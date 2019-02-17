<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\{Workshop, User, Plan, Membership, Event, Payment, Space};

class AdminController extends Controller
{
    public function dashboard()
    {
    	$ranking = Workshop::popular()->take(8)->get();
    	$latestUsers = User::latest()->take(18)->get();
    	$membershipsCount = Membership::count();
    	$plans = Plan::all();
        $eventsArray = Event::today()->calendar();
        $eventsToday = Event::today();
        
    	return view('admin.pages.dashboard.index', compact(['ranking', 'latestUsers', 'membershipsCount', 'plans', 'eventsArray', 'eventsToday']));
    }

    public function schedule()
    {
        $eventsArray = Event::calendar();
        $eventsToday = Event::today();

    	return view('admin.pages.schedule.index', compact(['eventsArray', 'eventsToday']));
    }

    public function users()
    {
        $users = User::all();

    	return view('admin.pages.users.index', compact('users'));
    }

    public function workshops()
    {
        $workshops = Workshop::orderBy('starts_at')->paginate(6);

    	return view('admin.pages.workshops.index', compact('workshops'));
    }

    public function payments()
    {
        $payments = Payment::all();

    	return view('admin.pages.payments.index', compact(['payments']));
    }
}
