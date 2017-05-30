<?php
namespace Team\Core\App\Controllers\Api;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Intervention\Image\ImageManager;
use \File;

class Upload{

    protected $imagesDir;
    protected $imageSrc;
    protected $thumbsDir;
    protected $thumbSrc;

    public function __construct(){
        $this->imageSrc = 'uploads';
        $this->thumbSrc = 'uploads/thumbs';
        $this->imagesDir = public_path($this->imageSrc);
        $this->thumbsDir = public_path($this->thumbSrc);
    }

    public function upload(Request $req){
        if($req->dir){
            $this->imageSrc = $this->imageSrc.'/'.$req->dir;
            $this->thumbSrc = $this->thumbSrc.'/'.$req->dir.'/thumbs';
            $this->imagesDir = public_path($this->imageSrc);
            $this->thumbsDir = public_path($this->thumbSrc);
        }
        $this->_checkDir();
        $initialPreview = [];
        $initialPreviewConfig = [];
        $_image = new ImageManager;
        for ($i=0; $i < count($req->file('team_files')); $i++) { 
            $file = $req->file('team_files');
            $fileExt = $file->getClientOriginalExtension();
            $fileName = time().'.'.$fileExt;
            try{
                $file->move($this->imagesDir, $fileName);
                $_image->make($this->imagesDir.'/'.$fileName,array(
                    'width' => config('admin.image.thumb.width'),
                    'height' => config('admin.image.thumb.height'),
                    'greyscale' => true
                ))->save($this->thumbsDir.'/thumb-'.$fileName);
                $initialPreview[] = url('public/'.$this->thumbSrc.'/thumb-'.$fileName);
                $initialPreviewConfig[] = [
                    'caption' => $fileName,
                    'url' => url('admin/api/delete/file'),
                    'key' => "{'largest': 'public/$this->imageSrc/$fileName', 'thumb': 'public/$this->thumbSrc/thumb-$fileName'}",
                    'append' => true
                ];
            }
            catch(\Exception $e){}
        }
        
        return response()->json([
            'initialPreview' => $initialPreview,
            'initialPreviewConfig' => $initialPreviewConfig
        ]);
    }

    protected function _checkDir(){
        !is_dir($this->imagesDir) ? mkdir($this->imagesDir) : '';
        !is_dir($this->thumbsDir) ? mkdir($this->thumbsDir) : '';
    }

    public function delete(Request $req){
        $src = json_decode(str_replace("'", '"', $req->key));
        File::delete([$src->largest, $src->thumb]);
        return response()->json($src);
    }
}