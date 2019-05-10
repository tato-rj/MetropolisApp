<?php

namespace App\Http\Controllers;

use App\Events\{EventCreated, EventUpdated};
use App\{Event, Space, User};
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Requests\{SpaceSearchForm, CreateEventForm, CreditCardForm};
use Illuminate\Support\Facades\Mail;
use App\Mail\InviteToEvent;
use App\Services\PagSeguro\PagSeguro;

class EventsController extends Controller
{
    /**
     * Show the form for creating a new resource (ADMINS ONLY).
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $spaces = Space::all();

        return view('admin.pages.schedule.create.index', compact('spaces'));
    }

    /**
     * Checks if the space is free for booking (ADMINS ONLY).
     * 
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function search(Request $request, SpaceSearchForm $form)
    {
        $report = $form->space->checkAvailability($form->starts_at, $request->duration, $request->participants);
        
        return view('pages.search.results', compact(['form', 'report']));
    }

    /**
     * Shows the payment form.
     * 
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function payment(Space $space, Request $request, SpaceSearchForm $form)
    {
        $authorization = $form->space->authorize($form);

        if (! $authorization->status)
            return redirect()->back()->with([
                'error' => $authorization->getMessage(),
                'form' => $form]);
        
        $price = $form->space->priceFor($form->participants, $form->duration, $form->user->bonusesLeft($form->space));

        if ($price == 0) {            
            $event = $form->user->schedule($form);

            event(new EventCreated($event));

            return redirect()->route('client.events.index')->with('status', 'A sua reserva foi confirmada com sucesso.');
        }

        $pagseguro = new PagSeguro;
        dd($pagseguro);
        return view('pages.user.checkout.event.index', compact(['form', 'pagseguro']));
    }

    /**
     * Charges the user for the reservation.
     * 
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function purchase(Request $request, SpaceSearchForm $form, CreditCardForm $cardForm)
    {
        $pagseguro = new PagSeguro;
        $scheduledEvent = null;

        if ($request->reference) {
            
            $reference = $request->reference;
            $scheduledEvent = Event::byReference($request->reference)->first();

        } else {
            $authorization = $form->space->authorize($form);
            
            if (! $authorization->status)
                return redirect()->back()->with('error', $authorization->getMessage());

            $reference = $pagseguro->generateReference($prefix = 'E', $form->user);
        }
        
        $price = $form->space->priceFor($form->participants, $form->duration, $form->user->bonusesLeft($form->space));
        
        $status = $pagseguro->event($form->user, $request, $price)->purchase($reference);

        if ($status instanceof \Exception)
            return redirect()->back()->with('error', $pagseguro->errorMessage($status))->withInput();

        if ($request->save_card)
            auth()->user()->updateCard($cardForm);

        if ($scheduledEvent) {
            $scheduledEvent->update(['status_id' => 0]);
            
            $event = $scheduledEvent;
        } else {
            $event = $form->user->schedule($form, $reference);            
        }

        event(new EventCreated($event));
        
        return redirect()->route('client.events.index')->with('status', 'A sua reserva foi confirmada com sucesso.');
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
        $admin = auth()->guard('admin')->user();
        $user = User::find($request->user_id);
        $creator = $user ?? $admin;
        $pagseguro = new PagSeguro;

        $event = Event::create([
            'creator_id' => $creator->id,
            'creator_type' => get_class($creator),
            'reference' => $user ? $pagseguro->generateReference($prefix = 'E', $user) : null,
            'space_id' => $form->space_id,
            'participants' => $form->participants,
            'starts_at' => $form->starts_at,
            'emails' => serialize($form->emails),
            'ends_at' => $form->ends_at,
            'verified_at' => now(),
            'status_id' => $user ? 99 : 3
        ]);

        event(new EventCreated($event, $user));

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

        event(new EventUpdated($event));

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

   public function updateConflict(Event $event)
   {
       $event->setConflict();

       return redirect()->back()->with('status', 'O conflito foi atualizado com sucesso.');
   }

   public function cancel(Event $event)
   {
        $pagseguro = new PagSeguro;
        
        if ($event->payment()->exists()) {
            if ($event->canBeReturned()) {
                $pagseguro->refund($event);
            } else {
                $pagseguro->cancel($event);                
            }
        }

        if ($event->plan()->exists()) {
            $pagseguro->unsubscribe($event->creator->membership);

            $event->creator->unsubscribe();
        } else {
            $event->cancel();
        }
        return redirect()->back()->with('status', 'Este evento foi cancelado com sucesso.');
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
