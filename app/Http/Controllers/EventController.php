<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\CityCategory;
use App\Models\Event;
use App\Models\EventParticipant;
use App\Models\EventVisitor;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Jenssegers\Agent\Agent;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Barryvdh\DomPdf\Facade\Pdf;
use Illuminate\Support\Facades\Crypt;

class EventController extends Controller
{
    private function getActiveEventsQuery()
    {
        $threeDaysAgo = date('Y-m-d H:i:s', strtotime('-3 days'));
        return Event::where(function ($query) use ($threeDaysAgo) {
            $query->where('end_date', '>', $threeDaysAgo)
                ->orWhereNull('end_date');
        });
    }

    public function events()
    {
        $popularEvents = $this->getActiveEventsQuery()
            ->withCount('participants')
            ->orderByDesc('participants_count')
            ->limit(6)
            ->get();

        $events = $this->getActiveEventsQuery()->get();

        $threeDaysAgo = date('Y-m-d H:i:s', strtotime('-3 days'));
        $category = Category::withCount(['events' => function ($query) use ($threeDaysAgo) {
            $query->where('end_date', '>', $threeDaysAgo)
                ->orWhereNull('end_date');
        }])->get()->sortByDesc('events_count');

        $citycategory = CityCategory::withCount(['events' => function ($query) use ($threeDaysAgo) {
            $query->where('end_date', '>', $threeDaysAgo)
                ->orWhereNull('end_date');
        }])->get()->sortByDesc('events_count');

        return view('home.events', [
            'events' => $events,
            'popularEvents' => $popularEvents,
            'category' => $category,
            'citycategory' => $citycategory
        ]);
    }

    public function show($slug, Request $request)
    {
        $event = Event::where('slug', $slug)->firstOrFail();
        $category = $event->category;
        $citycategory = $event->citycategory;
        $user = Auth::user();

        $startDate = new \DateTime($event->event_date);
        $endDate = new \DateTime($event->end_date);
        $now = new \DateTime();

        $isExpired = $now >= $endDate;
        $isOngoing = $now >= $startDate && $now < $endDate;

        $isRegistered = false;
        $isApproved = false;
        $participant = null;

        if ($user) {
            $participant = EventParticipant::where('event_id', $event->id)
                ->where('user_id', $user->id)
                ->first();

            if ($participant) {
                $isRegistered = true;
                // Ubah kondisi isApproved untuk memeriksa is_approved DAN payment_status
                $isApproved = $participant->is_approved && $participant->payment_status;
            }
        }

        $event->increment('views');

        $ip = $request->ip();
        $agent = new Agent();

        $location = Http::get("http://ip-api.com/json/{$ip}")->json();

        EventVisitor::create([
            'event_id' => $event->id,
            'ip_address' => $ip,
            'country' => $location['country'] ?? 'Unknown',
            'city' => $location['city'] ?? 'Unknown',
            'device' => $agent->isMobile() ? 'Mobile' : 'Desktop',
            'browser' => $agent->browser(),
        ]);

        // Jika latitude & longitude belum ada, coba dapatkan dari alamat
        if (!$event->latitude || !$event->longitude) {
            try {
                $address = urlencode($event->location_name . ' ' . $event->address);
                $geocode = Http::get("https://nominatim.openstreetmap.org/search?format=json&q={$address}")->json();

                if (!empty($geocode)) {
                    $event->update([
                        'latitude' => $geocode[0]['lat'],
                        'longitude' => $geocode[0]['lon']
                    ]);
                }
            } catch (\Exception $e) {
                // Handle error
            }
        }

        return view('home.event', [
            'event' => $event,
            'user' => $user,
            'category' => $category,
            'citycategory' => $citycategory,
            'isRegistered' => $isRegistered,
            'isExpired' => $isExpired,
            'isOngoing' => $isOngoing,
            'isApproved' => $isApproved,
        ]);
    }

    public function showByCategory($slug)
    {
        $category = Category::where('slug', $slug)->firstOrFail();

        $events = $this->getActiveEventsQuery()
            ->where('category_id', $category->id)
            ->get();

        return view('home.category', [
            'category' => $category,
            'events' => $events
        ]);
    }

    public function showByCityCategory($slug)
    {
        $citycategory = CityCategory::where('slug', $slug)->firstOrFail();

        $events = $this->getActiveEventsQuery()
            ->where('city_category_id', $citycategory->id)
            ->get();

        return view('home.city-category', [
            'citycategory' => $citycategory,
            'events' => $events
        ]);
    }

    public function search(Request $request)
    {
        $search = $request->input('search');

        $query = Event::latest();

        if (!empty($search)) {
            $query->where('title', 'like', '%' . $search . '%');
        }

        $events = $query->paginate(20);
        $category = Category::all();

        return view('home.search-event', compact('events', 'search', 'category'));
    }

    public function register(Request $request, $slug)
    {
        $event = Event::where('slug', $slug)->firstOrFail();
        $user = Auth::user();

        if (!$user) {
            return redirect()->route('login')->with('error', 'Silakan login untuk mendaftar.');
        }

        if ($event->ticket_quantity == 0) {
            return redirect()->back()->with('error', 'Tiket sudah habis.');
        }

        $isRegistered = EventParticipant::where('event_id', $event->id)
            ->where('user_id', $user->id)
            ->exists();

        if ($isRegistered) {
            return redirect()->back()->with('error', 'Anda sudah terdaftar dalam event ini.');
        }

        // Set payment_status to true if the event is free
        $paymentStatus = ($event->price_ticket == 0) ? true : false;

        // Set is_approved to true if the event doesn't require approval
        $isApproved = ($event->requires_approval == false) ? true : false;

        EventParticipant::create([
            'event_id' => $event->id,
            'user_id' => $user->id,
            'payment_status' => $paymentStatus, // Set payment status based on price
            'is_approved' => $isApproved // Set approval status based on requires_approval
        ]);

        $event->decrement('ticket_quantity');

        return redirect()->back()->with('success', 'Berhasil Mendaftar Event!');
    }

    public function ticket($eventSlug, $code)
    {
        try {
            $decrypted = Crypt::decryptString($code);
            $parts = explode('-', $decrypted);

            if (count($parts) !== 2) {
                abort(404);
            }

            $userId = $parts[0];
            $eventId = $parts[1];

            $user = User::findOrFail($userId);
            $event = Event::where('slug', $eventSlug)->where('id', $eventId)->firstOrFail();

            if (Auth::id() != $userId) {
                abort(403, 'Unauthorized access');
            }

            $isParticipant = EventParticipant::where('event_id', $event->id)
                ->where('user_id', $user->id)
                ->where('is_approved', true)
                ->where('payment_status', true)
                ->exists();

            if (!$isParticipant) {
                return redirect()->route('event.show', $event->slug)
                    ->with('error', 'Anda belum terdaftar atau belum menyelesaikan pembayaran.');
            }

            $fileName = $user->id . '-' . $event->id . '.svg';
            $qrCodePath = 'public/qrcodes/' . $fileName;
            $storagePath = storage_path('app/' . $qrCodePath);

            QrCode::format('svg')->size(250)->generate(route('ticket', [$event->slug, $code]), $storagePath);

            return view('home.ticket', compact('event', 'user', 'fileName'));
        } catch (\Exception $e) {
            abort(404);
        }
    }

    public function generateTicketCode($userId, $eventId)
    {
        $data = $userId . '-' . $eventId;
        return Crypt::encryptString($data);
    }

    public function cancelRegistration($slug)
    {
        $event = Event::where('slug', $slug)->firstOrFail();
        $user = Auth::user();

        if (!$user) {
            return redirect()->route('login')->with('error', 'Silakan login untuk membatalkan pendaftaran.');
        }

        $participant = EventParticipant::where('event_id', $event->id)
            ->where('user_id', $user->id)
            ->first();

        if (!$participant) {
            return redirect()->back()->with('error', 'Anda tidak terdaftar dalam event ini.');
        }

        $participant->delete();

        $event->increment('ticket_quantity');

        return redirect()->back()->with('success', 'Pendaftaran event berhasil dibatalkan.');
    }
}
