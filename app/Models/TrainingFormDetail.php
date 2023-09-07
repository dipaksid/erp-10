<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TrainingFormDetail extends Model
{
    use HasFactory;

    protected $table = 'training_form_details';

    protected $fillable = ['id','trainingid','no','particular','special','seq','space_lvl','input_flag'];

    public function saveTrainingFormDetail($data)
    {
        $this->trainingid = $data['trainingid'];
        $this->no = $data['no'];
        $this->particular = $data['particular'];
        $this->special = $data['special'];
        $this->space_lvl = $data['space_lvl'];
        $this->seq = $data['seq'];
        $this->input_flag = $data['input_flag'];
        $this->save();
        return 1;
    }

    public function updateTrainingFormDetail($data)
    {
        $training = $this->find($data['id']);
        $training->trainingid = $data['trainingid'];
        $training->no = $data['no'];
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

    public static function trainingdetailextralist(){
        return DB::table('trainingform')
            ->join('customer_categories', 'trainingform.systemcod', '=', 'customer_categories.categorycode')
            ->join('trainingformdetail','trainingform.id','=','trainingformdetail.trainingid')
            ->join('trainingdetail_extra','trainingformdetail.id','=','trainingdetail_extra.detail_id');
    }
}
