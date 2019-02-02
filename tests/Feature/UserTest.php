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
			'name' => 'New name',
			'email' => auth()->user()->email])->assertSessionHas('status');

		$this->assertEquals(auth()->user()->name, 'New name');
	}

	/** @test */
	public function users_cannot_update_their_names_with_a_single_word()
	{
		$this->signIn();

		$this->expectException('Illuminate\Validation\ValidationException');

		$this->post(route('client.profile.update'), [
			'name' => 'NoWay',
			'email' => auth()->user()->email]);
	}

	/** @test */
	public function users_cannot_update_their_emails_with_invalid_data()
	{
		$this->signIn();

		$this->expectException('Illuminate\Validation\ValidationException');

		$this->post(route('client.profile.update'), [
			'name' => 'Good Name',
			'email' => 'nah']);
	}
}
