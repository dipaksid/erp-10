<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;
class TermsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {

        Schema::disableForeignKeyConstraints();
        \DB::table('terms')->delete();

        \DB::table('terms')->insert(array (
            0 =>
            array (
                'created_at' => NULL,
                'description' => 'CASH',
                'id' => 3,
                'term' => 'CASH',
                'termdays' => 0,
                'terms_id' => '111',
                'updated_at' => '2022-02-22 10:43:44',
            ),
            1 =>
            array (
                'created_at' => NULL,
                'description' => '14 DAYS',
                'id' => 7,
                'term' => '14 DAYS',
                'termdays' => 14,
                'terms_id' => '115',
                'updated_at' => NULL,
            ),
            2 =>
            array (
                'created_at' => NULL,
                'description' => '30 DAYS',
                'id' => 8,
                'term' => '30 DAYS',
                'termdays' => 30,
                'terms_id' => '116',
                'updated_at' => '2020-06-11 19:34:50',
            ),
            3 =>
            array (
                'created_at' => NULL,
                'description' => '45 DAYS',
                'id' => 9,
                'term' => '45 DAYS',
                'termdays' => 45,
                'terms_id' => '117',
                'updated_at' => '2020-06-11 19:35:06',
            ),
        ));

        Schema::enableForeignKeyConstraints();
    }
}
