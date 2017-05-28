<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;

class CarCategory extends Model
{
    public static function getForSelectBox(){
        $data = CarCategory::select('id', 'name')->where('is_active', 1)->orderBy('id', 'desc')->get();
        $result = [];
        foreach ($data as $key) {
            $result[$key->id] = $key->name;
        }
        return $result;
    }

    
}
