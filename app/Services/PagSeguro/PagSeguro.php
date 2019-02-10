<?php

namespace App\Services\PagSeguro;

use PagSeguro\Library;
use PagSeguro\Configuration\Configure;
use PagSeguro\Services\Session as PagSeguroSession;
use PagSeguro\Domains\Requests\DirectPreApproval\Plan as PagSeguroPlan;
use App\{User, Plan, Event};
use Illuminate\Http\Request;

class PagSeguro
{
	protected $credentials, $session;

	public function __construct()
	{
        try {
            Library::initialize();
        } catch (\Exception $e) {
            abort(400, $e);
        }

        Library::cmsVersion()->setName('Metropolis')->setRelease('1.0');
        Library::moduleVersion()->setName('Metropolis')->setRelease('1.0');

        Configure::setEnvironment('sandbox');
        Configure::setCharset('UTF-8');
        Configure::setAccountCredentials(pagseguro('email'), pagseguro('token'));
        Configure::setLog(true, storage_path('logs/pagseguro_'. date('Y-m-d') .'.txt'));

        try {
            $this->credentials = \PagSeguro\Configuration\Configure::getAccountCredentials();

            $this->session = PagSeguroSession::create($this->credentials);
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Não foi possível conectar com o PagSeguro.');
        }
	}

    public function status(Event $event)
    {
        return new StatusManager($this, $event);
    }

	public function plan(User $user, Plan $plan, Request $request)
	{
		return new CheckoutPlan($this, $user, $plan, $request);
	}

    public function event(User $user, Request $request, $price)
    {
        return new CheckoutEvent($this, $user, $request, $price);
    }

    public function referenceToModel($reference)
    {
        return substr($reference, 0, 1) == 'W' ? 'App\UserWorkshop' : 'App\Event';
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

    public function generateReference($prefix, User $user)
    {
        return $prefix . '-' . now()->timestamp . $user->id; 
    }

    public function errorMessage(\Exception $error)
    {
        $message = '<strong>Mensagem do PagSeguro</strong> | ';

        if ($error->getCode() == 500)
            return $message . 'O ambiente sandbox está indisponível nesse momento';

        $response = $this->parseResponse($error);

        return $message . ucfirst($response);
    }

    public function parseResponse($error)
    {
        try {
            return simplexml_load_string($error->getMessage())->error->message;
        } catch (\Exception $e) {
            if (json_decode($error->getMessage()))
                return array_values(get_object_vars(json_decode($error->getMessage())->errors))[0];

            return $error->getMessage();   
        }
    }

	public function __get($property) {
		if (property_exists($this, $property)) {
			return $this->$property;
		}
	}
}
