<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;

class AreasTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {

        Schema::disableForeignKeyConstraints();
        \DB::table('areas')->delete();

        \DB::table('areas')->insert(array (
            0 =>
            array (
                'id' => 1,
                'areas_id' => '385',
                'areacode' => 'SB',
                'description' => 'SABAH',
                'auc_cod' => 'SBH',
                'isactive' => '1',
                'seq' => 12,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            1 =>
            array (
                'id' => 2,
                'areas_id' => '386',
                'areacode' => 'WP',
                'description' => 'WILAYAH PERSEKUTUAN',
                'auc_cod' => '',
                'isactive' => '1',
                'seq' => 1,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            2 =>
            array (
                'id' => 3,
                'areas_id' => '387',
                'areacode' => 'PN',
                'description' => 'PENANG',
                'auc_cod' => '',
                'isactive' => '1',
                'seq' => 7,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            3 =>
            array (
                'id' => 4,
                'areas_id' => '388',
                'areacode' => 'SL',
                'description' => 'SELANGOR',
                'auc_cod' => '',
                'isactive' => '1',
                'seq' => 2,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            4 =>
            array (
                'id' => 5,
                'areas_id' => '389',
                'areacode' => 'LB',
                'description' => 'WP LABUAN',
                'auc_cod' => '',
                'isactive' => '1',
                'seq' => 14,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            5 =>
            array (
                'id' => 6,
                'areas_id' => '390',
                'areacode' => 'PH',
                'description' => 'PAHANG',
                'auc_cod' => '',
                'isactive' => '1',
                'seq' => 9,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            6 =>
            array (
                'id' => 7,
                'areas_id' => '391',
                'areacode' => 'NS',
                'description' => 'N. SEMBILAN',
                'auc_cod' => '',
                'isactive' => '1',
                'seq' => 3,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            7 =>
            array (
                'id' => 8,
                'areas_id' => '392',
                'areacode' => 'IP',
                'description' => 'PERAK',
                'auc_cod' => '',
                'isactive' => '1',
                'seq' => 0,
                'created_at' => NULL,
                'updated_at' => '2020-12-09 14:38:39',
            ),
            8 =>
            array (
                'id' => 9,
                'areas_id' => '393',
                'areacode' => 'ML',
                'description' => 'MALACCA',
                'auc_cod' => 'MAL',
                'isactive' => '1',
                'seq' => 8,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            9 =>
            array (
                'id' => 10,
                'areas_id' => '394',
                'areacode' => 'SA',
                'description' => 'SA',
                'auc_cod' => '',
                'isactive' => '0',
                'seq' => 20,
                'created_at' => NULL,
                'updated_at' => '2020-10-14 13:57:28',
            ),
            10 =>
            array (
                'id' => 11,
                'areas_id' => '395',
                'areacode' => 'JH',
                'description' => 'JOHOR',
                'auc_cod' => '',
                'isactive' => '1',
                'seq' => 4,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            11 =>
            array (
                'id' => 12,
                'areas_id' => '396',
                'areacode' => 'KL',
                'description' => 'KELANTAN',
                'auc_cod' => '',
                'isactive' => '1',
                'seq' => 10,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            12 =>
            array (
                'id' => 13,
                'areas_id' => '397',
                'areacode' => 'TE',
                'description' => 'TRENGGANU',
                'auc_cod' => '',
                'isactive' => '1',
                'seq' => 11,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            13 =>
            array (
                'id' => 14,
                'areas_id' => '398',
                'areacode' => 'SR',
                'description' => 'SARAWAK',
                'auc_cod' => 'SWK',
                'isactive' => '1',
                'seq' => 13,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            14 =>
            array (
                'id' => 15,
                'areas_id' => '426',
                'areacode' => 'PJ',
                'description' => 'PJ',
                'auc_cod' => '',
                'isactive' => '0',
                'seq' => 20,
                'created_at' => NULL,
                'updated_at' => '2020-10-14 13:57:16',
            ),
            15 =>
            array (
                'id' => 16,
                'areas_id' => '427',
                'areacode' => 'KD',
                'description' => 'KEDAH',
                'auc_cod' => '',
                'isactive' => '0',
                'seq' => 16,
                'created_at' => NULL,
                'updated_at' => '2020-10-14 14:11:48',
            ),
            16 =>
            array (
                'id' => 17,
                'areas_id' => '428',
                'areacode' => 'KEDAH',
                'description' => 'KEDAH',
                'auc_cod' => '',
                'isactive' => '1',
                'seq' => 6,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            17 =>
            array (
                'id' => 20,
                'areas_id' => null,
                'areacode' => 'BR',
                'description' => 'BRUNEI',
                'auc_cod' => '',
                'isactive' => '1',
                'seq' => 21,
                'created_at' => '2023-05-12 06:56:46',
                'updated_at' => '2023-05-12 07:01:51',
            ),
        ));

        Schema::enableForeignKeyConstraints();
    }
}
