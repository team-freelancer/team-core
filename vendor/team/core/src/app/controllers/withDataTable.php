<?php

namespace Team\Core\App\Controllers;

use Illuminate\Http\Request;
use Team\Core\App\Controllers\AdminController;

class withDataTable extends AdminController
{
    protected $module;
    protected $filter;

    public function index(Request $request)
    {
        $req = $request->input();
        foreach ($req as $key => $value) {
            if(is_array($this->filter)){
                if((string)array_search($key, $this->filter) == '' || $req[$key] == ''){
                    unset($req[$key]);
                }
            }else{
                unset($req[$key]);
            }
        }
        $total = $this->module->count();
        $data = $this->module
                ->where($req);
        if(isset($this->search)){
            $data = $data->where($this->search, 'LIKE', '%' . $request->name . '%');
        }
        $data = $data->orderBy('id', 'desc');
        $filtered = $data->count();
        return response()->json([
            'draw'            => $request->draw,
            'recordsTotal'    => $total,
            'recordsFiltered' => $filtered,
            'data'            => $data->skip($request->start)->take($request->length)->get(),
        ]);
    }
}
