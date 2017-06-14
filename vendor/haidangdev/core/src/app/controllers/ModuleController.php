<?php
namespace Haidangdev\Core\App\Controllers;

use Illuminate\Http\Request;
use Haidangdev\Core\App\Controllers\AdminController;
use Haidangdev\Core\App\Middlewares\SuperAdmin;
use Haidangdev\Core\App\Requests\ModuleRequest;
use Haidangdev\Core\App\Models\Module;
use Haidangdev\Core\App\Models\Element;
use Haidangdev\Core\App\Helpers\Helper;
use Haidangdev\Core\App\Traits\DataTable;

class ModuleController extends AdminController
{
    use DataTable;

    public function __construct(){
        parent::__construct();
        $this->middleware(SuperAdmin::class);
    }

    public function index(Request $req){
        view()->share('active', 'module');
        return view('admin::module.index');
    }

    public function create(ModuleRequest $req, $id = null){
        if($req->isMethod('get')){
            if($id){
                $action = 'Sửa';
                $module = Module::find($id);
                $elements = Element::where('module_id', $module->id)->get();
            }
            view()->share('active', 'module');
            return view('admin::module.create', compact('module', 'action', 'elements'));
        }
        if($req->isMethod('post')){
            if($id){
                $module = Module::find($id);
            }else{
                $module = new Module;
                $module->table_name = $req->table_name;
            }
            $module->name = $req->name;
            $module->path = $req->path != '' ? $req->path : str_slug($req->name);
            $module->icon = $req->icon != '' ? $req->icon : 'fa fa-puzzle-piece';
            $module->is_active = $req->is_active == 'on' ? 1 : 0;
            
            if($id){
                if(Module::updateTable($module->table_name, $req->field)){
                    $module->save();
                    if(Element::updateField($req->field, $id)){
                        return redirect(url('admin/module'))->with('message', 'Cập nhật module thành công!');
                    }
                }
            }else{
                if($req->create_controller){
                    $controllerName = explode('-', $tableName);
                    for ($i=0; $i < count($controllerName); $i++) { 
                        $controllerName[$i] = ucfirst($controllerName[$i]);
                    }
                    $controllerName = implode('', $controllerName);
                    \Artisan::call('make:controller', ['name' => 'Front/'.$controllerName.'Controller']);
                }
                if(Module::createTable($req->table_name, $req->field)){
                    $module->save();
                    if(Element::createField($module->id, $req->field)){
                        if($req->much == 'on'){
                            return redirect()->back()->with('message', 'Thêm module thành công!');
                        }
                        return redirect(url('admin/module'))->with('message', 'Thêm module thành công!');
                    }
                }
            }
            return redirect()->back()->with('error', 'Lỗi');
        }
    }

    public function fetchingForDataTable(Request $req){
        $module = new Module;
        return $this->fetch($req, 'team_modules', $module, [], ['name']);
    }

    public function indexModule(Request $req, $path){
        $module = Module::getByPath($path);
        $elements = Element::getForDataTable($module->id);
        view()->share('activeChild', $path);
        view()->share('active', 'module-item');
        return view('admin::module.index-module', compact('module', 'elements'));
    }

    public function createModule(Request $req, $path, $id = null){
        $module = Module::getByPath($path);
        $elements = Element::where('module_id', $module->id)->get();
        if($req->isMethod('get')){
            $model = null;
            if($id){
                $action = 'Sửa';
                $model = $this->_callModel($module->table_name)->find($id);
            }
            $form = Element::makeForm($elements, $model);
            view()->share('activeChild', $path);
            view()->share('active', 'module-item');
            return view('admin::module.create-module', compact('module', 'model', 'action', 'form'));
        }
        if($req->isMethod('post')){
            if($id){
                $action = 'Sửa';
                $model = $this->_callModel($module->table_name)->find($id);
            }else{
                $model = $this->_callModel($module->table_name);
            }
            foreach ($elements as $key) {
                $field = $key->field_name;
                if($key->element == 6){
                    $model->$field = $req->$field ? 1 : 0;
                }else{
                    $model->$field = $req->$field;
                }
            }
            $model->save();
            if($req->much == 'on'){
                return redirect()->back()->with('message', (isset($action) ? $action : 'Thêm ').$module->name.' thành công!');
            }
            return redirect(url('admin/module/'.$module->path))->with('message', (isset($action) ? $action : 'Thêm ').$module->name.' thành công!');
        }
    }

    public function fetchingModuleItem(Request $req){
        $module = Module::select('id','table_name')->where('path', $req->path)->first();
        $fields = Element::forFetch($module->id, $module->table_name);
        $model = \DB::table($module->table_name)->select($fields['select']);
        return $this->fetch($req, $module->table_name, $model, $fields['filter'], $fields['search']);
    }

    protected function _callModel($tableName){
        $modelName = explode('-', $tableName);
        for ($i=0; $i < count($modelName); $i++) { 
            $modelName[$i] = ucfirst($modelName[$i]);
        }
        $modelName = 'App\Models\Front\\'.implode('', $modelName);
        return new $modelName;
    }

    public function deleteModule(Request $req){
        $module = Module::select('name', 'table_name')->where('path', $req->path)->first();
        \DB::table($module->table_name)->where('id', $req->id)->delete();
        return redirect(url('admin/module/'.$req->path))->with('message', 'Xóa '.$module->name.' thành công!');
    }
}
