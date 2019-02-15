<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\{Workshop, User, Plan, Membership, Event, Payment, Space};

class AdminController extends Controller
{
    public function dashboard()
    {
    	$ranking = Workshop::popular()->take(5)->get();
    	$upcomingWorkshop = Workshop::upcoming()->orderBy('starts_at', 'asc')->first();
    	$latestUsers = User::latest()->take(18)->get();
    	$membershipsCount = Membership::count();
    	$plans = Plan::all();

    	return view('admin.pages.dashboard.index', compact(['ranking', 'upcomingWorkshop', 'latestUsers', 'membershipsCount', 'plans']));
    }

    public function schedule()
    {
        $eventsArray = Event::calendar();
        $eventsToday = Event::today();
        $eventsCount = $eventsToday->count();
        $conflictsCount = $eventsToday->withConflict()->count();

    	return view('admin.pages.schedule.index', compact(['eventsArray', 'eventsCount', 'conflictsCount']));
    }

    public function users()
    {
        $users = User::all();

    	return view('admin.pages.users.index', compact('users'));
    }

    public function workshops()
    {
        $workshops = Workshop::paginate(6);

    	return view('admin.pages.workshops.index', compact('workshops'));
    }

    public function payments()
    {
        $payments = Payment::all();

    	return view('admin.pages.payments.index', compact('payments'));
    }
}
