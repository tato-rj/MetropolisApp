<?php

namespace App;

use App\Contracts\Reservation;
use App\Traits\PagSeguro;

class UserWorkshop extends Metropolis implements Reservation
{
    use PagSeguro;
}
