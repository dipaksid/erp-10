<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Home extends Model
{
    public static function getModule($request){
        $result='DASHBOARD';

        return $result;
    }
}
