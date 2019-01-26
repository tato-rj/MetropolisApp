<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\PagSeguro\PagSeguro;
use App\{Event, Membership};

class PagSeguroController extends Controller
{
    public function notification(Request $request)
    {
        try {
            $method = $request->notificationType;

            return $this->$method($request);
        } catch (\Exception $e) {
            return abort(404);
        }
    }

    public function preApproval(Request $request)
    {
        $code = $this->cleanCode($request->notificationCode);

        $url = 'https://ws.sandbox.pagseguro.uol.com.br/v2/pre-approvals/notifications/'.$code.'?email='.pagseguro('email').'&token='.pagseguro('token');

        $response = client()->get($url)->getBody();
        
        $xml = simplexml_load_string($response);

        try {
            Membership::where('reference', $xml->reference)->first()->setStatus($xml->status);

            return $response;
        } catch (\Exception $e) {
            throw new \Exception('Assinatura não encontrada');
        }

        return $xml->reference;
    }

    public function transaction(Request $request)
    {
        $code = $this->cleanCode($request->notificationCode);

        $url = 'https://ws.sandbox.pagseguro.uol.com.br/v2/transactions/notifications/'.$code.'?email='.pagseguro('email').'&token='.pagseguro('token');

        $response = client()->get($url)->getBody();
        
        $xml = simplexml_load_string($response);

        try {

            if ($xml->type == 1) {
                return $this->single($xml);
            } else {
                return $this->recurring($xml);
            }

        } catch (\Exception $e) {
            throw new \Exception('Evento não encontrado');
        }
    }

    public function recurring($xml)
    {
        $newEvent = Event::where('reference', $xml->reference)->whereNull('transaction_code');

        if ($newEvent->exists()) {
            $newEvent->first()->setStatus($xml->status)->setTransactionCode($xml->code);
        } else {
            $event = Event::where('transaction_code', $xml->code);

            if ($event->exists()) {
                $event->first()->setStatus($xml->status);
            } else {
                Membership::where('reference', $xml->reference)->first()->renew($xml);
            }
            
        }

        return $xml;        
    }

    public function single($xml)
    {
        Event::where('reference', $xml->reference)->first()->setStatus($xml->status)->setTransactionCode($xml->code);

        return $xml;
    }

    public function cleanCode($code)
    {
        return preg_replace('/[^[:alnum:]-]/', '', $code);
    }

    public function handle(PagseguroResponse $data)
    {
    	try {
    		return 'GETTING THERE!';
    	} catch (\Exception $e) {
    		logger($e->getMessage());
    	}
    }
}
