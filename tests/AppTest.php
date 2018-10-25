<?php

namespace Tests;

use Tests\Utilities\ExceptionHandling;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use App\Office\Conference;

abstract class AppTest extends TestCase
{
	use DatabaseMigrations, ExceptionHandling;

    public function setUp()
    {
        parent::setUp();

        $this->disableExceptionHandling();

        $this->event = create('App\Event', ['type' => get_class(new Conference)]);
        $this->plan = create('App\Plan');
    }
    
    protected function signIn($user = null)
    {
    	$user = ($user) ?: create('App\User');
    	return $this->actingAs($user);
    }
}