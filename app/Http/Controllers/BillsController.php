<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\CreateBillForm;
use App\Services\PagSeguro\PagSeguro;
use App\Bill;
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
				'name' => $form->name,
				'email' => $form->email,
				'title' => $form->title,
				'description' => $form->description,
				'fee' => $form->fee,
				'reference' => $reference
			]);
		}

        event(new BillCreated($bill));

		return redirect()->back()->with('status', 'A cobrança foi enviada para ' . $form->email);
	}
}
