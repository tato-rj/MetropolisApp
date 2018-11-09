<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;

class SpacesController extends Controller
{
    /**
     * Payment for a single transaction
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function pay(Plan $plan)
    {
        return $plan;
    }
}
