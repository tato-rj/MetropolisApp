<?php

namespace App\Services;

use PagSeguro\Library;
use PagSeguro\Configuration\Configure;
use PagSeguro\Services\Session as PagSeguroSession;
use PagSeguro\Domains\Requests\DirectPreApproval\Accession;
use PagSeguro\Domains\Requests\DirectPreApproval\Plan as PagSeguroPlan;

class PagSeguro
{
	protected $credentials;

	public function __construct()
	{
        try {
            Library::initialize();
        } catch (\Exception $e) {
            dd($e);
        }

        Library::cmsVersion()->setName('Metropolis')->setRelease('1.0');
        Library::moduleVersion()->setName('Metropolis')->setRelease('1.0');

        Configure::setEnvironment('sandbox');
        Configure::setAccountCredentials(pagseguro('email'), pagseguro('token'));

        try {
            $this->credentials = \PagSeguro\Configuration\Configure::getAccountCredentials();

            PagSeguroSession::create($this->credentials);
        } catch (\Exception $e) {
            dd($e->getMessage());
        }
	}

	public function subscription()
	{
		return new Accession();
	}

	public function createPlan($selectedPlan)
	{
        $plan = new PagSeguroPlan();
        $plan->setReference($selectedPlan->id);
        $plan->setReceiver()->withParameters(pagseguro('email'));
        $plan->setPreApproval()->setName($selectedPlan->displayName);
        $plan->setPreApproval()->setCharge('AUTO');
        $plan->setPreApproval()->setPeriod($selectedPlan->typeEn);
        $plan->setPreApproval()->setAmountPerPayment($selectedPlan->formattedFee);
        
        try {
            $response = $plan->register($this->credentials);
            dd($response);
        } catch (\Exception $e) {
            dd($e->getMessage());
        }
	}

	public function __get($property) {
		if (property_exists($this, $property)) {
			return $this->$property;
		}
	}
}
