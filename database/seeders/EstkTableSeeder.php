<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class EstkTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('estks')->delete();
        
        \DB::table('estks')->insert(array (
            0 => 
            array (
                'id' => 10,
            ),
            1 => 
            array (
                'id' => 13,
            ),
            2 => 
            array (
                'id' => 17,
            ),
            3 => 
            array (
                'id' => 19,
            ),
            4 => 
            array (
                'id' => 20,
            ),
            5 => 
            array (
                'id' => 21,
            ),
            6 => 
            array (
                'id' => 23,
            ),
            7 => 
            array (
                'id' => 26,
            ),
            8 => 
            array (
                'id' => 29,
            ),
            9 => 
            array (
                'id' => 31,
            ),
        ));
        
        
    }
}