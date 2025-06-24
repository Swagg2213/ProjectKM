<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        
    }

    /**
     * Store a newly created resource in storage.
     */
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

        //dd($validatedData);
        
        $validatedData['image'] = $request->file('image')->store('eventImage','public');
        
        Event::create($validatedData);

        
        return redirect('/home');
    }

    /**
     * Display the specified resource.
     */
    public function show(Event $event)
    {
        $events = DB::table('events')->paginate(5);
        return view('Event.eventView',["events"=>$events]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Event $event)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Event $event)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Event $event)
    {
        //
    }
    public function showDetail(Event $event)
    {

        return view('Event.eventDetail',["event"=>$event]);
    }
}
