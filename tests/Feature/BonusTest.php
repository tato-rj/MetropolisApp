<?php

namespace Tests\Feature;

use Tests\AppTest;
use App\{Space, Plan, Event, Bonus};
use Tests\Traits\Checkout;

class BonusTest extends AppTest
{
    use Checkout;

	/** @test */
	public function it_automatically_applies_to_users_with_a_plan()
	{
		$this->signIn();

        $plan = create(Plan::class, ['bonus_spaces' => $this->conference->id]);

		$this->subscribeToNewPlan($plan);

        $data = array_merge([
            'type' => $this->conference->slug,
            'participants' => 1,
            'guests' => null,
            'date' => now(),
            'time' => now()->hour  . ':0',
            'duration' => 1
        ], $this->cardFields);

        $this->post(route('client.events.purchase'), $data);
        
        $this->assertDatabaseHas('bonuses', [
        	'user_id' => auth()->user()->id,
        	'event_id' => auth()->user()->events->last()->id,
        	'plan_id' => $plan->id
        ]);
	}

    /** @test */
    public function the_memberships_number_of_available_bonuses_reset_when_the_membership_renews()
    {
        $request = $this->fakeEvent('recurring', Event::class, 'paga');
        
        $event = Event::byReference('E-REFERENCE')->first();
        
        $user = $event->creator;

        $this->post(route('pagseguro.event.notification', [
            'notificationType' => 'transaction',
            'xml' => $request['notification']]));

        $originalBonusCount = $user->bonusesLeft();

        $bonus = create('App\Bonus', ['duration' => 1]);

        $user->bonuses()->save($bonus);

        $this->assertEquals($originalBonusCount - 1, $user->fresh()->bonusesLeft());

        $firstRenew = $this->fakeNotification('recurring', 'paga');

        $this->post(route('pagseguro.event.notification', [
            'notificationType' => 'transaction',
            'xml' => $firstRenew->xml($ref = null, $code = '123456')]));

        $this->assertEquals($originalBonusCount, $user->fresh()->bonusesLeft());
    }
}
