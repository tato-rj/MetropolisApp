<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\SpaceSearchForm;
use Carbon\Carbon;

class SpacesController extends Controller
{
    /**
     * Searches for a space based on user's input.
     * 
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function search(Request $request)
    {
        return view('pages.search.index');
    }

    /**
     * Checks if the space is free for booking.
     * 
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function confirm(Request $request, SpaceSearchForm $form)
    {
        $type = request()->type;
        
        $totalCost = $type()->fee(
            request()->duration,
            request()->participants
        );

        $available = Carbon::parse($request->date)->isSameDay(now()->addDay());

        $page = $available ? 'success' : 'fail';

        return view("pages.search.{$page}", compact(['available', 'totalCost']));
    }

    /**
     * Payment for a single transaction
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function pay(Request $request)
    {
        return $request->all();
    }
}
