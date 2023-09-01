<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CustomerCategory extends Model
{
    use HasFactory;

    const ITEM_PER_PAGES = 15;

    protected $fillable = ['categorycode', 'description','lastrunno','b_rmk','b_mobapp','b_adrmk','stockcatgid'];

    public static function getModule($request){

        if($request->segment(2)=="create"){
            $result='ADD CUSTOMER CATEGORY';
        } elseif($request->segment(3)=="edit" || $request->segment(2)=="uploadsystem"){
            $result='EDIT CUSTOMER CATEGORY';
        } elseif(is_numeric($request->segment(2)) && $request->input('_method')!="DELETE" ){
            $result='VIEW CUSTOMER CATEGORY';
        } elseif(is_numeric($request->segment(2)) && $request->input('_method')=="DELETE" ){
            $result='DELETE CUSTOMER CATEGORY';
        } else {
            $result='CUSTOMER CATEGORY LIST';
        }

        return $result;
    }

    public function scopeSearch($query, $searchValue)
    {
        if ($searchValue) {

            return $query->where(function ($subQuery) use ($searchValue) {
                $subQuery->where('categorycode', 'like', '%' . $searchValue . '%')
                    ->orWhere('description', 'like', '%' . $searchValue . '%');
            })->paginate(self::ITEM_PER_PAGES);
        }

        return $query->paginate(self::ITEM_PER_PAGES);
    }
}
