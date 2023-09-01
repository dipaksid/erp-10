<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CategoryVersion extends Model
{
    use HasFactory;

    protected $fillable = ['categoryid','version', 'version_desc'];

    public function category(){

        return $this->belongsTo('App\Models\CustomerCategory', 'customer_categories_id', 'id');
    }
}
