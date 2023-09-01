<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class UomsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {


        \DB::table('uoms')->delete();

        \DB::table('uoms')->insert(array (
            0 =>
            array (
                'created_at' => NULL,
                'description' => '--BASE UOM--',
                'id' => 1,
                'isactive' => '1',
                'stocks_id' => 82,
                'uomcode' => 'UNIT',
                'uomid' => 'EA7D7B9D-153E-4A3F-A71A-08CB6071CE5F',
                'updated_at' => '2020-12-11 08:06:45',
            ),
            1 =>
            array (
                'created_at' => NULL,
                'description' => '--BASE UOM--',
                'id' => 2,
                'isactive' => '1',
                'stocks_id' => 18,
                'uomcode' => 'UNIT',
                'uomid' => '22F603F5-2E25-42F7-9B21-0F9D8F72B7E7',
                'updated_at' => NULL,
            ),
            2 =>
            array (
                'created_at' => NULL,
                'description' => '--BASE UOM--',
                'id' => 3,
                'isactive' => '1',
                'stocks_id' => 25,
                'uomcode' => 'UNIT',
                'uomid' => '228F629F-A614-4126-8011-10A3F0062B65',
                'updated_at' => NULL,
            ),
            3 =>
            array (
                'created_at' => NULL,
                'description' => '--BASE UOM--',
                'id' => 4,
                'isactive' => '1',
                'stocks_id' => 7,
                'uomcode' => 'UNIT',
                'uomid' => '17D99CCA-F0DA-4F68-8A91-13103671C615',
                'updated_at' => NULL,
            ),
            4 =>
            array (
                'created_at' => NULL,
                'description' => '--BASE UOM--',
                'id' => 5,
                'isactive' => '1',
                'stocks_id' => 13,
                'uomcode' => 'UNIT',
                'uomid' => '1D8FBD55-C0EF-49E8-8E44-1D528A89047A',
                'updated_at' => NULL,
            ),
            5 =>
            array (
                'created_at' => NULL,
                'description' => '--BASE UOM--',
                'id' => 6,
                'isactive' => '1',
                'stocks_id' => 22,
                'uomcode' => 'UNIT',
                'uomid' => '9D127D79-0E84-417F-B319-2612E5F1D102',
                'updated_at' => NULL,
            ),
            6 =>
            array (
                'created_at' => NULL,
                'description' => '--BASE UOM--',
                'id' => 7,
                'isactive' => '1',
                'stocks_id' => 1,
                'uomcode' => 'BOX',
                'uomid' => '34E8AEB6-55BF-4438-8764-26C64DCFB86F',
                'updated_at' => '2020-11-28 11:19:14',
            ),
            7 =>
            array (
                'created_at' => NULL,
                'description' => '--BASE UOM--',
                'id' => 8,
                'isactive' => '1',
                'stocks_id' => 2,
                'uomcode' => 'UNIT',
                'uomid' => '6D090A30-1BD4-48C3-9F3E-2A448748FC85',
                'updated_at' => NULL,
            ),
            8 =>
            array (
                'created_at' => NULL,
                'description' => '--BASE UOM--',
                'id' => 9,
                'isactive' => '1',
                'stocks_id' => 28,
                'uomcode' => 'UNIT',
                'uomid' => 'DE52240C-9173-4CE5-8798-3C784B0CB456',
                'updated_at' => NULL,
            ),
            9 =>
            array (
                'created_at' => '2020-12-11 09:22:14',
                'description' => '--BASE UOM--',
                'id' => 77,
                'isactive' => '1',
                'stocks_id' => 80,
                'uomcode' => 'UNIT',
                'uomid' => NULL,
                'updated_at' => NULL,
            ),
            10 =>
            array (
                'created_at' => NULL,
                'description' => '--BASE UOM--',
                'id' => 11,
                'isactive' => '1',
                'stocks_id' => 8,
                'uomcode' => 'UNIT',
                'uomid' => '1A98DE49-D0C4-4008-AF76-45D67D7D6A2B',
                'updated_at' => NULL,
            ),
            11 =>
            array (
                'created_at' => NULL,
                'description' => '--BASE UOM--',
                'id' => 12,
                'isactive' => '1',
                'stocks_id' => 17,
                'uomcode' => 'BOX',
                'uomid' => 'ECCCC2E9-8DAE-4A13-9FEB-4A3A1CE868C9',
                'updated_at' => '2020-11-28 11:19:01',
            ),
            12 =>
            array (
                'created_at' => '2020-12-11 09:22:14',
                'description' => '--BASE UOM--',
                'id' => 76,
                'isactive' => '1',
                'stocks_id' => 79,
                'uomcode' => 'UNIT',
                'uomid' => NULL,
                'updated_at' => NULL,
            ),
            13 =>
            array (
                'created_at' => NULL,
                'description' => '--BASE UOM--',
                'id' => 14,
                'isactive' => '1',
                'stocks_id' => 19,
                'uomcode' => 'UNIT',
                'uomid' => 'C1B8DD70-560B-42C9-94A8-5A240CBDEA72',
                'updated_at' => NULL,
            ),
            14 =>
            array (
                'created_at' => NULL,
                'description' => '--BASE UOM--',
                'id' => 15,
                'isactive' => '1',
                'stocks_id' => 15,
                'uomcode' => 'UNIT',
                'uomid' => '6A0B7FD1-A39B-42E2-9CF4-5BC20109BAF8',
                'updated_at' => NULL,
            ),
            15 =>
            array (
                'created_at' => NULL,
                'description' => '--BASE UOM--',
                'id' => 16,
                'isactive' => '1',
                'stocks_id' => 6,
                'uomcode' => 'BOX',
                'uomid' => 'EC3EC252-323E-4D18-9A68-5CEE489702B8',
                'updated_at' => '2020-11-28 11:19:37',
            ),
            16 =>
            array (
                'created_at' => '2020-12-11 09:22:14',
                'description' => '--BASE UOM--',
                'id' => 75,
                'isactive' => '1',
                'stocks_id' => 78,
                'uomcode' => 'UNIT',
                'uomid' => NULL,
                'updated_at' => NULL,
            ),
            17 =>
            array (
                'created_at' => NULL,
                'description' => 'BOX',
                'id' => 18,
                'isactive' => '1',
                'stocks_id' => 17,
                'uomcode' => 'BOX',
                'uomid' => '7C71762D-AB34-4763-B8D6-71B0A2DEB7B8',
                'updated_at' => NULL,
            ),
            18 =>
            array (
                'created_at' => '2020-12-11 09:22:14',
                'description' => '--BASE UOM--',
                'id' => 74,
                'isactive' => '1',
                'stocks_id' => 77,
                'uomcode' => 'UNIT',
                'uomid' => NULL,
                'updated_at' => NULL,
            ),
            19 =>
            array (
                'created_at' => '2020-12-11 09:22:14',
                'description' => '--BASE UOM--',
                'id' => 73,
                'isactive' => '1',
                'stocks_id' => 76,
                'uomcode' => 'UNIT',
                'uomid' => NULL,
                'updated_at' => NULL,
            ),
            20 =>
            array (
                'created_at' => '2020-12-11 09:22:14',
                'description' => '--BASE UOM--',
                'id' => 72,
                'isactive' => '1',
                'stocks_id' => 74,
                'uomcode' => 'UNIT',
                'uomid' => NULL,
                'updated_at' => NULL,
            ),
            21 =>
            array (
                'created_at' => NULL,
                'description' => '--BASE UOM--',
                'id' => 22,
                'isactive' => '1',
                'stocks_id' => 11,
                'uomcode' => 'UNIT',
                'uomid' => '0E7748E9-9F82-4700-8C9A-A9B55071AE74',
                'updated_at' => NULL,
            ),
            22 =>
            array (
                'created_at' => '2020-12-11 09:22:14',
                'description' => '--BASE UOM--',
                'id' => 71,
                'isactive' => '1',
                'stocks_id' => 68,
                'uomcode' => 'UNIT',
                'uomid' => NULL,
                'updated_at' => NULL,
            ),
            23 =>
            array (
                'created_at' => NULL,
                'description' => '--BASE UOM--',
                'id' => 24,
                'isactive' => '1',
                'stocks_id' => 9,
                'uomcode' => 'UNIT',
                'uomid' => '8E205034-04B2-424B-B03D-BE78559F7359',
                'updated_at' => NULL,
            ),
            24 =>
            array (
                'created_at' => NULL,
                'description' => '--BASE UOM--',
                'id' => 25,
                'isactive' => '1',
                'stocks_id' => 26,
                'uomcode' => 'UNIT',
                'uomid' => 'C84606D5-E920-4B05-9283-C15662B67907',
                'updated_at' => NULL,
            ),
            25 =>
            array (
                'created_at' => '2020-12-11 09:22:14',
                'description' => '--BASE UOM--',
                'id' => 70,
                'isactive' => '1',
                'stocks_id' => 67,
                'uomcode' => 'UNIT',
                'uomid' => NULL,
                'updated_at' => NULL,
            ),
            26 =>
            array (
                'created_at' => NULL,
                'description' => '--BASE UOM--',
                'id' => 27,
                'isactive' => '1',
                'stocks_id' => 20,
                'uomcode' => 'UNIT',
                'uomid' => 'C17AB81C-A376-402E-A979-C48BC87C081E',
                'updated_at' => NULL,
            ),
            27 =>
            array (
                'created_at' => NULL,
                'description' => '--BASE UOM--',
                'id' => 28,
                'isactive' => '1',
                'stocks_id' => 23,
                'uomcode' => 'UNIT',
                'uomid' => 'BD1E9C22-DB95-49BB-8EB7-E66912BCC45B',
                'updated_at' => NULL,
            ),
            28 =>
            array (
                'created_at' => '2020-12-11 09:22:14',
                'description' => '--BASE UOM--',
                'id' => 69,
                'isactive' => '1',
                'stocks_id' => 61,
                'uomcode' => 'UNIT',
                'uomid' => NULL,
                'updated_at' => NULL,
            ),
            29 =>
            array (
                'created_at' => NULL,
                'description' => '--BASE UOM--',
                'id' => 30,
                'isactive' => '1',
                'stocks_id' => 24,
                'uomcode' => 'UNIT',
                'uomid' => 'CEA6156A-7649-4A14-8D15-F028BB92E042',
                'updated_at' => NULL,
            ),
            30 =>
            array (
                'created_at' => '2020-12-11 09:22:14',
                'description' => '--BASE UOM--',
                'id' => 68,
                'isactive' => '1',
                'stocks_id' => 39,
                'uomcode' => 'UNIT',
                'uomid' => NULL,
                'updated_at' => NULL,
            ),
            31 =>
            array (
                'created_at' => '2019-12-18 14:33:02',
                'description' => '1 BOX = 200 FANS.',
                'id' => 32,
                'isactive' => '1',
                'stocks_id' => 6,
                'uomcode' => 'BOX',
                'uomid' => NULL,
                'updated_at' => '2020-11-28 11:19:54',
            ),
            32 =>
            array (
                'created_at' => '2020-01-07 09:06:07',
                'description' => '-BASE UOM-',
                'id' => 33,
                'isactive' => '1',
                'stocks_id' => 15,
                'uomcode' => 'BOX',
                'uomid' => NULL,
                'updated_at' => '2020-11-28 10:09:09',
            ),
            33 =>
            array (
                'created_at' => '2020-07-08 10:35:09',
                'description' => '--BASE UOM--',
                'id' => 35,
                'isactive' => '1',
                'stocks_id' => 36,
                'uomcode' => 'UNIT',
                'uomid' => NULL,
                'updated_at' => '2020-07-08 10:35:43',
            ),
            34 =>
            array (
                'created_at' => '2020-07-08 10:36:01',
                'description' => '--BASE UOM--',
                'id' => 36,
                'isactive' => '1',
                'stocks_id' => 42,
                'uomcode' => 'UNIT',
                'uomid' => NULL,
                'updated_at' => '2020-07-08 10:36:01',
            ),
            35 =>
            array (
                'created_at' => '2020-07-08 10:36:18',
                'description' => '--BASE UOM--',
                'id' => 37,
                'isactive' => '1',
                'stocks_id' => 43,
                'uomcode' => 'UNIT',
                'uomid' => NULL,
                'updated_at' => '2020-07-08 10:36:18',
            ),
            36 =>
            array (
                'created_at' => '2020-07-08 10:36:37',
                'description' => '--BASE UOM--',
                'id' => 38,
                'isactive' => '1',
                'stocks_id' => 44,
                'uomcode' => 'UNIT',
                'uomid' => NULL,
                'updated_at' => '2020-07-08 10:36:37',
            ),
            37 =>
            array (
                'created_at' => '2020-07-08 10:36:51',
                'description' => '--BASE UOM--',
                'id' => 39,
                'isactive' => '1',
                'stocks_id' => 44,
                'uomcode' => 'UNIT',
                'uomid' => NULL,
                'updated_at' => '2020-07-08 10:36:51',
            ),
            38 =>
            array (
                'created_at' => '2020-07-08 10:37:04',
                'description' => '--BASE UOM--',
                'id' => 40,
                'isactive' => '1',
                'stocks_id' => 45,
                'uomcode' => 'UNIT',
                'uomid' => NULL,
                'updated_at' => '2020-07-08 10:37:04',
            ),
            39 =>
            array (
                'created_at' => '2020-07-08 10:37:16',
                'description' => '--BASE UOM--',
                'id' => 41,
                'isactive' => '1',
                'stocks_id' => 46,
                'uomcode' => 'UNIT',
                'uomid' => NULL,
                'updated_at' => '2020-07-08 10:37:16',
            ),
            40 =>
            array (
                'created_at' => '2020-07-08 10:37:29',
                'description' => '--BASE UOM--',
                'id' => 42,
                'isactive' => '1',
                'stocks_id' => 55,
                'uomcode' => 'UNIT',
                'uomid' => NULL,
                'updated_at' => '2020-07-08 10:37:29',
            ),
            41 =>
            array (
                'created_at' => '2020-07-08 10:37:43',
                'description' => '--BASE UOM--',
                'id' => 43,
                'isactive' => '1',
                'stocks_id' => 56,
                'uomcode' => 'UNIT',
                'uomid' => NULL,
                'updated_at' => '2020-07-08 10:37:43',
            ),
            42 =>
            array (
                'created_at' => '2020-12-18 10:46:55',
                'description' => '--BASE UOM--',
                'id' => 84,
                'isactive' => '1',
                'stocks_id' => 90,
                'uomcode' => 'UNIT',
                'uomid' => NULL,
                'updated_at' => '2020-12-18 10:46:55',
            ),
            43 =>
            array (
                'created_at' => '2020-07-08 10:38:09',
                'description' => '--BASE UOM--',
                'id' => 45,
                'isactive' => '1',
                'stocks_id' => 59,
                'uomcode' => 'UNIT',
                'uomid' => NULL,
                'updated_at' => '2020-07-08 10:38:09',
            ),
            44 =>
            array (
                'created_at' => '2020-07-08 10:38:23',
                'description' => '--BASE UOM--',
                'id' => 46,
                'isactive' => '1',
                'stocks_id' => 60,
                'uomcode' => 'UNIT',
                'uomid' => NULL,
                'updated_at' => '2020-07-08 10:38:23',
            ),
            45 =>
            array (
                'created_at' => '2020-07-08 10:38:35',
                'description' => '--BASE UOM--',
                'id' => 47,
                'isactive' => '1',
                'stocks_id' => 70,
                'uomcode' => 'UNIT',
                'uomid' => NULL,
                'updated_at' => '2020-07-08 10:38:35',
            ),
            46 =>
            array (
                'created_at' => '2020-07-08 10:41:23',
                'description' => '--BASE UOM--',
                'id' => 49,
                'isactive' => '1',
                'stocks_id' => 64,
                'uomcode' => 'UNIT',
                'uomid' => NULL,
                'updated_at' => '2020-07-08 10:41:23',
            ),
            47 =>
            array (
                'created_at' => '2020-07-08 10:41:36',
                'description' => '--BASE UOM--',
                'id' => 50,
                'isactive' => '1',
                'stocks_id' => 65,
                'uomcode' => 'UNIT',
                'uomid' => NULL,
                'updated_at' => '2020-07-08 10:41:36',
            ),
            48 =>
            array (
                'created_at' => '2020-07-08 10:41:47',
                'description' => '--BASE UOM--',
                'id' => 51,
                'isactive' => '1',
                'stocks_id' => 66,
                'uomcode' => 'UNIT',
                'uomid' => NULL,
                'updated_at' => '2020-07-08 10:41:47',
            ),
            49 =>
            array (
                'created_at' => '2020-07-08 10:43:43',
                'description' => '--BASE UOM--',
                'id' => 52,
                'isactive' => '1',
                'stocks_id' => 53,
                'uomcode' => 'UNIT',
                'uomid' => NULL,
                'updated_at' => '2020-07-08 10:43:43',
            ),
            50 =>
            array (
                'created_at' => '2020-07-08 10:45:44',
                'description' => '--BASE UOM--',
                'id' => 53,
                'isactive' => '1',
                'stocks_id' => 54,
                'uomcode' => 'UNIT',
                'uomid' => NULL,
                'updated_at' => '2020-07-08 10:45:44',
            ),
            51 =>
            array (
                'created_at' => '2020-07-08 10:45:57',
                'description' => '--BASE UOM--',
                'id' => 54,
                'isactive' => '1',
                'stocks_id' => 57,
                'uomcode' => 'UNIT',
                'uomid' => NULL,
                'updated_at' => '2020-07-08 10:45:57',
            ),
            52 =>
            array (
                'created_at' => '2020-07-08 10:46:47',
                'description' => '--BASE UOM--',
                'id' => 55,
                'isactive' => '1',
                'stocks_id' => 51,
                'uomcode' => 'UNIT',
                'uomid' => NULL,
                'updated_at' => '2020-07-08 10:46:47',
            ),
            53 =>
            array (
                'created_at' => '2020-07-08 10:46:58',
                'description' => '--BASE UOM--',
                'id' => 56,
                'isactive' => '1',
                'stocks_id' => 52,
                'uomcode' => 'UNIT',
                'uomid' => NULL,
                'updated_at' => '2020-07-08 10:46:58',
            ),
            54 =>
            array (
                'created_at' => '2020-07-08 10:49:00',
                'description' => '--BASE UOM--',
                'id' => 57,
                'isactive' => '1',
                'stocks_id' => 48,
                'uomcode' => 'UNIT',
                'uomid' => NULL,
                'updated_at' => '2020-07-08 10:49:00',
            ),
            55 =>
            array (
                'created_at' => '2020-07-08 10:49:24',
                'description' => '--BASE UOM--',
                'id' => 58,
                'isactive' => '1',
                'stocks_id' => 37,
                'uomcode' => 'UNIT',
                'uomid' => NULL,
                'updated_at' => '2020-07-08 10:49:24',
            ),
            56 =>
            array (
                'created_at' => '2020-07-08 10:49:51',
                'description' => '--BASE UOM--',
                'id' => 59,
                'isactive' => '1',
                'stocks_id' => 38,
                'uomcode' => 'UNIT',
                'uomid' => NULL,
                'updated_at' => '2020-07-08 10:49:51',
            ),
            57 =>
            array (
                'created_at' => '2020-07-08 10:51:30',
                'description' => '--BASE UOM--',
                'id' => 60,
                'isactive' => '1',
                'stocks_id' => 69,
                'uomcode' => 'UNIT',
                'uomid' => NULL,
                'updated_at' => '2020-07-08 10:51:30',
            ),
            58 =>
            array (
                'created_at' => '2020-07-08 10:51:41',
                'description' => '--BASE UOM--',
                'id' => 61,
                'isactive' => '1',
                'stocks_id' => 47,
                'uomcode' => 'UNIT',
                'uomid' => NULL,
                'updated_at' => '2020-07-08 10:51:41',
            ),
            59 =>
            array (
                'created_at' => '2020-07-08 10:52:55',
                'description' => '--BASE UOM--',
                'id' => 62,
                'isactive' => '1',
                'stocks_id' => 40,
                'uomcode' => 'ROLL',
                'uomid' => NULL,
                'updated_at' => '2020-11-28 11:20:14',
            ),
            60 =>
            array (
                'created_at' => '2020-07-08 10:53:06',
                'description' => '--BASE UOM--',
                'id' => 63,
                'isactive' => '1',
                'stocks_id' => 41,
                'uomcode' => 'UNIT',
                'uomid' => NULL,
                'updated_at' => '2020-07-08 10:53:06',
            ),
            61 =>
            array (
                'created_at' => '2020-07-08 10:54:27',
                'description' => '--BASE UOM--',
                'id' => 64,
                'isactive' => '1',
                'stocks_id' => 49,
                'uomcode' => 'UNIT',
                'uomid' => NULL,
                'updated_at' => '2020-07-08 10:54:27',
            ),
            62 =>
            array (
                'created_at' => '2020-07-08 10:54:40',
                'description' => '--BASE UOM--',
                'id' => 65,
                'isactive' => '1',
                'stocks_id' => 58,
                'uomcode' => 'UNIT',
                'uomid' => NULL,
                'updated_at' => '2020-07-08 10:54:40',
            ),
            63 =>
            array (
                'created_at' => '2020-07-14 14:33:27',
                'description' => '--BASE UOM--',
                'id' => 66,
                'isactive' => '1',
                'stocks_id' => 73,
                'uomcode' => 'BOX',
                'uomid' => NULL,
                'updated_at' => '2021-02-19 11:31:45',
            ),
            64 =>
            array (
                'created_at' => '2020-12-11 09:22:14',
                'description' => '--BASE UOM--',
                'id' => 78,
                'isactive' => '1',
                'stocks_id' => 81,
                'uomcode' => 'UNIT',
                'uomid' => NULL,
                'updated_at' => NULL,
            ),
            65 =>
            array (
                'created_at' => '2020-12-11 09:22:14',
                'description' => '--BASE UOM--',
                'id' => 79,
                'isactive' => '1',
                'stocks_id' => 83,
                'uomcode' => 'UNIT',
                'uomid' => NULL,
                'updated_at' => NULL,
            ),
            66 =>
            array (
                'created_at' => '2020-12-11 09:22:14',
                'description' => '--BASE UOM--',
                'id' => 80,
                'isactive' => '1',
                'stocks_id' => 84,
                'uomcode' => 'UNIT',
                'uomid' => NULL,
                'updated_at' => NULL,
            ),
            67 =>
            array (
                'created_at' => '2020-12-11 09:22:14',
                'description' => '--BASE UOM--',
                'id' => 81,
                'isactive' => '1',
                'stocks_id' => 85,
                'uomcode' => 'UNIT',
                'uomid' => NULL,
                'updated_at' => NULL,
            ),
            68 =>
            array (
                'created_at' => '2020-12-14 05:44:39',
                'description' => '--BASE UOM--',
                'id' => 82,
                'isactive' => '1',
                'stocks_id' => 88,
                'uomcode' => 'UNIT',
                'uomid' => NULL,
                'updated_at' => '2020-12-14 05:44:39',
            ),
            69 =>
            array (
                'created_at' => '2020-12-15 06:15:26',
                'description' => '--BASE UOM--',
                'id' => 83,
                'isactive' => '1',
                'stocks_id' => 89,
                'uomcode' => 'BOX',
                'uomid' => NULL,
                'updated_at' => '2022-12-13 10:01:38',
            ),
            70 =>
            array (
                'created_at' => '2020-12-20 09:04:06',
                'description' => '--BASE UOM--',
                'id' => 85,
                'isactive' => '1',
                'stocks_id' => 91,
                'uomcode' => 'UNIT',
                'uomid' => NULL,
                'updated_at' => '2020-12-20 09:04:06',
            ),
            71 =>
            array (
                'created_at' => '2020-12-28 08:24:41',
                'description' => '--BASE UOM--',
                'id' => 86,
                'isactive' => '1',
                'stocks_id' => 92,
                'uomcode' => 'UNIT',
                'uomid' => NULL,
                'updated_at' => '2020-12-28 08:24:41',
            ),
            72 =>
            array (
                'created_at' => '2021-03-22 12:40:44',
                'description' => '--BASE UOM--',
                'id' => 90,
                'isactive' => '1',
                'stocks_id' => 96,
                'uomcode' => 'UNIT',
                'uomid' => NULL,
                'updated_at' => '2021-03-22 12:40:44',
            ),
            73 =>
            array (
                'created_at' => '2021-01-02 11:08:29',
                'description' => '--BASE UOM--',
                'id' => 88,
                'isactive' => '1',
                'stocks_id' => 94,
                'uomcode' => 'UNIT',
                'uomid' => NULL,
                'updated_at' => '2021-01-02 11:08:29',
            ),
            74 =>
            array (
                'created_at' => '2021-01-29 13:42:38',
                'description' => '--BASE UOM--',
                'id' => 89,
                'isactive' => '1',
                'stocks_id' => 95,
                'uomcode' => 'BOX',
                'uomid' => NULL,
                'updated_at' => '2021-01-29 14:02:06',
            ),
            75 =>
            array (
                'created_at' => '2021-06-10 06:40:06',
                'description' => '--BASE UOM--',
                'id' => 91,
                'isactive' => '1',
                'stocks_id' => 97,
                'uomcode' => 'UNIT',
                'uomid' => NULL,
                'updated_at' => '2021-06-10 06:40:06',
            ),
            76 =>
            array (
                'created_at' => '2021-09-09 14:58:59',
                'description' => '--BASE UOM--',
                'id' => 92,
                'isactive' => '1',
                'stocks_id' => 98,
                'uomcode' => 'UNIT',
                'uomid' => NULL,
                'updated_at' => '2021-09-09 14:58:59',
            ),
            77 =>
            array (
                'created_at' => '2021-11-30 08:13:11',
                'description' => '--BASE UOM--',
                'id' => 93,
                'isactive' => '1',
                'stocks_id' => 99,
                'uomcode' => 'UNIT',
                'uomid' => NULL,
                'updated_at' => '2021-11-30 08:13:11',
            ),
            78 =>
            array (
                'created_at' => '2021-11-30 08:14:56',
                'description' => '--BASE UOM--',
                'id' => 94,
                'isactive' => '1',
                'stocks_id' => 100,
                'uomcode' => 'UNIT',
                'uomid' => NULL,
                'updated_at' => '2021-11-30 08:14:56',
            ),
            79 =>
            array (
                'created_at' => '2021-11-30 08:17:01',
                'description' => '--BASE UOM--',
                'id' => 95,
                'isactive' => '1',
                'stocks_id' => 101,
                'uomcode' => 'UNIT',
                'uomid' => NULL,
                'updated_at' => '2021-11-30 08:17:01',
            ),
            80 =>
            array (
                'created_at' => '2021-11-30 08:19:21',
                'description' => '--BASE UOM--',
                'id' => 96,
                'isactive' => '1',
                'stocks_id' => 102,
                'uomcode' => 'UNIT',
                'uomid' => NULL,
                'updated_at' => '2021-11-30 08:19:21',
            ),
            81 =>
            array (
                'created_at' => '2021-11-30 08:20:57',
                'description' => '--BASE UOM--',
                'id' => 97,
                'isactive' => '1',
                'stocks_id' => 103,
                'uomcode' => 'UNIT',
                'uomid' => NULL,
                'updated_at' => '2021-11-30 08:20:57',
            ),
            82 =>
            array (
                'created_at' => '2021-11-30 08:59:07',
                'description' => '--BASE UOM--',
                'id' => 98,
                'isactive' => '1',
                'stocks_id' => 104,
                'uomcode' => 'UNIT',
                'uomid' => NULL,
                'updated_at' => '2021-11-30 08:59:07',
            ),
            83 =>
            array (
                'created_at' => '2021-11-30 09:00:24',
                'description' => '--BASE UOM--',
                'id' => 99,
                'isactive' => '1',
                'stocks_id' => 105,
                'uomcode' => 'UNIT',
                'uomid' => NULL,
                'updated_at' => '2021-11-30 09:00:24',
            ),
            84 =>
            array (
                'created_at' => '2021-11-30 09:02:08',
                'description' => '--BASE UOM--',
                'id' => 100,
                'isactive' => '1',
                'stocks_id' => 106,
                'uomcode' => 'UNIT',
                'uomid' => NULL,
                'updated_at' => '2021-11-30 09:02:08',
            ),
            85 =>
            array (
                'created_at' => '2021-11-30 09:03:16',
                'description' => '--BASE UOM--',
                'id' => 101,
                'isactive' => '1',
                'stocks_id' => 107,
                'uomcode' => 'UNIT',
                'uomid' => NULL,
                'updated_at' => '2021-11-30 09:03:16',
            ),
            86 =>
            array (
                'created_at' => '2022-03-28 11:12:12',
                'description' => '--BASE UOM--',
                'id' => 102,
                'isactive' => '1',
                'stocks_id' => 108,
                'uomcode' => 'UNIT',
                'uomid' => NULL,
                'updated_at' => '2022-03-28 11:12:12',
            ),
            87 =>
            array (
                'created_at' => '2022-04-14 08:40:22',
                'description' => '--BASE UOM--',
                'id' => 103,
                'isactive' => '1',
                'stocks_id' => 109,
                'uomcode' => 'UNIT',
                'uomid' => NULL,
                'updated_at' => '2022-04-14 08:40:22',
            ),
            88 =>
            array (
                'created_at' => '2022-06-08 07:17:24',
                'description' => '--BASE UOM--',
                'id' => 104,
                'isactive' => '1',
                'stocks_id' => 110,
                'uomcode' => 'UNIT',
                'uomid' => NULL,
                'updated_at' => '2022-06-08 07:17:24',
            ),
            89 =>
            array (
                'created_at' => '2023-02-27 08:33:47',
                'description' => '--BASE UOM--',
                'id' => 105,
                'isactive' => '1',
                'stocks_id' => 111,
                'uomcode' => 'UNIT',
                'uomid' => NULL,
                'updated_at' => '2023-02-27 08:33:47',
            ),
        ));


    }
}
