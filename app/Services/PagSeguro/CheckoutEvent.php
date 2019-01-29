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

        $creditCard = new CreditCard();

        $creditCard->setReceiverEmail(pagseguro('email'));
        $creditCard->setReference($reference);
        $creditCard->setCurrency("BRL");
        $creditCard->addItems()->withParameters(
            $reference, $this->request->description, 1, $this->price
        );
        $creditCard->setSender()->setName($this->user->name);
        $creditCard->setSender()->setEmail('c38672894586801235492@sandbox.pagseguro.com.br');
        $creditCard->setSender()->setPhone()->withParameters(21, 91891234);
        $creditCard->setSender()->setDocument()->withParameters('CPF', '09882490735');
        $creditCard->setSender()->setHash($this->request->card_hash);
        $creditCard->setShipping()->setAddress()->withParameters(
            'Avenida Rio Branco', '151', 'Centro', '20040006', 'Rio de Janeiro', 'RJ', 'BRA', 'Grupo 401'
        );
        $creditCard->setBilling()->setAddress()->withParameters(
            'Avenida Rio Branco', '151', 'Centro', '20040006', 'Rio de Janeiro', 'RJ', 'BRA', 'Grupo 401'
        );
        $creditCard->setToken($this->request->card_token);
        $creditCard->setInstallment()->withParameters(1, $this->request->price . '.00');
        $creditCard->setHolder()->setBirthdate('01/10/1979');
        $creditCard->setHolder()->setName($this->request->card_holder_name);
        $creditCard->setHolder()->setPhone()->withParameters(11, 56273440);
        $creditCard->setHolder()->setDocument()->withParameters('CPF', '09882490735');
        $creditCard->setMode('DEFAULT');
        
        try {
            return $creditCard->register($this->pagseguro->credentials);
        } catch (\Exception $error) {
            return $error;
        }
	}

	public function document()
	{
		return new Document;
	}
}
