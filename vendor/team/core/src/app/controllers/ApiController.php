<?php
namespace Team\Core\App\Controllers;

use Illuminate\Http\Request;
use Team\Core\App\Controllers\AdminController;
use Team\Core\App\Models\Menu;
use Team\Core\App\Models\Element;
use Team\Core\App\Models\Module;
use \DB, \File;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\ImageManager;

class ApiController extends AdminController
{
    public function getTable(Request $req){
        $tables = \DB::select('SHOW TABLES');
        $listTables = [];
        $table_select_except = [
            'migrations', 
            'team_menus', 
            'team_admins'
        ];
        foreach($tables as $table)
        {
            if(!in_array($table->Tables_in_team_oto, $table_select_except)){
                $listTables[] = $table->Tables_in_team_oto;
            }
        }
        // return response()->json($response);
        $response = '<div class="form-group"><label>Bảng liên kết</label>';
        $response .= \Form::select('link_to', $listTables, null, ['id' => 'menu-link_to', 'class' => 'form-control', 'placeholder' => 'Chọn bảng liên kết']);
        $response .= '</div>';
        return $response;
    }

    public function fetchingModule(Request $req){
        $module = Module::select(
						'team_modules.id', 'team_modules.name', 'team_modules.table_name', 'team_modules.is_active'
				);
        return $this->fetchingForDatatable($req, (object)['table_name' => 'team_modules'], $module, [], []);
    }

    public function fetchingModuleItem(Request $req, $path){
        $moduleItem = Module::select('id', 'table_name', 'path')->where('path', $path)->first();
        $elements = Element::select('field_name', 'element', 'is_hidden', 'is_search', 'is_filter', 'is_manager')->where(['module_id' => $moduleItem->id])->get();
        $select = []; $filter = []; $search = [];
        foreach ($elements as $key) {
            if($key->is_hidden){
                if(in_array($key->element, [0, 12])){
                    $select[] = $key->field_name;
                }
            }
            else{
                if($key->is_manager){
                    $select[] = $key->field_name;
                }
                if($key->is_filter){
                    $filter[] = $key->field_name;
                }
                if($key->is_search){
                    $search[] = $key->field_name;
                }
            }
        }
        if(count($select)> 0){
            $module = DB::table($moduleItem->table_name)->select($select);
        }else{
            return response()->json([
                'draw'            => $req->draw,
                'recordsTotal'    => 0,
                'recordsFiltered' => 0,
                'data'            => [],
            ]);
        }
        return $this->fetchingForDatatable($req, $moduleItem, $module, $filter, $search);
    }

    public function fetchingForDatatable($request, $module, $model, $filter = [], $search = []){
        $req = $request->input();
        $totalInput = array_merge($filter, $search);
        $where = [];
        foreach ($req as $key => $value) {
            if(count($filter) == 0 && count($search) == 0){
                unset($req[$key]);
            }else{
                if(in_array($key, $filter) && $req[$key] != ''){
                    $where[$module->table_name.'.'.$key] = $req[$key];
                }
                if(in_array($key, $totalInput) && $req[$key] != ''){
                    $req[$module->table_name.'.'.$key] = $req[$key];
                    unset($req[$key]);
                }else{
                    unset($req[$key]);
                }
            }
        }
        $total = $model->count();
        $data = $model->where($where);
        if(count($search) > 0){
            foreach ($search as $s) {
                if(isset($req[$module->table_name.'.'.$s])){
                    $data = $data->where($tableName.'.'.$s, 'LIKE', '%' . trim($req[$module->table_name.'.'.$s]) . '%');
                }
            }
        }
        $data = $data->orderBy($module->table_name.'.id', 'desc');
        $filtered = $data->count();
        $response = $data->skip($request->start)->take($request->length)->get();
        return response()->json([
            'draw'            => $request->draw,
            'recordsTotal'    => $total,
            'recordsFiltered' => $filtered,
            'data'            => $response,
        ]);
    }

    public function upload(Request $req){
        $pre = [];
        $conf = [];
        if(!is_dir(storage_path('app/public/thumbs'))){
            mkdir(storage_path('app/public/thumbs'));
        }
        $image = new ImageManager;
        for ($i=0; $i < count($req->file('team_files')); $i++) { 
            $path = str_replace('public/', '', $req->file('team_files')->store('public'));
            $pre[] = url('storage/'.$path);
            $image->make(storage_path('app/public/'.$path),array(
                'width' => config('admin.image.thumb.width'),
                'height' => config('admin.image.thumb.height'),
                'greyscale' => true
            ))->save(storage_path('app/public/thumbs/thumb-'.$path));
            $conf[] = [
                'caption' => $path,
                'url' => url('admin/api/delete/file'),
                'key' => "{'largest': '".$path."', 'thumb': 'thumbs/thumb-".$path."'}",
                'append' => true
            ];
        }
        return [
            'initialPreview' => $pre,
            'initialPreviewConfig' => $conf
        ];
    }

    public function deleteFile(Request $req){
        $src = json_decode(str_replace("'", '"', $req->key));
        Storage::delete(['public/'.$src->largest, 'public/'.str_replace('thumbs/thumbs/', 'thumbs/', $src->thumb)]);
        return response()->json([
            'largest' => $src->largest,
            'key' => $src
        ]);
    }
}
