<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;

class HardwareloanTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        Schema::disableForeignKeyConstraints();

        \DB::table('hardware_loans')->delete();
        
        \DB::table('hardware_loans')->insert(array (
            0 => 
            array (
                'categorycode' => 'PWS',
                'comp_cod' => 'SL024',
                'created_at' => '2023-05-23 12:55:05',
                'jobno' => 'SW00007606',
                'remarks' => '',
                'status' => 1,
                'stocks_id' => 106,
                'stockname' => 'OKI ML391T 136 COL DOT MATRIX PRINTER',
                'updated_at' => '2023-05-23 12:55:05',
            ),
            1 => 
            array (
                'categorycode' => 'PWS',
                'comp_cod' => 'PH007',
                'created_at' => '2023-05-23 12:57:27',
                'jobno' => 'SW00007813',
                'remarks' => 'demo 9 loan',
                'status' => 1,
                'stocks_id' => 106,
                'stockname' => 'OKI ML391T 136 COL DOT MATRIX PRINTER',
                'updated_at' => '2023-05-23 12:57:27',
            ),
        ));
        
        Schema::enableForeignKeyConstraints();
    }
}