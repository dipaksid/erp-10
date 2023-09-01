<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;
class CurrenciesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {

        Schema::disableForeignKeyConstraints();
        \DB::table('currencies')->delete();

        \DB::table('currencies')->insert(array (
            0 =>
            array (
                'id' => 1,
                'currencies_id' => '1',
                'currencycode' => 'MYR',
                'description' => 'MALAYSIAN RINGGIT',
                'sign' => 'MYR',
                'created_at' => now(),
                'updated_at' => NULL,
            ),
        ));

        Schema::enableForeignKeyConstraints();
    }
}
