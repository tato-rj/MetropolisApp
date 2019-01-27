<?php

namespace App;

use App\Services\PagSeguro\PagSeguro;

class Membership extends Metropolis
{
    protected $dates = ['next_payment_at', 'subscription_ends_at', 'renewed_at','canceled_at'];

    public function plan()
    {
    	return $this->belongsTo(Plan::class);
    }

    public function user()
    {
    	return $this->belongsTo(User::class);
    }

    public function start()
    {
        return $this->user->events()->create([
            'plan_id' => $this->plan->id,
            'reference' => $this->reference,
            'fee' => $this->plan->fee,
            'starts_at' => $this->created_at->setTime(office()->day_starts_at,0,0),
            'ends_at' => $this->next_payment_at->subDay()
        ]);
    }

    public function setStatus($status)
    {
        $this->update([
            'status' => $status,
            'verified_at' => now()
        ]);
    }

    public function renew($xml)
    {
        $lastEvent = Event::where('reference', $this->reference)->orderBy('id', 'desc')->first();

        $starts_at = $lastEvent->ends_at->addDay()->setTime(office()->day_starts_at,0,0);

        $this->user->bonuses()->delete();

        $this->update(['next_payment_at' => $this->plan->renewsAt($starts_at)]);

        return $this->user->events()->create([
            'plan_id' => $this->plan->id,
            'transaction_code' => $xml->code,
            'reference' => $this->reference,
            'fee' => $this->plan->fee,
            'starts_at' => $starts_at,
            'ends_at' => $this->next_payment_at->subDay(),
            'verified_at' => now(),
            'status_id' => $xml->status
        ]);
    }

    public function scopeByReference($query, $reference)
    {
        return $query->where('reference', $reference);
    }

    public function isActive()
    {
        return $this->status == 'ACTIVE';
    }
}
