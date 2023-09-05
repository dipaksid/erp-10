<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ServiceRate extends Model
{
    use HasFactory;

    protected $fillable = ['id','description', 'rate', 'status','effectivedate'];

    public static function getModule($request){
        if($request->segment(2)=="create"){
            $result='ADD SERVICES RATE PROFILE';
        } elseif($request->segment(3)=="edit"){
            $result='EDIT SERVICES RATE PROFILE';
        } elseif(is_numeric($request->segment(2)) && $request->input('_method')!="DELETE" ){
            $result='VIEW SERVICES RATE PROFILE';
        } elseif(is_numeric($request->segment(2)) && $request->input('_method')=="DELETE" ){
            $result='DELETE SERVICES RATE PROFILE';
        } else {
            $result='SERVICES RATE PROFILE LIST';
        }
        return $result;
    }

    public function scopeSearch($query, $searchValue)
    {
        if ($searchValue) {
            return $query->where('description', 'like', '%' . $searchValue . '%')
                ->orWhere('effectivedate', 'like', '%' . $searchValue . '%');
        }

        return $query;
    }
}
