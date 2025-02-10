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
            ->with('user') // Mengambil informasi user yang mendaftar
            ->get();
        $viewsData = Event::select(
            DB::raw('DATE(created_at) as date'),
            DB::raw('SUM(views) as total_views')
        )
            ->where('id', $event->id) // Filter berdasarkan event yang sedang dilihat
            ->groupBy('date')
            ->orderBy('date')
            ->limit(12)
            ->get();


        $browserData = EventVisitor::select('device', DB::raw('COUNT(*) as total'))
            ->where('event_id', $event->id) // Pastikan hanya mengambil data event yang sedang dilihat
            ->groupBy('device')
            ->get();

        $bubbleData = [
            'browsers' => $browserData->pluck('device'), // Nama browser
            'totals' => $browserData->pluck('total') // Jumlah pengguna per browser
        ];

        return view('dashboard.detail-event', [
            'event' => $event,
            'bubbleData' => $bubbleData,
            'eventParticipants' => $eventParticipants,
            'category' => $category,
            'citycategory' => $citycategory,
            'chartData' => [
                'dates' => $viewsData->pluck('date'),
                'views' => $viewsData->pluck('total_views')
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
        try {
            $request->validate([
                'title' => 'required|string|max:255',
                'body' => 'required|string|max:2000',
                'category_id' => 'required|exists:categories,id',
                'city_category_id' => 'required|exists:city_categories,id',
                'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
                'event_date' => 'required|date',
                'start_time' => 'required',
                'end_date' => 'required|date',
                'end_time' => 'required',
                'location_name' => 'required|string|max:255',
                'address' => 'required|string|max:255',
                'ticket_quantity' => 'nullable|integer|min:1',
            ]);

            // Simpan gambar jika ada
            $imagePath = null;
            if ($request->hasFile('image')) {
                $imagePath = $request->file('image')->store('events', 'public');
            }

            $slug = Str::slug($request->title);

            Event::create([
                'title' => $request->title,
                'slug' => Str::slug($request->title),
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

            // Redirect dengan flash message dan menandai bahwa modal harus ditampilkan
            return redirect()
                ->route('create-event')
                ->with('success', 'Event berhasil dibuat!')
                ->with('showModal', true)
                ->with('slug', $slug); // Menyimpan ID event untuk preview

        } catch (\Exception $e) {
            // Handle error
            return redirect()
                ->back()
                ->withInput()
                ->withErrors(['error' => 'Terjadi kesalahan saat membuat event. Silakan coba lagi.']);
        }
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
        ]);

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
