<?php

namespace Team\Core\App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Team\Core\App\Helpers\Helper;

class Module extends Model
{
    protected $table = 'team_modules';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        
    ];

    public static function createTable($tableName, $fields = []){
        Schema::create($tableName, function (Blueprint $table) use ($fields){
            $table->increments('id');
            foreach ($fields as $field) {
                $nullable = isset($field['required']) ? false : true;
                switch($field['dataType']){
                    case 'integer':
                    case 'tinyInteger':
                    case 'unsignedInteger':
                    case 'unsignedTinyInteger':
                        $table->$field['dataType']($field['name'])->default(@$field['default'])->nullable($nullable);
                        break;
                    case 'string':
                        $table->$field['dataType']($field['name'], @$field['length'])->default(@$field['default'])->nullable($nullable);
                        break;
                    case 'boolean':
                        $table->$field['dataType']($field['name'])->default(isset($field['default']) ? 1 : 0)->nullable($nullable);
                        break;
                    case 'timestamp':
                        $table->timestamp($field['name'])->default(isset($field['default']) ? $field['default'] : \Carbon\Carbon::now());
                        break;
                    default:
                        $table->$field['dataType']($field['name'])->default(@$field['default'])->nullable($nullable);
                        break;
                }
            }
            $table->timestamps();
        });
        $modelName = explode('-', $tableName);
        for ($i=0; $i < count($modelName); $i++) { 
            $modelName[$i] = ucfirst($modelName[$i]);
        }
        $modelName = implode('', $modelName);
        \Artisan::call('make:model', ['name' => 'Models/Front/'.$modelName]);
        return 1;
    }

    public static function updateTable($tableName, $fields = []){
        Schema::table($tableName, function (Blueprint $table) use ($fields, $tableName){
            foreach ($fields as $field) {
                if(isset($field['is_drop'])){
                    $table->dropColumn($field['old_name']);
                }elseif(!isset($field['old_name'])){
                    $nullable = isset($field['required']) ? false : true;
                    switch($field['dataType']){
                        case 'integer':
                        case 'tinyInteger':
                        case 'unsignedInteger':
                        case 'unsignedTinyInteger':
                            $table->$field['dataType']($field['name'])->default(@$field['default'])->nullable($nullable);
                            break;
                        case 'string':
                            $table->$field['dataType']($field['name'], @$field['length'])->default(@$field['default'])->nullable($nullable);
                            break;
                        case 'boolean':
                            $table->$field['dataType']($field['name'])->default(isset($field['default']) ? 1 : 0)->nullable($nullable);
                            break;
                        case 'timestamp':
                            $table->timestamp($field['name'])->default(isset($field['default']) ? $field['default'] : \Carbon\Carbon::now());
                            break;
                        default:
                            $table->$field['dataType']($field['name'])->default(@$field['default'])->nullable($nullable);
                            break;
                    }
                }else{
                    $nullable = isset($field['required']) ? false : true;
                    switch($field['dataType']){
                        case 'integer':
                        case 'tinyInteger':
                        case 'unsignedInteger':
                        case 'unsignedTinyInteger':
                            $table->$field['dataType']($field['old_name'])->default(@$field['default'])->nullable($nullable)->change();
                            break;
                        case 'string':
                            $table->$field['dataType']($field['old_name'], @$field['length'])->default(@$field['default'])->nullable($nullable)->change();
                            break;
                        case 'boolean':
                            $table->$field['dataType']($field['old_name'])->default(isset($field['default']) ? 1 : 0)->nullable($nullable)->change();
                            break;
                        case 'timestamp':
                            $table->timestamp($field['name'])->default(isset($field['default']) ? $field['default'] : \Carbon\Carbon::now())->change();
                            break;
                        default:
                            $table->$field['dataType']($field['old_name'])->default(@$field['default'])->nullable($nullable)->change();
                            break;
                    }
                    if($field['old_name'] != $field['name']){
                        $table->renameColumn($field['old_name'], $field['name']);
                    }
                }
            }
        });
        return 1;
    }

    public static function getForSideBar(){
        return Module::select('name', 'path', 'icon')->where('is_active', 1)->get();
    }

    public static function getByPath($path){
        return Module::select('id', 'name', 'path', 'icon', 'table_name')->where('path', $path)->first();
    }

    public static function getForSelect(){
        $module = Module::select('id', 'name')->where('is_active', 1)->get();
        $result = [];
        foreach ($module as $key => $value) {
            $result[$value->id] = $value->name;
        }
        return $result;
    }
}