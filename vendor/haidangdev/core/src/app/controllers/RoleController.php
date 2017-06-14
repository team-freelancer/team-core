<?php
namespace Haidangdev\Core\App\Controllers;

use Illuminate\Http\Request;
use Haidangdev\Core\App\Controllers\AdminController;
use Haidangdev\Core\App\Middlewares\SuperAdmin;
use Haidangdev\Core\App\Models\Role;
use Haidangdev\Core\App\Models\RoleMap;
use Haidangdev\Core\App\Models\Module;
use Haidangdev\Core\App\Traits\DataTable;

class RoleController extends AdminController
{
    use DataTable;
    
    public function __construct(){
        parent::__construct();
        $this->middleware(SuperAdmin::class);
        view()->share('active', 'role');
    }

    public function index(Request $req){
        return view('admin::role.index');
    }

    public function create(Request $req, $id = null){
        
        if($req->isMethod('get')){
            $modules = Module::select('id', 'name')->where('is_active', 1)->get();
            if($id){
                $maps = RoleMap::getMap($id);
                $action = 'Sửa';
                $role = Role::find($id);
            }
            return view('admin::role.create', compact('role', 'action', 'modules', 'maps'));
        }
        if($req->isMethod('post')){
            if($id){
                $action = 'Sửa';
                $role = Role::find($id);
            }else{
                $role = new Role;
            }
            $role->name = $req->name;
            $role->super_admin = $req->super_admin == 'on' ? 1 : 0;
            $role->is_active = $req->is_active == 'on' ? 1 : 0;
            if($role->save()){
                $maps = [];
                foreach ($req->map as $map) {
                    $m = [
                        'role_id' => $role->id,
                        'module_id' => $map['module_id'],
                        'is_view' => isset($map['is_view']) ? 1 : 0,
                        'is_create' => isset($map['is_create']) ? 1 : 0,
                        'is_update' => isset($map['is_update']) ? 1 : 0,
                        'is_delete' => isset($map['is_delete']) ? 1 : 0,
                    ];
                    $maps[] = $m;
                }
                RoleMap::where('role_id', $role->id)->delete();
                RoleMap::insert($maps);
            }
            if($req->much == 'on'){
                return redirect()->back()->with('message', 'Thêm quyền thành công!');
            }
            return redirect(url('admin/role'))->with('message', (isset($action) ? $action : 'Thêm').' quyền thành công!');
        }
    }

    public function fetchingRole(Request $req){
        $role = new Role;
        return $this->fetch($req, 'team_roles', $role, [], ['name']);
    }

    public function delete(Request $req){
        Role::where('id', $req->id)->delete();
        RoleMap::where('role_id', $req->id)->delete();
        return redirect()->back()->with('message', 'Xóa quyền thành công!');
    }
}
