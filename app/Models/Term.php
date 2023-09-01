<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Term extends Model
{
    use HasFactory;

    protected $fillable = ['term', 'description', 'termdays'];
    public static function getModule($request){
        if($request->segment(2)=="create"){
            $result='ADD TERM';
        } elseif($request->segment(3)=="edit"){
            $result='EDIT TERM';
        } elseif(is_numeric($request->segment(2)) && $request->input('_method')!="DELETE" ){
            $result='VIEW TERM';
        } elseif(is_numeric($request->segment(2)) && $request->input('_method')=="DELETE" ){
            $result='DELETE TERM';
        } else {
            $result='TERM LIST';
        }
        return $result;
    }
}
