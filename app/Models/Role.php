<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use DB;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;

    const ROLES_PER_PAGE = 15;

    public function users(){
        return $this->belongsToMany(User::class);
    }

    public static function getModule($request){
        if($request->segment(2)=="create"){
            $result='ADD ROLE';
        } elseif($request->segment(3)=="edit"){
            $result='EDIT ROLE';
        } elseif(is_numeric($request->segment(2)) && $request->input('_method')!="DELETE" ){
            $result='VIEW ROLE';
        } elseif(is_numeric($request->segment(2)) && $request->input('_method')=="DELETE" ){
            $result='DELETE ROLE';
        } else {
            $result='ROLE LIST';
        }
        return $result;
    }
    public function scopeSearchRolesWithFilters(Builder $query, $filters)
    {
        $query = $this->select('roles.id as id','roles.name as name',DB::raw('group_concat(permissions.name) as permissionname'))
                        ->leftjoin('role_has_permissions','roles.id','=','role_has_permissions.role_id')
                        ->leftjoin('permissions', 'role_has_permissions.permission_id', '=', 'permissions.id');

        if(isset($filters['searchvalue'])) {
            $query->where(function ($query) use ($filters) {
                if (isset($filters['searchvalue'])) {
                    $query->where('roles.name','like','%'. $filters['searchvalue'] .'%')
                          ->orwhere('permissions.name','like','%'. $filters['searchvalue'] .'%');
                }
            });
        }

        return $query->groupBy('roles.id')->orderBy('id', 'desc')->paginate(self::ROLES_PER_PAGE);
    }

}
