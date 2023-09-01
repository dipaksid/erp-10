<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class RolesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('roles')->delete();
        
        \DB::table('roles')->insert(array (
            0 => 
            array (
                'created_at' => '2019-11-28 14:21:50',
                'id' => 1,
                'name' => 'ADMINISTRATOR',
				'guard_name' => 'web',
                'updated_at' => '2019-11-28 14:21:50',
            ),
            1 => 
            array (
                'created_at' => '2019-11-28 14:21:50',
                'id' => 2,
                'name' => 'ACCOUNT',
				'guard_name' => 'web',
                'updated_at' => '2019-11-28 14:21:50',
            ),
            2 => 
            array (
                'created_at' => '2020-04-22 06:42:55',
                'id' => 3,
                'name' => 'TESTER',
				'guard_name' => 'web',
                'updated_at' => '2020-04-22 06:42:55',
            ),
            3 => 
            array (
                'created_at' => '2021-01-22 14:30:55',
                'id' => 4,
                'name' => 'ADMIN STAFF',
				'guard_name' => 'web',
                'updated_at' => '2021-01-22 14:30:55',
            ),
            4 => 
            array (
                'created_at' => '2022-06-20 10:04:39',
                'id' => 5,
                'name' => 'SUPPORT',
				'guard_name' => 'web',
                'updated_at' => '2022-06-20 10:04:39',
            ),
        ));
        
        
    }
}