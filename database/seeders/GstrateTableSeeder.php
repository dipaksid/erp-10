<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class GstrateTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('gstrates')->delete();
        
        \DB::table('gstrates')->insert(array (
            0 => 
            array (
                'created_at' => '2021-08-26 13:34:48',
                'effectivedate_from' => '2015-04-01',
                'effectivedate_to' => '2018-05-31',
                'id' => 1,
                'rate' => 6,
                'status' => '1',
                'updated_at' => '2021-08-26 13:34:48',
            ),
        ));
        
        
    }
}