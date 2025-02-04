<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Event;
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

        return view('home.events', ['events' => $events, 'popularEvents' => $popularEvents, 'category' => $category,]);
    }

    public function show($slug)
    {
        $event = Event::where('slug', $slug)->firstOrFail();

        $category = $event->category;

        return view('home.event', ['event' => $event, 'category' => $category]);
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
}
