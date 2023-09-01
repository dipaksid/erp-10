<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {

        \DB::table('users')->insert(array (
            1 =>
            array (
                'api_token' => NULL,
                'created_at' => '2019-12-03 09:35:57',
                'email' => 'TFS163@YAHOO.COM',
                'id' => 7,
                'name' => 'TSEN',
                'password' => '$2y$10$8UJjHSrWgAGSj9lcmIwiUO4UkXZMlLRzJIWtRJTbiJ4WdBQmoJPU2',
                'remember_token' => 'HO5mTZYb74osbg6Bv0TnCPsyDbaDWcHzMGxvhteCEKIGYc1rjPZNroJ3bIJP',
                'staff_id' => 2,
                'updated_at' => '2023-02-08 10:49:52',
            ),
            2 =>
            array (
                'api_token' => NULL,
                'created_at' => '2019-12-03 12:04:57',
                'email' => 'PYCHAN@BRIGHTWIN.COM',
                'id' => 8,
                'name' => 'PYCHAN',
                'password' => '$2y$10$E6gjZ.N4AiKf/D42aEOOY.9Lwi3x1NSp5qyfbCAFsY./wAlHJA6pi',
                'remember_token' => '6AOHl0mpOEV93XeoV5YtZZwpwVqLcyWA1CnNj4uS1GJ0EbY5k2geFlYSQmE3',
                'staff_id' => 1,
                'updated_at' => '2023-02-08 10:50:06',
            ),
            3 =>
            array (
                'api_token' => NULL,
                'created_at' => '2021-04-19 08:53:35',
                'email' => 'SUPPORT@BRIGHTWIN.COM',
                'id' => 20,
                'name' => 'TEST',
                'password' => '$2y$10$Cok8HMADGEciethkK.M97.SbCa7nRRTJCwZ7CsEwI62xDokHW864u',
                'remember_token' => 'jvP5NZ0zzzAvmf5F6O9gLBp7UP1C4hIq3SzvkdXxMnWHd9uqjk3y57PNygxv',
                'staff_id' => 9,
                'updated_at' => '2023-06-23 10:24:47',
            ),
            4 =>
            array (
                'api_token' => NULL,
                'created_at' => '2023-02-08 10:57:41',
                'email' => 'SUPPORT1@BRIGHTWIN.COM',
                'id' => 23,
                'name' => 'TEST1',
                'password' => '$2y$10$1HrTleCDw5CqoXYT8dcsC.ZT9CTjl65X1c2P1elMps44grmF9Zql.',
                'remember_token' => 'AW5GF6NrfJdV4addLpFOpfjqBmQBamCGILqzNC1aCFrP6Glsx4P0S13zYhZS',
                'staff_id' => 7,
                'updated_at' => '2023-02-08 10:57:41',
            ),
        ));


    }
}
