<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class StaffTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('staffs')->delete();
        
        \DB::table('staffs')->insert(array (
            0 => 
            array (
                'commrate' => '1.00',
                'comp_id' => 1,
                'created_at' => '2019-12-03 13:37:21',
                'date_join' => '01/01/1998',
                'department' => 'ADMIN',
                'designation' => 'DIRECTOR',
                'id' => 1,
                'last_review' => '',
                'name' => 'CHAN POH YOKE',
                'staffcode' => 'B0001',
                'updated_at' => '2023-02-08 10:49:01',
            ),
            1 => 
            array (
                'commrate' => '1.00',
                'comp_id' => 1,
                'created_at' => '2019-12-03 13:55:23',
                'date_join' => '01/01/1998',
                'department' => 'MANAGEMENT',
                'designation' => 'CEO',
                'id' => 2,
                'last_review' => '',
                'name' => 'TSEN FUN SENG',
                'staffcode' => 'B0002',
                'updated_at' => '2023-02-08 10:49:24',
            ),
            2 => 
            array (
                'commrate' => '1.00',
                'comp_id' => 1,
                'created_at' => '2020-06-11 19:37:36',
                'date_join' => '01/01/2002',
                'department' => 'SOFTWARE AND SUPPORT',
                'designation' => 'SUPPORT ENGINEER',
                'id' => 3,
                'last_review' => '',
                'name' => 'TSEN FUN KIEW',
                'staffcode' => 'B0005',
                'updated_at' => '2023-02-08 10:46:04',
            ),
            3 => 
            array (
                'commrate' => '1.00',
                'comp_id' => 2,
                'created_at' => '2020-06-11 19:38:02',
                'date_join' => '28/01/2013',
                'department' => 'SOFTWARE AND SUPPORT',
                'designation' => 'SOFTWARE MANAGER',
                'id' => 4,
                'last_review' => '',
                'name' => 'STANLEY LOH CHEE KUAN',
                'staffcode' => 'B0018',
                'updated_at' => '2023-02-10 13:30:14',
            ),
            4 => 
            array (
                'commrate' => '1.00',
                'comp_id' => 2,
                'created_at' => '2023-02-08 10:44:52',
                'date_join' => '20/12/2019',
                'department' => 'SOFTWARE AND SUPPORT',
                'designation' => 'SOFTWARE PROGRAMMER',
                'id' => 6,
                'last_review' => '',
                'name' => 'LIM QING WEI',
                'staffcode' => 'B0023',
                'updated_at' => '2023-02-10 13:53:22',
            ),
            5 => 
            array (
                'commrate' => '1.00',
                'comp_id' => 1,
                'created_at' => '2023-02-08 10:47:00',
                'date_join' => '10/01/2020',
                'department' => 'SOFTWARE AND SUPPORT',
                'designation' => 'SOFTWARE PROGRAMMER',
                'id' => 7,
                'last_review' => '',
                'name' => 'LAU ZHEN FEI',
                'staffcode' => 'B0024',
                'updated_at' => '2023-02-08 10:47:00',
            ),
            6 => 
            array (
                'commrate' => '1.00',
                'comp_id' => 1,
                'created_at' => '2023-02-08 10:48:28',
                'date_join' => '15/06/2022',
                'department' => 'SOFTWARE AND SUPPORT',
                'designation' => 'SOFTWARE SUPPORT/PRO',
                'id' => 8,
                'last_review' => '',
                'name' => 'CALDREN CHEW KAI XIN',
                'staffcode' => 'B0029',
                'updated_at' => '2023-02-08 10:48:28',
            ),
            7 => 
            array (
                'commrate' => '1.00',
                'comp_id' => 1,
                'created_at' => '2023-05-02 08:36:27',
                'date_join' => '02/05/2023',
                'department' => 'SOFTWARE AND SUPPORT',
                'designation' => 'SOFTWARE SUPPORT/PRO',
                'id' => 9,
                'last_review' => '',
                'name' => 'JASON CHAI JA SON',
                'staffcode' => 'B0030',
                'updated_at' => '2023-05-31 06:23:59',
            ),
        ));
        
        
    }
}