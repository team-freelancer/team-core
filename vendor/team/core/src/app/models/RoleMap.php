<?php

namespace Team\Core\App\Models;

use Illuminate\Database\Eloquent\Model;

class RoleMap extends Model
{
    protected $table = 'team_role_mappers';
    public $timestamp = false;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        
    ];

    public static function getMap($roleID){
        $maps = RoleMap::where('role_id', $roleID)->get();
        $result = [];
        foreach ($maps as $map) {
            $result[$map->module_id] = [
                'is_view' => $map->is_view,
                'is_create' => $map->is_create,
                'is_update' => $map->is_update,
                'is_delete' => $map->is_delete,
            ];
        }
        return $result;
    }
}