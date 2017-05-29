<?php
namespace Team\Core\App\Controllers\Auth;

use Illuminate\Http\Request;
use Team\Core\App\Controllers\AdminController;
use Team\Core\App\Middlewares\SuperAdmin;
use Team\Core\App\Models\Admin;
use Team\Core\App\Models\Element;
use Team\Core\App\Models\Module;
use Team\Core\App\Models\Role;
use Team\Core\App\Traits\DataTable;
use Team\Core\App\Requests\AdminRequest;
use Auth;

class ManagerController extends AdminController
{
    use DataTable;

    public function __construct(){
        parent::__construct();
        $this->middleware(SuperAdmin::class)->only('index', 'fetchingAdmin');
        view()->share('active', 'manager');
    }
    public function index(Request $req){
        return view('admin::auth.index');
    }

    public function create(AdminRequest $req, $id = null){
        if(!$id){
            if(!Auth::guard('admin')->user()->role->super_admin){
                return redirect(url('admin'))->with(['message' => 'Tài khoản không đủ quyền truy cập', 'messageType' => 'danger']);
            }
        }else{
            if($id != Auth::guard('admin')->user()->id){
                return redirect(url('admin'))->with(['message' => 'Tài khoản không đủ quyền truy cập', 'messageType' => 'danger']);
            }
        }
        if($req->isMethod('get')){
            $roles = Role::getForSelect();
            if($id){
                $action = 'Sửa';
                $adminUser = Admin::find($id);
            }
            return view('admin::auth.create', compact('adminUser', 'action', 'modules', 'roles'));
        }
        if($req->isMethod('post')){
            if($id){
                $action = 'Sửa';
                $adminUser = Admin::find($id);
            }else{
                $adminUser = new Admin;
            }
            $adminUser->name = $req->name;
            $adminUser->role_id = $req->role_id;
            $adminUser->email = $req->email;
            $adminUser->avatar = $req->avatar;
            $adminUser->active = $req->active == 'on' ? 1 : 0;
            $req->password ? $adminUser->password = \Hash::make($req->password) : '';
            $adminUser->save();
            if($req->much == 'on'){
                return redirect()->back()->with('message', (isset($action) ? $action : 'Thêm ').' admin thành công!');
            }
            return redirect(url('admin/manager'))->with('message', (isset($action) ? $action : 'Thêm ').'admin thành công!');
        }
    }

    public function fetchingAdmin(Request $req){
        $admin = Admin::leftJoin('team_roles', 'team_admins.role_id', '=', 'team_roles.id')->select('team_admins.*', 'team_roles.name as role_name');
        return $this->fetch($req, 'team_admins', $admin, [], ['name']);
    }
}
