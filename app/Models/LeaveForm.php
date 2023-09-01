<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LeaveForm extends Model
{
    use HasFactory;

    protected $table = 'leave_forms';

    protected $fillable = ['doc_no','staffid','staff_name', 'designation', 'leave_typ','leave_duration','leave_dat_frm','leave_dat_to','leave_reason','applied_dat','status','approved_by','approved_dat','applied_by'];

    public static function getModule($request) {
        if($request->segment(2)=="create"){
            $result = 'ADD LEAVE FORM';
        } elseif($request->segment(3)=="edit"){
            $result = 'EDIT LEAVE FORM';
        } elseif(is_numeric($request->segment(2)) && $request->input('_method')!="DELETE" ){
            $result = 'VIEW LEAVE FORM';
        } elseif(is_numeric($request->segment(2)) && $request->input('_method')=="DELETE" ){
            $result = 'DELETE LEAVE FORM';
        } else {
            $result = 'LEAVE FORM LIST';
        }
        return $result;
    }

    /**
     * Scope to filter leave forms for administrators.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @param  string  $searchValue
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeForAdmin(Builder $query, $searchValue)
    {
        return $query->where(function ($subQuery) use ($searchValue) {
            $subQuery->where('staff_name', 'like', '%' . $searchValue . '%')
                ->orWhere('leave_typ', 'like', '%' . $searchValue . '%')
                ->orWhere('designation', 'like', '%' . $searchValue . '%');
        });
    }

    /**
     * Scope to filter leave forms for regular users.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @param  string  $getUsername
     * @param  string  $searchValue
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeForUser(Builder $query, $getUsername, $searchValue)
    {
        return $query->where('applied_by', $getUsername)
            ->forAdmin($searchValue);
    }
}
