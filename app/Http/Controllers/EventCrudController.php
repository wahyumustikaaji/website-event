<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\CityCategory;
use App\Models\Event;
use App\Models\EventParticipant;
use App\Models\EventVisitor;
use App\Models\Payment;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use DateTime;

class EventCrudController extends Controller
{
    public function dashboard()
    {
        $user = Auth::user();
        $currentDate = new DateTime();
        $yesterday = (new DateTime())->modify('-1 day');

        // Total Events Created
        $totalEvents = Event::where('creator_id', $user->id)->count();
        $yesterdayTotalEvents = Event::where('creator_id', $user->id)
            ->where('created_at', '<', $yesterday->format('Y-m-d 23:59:59'))
            ->count();
        $eventPercentageChange = $yesterdayTotalEvents > 0
            ? (($totalEvents - $yesterdayTotalEvents) / $yesterdayTotalEvents) * 100
            : 0;

        // My Tickets (Events I've registered for)
        $myTickets = EventParticipant::where('user_id', $user->id)->where('is_approved', true)->where('payment_status', true)->count();
        $yesterdayTickets = EventParticipant::where('user_id', $user->id)
            ->where('created_at', '<', $yesterday->format('Y-m-d 23:59:59'))
            ->count();
        $ticketPercentageChange = $yesterdayTickets > 0
            ? (($myTickets - $yesterdayTickets) / $yesterdayTickets) * 100
            : 0;

        $now = now(); // Waktu saat ini

        // Ongoing Events: Event yang sedang berlangsung
        $ongoingEvents = Event::where('creator_id', $user->id)
            ->where('event_date', '<=', $now)  // Event sudah dimulai
            ->where('end_date', '>', $now)     // Event belum berakhir
            ->count();

        // Page Views
        $userEventIds = Event::where('creator_id', $user->id)->pluck('id');
        $pageViews = EventVisitor::whereIn('event_id', $userEventIds)->count();
        $yesterdayPageViews = EventVisitor::whereIn('event_id', $userEventIds)
            ->where('created_at', '<', $yesterday->format('Y-m-d 23:59:59'))
            ->count();
        $pageViewsPercentageChange = $yesterdayPageViews > 0
            ? (($pageViews - $yesterdayPageViews) / $yesterdayPageViews) * 100
            : 0;

        $myevents = Event::where('creator_id', $user->id)->limit(6)->get();

        return view('dashboard.dashboard', compact(
            'totalEvents',
            'eventPercentageChange',
            'myTickets',
            'ongoingEvents',
            'pageViews',
            'pageViewsPercentageChange',
            'user',
            'myevents',
        ));
    }

    public function eventCreate()
    {
        $user = Auth::user();
        $currentDateTime = now();

        $myevents = Event::where('creator_id', $user->id)
            ->where('end_date', '>=', $currentDateTime)
            ->get();

        return view('dashboard.event-create', compact('myevents'));
    }

    public function myEvent()
    {
        $user = Auth::user();
        $myeventsregistered = Event::whereHas('participants', function ($query) use ($user) {
            $query->where('user_id', $user->id)
                ->where('is_approved', true)
                ->where('payment_status', true);
        })->get();

        return view('dashboard.my-event', compact('myeventsregistered'));
    }

    public function eventFinished()
    {
        $user = Auth::user();
        $currentDateTime = now();

        $myeventsfinished = Event::where('creator_id', $user->id)
            ->where('end_date', '<', $currentDateTime)
            ->get();

        return view('dashboard.event-finished', compact('myeventsfinished'));
    }

    public function historyPayment()
    {
        $user = Auth::user();
        $payments = Payment::where('user_id', $user->id)
            ->orderBy('created_at', 'desc')
            ->get();

        return view('dashboard.history-payment', compact('user', 'payments'));
    }

    public function detailEvent($slug)
    {
        $event = Event::where('slug', $slug)->firstOrFail();
        $category = $event->category;
        $citycategory = $event->citycategory;
        $eventParticipants = EventParticipant::where('event_id', $event->id)
            ->with('user')
            ->get();

        // Get views data for the last 12 months
        $viewsData = $this->getEventViewsData($event->id);

        // Get browser statistics
        $browserData = $this->getBrowserStatistics($event->id);

        return view('dashboard.detail-event', [
            'event' => $event,
            'bubbleData' => [
                'browsers' => array_column($browserData, 'device'),
                'totals' => array_column($browserData, 'total')
            ],
            'eventParticipants' => $eventParticipants,
            'category' => $category,
            'citycategory' => $citycategory,
            'chartData' => [
                'dates' => array_column($viewsData, 'date'),
                'views' => array_column($viewsData, 'total_views')
            ]
        ]);
    }

    private function getEventViewsData(int $eventId): array
    {
        // Get the current date and one year later
        $currentDate = new DateTime();
        $oneYearLater = (new DateTime())->modify('+12 months');

        // Get the raw views data from database
        $rawViewsData = EventVisitor::select(
            DB::raw('DATE_FORMAT(created_at, "%Y-%m") as date'),
            DB::raw('COUNT(*) as total_views')
        )
            ->where('event_id', $eventId)
            ->where('created_at', '<=', $oneYearLater->format('Y-m-d H:i:s'))
            ->groupBy('date')
            ->orderBy('date')
            ->get()
            ->toArray();

        // Convert to associative array for easier lookup
        $viewsByMonth = array_column($rawViewsData, 'total_views', 'date');

        // Generate complete data for last 12 months
        $completeViewsData = [];
        for ($i = 11; $i >= 0; $i--) {
            $date = (new DateTime())->modify("-$i months")->format('Y-m');
            $completeViewsData[] = [
                'date' => $date,
                'total_views' => $viewsByMonth[$date] ?? 0
            ];
        }

        return $completeViewsData;
    }

    private function getBrowserStatistics(int $eventId): array
    {
        return EventVisitor::select('device', DB::raw('COUNT(*) as total'))
            ->where('event_id', $eventId)
            ->groupBy('device')
            ->get()
            ->toArray();
    }

    public function createEvent()
    {
        $categories = Category::all();
        $cityCategories = CityCategory::all();
        $event = null;
        return view('dashboard.create-event', compact('categories', 'cityCategories', 'event'));
    }

    public function store(Request $request)
    {
        $messages = $this->getValidationMessages();

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'body' => 'required',
            'category_id' => 'required|exists:categories,id',
            'city_category_id' => 'required|exists:city_categories,id',
            'image' => 'required|image|mimes:jpg,jpeg,png|max:2048',
            'event_date' => 'required|date',
            'start_time' => 'required',
            'end_date' => 'required|date|after_or_equal:event_date',
            'end_time' => 'required',
            'location_name' => 'required|string|max:255',
            'address' => 'required|string',
            'ticket_quantity' => 'nullable|integer|min:1|max:100000',
            'price_ticket' => 'nullable|numeric|min:0',
        ], $messages);

        if ($request->has('price_ticket')) {
            $priceTicket = str_replace('.', '', $request->price_ticket);
        } else {
            $priceTicket = null;
        }

        // Handle image upload
        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('events', 'public');
        }

        $slug = Str::slug($request->title);

        Event::create([
            'title' => $request->title,
            'slug' => $slug,
            'category_id' => $request->category_id,
            'city_category_id' => $request->city_category_id,
            'creator_id' => Auth::user()->id,
            'location_name' => $request->location_name,
            'address' => $request->address,
            'body' => $request->body,
            'event_date' => $request->event_date,
            'start_time' => $request->start_time,
            'end_date' => $request->end_date,
            'end_time' => $request->end_time,
            'ticket_quantity' => $request->ticket_quantity,
            'image' => $imagePath,
            'price_ticket' => $priceTicket,
            'requires_approval' => $request->has('requires_approval') ? 1 : 0,
        ]);

        return redirect()
            ->route('create-event')
            ->with('success', 'Event berhasil dibuat!')
            ->with('showModal', true)
            ->with('slug', $slug);
    }

    public function edit($slug)
    {
        $event = Event::where('slug', $slug)->firstOrFail();

        if ($event->creator_id !== Auth::user()->id) {
            abort(403);
        }

        // Format dates for form
        if ($event->event_date && $event->end_date) {
            $event->event_date = (new DateTime($event->event_date))->format('Y-m-d');
            $event->end_date = (new DateTime($event->end_date))->format('Y-m-d');
        }

        $categories = Category::all();
        $cityCategories = CityCategory::all();

        return view('dashboard.create-event', [
            'event' => $event,
            'categories' => $categories,
            'cityCategories' => $cityCategories
        ]);
    }

    public function update(Request $request, $slug)
    {
        $event = Event::where('slug', $slug)->firstOrFail();

        if ($event->creator_id !== Auth::user()->id) {
            abort(403);
        }

        $messages = $this->getValidationMessages();

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'city_category_id' => 'required|exists:city_categories,id',
            'ticket_quantity' => 'required|integer|min:0',
            'body' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'event_date' => 'required|date',
            'start_time' => 'required',
            'end_date' => 'required|date|after_or_equal:event_date',
            'end_time' => 'required',
            'location_name' => 'required|string|max:255',
            'address' => 'required|string',
            'price_ticket' => 'nullable|numeric|min:0',
        ], $messages);

        if ($request->has('price_ticket')) {
            $priceTicket = str_replace('.', '', $request->price_ticket);
        } else {
            $priceTicket = null;
        }

        // Handle image upload
        if ($request->hasFile('image')) {
            if ($event->image) {
                Storage::disk('public')->delete($event->image);
            }
            $imagePath = $request->file('image')->store('events', 'public');
            $event->image = $imagePath;
        }

        $event->update([
            'title' => $validated['title'],
            'slug' => Str::slug($validated['title']),
            'category_id' => $validated['category_id'],
            'city_category_id' => $validated['city_category_id'],
            'ticket_quantity' => $validated['ticket_quantity'],
            'body' => $validated['body'],
            'event_date' => $validated['event_date'],
            'start_time' => $validated['start_time'],
            'end_date' => $validated['end_date'],
            'end_time' => $validated['end_time'],
            'location_name' => $validated['location_name'],
            'address' => $validated['address'],
            'price_ticket' => $priceTicket,
            'requires_approval' => $request->has('requires_approval') ? 1 : 0,
        ]);

        return redirect()->route('event-create')->with('success', 'Event berhasil diperbarui!');
    }

    public function destroy($slug)
    {
        $event = Event::where('slug', $slug)->firstOrFail();

        if ($event->creator_id !== Auth::user()->id) {
            abort(403);
        }

        // Delete associated image
        if ($event->image) {
            Storage::disk('public')->delete($event->image);
        }

        $event->delete();

        return redirect()->route('dashboard')->with('success', 'Event berhasil dihapus.');
    }

    /**
     * Get validation messages
     */
    private function getValidationMessages(): array
    {
        return [
            'title.required' => 'Nama event wajib diisi',
            'title.max' => 'Nama event tidak boleh lebih dari 255 karakter',
            'body.required' => 'Deskripsi event wajib diisi',
            'image.required' => 'Poster event wajib diisi',
            'image.image' => 'File harus berupa gambar',
            'image.mimes' => 'Format gambar harus jpg, jpeg, atau png',
            'image.max' => 'Ukuran gambar tidak boleh lebih dari 2MB',
            'ticket_quantity.min' => 'Jumlah tiket minimal 1',
            'ticket_quantity.max' => 'Jumlah tiket maksimal 100.000',
            'event_date.required' => 'Tanggal event wajib diisi',
            'event_date.date' => 'Format tanggal tidak valid',
            'start_time.required' => 'Waktu mulai wajib diisi',
            'end_date.required' => 'Tanggal selesai wajib diisi',
            'end_time.required' => 'Waktu selesai wajib diisi',
            'location_name.required' => 'Nama lokasi wajib diisi',
            'address.required' => 'Alamat wajib diisi',
        ];
    }

    public function approveParticipant(Request $request, $slug, $participantId)
    {
        $event = Event::where('slug', $slug)->firstOrFail();

        // Check if current user is the event creator
        if ($event->creator_id !== Auth::user()->id) {
            return redirect()->back()->with('error', 'Anda tidak memiliki izin untuk menyetujui peserta.');
        }

        $participant = EventParticipant::findOrFail($participantId);

        // Check if participant belongs to this event
        if ($participant->event_id !== $event->id) {
            return redirect()->back()->with('error', 'Peserta tidak terdaftar dalam event ini.');
        }

        // Update approval status
        $participant->update([
            'is_approved' => true
        ]);

        return redirect()->back()->with('success', 'Peserta berhasil disetujui.');
    }

    /**
     * View participant details
     */
    public function participantDetail($slug, $participantId)
    {
        $event = Event::where('slug', $slug)->firstOrFail();

        // Check if current user is the event creator
        if ($event->creator_id !== Auth::user()->id) {
            return redirect()->back()->with('error', 'Anda tidak memiliki izin untuk melihat detail peserta.');
        }

        $participant = EventParticipant::with('user')->findOrFail($participantId);

        // Check if participant belongs to this event
        if ($participant->event_id !== $event->id) {
            return redirect()->back()->with('error', 'Peserta tidak terdaftar dalam event ini.');
        }

        return view('dashboard.participant-detail', [
            'event' => $event,
            'participant' => $participant
        ]);
    }

    /**
     * Remove a participant from an event
     */
    public function removeParticipant(Request $request, $slug, $participantId)
    {
        $event = Event::where('slug', $slug)->firstOrFail();

        // Check if current user is the event creator
        if ($event->creator_id !== Auth::user()->id) {
            return redirect()->back()->with('error', 'Anda tidak memiliki izin untuk menghapus peserta.');
        }

        $participant = EventParticipant::findOrFail($participantId);

        // Check if participant belongs to this event
        if ($participant->event_id !== $event->id) {
            return redirect()->back()->with('error', 'Peserta tidak terdaftar dalam event ini.');
        }

        // Delete the participant
        $participant->delete();

        // Increment the ticket quantity back if this was a paid event
        if ($event->price_ticket > 0) {
            $event->increment('ticket_quantity');
        }

        return redirect()->back()->with('success', 'Peserta berhasil dihapus dari event.');
    }
}
