<?php

namespace App\Http\Controllers;

use App\{Plan, User, Event, Membership};
use Illuminate\Http\Request;
use App\Http\Requests\{SubscribeForm, CreditCardForm};
use App\Events\MembershipCreated;
use App\Services\PagSeguro\PagSeguro;

class PlansController extends Controller
{
    public function index()
    {
        return view('pages.plans.show.index');
    }
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
    public function subscribe(Request $request, SubscribeForm $form, CreditCardForm $cardForm)
    {
        $pagseguro = new PagSeguro;

        $plan = Plan::find($request->plan_id);

        $user = auth()->user();

        $reference = $pagseguro->generateReference($prefix = 'P', $user);

        $status = $pagseguro->plan($user, $plan, $request)->purchase($reference);

        if ($status instanceof \Exception)
            return redirect()->back()->with('error', $pagseguro->errorMessage($status))->withInput();

        if ($request->save_card)
            auth()->user()->updateCard($cardForm);

        $user->subscribe($plan, $reference);

        event(new MembershipCreated($user));

        return redirect()->route('client.events.index')->with('status', 'A sua assinatura foi realizada com sucesso. Aproveite o seu novo espaço de trabalho!');
    }

    public function toggle(Membership $membership)
    {
        $pagseguro = new PagSeguro;

        $pagseguro->toggle($membership);

        $membership->toggle();

        return redirect()->back()->with('status', 'A sua preferência foi atualizada com sucesso.');        
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
