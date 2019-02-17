<?php

namespace App;

use App\Contracts\Reservation;
use App\Traits\PagSeguro;

class Bill extends Metropolis implements Reservation
{
    use PagSeguro;

    public function getOwnerIdAttribute()
    {
        return $this->creator_id;
    }

    public function setStatus($status_id)
    {
        $this->update([
            'status_id' => $status_id,
            'verified_at' => now()
        ]);

        return $this;
    }
}
