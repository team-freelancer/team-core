<?php

namespace Haidangdev\Core\App\Models;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    protected $table = 'team_roles';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        
    ];

    public static function getForSelect(){
        $module = Role::select('id', 'name')->where('is_active', 1)->get();
        $result = [];
        foreach ($module as $key => $value) {
            $result[$value->id] = $value->name;
        }
        return $result;
    }
}