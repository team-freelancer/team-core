<?php

namespace App\Models\Front;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    //
    
    public static function getMenu(){
        $categories = \DB::table('groups')->select('id', 'name', 'slug')->where('is_active', 1)->get();
        foreach($categories as $item){
            $item->adapters = \DB::table('adapters')->select('id', 'name', 'slug')->where('is_active', 1)->where('group_id',$item->id)->get();
        }
        return $categories;
    }
    
}
