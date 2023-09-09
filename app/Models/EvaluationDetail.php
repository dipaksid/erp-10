<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EvaluationDetail extends Model
{
    use HasFactory;

    protected $table = 'evaluation_details';

    protected $guarded = [];

    public function saveEvaluationFormDetail($data)
    {
        $this->evaluation_id = $data['evaluation_id'];
        $this->form_title = $data['form_title'];
        $this->form_detail = $data['form_detail'];
        if(isset($data['status'])){
            $this->status = $data['status'];
        }
        $this->seq = $data['seq'];
        $this->max_rating = $data['max_rating'];

        try {
            $rs = $this->save();
            return 1;
        } catch (\Exception $e) {
            return 0;
        }
    }

    public function updateEvaluationFormDetail($data)
    {
        $evaluation = $this->where('evaluation_id', $data['evaluation_id'])->first();
        $evaluation->evaluation_id = $data['evaluation_id'];
        $evaluation->form_title = $data['form_title'];
        $evaluation->form_detail = $data['form_detail'];
        if(isset($data['status'])){
            $evaluation->status = $data['status'];
        }
        $evaluation->seq = $data['seq'];
        $evaluation->max_rating = $data['max_rating'];
        $evaluation->save();
        return 1;
    }
}
