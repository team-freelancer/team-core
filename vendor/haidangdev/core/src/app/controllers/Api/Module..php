<?php
namespace Haidangdev\Core\App\Controllers\Api;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Haidangdev\Core\App\Models\Element;

class Module{

    public function fields(Request $req){
        return response()->json(Element::select('field_name', 'field_title')->where('module_id', $req->module_id)->get());
    }

}