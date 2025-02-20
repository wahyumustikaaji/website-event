<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\CityCategory;
use App\Models\Event;
use App\Models\EventParticipant;
use App\Models\EventVisitor;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;

class EventCrudController extends Controller
{
    public function dashboard()
    {
        $user = Auth::user();

        $myevents = Event::where('creator_id', $user->id)->get();

        return view('dashboard.dashboard', compact('myevents'));
    }

    public function myEvent()
    {
        $user = Auth::user();

        $myeventsregistered = Event::whereHas('participants', function ($query) use ($user) {
            $query->where('user_id', $user->id);
        })->get();

        return view('dashboard.my-event', compact('myeventsregistered'));
    }

    public function detailEvent($slug)
    {
        $event = Event::where('slug', $slug)->firstOrFail();
        $category = $event->category;
        $citycategory = $event->citycategory;
        $eventParticipants = EventParticipant::where('event_id', $event->id)
            ->with('user')
            ->get();

        // Query untuk data views per bulan
        $viewsData = EventVisitor::select(
            DB::raw('DATE_FORMAT(created_at, "%Y-%m") as date'),
            DB::raw('COUNT(*) as total_views')
        )
            ->where('event_id', $event->id)
            ->where('created_at', '<=', now()->addMonths(12)) // Ambil data 12 bulan ke depan
            ->groupBy('date')
            ->orderBy('date')
            ->get();

        // Mengisi bulan yang kosong dengan 0
        $completeViewsData = collect();
        for ($i = 11; $i >= 0; $i--) {
            $date = now()->subMonths($i)->format('Y-m');
            $viewForDate = $viewsData->firstWhere('date', $date);
            $completeViewsData->push([
                'date' => $date,
                'total_views' => $viewForDate ? $viewForDate->total_views : 0
            ]);
        }

        $browserData = EventVisitor::select('device', DB::raw('COUNT(*) as total'))
            ->where('event_id', $event->id)
            ->groupBy('device')
            ->get();

        $bubbleData = [
            'browsers' => $browserData->pluck('device'),
            'totals' => $browserData->pluck('total')
        ];

        return view('dashboard.detail-event', [
            'event' => $event,
            'bubbleData' => $bubbleData,
            'eventParticipants' => $eventParticipants,
            'category' => $category,
            'citycategory' => $citycategory,
            'chartData' => [
                'dates' => $completeViewsData->pluck('date'),
                'views' => $completeViewsData->pluck('total_views')
            ]
        ]);
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
        $messages = [
            'title.required' => 'Nama event wajib diisi',
            'title.max' => 'Nama event tidak boleh lebih dari 255 karakter',
            'body.required' => 'Deskripsi event wajib diisi',
            'body.max' => 'Deskripsi tidak boleh lebih dari 2000 karakter',
            'image.required' => 'Poster event wajib diisi',
            'image.image' => 'File harus berupa gambar',
            'image.mimes' => 'Format gambar harus jpg, jpeg, atau png',
            'image.max' => 'Ukuran gambar tidak boleh lebih dari 2MB',
            'ticket_quantity.min' => 'Jumlah tiket minimal 1',
            'ticket_quantity.max' => 'Jumlah tiket terlalu banyak',
            'event_date.required' => 'Tanggal event wajib diisi',
            'event_date.date' => 'Format tanggal tidak valid',
            'start_time.required' => 'Waktu mulai wajib diisi',
            'end_date.required' => 'Tanggal selesai wajib diisi',
            'end_time.required' => 'Waktu selesai wajib diisi',
            'location_name.required' => 'Nama lokasi wajib diisi',
            'address.required' => 'Alamat wajib diisi',
        ];

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'body' => 'required|string|max:2000',
            'category_id' => 'required|exists:categories,id',
            'city_category_id' => 'required|exists:city_categories,id',
            'image' => 'required|image|mimes:jpg,jpeg,png|max:2048',
            'event_date' => 'required|date',
            'start_time' => 'required',
            'end_date' => 'required|date|after_or_equal:event_date',
            'end_time' => 'required',
            'location_name' => 'required|string|max:255',
            'address' => 'required|string',
            'ticket_quantity' => 'nullable|integer|min:1|max:999999',
        ], $messages);

        // Simpan gambar jika ada
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

        if ($event->event_date && $event->end_date) {
            $event->event_date = \Carbon\Carbon::parse($event->event_date)->format('Y-m-d');
            $event->end_date = \Carbon\Carbon::parse($event->end_date)->format('Y-m-d');
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

        $messages = [
            'title.required' => 'Nama event wajib diisi',
            'title.max' => 'Nama event tidak boleh lebih dari 255 karakter',
            'body.required' => 'Deskripsi event wajib diisi',
            'body.max' => 'Deskripsi tidak boleh lebih dari 2000 karakter',
            'image.required' => 'Poster event wajib diisi',
            'image.image' => 'File harus berupa gambar',
            'image.mimes' => 'Format gambar harus jpg, jpeg, atau png',
            'image.max' => 'Ukuran gambar tidak boleh lebih dari 2MB',
            'ticket_quantity.min' => 'Jumlah tiket minimal 1',
            'ticket_quantity.max' => 'Jumlah tiket terlalu banyak',
            'event_date.required' => 'Tanggal event wajib diisi',
            'event_date.date' => 'Format tanggal tidak valid',
            'start_time.required' => 'Waktu mulai wajib diisi',
            'end_date.required' => 'Tanggal selesai wajib diisi',
            'end_time.required' => 'Waktu selesai wajib diisi',
            'location_name.required' => 'Nama lokasi wajib diisi',
            'address.required' => 'Alamat wajib diisi',
        ];

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
            'address' => 'required|string'
        ], $messages);

        if ($request->hasFile('image')) {
            if ($event->image) {
                Storage::disk('public')->delete($event->image);
            }
            $imagePath = $request->file('image')->store('events', 'public');
        }

        $event->update([
            'title' => $validated['title'],
            'slug' => Str::slug($validated['title']),
            'category_id' => $validated['category_id'],
            'city_category_id' => $validated['city_category_id'],
            'ticket_quantity' => $validated['ticket_quantity'],
            'body' => $validated['body'],
            'image' => $request->hasFile('image') ? $imagePath : $event->image,
            'event_date' => $validated['event_date'],
            'start_time' => $validated['start_time'],
            'end_date' => $validated['end_date'],
            'end_time' => $validated['end_time'],
            'location_name' => $validated['location_name'],
            'address' => $validated['address']
        ]);

        return redirect()->route('dashboard')->with('success', 'Event berhasil diperbarui!');
    }

    public function destroy(Request $request, $slug)
    {
        $event = Event::where('slug', $slug)->firstOrFail();

        // Hapus gambar jika ada
        if ($event->image) {
            Storage::delete('public/' . $event->image);
        }

        $event->delete();

        return redirect()->route('dashboard')->with('success', 'Event berhasil dihapus.');
    }
}
