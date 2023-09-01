<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Area extends Model
{
    use HasFactory;

    protected $fillable = ['areacode', 'description', 'isactive', 'seq'];

    public static function getModule($request) {
        if($request->segment(2)=="create") {
            $result='ADD AREA';
        } elseif($request->segment(3)=="edit") {
            $result='EDIT AREA';
        } elseif(is_numeric($request->segment(2)) && $request->input('_method')!="DELETE" ) {
            $result='VIEW AREA';
        } elseif(is_numeric($request->segment(2)) && $request->input('_method')=="DELETE" ) {
            $result='DELETE AREA';
        } else {
            $result='AREA LIST';
        }

        return $result;
    }

    public function scopeSearchByValue($query, $searchValue)
    {
        return $query->where('areacode', 'like', '%' . $searchValue . '%')
                    ->orWhere('description', 'like', '%' . $searchValue . '%')
                    ->orderBy('seq');
    }
}
