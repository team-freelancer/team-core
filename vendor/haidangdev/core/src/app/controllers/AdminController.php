<?php
namespace Haidangdev\Core\App\Controllers;

use Illuminate\Http\Request;
use Haidangdev\Core\App\Middlewares\Authenticate;
use Auth;
use Haidangdev\Core\App\Models\Module;
use Haidangdev\Core\App\Helpers\Helper;

class AdminController extends \App\Http\Controllers\Controller
{
    public function __construct(){
        $this->middleware(Authenticate::class);
        view()->share('team_modules', Module::getForSideBar());
    }

    public function index(Request $req){
        $module = Module::select('name', 'table_name', 'icon', 'path');
        $statist = [
            'Module' => [
                'icon' => 'fa fa-cubes',
                'count' => $module->count(),
                'path' => 'admin/module'
            ]
        ];
        foreach ($module->get() as $key) {
            $statist[$key->name] = [
                'icon' => $key->icon,
                'count' => \DB::table($key->table_name)->select('COUNT(1)')->count(),
                'path' => 'admin/module/'.$key->path
            ];
        }
        return view('admin::index', compact('statist'));
    }
}
