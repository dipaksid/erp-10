<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class PermissionsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        \DB::table('permissions')->insert(array (
            0 =>
            array (
                'id' => 28,
                'name' => 'STOCK LIST',
                'guard_name' => 'web',
                'created_at' => '2019-12-03 07:46:29',
                'updated_at' => '2019-12-03 07:46:29',
            ),
            1 =>
            array (
                'id' => 2,
                'name' => 'DASHBOARD',
                'guard_name' => 'web',
                'created_at' => '2019-12-02 10:54:03',
                'updated_at' => '2019-12-02 10:54:03',
            ),
            2 =>
            array (
                'id' => 3,
                'name' => 'ADD SALES INVOICE',
                'guard_name' => 'web',
                'created_at' => '2019-12-02 10:54:45',
                'updated_at' => '2019-12-02 10:54:45',
            ),
            3 =>
            array (
                'id' => 4,
                'name' => 'EDIT SALES INVOICE',
                'guard_name' => 'web',
                'created_at' => '2019-12-02 10:54:59',
                'updated_at' => '2019-12-02 10:54:59',
            ),
            4 =>
            array (
                'id' => 5,
                'name' => 'PRINT SALES INVOICE',
                'guard_name' => 'web',
                'created_at' => '2019-12-02 10:55:41',
                'updated_at' => '2019-12-02 10:55:41',
            ),
            5 =>
            array (
                'id' => 6,
                'name' => 'PRINT SALES DELIVERY ORDER',
                'guard_name' => 'web',
                'created_at' => '2019-12-02 10:56:09',
                'updated_at' => '2019-12-02 10:56:09',
            ),
            6 =>
            array (
                'id' => 7,
                'name' => 'CHECK SALES INVOICE',
                'guard_name' => 'web',
                'created_at' => '2019-12-02 10:56:34',
                'updated_at' => '2019-12-02 10:56:34',
            ),
            7 =>
            array (
                'id' => 8,
                'name' => 'ADD CUSTOMER',
                'guard_name' => 'web',
                'created_at' => '2019-12-02 10:56:59',
                'updated_at' => '2019-12-02 10:56:59',
            ),
            8 =>
            array (
                'id' => 9,
                'name' => 'CUSTOMER LIST',
                'guard_name' => 'web',
                'created_at' => '2019-12-02 10:57:13',
                'updated_at' => '2019-12-02 10:57:13',
            ),
            9 =>
            array (
                'id' => 10,
                'name' => 'EDIT CUSTOMER',
                'guard_name' => 'web',
                'created_at' => '2019-12-02 10:57:26',
                'updated_at' => '2019-12-02 10:57:26',
            ),
            10 =>
            array (
                'id' => 11,
                'name' => 'DELETE CUSTOMER',
                'guard_name' => 'web',
                'created_at' => '2019-12-02 10:57:37',
                'updated_at' => '2019-12-02 10:57:37',
            ),
            11 =>
            array (
                'id' => 12,
                'name' => 'VIEW CUSTOMER',
                'guard_name' => 'web',
                'created_at' => '2019-12-02 10:57:54',
                'updated_at' => '2019-12-02 10:57:54',
            ),
            12 =>
            array (
                'id' => 13,
                'name' => 'USER LIST',
                'guard_name' => 'web',
                'created_at' => '2019-12-02 12:52:10',
                'updated_at' => '2019-12-02 12:52:10',
            ),
            13 =>
            array (
                'id' => 14,
                'name' => 'ADD USER',
                'guard_name' => 'web',
                'created_at' => '2019-12-02 12:52:18',
                'updated_at' => '2019-12-02 12:52:18',
            ),
            14 =>
            array (
                'id' => 15,
                'name' => 'EDIT USER',
                'guard_name' => 'web',
                'created_at' => '2019-12-02 12:52:25',
                'updated_at' => '2019-12-02 12:52:25',
            ),
            15 =>
            array (
                'id' => 16,
                'name' => 'DELETE USER',
                'guard_name' => 'web',
                'created_at' => '2019-12-02 12:52:32',
                'updated_at' => '2019-12-02 12:52:32',
            ),
            16 =>
            array (
                'id' => 17,
                'name' => 'VIEW USER',
                'guard_name' => 'web',
                'created_at' => '2019-12-02 12:52:53',
                'updated_at' => '2019-12-02 12:52:53',
            ),
            17 =>
            array (
                'id' => 18,
                'name' => 'ROLE LIST',
                'guard_name' => 'web',
                'created_at' => '2019-12-02 14:21:03',
                'updated_at' => '2019-12-02 14:21:03',
            ),
            18 =>
            array (
                'id' => 19,
                'name' => 'ADD ROLE',
                'guard_name' => 'web',
                'created_at' => '2019-12-02 14:21:10',
                'updated_at' => '2019-12-02 14:21:10',
            ),
            19 =>
            array (
                'id' => 20,
                'name' => 'EDIT ROLE',
                'guard_name' => 'web',
                'created_at' => '2019-12-02 14:21:26',
                'updated_at' => '2019-12-02 14:21:26',
            ),
            20 =>
            array (
                'id' => 21,
                'name' => 'VIEW ROLE',
                'guard_name' => 'web',
                'created_at' => '2019-12-02 14:21:38',
                'updated_at' => '2019-12-02 14:21:38',
            ),
            21 =>
            array (
                'id' => 22,
                'name' => 'DELETE ROLE',
                'guard_name' => 'web',
                'created_at' => '2019-12-02 14:21:55',
                'updated_at' => '2019-12-02 14:21:55',
            ),
            22 =>
            array (
                'id' => 23,
                'name' => 'PERMISSION LIST',
                'guard_name' => 'web',
                'created_at' => '2019-12-02 14:22:14',
                'updated_at' => '2019-12-02 14:22:14',
            ),
            23 =>
            array (
                'id' => 24,
                'name' => 'ADD PERMISSION',
                'guard_name' => 'web',
                'created_at' => '2019-12-02 14:22:23',
                'updated_at' => '2019-12-02 14:22:23',
            ),
            24 =>
            array (
                'id' => 25,
                'name' => 'EDIT PERMISSION',
                'guard_name' => 'web',
                'created_at' => '2019-12-02 14:22:32',
                'updated_at' => '2019-12-02 14:22:32',
            ),
            25 =>
            array (
                'id' => 26,
                'name' => 'VIEW PERMISSION',
                'guard_name' => 'web',
                'created_at' => '2019-12-02 14:22:39',
                'updated_at' => '2019-12-02 14:22:39',
            ),
            26 =>
            array (
                'id' => 27,
                'name' => 'DELETE PERMISSION',
                'guard_name' => 'web',
                'created_at' => '2019-12-02 14:22:45',
                'updated_at' => '2019-12-02 14:22:45',
            ),
            27 =>
            array (
                'id' => 29,
                'name' => 'ADD STOCK',
                'guard_name' => 'web',
                'created_at' => '2019-12-03 07:52:47',
                'updated_at' => '2019-12-03 07:52:47',
            ),
            28 =>
            array (
                'id' => 30,
                'name' => 'EDIT STOCK',
                'guard_name' => 'web',
                'created_at' => '2019-12-03 07:53:03',
                'updated_at' => '2019-12-03 07:53:03',
            ),
            29 =>
            array (
                'id' => 31,
                'name' => 'VIEW STOCK',
                'guard_name' => 'web',
                'created_at' => '2019-12-03 07:54:00',
                'updated_at' => '2019-12-03 07:54:00',
            ),
            30 =>
            array (
                'id' => 32,
                'name' => 'DELETE STOCK',
                'guard_name' => 'web',
                'created_at' => '2019-12-03 07:54:09',
                'updated_at' => '2019-12-03 07:54:09',
            ),
            31 =>
            array (
                'id' => 33,
                'name' => 'SUPPLIER LIST',
                'guard_name' => 'web',
                'created_at' => '2019-12-03 07:56:03',
                'updated_at' => '2019-12-03 07:56:03',
            ),
            32 =>
            array (
                'id' => 34,
                'name' => 'ADD SUPPLIER',
                'guard_name' => 'web',
                'created_at' => '2019-12-03 07:56:10',
                'updated_at' => '2019-12-03 07:56:10',
            ),
            33 =>
            array (
                'id' => 35,
                'name' => 'EDIT SUPPLIER',
                'guard_name' => 'web',
                'created_at' => '2019-12-03 07:56:18',
                'updated_at' => '2019-12-03 07:56:18',
            ),
            34 =>
            array (
                'id' => 36,
                'name' => 'VIEW SUPPLIER',
                'guard_name' => 'web',
                'created_at' => '2019-12-03 07:56:25',
                'updated_at' => '2019-12-03 07:56:25',
            ),
            35 =>
            array (
                'id' => 37,
                'name' => 'DELETE SUPPLIER',
                'guard_name' => 'web',
                'created_at' => '2019-12-03 07:56:32',
                'updated_at' => '2019-12-03 07:56:32',
            ),
            36 =>
            array (
                'id' => 38,
                'name' => 'SALES INVOICE',
                'guard_name' => 'web',
                'created_at' => '2019-12-03 08:18:45',
                'updated_at' => '2019-12-03 08:18:45',
            ),
            37 =>
            array (
                'id' => 39,
                'name' => 'AREA LIST',
                'guard_name' => 'web',
                'created_at' => '2019-12-03 08:27:12',
                'updated_at' => '2019-12-03 08:27:12',
            ),
            38 =>
            array (
                'id' => 40,
                'name' => 'ADD AREA',
                'guard_name' => 'web',
                'created_at' => '2019-12-03 08:27:19',
                'updated_at' => '2019-12-03 08:27:19',
            ),
            39 =>
            array (
                'id' => 41,
                'name' => 'EDIT AREA',
                'guard_name' => 'web',
                'created_at' => '2019-12-03 08:35:27',
                'updated_at' => '2019-12-03 08:35:27',
            ),
            40 =>
            array (
                'id' => 42,
                'name' => 'VIEW AREA',
                'guard_name' => 'web',
                'created_at' => '2019-12-03 08:35:37',
                'updated_at' => '2019-12-03 08:35:37',
            ),
            41 =>
            array (
                'id' => 43,
                'name' => 'DELETE AREA',
                'guard_name' => 'web',
                'created_at' => '2019-12-03 08:35:43',
                'updated_at' => '2019-12-03 08:35:43',
            ),
            42 =>
            array (
                'id' => 44,
                'name' => 'TERM LIST',
                'guard_name' => 'web',
                'created_at' => '2019-12-03 08:36:06',
                'updated_at' => '2019-12-03 08:36:06',
            ),
            43 =>
            array (
                'id' => 45,
                'name' => 'ADD TERM',
                'guard_name' => 'web',
                'created_at' => '2019-12-03 08:36:12',
                'updated_at' => '2019-12-03 08:37:47',
            ),
            44 =>
            array (
                'id' => 46,
                'name' => 'EDIT TERM',
                'guard_name' => 'web',
                'created_at' => '2019-12-03 08:37:57',
                'updated_at' => '2019-12-03 08:37:57',
            ),
            45 =>
            array (
                'id' => 47,
                'name' => 'VIEW TERM',
                'guard_name' => 'web',
                'created_at' => '2019-12-03 08:38:05',
                'updated_at' => '2019-12-03 08:38:05',
            ),
            46 =>
            array (
                'id' => 48,
                'name' => 'DELETE TERM',
                'guard_name' => 'web',
                'created_at' => '2019-12-03 08:38:12',
                'updated_at' => '2019-12-03 08:38:12',
            ),
            47 =>
            array (
                'id' => 49,
                'name' => 'CUSTOMER CATEGORY LIST',
                'guard_name' => 'web',
                'created_at' => '2019-12-03 08:38:44',
                'updated_at' => '2019-12-03 08:38:44',
            ),
            48 =>
            array (
                'id' => 50,
                'name' => 'ADD CUSTOMER CATEGORY',
                'guard_name' => 'web',
                'created_at' => '2019-12-03 08:38:55',
                'updated_at' => '2019-12-03 08:38:55',
            ),
            49 =>
            array (
                'id' => 51,
                'name' => 'EDIT CUSTOMER CATEGORY',
                'guard_name' => 'web',
                'created_at' => '2019-12-03 08:39:05',
                'updated_at' => '2019-12-03 08:39:05',
            ),
            50 =>
            array (
                'id' => 52,
                'name' => 'VIEW CUSTOMER CATEGORY',
                'guard_name' => 'web',
                'created_at' => '2019-12-03 08:39:14',
                'updated_at' => '2019-12-03 08:39:14',
            ),
            51 =>
            array (
                'id' => 53,
                'name' => 'DELETE CUSTOMER CATEGORY',
                'guard_name' => 'web',
                'created_at' => '2019-12-03 08:39:38',
                'updated_at' => '2019-12-03 08:39:38',
            ),
            52 =>
            array (
                'id' => 54,
                'name' => 'BANK LIST',
                'guard_name' => 'web',
                'created_at' => '2019-12-03 08:39:53',
                'updated_at' => '2019-12-03 08:39:53',
            ),
            53 =>
            array (
                'id' => 55,
                'name' => 'ADD BANK',
                'guard_name' => 'web',
                'created_at' => '2019-12-03 08:40:05',
                'updated_at' => '2019-12-03 08:40:05',
            ),
            54 =>
            array (
                'id' => 56,
                'name' => 'EDIT BANK',
                'guard_name' => 'web',
                'created_at' => '2019-12-03 08:40:14',
                'updated_at' => '2019-12-03 08:40:14',
            ),
            55 =>
            array (
                'id' => 57,
                'name' => 'VIEW BANK',
                'guard_name' => 'web',
                'created_at' => '2019-12-03 08:40:46',
                'updated_at' => '2019-12-03 08:40:46',
            ),
            56 =>
            array (
                'id' => 58,
                'name' => 'DELETE BANK',
                'guard_name' => 'web',
                'created_at' => '2019-12-03 08:40:53',
                'updated_at' => '2019-12-03 08:40:53',
            ),
            57 =>
            array (
                'id' => 59,
                'name' => 'AGENT LIST',
                'guard_name' => 'web',
                'created_at' => '2019-12-03 08:41:09',
                'updated_at' => '2019-12-03 08:41:09',
            ),
            58 =>
            array (
                'id' => 60,
                'name' => 'ADD AGENT',
                'guard_name' => 'web',
                'created_at' => '2019-12-03 08:41:17',
                'updated_at' => '2019-12-03 08:41:17',
            ),
            59 =>
            array (
                'id' => 61,
                'name' => 'EDIT AGENT',
                'guard_name' => 'web',
                'created_at' => '2019-12-03 08:41:26',
                'updated_at' => '2019-12-03 08:41:26',
            ),
            60 =>
            array (
                'id' => 62,
                'name' => 'VIEW AGENT',
                'guard_name' => 'web',
                'created_at' => '2019-12-03 08:41:39',
                'updated_at' => '2019-12-03 08:41:39',
            ),
            61 =>
            array (
                'id' => 63,
                'name' => 'DELETE AGENT',
                'guard_name' => 'web',
                'created_at' => '2019-12-03 08:41:47',
                'updated_at' => '2019-12-03 08:41:47',
            ),
            62 =>
            array (
                'id' => 64,
                'name' => 'STAFF LIST',
                'guard_name' => 'web',
                'created_at' => '2019-12-03 08:42:01',
                'updated_at' => '2019-12-03 08:42:01',
            ),
            63 =>
            array (
                'id' => 65,
                'name' => 'ADD STAFF',
                'guard_name' => 'web',
                'created_at' => '2019-12-03 08:42:09',
                'updated_at' => '2019-12-03 08:42:09',
            ),
            64 =>
            array (
                'id' => 66,
                'name' => 'EDIT STAFF',
                'guard_name' => 'web',
                'created_at' => '2019-12-03 08:42:16',
                'updated_at' => '2019-12-03 08:42:16',
            ),
            65 =>
            array (
                'id' => 67,
                'name' => 'VIEW STAFF',
                'guard_name' => 'web',
                'created_at' => '2019-12-03 08:42:23',
                'updated_at' => '2019-12-03 08:42:23',
            ),
            66 =>
            array (
                'id' => 68,
                'name' => 'DELETE STAFF',
                'guard_name' => 'web',
                'created_at' => '2019-12-03 08:42:35',
                'updated_at' => '2019-12-03 08:42:35',
            ),
            67 =>
            array (
                'id' => 69,
                'name' => 'STOCK CATEGORY LIST',
                'guard_name' => 'web',
                'created_at' => '2019-12-03 08:42:56',
                'updated_at' => '2019-12-03 08:49:12',
            ),
            68 =>
            array (
                'id' => 70,
                'name' => 'ADD STOCK CATEGORY',
                'guard_name' => 'web',
                'created_at' => '2019-12-03 08:43:08',
                'updated_at' => '2019-12-03 08:43:08',
            ),
            69 =>
            array (
                'id' => 71,
                'name' => 'EDIT STOCK CATEGORY',
                'guard_name' => 'web',
                'created_at' => '2019-12-03 08:43:16',
                'updated_at' => '2019-12-03 08:43:16',
            ),
            70 =>
            array (
                'id' => 72,
                'name' => 'VIEW STOCK CATEGORY',
                'guard_name' => 'web',
                'created_at' => '2019-12-03 08:43:29',
                'updated_at' => '2019-12-03 08:43:29',
            ),
            71 =>
            array (
                'id' => 73,
                'name' => 'DELETE STOCK CATEGORY',
                'guard_name' => 'web',
                'created_at' => '2019-12-03 08:43:41',
                'updated_at' => '2019-12-03 08:43:41',
            ),
            72 =>
            array (
                'id' => 74,
                'name' => 'PROFILE',
                'guard_name' => 'web',
                'created_at' => '2019-12-03 12:02:46',
                'updated_at' => '2019-12-03 12:02:46',
            ),
            73 =>
            array (
                'id' => 75,
                'name' => 'RECEIVE PAYMENT',
                'guard_name' => 'web',
                'created_at' => '2019-12-05 06:22:28',
                'updated_at' => '2019-12-05 06:22:28',
            ),
            74 =>
            array (
                'id' => 76,
                'name' => 'ADD RECEIVE PAYMENT',
                'guard_name' => 'web',
                'created_at' => '2019-12-05 06:22:50',
                'updated_at' => '2019-12-05 06:22:50',
            ),
            75 =>
            array (
                'id' => 77,
                'name' => 'EDIT RECEIVE PAYMENT',
                'guard_name' => 'web',
                'created_at' => '2019-12-05 06:23:04',
                'updated_at' => '2019-12-05 06:23:04',
            ),
            76 =>
            array (
                'id' => 78,
                'name' => 'PRINT RECEIVE VOUCHER',
                'guard_name' => 'web',
                'created_at' => '2019-12-05 06:24:45',
                'updated_at' => '2019-12-05 06:24:45',
            ),
            77 =>
            array (
                'id' => 79,
                'name' => 'CHECK RECEIVE PAYMENT',
                'guard_name' => 'web',
                'created_at' => '2019-12-05 06:25:47',
                'updated_at' => '2019-12-05 06:25:47',
            ),
            78 =>
            array (
                'id' => 80,
                'name' => 'UOMS LIST',
                'guard_name' => 'web',
                'created_at' => '2019-12-10 01:53:47',
                'updated_at' => '2019-12-10 01:53:47',
            ),
            79 =>
            array (
                'id' => 81,
                'name' => 'ADD UOMS',
                'guard_name' => 'web',
                'created_at' => '2019-12-10 01:54:01',
                'updated_at' => '2019-12-10 01:54:01',
            ),
            80 =>
            array (
                'id' => 82,
                'name' => 'EDIT UOMS',
                'guard_name' => 'web',
                'created_at' => '2019-12-10 01:54:21',
                'updated_at' => '2019-12-10 01:54:21',
            ),
            81 =>
            array (
                'id' => 83,
                'name' => 'VIEW UOMS',
                'guard_name' => 'web',
                'created_at' => '2019-12-10 01:54:31',
                'updated_at' => '2019-12-10 01:54:31',
            ),
            82 =>
            array (
                'id' => 84,
                'name' => 'DELETE UOMS',
                'guard_name' => 'web',
                'created_at' => '2019-12-10 01:54:40',
                'updated_at' => '2019-12-10 01:54:40',
            ),
            83 =>
            array (
                'id' => 85,
                'name' => 'PAYMENT VOUCHER',
                'guard_name' => 'web',
                'created_at' => '2019-12-10 22:15:57',
                'updated_at' => '2019-12-10 22:18:56',
            ),
            84 =>
            array (
                'id' => 86,
                'name' => 'ADD PAYMENT VOUCHER',
                'guard_name' => 'web',
                'created_at' => '2019-12-10 22:16:08',
                'updated_at' => '2019-12-10 22:18:05',
            ),
            85 =>
            array (
                'id' => 87,
                'name' => 'EDIT PAYMENT VOUCHER',
                'guard_name' => 'web',
                'created_at' => '2019-12-10 22:16:17',
                'updated_at' => '2019-12-10 22:18:20',
            ),
            86 =>
            array (
                'id' => 88,
                'name' => 'PRINT PAYMENT VOUCHER',
                'guard_name' => 'web',
                'created_at' => '2019-12-10 22:16:36',
                'updated_at' => '2019-12-10 22:16:36',
            ),
            87 =>
            array (
                'id' => 89,
                'name' => 'CHECK PAYMENT VOUCHER',
                'guard_name' => 'web',
                'created_at' => '2019-12-10 22:16:45',
                'updated_at' => '2019-12-10 22:18:39',
            ),
            88 =>
            array (
                'id' => 90,
                'name' => 'ALLOW CHANGE DATE',
                'guard_name' => 'web',
                'created_at' => '2019-12-11 14:03:20',
                'updated_at' => '2019-12-11 14:03:20',
            ),
            89 =>
            array (
                'id' => 91,
                'name' => 'CREDIT NOTE',
                'guard_name' => 'web',
                'created_at' => '2019-12-11 22:16:32',
                'updated_at' => '2019-12-11 22:16:32',
            ),
            90 =>
            array (
                'id' => 92,
                'name' => 'ADD CREDIT NOTE',
                'guard_name' => 'web',
                'created_at' => '2019-12-11 22:16:51',
                'updated_at' => '2019-12-11 22:16:51',
            ),
            91 =>
            array (
                'id' => 93,
                'name' => 'EDIT CREDIT NOTE',
                'guard_name' => 'web',
                'created_at' => '2019-12-11 22:16:59',
                'updated_at' => '2019-12-11 22:16:59',
            ),
            92 =>
            array (
                'id' => 94,
                'name' => 'PRINT CREDIT NOTE',
                'guard_name' => 'web',
                'created_at' => '2019-12-11 22:17:59',
                'updated_at' => '2019-12-11 22:17:59',
            ),
            93 =>
            array (
                'id' => 95,
                'name' => 'CHECK CREDIT NOTE',
                'guard_name' => 'web',
                'created_at' => '2019-12-11 22:18:19',
                'updated_at' => '2019-12-11 22:18:19',
            ),
            94 =>
            array (
                'id' => 96,
                'name' => 'PURCHASE ORDER',
                'guard_name' => 'web',
                'created_at' => '2019-12-12 02:47:21',
                'updated_at' => '2019-12-12 02:47:21',
            ),
            95 =>
            array (
                'id' => 97,
                'name' => 'ADD PURCHASE ORDER',
                'guard_name' => 'web',
                'created_at' => '2019-12-12 02:47:28',
                'updated_at' => '2019-12-12 02:47:28',
            ),
            96 =>
            array (
                'id' => 98,
                'name' => 'EDIT PURCHASE ORDER',
                'guard_name' => 'web',
                'created_at' => '2019-12-12 02:47:35',
                'updated_at' => '2019-12-12 02:47:35',
            ),
            97 =>
            array (
                'id' => 99,
                'name' => 'PRINT PURCHASE ORDER',
                'guard_name' => 'web',
                'created_at' => '2019-12-12 02:47:49',
                'updated_at' => '2019-12-12 02:47:49',
            ),
            98 =>
            array (
                'id' => 100,
                'name' => 'CHECK PURCHASE ORDER',
                'guard_name' => 'web',
                'created_at' => '2019-12-12 02:47:56',
                'updated_at' => '2019-12-12 02:47:56',
            ),
            99 =>
            array (
                'id' => 101,
                'name' => 'ADMIN AUTHORITY',
                'guard_name' => 'web',
                'created_at' => '2019-12-16 13:40:31',
                'updated_at' => '2019-12-16 13:40:31',
            ),
            100 =>
            array (
                'id' => 102,
                'name' => 'OUTSTANDING REPORT',
                'guard_name' => 'web',
                'created_at' => '2020-01-08 14:03:21',
                'updated_at' => '2020-01-08 14:03:21',
            ),
            101 =>
            array (
                'id' => 103,
                'name' => 'DASHBOARD - SALES (MONTHLY)',
                'guard_name' => 'web',
                'created_at' => '2020-01-09 12:06:59',
                'updated_at' => '2020-01-09 12:06:59',
            ),
            102 =>
            array (
                'id' => 104,
                'name' => 'DASHBOARD - SALES (ANNUAL)',
                'guard_name' => 'web',
                'created_at' => '2020-01-09 12:07:09',
                'updated_at' => '2020-01-09 12:07:09',
            ),
            103 =>
            array (
                'id' => 105,
                'name' => 'DASHBOARD - RECEIVED PAYMENT (MONTHLY)',
                'guard_name' => 'web',
                'created_at' => '2020-01-09 12:07:24',
                'updated_at' => '2020-01-09 12:07:24',
            ),
            104 =>
            array (
                'id' => 106,
                'name' => 'DASHBOARD - RECEIVED PAYMENT (YEARLY)',
                'guard_name' => 'web',
                'created_at' => '2020-01-09 12:07:46',
                'updated_at' => '2020-01-09 12:07:46',
            ),
            105 =>
            array (
                'id' => 107,
                'name' => 'DASHBOARD - SALES OVERVIEW',
                'guard_name' => 'web',
                'created_at' => '2020-01-09 12:07:57',
                'updated_at' => '2020-01-09 12:07:57',
            ),
            106 =>
            array (
                'id' => 108,
                'name' => 'DASHBOARD - AREA SALES',
                'guard_name' => 'web',
                'created_at' => '2020-01-09 12:08:13',
                'updated_at' => '2020-01-09 12:08:13',
            ),
            107 =>
            array (
                'id' => 109,
                'name' => 'DASHBOARD - AREA OUTSTANDING',
                'guard_name' => 'web',
                'created_at' => '2020-01-09 12:08:24',
                'updated_at' => '2020-01-09 12:08:24',
            ),
            108 =>
            array (
                'id' => 110,
                'name' => 'RECEIPT REPORT',
                'guard_name' => 'web',
                'created_at' => '2020-01-10 13:54:11',
                'updated_at' => '2020-01-10 13:54:11',
            ),
            109 =>
            array (
                'id' => 111,
                'name' => 'SALES REPORT',
                'guard_name' => 'web',
                'created_at' => '2020-01-13 14:23:17',
                'updated_at' => '2020-01-13 14:23:17',
            ),
            110 =>
            array (
                'id' => 112,
                'name' => 'PRINT CUSTOMER/SUPPLIER STICKER',
                'guard_name' => 'web',
                'created_at' => '2020-01-20 13:50:33',
                'updated_at' => '2020-01-20 13:50:33',
            ),
            111 =>
            array (
                'id' => 113,
                'name' => 'CUSTOMER GROUP LIST',
                'guard_name' => 'web',
                'created_at' => '2020-04-04 18:16:22',
                'updated_at' => '2020-04-04 18:16:22',
            ),
            112 =>
            array (
                'id' => 114,
                'name' => 'ADD CUSTOMER GROUP',
                'guard_name' => 'web',
                'created_at' => '2020-04-04 18:16:38',
                'updated_at' => '2020-04-04 18:16:38',
            ),
            113 =>
            array (
                'id' => 115,
                'name' => 'EDIT CUSTOMER GROUP',
                'guard_name' => 'web',
                'created_at' => '2020-04-04 18:16:51',
                'updated_at' => '2020-04-04 18:16:51',
            ),
            114 =>
            array (
                'id' => 116,
                'name' => 'VIEW CUSTOMER GROUP',
                'guard_name' => 'web',
                'created_at' => '2020-04-04 18:16:58',
                'updated_at' => '2020-04-04 18:16:58',
            ),
            115 =>
            array (
                'id' => 117,
                'name' => 'DELETE CUSTOMER GROUP',
                'guard_name' => 'web',
                'created_at' => '2020-04-04 18:17:04',
                'updated_at' => '2020-04-04 18:17:04',
            ),
            116 =>
            array (
                'id' => 118,
                'name' => 'CUSTOMER SERVICE LIST',
                'guard_name' => 'web',
                'created_at' => '2020-04-08 08:44:17',
                'updated_at' => '2020-04-08 08:44:17',
            ),
            117 =>
            array (
                'id' => 119,
                'name' => 'ADD CUSTOMER SERVICE',
                'guard_name' => 'web',
                'created_at' => '2020-04-08 08:44:28',
                'updated_at' => '2020-04-08 08:44:28',
            ),
            118 =>
            array (
                'id' => 120,
                'name' => 'EDIT CUSTOMER SERVICE',
                'guard_name' => 'web',
                'created_at' => '2020-04-08 08:44:39',
                'updated_at' => '2020-04-08 08:44:39',
            ),
            119 =>
            array (
                'id' => 121,
                'name' => 'DELETE CUSTOMER SERVICE',
                'guard_name' => 'web',
                'created_at' => '2020-04-08 08:44:51',
                'updated_at' => '2020-04-08 08:44:51',
            ),
            120 =>
            array (
                'id' => 122,
                'name' => 'PWS PG APP SERVICE LIST',
                'guard_name' => 'web',
                'created_at' => '2020-04-21 21:56:45',
                'updated_at' => '2020-04-21 21:56:45',
            ),
            121 =>
            array (
                'id' => 123,
                'name' => 'ADD PWS PG APP SERVICE',
                'guard_name' => 'web',
                'created_at' => '2020-04-21 21:57:02',
                'updated_at' => '2020-04-21 21:57:02',
            ),
            122 =>
            array (
                'id' => 124,
                'name' => 'EDIT PWS PG APP SERVICE',
                'guard_name' => 'web',
                'created_at' => '2020-04-21 21:57:17',
                'updated_at' => '2020-04-21 21:57:17',
            ),
            123 =>
            array (
                'id' => 125,
                'name' => 'DELETE PWS PG APP SERVICE',
                'guard_name' => 'web',
                'created_at' => '2020-04-21 21:57:34',
                'updated_at' => '2020-04-21 21:57:34',
            ),
            124 =>
            array (
                'id' => 126,
                'name' => 'CUSTOMER SERVICE PRICE',
                'guard_name' => 'web',
                'created_at' => '2020-04-22 08:05:28',
                'updated_at' => '2020-04-22 08:05:28',
            ),
            125 =>
            array (
                'id' => 127,
                'name' => 'UPLOAD SYSTEM FILE',
                'guard_name' => 'web',
                'created_at' => '2020-04-24 20:28:11',
                'updated_at' => '2020-04-24 20:28:11',
            ),
            126 =>
            array (
                'id' => 128,
                'name' => 'CUSTOMER SALES DATA EXPORT (LHDN)',
                'guard_name' => 'web',
                'created_at' => '2020-05-17 12:35:05',
                'updated_at' => '2020-05-17 12:35:05',
            ),
            127 =>
            array (
                'id' => 129,
                'name' => 'SERVICE MAINTENANCE REPORT',
                'guard_name' => 'web',
                'created_at' => '2020-06-05 15:08:27',
                'updated_at' => '2020-06-05 15:08:27',
            ),
            128 =>
            array (
                'id' => 130,
                'name' => 'SYSTEM SETTING',
                'guard_name' => 'web',
                'created_at' => '2020-10-30 14:29:24',
                'updated_at' => '2020-10-30 14:29:24',
            ),
            129 =>
            array (
                'id' => 131,
                'name' => 'DASHBOARD - MAINTENANCE SERVICE',
                'guard_name' => 'web',
                'created_at' => '2020-11-03 13:32:15',
                'updated_at' => '2020-11-03 13:32:15',
            ),
            130 =>
            array (
                'id' => 132,
                'name' => 'SERVICES RATE PROFILE LIST',
                'guard_name' => 'web',
                'created_at' => '2020-12-28 06:30:39',
                'updated_at' => '2020-12-28 06:30:39',
            ),
            131 =>
            array (
                'id' => 133,
                'name' => 'ADD SERVICES RATE PROFILE',
                'guard_name' => 'web',
                'created_at' => '2020-12-28 06:30:57',
                'updated_at' => '2020-12-28 06:30:57',
            ),
            132 =>
            array (
                'id' => 134,
                'name' => 'EDIT SERVICES RATE PROFILE',
                'guard_name' => 'web',
                'created_at' => '2020-12-28 06:31:07',
                'updated_at' => '2020-12-28 06:31:07',
            ),
            133 =>
            array (
                'id' => 135,
                'name' => 'DELETE SERVICES RATE PROFILE',
                'guard_name' => 'web',
                'created_at' => '2020-12-28 06:31:15',
                'updated_at' => '2020-12-28 06:31:15',
            ),
            134 =>
            array (
                'id' => 136,
                'name' => 'VIEW SERVICES RATE PROFILE',
                'guard_name' => 'web',
                'created_at' => '2020-12-28 06:31:22',
                'updated_at' => '2020-12-28 06:31:22',
            ),
            135 =>
            array (
                'id' => 137,
                'name' => 'SOLUTION PROFILE LIST',
                'guard_name' => 'web',
                'created_at' => '2020-12-29 03:57:41',
                'updated_at' => '2020-12-29 03:57:41',
            ),
            136 =>
            array (
                'id' => 138,
                'name' => 'ADD SOLUTION PROFILE',
                'guard_name' => 'web',
                'created_at' => '2020-12-29 03:57:46',
                'updated_at' => '2020-12-29 03:57:46',
            ),
            137 =>
            array (
                'id' => 139,
                'name' => 'EDIT SOLUTION PROFILE',
                'guard_name' => 'web',
                'created_at' => '2020-12-29 03:57:51',
                'updated_at' => '2020-12-29 03:57:51',
            ),
            138 =>
            array (
                'id' => 140,
                'name' => 'DELETE SOLUTION PROFILE',
                'guard_name' => 'web',
                'created_at' => '2020-12-29 03:57:57',
                'updated_at' => '2020-12-29 03:57:57',
            ),
            139 =>
            array (
                'id' => 141,
                'name' => 'VIEW SOLUTION PROFILE',
                'guard_name' => 'web',
                'created_at' => '2020-12-29 03:58:21',
                'updated_at' => '2020-12-29 03:58:21',
            ),
            140 =>
            array (
                'id' => 147,
                'name' => 'DASHBOARD - SOFTWARE SERVICE',
                'guard_name' => 'web',
                'created_at' => '2021-01-09 03:17:24',
                'updated_at' => '2021-01-09 03:17:24',
            ),
            141 =>
            array (
                'id' => 142,
                'name' => 'SOFTWARE SERVICE LIST',
                'guard_name' => 'web',
                'created_at' => '2020-12-31 05:57:18',
                'updated_at' => '2020-12-31 05:57:18',
            ),
            142 =>
            array (
                'id' => 143,
                'name' => 'ADD SOFTWARE SERVICE',
                'guard_name' => 'web',
                'created_at' => '2020-12-31 05:57:22',
                'updated_at' => '2020-12-31 05:57:22',
            ),
            143 =>
            array (
                'id' => 144,
                'name' => 'VIEW SOFTWARE SERVICE',
                'guard_name' => 'web',
                'created_at' => '2020-12-31 05:57:32',
                'updated_at' => '2020-12-31 05:57:32',
            ),
            144 =>
            array (
                'id' => 145,
                'name' => 'EDIT SOFTWARE SERVICE',
                'guard_name' => 'web',
                'created_at' => '2020-12-31 05:57:36',
                'updated_at' => '2020-12-31 05:57:36',
            ),
            145 =>
            array (
                'id' => 146,
                'name' => 'DELETE SOFTWARE SERVICE',
                'guard_name' => 'web',
                'created_at' => '2020-12-31 05:57:40',
                'updated_at' => '2020-12-31 05:57:40',
            ),
            146 =>
            array (
                'id' => 148,
                'name' => 'CANCEL SALES INVOICE',
                'guard_name' => 'web',
                'created_at' => '2021-01-16 12:22:34',
                'updated_at' => '2021-01-16 12:22:34',
            ),
            147 =>
            array (
                'id' => 149,
                'name' => 'CANCEL SALES REPORT',
                'guard_name' => 'web',
                'created_at' => '2021-01-20 06:00:39',
                'updated_at' => '2021-01-20 06:00:39',
            ),
            148 =>
            array (
                'id' => 150,
                'name' => 'CREDIT NOTE REPORT',
                'guard_name' => 'web',
                'created_at' => '2021-01-20 16:05:50',
                'updated_at' => '2021-01-20 16:05:50',
            ),
            149 =>
            array (
                'id' => 151,
                'name' => 'FILE MANAGEMENT REPORT',
                'guard_name' => 'web',
                'created_at' => '2021-01-20 16:32:01',
                'updated_at' => '2021-01-20 16:32:01',
            ),
            150 =>
            array (
                'id' => 152,
                'name' => 'DASHBOARD - OUTSTANDING JOB',
                'guard_name' => 'web',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            151 =>
            array (
                'id' => 153,
                'name' => 'DASHBOARD - SERVICE FORM',
                'guard_name' => 'web',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            152 =>
            array (
                'id' => 154,
                'name' => 'SERVICE FORM',
                'guard_name' => 'web',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            153 =>
            array (
                'id' => 155,
                'name' => 'COMPANY SETTING',
                'guard_name' => 'web',
                'created_at' => '2021-03-21 19:18:35',
                'updated_at' => NULL,
            ),
            154 =>
            array (
                'id' => 156,
                'name' => 'ADD COMPANY',
                'guard_name' => 'web',
                'created_at' => '2021-03-21 19:18:35',
                'updated_at' => NULL,
            ),
            155 =>
            array (
                'id' => 157,
                'name' => 'EDIT COMPANY',
                'guard_name' => 'web',
                'created_at' => '2021-03-21 19:22:07',
                'updated_at' => NULL,
            ),
            156 =>
            array (
                'id' => 158,
                'name' => 'VIEW COMPANY',
                'guard_name' => 'web',
                'created_at' => '2021-03-21 19:22:07',
                'updated_at' => NULL,
            ),
            157 =>
            array (
                'id' => 159,
                'name' => 'DELETE COMPANY',
                'guard_name' => 'web',
                'created_at' => '2021-03-21 19:24:20',
                'updated_at' => NULL,
            ),
            158 =>
            array (
                'id' => 160,
                'name' => 'BANK DOC',
                'guard_name' => 'web',
                'created_at' => '2021-04-10 16:42:36',
                'updated_at' => '2021-04-10 16:42:36',
            ),
            159 =>
            array (
                'id' => 161,
                'name' => 'ADD BANK DOC',
                'guard_name' => 'web',
                'created_at' => '2021-04-10 16:42:55',
                'updated_at' => '2021-04-10 16:42:55',
            ),
            160 =>
            array (
                'id' => 162,
                'name' => 'EDIT BANK DOC',
                'guard_name' => 'web',
                'created_at' => '2021-04-10 16:43:04',
                'updated_at' => '2021-04-10 16:43:04',
            ),
            161 =>
            array (
                'id' => 163,
                'name' => 'DELETE CLOSE CASE SERVICE',
                'guard_name' => 'web',
                'created_at' => '2021-04-21 15:13:08',
                'updated_at' => '2021-04-21 15:13:08',
            ),
            162 =>
            array (
                'id' => 164,
                'name' => 'EDIT CLOSE CASE SERVICE',
                'guard_name' => 'web',
                'created_at' => '2021-04-21 15:13:15',
                'updated_at' => '2021-04-21 15:13:15',
            ),
            163 =>
            array (
                'id' => 165,
                'name' => 'OUTSTANDING JOB NOTIFICATION',
                'guard_name' => 'web',
                'created_at' => '2021-05-17 07:32:47',
                'updated_at' => '2021-05-17 07:32:47',
            ),
            164 =>
            array (
                'id' => 166,
                'name' => 'STAFF SERVICE REPORT',
                'guard_name' => 'web',
                'created_at' => '2021-06-22 14:13:18',
                'updated_at' => '2021-06-22 14:13:18',
            ),
            165 =>
            array (
                'id' => 167,
                'name' => 'TOTALPAY APP SERVICE LIST',
                'guard_name' => 'web',
                'created_at' => '2021-07-03 09:42:20',
                'updated_at' => '2021-07-03 09:42:20',
            ),
            166 =>
            array (
                'id' => 168,
                'name' => 'ADD TOTALPAY APP SERVICE',
                'guard_name' => 'web',
                'created_at' => '2021-07-03 09:42:32',
                'updated_at' => '2021-07-03 09:42:32',
            ),
            167 =>
            array (
                'id' => 169,
                'name' => 'EDIT TOTALPAY APP SERVICE',
                'guard_name' => 'web',
                'created_at' => '2021-07-03 09:42:44',
                'updated_at' => '2021-07-03 09:42:44',
            ),
            168 =>
            array (
                'id' => 170,
                'name' => 'DELETE TOTALPAY APP SERVICE',
                'guard_name' => 'web',
                'created_at' => '2021-07-03 09:42:54',
                'updated_at' => '2021-07-03 09:42:54',
            ),
            169 =>
            array (
                'id' => 171,
                'name' => 'TRAINING FORM LIST',
                'guard_name' => 'web',
                'created_at' => '2021-08-23 10:35:34',
                'updated_at' => '2021-08-23 10:35:34',
            ),
            170 =>
            array (
                'id' => 172,
                'name' => 'ADD TRAINING FORM',
                'guard_name' => 'web',
                'created_at' => '2021-08-23 10:35:44',
                'updated_at' => '2021-08-23 10:35:44',
            ),
            171 =>
            array (
                'id' => 173,
                'name' => 'VIEW TRAINING FORM',
                'guard_name' => 'web',
                'created_at' => '2021-08-23 10:35:51',
                'updated_at' => '2021-08-23 10:35:51',
            ),
            172 =>
            array (
                'id' => 174,
                'name' => 'EDIT TRAINING FORM',
                'guard_name' => 'web',
                'created_at' => '2021-08-23 10:35:59',
                'updated_at' => '2021-08-23 10:35:59',
            ),
            173 =>
            array (
                'id' => 175,
                'name' => 'DELETE TRAINING FORM',
                'guard_name' => 'web',
                'created_at' => '2021-08-23 10:36:10',
                'updated_at' => '2021-08-23 10:36:10',
            ),
            174 =>
            array (
                'id' => 176,
                'name' => 'SORT TRAINING FORM',
                'guard_name' => 'web',
                'created_at' => '2021-08-23 10:36:18',
                'updated_at' => '2021-08-23 10:36:18',
            ),
            175 =>
            array (
                'id' => 177,
                'name' => 'PRINT UNSIGNED SERVICE FORM',
                'guard_name' => 'web',
                'created_at' => '2021-10-31 21:30:00',
                'updated_at' => '2021-10-31 21:30:00',
            ),
            176 =>
            array (
                'id' => 178,
                'name' => 'EVALUATION FORM LIST',
                'guard_name' => 'web',
                'created_at' => '2023-01-18 16:14:01',
                'updated_at' => '2023-01-18 16:14:01',
            ),
            177 =>
            array (
                'id' => 179,
                'name' => 'ADD EVALUATION FORM',
                'guard_name' => 'web',
                'created_at' => '2023-01-18 16:14:14',
                'updated_at' => '2023-01-18 16:14:14',
            ),
            178 =>
            array (
                'id' => 180,
                'name' => 'EDIT EVALUATION FORM',
                'guard_name' => 'web',
                'created_at' => '2023-01-18 16:14:31',
                'updated_at' => '2023-01-18 16:14:31',
            ),
            179 =>
            array (
                'id' => 181,
                'name' => 'VIEW EVALUATION FORM',
                'guard_name' => 'web',
                'created_at' => '2023-01-18 16:14:50',
                'updated_at' => '2023-01-18 16:14:50',
            ),
            180 =>
            array (
                'id' => 182,
                'name' => 'DELETE EVALUATION FORM',
                'guard_name' => 'web',
                'created_at' => '2023-01-18 16:15:13',
                'updated_at' => '2023-01-18 16:15:13',
            ),
            181 =>
            array (
                'id' => 183,
                'name' => 'SERIALIZATION CATEGORY REPORT',
                'guard_name' => 'web',
                'created_at' => '2023-01-31 11:30:51',
                'updated_at' => '2023-01-31 11:30:51',
            ),
            182 =>
            array (
                'id' => 184,
                'name' => 'LEAVE FORM LIST',
                'guard_name' => 'web',
                'created_at' => '2023-02-08 09:41:13',
                'updated_at' => '2023-02-08 09:41:13',
            ),
            183 =>
            array (
                'id' => 185,
                'name' => 'ADD LEAVE FORM',
                'guard_name' => 'web',
                'created_at' => '2023-02-08 09:41:20',
                'updated_at' => '2023-02-08 09:41:20',
            ),
            184 =>
            array (
                'id' => 186,
                'name' => 'EDIT LEAVE FORM',
                'guard_name' => 'web',
                'created_at' => '2023-02-08 09:41:27',
                'updated_at' => '2023-02-08 09:41:27',
            ),
            185 =>
            array (
                'id' => 187,
                'name' => 'DELETE LEAVE FORM',
                'guard_name' => 'web',
                'created_at' => '2023-02-08 09:41:34',
                'updated_at' => '2023-02-08 09:41:34',
            ),
            186 =>
            array (
                'id' => 188,
                'name' => 'VIEW LEAVE FORM',
                'guard_name' => 'web',
                'created_at' => '2023-02-08 09:41:40',
                'updated_at' => '2023-02-08 09:41:40',
            ),
            187 =>
            array (
                'id' => 189,
                'name' => 'APPROVE LEAVE FORM',
                'guard_name' => 'web',
                'created_at' => '2023-02-08 09:41:46',
                'updated_at' => '2023-02-08 09:41:46',
            ),
            188 =>
            array (
                'id' => 190,
                'name' => 'CANCEL PAYMENT VOUCHER',
                'guard_name' => 'web',
                'created_at' => '2023-04-03 09:24:03',
                'updated_at' => '2023-04-03 09:24:03',
            ),
        ));


    }
}
