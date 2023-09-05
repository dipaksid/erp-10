<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EvaluationForm extends Model
{
    use HasFactory;

    public function evaluationDetails()
    {
        return $this->hasMany(EvaluationDetail::class, 'evaluation_id')->orderBy('seq', 'ASC');
    }

    public static function getModule($request){
        if($request->segment(2)=="create"){
            $result='ADD EVALUATION FORM';
        } elseif($request->segment(3)=="edit"){
            $result='EDIT EVALUATION FORM';
        } elseif(is_numeric($request->segment(2)) && $request->input('_method')!="DELETE" ){
            $result='VIEW EVALUATION FORM';
        } elseif(is_numeric($request->segment(2)) && $request->input('_method')=="DELETE" ){
            $result='DELETE EVALUATION FORM';
        } else {
            $result='EVALUATION FORM LIST';
        }
        return $result;
    }

    public function scopeSearch($query, $searchValue)
    {
        if ($searchValue) {
            return $query->where('form_title', 'like', '%' . $searchValue . '%');
        }
        return $query;
    }
}
