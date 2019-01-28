<?php

namespace Tests\Unit;

use Tests\AppTest;
use App\{User, Payment};

class PaymentTest extends AppTest
{
	/** @test */
	public function it_belongs_to_a_user()
	{
		$this->assertInstanceOf(User::class, $this->payment->user);
	}
}
