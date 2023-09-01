<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class TrainingformTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {


        \DB::table('training_forms')->delete();

        \DB::table('training_forms')->insert(array (
            0 =>
            array (
                'created_at' => '2021-08-24 10:32:24',
            'form_title' => 'BNM SCREENING SOFTWARE  - USER TRAINING GUIDE (SUMMARY)',
                'id' => 2,
                'systemcod' => 'BNM',
                'updated_at' => '2021-08-24 10:32:24',
            ),
            1 =>
            array (
                'created_at' => '2021-08-24 10:43:16',
            'form_title' => 'GOLDSMITH SOFTWARE  - USER TRAINING GUIDE (SUMMARY)',
                'id' => 3,
                'systemcod' => 'GSS',
                'updated_at' => '2021-08-24 10:43:16',
            ),
            2 =>
            array (
                'created_at' => '2021-08-28 11:29:39',
            'form_title' => 'PAWN SOFTWARE  - USER TRAINING GUIDE (SUMMARY)',
                'id' => 4,
                'systemcod' => 'PWS',
                'updated_at' => '2021-08-28 11:29:39',
            ),
            3 =>
            array (
                'created_at' => '2021-11-07 08:54:11',
            'form_title' => 'MONEY LENDER SOFTWARE  - USER TRAINING GUIDE (SUMMARY)',
                'id' => 7,
                'systemcod' => 'MLS',
                'updated_at' => '2021-11-07 08:54:11',
            ),
        ));


    }
}
