<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bank extends Model
{
    use HasFactory;

    protected $fillable = ['code', 'name'];

    public static function getModule($request) {
        if($request->segment(2) == "create") {
            $result='ADD BANK';
        } elseif($request->segment(3) == "edit") {
            $result='EDIT BANK';
        } elseif(is_numeric($request->segment(2)) && $request->input('_method') != "DELETE" ) {
            $result='VIEW BANK';
        } elseif(is_numeric($request->segment(2)) && $request->input('_method') == "DELETE" ) {
            $result='DELETE BANK';
        } else {
            $result='BANK LIST';
        }

        return $result;
    }

    /**
     * Scope a query to filter banks based on search value.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @param string|null $searchValue
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeSearch($query, $searchValue = null)
    {
        if ($searchValue) {
            return $query->where(function ($subQuery) use ($searchValue) {
                $subQuery->where('code', 'like', '%' . $searchValue . '%')
                    ->orWhere('name', 'like', '%' . $searchValue . '%');
            });
        }

        return $query;
    }
}
