<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Payment;

class PaymentsController extends Controller
{
    public function index()
    {
    	// return auth()->user()->payments;

        return view('pages.user.payments.index');
    }
}
