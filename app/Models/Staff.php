<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Staff extends Model
{
    use HasFactory;

    protected $table = 'staffs';

    protected $fillable = ['staffcode', 'name','comp_id', 'commrate','designation','department','date_join','last_review'];

    public static function getModule($request){
        if($request->segment(2)=="create"){
            $result='ADD STAFF';
        } elseif($request->segment(3)=="edit"){
            $result='EDIT STAFF';
        } elseif(is_numeric($request->segment(2)) && $request->input('_method')!="DELETE" ){
            $result='VIEW STAFF';
        } elseif(is_numeric($request->segment(2)) && $request->input('_method')=="DELETE" ){
            $result='DELETE STAFF';
        } else {
            $result='STAFF LIST';
        }
        return $result;
    }

    public function scopeSearch($query, $searchValue)
    {
        if (isset($searchValue) && $searchValue !== null) {
            return $query->where('staffcode', 'like', '%' . $searchValue . '%')
                ->orWhere('name', 'like', '%' . $searchValue . '%')
                ->orWhere('commrate', 'like', '%' . $searchValue . '%');
        }

        return $query;
    }
}
