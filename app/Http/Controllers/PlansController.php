<?php

namespace App\Http\Controllers;

use App\{Plan, User};
use Illuminate\Http\Request;
use App\Http\Requests\SubscribeForm;
use App\Events\MembershipCreated;
use App\Services\PagSeguro\PagSeguro;

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
        $pagseguro = new PagSeguro;

        $plan = Plan::find(request()->plan_id);

        return view('pages.user.checkout.plan.index', compact(['pagseguro', 'plan']));
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

        $reference = $pagseguro->generateReference($user, 'PLANO');

        $status = $pagseguro->plan($user, $plan, $request)->purchase($reference);

        if (! $status)
            return redirect()->back()->with('error', 'Não foi possível realizar o seu pedido nesse momento, por favor tente mais tarde.');
        
        $user->subscribe($plan, $reference);

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
