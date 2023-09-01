<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;

class CategoryVersionTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {

        Schema::disableForeignKeyConstraints();
        \DB::table('category_versions')->delete();

        \DB::table('category_versions')->insert(array (
            0 =>
            array (
                'id' => 1,
                'customer_categories_id' => 1,
                'version' => '6.0.24.4',
                'version_desc' => 'TESTING',
                'created_at' => '2020-04-24 20:29:46',
                'updated_at' => '2020-04-24 20:29:46',
            ),
            1 =>
            array (
                'id' => 2,
                'customer_categories_id' => 1,
                'version' => '6.0.25.4',
                'version_desc' => 'TESTING',
                'created_at' => '2020-04-24 21:36:22',
                'updated_at' => '2020-04-24 21:36:22',
            ),
            2 =>
            array (
                'id' => 3,
                'customer_categories_id' => 1,
                'version' => '6.0.30.4',
                'version_desc' => 'FIX BUGS',
                'created_at' => '2020-04-30 19:36:53',
                'updated_at' => '2020-04-30 19:36:53',
            ),
            3 =>
            array (
                'id' => 4,
                'customer_categories_id' => 1,
                'version' => '6.0.1.5',
                'version_desc' => 'TESTING LIVE UPDATE',
                'created_at' => '2020-05-01 10:08:01',
                'updated_at' => '2020-05-01 10:08:01',
            ),
            4 =>
            array (
                'id' => 5,
                'customer_categories_id' => 1,
                'version' => '6.0.5.5',
                'version_desc' => 'SOLVED PROMOTION RATE PROBLEM',
                'created_at' => '2020-05-05 10:51:41',
                'updated_at' => '2020-05-05 10:51:41',
            ),
            5 =>
            array (
                'id' => 6,
                'customer_categories_id' => 1,
                'version' => '6.0.9.5',
                'version_desc' => 'UPDATE RECEIPT PRINTING, UPDATE PROMOTION FLOW',
                'created_at' => '2020-05-09 10:59:23',
                'updated_at' => '2020-05-09 10:59:23',
            ),
            6 =>
            array (
                'id' => 7,
                'customer_categories_id' => 1,
                'version' => '6.0.13.5',
                'version_desc' => 'ADD QRCODE FOR SCAN HEALTH DATA ENTRY, FIXED PRINTING ALIGNMENT FOR ON RECEIPT REPORT',
                'created_at' => '2020-05-13 10:14:38',
                'updated_at' => '2020-05-13 10:14:38',
            ),
            7 =>
            array (
                'id' => 8,
                'customer_categories_id' => 1,
                'version' => '6.0.14.5',
                'version_desc' => 'SHOW CUSTOMER TEMPERATURE FOR PAWN, REDEEM, REPAWN SETTING ON.',
                'created_at' => '2020-05-14 20:33:27',
                'updated_at' => '2020-05-14 20:33:27',
            ),
            8 =>
            array (
                'id' => 9,
                'customer_categories_id' => 1,
                'version' => '6.0.15.5',
                'version_desc' => 'FIXED UPDATE BUGS',
                'created_at' => '2020-05-15 13:52:02',
                'updated_at' => '2020-05-15 14:41:25',
            ),
            9 =>
            array (
                'id' => 10,
                'customer_categories_id' => 1,
                'version' => '6.0.18.5',
                'version_desc' => 'PROMOTION ADDED UNTIL DATE.',
                'created_at' => '2020-05-18 14:54:19',
                'updated_at' => '2020-05-18 14:54:19',
            ),
            10 =>
            array (
                'id' => 14,
                'customer_categories_id' => 15,
                'version' => '6.0.30.10',
                'version_desc' => 'TESTING',
                'created_at' => '2020-10-30 07:57:16',
                'updated_at' => '2020-10-30 07:57:16',
            ),
            11 =>
            array (
                'id' => 13,
                'customer_categories_id' => 1,
                'version' => '6.0.24.10',
                'version_desc' => 'FIX GROUP REPAWN CDD ISSUES. ADDED EDIT CDD INFO ON CHECK TICKET SHORTCUT KEY CTRL F2. ADDED SOLD ITEM CALCULATION BY SETTING. ADDED EXTRA CHARGES FOR TICKET WHICH SENT OUT REG LETTER BY SETT',
                'created_at' => '2020-10-24 11:50:55',
                'updated_at' => '2020-10-24 11:50:55',
            ),
            12 =>
            array (
                'id' => 15,
                'customer_categories_id' => 7,
                'version' => '7.0.12.1',
                'version_desc' => 'SDASDASD',
                'created_at' => '2021-01-12 14:36:34',
                'updated_at' => '2021-01-12 14:36:34',
            ),
            13 =>
            array (
                'id' => 16,
                'customer_categories_id' => 1,
                'version' => '7.0.16.1',
                'version_desc' => 'ADDED PROMOTION ON CALCULATE INTEREST BY DAY OR MONTH, ADD LOYALTY POINT TRANSFER BRANCH. FIXED SOME BUGS.',
                'created_at' => '2021-01-16 10:17:01',
                'updated_at' => '2021-01-16 10:17:01',
            ),
            14 =>
            array (
                'id' => 17,
                'customer_categories_id' => 7,
                'version' => '7.0.22.1',
                'version_desc' => 'TEST UPDATE',
                'created_at' => '2021-01-22 07:54:45',
                'updated_at' => '2021-01-22 14:22:28',
            ),
            15 =>
            array (
                'id' => 18,
                'customer_categories_id' => 1,
                'version' => '7.0.22.1',
                'version_desc' => 'FIXED GROUP REPAWN BNM CDD BUG.',
                'created_at' => '2021-01-22 15:30:14',
                'updated_at' => '2021-01-22 15:30:14',
            ),
            16 =>
            array (
                'id' => 19,
                'customer_categories_id' => 7,
                'version' => '7.0.23.1',
                'version_desc' => 'IN MAINTENANCE MODULE OCCUPATION/PURPOSE OF TRANSACTION ABLE TO ADD RISK POINT FOR EACH DATA , ADD NEW SETTING , AUTO UPDATE UNSCR LIST, FIX BUGS.',
                'created_at' => '2021-01-23 09:35:47',
                'updated_at' => '2021-01-23 09:35:47',
            ),
            17 =>
            array (
                'id' => 20,
                'customer_categories_id' => 5,
                'version' => '7.0.8.3',
                'version_desc' => 'TEST UPDATE',
                'created_at' => '2021-03-08 06:35:07',
                'updated_at' => '2021-03-08 06:35:07',
            ),
            18 =>
            array (
                'id' => 21,
                'customer_categories_id' => 5,
                'version' => '7.0.4.5',
            'version_desc' => 'SOLVED BUG , ALLOW VIEW LOAN LEDGER IN ENQUIRY (LOAN ACCOUNT) , ALLOW LIVEUPDATE , SOLVED PAYMENT AMOUNT SHOW INCORRECT , ALLOW DIFFERENT INPUT FORM TYPE.',
                'created_at' => '2021-05-04 15:40:50',
                'updated_at' => '2021-05-04 15:40:50',
            ),
            19 =>
            array (
                'id' => 22,
                'customer_categories_id' => 5,
                'version' => '7.0.15.6',
                'version_desc' => 'ALLOW LIVEUPDATE',
                'created_at' => '2021-06-15 14:42:27',
                'updated_at' => '2021-06-15 14:42:27',
            ),
            20 =>
            array (
                'id' => 23,
                'customer_categories_id' => 1,
                'version' => '7.0.12.7',
                'version_desc' => 'UPDATE PAWN SYSTEM',
                'created_at' => '2021-07-12 09:12:04',
                'updated_at' => '2021-07-12 09:12:04',
            ),
            21 =>
            array (
                'id' => 24,
                'customer_categories_id' => 7,
                'version' => '7.0.12.7',
                'version_desc' => 'UPDATE BNM SYSTEM',
                'created_at' => '2021-07-12 14:52:27',
                'updated_at' => '2021-07-12 14:52:27',
            ),
            22 =>
            array (
                'id' => 25,
                'customer_categories_id' => 1,
                'version' => '7.0.30.7',
                'version_desc' => 'UPDATE SYSTEM ADD NEW SERVICES.',
                'created_at' => '2021-07-30 15:51:01',
                'updated_at' => '2021-07-30 15:51:01',
            ),
            23 =>
            array (
                'id' => 26,
                'customer_categories_id' => 1,
                'version' => '7.0.4.8',
                'version_desc' => 'FIX PRE-AUCTION BUGS.',
                'created_at' => '2021-08-04 15:27:44',
                'updated_at' => '2021-08-04 15:27:44',
            ),
            24 =>
            array (
                'id' => 27,
                'customer_categories_id' => 1,
                'version' => '8.0.8.1',
                'version_desc' => 'UPDATE ONLINE PAYMENT TRANSACTION, TOTALPAY APP FEATURES.',
                'created_at' => '2022-01-08 09:25:01',
                'updated_at' => '2022-01-08 09:25:01',
            ),
            25 =>
            array (
                'id' => 28,
                'customer_categories_id' => 1,
                'version' => '8.0.10.1',
                'version_desc' => 'FIXED INTEREST SETTING UPDATE WRONG',
                'created_at' => '2022-01-10 14:50:44',
                'updated_at' => '2022-01-10 14:50:44',
            ),
            26 =>
            array (
                'id' => 29,
                'customer_categories_id' => 1,
                'version' => '9.0.17.4',
                'version_desc' => 'LATEST UPDATE FOR PAWN SYSTEM , FIX BUG AND UPDATE FOR LATEST BNM MOHA LIST',
                'created_at' => '2023-04-17 08:35:09',
                'updated_at' => '2023-04-17 08:35:09',
            ),
            27 =>
            array (
                'id' => 30,
                'customer_categories_id' => 7,
                'version' => '9.0.17.4',
                'version_desc' => 'UPDATE FOR LATEST MOHA LIST',
                'created_at' => '2023-04-17 14:12:26',
                'updated_at' => '2023-04-17 14:12:26',
            ),
        ));
        Schema::enableForeignKeyConstraints();

    }
}
