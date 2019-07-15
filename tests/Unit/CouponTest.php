<?php

namespace Tests\Unit;

use Tests\AppTest;
use App\Coupon;

class CouponTest extends AppTest
{
	/** @test */
	public function it_knows_how_to_apply_it_self()
	{
		$halfCoupon = create(Coupon::class, ['discount' => 50]);
		$tenPercentCoupon = create(Coupon::class, ['discount' => 10]);

		$this->assertEquals($halfCoupon->apply($this->event->fee), $this->event->fee/2);
		$this->assertEquals($tenPercentCoupon->apply($this->event->fee), ($this->event->fee - ($this->event->fee/10)));
	}

	/** @test */
	public function it_knows_if_it_is_expired()
	{
		$this->expectException('Symfony\Component\HttpKernel\Exception\HttpException');

		$expiredCoupon = create(Coupon::class, ['expires_at' => now()->copy()->subWeek()]);
		
		$expiredCoupon->apply(100);
	}

	/** @test */
	public function it_knows_if_it_has_exceeded_its_usage_limit()
	{
		$this->expectException('Symfony\Component\HttpKernel\Exception\HttpException');
		
		$usedCoupon = create(Coupon::class, ['limit' => 1]);
		
		$usedCoupon->apply(100);
		$usedCoupon->apply(100);
	}
}
