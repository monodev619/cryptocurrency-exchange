<?php

namespace App\Http\Middleware;

use Closure;
use App\Admin;

class AdminAuth
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (!empty(auth()->guard('admin')->id())) {

            if (!Admin::find(auth()->guard('admin')->id())->count()) {
                return redirect()->route('admin.login_view');
            }

            return $next($request);
        }
        else {
            return redirect()->route('admin.login_view');
        }
    }
}
