<?php

namespace App\Http\Controllers;

use App\{Plan, User};
use Illuminate\Http\Request;
use App\Http\Requests\SubscribeForm;
use App\Events\MembershipCreated;

class PlansController extends Controller
{
    protected $localUrl = 'http://db20ff9d.ngrok.io';

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function confirm(Request $request)
    {
        $plan = Plan::find($request->plan_id);

        return view('pages.plans.subscribe.index', compact('plan'));
    }

    public function payment()
    {
        $xml = client()->post('https://ws.sandbox.pagseguro.uol.com.br/v2/sessions?email='.pagseguro('email').'&token='.pagseguro('token'))->getBody();

        $pagseguroId = json_encode(simplexml_load_string($xml)->id);
        
        $pagseguroId = json_decode($pagseguroId, true)[0];

        $selectedPlan = Plan::find(request()->plan_id);

        return view('pages.user.checkout.plan.index', compact(['pagseguroId', 'selectedPlan']));
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function subscribe(Request $request, SubscribeForm $form)
    {
        $plan = Plan::find($request->plan_id);

        $payload = [
            'plan' => $plan->code,
            'email' => pagseguro('email'),
            'token' => pagseguro('token'),
            'sender.name' => auth()->user()->name,
            // 'sender.email' => 'c38672894586801235492@sandbox.pagseguro.com.br',
            // 'sender.ip' => '255.255.255.255',
            'sender.hash' => $request->card_hash,
            'sender.phone.areaCode' => '21',
            'sender.phone.number' => '91891234',
            // 'sender.address.street' => 'Av. Brig. Faria Lima',
            // 'sender.address.number' => '1384',
            // 'sender.address.complement' => '5o andar',
            // 'sender.address.district' => 'Centro',
            'sender.address.postalCode' => '20040006',
            // 'sender.address.city' => 'Rio de Janeiro',
            // 'sender.address.state' => 'RJ',
            // 'sender.address.country' => 'BRA',
            // 'sender.documents.type' => 'cpf',
            // 'sender.documents.value' => '22111944785',
            // 'paymentMethod.type' => $request->paymentMethod,
            // 'paymentMethod.creditCard.token' => $request->card_token,
            // 'paymentMethod.creditCard.holder.name' => $request->card_holder_name,
            // 'paymentMethod.creditCard.holder.birthDate' => '23/06/1984',
            // 'paymentMode' => 'default',
            // 'bankName' => $request->card_brand,
            // 'receiverEmail' => pagseguro('email'),
            // 'currency' => 'BRL',
            // 'notificationURL' => notificationUrl($this->localUrl),
            // 'reference' => 'testando',
            // 'shippingType' => '3',
            // 'shippingCost' => '0.00',
            // 'installmentQuantity' => '1',
            // 'installmentValue' => $request->price . '.00',
            // 'noInterestInstallmentQuantity' => '2',
            // 'creditCardHolderCPF' => clean($request->card_holder_cpf),
            // 'creditCardHolderAreaCode' => '11',
            // 'creditCardHolderPhone' => '56273440',
            // 'billingAddressStreet' => 'Av. Brig. Faria Lima',
            // 'billingAddressNumber' => '1384',
            // 'billingAddressComplement' => '5o andar',
            // 'billingAddressDistrict' => 'Jardim Paulistano',
            // 'billingAddressPostalCode' => '01452002',
            // 'billingAddressCity' => 'Sao Paulo',
            // 'billingAddressState' => 'SP',
            // 'billingAddressCountry' => 'BRA'
        ];

        try {
            $response = client($isPlan = true)->post('https://ws.sandbox.pagseguro.uol.com.br/pre-approvals', ['form_params' => $payload])->getBody();
        } catch (\Exception $e) {
            dd($e);
            return redirect()->route('client.events.index')
                             ->with('error', 'Não conseguimos realizar o seu pedido. Se o problema persistir, por favor entre em contato com o nosso escritório.');
        }

        return $response;
        
        return $request->all();


        // User::find($request->user_id)->subscribe(Plan::find($request->plan_id));

        // event(new MembershipCreated(auth()->user()));

        return redirect()->route('client.events.index')->with('status', 'A sua assinatura foi realizada com sucesso. Aproveite o seu novo espaço de trabalho!');
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
     * @param  \App\Plan  $plan
     * @return \Illuminate\Http\Response
     */
    public function show(Plan $plan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Plan  $plan
     * @return \Illuminate\Http\Response
     */
    public function edit(Plan $plan)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Plan  $plan
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Plan $plan)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Plan  $plan
     * @return \Illuminate\Http\Response
     */
    public function destroy(Plan $plan)
    {
        //
    }
}
