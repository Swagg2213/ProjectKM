<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class EventController extends Controller
{
public function show(Request $request)
    {
        $now = Carbon::now();

        $query = Event::query()
            ->where('status', 'approved')
            ->where(function ($dateQuery) use ($now) {
                $dateQuery->where('date', '>', $now->toDateString())
                    ->orWhere(function ($timeQuery) use ($now) {
                        $timeQuery->where('date', $now->toDateString())
                                  ->where('endTime', '>', $now->toTimeString());
                    });
            });

        if ($request->filled('search')) {
            $search = $request->input('search');
            $query->where(function ($subQuery) use ($search) {
                $subQuery->where('title', 'like', '%' . $search . '%')
                         ->orWhere('kategori', 'like', '%' . $search . '%');
            });
        }

        if ($request->filled('category')) {
            $query->where('kategori', $request->input('category'));
        }

        $events = $query->withCount('favorites')->latest()->paginate(9);

        $topEvents = Event::withCount('favorites')
            ->where('status', 'approved')
            ->where(function ($dateQuery) use ($now) {
                $dateQuery->where('date', '>', $now->toDateString())
                    ->orWhere(function ($timeQuery) use ($now) {
                        $timeQuery->where('date', $now->toDateString())
                                  ->where('endTime', '>', $now->toTimeString());
                    });
            })
            ->get()
            ->filter(function ($event) {
                return $event->favorites_count > 20;
            })
            ->sortByDesc('favorites_count')
            ->take(10);

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
        
        return redirect('/events')->with('success', 'Event successfully created and is pending approval.');
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
        
        return redirect('/events')->with('success', 'Event successfully updated and is pending approval.');
    }

    public function showDetail(Event $event)
    {
        return view('Event.eventDetail',["event"=>$event]);
    }

    public function toggleFavorite($id)
    {
        $user = Auth::user();
        $user->favorites()->toggle($id);

        $isFavorited = $user->favorites()->where('event_id', $id)->exists();

        $message = $isFavorited ?
            'Event successfully added to Interested List!' :
            'Event successfully deleted from Interested List!';

        return redirect()->back()->with('success', $message);
    }

    public function showFavorites(Request $request)
    {
        $query = Auth::user()->favorites();

        if ($request->filled('search')) {
            $search = $request->input('search');
            $query->where(function ($subQuery) use ($search) {
                $subQuery->where('title', 'like', '%' . $search . '%')
                    ->orWhere('kategori', 'like', '%' . $search . '%');
            });
        }

        if ($request->filled('category')) {
            $query->where('kategori', $request->input('category'));
        }

        $events = $query->latest()->paginate(10);
        
        $events->each(function ($event) {
            $event->isFavorite = true;
        });


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