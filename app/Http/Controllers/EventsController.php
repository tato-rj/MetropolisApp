<?php

namespace App\Http\Controllers;

use App\Events\EventCreated;
use App\{Event, Space, User};
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Requests\{SpaceSearchForm, CreateEventForm};
use Illuminate\Support\Facades\Mail;
use App\Mail\InviteToEvent;

class EventsController extends Controller
{
    protected $localUrl = 'http://db20ff9d.ngrok.io';

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

    // /**
    //  * Store a newly created resource in storage.
    //  *
    //  * @param  \Illuminate\Http\Request  $request
    //  * @return \Illuminate\Http\Response
    //  */
    // public function store(Request $request, CreateEventForm $form)
    // {
    //     $event = $form->user->events()->create([
    //         'space_id' => $form->space_id,
    //         'fee' => $form->space->priceFor($form->participants, $form->duration, $form->user->bonusesLeft($form->space)),
    //         'participants' => $form->participants,
    //         'emails' => serialize($form->emails),
    //         'starts_at' => $form->starts_at,
    //         'ends_at' => $form->ends_at
    //     ]);

    //     $form->user->useBonus($event, $form->duration);

    //     event(new EventCreated($event));

    //     return redirect()->route('client.events.index')->with('status', 'A sua reserva foi confirmada com sucesso.');
    // }

    public function payment()
    {
        $xml = client()->post('https://ws.sandbox.pagseguro.uol.com.br/v2/sessions?email='.pagseguro('email').'&token='.pagseguro('token'))->getBody();

        $pagseguroId = json_encode(simplexml_load_string($xml)->id);
        
        $pagseguroId = json_decode($pagseguroId, true)[0];

        $selectedSpace = Space::find(request()->space_id);

        return view('pages.user.checkout.event.index', compact(['pagseguroId', 'selectedSpace']));
    }

    public function purchase(Request $request, CreateEventForm $form)
    {
        $reference = now()->timestamp . auth()->user()->id;

        $payload = [
            'email' => pagseguro('email'),
            'token' => pagseguro('token'),
            'paymentMode' => 'default',
            'bankName' => $request->card_brand,
            'paymentMethod' => $request->paymentMethod,
            'receiverEmail' => pagseguro('email'),
            'currency' => 'BRL',
            'extraAmount' => '0.00',
            'itemId1' => '1',
            'itemDescription1' => $request->description,
            'itemAmount1' => $request->price . '.00',
            'itemQuantity1' => '1',
            'notificationURL' => notificationUrl($this->localUrl),
            'reference' => $reference,
            'senderName' => auth()->user()->name,
            'senderCPF' => '22111944785',
            'senderAreaCode' => '21',
            'senderPhone' => '91891234',
            'senderEmail' => 'c38672894586801235492@sandbox.pagseguro.com.br',
            'senderHash' => $request->card_hash,
            'shippingAddressStreet' => 'Av. Brig. Faria Lima',
            'shippingAddressNumber' => '1384',
            'shippingAddressComplement' => '5o andar',
            'shippingAddressDistrict' => 'Centro',
            'shippingAddressPostalCode' => '01452002',
            'shippingAddressCity' => 'Rio de Janeiro',
            'shippingAddressState' => 'RJ',
            'shippingAddressCountry' => 'BRA',
            'shippingType' => '3',
            'shippingCost' => '0.00',
            'creditCardToken' => $request->card_token,
            'installmentQuantity' => '1',
            'installmentValue' => $request->price . '.00',
            'noInterestInstallmentQuantity' => '2',
            'creditCardHolderName' => $request->card_holder_name,
            'creditCardHolderCPF' => clean($request->card_holder_cpf),
            'creditCardHolderBirthDate' => '01/01/1001',
            'creditCardHolderAreaCode' => '11',
            'creditCardHolderPhone' => '56273440',
            'billingAddressStreet' => 'Av. Brig. Faria Lima',
            'billingAddressNumber' => '1384',
            'billingAddressComplement' => '5o andar',
            'billingAddressDistrict' => 'Jardim Paulistano',
            'billingAddressPostalCode' => '01452002',
            'billingAddressCity' => 'Sao Paulo',
            'billingAddressState' => 'SP',
            'billingAddressCountry' => 'BRA'
        ];

        try {
            $response = client()->post('https://ws.sandbox.pagseguro.uol.com.br/v2/transactions', ['form_params' => $payload])->getBody();
        } catch (\Exception $e) {
            return redirect()->route('client.events.index')
                             ->with('error', 'Não conseguimos realizar o seu pedido. Se o problema persistir, por favor entre em contato com o nosso escritório.');
        }

        $event = $form->user->events()->create([
            'reference' => $reference,
            'space_id' => $form->space_id,
            'fee' => $form->space->priceFor($form->participants, $form->duration, $form->user->bonusesLeft($form->space)),
            'participants' => $form->participants,
            'emails' => serialize($form->emails),
            'starts_at' => $form->starts_at,
            'ends_at' => $form->ends_at
        ]);

        $form->user->useBonus($event, $form->duration);

        event(new EventCreated($event));

        return redirect()->route('client.events.index')->with('status', 'A sua reserva foi confirmada com sucesso.');
    }

    public function notification(Request $request)
    {        
        try {
            $notification = client()->get(
                'https://ws.sandbox.pagseguro.uol.com.br/v3/transactions/notifications/'.$request->notificationCode.'?email='.pagseguro('email').'&token='.pagseguro('token')
            )->getBody();
        } catch (\Exception $e) {
            return $e;
        }
        
        $response = simplexml_load_string($notification);

        Event::where('reference', $response->reference)->update([
            'status_id' => $response->status,
            'notified_at' => now()]);

        return response('Status atualizado', 200);
    }

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

    public function ajax(Request $request)
    {
        $event = Event::find($request->event_id);

        if ($event->plan()->exists())
            return view('components.modals.results.recurring', compact('event'))->render();
    
        return view('components.modals.results.standalone', compact('event'))->render();
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
        $event->update([$request->field => $request->emails]);

        return view('components.alerts.success', ['message' => 'O evento foi atualizado com sucesso.'])->render();
   }

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
