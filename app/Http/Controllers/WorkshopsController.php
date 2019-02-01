<?php

namespace App\Http\Controllers;

use App\{Workshop, UserWorkshop};
use Illuminate\Http\Request;
use App\Events\WorkshopSignup;
use App\Services\PagSeguro\PagSeguro;

class WorkshopsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $workshops = Workshop::upcoming()->filtered()->ordered()->paginate(4);

        return view('pages.workshops.index', compact('workshops'));
    }
    
    public function payment(Workshop $workshop)
    {
        if ($workshop->isFree) {
            auth()->user()->signup($workshop);

            event(new WorkshopSignup($workshop));

            return redirect()->route('client.events.index')->with('status', 'A sua reserva foi confirmada com sucesso.');
        }

        $pagseguro = new PagSeguro;

        return view('pages.user.checkout.workshop.index', compact(['workshop', 'pagseguro']));
    }

    public function purchase(Workshop $workshop, Request $request)
    {
        $pagseguro = new PagSeguro;

        $user = auth()->user();

        $reference = $pagseguro->generateReference($prefix = 'W', $user);

        $status = $pagseguro->event($user, $request, $workshop->fee)->purchase($reference);
        
        if ($status instanceof \Exception)
            return redirect()->back()->with('error', $pagseguro->errorMessage($status));

        $user->signup($workshop, $reference);

        event(new WorkshopSignup($workshop));

        return redirect()->route('client.events.index')->with('status', 'A sua reserva foi confirmada com sucesso.');
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
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Workshop  $workshop
     * @return \Illuminate\Http\Response
     */
    public function show(Workshop $workshop)
    {
        return view('pages.workshops.show.index', compact('workshop'));
    }

    public function ajax(Workshop $workshop)
    {
        $reservation = auth()->user()->workshops()->find($workshop->id)->reservation;

        return view('components.modals.workshop', compact('reservation'))->render();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Workshop  $workshop
     * @return \Illuminate\Http\Response
     */
    public function edit(Workshop $workshop)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Workshop  $workshop
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Workshop $workshop)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Workshop  $workshop
     * @return \Illuminate\Http\Response
     */
    public function destroy(Workshop $workshop)
    {
        //
    }
}
