<?php
namespace Team\Core\App\Helpers;
use Illuminate\Support\Facades\Storage;
use \File;

class Helper{

    public static function replaceLast($search, $replace, $subject)
    {
        $pos = strrpos($subject, $search);

        if($pos !== false)
        {
            $subject = substr_replace($subject, $replace, $pos, strlen($search));
        }

        return $subject;
    }

    public static function deleteImage($image){
        try{
            $image = json_decode($image);
            $arr = [];
            foreach ($image as $img) {
                $arr[] = $img->largest;
                $arr[] = 'public/'.$img->thumb;
            }
            if(count($arr)){
                Storage::delete($arr);
            }
            return 1;
        }
        catch(\Exception $e){
            return 0;
        }
    }
    /**/
    public static function isPrimary($dataType){
        if(in_array($dataType, config('admin.database.primary'))) return 1;
    }

    public static function isNullAble($dataType){
        if(!in_array($dataType, config('admin.database.notnull'))) return 1;
    }
}