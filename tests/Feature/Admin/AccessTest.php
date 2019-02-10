<?php

namespace Tests\Feature\Admin;

use Tests\AppTest;
use App\Admin;

class AccessTest extends AppTest
{
    public function setUp()
    {
        parent::setUp();

        $this->admin = create(Admin::class);
    }

    /** @test */
    public function authenticated_admins_can_access_the_admin_page()
    {
    	$this->signIn($this->admin, 'admin');

    	$this->get(route('admin.dashboard'))->assertStatus(200);
    }

    /** @test */
    public function admins_are_required_to_update_their_password_on_their_first_login()
    {
        $this->expectException('Illuminate\Validation\ValidationException');
        
    	$this->post(route('admin.login.submit'), [
    		'email' => $this->admin->email,
    		'password' => 'metropolis'
    	]);	
    }

    /** @test */
    public function unauthenticated_admins_cannot_access_the_admin_page()
    {
		$this->expectException('Illuminate\Auth\AuthenticationException');

    	$this->get(route('admin.dashboard'));
    }
}
