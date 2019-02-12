<?php

namespace App\Http\Controllers\Auth\Admin;

use App\Http\Controllers\Controller;
use App\Admin;
use Illuminate\Foundation\Auth\ResetsPasswords;
use Illuminate\Support\Facades\Password;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ResetPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset requests
    | and uses a simple trait to include this behavior. You're free to
    | explore this trait and override any methods you wish to tweak.
    |
    */

    use ResetsPasswords;

    /**
     * Where to redirect users after resetting their password.
     *
     * @var string
     */
    protected $redirectTo = '/admin';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest:admin');
    }

    protected function broker()
    {
        return Password::broker('admins');
    }

    protected function guard()
    {
        return Auth::guard('admin');
    }

    public function showResetForm(Request $request, $token = null)
    {
        return view('auth.admin.passwords.reset')->with(
            ['token' => $token, 'email' => $request->email]
        );
    }

    public function showRequiredResetForm(Request $request, $token = null)
    {
        return view('auth.admin.passwords.reset')->with(
            ['required_reset' => true]
        );
    }

    public function saveNewPassword(Request $request)
    {
        $request->validate([
            'email' => 'required|string|email|max:255|exists:admins|safePassUpdate',
            'password' => 'required|string|min:6|confirmed|not_in:metropolis',
        ]);

        $admin = Admin::byEmail($request->email);

        $admin->update(['password' => bcrypt($request->password)]);

        Auth::guard('admin')->login($admin);

        return redirect(route('admin.dashboard'))->with('status', 'Bem vindo(a) à área administrativa do MetropolisRio!');
    }
}
