<?php

namespace Team\Core\App\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Auth;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/admin';
    protected $redirectIfFails = '/admin/login';
    protected $redirectIfSuccess = '/admin';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function index(Request $req){
        if($req->isMethod('get')){
            if(Auth::guard('admin')->check()){
                return redirect(url($this->redirectIfSuccess));
            }
            return view('admin::auth.login');
        }
        if(Auth::guard('admin')->attempt(['email' => $req->email, 'password' => $req->password, 'active' => 1])){
            return redirect(url($this->redirectIfSuccess));
        };
        return redirect()->back()->withErrors(['login' => 'Tên đăng nhập hoặc mật khẩu không đúng hoặc tài khoản bị chặn']);
    }

    public function logout(){
        Auth::guard('admin')->logout();
        return redirect(url($this->redirectIfFails));
    }
}
