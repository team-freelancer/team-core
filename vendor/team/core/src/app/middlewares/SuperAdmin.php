<?php

namespace Team\Core\App\Middlewares;

use Closure;
use Illuminate\Support\Facades\Auth;
use Team\Core\App\Models\Role;

class SuperAdmin
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
            return $this->ifFalse($request);
        }
        $role_id = Auth::guard($guard)->user()->role_id;
        if(!$role_id){
            return $this->ifFalse($request);
        }
        $role = Role::select('super_admin')->where('id', $role_id)->first();
        if($role->super_admin){
            return $next($request);
        }
        return $this->ifFalse($request);
    }

    public static function ifFalse($request){
        if($request->ajax()){
            return response()->json(['error' => 'You do not have access']);
        }
        return redirect(url('admin'))->with(['message' => 'Tài khoản không đủ quyền truy cập', 'messageType' => 'danger']);
    }
}
