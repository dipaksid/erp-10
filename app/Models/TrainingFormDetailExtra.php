<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class TrainingFormDetailExtra extends Model
{
    use HasFactory;

    protected $table = 'training_detail_extras';

    protected $fillable = ['id','detail_id','particular','special','seq','space_lvl','input_flag'];

    public function saveTrainingDetailExtra($data)
    {
        $this->detail_id = $data['detail_id'];
        $this->particular = $data['particular'];
        $this->special = $data['special'];
        $this->space_lvl = $data['space_lvl'];
        $this->seq = $data['seq'];
        $this->input_flag = $data['input_flag'];
        $this->save();
        return 1;
    }

    public function updateTrainingDetailExtra($data)
    {
        $training = $this->find($data['id']);
        $training->detail_id = $data['detail_id'];
        $training->particular = $data['particular'];
        $training->special = $data['special'];
        $training->space_lvl = $data['space_lvl'];
        $training->seq = $data['seq'];
        $training->input_flag = $data['input_flag'];
        $training->save();
        return 1;
    }

    public static function trainingformtablelist(){
        return DB::table('training_forms')
            ->join('customer_categories', 'training_forms.systemcod', '=', 'customer_categories.categorycode');
    }

    public static function trainingformdetaillist(){
        return DB::table('trainingform')
            ->join('customer_categories', 'training_forms.systemcod', '=', 'customer_categories.categorycode')
            ->join('training_form_details','training_forms.id','=','training_form_details.trainingid');
    }

    public static function trainingdetaillist(){
        return DB::table('training_detail_extras')
            ->join('training_form_details','training_detail_extras.detail_id','=','training_form_details.id');
    }

    public static function trainingdetailextralist(){
        return DB::table('trainingform')
            ->join('customer_categories', 'training_forms.systemcod', '=', 'customer_categories.categorycode')
            ->join('training_form_details','training_forms.id','=','training_form_details.trainingid')
            ->join('training_detail_extras','training_form_details.id','=','training_detail_extras.detail_id');
    }
}
