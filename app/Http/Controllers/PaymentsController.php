<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Payment;

class PaymentsController extends Controller
{
    public function index()
    {
        return view('pages.user.payments.index');
    }

    public function loadFields()
    {
    	return view('components.form.payment.fields.' . request('fields'))->render();
    }
}
