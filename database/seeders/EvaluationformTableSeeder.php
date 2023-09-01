<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class EvaluationformTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('evaluation_forms')->delete();
        
        \DB::table('evaluation_forms')->insert(array (
            0 => 
            array (
                'created_at' => '2023-07-11 10:01:09',
                'form_title' => 'PROGRAMMER/ G CLERK',
                'id' => 1,
                'status' => 1,
                'updated_at' => '2023-07-11 10:01:09',
            ),
            1 => 
            array (
                'created_at' => '2023-07-11 10:01:09',
                'form_title' => 'EXECUTIVE / HOD',
                'id' => 2,
                'status' => 1,
                'updated_at' => '2023-07-11 10:01:09',
            ),
        ));
        
        
    }
}