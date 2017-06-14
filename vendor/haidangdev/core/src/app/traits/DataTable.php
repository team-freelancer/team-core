<?php
namespace Haidangdev\Core\App\Traits;

trait DataTable
{
    public function fetch($request, $tableName, $model, $filter = [], $search = []){
        $req = $request->input();
        $totalInput = array_merge($filter, $search);
        $where = [];
        foreach ($req as $key => $value) {
            if(count($filter) == 0 && count($search) == 0){
                unset($req[$key]);
            }else{
                if(in_array($key, $filter) && $req[$key] != ''){
                    $where[$tableName.'.'.$key] = $req[$key];
                }
                if(in_array($key, $totalInput) && $req[$key] != ''){
                    $req[$tableName.'.'.$key] = $req[$key];
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
                if(isset($req[$tableName.'.'.$s])){
                    $data = $data->where($tableName.'.'.$s, 'LIKE', '%' . trim($req[$tableName.'.'.$s]) . '%');
                }
            }
        }
        $data = $data->orderBy($tableName.'.id', 'desc');
        $filtered = $data->count();
        $response = $data->skip($request->start)->take($request->length)->get();
        return response()->json([
            'draw'            => $request->draw,
            'recordsTotal'    => $total,
            'recordsFiltered' => $filtered,
            'data'            => $response,
        ]);
    }
}
