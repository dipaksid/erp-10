<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Gstrate extends Model
{
    use HasFactory;

    protected $fillable = ['id','effectivedate_from', 'rate', 'status','effectivedate_to'];
}
