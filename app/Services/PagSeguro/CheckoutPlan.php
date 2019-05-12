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
        $preApproval->setSender()->setEmail($this->user->email);
        $preApproval->setSender()->setHash($this->request->card_hash);
        $preApproval->setSender()->setDocuments(
            $this->document()->withParameters('CNPJ', pagseguro('cnpj'))
        );
        $preApproval->setSender()->setAddress()->withParameters(
            $this->request->address_street, 
            $this->request->address_number, 
            $this->request->address_district, 
            clean($this->request->address_zip), 
            $this->request->address_city, 
            $this->request->address_state, 
            'BRA', 
            $this->request->address_complement
        );
        $preApproval->setSender()->setPhone()->withParameters($this->user->area_code, $this->user->phone);
        $preApproval->setPaymentMethod()->setCreditCard()->setToken($this->request->card_token);
        $preApproval->setPaymentMethod()->setCreditCard()->setHolder()->setName($this->request->card_holder_name);
        $preApproval->setPaymentMethod()->setCreditCard()->setHolder()->setBirthDate('01/10/1979');
        $preApproval->setPaymentMethod()->setCreditCard()->setHolder()->setDocuments(
            $this->document()->withParameters($this->request->card_holder_document_type, clean($this->request->card_holder_document_value))
        );
        $preApproval->setPaymentMethod()->setCreditCard()->setHolder()->setPhone()->withParameters(21, 31991377);
        $preApproval->setPaymentMethod()->setCreditCard()->setHolder()->setBillingAddress()->withParameters(
            $this->request->address_street, 
            $this->request->address_number, 
            $this->request->address_district, 
            clean($this->request->address_zip), 
            $this->request->address_city, 
            $this->request->address_state, 
            'BRA', 
            $this->request->address_complement
        );

        try {
            return $preApproval->register($this->pagseguro->credentials);
        } catch (\Exception $error) {
            return $error;
        }
	}

	public function document()
	{
		return new Document;
	}
}
