<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;

class AgentsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {

        Schema::disableForeignKeyConstraints();

        \DB::table('agents')->delete();

        \DB::table('agents')->insert(array (
            0 =>
            array (
                'agentcode' => 'TFS',
                'areas_id' => 2,
                'commrate' => '0.00',
                'created_at' => NULL,
                'id' => 1,
                'name' => 'TSEN FUN SENG',
                'updated_at' => '2020-05-11 16:24:37',
            ),
            1 =>
            array (
                'agentcode' => 'CPY',
                'areas_id' => 2,
                'commrate' => '0.00',
                'created_at' => NULL,
                'id' => 2,
                'name' => 'MS CHAN',
                'updated_at' => '2019-12-10 14:11:56',
            ),
            2 =>
            array (
                'agentcode' => 'SAM',
                'areas_id' => 4,
                'commrate' => '10.00',
                'created_at' => '2020-06-11 19:36:42',
                'id' => 3,
                'name' => 'SAM - IRENE FRIEND',
                'updated_at' => '2020-06-11 19:36:42',
            ),
            3 =>
            array (
                'agentcode' => 'C-JB',
                'areas_id' => 11,
                'commrate' => '15.00',
                'created_at' => '2021-10-07 10:45:06',
                'id' => 5,
            'name' => 'MR CHANG (PWS-DP5500,MLS-DP5000)',
                'updated_at' => '2021-10-07 10:53:32',
            ),
            4 =>
            array (
                'agentcode' => 'NEOH',
                'areas_id' => 17,
                'commrate' => '10.00',
                'created_at' => '2022-03-19 08:19:23',
                'id' => 6,
                'name' => 'NEOH',
                'updated_at' => '2022-03-19 08:19:23',
            ),
        ));

        Schema::enableForeignKeyConstraints();
    }
}
