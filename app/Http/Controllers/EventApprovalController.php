<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\EventReview;
use Illuminate\Http\Request;

class EventApprovalController extends Controller
{
public function show()
{
    $events = Event::where('status', 'pending')
                   ->latest()
                   ->paginate(10, ['*'], 'pending_page');

    $reviewedEvents = Event::whereIn('status', ['approved', 'rejected'])
                           ->latest('updated_at')
                           ->paginate(10, ['*'], 'reviewed_page');

    return view('EventApproval.eventApproval', compact('events', 'reviewedEvents'));
}

    public function reviewEvent($eventId)
    {
        $event = Event::findOrFail($eventId);
        return view('EventApproval.eventReview', compact('event'));
    }

    public function sendReviewEvent(Request $request, $eventId)
    {
        $request->validate([
            'action' => 'required|in:approve,reject',
            'review' => 'required_if:action,reject',
        ]);

        $event = Event::findOrFail($eventId);
        
        $event->update(['status' => $request->action === 'approve' ? 'approved' : 'rejected']);
        
        EventReview::create([
            'event_id' => $eventId,
            'user_id' => auth()->id(),
            'review' => $request->review ?? $request->approval_comment,
        ]);
        
        return redirect()->back()->with('success', 'Event review submitted successfully!');
    }
}
