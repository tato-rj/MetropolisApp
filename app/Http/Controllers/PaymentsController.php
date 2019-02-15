<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\ShowPaymentForm;
use App\Services\PagSeguro\PagSeguro;
use App\{Payment, Event};

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

    public function create(Request $request, ShowPaymentForm $form)
    {
        $pagseguro = new PagSeguro;

        return view('pages.user.checkout.event.index', compact(['form', 'pagseguro']));
    }
}
