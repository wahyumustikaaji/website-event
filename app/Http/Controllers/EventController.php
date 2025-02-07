<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\CityCategory;
use App\Models\Event;
use App\Models\EventParticipant;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

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

    public function show($slug)
    {
        $event = Event::where('slug', $slug)->firstOrFail();
        $category = $event->category;
        $citycategory = $event->citycategory;
        $user = Auth::user();

        // Cek apakah user sudah terdaftar dalam event
        $isRegistered = false;
        if ($user) {
            $isRegistered = EventParticipant::where('event_id', $event->id)
                ->where('user_id', $user->id)
                ->exists();
        }

        return view('home.event', [
            'event' => $event,
            'category' => $category,
            'citycategory' => $citycategory,
            'isRegistered' => $isRegistered
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

        $events = Event::where('category_id', $citycategory->id)->get();

        return view('home.city-category', [
            'citycategory' => $citycategory,
            'events' => $events
        ]);
    }
}
