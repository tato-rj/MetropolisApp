<?php

namespace App\Http\Controllers;

use App\{Event, Space, User};
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Requests\{SpaceSearchForm, CreateEventForm};

class EventsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('pages.user.schedule.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, CreateEventForm $form)
    {
        $user = User::find($request->creator_id);
        $space = Space::find($request->space_id);

        $starts_at = Carbon::parse($request->date)->setTime($request->time, 0, 0);
        $ends_at = calculateEndingTime($starts_at, $request->duration);

        $user->events()->create([
            'space_id' => $request->space_id,
            'fee' => $space->priceFor($request->participants, $request->duration),
            'participants' => $request->participants,
            'emails' => $request->emails ? serialize($request->emails) : null,
            'starts_at' => $starts_at,
            'ends_at' => $ends_at
        ]);

        return redirect()->route('client.home')->with('status', 'A sua reserva foi confirmada com sucesso.');
    }

    /**
     * Checks if the space is free for booking.
     * 
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function search(Request $request, SpaceSearchForm $form)
    {
        $selectedSpace = Space::where('slug', $request->type)->first();

        $date = Carbon::parse($request->date)->setTime($request->time,0,0);

        $report = $selectedSpace->checkAvailability($date, $request->duration, $request->participants);

        return view("pages.search.results", compact(['report', 'selectedSpace']));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function show(Event $event)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function edit(Event $event)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Event $event)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function destroy(Event $event)
    {
        //
    }
}
