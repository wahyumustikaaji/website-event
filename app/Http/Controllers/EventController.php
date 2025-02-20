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
    private function getActiveEventsQuery()
    {
        return Event::where(function ($query) {
            $query->where('end_date', '>', Carbon::now()->subDays(3))
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

        $category = Category::withCount(['events' => function ($query) {
            $query->where('end_date', '>', Carbon::now()->subDays(3))
                ->orWhereNull('end_date');
        }])->get()->sortByDesc('events_count');

        $citycategory = CityCategory::withCount(['events' => function ($query) {
            $query->where('end_date', '>', Carbon::now()->subDays(3))
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

        $startDate = Carbon::parse($event->event_date);
        $endDate = Carbon::parse($event->end_date);
        $now = Carbon::now();

        $isExpired = $now->greaterThanOrEqualTo($endDate);
        $isOngoing = $now->greaterThanOrEqualTo($startDate) && $now->lessThan($endDate);

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

    // Register method remains unchanged as it already checks event availability
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
}
