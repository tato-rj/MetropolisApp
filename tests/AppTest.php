<?php

namespace Tests;

use Tests\Utilities\ExceptionHandling;
use Illuminate\Foundation\Testing\DatabaseMigrations;

abstract class AppTest extends TestCase
{
	use DatabaseMigrations, ExceptionHandling;

    public function setUp()
    {
        parent::setUp();

        $this->disableExceptionHandling();
    }
    
    protected function signIn($user = null)
    {
    	$user = ($user) ?: create('App\User');
    	return $this->actingAs($user);
    }
}