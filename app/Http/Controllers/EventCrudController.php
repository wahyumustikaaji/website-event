<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\CityCategory;
use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

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
        $categories = Category::all();
        $cityCategories = CityCategory::all();
        return view('dashboard.create-event', compact('categories', 'cityCategories'));
    }

    public function store(Request $request)
    {
        try {
            $request->validate([
                'title' => 'required|string|max:255',
                'body' => 'required|string|max:500',
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
