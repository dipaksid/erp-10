<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
    use HasFactory;

    protected $table = 'permissions';

    protected $fillable = ['name', 'guard_name'];

    const PERMISSION_PER_PAGE = 15;
    /**
     * Find a permission by its name.
     *
     * @param string $name
     *
     * @throws PermissionDoesNotExist
     *
     * @return Permission
     */
    public static function findByName($name)
    {
        $permission = Permission::where('name', $name)->first();

        return $permission;
    }

    public function roles()
    {
        return $this->belongsToMany(
            config('laravel-permission.models.role'),
            config('laravel-permission.table_names.role_has_permissions')
        );
    }

    public static function getModule($request){
        if($request->segment(2)=="create"){
            $result='ADD PERMISSION';
        } elseif($request->segment(3)=="edit"){
            $result='EDIT PERMISSION';
        } elseif(is_numeric($request->segment(2)) && $request->input('_method')!="DELETE" ){
            $result='VIEW PERMISSION';
        } elseif(is_numeric($request->segment(2)) && $request->input('_method')=="DELETE" ){
            $result='DELETE PERMISSION';
        } else {
            $result='PERMISSION LIST';
        }
        return $result;
    }

    public function scopeSearchPermissionsWithFilters(Builder $query, $filters)
    {
        if(isset($filters['searchvalue'])) {
            $query->where('name','like','%'. $filters['searchvalue'].'%');
        }

        return $query->orderBy('id', 'desc')->paginate(self::PERMISSION_PER_PAGE);
    }
}
