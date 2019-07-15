<?php

namespace App;

use App\Contracts\Reservation;

class Coupon extends Metropolis
{
	protected $dates = ['expires_at'];

    public function apply($fee, $user = null)
    {
    	$this->validate();

    	$this->increment('used', 1);

    	$discount = ($fee * $this->discount) / 100;

    	return $fee - $discount;
    }

    public function validate()
    {
    	if ($this->limit && $this->used >= $this->limit)
    		abort(403, 'Este coupon excedeu o seu limite de uso');

    	if ($this->expires_at && $this->expires_at->isPast())
    		abort(403, 'Este coupon expirou');
    }
}
