<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SolutionProfile extends Model
{
    use HasFactory;

    public static function getModule($request){
        if($request->segment(2)=="create"){
            $result='ADD SOLUTION PROFILE';
        } elseif($request->segment(3)=="edit"){
            $result='EDIT SOLUTION PROFILE';
        } elseif(is_numeric($request->segment(2)) && $request->input('_method')!="DELETE" ){
            $result='VIEW SOLUTION PROFILE';
        } elseif(is_numeric($request->segment(2)) && $request->input('_method')=="DELETE" ){
            $result='DELETE SOLUTION PROFILE';
        } else {
            $result='SOLUTION PROFILE LIST';
        }
        return $result;
    }

}
