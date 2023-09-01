<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class UserHasRolesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {


        \DB::table('model_has_roles')->delete();

        \DB::table('model_has_roles')->insert(array (
            0 =>
            array (
                'role_id' => 1,
                'model_type' => 'App\Models\User',
                'model_id' => 1,
            ),
            1 =>
            array (
                'role_id' => 1,
                'model_type' => 'App\Models\User',
                'model_id' => 7,
            ),
            2 =>
            array (
                'role_id' => 1,
                'model_type' => 'App\Models\User',
                'model_id' => 8,
            ),
            3 =>
            array (
                'role_id' => 1,
                'model_type' => 'App\Models\User',
                'model_id' => 20,
            ),
            4 =>
            array (
                'role_id' => 2,
                'model_type' => 'App\Models\User',
                'model_id' => 2,
            ),
            5 =>
            array (
                'role_id' => 2,
                'model_type' => 'App\Models\User',
                'model_id' => 3,
            ),
            6 =>
            array (
                'role_id' => 2,
                'model_type' => 'App\Models\User',
                'model_id' => 4,
            ),
            7 =>
            array (
                'role_id' => 2,
                'model_type' => 'App\Models\User',
                'model_id' => 5,
            ),
            8 =>
            array (
                'role_id' => 2,
                'model_type' => 'App\Models\User',
                'model_id' => 6,
            ),
            9 =>
            array (
                'role_id' => 2,
                'model_type' => 'App\Models\User',
                'model_id' => 9,
            ),
            10 =>
            array (
                'role_id' => 2,
                'model_type' => 'App\Models\User',
                'model_id' => 13,
            ),
            11 =>
            array (
                'role_id' => 2,
                'model_type' => 'App\Models\User',
                'model_id' => 18,
            ),
            12 =>
            array (
                'role_id' => 2,
                'model_type' => 'App\Models\User',
                'model_id' => 21,
            ),
            13 =>
            array (
                'role_id' => 3,
                'model_type' => 'App\Models\User',
                'model_id' => 10,
            ),
            14 =>
            array (
                'role_id' => 3,
                'model_type' => 'App\Models\User',
                'model_id' => 11,
            ),
            15 =>
            array (
                'role_id' => 3,
                'model_type' => 'App\Models\User',
                'model_id' => 12,
            ),
            16 =>
            array (
                'role_id' => 3,
                'model_type' => 'App\Models\User',
                'model_id' => 14,
            ),
            17 =>
            array (
                'role_id' => 3,
                'model_type' => 'App\Models\User',
                'model_id' => 15,
            ),
            18 =>
            array (
                'role_id' => 3,
                'model_type' => 'App\Models\User',
                'model_id' => 16,
            ),
            19 =>
            array (
                'role_id' => 3,
                'model_type' => 'App\Models\User',
                'model_id' => 17,
            ),
            20 =>
            array (
                'role_id' => 3,
                'model_type' => 'App\Models\User',
                'model_id' => 19,
            ),
            21 =>
            array (
                'role_id' => 3,
                'model_type' => 'App\Models\User',
                'model_id' => 22,
            ),
            22 =>
            array (
                'role_id' => 3,
                'model_type' => 'App\Models\User',
                'model_id' => 23,
            ),
            23 =>
            array (
                'role_id' => 3,
                'model_type' => 'App\Models\User',
                'model_id' => 24,
            ),
        ));


    }
}
