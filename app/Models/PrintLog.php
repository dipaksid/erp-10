<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PrintLog extends Model
{
    use HasFactory;

    protected $fillable = ['module','printfile', 'startprint', 'endprint', 'printcmd'];

    public function getfillable(){
        return $this->fillable;
    }
}
