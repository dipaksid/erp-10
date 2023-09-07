<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class TrainingForm extends Model
{
    use HasFactory;

    protected $table = 'training_forms';

    protected $fillable = ['id','systemcod','form_title'];

    public function saveTrainingForm($data)
    {
        $this->systemcod = $data['systemcod'];
        $this->form_title = $data['form_title'];
        $this->save();
        return 1;
    }

    public function updateTrainingForm($data)
    {
        $training = $this->find($data['id']);
        $training->systemcod = $data['systemcod'];
        $training->form_title = $data['form_title'];
        $training->save();
        return 1;
    }

    public static function trainingformtablelist(){
        return DB::table('training_forms')
            ->join('customer_categories', 'training_forms.systemcod', '=', 'customer_categories.categorycode');
    }

    public static function trainingformdetaillist(){
        return DB::table('training_forms')
            ->join('customer_categories', 'training_forms.systemcod', '=', 'customer_categories.categorycode')
            ->join('training_form_details','training_forms.id','=','training_form_details.trainingid');
    }

    public static function trainingdetailextralist(){
        return DB::table('training_forms')
            ->join('customer_categories', 'training_forms.systemcod', '=', 'customer_categories.categorycode')
            ->join('training_form_details','training_forms.id','=','training_form_details.trainingid')
            ->join('training_detail_extras','training_form_details.id','=','training_detail_extras.detail_id');
    }

    public static function getModule($request){
        if($request->segment(2)=="create"){
            $result='ADD TRAINING FORM';
        } elseif($request->segment(3)=="edit"){
            $result='EDIT TRAINING FORM';
        } elseif(is_numeric($request->segment(2)) && $request->input('_method')!="DELETE" ){
            $result='VIEW TRAINING FORM';
        } elseif(is_numeric($request->segment(2)) && $request->input('_method')=="DELETE" ){
            $result='DELETE TRAINING FORM';
        } else {
            $result='TRAINING FORM LIST';
        }
        return $result;
    }
}
