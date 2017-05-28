<?php
function imageThumb($image){
    try{
        $image = json_decode($image);
        if(count($image)){
            return asset('storage/'.$image[0]->thumb);
        }
    }
    catch(\Exception $e){
        return asset('vendor/img/no-image.png');
    }
}