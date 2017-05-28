<?php

namespace Team\Core\App\Middlewares;

use Closure;
use Illuminate\Support\Facades\Auth;

class Authenticate
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = 'admin')
    {
        if (!Auth::guard($guard)->check()) {
            if($request->ajax()){
                return response()->json(['error' => 'You do not have access']);
            }
            return redirect(url('admin/login'));
        }
        view()->share($guard, Auth::guard($guard)->user());
        return $next($request);
    }
}
