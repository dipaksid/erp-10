<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'staff_id'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    const USER_PER_PAGE = 15;

    public function scopeSearchUsersWithFilters(Builder $query, $filters)
    {
        $query = $this->select('users.id as id','users.name as name','users.email as email','roles.name as rolename')
                        ->leftJoin('model_has_roles', 'users.id', '=', 'model_has_roles.model_id')
                        ->leftJoin('roles', 'model_has_roles.role_id', '=', 'roles.id');

        if(isset($filters['searchvalue'])) {
            $query->where(function ($query) use ($filters) {
                if (isset($filters['searchvalue'])) {
                    $query->where('users.name', 'like', '%' . $filters['searchvalue'] . '%');
                    $query->where('users.email', 'like', '%' . $filters['searchvalue'] . '%');
                    $query->orwhere('roles.name','like','%'.  $filters['searchvalue'] .'%');
                }
            })->distinct();
        }

        return $query->orderBy('id', 'desc')->paginate(self::USER_PER_PAGE);
    }

    public static function getModule($request)
    {
        if($request->segment(2)=="create"){
            $result='ADD USER';
        } elseif($request->segment(3)=="edit"){
            $result='EDIT USER';
        } elseif(is_numeric($request->segment(2)) && $request->input('_method')!="DELETE" ){
            $result='VIEW USER';
        } elseif(is_numeric($request->segment(2)) && $request->input('_method')=="DELETE" ){
            $result='DELETE USER';
        } else {
            $result='USER LIST';
        }
        return $result;
    }

    public function scopeUserStaffInfo(Builder $query, $userId)
    {
        return $query->select('staffs.name', 'staffs.staffcode', 'staffs.designation', 'staffs.department')
            ->leftJoin('model_has_roles', function ($join) {
                $join->on('users.id', '=', 'model_has_roles.model_id')
                    ->where('model_has_roles.model_type', '=', 'App\Models\User');
            })
            ->leftJoin('roles', 'model_has_roles.role_id', '=', 'roles.id')
            ->leftJoin('staffs', 'users.staff_id', '=', 'staffs.id')
            ->where('users.id', $userId)
            ->first();
    }
}
