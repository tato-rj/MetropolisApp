<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\CheckEventsForm;
use App\{Space, Event, User};

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

    /**
     * Checks if the space is available for booking.
     * 
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function check(Request $request, CheckEventsForm $form)
    {
        $date = carbon($form->starts_at);

        $usersArray = User::select(['id', 'name', 'email'])->get()->toArray();

    	$results = $form->space->checkAvailability($date, $form->duration, $form->participants, $includePlan = true);

        $price = $form->space->priceFor($form->participants, $form->duration);

        if ($date->isWeekend())
            return view('admin.pages.schedule.create.results.invalid', compact(['results', 'form']))->render();

    	return view('admin.pages.schedule.create.results.valid', compact(['results', 'form', 'usersArray', 'price']))->render();
    }
}
