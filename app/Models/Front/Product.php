<?php

namespace App\Models\Front;

use Illuminate\Database\Eloquent\Model;
// use App\Models\Front\Category;
use DB;

class Product extends Model
{
    public static function getSelling(){
        return Product::select('id', 'name', 'price', 'images')->where('is_active', 1)->orderBy('buy', 'desc')->limit(6)->get();
    }
    public static function getForHome(){
        $categories = DB::table('groups')->select('id', 'name', 'slug')->where('is_active', 1)->get();
        foreach ($categories as $key) {
            $key->products = Product::select('id', 'name', 'price', 'images')->where('group_id', $key->id)->orderBy('id', 'desc')->limit(6)->get();
        }
        return $categories;
    }
}
