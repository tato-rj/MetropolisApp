<?php

namespace App\Http\Controllers;

use App\{Plan, User};
use Illuminate\Http\Request;
use App\Http\Requests\SubscribeForm;
use App\Events\MembershipCreated;
use App\Services\PagSeguro\PagSeguro;
use App\Services\PagSeguro\PagSeguro\Checkout;

class PlansController extends Controller
{
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

        $pagseguro->subscription($user, $plan, $request)->purchase();
        
        $user->subscribe($plan);

        event(new MembershipCreated($user));

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
