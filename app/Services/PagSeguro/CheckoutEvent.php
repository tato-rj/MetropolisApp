<?php

namespace App\Services\PagSeguro;

use App\{User, Plan};
use Illuminate\Http\Request;
use PagSeguro\Domains\Requests\DirectPayment\CreditCard;
use PagSeguro\Domains\DirectPreApproval\Document;
use App\Services\PagSeguro\Contracts\Checkout;

class CheckoutEvent implements Checkout
{
	protected $user, $request, $pagseguro, $price;

	public function __construct(PagSeguro $pagseguro, User $user, Request $request, $price)
	{
		$this->user = $user;
		$this->request = $request;
		$this->pagseguro = $pagseguro;
        $this->price = $price . '.00';
	}

	public function purchase($reference)
	{
        if (app()->environment() == 'testing')
            return true;

        $method = $this->request->paymentMethod;

        $purchase = $this->$method($reference);
        dd($purchase);
        try {
            return $purchase->register($this->pagseguro->credentials);
        } catch (\Exception $error) {
            return $error;
        }
	}

    public function eft($reference)
    {
        $onlineDebit = new \PagSeguro\Domains\Requests\DirectPayment\OnlineDebit();

        $onlineDebit->setMode('DEFAULT');
        $onlineDebit->setReceiverEmail(pagseguro('email'));
        $onlineDebit->setCurrency("BRL");
        $onlineDebit->addItems()->withParameters(
            $reference, $this->request->description, 1, $this->price
        );
        $onlineDebit->setReference($reference);
        $onlineDebit->setExtraAmount('0.00');
        $onlineDebit->setSender()->setName($this->user->name);
        $onlineDebit->setSender()->setEmail($this->user->email);
        $onlineDebit->setSender()->setPhone()->withParameters($this->user->area_code, $this->user->phone);
        $onlineDebit->setSender()->setDocument()->withParameters($this->request->card_holder_document_type, $this->request->card_holder_document_value);
        $onlineDebit->setSender()->setHash($this->request->card_hash);
        $onlineDebit->setShipping()->setShipping()->setAddress()->withParameters(
            'Rua Santa Clara', 
            '5', 
            'Copacabana', 
            '22041011', 
            'Rio de Janeiro', 
            'RJ', 
            'BRA', 
            ''
        );
        $onlineDebit->setShipping()->setAddressRequired()->withParameters('FALSE');
        $onlineDebit->setBankName($this->request->bank_name);

        return $onlineDebit;
    }

    public function creditCard($reference)
    {
        $creditCard = new CreditCard();

        $creditCard->setReceiverEmail(pagseguro('email'));
        $creditCard->setReference($reference);
        $creditCard->setCurrency("BRL");
        $creditCard->addItems()->withParameters(
            $reference, $this->request->description, 1, $this->price
        );
        $creditCard->setSender()->setName($this->user->name);
        $creditCard->setSender()->setEmail($this->user->email);
        $creditCard->setSender()->setPhone()->withParameters($this->user->area_code, $this->user->phone);
        $creditCard->setSender()->setDocument()->withParameters($this->request->card_holder_document_type, $this->request->card_holder_document_value);
        $creditCard->setSender()->setHash($this->request->card_hash);
        $creditCard->setShipping()->setAddress()->withParameters(
            $this->request->address_street, 
            $this->request->address_number, 
            $this->request->address_district, 
            clean($this->request->address_zip), 
            $this->request->address_city, 
            $this->request->address_state, 
            'BRA', 
            $this->request->address_complement
        );
        $creditCard->setBilling()->setAddress()->withParameters(
            $this->request->address_street, 
            $this->request->address_number, 
            $this->request->address_district, 
            clean($this->request->address_zip), 
            $this->request->address_city, 
            $this->request->address_state, 
            'BRA', 
            $this->request->address_complement
        );
        $creditCard->setToken($this->request->card_token);
        $creditCard->setInstallment()->withParameters(1, $this->price);
        $creditCard->setHolder()->setBirthdate('01/10/1979');
        $creditCard->setHolder()->setName($this->request->card_holder_name);
        $creditCard->setHolder()->setPhone()->withParameters($this->user->area_code, $this->user->phone);
        $creditCard->setHolder()->setDocument()->withParameters($this->request->card_holder_document_type, clean($this->request->card_holder_document_value));
        $creditCard->setMode('DEFAULT');

        return $creditCard;
    }

	public function document($type, $value)
	{
		return new \PagSeguro\Domains\Document($type, $value);
	}
}
