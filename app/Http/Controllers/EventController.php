<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class EventController extends Controller
{
    /**
     * Display a listing of the resource, with filtering and searching.
     */
    public function show(Request $request)
    {
        $query = Event::query();

        if ($request->filled('search')) {
            $search = $request->input('search');
            $query->where(function($subQuery) use ($search) {
                $subQuery->where('title', 'like', '%' . $search . '%')
                         ->orWhere('kategori', 'like', '%' . $search . '%');
            });
        }

        if ($request->filled('category')) {
            $query->where('kategori', $request->input('category'));
        }
        
        $events = $query->latest()->paginate(9);

        return view('Event.eventView', ['events' => $events]);
    }

    public function store(Request $request)
    {
        //dd($request);
        $validatedData = $request->validate([
            'title'=>'required',
            'kategori'=>'required',
            'startTime'=>'required',
            'endTime'=>'required',
            'lokasi'=>'required',
            'detail'=>'required',
            'date'=>'required',
            'image'=>'required|image|mimes:jpg,png',
            'link'=>'required'
        ]);
        
        $validatedData['image'] = $request->file('image')->store('eventImage','public');
        
        Event::create($validatedData);
        
        return redirect('/events');
    }

    public function showDetail(Event $event)
    {
        return view('Event.eventDetail',["event"=>$event]);
    }


    // Ini fungsi buat toggle favorite
    public function toggleFavorite($id)
    {
        try {
            $event = Event::findOrFail($id);
            $event->isFavorite = !$event->isFavorite;
            $event->save();
            
            $message = $event->isFavorite ? 
                'Event berhasil ditambahkan ke favorit!' : 
                'Event berhasil dihapus dari favorit!';
                
            return redirect()->back()->with('success', $message);
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Terjadi kesalahan saat mengubah status favorit.');
        }
    }

    // ini fungsi buat show semua event yang di fav (termasuk search & filter kategori e)
    public function showFavorites(Request $request)
    {
        $query = Event::where('isFavorite', true);

        if ($request->filled('search')) {
            $search = $request->input('search');
            $query->where(function($subQuery) use ($search) {
                $subQuery->where('title', 'like', '%' . $search . '%')
                        ->orWhere('kategori', 'like', '%' . $search . '%');
            });
        }

        if ($request->filled('category')) {
            $query->where('kategori', $request->input('category'));
        }
        
        $events = $query->latest()->paginate(10);

        return view('Event.eventFavorite', ['events' => $events]);
    }
}