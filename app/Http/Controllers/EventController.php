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
        if ($user) {
            $isRegistered = EventParticipant::where('event_id', $event->id)
                ->where('user_id', $user->id)
                ->exists();
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

        return view('home.event', [
            'event' => $event,
            'category' => $category,
            'citycategory' => $citycategory,
            'isRegistered' => $isRegistered,
            'isExpired' => $isExpired,
            'isOngoing' => $isOngoing,
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

        EventParticipant::create([
            'event_id' => $event->id,
            'user_id' => $user->id
        ]);

        $event->decrement('ticket_quantity');

        return redirect()->back()->with('success', 'Berhasil Mendaftar Event!');
    }

    public function ticket($eventSlug, $userName)
    {
        $user = User::where('name', $userName)->firstOrFail();
        $event = Event::where('slug', $eventSlug)->firstOrFail();

        $isParticipant = EventParticipant::where('event_id', $event->id)
            ->where('user_id', $user->id)
            ->exists();

        if (!$isParticipant) {
            abort(403, 'Anda belum mendaftar di event ini.');
        }

        $fileName = $user->id . '-' . $event->id . '.svg';
        $qrCodePath = 'public/qrcodes/' . $fileName;
        $storagePath = storage_path('app/' . $qrCodePath);

        // Generate QR Code
        QrCode::format('svg')->size(250)->generate(route('ticket', [$event->slug, $user->name]), $storagePath);

        return view('home.ticket', compact('event', 'user', 'fileName'));
    }
}
