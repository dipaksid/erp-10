<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;

class CustomerCategoriesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        
		Schema::disableForeignKeyConstraints();
        \DB::table('customer_categories')->delete();
        
        \DB::table('customer_categories')->insert(array (
            0 => 
            array (
                'id' => 1,
                'categoryid' => '63',
                'categorycode' => 'PWS',
                'description' => 'WIN PAWN SYSTEM',
                'lastrunno' => '1800055951',
                'version' => '9.0.17.4',
                'b_rmk' => 'N',
                'b_mobapp' => 'N',
                'b_adrmk' => 'N',
                'stockcatgid' => 1,
                'created_at' => NULL,
                'updated_at' => '2023-06-13 07:12:07',
            ),
            1 => 
            array (
                'id' => 2,
                'categoryid' => '134',
                'categorycode' => 'GSS',
                'description' => 'WIN GOLDSMITH SYSTEM',
                'lastrunno' => '1900055622',
                'version' => '',
                'b_rmk' => 'N',
                'b_mobapp' => 'N',
                'b_adrmk' => 'N',
                'stockcatgid' => 1,
                'created_at' => NULL,
                'updated_at' => '2023-05-30 08:02:24',
            ),
            2 => 
            array (
                'id' => 3,
                'categoryid' => '135',
                'categorycode' => 'OTH',
                'description' => 'OTHER',
                'lastrunno' => '0000000000',
                'version' => '',
                'b_rmk' => 'N',
                'b_mobapp' => 'N',
                'b_adrmk' => 'N',
                'stockcatgid' => NULL,
                'created_at' => NULL,
                'updated_at' => '2020-04-27 18:14:00',
            ),
            3 => 
            array (
                'id' => 4,
                'categoryid' => '136',
                'categorycode' => 'AUS',
                'description' => 'AUCTIONEER CONTROL SYSTEM',
                'lastrunno' => '1200055553',
                'version' => '',
                'b_rmk' => 'N',
                'b_mobapp' => 'N',
                'b_adrmk' => 'N',
                'stockcatgid' => 1,
                'created_at' => NULL,
                'updated_at' => '2020-11-02 13:53:15',
            ),
            4 => 
            array (
                'id' => 5,
                'categoryid' => '',
                'categorycode' => 'MLS',
                'description' => 'MONEY LENDER SYSTEM',
                'lastrunno' => '2200055533',
                'version' => '7.0.15.6',
                'b_rmk' => 'N',
                'b_mobapp' => 'N',
                'b_adrmk' => 'N',
                'stockcatgid' => 1,
                'created_at' => '2019-12-03 13:35:09',
                'updated_at' => '2023-01-19 15:19:16',
            ),
            5 => 
            array (
                'id' => 6,
                'categoryid' => '',
                'categorycode' => 'JBS',
                'description' => 'JUAL/BELI SYSTEM',
                'lastrunno' => '2300055021',
                'version' => '',
                'b_rmk' => 'N',
                'b_mobapp' => 'N',
                'b_adrmk' => 'N',
                'stockcatgid' => 1,
                'created_at' => '2019-12-03 13:35:32',
                'updated_at' => '2023-05-22 05:52:33',
            ),
            6 => 
            array (
                'id' => 7,
                'categoryid' => '',
                'categorycode' => 'BNM',
                'description' => 'AFT/CLT SCREENING SYSTEM',
                'lastrunno' => '2600000324',
                'version' => '9.0.17.4',
                'b_rmk' => 'N',
                'b_mobapp' => 'N',
                'b_adrmk' => 'N',
                'stockcatgid' => 1,
                'created_at' => '2020-04-06 14:03:43',
                'updated_at' => '2023-06-13 07:12:36',
            ),
            7 => 
            array (
                'id' => 8,
                'categoryid' => '',
                'categorycode' => 'QNE',
                'description' => 'THIRD PARTY QNE ACCOUNTING SYSTEM',
                'lastrunno' => '0000000000',
                'version' => '',
                'b_rmk' => 'Y',
                'b_mobapp' => 'N',
                'b_adrmk' => 'Y',
                'stockcatgid' => 9,
                'created_at' => '2020-05-08 08:18:46',
                'updated_at' => '2020-12-21 12:37:22',
            ),
            8 => 
            array (
                'id' => 9,
                'categoryid' => '',
                'categorycode' => 'CCTV',
                'description' => 'CCTV SYSTEM',
                'lastrunno' => '0000000000',
                'version' => '',
                'b_rmk' => 'N',
                'b_mobapp' => 'N',
                'b_adrmk' => 'N',
                'stockcatgid' => 1,
                'created_at' => '2020-05-11 11:38:33',
                'updated_at' => '2022-02-12 07:49:39',
            ),
            9 => 
            array (
                'id' => 10,
                'categoryid' => '',
                'categorycode' => 'DNS1',
                'description' => 'DYNDNS DOMAIN NAME SET 1',
                'lastrunno' => '0000000000',
                'version' => '',
                'b_rmk' => 'Y',
                'b_mobapp' => 'N',
                'b_adrmk' => 'Y',
                'stockcatgid' => 9,
                'created_at' => '2020-05-11 11:39:04',
                'updated_at' => '2020-12-26 09:21:37',
            ),
            10 => 
            array (
                'id' => 11,
                'categoryid' => '',
                'categorycode' => 'DNS2',
                'description' => 'DYNDNS DOMAIN NAME SET 2',
                'lastrunno' => '0000000000',
                'version' => '',
                'b_rmk' => 'Y',
                'b_mobapp' => 'N',
                'b_adrmk' => 'Y',
                'stockcatgid' => 9,
                'created_at' => '2020-05-16 15:07:50',
                'updated_at' => '2020-12-26 09:23:29',
            ),
            11 => 
            array (
                'id' => 12,
                'categoryid' => '',
                'categorycode' => 'DNS3',
                'description' => 'DYNDNS DOMAIN NAME SET 3',
                'lastrunno' => '0000000000',
                'version' => '',
                'b_rmk' => 'Y',
                'b_mobapp' => 'N',
                'b_adrmk' => 'Y',
                'stockcatgid' => 10,
                'created_at' => '2020-05-16 15:14:18',
                'updated_at' => '2020-11-02 13:58:23',
            ),
            12 => 
            array (
                'id' => 13,
                'categoryid' => '',
                'categorycode' => 'SMS',
                'description' => 'SMS GATEWAY SERVICES',
                'lastrunno' => '0000000000',
                'version' => '',
                'b_rmk' => 'Y',
                'b_mobapp' => 'N',
                'b_adrmk' => 'N',
                'stockcatgid' => 8,
                'created_at' => '2020-05-23 07:54:42',
                'updated_at' => '2020-11-13 11:31:26',
            ),
            13 => 
            array (
                'id' => 15,
                'categoryid' => '',
                'categorycode' => 'GSSADAPPS',
                'description' => 'E-COMM GOLDSMITH ADMIN MOBILE APPS',
                'lastrunno' => '0000000000',
                'version' => '',
                'b_rmk' => 'Y',
                'b_mobapp' => 'Y',
                'b_adrmk' => 'N',
                'stockcatgid' => NULL,
                'created_at' => '2020-10-27 13:31:13',
                'updated_at' => '2020-10-30 07:57:16',
            ),
            14 => 
            array (
                'id' => 16,
                'categoryid' => '',
                'categorycode' => 'GSSCLIENTAPP',
                'description' => 'E-COMM GOLDSMITH CLIENT MOBILE APPS',
                'lastrunno' => '0000000000',
                'version' => '',
                'b_rmk' => 'Y',
                'b_mobapp' => 'Y',
                'b_adrmk' => 'N',
                'stockcatgid' => NULL,
                'created_at' => '2020-10-28 13:35:30',
                'updated_at' => '2020-10-29 18:04:01',
            ),
            15 => 
            array (
                'id' => 17,
                'categoryid' => '',
                'categorycode' => 'TOTALAPP',
                'description' => 'TOTALPAY PAWNSHOP CLIENT MOBILE APPS',
                'lastrunno' => '0000000000',
                'version' => '',
                'b_rmk' => 'Y',
                'b_mobapp' => 'Y',
                'b_adrmk' => 'N',
                'stockcatgid' => NULL,
                'created_at' => '2020-10-28 13:36:24',
                'updated_at' => '2020-10-30 13:04:19',
            ),
            16 => 
            array (
                'id' => 18,
                'categoryid' => '',
                'categorycode' => 'TESTING',
                'description' => 'TESTING CATEGORY',
                'lastrunno' => '00000000',
                'version' => '',
                'b_rmk' => 'N',
                'b_mobapp' => 'N',
                'b_adrmk' => 'N',
                'stockcatgid' => 1,
                'created_at' => '2020-11-02 14:08:18',
                'updated_at' => '2020-11-02 14:08:18',
            ),
            17 => 
            array (
                'id' => 19,
                'categoryid' => '',
                'categorycode' => 'TESTING2',
                'description' => 'TESTING2',
                'lastrunno' => '00000000',
                'version' => '',
                'b_rmk' => 'N',
                'b_mobapp' => 'N',
                'b_adrmk' => 'N',
                'stockcatgid' => 2,
                'created_at' => '2020-11-02 14:09:47',
                'updated_at' => '2020-11-02 14:10:01',
            ),
            18 => 
            array (
                'id' => 20,
                'categoryid' => '',
                'categorycode' => 'PAWNLIVE',
                'description' => 'PAWNSHOP OWNER MOBILE APPS',
                'lastrunno' => '0000000000',
                'version' => '',
                'b_rmk' => 'Y',
                'b_mobapp' => 'Y',
                'b_adrmk' => 'N',
                'stockcatgid' => NULL,
                'created_at' => '2020-11-13 11:32:33',
                'updated_at' => '2020-11-13 11:32:50',
            ),
            19 => 
            array (
                'id' => 21,
                'categoryid' => '',
                'categorycode' => 'ECOMM',
                'description' => 'E-COMMERCE APPLICATION HOSTING',
                'lastrunno' => '0000000000',
                'version' => '',
                'b_rmk' => 'N',
                'b_mobapp' => 'N',
                'b_adrmk' => 'N',
                'stockcatgid' => 9,
                'created_at' => '2022-04-18 10:34:32',
                'updated_at' => '2022-04-18 10:34:32',
            ),
        ));
        
        Schema::enableForeignKeyConstraints();
    }
}