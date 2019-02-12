<?php

namespace App\Http\Middleware;

use Closure;
use App\Admin;
use Illuminate\Support\Facades\Auth;

class AdminMustUpdatePassword
{
    protected $defaultPassword = 'metropolis';
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $admin = Admin::byEmail($request->email);

        if ($admin->exists() && $this->isDefaultPassword($admin, $request)) {
            return redirect(route('admin.password.required-reset', ['admin' => $admin->email]));
        }

        return $next($request);
    }

    public function isDefaultPassword($admin, $request)
    {
        return \Hash::check($this->defaultPassword, $admin->password) && $request->password == $this->defaultPassword;
    }
}
