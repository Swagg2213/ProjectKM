<?php

namespace App\Http\Controllers;

use App\Models\EventReview;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NotificationController extends Controller
{

    public function index()
    {
        $user = Auth::user();

        EventReview::whereHas('event', function ($query) use ($user) {
            $query->where('user_id', $user->id);
        })->whereNull('read_at')->update(['read_at' => now()]);

        $reviews = EventReview::whereHas('event', function ($query) use ($user) {
            $query->where('user_id', $user->id);
        })
        ->with('event')
        ->latest()
        ->paginate(10);

        return view('notifications.index', compact('reviews'));
    }
}