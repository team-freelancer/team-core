<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;
use DB;

class Category extends Model
{
    protected $i;

    public static function getBox($tableName){
        $data = DB::table($tableName)->select('id', 'name')->where('is_active', 1)->get();
        $response = [];
        foreach ($data as $key) {
            $response[$key->id] = $key->name;
        }
        return $response;
    }

    public static function getForSelectBox(){
        $data = Category::select('id', 'name', 'parent_id')->where('is_active', 1)->orderBy('id', 'desc')->get();
        return Category::recursive(-1, 0, $data, [0 => '_ROOT_']);
    }

    public static function recursive($start, $parentID, $data, $result){
        $start ++;
        $str = '';
        for ($i=0; $i < $start; $i++) { 
            $str .= '---';
        }
        foreach ($data as $key) {
            if($parentID == $key->parent_id){
                $result[$key->id] = $str.$key->name;
                $result = Category::recursive($start, $key->id, $data, $result);
            }
        }
        return $result;
    }

    public static function getForSelectBoxByType(){
        $data = Category::select('id', 'name', 'type')->where('is_active', 1)->orderBy('id', 'desc')->get();
        $result = [
            [],
            [],
            []
        ];
        foreach ($data as $key) {
            $result[(int)$key->type][(int)$key->id] = $key->name;
        }
        return $result;
    }
}
