<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;

class CustomerGroupDetailsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        
		Schema::disableForeignKeyConstraints();
        \DB::table('customer_groups_customers')->delete();
        
        \DB::table('customer_groups_customers')->insert(array (
            0 => 
            array (
                'created_at' => '2020-04-05 08:31:45',
                'customer_groups_id' => 2,
                'customers_id' => 502,
                'id' => 16,
                'updated_at' => '2020-04-05 08:31:45',
            ),
            1 => 
            array (
                'created_at' => '2020-06-12 14:02:19',
                'customer_groups_id' => 18,
                'customers_id' => 219,
                'id' => 173,
                'updated_at' => '2020-06-12 14:02:19',
            ),
            2 => 
            array (
                'created_at' => '2020-04-05 08:29:16',
                'customer_groups_id' => 2,
                'customers_id' => 658,
                'id' => 6,
                'updated_at' => '2020-04-05 08:29:16',
            ),
            3 => 
            array (
                'created_at' => '2020-04-05 08:29:16',
                'customer_groups_id' => 2,
                'customers_id' => 179,
                'id' => 5,
                'updated_at' => '2020-04-05 08:29:16',
            ),
            4 => 
            array (
                'created_at' => '2020-04-05 08:29:16',
                'customer_groups_id' => 2,
                'customers_id' => 618,
                'id' => 9,
                'updated_at' => '2020-04-05 08:29:16',
            ),
            5 => 
            array (
                'created_at' => '2020-04-05 08:29:16',
                'customer_groups_id' => 2,
                'customers_id' => 228,
                'id' => 10,
                'updated_at' => '2020-04-05 08:29:16',
            ),
            6 => 
            array (
                'created_at' => '2020-04-05 08:29:16',
                'customer_groups_id' => 2,
                'customers_id' => 550,
                'id' => 11,
                'updated_at' => '2020-04-05 08:29:16',
            ),
            7 => 
            array (
                'created_at' => '2020-04-05 08:29:16',
                'customer_groups_id' => 2,
                'customers_id' => 484,
                'id' => 12,
                'updated_at' => '2020-04-05 08:29:16',
            ),
            8 => 
            array (
                'created_at' => '2020-04-05 08:29:16',
                'customer_groups_id' => 2,
                'customers_id' => 406,
                'id' => 13,
                'updated_at' => '2020-04-05 08:29:16',
            ),
            9 => 
            array (
                'created_at' => '2020-04-05 08:29:16',
                'customer_groups_id' => 2,
                'customers_id' => 501,
                'id' => 14,
                'updated_at' => '2020-04-05 08:29:16',
            ),
            10 => 
            array (
                'created_at' => '2020-04-05 08:29:16',
                'customer_groups_id' => 2,
                'customers_id' => 591,
                'id' => 15,
                'updated_at' => '2020-04-05 08:29:16',
            ),
            11 => 
            array (
                'created_at' => '2020-04-05 08:40:23',
                'customer_groups_id' => 3,
                'customers_id' => 592,
                'id' => 17,
                'updated_at' => '2020-04-05 08:40:23',
            ),
            12 => 
            array (
                'created_at' => '2020-04-05 08:40:23',
                'customer_groups_id' => 3,
                'customers_id' => 629,
                'id' => 18,
                'updated_at' => '2020-04-05 08:40:23',
            ),
            13 => 
            array (
                'created_at' => '2020-04-05 08:40:23',
                'customer_groups_id' => 3,
                'customers_id' => 648,
                'id' => 19,
                'updated_at' => '2020-04-05 08:40:23',
            ),
            14 => 
            array (
                'created_at' => '2020-04-05 08:40:23',
                'customer_groups_id' => 3,
                'customers_id' => 216,
                'id' => 20,
                'updated_at' => '2020-04-05 08:40:23',
            ),
            15 => 
            array (
                'created_at' => '2020-04-05 08:40:23',
                'customer_groups_id' => 3,
                'customers_id' => 23,
                'id' => 21,
                'updated_at' => '2020-04-05 08:40:23',
            ),
            16 => 
            array (
                'created_at' => '2020-04-05 08:40:23',
                'customer_groups_id' => 3,
                'customers_id' => 630,
                'id' => 22,
                'updated_at' => '2020-04-05 08:40:23',
            ),
            17 => 
            array (
                'created_at' => '2020-04-05 08:40:23',
                'customer_groups_id' => 3,
                'customers_id' => 619,
                'id' => 23,
                'updated_at' => '2020-04-05 08:40:23',
            ),
            18 => 
            array (
                'created_at' => '2020-04-05 08:40:23',
                'customer_groups_id' => 3,
                'customers_id' => 158,
                'id' => 24,
                'updated_at' => '2020-04-05 08:40:23',
            ),
            19 => 
            array (
                'created_at' => '2020-04-05 08:40:23',
                'customer_groups_id' => 3,
                'customers_id' => 566,
                'id' => 25,
                'updated_at' => '2020-04-05 08:40:23',
            ),
            20 => 
            array (
                'created_at' => '2020-04-05 08:40:23',
                'customer_groups_id' => 3,
                'customers_id' => 400,
                'id' => 26,
                'updated_at' => '2020-04-05 08:40:23',
            ),
            21 => 
            array (
                'created_at' => '2020-04-05 08:40:23',
                'customer_groups_id' => 3,
                'customers_id' => 300,
                'id' => 27,
                'updated_at' => '2020-04-05 08:40:23',
            ),
            22 => 
            array (
                'created_at' => '2020-04-05 08:40:23',
                'customer_groups_id' => 3,
                'customers_id' => 296,
                'id' => 28,
                'updated_at' => '2020-04-05 08:40:23',
            ),
            23 => 
            array (
                'created_at' => '2020-04-05 08:40:23',
                'customer_groups_id' => 3,
                'customers_id' => 174,
                'id' => 29,
                'updated_at' => '2020-04-05 08:40:23',
            ),
            24 => 
            array (
                'created_at' => '2020-04-05 08:40:23',
                'customer_groups_id' => 3,
                'customers_id' => 121,
                'id' => 30,
                'updated_at' => '2020-04-05 08:40:23',
            ),
            25 => 
            array (
                'created_at' => '2020-04-05 08:40:23',
                'customer_groups_id' => 3,
                'customers_id' => 611,
                'id' => 31,
                'updated_at' => '2020-04-05 08:40:23',
            ),
            26 => 
            array (
                'created_at' => '2020-04-05 08:40:23',
                'customer_groups_id' => 3,
                'customers_id' => 178,
                'id' => 32,
                'updated_at' => '2020-04-05 08:40:23',
            ),
            27 => 
            array (
                'created_at' => '2020-04-05 08:40:23',
                'customer_groups_id' => 3,
                'customers_id' => 98,
                'id' => 33,
                'updated_at' => '2020-04-05 08:40:23',
            ),
            28 => 
            array (
                'created_at' => '2020-04-05 08:40:23',
                'customer_groups_id' => 3,
                'customers_id' => 325,
                'id' => 34,
                'updated_at' => '2020-04-05 08:40:23',
            ),
            29 => 
            array (
                'created_at' => '2020-04-05 08:42:19',
                'customer_groups_id' => 4,
                'customers_id' => 68,
                'id' => 35,
                'updated_at' => '2020-04-05 08:42:19',
            ),
            30 => 
            array (
                'created_at' => '2020-04-05 08:42:19',
                'customer_groups_id' => 4,
                'customers_id' => 395,
                'id' => 36,
                'updated_at' => '2020-04-05 08:42:19',
            ),
            31 => 
            array (
                'created_at' => '2020-04-05 08:42:19',
                'customer_groups_id' => 4,
                'customers_id' => 379,
                'id' => 37,
                'updated_at' => '2020-04-05 08:42:19',
            ),
            32 => 
            array (
                'created_at' => '2020-04-05 08:42:19',
                'customer_groups_id' => 4,
                'customers_id' => 390,
                'id' => 38,
                'updated_at' => '2020-04-05 08:42:19',
            ),
            33 => 
            array (
                'created_at' => '2020-04-05 08:42:19',
                'customer_groups_id' => 4,
                'customers_id' => 582,
                'id' => 39,
                'updated_at' => '2020-04-05 08:42:19',
            ),
            34 => 
            array (
                'created_at' => '2020-04-05 08:42:19',
                'customer_groups_id' => 4,
                'customers_id' => 518,
                'id' => 40,
                'updated_at' => '2020-04-05 08:42:19',
            ),
            35 => 
            array (
                'created_at' => '2020-04-05 08:44:09',
                'customer_groups_id' => 5,
                'customers_id' => 171,
                'id' => 41,
                'updated_at' => '2020-04-05 08:44:09',
            ),
            36 => 
            array (
                'created_at' => '2020-04-05 08:44:09',
                'customer_groups_id' => 5,
                'customers_id' => 444,
                'id' => 42,
                'updated_at' => '2020-04-05 08:44:09',
            ),
            37 => 
            array (
                'created_at' => '2020-04-05 08:44:09',
                'customer_groups_id' => 5,
                'customers_id' => 650,
                'id' => 43,
                'updated_at' => '2020-04-05 08:44:09',
            ),
            38 => 
            array (
                'created_at' => '2020-04-05 08:44:09',
                'customer_groups_id' => 5,
                'customers_id' => 164,
                'id' => 44,
                'updated_at' => '2020-04-05 08:44:09',
            ),
            39 => 
            array (
                'created_at' => '2020-04-05 08:44:57',
                'customer_groups_id' => 6,
                'customers_id' => 538,
                'id' => 45,
                'updated_at' => '2020-04-05 08:44:57',
            ),
            40 => 
            array (
                'created_at' => '2020-04-05 08:44:57',
                'customer_groups_id' => 6,
                'customers_id' => 483,
                'id' => 46,
                'updated_at' => '2020-04-05 08:44:57',
            ),
            41 => 
            array (
                'created_at' => '2020-04-05 08:45:46',
                'customer_groups_id' => 7,
                'customers_id' => 182,
                'id' => 47,
                'updated_at' => '2020-04-05 08:45:46',
            ),
            42 => 
            array (
                'created_at' => '2020-04-05 08:45:46',
                'customer_groups_id' => 7,
                'customers_id' => 405,
                'id' => 48,
                'updated_at' => '2020-04-05 08:45:46',
            ),
            43 => 
            array (
                'created_at' => '2020-04-05 16:39:45',
                'customer_groups_id' => 10,
                'customers_id' => 124,
                'id' => 56,
                'updated_at' => '2020-04-05 16:39:45',
            ),
            44 => 
            array (
                'created_at' => '2020-04-05 16:39:45',
                'customer_groups_id' => 10,
                'customers_id' => 578,
                'id' => 55,
                'updated_at' => '2020-04-05 16:39:45',
            ),
            45 => 
            array (
                'created_at' => '2020-04-05 16:39:45',
                'customer_groups_id' => 10,
                'customers_id' => 410,
                'id' => 54,
                'updated_at' => '2020-04-05 16:39:45',
            ),
            46 => 
            array (
                'created_at' => '2020-04-05 16:39:45',
                'customer_groups_id' => 10,
                'customers_id' => 140,
                'id' => 57,
                'updated_at' => '2020-04-05 16:39:45',
            ),
            47 => 
            array (
                'created_at' => '2020-04-05 16:39:45',
                'customer_groups_id' => 10,
                'customers_id' => 469,
                'id' => 58,
                'updated_at' => '2020-04-05 16:39:45',
            ),
            48 => 
            array (
                'created_at' => '2020-04-05 16:39:45',
                'customer_groups_id' => 10,
                'customers_id' => 165,
                'id' => 59,
                'updated_at' => '2020-04-05 16:39:45',
            ),
            49 => 
            array (
                'created_at' => '2020-04-05 16:39:45',
                'customer_groups_id' => 10,
                'customers_id' => 479,
                'id' => 60,
                'updated_at' => '2020-04-05 16:39:45',
            ),
            50 => 
            array (
                'created_at' => '2020-04-05 16:39:45',
                'customer_groups_id' => 10,
                'customers_id' => 96,
                'id' => 61,
                'updated_at' => '2020-04-05 16:39:45',
            ),
            51 => 
            array (
                'created_at' => '2020-04-05 16:39:45',
                'customer_groups_id' => 10,
                'customers_id' => 470,
                'id' => 62,
                'updated_at' => '2020-04-05 16:39:45',
            ),
            52 => 
            array (
                'created_at' => '2020-04-05 16:39:45',
                'customer_groups_id' => 10,
                'customers_id' => 573,
                'id' => 63,
                'updated_at' => '2020-04-05 16:39:45',
            ),
            53 => 
            array (
                'created_at' => '2020-04-05 16:39:45',
                'customer_groups_id' => 10,
                'customers_id' => 342,
                'id' => 64,
                'updated_at' => '2020-04-05 16:39:45',
            ),
            54 => 
            array (
                'created_at' => '2020-04-05 16:39:45',
                'customer_groups_id' => 10,
                'customers_id' => 471,
                'id' => 65,
                'updated_at' => '2020-04-05 16:39:45',
            ),
            55 => 
            array (
                'created_at' => '2020-04-05 16:39:45',
                'customer_groups_id' => 10,
                'customers_id' => 377,
                'id' => 66,
                'updated_at' => '2020-04-05 16:39:45',
            ),
            56 => 
            array (
                'created_at' => '2020-05-06 07:41:06',
                'customer_groups_id' => 11,
                'customers_id' => 275,
                'id' => 67,
                'updated_at' => '2020-05-06 07:41:06',
            ),
            57 => 
            array (
                'created_at' => '2020-05-06 07:41:06',
                'customer_groups_id' => 11,
                'customers_id' => 548,
                'id' => 68,
                'updated_at' => '2020-05-06 07:41:06',
            ),
            58 => 
            array (
                'created_at' => '2020-05-06 07:42:31',
                'customer_groups_id' => 12,
                'customers_id' => 265,
                'id' => 69,
                'updated_at' => '2020-05-06 07:42:31',
            ),
            59 => 
            array (
                'created_at' => '2020-05-06 07:42:31',
                'customer_groups_id' => 12,
                'customers_id' => 590,
                'id' => 70,
                'updated_at' => '2020-05-06 07:42:31',
            ),
            60 => 
            array (
                'created_at' => '2020-05-06 07:43:06',
                'customer_groups_id' => 13,
                'customers_id' => 462,
                'id' => 71,
                'updated_at' => '2020-05-06 07:43:06',
            ),
            61 => 
            array (
                'created_at' => '2020-05-06 07:43:06',
                'customer_groups_id' => 13,
                'customers_id' => 584,
                'id' => 72,
                'updated_at' => '2020-05-06 07:43:06',
            ),
            62 => 
            array (
                'created_at' => '2020-05-06 07:44:07',
                'customer_groups_id' => 14,
                'customers_id' => 153,
                'id' => 73,
                'updated_at' => '2020-05-06 07:44:07',
            ),
            63 => 
            array (
                'created_at' => '2020-05-06 07:44:07',
                'customer_groups_id' => 14,
                'customers_id' => 83,
                'id' => 74,
                'updated_at' => '2020-05-06 07:44:07',
            ),
            64 => 
            array (
                'created_at' => '2022-02-14 10:38:09',
                'customer_groups_id' => 36,
                'customers_id' => 803,
                'id' => 252,
                'updated_at' => '2022-02-14 10:38:09',
            ),
            65 => 
            array (
                'created_at' => '2020-05-06 07:45:21',
                'customer_groups_id' => 15,
                'customers_id' => 662,
                'id' => 76,
                'updated_at' => '2020-05-06 07:45:21',
            ),
            66 => 
            array (
                'created_at' => '2020-05-06 07:45:21',
                'customer_groups_id' => 15,
                'customers_id' => 475,
                'id' => 77,
                'updated_at' => '2020-05-06 07:45:21',
            ),
            67 => 
            array (
                'created_at' => '2020-05-06 07:45:21',
                'customer_groups_id' => 15,
                'customers_id' => 492,
                'id' => 78,
                'updated_at' => '2020-05-06 07:45:21',
            ),
            68 => 
            array (
                'created_at' => '2020-05-06 07:45:21',
                'customer_groups_id' => 15,
                'customers_id' => 95,
                'id' => 79,
                'updated_at' => '2020-05-06 07:45:21',
            ),
            69 => 
            array (
                'created_at' => '2020-05-06 07:50:15',
                'customer_groups_id' => 16,
                'customers_id' => 418,
                'id' => 80,
                'updated_at' => '2020-05-06 07:50:15',
            ),
            70 => 
            array (
                'created_at' => '2020-05-06 07:50:15',
                'customer_groups_id' => 16,
                'customers_id' => 654,
                'id' => 81,
                'updated_at' => '2020-05-06 07:50:15',
            ),
            71 => 
            array (
                'created_at' => '2020-05-06 07:50:15',
                'customer_groups_id' => 16,
                'customers_id' => 388,
                'id' => 82,
                'updated_at' => '2020-05-06 07:50:15',
            ),
            72 => 
            array (
                'created_at' => '2020-05-06 07:50:15',
                'customer_groups_id' => 16,
                'customers_id' => 173,
                'id' => 83,
                'updated_at' => '2020-05-06 07:50:15',
            ),
            73 => 
            array (
                'created_at' => '2020-05-06 07:50:15',
                'customer_groups_id' => 16,
                'customers_id' => 217,
                'id' => 84,
                'updated_at' => '2020-05-06 07:50:15',
            ),
            74 => 
            array (
                'created_at' => '2020-05-06 07:50:15',
                'customer_groups_id' => 16,
                'customers_id' => 120,
                'id' => 85,
                'updated_at' => '2020-05-06 07:50:15',
            ),
            75 => 
            array (
                'created_at' => '2020-05-06 07:52:29',
                'customer_groups_id' => 17,
                'customers_id' => 190,
                'id' => 86,
                'updated_at' => '2020-05-06 07:52:29',
            ),
            76 => 
            array (
                'created_at' => '2020-05-06 07:52:29',
                'customer_groups_id' => 17,
                'customers_id' => 201,
                'id' => 87,
                'updated_at' => '2020-05-06 07:52:29',
            ),
            77 => 
            array (
                'created_at' => '2020-05-06 07:55:01',
                'customer_groups_id' => 18,
                'customers_id' => 399,
                'id' => 88,
                'updated_at' => '2020-05-06 07:55:01',
            ),
            78 => 
            array (
                'created_at' => '2020-05-06 07:55:01',
                'customer_groups_id' => 18,
                'customers_id' => 254,
                'id' => 89,
                'updated_at' => '2020-05-06 07:55:01',
            ),
            79 => 
            array (
                'created_at' => '2020-05-06 07:55:01',
                'customer_groups_id' => 18,
                'customers_id' => 505,
                'id' => 90,
                'updated_at' => '2020-05-06 07:55:01',
            ),
            80 => 
            array (
                'created_at' => '2020-05-06 07:55:53',
                'customer_groups_id' => 19,
                'customers_id' => 189,
                'id' => 91,
                'updated_at' => '2020-05-06 07:55:53',
            ),
            81 => 
            array (
                'created_at' => '2020-05-06 07:55:53',
                'customer_groups_id' => 19,
                'customers_id' => 543,
                'id' => 92,
                'updated_at' => '2020-05-06 07:55:53',
            ),
            82 => 
            array (
                'created_at' => '2020-05-06 08:01:32',
                'customer_groups_id' => 20,
                'customers_id' => 588,
                'id' => 93,
                'updated_at' => '2020-05-06 08:01:32',
            ),
            83 => 
            array (
                'created_at' => '2020-05-06 08:01:32',
                'customer_groups_id' => 20,
                'customers_id' => 512,
                'id' => 94,
                'updated_at' => '2020-05-06 08:01:32',
            ),
            84 => 
            array (
                'created_at' => '2020-05-06 08:01:32',
                'customer_groups_id' => 20,
                'customers_id' => 355,
                'id' => 95,
                'updated_at' => '2020-05-06 08:01:32',
            ),
            85 => 
            array (
                'created_at' => '2020-05-06 08:01:32',
                'customer_groups_id' => 20,
                'customers_id' => 489,
                'id' => 96,
                'updated_at' => '2020-05-06 08:01:32',
            ),
            86 => 
            array (
                'created_at' => '2020-05-06 08:01:32',
                'customer_groups_id' => 20,
                'customers_id' => 241,
                'id' => 97,
                'updated_at' => '2020-05-06 08:01:32',
            ),
            87 => 
            array (
                'created_at' => '2020-05-06 08:04:59',
                'customer_groups_id' => 21,
                'customers_id' => 155,
                'id' => 98,
                'updated_at' => '2020-05-06 08:04:59',
            ),
            88 => 
            array (
                'created_at' => '2020-05-06 08:04:59',
                'customer_groups_id' => 21,
                'customers_id' => 63,
                'id' => 99,
                'updated_at' => '2020-05-06 08:04:59',
            ),
            89 => 
            array (
                'created_at' => '2020-05-06 08:05:57',
                'customer_groups_id' => 22,
                'customers_id' => 558,
                'id' => 100,
                'updated_at' => '2020-05-06 08:05:57',
            ),
            90 => 
            array (
                'created_at' => '2020-05-06 08:05:57',
                'customer_groups_id' => 22,
                'customers_id' => 545,
                'id' => 101,
                'updated_at' => '2020-05-06 08:05:57',
            ),
            91 => 
            array (
                'created_at' => '2020-05-06 08:09:00',
                'customer_groups_id' => 23,
                'customers_id' => 321,
                'id' => 102,
                'updated_at' => '2020-05-06 08:09:00',
            ),
            92 => 
            array (
                'created_at' => '2020-05-06 08:09:00',
                'customer_groups_id' => 23,
                'customers_id' => 544,
                'id' => 103,
                'updated_at' => '2020-05-06 08:09:00',
            ),
            93 => 
            array (
                'created_at' => '2020-05-06 08:09:00',
                'customer_groups_id' => 23,
                'customers_id' => 328,
                'id' => 104,
                'updated_at' => '2020-05-06 08:09:00',
            ),
            94 => 
            array (
                'created_at' => '2020-05-06 08:12:12',
                'customer_groups_id' => 24,
                'customers_id' => 593,
                'id' => 105,
                'updated_at' => '2020-05-06 08:12:12',
            ),
            95 => 
            array (
                'created_at' => '2020-05-06 08:12:12',
                'customer_groups_id' => 24,
                'customers_id' => 606,
                'id' => 106,
                'updated_at' => '2020-05-06 08:12:12',
            ),
            96 => 
            array (
                'created_at' => '2020-05-06 08:13:09',
                'customer_groups_id' => 24,
                'customers_id' => 381,
                'id' => 107,
                'updated_at' => '2020-05-06 08:13:09',
            ),
            97 => 
            array (
                'created_at' => '2020-05-06 08:15:09',
                'customer_groups_id' => 25,
                'customers_id' => 640,
                'id' => 108,
                'updated_at' => '2020-05-06 08:15:09',
            ),
            98 => 
            array (
                'created_at' => '2020-05-06 08:15:09',
                'customer_groups_id' => 25,
                'customers_id' => 248,
                'id' => 109,
                'updated_at' => '2020-05-06 08:15:09',
            ),
            99 => 
            array (
                'created_at' => '2020-05-06 08:15:09',
                'customer_groups_id' => 25,
                'customers_id' => 401,
                'id' => 110,
                'updated_at' => '2020-05-06 08:15:09',
            ),
            100 => 
            array (
                'created_at' => '2020-05-06 08:15:09',
                'customer_groups_id' => 25,
                'customers_id' => 114,
                'id' => 111,
                'updated_at' => '2020-05-06 08:15:09',
            ),
            101 => 
            array (
                'created_at' => '2020-05-06 08:17:00',
                'customer_groups_id' => 26,
                'customers_id' => 194,
                'id' => 112,
                'updated_at' => '2020-05-06 08:17:00',
            ),
            102 => 
            array (
                'created_at' => '2020-05-06 08:17:00',
                'customer_groups_id' => 26,
                'customers_id' => 263,
                'id' => 113,
                'updated_at' => '2020-05-06 08:17:00',
            ),
            103 => 
            array (
                'created_at' => '2020-05-06 08:17:00',
                'customer_groups_id' => 26,
                'customers_id' => 151,
                'id' => 114,
                'updated_at' => '2020-05-06 08:17:00',
            ),
            104 => 
            array (
                'created_at' => '2020-05-06 08:20:21',
                'customer_groups_id' => 27,
                'customers_id' => 664,
                'id' => 115,
                'updated_at' => '2020-05-06 08:20:21',
            ),
            105 => 
            array (
                'created_at' => '2020-05-06 08:20:21',
                'customer_groups_id' => 27,
                'customers_id' => 608,
                'id' => 116,
                'updated_at' => '2020-05-06 08:20:21',
            ),
            106 => 
            array (
                'created_at' => '2020-05-06 08:20:21',
                'customer_groups_id' => 27,
                'customers_id' => 39,
                'id' => 117,
                'updated_at' => '2020-05-06 08:20:21',
            ),
            107 => 
            array (
                'created_at' => '2020-05-06 08:20:21',
                'customer_groups_id' => 27,
                'customers_id' => 600,
                'id' => 118,
                'updated_at' => '2020-05-06 08:20:21',
            ),
            108 => 
            array (
                'created_at' => '2020-05-06 08:20:21',
                'customer_groups_id' => 27,
                'customers_id' => 372,
                'id' => 119,
                'updated_at' => '2020-05-06 08:20:21',
            ),
            109 => 
            array (
                'created_at' => '2020-05-06 08:20:21',
                'customer_groups_id' => 27,
                'customers_id' => 76,
                'id' => 120,
                'updated_at' => '2020-05-06 08:20:21',
            ),
            110 => 
            array (
                'created_at' => '2020-05-06 08:20:21',
                'customer_groups_id' => 27,
                'customers_id' => 402,
                'id' => 121,
                'updated_at' => '2020-05-06 08:20:21',
            ),
            111 => 
            array (
                'created_at' => '2020-05-06 08:20:21',
                'customer_groups_id' => 27,
                'customers_id' => 363,
                'id' => 122,
                'updated_at' => '2020-05-06 08:20:21',
            ),
            112 => 
            array (
                'created_at' => '2020-05-06 08:25:40',
                'customer_groups_id' => 28,
                'customers_id' => 523,
                'id' => 123,
                'updated_at' => '2020-05-06 08:25:40',
            ),
            113 => 
            array (
                'created_at' => '2020-05-06 08:25:40',
                'customer_groups_id' => 28,
                'customers_id' => 184,
                'id' => 124,
                'updated_at' => '2020-05-06 08:25:40',
            ),
            114 => 
            array (
                'created_at' => '2020-05-06 08:25:40',
                'customer_groups_id' => 28,
                'customers_id' => 603,
                'id' => 125,
                'updated_at' => '2020-05-06 08:25:40',
            ),
            115 => 
            array (
                'created_at' => '2020-05-06 08:25:40',
                'customer_groups_id' => 28,
                'customers_id' => 244,
                'id' => 126,
                'updated_at' => '2020-05-06 08:25:40',
            ),
            116 => 
            array (
                'created_at' => '2020-05-06 08:25:40',
                'customer_groups_id' => 28,
                'customers_id' => 130,
                'id' => 127,
                'updated_at' => '2020-05-06 08:25:40',
            ),
            117 => 
            array (
                'created_at' => '2020-05-06 08:25:40',
                'customer_groups_id' => 28,
                'customers_id' => 208,
                'id' => 128,
                'updated_at' => '2020-05-06 08:25:40',
            ),
            118 => 
            array (
                'created_at' => '2020-05-06 08:25:40',
                'customer_groups_id' => 28,
                'customers_id' => 612,
                'id' => 129,
                'updated_at' => '2020-05-06 08:25:40',
            ),
            119 => 
            array (
                'created_at' => '2020-05-06 08:25:40',
                'customer_groups_id' => 28,
                'customers_id' => 65,
                'id' => 130,
                'updated_at' => '2020-05-06 08:25:40',
            ),
            120 => 
            array (
                'created_at' => '2020-05-06 08:25:40',
                'customer_groups_id' => 28,
                'customers_id' => 30,
                'id' => 131,
                'updated_at' => '2020-05-06 08:25:40',
            ),
            121 => 
            array (
                'created_at' => '2020-05-06 08:27:09',
                'customer_groups_id' => 29,
                'customers_id' => 91,
                'id' => 132,
                'updated_at' => '2020-05-06 08:27:09',
            ),
            122 => 
            array (
                'created_at' => '2020-05-06 08:27:09',
                'customer_groups_id' => 29,
                'customers_id' => 431,
                'id' => 133,
                'updated_at' => '2020-05-06 08:27:09',
            ),
            123 => 
            array (
                'created_at' => '2020-05-06 08:30:35',
                'customer_groups_id' => 30,
                'customers_id' => 291,
                'id' => 134,
                'updated_at' => '2020-05-06 08:30:35',
            ),
            124 => 
            array (
                'created_at' => '2020-05-06 08:30:35',
                'customer_groups_id' => 30,
                'customers_id' => 671,
                'id' => 135,
                'updated_at' => '2020-05-06 08:30:35',
            ),
            125 => 
            array (
                'created_at' => '2020-05-06 08:31:35',
                'customer_groups_id' => 31,
                'customers_id' => 553,
                'id' => 136,
                'updated_at' => '2020-05-06 08:31:35',
            ),
            126 => 
            array (
                'created_at' => '2020-05-06 08:31:35',
                'customer_groups_id' => 31,
                'customers_id' => 340,
                'id' => 137,
                'updated_at' => '2020-05-06 08:31:35',
            ),
            127 => 
            array (
                'created_at' => '2020-05-06 08:34:21',
                'customer_groups_id' => 32,
                'customers_id' => 81,
                'id' => 138,
                'updated_at' => '2020-05-06 08:34:21',
            ),
            128 => 
            array (
                'created_at' => '2020-05-06 08:34:21',
                'customer_groups_id' => 32,
                'customers_id' => 62,
                'id' => 139,
                'updated_at' => '2020-05-06 08:34:21',
            ),
            129 => 
            array (
                'created_at' => '2020-05-06 08:36:09',
                'customer_groups_id' => 33,
                'customers_id' => 626,
                'id' => 140,
                'updated_at' => '2020-05-06 08:36:09',
            ),
            130 => 
            array (
                'created_at' => '2020-05-06 08:36:09',
                'customer_groups_id' => 33,
                'customers_id' => 168,
                'id' => 141,
                'updated_at' => '2020-05-06 08:36:09',
            ),
            131 => 
            array (
                'created_at' => '2020-05-06 08:37:42',
                'customer_groups_id' => 34,
                'customers_id' => 392,
                'id' => 142,
                'updated_at' => '2020-05-06 08:37:42',
            ),
            132 => 
            array (
                'created_at' => '2020-05-06 08:37:42',
                'customer_groups_id' => 34,
                'customers_id' => 94,
                'id' => 143,
                'updated_at' => '2020-05-06 08:37:42',
            ),
            133 => 
            array (
                'created_at' => '2020-05-06 08:38:51',
                'customer_groups_id' => 35,
                'customers_id' => 129,
                'id' => 144,
                'updated_at' => '2020-05-06 08:38:51',
            ),
            134 => 
            array (
                'created_at' => '2020-05-06 08:38:51',
                'customer_groups_id' => 35,
                'customers_id' => 423,
                'id' => 145,
                'updated_at' => '2020-05-06 08:38:51',
            ),
            135 => 
            array (
                'created_at' => '2020-05-06 08:38:51',
                'customer_groups_id' => 35,
                'customers_id' => 273,
                'id' => 146,
                'updated_at' => '2020-05-06 08:38:51',
            ),
            136 => 
            array (
                'created_at' => '2020-05-06 08:40:18',
                'customer_groups_id' => 36,
                'customers_id' => 24,
                'id' => 147,
                'updated_at' => '2020-05-06 08:40:18',
            ),
            137 => 
            array (
                'created_at' => '2020-10-26 13:29:16',
                'customer_groups_id' => 23,
                'customers_id' => 734,
                'id' => 194,
                'updated_at' => '2020-10-26 13:29:16',
            ),
            138 => 
            array (
                'created_at' => '2021-03-24 10:48:25',
                'customer_groups_id' => 47,
                'customers_id' => 699,
                'id' => 239,
                'updated_at' => '2021-03-24 10:48:25',
            ),
            139 => 
            array (
                'created_at' => '2021-03-24 10:48:11',
                'customer_groups_id' => 47,
                'customers_id' => 433,
                'id' => 238,
                'updated_at' => '2021-03-24 10:48:11',
            ),
            140 => 
            array (
                'created_at' => '2021-03-24 10:46:55',
                'customer_groups_id' => 47,
                'customers_id' => 111,
                'id' => 237,
                'updated_at' => '2021-03-24 10:46:55',
            ),
            141 => 
            array (
                'created_at' => '2020-05-06 08:42:54',
                'customer_groups_id' => 37,
                'customers_id' => 226,
                'id' => 152,
                'updated_at' => '2020-05-06 08:42:54',
            ),
            142 => 
            array (
                'created_at' => '2020-05-06 08:42:54',
                'customer_groups_id' => 37,
                'customers_id' => 551,
                'id' => 153,
                'updated_at' => '2020-05-06 08:42:54',
            ),
            143 => 
            array (
                'created_at' => '2020-05-06 08:42:54',
                'customer_groups_id' => 37,
                'customers_id' => 448,
                'id' => 154,
                'updated_at' => '2020-05-06 08:42:54',
            ),
            144 => 
            array (
                'created_at' => '2020-05-08 07:15:44',
                'customer_groups_id' => 38,
                'customers_id' => 688,
                'id' => 155,
                'updated_at' => '2020-05-08 07:15:44',
            ),
            145 => 
            array (
                'created_at' => '2020-05-08 07:15:44',
                'customer_groups_id' => 38,
                'customers_id' => 689,
                'id' => 156,
                'updated_at' => '2020-05-08 07:15:44',
            ),
            146 => 
            array (
                'created_at' => '2020-05-08 07:15:44',
                'customer_groups_id' => 38,
                'customers_id' => 690,
                'id' => 157,
                'updated_at' => '2020-05-08 07:15:44',
            ),
            147 => 
            array (
                'created_at' => '2020-05-08 07:15:44',
                'customer_groups_id' => 38,
                'customers_id' => 691,
                'id' => 158,
                'updated_at' => '2020-05-08 07:15:44',
            ),
            148 => 
            array (
                'created_at' => '2020-05-08 07:15:44',
                'customer_groups_id' => 38,
                'customers_id' => 692,
                'id' => 159,
                'updated_at' => '2020-05-08 07:15:44',
            ),
            149 => 
            array (
                'created_at' => '2020-05-08 07:15:44',
                'customer_groups_id' => 38,
                'customers_id' => 693,
                'id' => 160,
                'updated_at' => '2020-05-08 07:15:44',
            ),
            150 => 
            array (
                'created_at' => '2020-05-08 07:15:44',
                'customer_groups_id' => 38,
                'customers_id' => 694,
                'id' => 161,
                'updated_at' => '2020-05-08 07:15:44',
            ),
            151 => 
            array (
                'created_at' => '2020-05-08 07:15:44',
                'customer_groups_id' => 38,
                'customers_id' => 695,
                'id' => 162,
                'updated_at' => '2020-05-08 07:15:44',
            ),
            152 => 
            array (
                'created_at' => '2020-05-08 07:15:44',
                'customer_groups_id' => 38,
                'customers_id' => 696,
                'id' => 163,
                'updated_at' => '2020-05-08 07:15:44',
            ),
            153 => 
            array (
                'created_at' => '2020-05-08 07:15:44',
                'customer_groups_id' => 38,
                'customers_id' => 697,
                'id' => 164,
                'updated_at' => '2020-05-08 07:15:44',
            ),
            154 => 
            array (
                'created_at' => '2020-05-08 07:15:44',
                'customer_groups_id' => 38,
                'customers_id' => 698,
                'id' => 165,
                'updated_at' => '2020-05-08 07:15:44',
            ),
            155 => 
            array (
                'created_at' => '2020-06-12 13:54:18',
                'customer_groups_id' => 23,
                'customers_id' => 680,
                'id' => 166,
                'updated_at' => '2020-06-12 13:54:18',
            ),
            156 => 
            array (
                'created_at' => '2020-06-12 13:54:18',
                'customer_groups_id' => 23,
                'customers_id' => 710,
                'id' => 167,
                'updated_at' => '2020-06-12 13:54:18',
            ),
            157 => 
            array (
                'created_at' => '2020-06-12 13:56:37',
                'customer_groups_id' => 17,
                'customers_id' => 702,
                'id' => 168,
                'updated_at' => '2020-06-12 13:56:37',
            ),
            158 => 
            array (
                'created_at' => '2020-06-12 13:58:36',
                'customer_groups_id' => 10,
                'customers_id' => 713,
                'id' => 169,
                'updated_at' => '2020-06-12 13:58:36',
            ),
            159 => 
            array (
                'created_at' => '2020-10-26 13:44:35',
                'customer_groups_id' => 10,
                'customers_id' => 700,
                'id' => 196,
                'updated_at' => '2020-10-26 13:44:35',
            ),
            160 => 
            array (
                'created_at' => '2020-06-12 13:59:03',
                'customer_groups_id' => 10,
                'customers_id' => 711,
                'id' => 171,
                'updated_at' => '2020-06-12 13:59:03',
            ),
            161 => 
            array (
                'created_at' => '2020-06-12 13:59:28',
                'customer_groups_id' => 10,
                'customers_id' => 712,
                'id' => 172,
                'updated_at' => '2020-06-12 13:59:28',
            ),
            162 => 
            array (
                'created_at' => '2020-06-12 14:07:42',
                'customer_groups_id' => 36,
                'customers_id' => 714,
                'id' => 174,
                'updated_at' => '2020-06-12 14:07:42',
            ),
            163 => 
            array (
                'created_at' => '2020-07-18 07:23:57',
                'customer_groups_id' => 10,
                'customers_id' => 718,
                'id' => 175,
                'updated_at' => '2020-07-18 07:23:57',
            ),
            164 => 
            array (
                'created_at' => '2020-10-23 13:05:43',
                'customer_groups_id' => 10,
                'customers_id' => 719,
                'id' => 176,
                'updated_at' => '2020-10-23 13:05:43',
            ),
            165 => 
            array (
                'created_at' => '2020-10-23 13:05:43',
                'customer_groups_id' => 10,
                'customers_id' => 28,
                'id' => 177,
                'updated_at' => '2020-10-23 13:05:43',
            ),
            166 => 
            array (
                'created_at' => '2020-10-23 13:05:43',
                'customer_groups_id' => 10,
                'customers_id' => 202,
                'id' => 178,
                'updated_at' => '2020-10-23 13:05:43',
            ),
            167 => 
            array (
                'created_at' => '2020-10-23 13:05:43',
                'customer_groups_id' => 10,
                'customers_id' => 572,
                'id' => 179,
                'updated_at' => '2020-10-23 13:05:43',
            ),
            168 => 
            array (
                'created_at' => '2020-10-23 13:05:43',
                'customer_groups_id' => 10,
                'customers_id' => 351,
                'id' => 180,
                'updated_at' => '2020-10-23 13:05:43',
            ),
            169 => 
            array (
                'created_at' => '2020-10-23 13:06:31',
                'customer_groups_id' => 2,
                'customers_id' => 72,
                'id' => 181,
                'updated_at' => '2020-10-23 13:06:31',
            ),
            170 => 
            array (
                'created_at' => '2020-10-23 13:14:39',
                'customer_groups_id' => 11,
                'customers_id' => 701,
                'id' => 182,
                'updated_at' => '2020-10-23 13:14:39',
            ),
            171 => 
            array (
                'created_at' => '2020-10-23 13:14:56',
                'customer_groups_id' => 12,
                'customers_id' => 722,
                'id' => 183,
                'updated_at' => '2020-10-23 13:14:56',
            ),
            172 => 
            array (
                'created_at' => '2020-10-23 13:17:31',
                'customer_groups_id' => 23,
                'customers_id' => 715,
                'id' => 184,
                'updated_at' => '2020-10-23 13:17:31',
            ),
            173 => 
            array (
                'created_at' => '2021-03-22 12:28:54',
                'customer_groups_id' => 45,
                'customers_id' => 484,
                'id' => 226,
                'updated_at' => '2021-03-22 12:28:54',
            ),
            174 => 
            array (
                'created_at' => '2020-10-23 13:19:25',
                'customer_groups_id' => 31,
                'customers_id' => 365,
                'id' => 186,
                'updated_at' => '2020-10-23 13:19:25',
            ),
            175 => 
            array (
                'created_at' => '2020-10-23 13:20:01',
                'customer_groups_id' => 35,
                'customers_id' => 724,
                'id' => 187,
                'updated_at' => '2020-10-23 13:20:01',
            ),
            176 => 
            array (
                'created_at' => '2020-10-23 13:21:10',
                'customer_groups_id' => 36,
                'customers_id' => 727,
                'id' => 188,
                'updated_at' => '2020-10-23 13:21:10',
            ),
            177 => 
            array (
                'created_at' => '2021-03-22 12:28:54',
                'customer_groups_id' => 45,
                'customers_id' => 591,
                'id' => 225,
                'updated_at' => '2021-03-22 12:28:54',
            ),
            178 => 
            array (
                'created_at' => '2020-11-16 13:06:05',
                'customer_groups_id' => 3,
                'customers_id' => 739,
                'id' => 199,
                'updated_at' => '2020-11-16 13:06:05',
            ),
            179 => 
            array (
                'created_at' => '2020-11-16 13:07:38',
                'customer_groups_id' => 3,
                'customers_id' => 740,
                'id' => 200,
                'updated_at' => '2020-11-24 12:45:52',
            ),
            180 => 
            array (
                'created_at' => '2020-11-17 13:38:06',
                'customer_groups_id' => 3,
                'customers_id' => 742,
                'id' => 201,
                'updated_at' => '2020-11-24 12:47:44',
            ),
            181 => 
            array (
                'created_at' => '2020-11-23 12:04:13',
                'customer_groups_id' => 23,
                'customers_id' => 744,
                'id' => 202,
                'updated_at' => '2020-11-23 12:04:13',
            ),
            182 => 
            array (
                'created_at' => '2020-11-24 12:54:58',
                'customer_groups_id' => 39,
                'customers_id' => 741,
                'id' => 203,
                'updated_at' => '2020-11-24 12:54:58',
            ),
            183 => 
            array (
                'created_at' => '2020-11-29 07:57:10',
                'customer_groups_id' => 36,
                'customers_id' => 456,
                'id' => 204,
                'updated_at' => '2020-11-29 07:57:10',
            ),
            184 => 
            array (
                'created_at' => '2020-11-29 08:01:45',
                'customer_groups_id' => 40,
                'customers_id' => 660,
                'id' => 205,
                'updated_at' => '2020-11-29 08:01:45',
            ),
            185 => 
            array (
                'created_at' => '2020-12-13 07:51:22',
                'customer_groups_id' => 40,
                'customers_id' => 337,
                'id' => 206,
                'updated_at' => '2020-12-13 07:51:22',
            ),
            186 => 
            array (
                'created_at' => '2020-12-13 08:23:50',
                'customer_groups_id' => 3,
                'customers_id' => 15,
                'id' => 207,
                'updated_at' => '2020-12-13 08:23:50',
            ),
            187 => 
            array (
                'created_at' => '2020-12-13 08:50:25',
                'customer_groups_id' => 11,
                'customers_id' => 170,
                'id' => 208,
                'updated_at' => '2020-12-13 08:50:25',
            ),
            188 => 
            array (
                'created_at' => '2020-12-21 07:16:34',
                'customer_groups_id' => 41,
                'customers_id' => 207,
                'id' => 209,
                'updated_at' => '2020-12-21 07:16:34',
            ),
            189 => 
            array (
                'created_at' => '2020-12-21 07:16:34',
                'customer_groups_id' => 41,
                'customers_id' => 683,
                'id' => 210,
                'updated_at' => '2020-12-21 07:16:34',
            ),
            190 => 
            array (
                'created_at' => '2020-12-21 07:17:14',
                'customer_groups_id' => 42,
                'customers_id' => 725,
                'id' => 211,
                'updated_at' => '2020-12-21 07:17:14',
            ),
            191 => 
            array (
                'created_at' => '2020-12-21 07:17:14',
                'customer_groups_id' => 42,
                'customers_id' => 743,
                'id' => 212,
                'updated_at' => '2020-12-21 07:17:14',
            ),
            192 => 
            array (
                'created_at' => '2020-12-22 07:53:49',
                'customer_groups_id' => 43,
                'customers_id' => 88,
                'id' => 213,
                'updated_at' => '2020-12-22 07:53:49',
            ),
            193 => 
            array (
                'created_at' => '2020-12-22 07:53:49',
                'customer_groups_id' => 43,
                'customers_id' => 498,
                'id' => 214,
                'updated_at' => '2020-12-22 07:53:49',
            ),
            194 => 
            array (
                'created_at' => '2020-12-22 08:06:44',
                'customer_groups_id' => 44,
                'customers_id' => 350,
                'id' => 216,
                'updated_at' => '2020-12-22 08:06:44',
            ),
            195 => 
            array (
                'created_at' => '2020-12-22 08:06:44',
                'customer_groups_id' => 44,
                'customers_id' => 327,
                'id' => 217,
                'updated_at' => '2020-12-22 08:06:44',
            ),
            196 => 
            array (
                'created_at' => '2020-12-23 13:14:09',
                'customer_groups_id' => 3,
                'customers_id' => 746,
                'id' => 218,
                'updated_at' => '2020-12-23 13:14:09',
            ),
            197 => 
            array (
                'created_at' => '2020-12-30 07:00:11',
                'customer_groups_id' => 40,
                'customers_id' => 747,
                'id' => 219,
                'updated_at' => '2020-12-30 07:00:11',
            ),
            198 => 
            array (
                'created_at' => '2021-02-09 10:07:31',
                'customer_groups_id' => 36,
                'customers_id' => 752,
                'id' => 220,
                'updated_at' => '2021-02-09 10:07:31',
            ),
            199 => 
            array (
                'created_at' => '2021-02-09 10:16:37',
                'customer_groups_id' => 28,
                'customers_id' => 753,
                'id' => 221,
                'updated_at' => '2021-02-09 10:16:37',
            ),
            200 => 
            array (
                'created_at' => '2021-03-22 12:28:54',
                'customer_groups_id' => 45,
                'customers_id' => 501,
                'id' => 224,
                'updated_at' => '2021-03-22 12:28:54',
            ),
            201 => 
            array (
                'created_at' => '2021-03-18 12:04:52',
                'customer_groups_id' => 27,
                'customers_id' => 763,
                'id' => 223,
                'updated_at' => '2021-03-18 12:04:52',
            ),
            202 => 
            array (
                'created_at' => '2021-03-22 12:28:54',
                'customer_groups_id' => 45,
                'customers_id' => 406,
                'id' => 227,
                'updated_at' => '2021-03-22 12:28:54',
            ),
            203 => 
            array (
                'created_at' => '2021-03-22 12:28:54',
                'customer_groups_id' => 45,
                'customers_id' => 550,
                'id' => 228,
                'updated_at' => '2021-03-22 12:28:54',
            ),
            204 => 
            array (
                'created_at' => '2021-03-22 12:28:54',
                'customer_groups_id' => 45,
                'customers_id' => 228,
                'id' => 229,
                'updated_at' => '2021-03-22 12:28:54',
            ),
            205 => 
            array (
                'created_at' => '2021-03-22 12:28:54',
                'customer_groups_id' => 45,
                'customers_id' => 618,
                'id' => 230,
                'updated_at' => '2021-03-22 12:28:54',
            ),
            206 => 
            array (
                'created_at' => '2021-03-22 12:28:54',
                'customer_groups_id' => 45,
                'customers_id' => 658,
                'id' => 231,
                'updated_at' => '2021-03-22 12:28:54',
            ),
            207 => 
            array (
                'created_at' => '2021-03-22 12:28:54',
                'customer_groups_id' => 45,
                'customers_id' => 502,
                'id' => 232,
                'updated_at' => '2021-03-22 12:28:54',
            ),
            208 => 
            array (
                'created_at' => '2021-03-22 12:28:54',
                'customer_groups_id' => 45,
                'customers_id' => 72,
                'id' => 233,
                'updated_at' => '2021-03-22 12:28:54',
            ),
            209 => 
            array (
                'created_at' => '2021-03-22 12:28:54',
                'customer_groups_id' => 45,
                'customers_id' => 179,
                'id' => 234,
                'updated_at' => '2021-03-22 12:28:54',
            ),
            210 => 
            array (
                'created_at' => '2021-03-24 10:30:25',
                'customer_groups_id' => 46,
                'customers_id' => 551,
                'id' => 235,
                'updated_at' => '2021-03-24 10:30:25',
            ),
            211 => 
            array (
                'created_at' => '2021-03-24 10:39:31',
                'customer_groups_id' => 27,
                'customers_id' => 737,
                'id' => 236,
                'updated_at' => '2021-03-24 10:39:31',
            ),
            212 => 
            array (
                'created_at' => '2021-05-18 10:39:11',
                'customer_groups_id' => 23,
                'customers_id' => 767,
                'id' => 240,
                'updated_at' => '2021-05-18 10:39:11',
            ),
            213 => 
            array (
                'created_at' => '2021-08-21 16:37:36',
                'customer_groups_id' => 36,
                'customers_id' => 774,
                'id' => 241,
                'updated_at' => '2021-08-21 16:37:36',
            ),
            214 => 
            array (
                'created_at' => '2021-09-10 12:51:36',
                'customer_groups_id' => 23,
                'customers_id' => 777,
                'id' => 242,
                'updated_at' => '2021-09-10 12:51:36',
            ),
            215 => 
            array (
                'created_at' => '2021-09-24 08:44:02',
                'customer_groups_id' => 3,
                'customers_id' => 783,
                'id' => 243,
                'updated_at' => '2021-09-24 08:44:02',
            ),
            216 => 
            array (
                'created_at' => '2021-10-15 07:46:45',
                'customer_groups_id' => 11,
                'customers_id' => 125,
                'id' => 244,
                'updated_at' => '2021-10-15 07:46:45',
            ),
            217 => 
            array (
                'created_at' => '2021-12-06 09:44:13',
                'customer_groups_id' => 4,
                'customers_id' => 792,
                'id' => 245,
                'updated_at' => '2021-12-06 09:44:13',
            ),
            218 => 
            array (
                'created_at' => '2021-12-10 13:05:16',
                'customer_groups_id' => 20,
                'customers_id' => 793,
                'id' => 246,
                'updated_at' => '2021-12-10 13:05:16',
            ),
            219 => 
            array (
                'created_at' => '2021-12-10 13:17:50',
                'customer_groups_id' => 20,
                'customers_id' => 794,
                'id' => 247,
                'updated_at' => '2021-12-10 13:17:50',
            ),
            220 => 
            array (
                'created_at' => '2021-12-10 13:39:21',
                'customer_groups_id' => 3,
                'customers_id' => 795,
                'id' => 248,
                'updated_at' => '2021-12-10 13:39:21',
            ),
            221 => 
            array (
                'created_at' => '2021-12-13 11:17:10',
                'customer_groups_id' => 3,
                'customers_id' => 797,
                'id' => 249,
                'updated_at' => '2021-12-13 11:17:10',
            ),
            222 => 
            array (
                'created_at' => '2021-12-13 13:06:32',
                'customer_groups_id' => 39,
                'customers_id' => 755,
                'id' => 250,
                'updated_at' => '2021-12-13 13:06:32',
            ),
            223 => 
            array (
                'created_at' => '2021-12-13 13:08:27',
                'customer_groups_id' => 39,
                'customers_id' => 780,
                'id' => 251,
                'updated_at' => '2021-12-13 13:08:27',
            ),
            224 => 
            array (
                'created_at' => '2022-03-28 11:15:51',
                'customer_groups_id' => 27,
                'customers_id' => 810,
                'id' => 253,
                'updated_at' => '2022-03-28 11:15:51',
            ),
            225 => 
            array (
                'created_at' => '2022-12-05 06:41:27',
                'customer_groups_id' => 37,
                'customers_id' => 815,
                'id' => 259,
                'updated_at' => '2022-12-05 06:41:27',
            ),
            226 => 
            array (
                'created_at' => '2022-07-12 09:19:24',
                'customer_groups_id' => 4,
                'customers_id' => 826,
                'id' => 255,
                'updated_at' => '2022-07-12 09:19:24',
            ),
            227 => 
            array (
                'created_at' => '2022-07-25 08:56:25',
                'customer_groups_id' => 40,
                'customers_id' => 828,
                'id' => 256,
                'updated_at' => '2022-07-25 08:56:25',
            ),
            228 => 
            array (
                'created_at' => '2022-11-01 11:07:12',
                'customer_groups_id' => 10,
                'customers_id' => 840,
                'id' => 257,
                'updated_at' => '2022-11-01 11:07:12',
            ),
            229 => 
            array (
                'created_at' => '2022-11-21 12:02:05',
                'customer_groups_id' => 3,
                'customers_id' => 843,
                'id' => 258,
                'updated_at' => '2022-11-21 12:02:05',
            ),
            230 => 
            array (
                'created_at' => '2023-03-15 07:43:59',
                'customer_groups_id' => 3,
                'customers_id' => 850,
                'id' => 260,
                'updated_at' => '2023-03-15 07:43:59',
            ),
            231 => 
            array (
                'created_at' => '2023-03-15 07:45:42',
                'customer_groups_id' => 3,
                'customers_id' => 851,
                'id' => 261,
                'updated_at' => '2023-03-15 07:45:42',
            ),
            232 => 
            array (
                'created_at' => '2023-03-16 06:35:41',
                'customer_groups_id' => 37,
                'customers_id' => 852,
                'id' => 262,
                'updated_at' => '2023-03-16 06:35:41',
            ),
            233 => 
            array (
                'created_at' => '2023-03-24 06:25:26',
                'customer_groups_id' => 40,
                'customers_id' => 855,
                'id' => 263,
                'updated_at' => '2023-03-24 06:25:26',
            ),
            234 => 
            array (
                'created_at' => '2023-03-24 07:08:54',
                'customer_groups_id' => 40,
                'customers_id' => 856,
                'id' => 264,
                'updated_at' => '2023-03-24 07:08:54',
            ),
            235 => 
            array (
                'created_at' => '2023-03-24 07:11:01',
                'customer_groups_id' => 40,
                'customers_id' => 857,
                'id' => 265,
                'updated_at' => '2023-03-24 07:11:01',
            ),
            236 => 
            array (
                'created_at' => '2023-03-24 07:16:25',
                'customer_groups_id' => 40,
                'customers_id' => 860,
                'id' => 266,
                'updated_at' => '2023-03-24 07:16:25',
            ),
            237 => 
            array (
                'created_at' => '2023-03-24 07:17:17',
                'customer_groups_id' => 40,
                'customers_id' => 859,
                'id' => 267,
                'updated_at' => '2023-03-24 07:17:17',
            ),
            238 => 
            array (
                'created_at' => '2023-04-29 08:42:12',
                'customer_groups_id' => 3,
                'customers_id' => 862,
                'id' => 268,
                'updated_at' => '2023-04-29 08:42:12',
            ),
            239 => 
            array (
                'created_at' => '2023-05-17 11:27:21',
                'customer_groups_id' => 40,
                'customers_id' => 869,
                'id' => 269,
                'updated_at' => '2023-05-17 11:27:21',
            ),
        ));
        
        Schema::enableForeignKeyConstraints();
    }
}