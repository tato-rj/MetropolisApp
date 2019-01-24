<?php

namespace App\Http\Controllers;

use App\{Plan, User};
use Illuminate\Http\Request;
use App\Http\Requests\SubscribeForm;
use App\Events\MembershipCreated;
use App\Services\PagSeguro;

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
        $pagseguro = new PagSeguro;

        $plan = Plan::find($request->plan_id);

        $user = auth()->user();

        $preApproval = $pagseguro->subscription();
        
        $preApproval->setPlan($plan->code);
        $preApproval->setReference($user->id);
        $preApproval->setSender()->setName($user->name);
        $preApproval->setSender()->setEmail('c38672894586801235492@sandbox.pagseguro.com.br');
        $preApproval->setSender()->setHash($request->card_hash);
        $preApproval->setSender()->setDocuments(
            (new \PagSeguro\Domains\DirectPreApproval\Document)->withParameters('CPF', '09882490735')
        );
        $preApproval->setSender()->setAddress()->withParameters(
            $request->address_street,
            $request->address_number,
            $request->address_district,
            $request->address_zip,
            $request->address_city,
            $request->address_state,
            'BRA'
        );
        $preApproval->setSender()->setPhone()->withParameters('21', '91982736');
        $preApproval->setPaymentMethod()->setCreditCard()->setToken($request->card_token);
        $preApproval->setPaymentMethod()->setCreditCard()->setHolder()->setName($request->card_holder_name);
        $preApproval->setPaymentMethod()->setCreditCard()->setHolder()->setBirthDate('23/06/1984');
        $preApproval->setPaymentMethod()->setCreditCard()->setHolder()->setDocuments(
            (new \PagSeguro\Domains\DirectPreApproval\Document)->withParameters('CPF', '09882490735')
        );
        $preApproval->setPaymentMethod()->setCreditCard()->setHolder()->setPhone()->withParameters('21', '91982736');
        $preApproval->setPaymentMethod()->setCreditCard()->setHolder()->setBillingAddress()->withParameters(
            $request->address_street,
            $request->address_number,
            $request->address_district,
            $request->address_zip,
            $request->address_city,
            $request->address_state,
            'BRA'
        );

        try {
            $response = $preApproval->register($pagseguro->credentials);
        } catch (\Exception $e) {
            dd($e);
        }
        
        User::find($user->id)->subscribe($plan);

        event(new MembershipCreated(auth()->user()));

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
