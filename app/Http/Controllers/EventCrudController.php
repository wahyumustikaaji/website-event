<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EventCrudController extends Controller
{
    public function dashboard()
    {
        $user = Auth::user();

        // Ambil hanya event yang dibuat oleh user yang login
        $myevents = Event::where('creator_id', $user->id)->get();

        return view('dashboard.dashboard', compact('myevents'));
    }

    public function createEvent()
    {
        return view('dashboard.create-event');
    }
}
