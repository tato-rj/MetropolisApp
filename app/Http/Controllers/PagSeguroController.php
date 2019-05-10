<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\PagSeguro\PagSeguro;
use App\{Event, Membership, Payment};

class PagSeguroController extends Controller
{
    protected $baseurl;

    public function __construct()
    {
        $this->baseurl = (pagseguro('env') == 'sandbox') ? 'https://ws.sandbox.pagseguro.uol.com.br' : 'https://ws.pagseguro.uol.com.br';
    }

    public function status(Request $request)
    {
        $pagseguro = new PagSeguro;

        try {
            $response = \PagSeguro\Services\Transactions\Search\Reference::search(
                /** @var \PagSeguro\Domains\AccountCredentials | \PagSeguro\Domains\ApplicationCredentials $credential */
                $pagseguro->credentials,
                $request->reference,
                [
                    'initial_date' => "2019-05-09T15:17",
                    'final_date' => "2019-05-10T15:17",
                    'page' => 1,
                    'max_per_page' => 10,
                ]
            );
        } catch (\Exception $e) {
            die('arg');
        }

        return $response;
    }

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

        $url = $this->baseurl . '/v2/pre-approvals/notifications/'.$code.'?email='.pagseguro('email').'&token='.pagseguro('token');

        $response = client()->get($url)->getBody();
        
        $xml = simplexml_load_string($response);

        try {
            $membership = Membership::where('reference', $xml->reference)->first();
            $membership->setStatus($xml->status);
            $membership->setTransactionCode($xml->code);

            return $response;
        } catch (\Exception $e) {
            throw new \Exception('Assinatura não encontrada');
        }

        return $xml->reference;
    }

    public function transaction(Request $request)
    {
        if (testing()) {
            $response = $request->xml;
        } else {
            $code = $this->cleanCode($request->notificationCode);

            $url = $this->baseurl . '/v2/transactions/notifications/'.$code.'?email='.pagseguro('email').'&token='.pagseguro('token');

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
}
