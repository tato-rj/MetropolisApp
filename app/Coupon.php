<?php

namespace App;

use App\Contracts\Reservation;

class Coupon extends Metropolis
{
	protected $dates = ['expires_at'];

    public function scopeMatch($query, $name)
    {
        return $query->where('name', $name);
    }

    public function apply($fee, $user = null)
    {
    	$this->validate();

    	$this->increment('used', 1);

    	$discount = floor(($fee * $this->discount) / 100);

    	return $fee - $discount;
    }

    public function status()
    {
        try {
            $this->validate();
        } catch (\Exception $e) {
            return response()->json(['message' => 'Este coupon não é válido.', 'status' => 'invalid']);
        }

        return response()->json(['message' => 'Coupon válido! O desconto de ' . $this->discount . '% será aplicado ao valor final dessa compra.', 'status' => 'valid']);
    }

    public function isValid()
    {
        try {
            $this->validate();
        } catch (\Exception $e) {
            return false;
        }

        return true;
    }

    public function validate()
    {
    	if ($this->limit && $this->used >= $this->limit)
    		abort(403, 'Este coupon excedeu o seu limite de uso');

    	if ($this->expires_at && $this->expires_at->isPast())
    		abort(403, 'Este coupon expirou');

        return $this;
    }
}
