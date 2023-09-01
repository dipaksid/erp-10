<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;

class BanksTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {

        Schema::disableForeignKeyConstraints();
        \DB::table('banks')->delete();

        \DB::table('banks')->insert(array (
            0 =>
            array (
                'id' => 1,
                'code' => 'HLBB',
                'name' => 'HONG LEONG BANK BERHAD',
                'created_at' => '2019-12-03 13:35:58',
                'updated_at' => '2019-12-03 13:35:58',
            ),
            1 =>
            array (
                'id' => 2,
                'code' => 'PBB',
                'name' => 'PUBLIC BANK BERHAD',
                'created_at' => '2019-12-03 13:36:09',
                'updated_at' => '2019-12-03 13:36:09',
            ),
            2 =>
            array (
                'id' => 3,
                'code' => 'CIMB',
                'name' => 'CIMB BANK BHD',
                'created_at' => '2019-12-03 13:36:21',
                'updated_at' => '2019-12-03 14:33:18',
            ),
            3 =>
            array (
                'id' => 4,
                'code' => 'MBB',
                'name' => 'MAYBANK BERHAD',
                'created_at' => '2019-12-03 13:36:30',
                'updated_at' => '2019-12-03 13:36:30',
            ),
            4 =>
            array (
                'id' => 5,
                'code' => 'AMB',
                'name' => 'AMBANK (M) BERHAD',
                'created_at' => '2019-12-03 13:36:42',
                'updated_at' => '2019-12-03 14:32:43',
            ),
            5 =>
            array (
                'id' => 6,
                'code' => 'UOBMB',
                'name' => 'UNITED OVERSEAS BANK (M) BHD',
                'created_at' => '2019-12-03 14:33:09',
                'updated_at' => '2019-12-03 14:33:09',
            ),
            6 =>
            array (
                'id' => 7,
                'code' => 'AFFIN',
                'name' => 'AFFIN BANK BHD',
                'created_at' => '2019-12-03 14:35:26',
                'updated_at' => '2019-12-03 14:35:26',
            ),
            7 =>
            array (
                'id' => 8,
                'code' => 'CITIBANK',
                'name' => 'CITIBANK BHD',
                'created_at' => '2019-12-03 14:35:54',
                'updated_at' => '2019-12-03 14:35:54',
            ),
            8 =>
            array (
                'id' => 9,
                'code' => 'HSBC',
                'name' => 'HSBC BANK MALAYSIA BHD',
                'created_at' => '2019-12-03 14:36:33',
                'updated_at' => '2019-12-03 14:36:33',
            ),
            9 =>
            array (
                'id' => 10,
                'code' => 'OCBC',
                'name' => 'OCBC BANK MALAYSIA BHD',
                'created_at' => '2019-12-03 14:36:56',
                'updated_at' => '2019-12-03 14:36:56',
            ),
            10 =>
            array (
                'id' => 11,
                'code' => 'RHB',
                'name' => 'RHB BANK BHD',
                'created_at' => '2019-12-03 14:37:09',
                'updated_at' => '2019-12-03 14:37:09',
            ),
            11 =>
            array (
                'id' => 12,
                'code' => 'STANDARD',
                'name' => 'STANDARD  CHARTERED BANK BHD',
                'created_at' => '2019-12-03 14:37:35',
                'updated_at' => '2019-12-03 14:37:35',
            ),
        ));
        Schema::enableForeignKeyConstraints();

    }
}
