<?php

namespace App\Http\Controllers\Auth\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Exceptions\AdminMustCreatePassword;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class LoginController extends Controller
{
    use AuthenticatesUsers;

    protected $defaultPassword = 'metropolis';
    protected $redirectTo = '/admin';

    public function showLoginForm()
    {
    	return view('auth.admin.login');
    }

    public function guard()
    {
    	return Auth::guard('admin');
    }
}
