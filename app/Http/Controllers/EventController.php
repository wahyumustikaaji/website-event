<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\CityCategory;
use App\Models\Event;
use App\Models\EventParticipant;
use App\Models\EventVisitor;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Jenssegers\Agent\Agent;

class EventController extends Controller
{
    public function events()
    {
        $popularEvents = Event::withCount('participants')
            ->orderByDesc('participants_count')
            ->limit(6)
            ->get();

        $events = Event::all();

        $category = Category::withCount('events')->get()->sortByDesc('events_count');
        $citycategory = CityCategory::withCount('events')->get()->sortByDesc('events_count');

        return view('home.events', ['events' => $events, 'popularEvents' => $popularEvents, 'category' => $category, 'citycategory' => $citycategory]);
    }

    public function show($slug, Request $request)
    {
        $event = Event::where('slug', $slug)->firstOrFail();
        $category = $event->category;
        $citycategory = $event->citycategory;
        $user = Auth::user();

        // Konversi start_date dan end_date ke format tanggal
        $startDate = Carbon::parse($event->start_date);
        $endDate = Carbon::parse($event->end_date);
        $now = Carbon::now();

        // Periksa status event berdasarkan tanggal
        $isExpired = $now->greaterThan($endDate); // Event sudah selesai jika sekarang lebih dari end_date
        $isOngoing = $now->between($startDate, $endDate); // Event berlangsung jika sekarang di antara start_date dan end_date

        $isRegistered = false;
        if ($user) {
            $isRegistered = EventParticipant::where('event_id', $event->id)
                ->where('user_id', $user->id)
                ->exists();
        }

        // Meningkatkan jumlah views (hanya jika belum dikunjungi dalam sesi ini)
        $event->increment('views');

        // **Menyimpan Data Demografi Pengunjung**
        $ip = $request->ip();
        $agent = new Agent(); // Menggunakan Jenssegers\Agent untuk mendeteksi device/browser

        // Ambil informasi lokasi berdasarkan IP (menggunakan API seperti ip-api.com atau geoplugin.net)
        $location = Http::get("http://ip-api.com/json/{$ip}")->json();

        EventVisitor::create([
            'event_id' => $event->id,
            'ip_address' => $ip,
            'country' => $location['country'] ?? 'Unknown',
            'city' => $location['city'] ?? 'Unknown',
            'device' => $agent->isMobile() ? 'Mobile' : 'Desktop',
            'browser' => $agent->browser(),
        ]);

        return view('home.event', [
            'event' => $event,
            'category' => $category,
            'citycategory' => $citycategory,
            'isRegistered' => $isRegistered,
            'isExpired' => $isExpired,
            'isOngoing' => $isOngoing,
        ]);
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

        EventParticipant::create([
            'event_id' => $event->id,
            'user_id' => $user->id
        ]);

        $event->decrement('ticket_quantity');

        return redirect()->back()->with('success', 'Berhasil Mendaftar Event!');
    }

    public function showByCategory($slug)
    {
        $category = Category::where('slug', $slug)->firstOrFail();

        $events = Event::where('category_id', $category->id)->get();

        return view('home.category', [
            'category' => $category,
            'events' => $events
        ]);
    }

    public function showByCityCategory($slug)
    {
        $citycategory = CityCategory::where('slug', $slug)->firstOrFail();

        $events = Event::where('city_category_id', $citycategory->id)->get();

        return view('home.city-category', [
            'citycategory' => $citycategory,
            'events' => $events
        ]);
    }

    public function search(Request $request)
    {
        // Tangkap query pencarian dari request
        $search = $request->input('search');

        // Mulai query untuk post (dengan sorting terbaru)
        $query = Event::latest();

        // Cek apakah parameter 'search' ada
        if (!empty($search)) {
            $query->where('title', 'like', '%' . $search . '%');
        }

        // Ambil hasil query dengan paginasi
        $events = $query->paginate(20);
        $category = Category::all();

        // Kirim data ke view
        return view('home.search-event', compact('events', 'search', 'category'));
    }
}
