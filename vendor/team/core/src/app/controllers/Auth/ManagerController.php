<?php
namespace Team\Core\App\Controllers\Auth;

use Illuminate\Http\Request;
use Team\Core\App\Controllers\AdminController;
use Team\Core\App\Models\Admin;
use Team\Core\App\Traits\DataTable;
use Team\Core\App\Requests\AdminRequest;

class ManagerController extends AdminController
{
    use DataTable;

    public function __construct(){
        parent::__construct();
        view()->share('active', 'manager');
    }
    public function index(Request $req){
        return view('admin::auth.index');
    }

    public function create(AdminRequest $req, $id = null){
        
        if($req->isMethod('get')){
            if($id){
                $action = 'Sửa';
                $adminUser = Admin::find($id);
            }
            return view('admin::auth.create', compact('adminUser', 'action'));
        }
        if($req->isMethod('post')){
            if($id){
                $action = 'Sửa';
                $adminUser = Admin::find($id);
            }else{
                $adminUser = new Admin;
            }
            $adminUser->name = $req->name;
            $adminUser->email = $req->email;
            $adminUser->avatar = $req->avatar;
            $adminUser->active = $req->active == 'on' ? 1 : 0;
            $req->password ? $adminUser->password = \Hash::make($req->password) : '';
            $adminUser->save();
            if($req->much == 'on'){
                return redirect()->back()->with('message', (isset($action) ? $action : 'Thêm ').'admin thành công!');
            }
            return redirect(url('admin/manager'))->with('message', (isset($action) ? $action : 'Thêm ').'admin thành công!');
        }
    }

    public function fetchingAdmin(Request $req){
        $admin = new Admin;
        return $this->fetch($req, 'team_admins', $admin, [], ['name']);
    }
}
