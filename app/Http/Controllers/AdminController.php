<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\{Workshop, User, Plan, Membership, Event};

class AdminController extends Controller
{
    public function dashboard()
    {
    	$eventsNow = Event::now();
    	$ranking = Workshop::popular()->take(5)->get();
    	$upcoming = Workshop::upcoming()->orderBy('starts_at', 'asc')->first();
    	$latestUsers = User::latest()->take(20)->get();
    	$membershipsCount = Membership::count();
    	$plans = Plan::all();

    	return view('admin.pages.dashboard.index', compact(['ranking', 'upcoming', 'latestUsers', 'membershipsCount', 'plans', 'eventsNow']));
    }
}
