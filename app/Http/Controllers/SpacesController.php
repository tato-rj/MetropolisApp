<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\CheckEventsForm;
use App\{Space, Event};
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

    /**
     * Checks if the space is available for booking.
     * 
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function check(Request $request, CheckEventsForm $form)
    {
        $date = Carbon::parse($request->date)->setTime($request->time,0,0);

    	$space = Space::find($request->space_id);

    	$results = $space->checkAvailability($date, $request->duration, $request->participants);
    	
        if ($date->isWeekend())
            return view('admin.pages.schedule.create.results.invalid', compact('results'))->render();

    	return view('admin.pages.schedule.create.results.valid', compact(['results', 'request', 'space']))->render();
    }
}
