<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Agent extends Model
{
    use HasFactory;

    protected $fillable = ['agentcode', 'name', 'commrate', 'areas_id'];

    public static function getModule($request){
        if($request->segment(2)=="create"){
            $result='ADD AGENT';
        } elseif($request->segment(3)=="edit"){
            $result='EDIT AGENT';
        } elseif(is_numeric($request->segment(2)) && $request->input('_method')!="DELETE" ){
            $result='VIEW AGENT';
        } elseif(is_numeric($request->segment(2)) && $request->input('_method')=="DELETE" ){
            $result='DELETE AGENT';
        } else {
            $result='AGENT LIST';
        }
        return $result;
    }

    public static function searchAgents($searchValue = null)
    {
        $query = self::select('agents.id', 'agents.agentcode', 'agents.name', 'areas.description', 'agents.commrate')
            ->leftJoin('areas', 'agents.areas_id', '=', 'areas.id');

        if ($searchValue) {
            $query->where(function ($subQuery) use ($searchValue) {
                $subQuery->where('agents.agentcode', 'like', '%' . $searchValue . '%')
                    ->orWhere('agents.name', 'like', '%' . $searchValue . '%')
                    ->orWhere('areas.description', 'like', '%' . $searchValue . '%');
            });
        }

        return $query;
    }

}
