<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SolutionProfile extends Model
{
    use HasFactory;

    protected $table = 'solution_profiles';

    protected $fillable = ['id','solutioncode', 'problem_description', 'problem_solution','active'];

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

    public function scopeSearch($query, $searchValue, $active)
    {
        if(isset($searchValue) && $searchValue != ''){
            return $query->where('active', $active)
                ->where(function ($query) use ($searchValue) {
                    if (!empty($searchValue)) {
                        $query->where('solutioncode', 'like', '%' . $searchValue . '%')
                            ->orWhere('problem_description', 'like', '%' . $searchValue . '%')
                            ->orWhere('problem_solution', 'like', '%' . $searchValue . '%');
                    }
                });
        }

        return $query->where('active', $active);
    }

    public static function generateNewSolutionCode()
    {
        $lastSolution = SolutionProfile::whereRaw('solutioncode like "%SP%"')->max('solutioncode');
        if ($lastSolution) {
            $lastNumber = intval(substr($lastSolution, 2));
            $newNumber = $lastNumber + 1;
        } else {
            $newNumber = 1;
        }

        return "SP" . sprintf("%08d", $newNumber);
    }
}
