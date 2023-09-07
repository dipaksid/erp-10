<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
        return DB::table('trainingform')
            ->join('customer_categories', 'trainingform.systemcod', '=', 'customer_categories.categorycode');
    }

    public static function trainingformdetaillist(){
        return DB::table('trainingform')
            ->join('customer_categories', 'trainingform.systemcod', '=', 'customer_categories.categorycode')
            ->join('trainingformdetail','trainingform.id','=','trainingformdetail.trainingid');
    }

    public static function trainingdetaillist(){
        return DB::table('trainingdetail_extra')
            ->join('trainingformdetail','trainingdetail_extra.detail_id','=','trainingformdetail.id');
    }

    public static function trainingdetailextralist(){
        return DB::table('trainingform')
            ->join('customer_categories', 'trainingform.systemcod', '=', 'customer_categories.categorycode')
            ->join('trainingformdetail','trainingform.id','=','trainingformdetail.trainingid')
            ->join('trainingdetail_extra','trainingformdetail.id','=','trainingdetail_extra.detail_id');
    }
}
