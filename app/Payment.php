<?php

namespace App;

use App\Contracts\Reservation;

class Payment extends Metropolis
{
	protected $with = ['reservation'];

    public function user()
    {
    	return $this->belongsTo(User::class);
    }

    public function reservation()
    {
    	return $this->morphTo();
    }

    public function scopeRecord($query, Reservation $reservation = null)
    {
        if ($reservation && ! $this->byCode($reservation->transaction_code)->exists()) {
        	return $this->create([
        		'user_id' => $reservation->owner_id,
        		'reservation_id' => $reservation->id,
        		'reservation_type' => get_class($reservation),
        		'transaction_code' => $reservation->transaction_code
        	]);
        }
    }

    public function scopeByCode($query, $code)
    {
        return $query->where('transaction_code', $code);
    }
}
