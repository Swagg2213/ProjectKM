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

        $topEvents = Event::query()
            ->where('status', 'approved') 
            ->withCount('favorites')
            ->orderBy('favorites_count', 'desc')
            ->take(10)
            ->get();


        // --- Main Query for Paginated & Filterable Events (your existing code) ---
        $query = Event::query();

        $query->where('status', 'approved');

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

        // Pass both the main events list and the top events list to the view
        return view('Event.eventView', [
            'events' => $events,
            'topEvents' => $topEvents,
        ]);
    }

    public function store(Request $request)
    {
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

        $user = auth()->user();
        $validatedData['user_id'] = $user->id; 
        $validatedData['image'] = $request->file('image')->store('eventImage','public');
        $validatedData['status'] = 'pending';
        
        Event::create($validatedData);
        
        return redirect('/events');
    }

    public function showEdit($id)
    {
        $event = Event::findOrFail($id);
        return view('Event.eventEdit', ['event' => $event]);
    }

    public function update(Request $request, $id)
    {
        $event = Event::findOrFail($id);
        
        $validatedData = $request->validate([
            'title'=>'required',
            'kategori'=>'required',
            'startTime'=>'required',
            'endTime'=>'required',
            'lokasi'=>'required',
            'detail'=>'required',
            'date'=>'required',
            'image'=>'nullable|image|mimes:jpg,png',
            'link'=>'required'
        ]);

        if ($request->hasFile('image')) {
            $validatedData['image'] = $request->file('image')->store('eventImage','public');
        } else {
            unset($validatedData['image']);
        }

        $validatedData['status'] = 'pending';

        $event->update($validatedData);
        
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
                'Event successfully added to Interested List!' : 
                'Event successfully deleted from Interested List!';
                
            return redirect()->back()->with('success', $message);
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'An error occurred while changing the favorite status.');
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

    public function approve($id)
    {
        return $this->updateStatus('approved', $id);
    }

    public function reject($id)
    {
        return $this->updateStatus('rejected', $id);
    }

    private function updateStatus($status, $id)
    {
        $event = Event::findOrFail($id);

        if (in_array($status, ['pending', 'rejected', 'approved'])) {
            $event->status = $status;
            $event->save();
            return redirect()->back()->with('success', 'Event status updated successfully.');
        }

        return redirect()->back()->with('error', 'Invalid status provided.');
    }
}