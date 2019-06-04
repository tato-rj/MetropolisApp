<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Mail\{ConfirmContact, SendContact};

class HomeController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('pages.user.home.index');
    }

    public function email(Request $request)
    {
    	\Mail::to(config('mail.from.address'))->send(new SendContact($request->all()));
    	\Mail::to($request->email)->send(new ConfirmContact($request->all()));

    	return redirect()->back()->with('status', 'A sua mensagem foi enviada com sucesso! Entraremos em contato o mais rápido possível.');
    }
}
