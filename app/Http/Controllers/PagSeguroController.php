<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Space;
use GuzzleHttp\Client;
use App\Http\Requests\CreateEventForm;
use App\Events\EventCreated;

class PagSeguroController extends Controller
{
	protected $client;

	public function __construct()
	{
		$this->client = new Client([
            'headers' => ['Content-Type' => 'application/x-www-form-urlencoded; charset=UTF-8']
        ]);
	}

    public function payment(Request $request)
    {
        $xml = $this->client->post('https://ws.sandbox.pagseguro.uol.com.br/v2/sessions?email='.pagseguro('email').'&token='.pagseguro('token'))->getBody();

        $pagseguroId = json_encode(simplexml_load_string($xml)->id);
        
        $pagseguroId = json_decode($pagseguroId, true)[0];

        $selectedSpace = Space::find($request->space_id);

        return view('pages.user.checkout.index', compact(['pagseguroId', 'selectedSpace']));
    }

    public function purchase(Request $request, CreateEventForm $form)
    {
        $payload = [
            'email' => pagseguro('email'),
            'token' => pagseguro('token'),
            'paymentMode' => 'default',
            'paymentMethod' => $request->paymentMethod,
            'receiverEmail' => pagseguro('email'),
            'currency' => 'BRL',
            'extraAmount' => '0.00',
            'itemId1' => '1',
            'itemDescription1' => $request->description,
            'itemAmount1' => $request->price . '.00',
            'itemQuantity1' => '1',
            'notificationURL' => 'https://www.metropolis.com/pagseguro/notification',
            'reference' => '1',
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
            'creditCardHolderCPF' => $request->card_holder_cpf,
            'creditCardHolderBirthDate' => '01/01/1001',
            'creditCardHolderAreaCode' => '11',
            'creditCardHolderPhone' => '56273440',
            'billingAddressStreet' => $request->address_street,
            'billingAddressNumber' => $request->address_number,
            'billingAddressComplement' => $request->address_complement,
            'billingAddressDistrict' => $request->address_district,
            'billingAddressPostalCode' => $request->address_zip,
            'billingAddressCity' => $request->address_city,
            'billingAddressState' => $request->address_state,
            'billingAddressCountry' => 'BRA'
        ];

        try {
            $response = $this->client->post('https://ws.sandbox.pagseguro.uol.com.br/v2/transactions', ['form_params' => $payload])->getBody();
        } catch (\Exception $e) {
            return redirect()->route('client.events.index')->with('error', 'Não conseguimos realizar o seu pedido. Se o problema persistir, por favor entre em contato com o nosso escritório.');
        }

        $event = $form->user->events()->create([
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
}