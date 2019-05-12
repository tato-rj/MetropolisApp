<?php

namespace Tests\Feature;

use Tests\AppTest;

class UserTest extends AppTest
{
	/** @test */
	public function authenticated_users_can_update_their_profile_information()
	{
		$this->signIn();

		$this->post(route('client.profile.update'), [
			'name' => 'New Name',
			'email' => auth()->user()->email,
			'phone' => '(21) 123-123'])->assertSessionHas('status');

		$this->assertEquals(auth()->user()->name, 'New Name');
	}

	/** @test */
	public function authenticated_users_can_update_their_password()
	{
		$this->signIn();

		$oldPass = auth()->user()->password;
		
		$this->expectException('Illuminate\Validation\ValidationException');

		$this->post(route('client.profile.update.password'), [
			'password' => 'newPass',
			'password_confirmation' => 'newPsass'])->assertSessionHas('status');

		$this->post(route('client.profile.update.password'), [
			'password' => 'newPass',
			'password_confirmation' => 'newPass'])->assertSessionHas('status');

		$this->assertNotEquals(auth()->user()->fresh()->password, $oldPass);
	}

	/** @test */
	public function authenticated_users_can_save_their_credit_card_information()
	{
		$this->signIn();

		$this->postCreditCard()->assertSessionHas('status');
	}

	/** @test */
	public function authenticated_users_can_remove_their_credit_card_information()
	{
		$this->signIn();

		$this->postCreditCard()->assertSessionHas('status');

		$this->assertTrue(auth()->user()->hasCard);

		$this->post(route('client.profile.remove.creditCard', auth()->user()->id));

		$this->assertFalse(auth()->user()->fresh()->hasCard);
	}

	/** @test */
	public function users_cannot_update_their_names_with_a_single_word()
	{
		$this->signIn();

		$this->expectException('Illuminate\Validation\ValidationException');

		$this->post(route('client.profile.update'), [
			'name' => 'NoWay',
			'email' => auth()->user()->email,
			'phone' => '(21) 123-123']);
	}

	/** @test */
	public function users_cannot_update_their_emails_with_invalid_data()
	{
		$this->signIn();

		$this->expectException('Illuminate\Validation\ValidationException');

		$this->post(route('client.profile.update'), [
			'name' => 'Good Name',
			'email' => 'nah',
			'phone' => '(21) 123-123']);
	}
}
