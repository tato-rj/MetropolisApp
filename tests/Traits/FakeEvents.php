<?php

namespace Tests\Traits;

trait FakeEvents
{
    protected $cardFields =  [
        'card_holder_name' => 'John Doe',
        'card_number' => '4111111111111111',
        'card_brand' => 'VISA',
        'cvv' => '123',
        'expiry_month' => '12',
        'expiry_year' => '2030',
        'card_holder_document_type' => 'CPF',
        'card_holder_document_value' => '111.111.111-11',
        'address_zip' => '20-040-006',
        'address_street' => 'Avenida Rio Branco',
        'address_number' => '151',
        'address_complement' => null,
        'address_district' => 'Centro',
        'address_city' => 'Rio de Janeiro',
        'address_state' => 'RJ'];

    protected function signIn($user = null)
    {
    	$user = ($user) ?: create('App\User');
    	return $this->actingAs($user);
    }

    public function createNewEvent($user = null, $saveCard = null)
    {
        $user = $user ?? auth()->user();

        $data = array_merge([
            'space_id' => $this->space->id,
            'participants' => 1,
            'guests' => null,
            'date' => now(),
            'time' => now()->hour,
            'duration' => 2,
            'save_card' => $saveCard
        ], $this->cardFields);

        return $this->post(route('client.events.purchase'), $data);
    }

    public function signUpToNewWorkshop($workshop, $user = null, $saveCard = null)
    {
        $user = $user ?? auth()->user();

        $data = array_merge(['save_card' => $saveCard], $this->cardFields);

        return $this->post(route('workshops.purchase', $workshop->slug), $data);
    }

    public function subscribeToNewPlan($plan, $user = null, $saveCard = null)
    {
        $user = $user ?? auth()->user();

        $data = array_merge(['plan_id' => $plan->id, 'save_card' => $saveCard], $this->cardFields);

        return $this->post(route('plan.subscribe'), $data);
    }

    public function postCreditCard()
    {
        return $this->post(route('client.profile.update.creditCard'), [
            'card_holder_name' => 'John Doe',
            'card_number' => '4111111111111111',
            'card_brand' => 'VISA',
            'cvv' => '123',
            'expiry_month' => '12',
            'expiry_year' => '2030',
            'card_holder_document_type' => 'CPF',
            'card_holder_document_value' => '111.111.111-11',
            'address_zip' => '20-040-006',
            'address_street' => 'Avenida Rio Branco',
            'address_number' => '151',
            'address_complement' => null,
            'address_district' => 'Centro',
            'address_city' => 'Rio de Janeiro',
            'address_state' => 'RJ'
        ]);
    }
}