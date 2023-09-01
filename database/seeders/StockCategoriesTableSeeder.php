<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class StockCategoriesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('stock_categories')->delete();
        
        \DB::table('stock_categories')->insert(array (
            0 => 
            array (
                'categorycode' => 'SYS',
                'created_at' => NULL,
                'description' => 'SYSTEM',
                'id' => 1,
                'isactive' => '1',
                'isshowdb' => '',
                'stockid' => '7FA064C3-4AEB-465F-9F73-0D247A01DDAB',
                'updated_at' => NULL,
            ),
            1 => 
            array (
                'categorycode' => 'ACC',
                'created_at' => NULL,
                'description' => 'ACCESSERIOES',
                'id' => 2,
                'isactive' => '1',
                'isshowdb' => '0',
                'stockid' => '7883E65B-3A6C-4CF8-938F-C61677E9DFB0',
                'updated_at' => '2020-06-04 19:02:08',
            ),
            2 => 
            array (
                'categorycode' => 'RIBBON',
                'created_at' => '2019-12-03 14:09:38',
                'description' => 'RIBBON',
                'id' => 3,
                'isactive' => '1',
                'isshowdb' => '1',
                'stockid' => '',
                'updated_at' => '2020-06-04 19:01:45',
            ),
            3 => 
            array (
                'categorycode' => 'PLAIN FORM',
                'created_at' => '2019-12-03 14:14:52',
                'description' => 'PLAIN FORM',
                'id' => 4,
                'isactive' => '1',
                'isshowdb' => '1',
                'stockid' => '',
                'updated_at' => '2020-06-04 19:01:53',
            ),
            4 => 
            array (
                'categorycode' => 'PREPRINTED FORM',
                'created_at' => '2020-02-22 09:43:44',
                'description' => 'COMPUTER PRE-PRINTED PLAIN FORM',
                'id' => 5,
                'isactive' => '1',
                'isshowdb' => '1',
                'stockid' => '',
                'updated_at' => '2020-06-04 19:01:59',
            ),
            5 => 
            array (
                'categorycode' => 'OTH',
                'created_at' => '2020-06-08 13:03:17',
                'description' => 'OTHERS',
                'id' => 8,
                'isactive' => '1',
                'isshowdb' => '0',
                'stockid' => '',
                'updated_at' => '2020-06-08 13:03:17',
            ),
            6 => 
            array (
                'categorycode' => 'MAINTENANCE',
                'created_at' => '2020-06-11 19:41:51',
                'description' => 'SERVICE MAINTENANCE',
                'id' => 9,
                'isactive' => '1',
                'isshowdb' => '1',
                'stockid' => '',
                'updated_at' => '2020-06-11 19:41:51',
            ),
            7 => 
            array (
                'categorycode' => 'DOMAIN',
                'created_at' => '2020-11-02 13:57:33',
                'description' => 'DOMAIN NAME',
                'id' => 10,
                'isactive' => '1',
                'isshowdb' => '0',
                'stockid' => '',
                'updated_at' => '2020-11-02 13:57:33',
            ),
            8 => 
            array (
                'categorycode' => 'HARD MAINTENANCE',
                'created_at' => '2021-03-08 14:05:13',
                'description' => 'HARDWARE  MAINTENANCE',
                'id' => 11,
                'isactive' => '1',
                'isshowdb' => '1',
                'stockid' => '',
                'updated_at' => '2021-03-08 14:05:13',
            ),
            9 => 
            array (
                'categorycode' => 'ON-LOAN',
                'created_at' => '2021-06-10 06:35:26',
                'description' => 'ON LOAN STOCK ITEM',
                'id' => 12,
                'isactive' => '1',
                'isshowdb' => '1',
                'stockid' => '',
                'updated_at' => '2021-06-10 06:35:26',
            ),
        ));
        
        
    }
}