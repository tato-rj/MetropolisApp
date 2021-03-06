<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use App\Rules\FullName;
use App\Http\Requests\CreditCardForm;

class UsersController extends Controller
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
     * Show the schedule page.
     *
     * @return \Illuminate\Http\Response
     */
    public function schedule()
    {
        return view('pages.user.schedule.index');
    }

    /**
     * Show the profile page.
     *
     * @return \Illuminate\Http\Response
     */
    public function profile()
    {
        $user = auth()->user();

        return view('pages.user.profile.index', compact('user'));
    }

    /**
     * Show the profile page.
     *
     * @return \Illuminate\Http\Response
     */
    public function workshops()
    {
        $workshops = auth()->user()->validWorkshops()->paginate(4);

        return view('pages.user.workshops.index', compact('workshops'));
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
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        return view('admin.pages.users.show.index', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $request->validate([
            'name' => ['required', 'min:4', 'max:255', 'string', new FullName],
            'email' => 'required|email',
            'phone' => 'required',
        ]);

        auth()->user()->update([
            'name' => ucwords($request->name),
            'email' => $request->email,
            'area_code' => phone_fields($request->phone)['code'],
            'phone' => phone_fields($request->phone)['number']
        ]);

        return redirect()->back()->with('status', 'O seu cadastro foi atualizado com sucesso.');
    }

    public function password(Request $request)
    {
        $request->validate(['password' => 'required|string|min:6|confirmed']);

        auth()->user()->update(['password' => bcrypt($request->password)]);

        return redirect()->back()->with('status', 'O seu password foi atualizado com sucesso.');
    }

    public function creditCard(Request $request, CreditCardForm $form)
    {
        auth()->user()->updateCard($form);

        return redirect()->back()->with('status', 'O seu cartão de crédito foi atualizado com sucesso.');
    }

    public function removeCard(Request $request)
    {
        auth()->user()->removeCard();

        return redirect()->back()->with('status', 'O seu cartão de crédito foi removido com sucesso.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        //
    }
}
