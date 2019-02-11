<?php

namespace App\Http\Controllers;

use App\Events\EventCreated;
use App\{Event, Space, User};
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Requests\{SpaceSearchForm, CreateEventForm, CreditCardForm, AdminCreateEventForm};
use Illuminate\Support\Facades\Mail;
use App\Mail\InviteToEvent;
use App\Services\PagSeguro\PagSeguro;

class EventsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $spaces = Space::all();
     
        return view('admin.pages.schedule.create.index', compact('space'));
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
     * Shows the payment form.
     * 
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function payment(Space $space, Request $request, CreateEventForm $form)
    {
        $price = $form->space->priceFor($request->participants, $request->duration, $form->user->bonusesLeft($form->space));

        if ($price == 0) {            
            $event = $form->user->schedule($form);

            event(new EventCreated($event));

            return redirect()->route('client.events.index')->with('status', 'A sua reserva foi confirmada com sucesso.');
        }

        $pagseguro = new PagSeguro;

        $space = $form->space;

        return view('pages.user.checkout.event.index', compact(['space', 'pagseguro']));
    }

    /**
     * Charges the user for the reservation.
     * 
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function purchase(Request $request, CreateEventForm $form, CreditCardForm $cardForm)
    {
        $pagseguro = new PagSeguro;

        $price = $form->space->priceFor($request->participants, $request->duration, $form->user->bonusesLeft($form->space));

        $reference = $pagseguro->generateReference($prefix = 'E', $form->user);

        $status = $pagseguro->event($form->user, $request, $price)->purchase($reference);
        
        if ($status instanceof \Exception)
            return redirect()->back()->with('error', $pagseguro->errorMessage($status))->withInput();

        if ($request->save_card)
            auth()->user()->updateCard($cardForm);

        $event = $form->user->schedule($form, $reference);

        event(new EventCreated($event));

        return redirect()->route('client.events.index')->with('status', 'A sua reserva foi confirmada com sucesso.');
    }

    /**
     * Checks the status of a current reservation.
     * 
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function status(Event $event, Request $request)
    {
        $pagseguro = new PagSeguro;

        $status = $pagseguro->status($event)->checkEvent([
            'initial_date' => null,
            'final_date' => null,
            'page' => 1,
            'max_per_page' => 5,
        ]);

        if (! $status)
            abort(404);

        $event->setStatus($status->getTransactions()[0]->getStatus());

        return $event;
    }

    /**
     * Invites the participants.
     * 
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function invite(Request $request)
    {
        $event = Event::find($request->event_id);

        foreach ($event->emails as $email) {
            if ($email) Mail::to($email)->send(new InviteToEvent($event));
        }

        return redirect()->back()->with('status', 'Os convites foram re-enviados com sucesso.');
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
     * Returns the view with details about an event.
     * 
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function ajax(Request $request)
    {
        $user_type = $request->user_type;
        $event = Event::find($request->event_id);

        if ($event->plan()->exists())
            return view('components.modals.results.recurring', compact(['event', 'user_type']))->render();
    
        return view('components.modals.results.standalone', compact(['event', 'user_type']))->render();
    }

    /**
     * Saves a new event.
     * 
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, CreateEventForm $form)
    {
        $event = auth()->guard('admin')->user()->events()->create([
            'space_id' => $form->space_id,
            'participants' => $form->participants,
            'starts_at' => $form->starts_at,
            'emails' => serialize($form->emails),
            'ends_at' => $form->ends_at,
            'verified_at' => now(),
            'status_id' => 3
        ]);

        event(new EventCreated($event));

        return redirect()->route('admin.schedule.index')->with('status', 'A reserva na ' . $event->space->name . ' foi criada com sucesso.');
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
    public function updateDatetime(Request $request)
    {
        $event = Event::findOrFail($request->event_id);

        try {

            $event->update([
                'starts_at' => carbon($request->starts_at),
                'ends_at' => carbon($request->ends_at)]);       

        } catch (\Exception $e) {

            return view('components.alerts.error', ['message' => 'Não foi possível atualizar o evento nesse momento.'])->render();
        
        }

        return view('components.alerts.success', ['message' => 'O evento foi atualizado com sucesso.'])->render();
   }

    /**
     * Update the emails of participants.
     * 
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function updateEmails(Request $request, Event $event)
    {
        $event->update([$request->field => serialize(json_decode($request->emails))]);

        return view('components.alerts.success', ['message' => 'O email foi atualizado com sucesso.'])->render();
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
