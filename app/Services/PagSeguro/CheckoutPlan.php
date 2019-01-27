<?php

namespace App\Services\PagSeguro;

use App\{User, Plan};
use Illuminate\Http\Request;
use PagSeguro\Domains\Requests\DirectPreApproval\Accession;
use PagSeguro\Domains\DirectPreApproval\Document;
use App\Services\PagSeguro\Contracts\Checkout;

class CheckoutPlan implements Checkout
{
	protected $user, $plan, $request, $pagseguro;

	public function __construct(PagSeguro $pagseguro, User $user, Plan $plan, Request $request)
	{
		$this->user = $user;
		$this->plan = $plan;
		$this->request = $request;
		$this->pagseguro = $pagseguro;
	}

	public function purchase($reference)
	{
        if (app()->environment() == 'testing')
            return true;

        $preApproval = new Accession();
        
        $preApproval->setPlan($this->plan->code);
        $preApproval->setReference($reference);
        $preApproval->setSender()->setName($this->user->name);
        $preApproval->setSender()->setEmail('c38672894586801235492@sandbox.pagseguro.com.br');
        $preApproval->setSender()->setHash($this->request->card_hash);
        $preApproval->setSender()->setDocuments(
            $this->document()->withParameters('CPF', '09882490735')
        );
        $preApproval->setSender()->setAddress()->withParameters(
            $this->request->address_street,
            $this->request->address_number,
            $this->request->address_district,
            $this->request->address_zip,
            $this->request->address_city,
            $this->request->address_state,
            'BRA'
        );
        $preApproval->setSender()->setPhone()->withParameters('21', '91982736');
        $preApproval->setPaymentMethod()->setCreditCard()->setToken($this->request->card_token);
        $preApproval->setPaymentMethod()->setCreditCard()->setHolder()->setName($this->request->card_holder_name);
        $preApproval->setPaymentMethod()->setCreditCard()->setHolder()->setBirthDate('23/06/1984');
        $preApproval->setPaymentMethod()->setCreditCard()->setHolder()->setDocuments(
            $this->document()->withParameters('CPF', '09882490735')
        );
        $preApproval->setPaymentMethod()->setCreditCard()->setHolder()->setPhone()->withParameters('21', '91982736');
        $preApproval->setPaymentMethod()->setCreditCard()->setHolder()->setBillingAddress()->withParameters(
            $this->request->address_street,
            $this->request->address_number,
            $this->request->address_district,
            $this->request->address_zip,
            $this->request->address_city,
            $this->request->address_state,
            'BRA'
        );

        try {
            return $preApproval->register($this->pagseguro->credentials);
        } catch (\Exception $e) {
            if ($e->getCode() == 500)
                return null;
            
            dd($e);
        }
	}

	public function document()
	{
		return new Document;
	}
}
