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

		$this->assertEquals(coupon($halfCoupon->name, $this->event->fee), $this->event->fee/2);
		$this->assertEquals(coupon($tenPercentCoupon->name, $this->event->fee), ($this->event->fee - ($this->event->fee/10)));
	}

	/** @test */
	public function it_knows_if_it_is_expired()
	{
		$this->expectException('Symfony\Component\HttpKernel\Exception\HttpException');

		$expiredCoupon = create(Coupon::class, ['expires_at' => now()->copy()->subWeek()]);
		
		coupon($expiredCoupon->name, 100);
	}

	/** @test */
	public function it_knows_if_it_has_exceeded_its_usage_limit()
	{
		$this->expectException('Symfony\Component\HttpKernel\Exception\HttpException');
		
		$usedCoupon = create(Coupon::class, ['limit' => 1]);
		
		coupon($usedCoupon->name, 100);
		coupon($usedCoupon->name, 100);
	}

	/** @test */
	public function it_ignores_the_coupon_if_it_doesnt_exist()
	{
		$fee = 100;
		$coupon = create(Coupon::class, ['discount' => 100]);

		$this->assertEquals(coupon(null, $fee), $fee);
		$this->assertEquals(coupon('FAKE', $fee), $fee);
		$this->assertEquals(coupon($coupon->name, $fee), 0);
	}

	/** @test */
	public function it_knows_its_status()
	{
		$coupon = create(Coupon::class);
		$expiredCoupon = create(Coupon::class, ['expires_at' => now()->copy()->subWeek()]);

		$this->assertEquals($expiredCoupon->status(), 'Este coupon não é válido.');
		$this->assertEquals($coupon->status(), 'Coupon válido! O desconto de ' . $coupon->discount . '% será aplicado ao valor final dessa compra.');
	}
}
