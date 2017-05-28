<?php
namespace Team\Core\App\Controllers;

use Illuminate\Http\Request;
use Team\Core\App\Middlewares\Authenticate;
use Auth;
use Team\Core\App\Models\Module;
use Team\Core\App\Helpers\Helper;

class AdminController extends \App\Http\Controllers\Controller
{
    public function __construct(){
        $this->middleware(Authenticate::class);
        view()->share('team_modules', Module::getForSideBar());
    }

    public function index(Request $req){
        return view('admin::index');
    }
}
