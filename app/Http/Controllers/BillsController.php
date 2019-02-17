<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\CreateBillForm;
use App\Services\PagSeguro\PagSeguro;
use App\Bill;
use App\Http\Requests\BillPaymentForm;
use App\Events\BillCreated;

class BillsController extends Controller
{
	public function pending()
	{
        $pendingBills = Bill::whereNull('verified_at')->get();

        return view('admin.pages.bills.pending', compact('pendingBills'));		
	}

    public function create()
    {
        return view('admin.pages.bills.create'); 
    }

	public function store(Request $request, CreateBillForm $form)
	{
        $pagseguro = new PagSeguro;

		$reference = $pagseguro->generateReference($prefix = 'B', auth()->guard('admin')->user());

		$bill = Bill::find($request->id);

		if (! $bill) {
			$bill = Bill::create([
				'creator_id' => auth()->guard('admin')->user()->id,
				'recipient_name' => $form->recipient_name,
				'recipient_email' => $form->recipient_email,
				'name' => $form->name,
				'description' => $form->description,
				'fee' => $form->fee,
				'reference' => $reference
			]);
		}

        event(new BillCreated($bill));

		return redirect()->back()->with('status', 'A cobrança foi enviada para ' . $form->recipient_email);
	}

	public function purchase(Request $request, BillPaymentForm $form)
	{
        $pagseguro = new PagSeguro;
		
		$status = $pagseguro->event($form->user, $request, $form->bill->fee)->purchase($form->bill->reference);

        if ($status instanceof \Exception)
            return redirect()->back()->with('error', $pagseguro->errorMessage($status))->withInput();

        if ($request->save_card)
            auth()->user()->updateCard($cardForm);

        return redirect()->route('client.home')->with('status', 'O seu pagamento foi realizado com sucesso.');
	}
}
