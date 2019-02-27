<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\PagSeguro\PagSeguro;
use App\{Event, Membership, Payment};

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
        if (app()->environment() == 'testing') {
            $response = $request->xml;
        } else {
            $code = $this->cleanCode($request->notificationCode);

            $url = 'https://ws.sandbox.pagseguro.uol.com.br/v2/transactions/notifications/'.$code.'?email='.pagseguro('email').'&token='.pagseguro('token');

            $response = client()->get($url)->getBody();
        }

        $xml = simplexml_load_string($response);

        try {

            if ($xml->type == 1) {
                $event = $this->single($xml);
            } else {
                $event = $this->recurring($xml);
            }

            Payment::record($event);

            return $response;

        } catch (\Exception $e) {
            throw new \Exception('Evento não encontrado');
        }
    }

    public function single($xml)
    {
        $model = (new PagSeguro)->referenceToModel($xml->reference);

        $event = $model::where('reference', $xml->reference)->first();

        $event->setStatus($xml->status)->setTransactionCode($xml->code);

        return $event;
    }

    public function recurring($xml)
    {
        $newEvent = Event::byReference($xml->reference)->whereNull('transaction_code');

        if ($newEvent->exists()) {
            $newEvent->first()->setStatus($xml->status)->setTransactionCode($xml->code);
        } else {
            $existingEvent = Event::byCode($xml->code);

            if ($existingEvent->exists()) {
                $existingEvent->first()->setStatus($xml->status);
            } else {
                if (! in_array($xml->status, [5,6,7]))
                    Membership::byReference($xml->reference)->first()->renew($xml);
            }
        }

        return Event::byCode($xml->code)->first();
    }

    public function cleanCode($code)
    {
        return preg_replace('/[^[:alnum:]-]/', '', $code);
    }

    public function status($transaction_code)
    {
        $pagseguro = new PagSeguro;

        $payment = Payment::byCode($transaction_code)->firstOrFail();

        if (! auth()->guard('admin')->check())
            $this->authorize('view', $payment);

        if (app()->environment() != 'testing')
            $pagseguro->status($payment)->get();

        return view('components.modals.results.payment', compact('payment'))->render();
    }
}
