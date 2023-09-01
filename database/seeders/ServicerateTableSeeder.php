<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class ServicerateTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('service_rates')->delete();
        
        \DB::table('service_rates')->insert(array (
            0 => 
            array (
                'id' => 6,
				'description' => '[{"rate": "150.00", "description": "SERVICE CHARGE FOR LOCAL (KL) OTHER THAN SOFTWARE MAINTENANCE"}, {"rate": "200.00", "description": "SERVICE CHARGE FOR LOCAL (SEL) OTHER THAN SOFTWARE MAINTENANCE"}, {"rate": "300.00", "description": "SERVICE CHARGE FOR OUTSTATION OTHER THAN SOFTWARE MAINTENANCE"}, {"rate": "200.00", "description": "SERVICE CHARGE FOR LOCAL (KL) - WITHOUT ANY MAINTENANCE"}, {"rate": "250.00", "description": "SERVICE CHARGE FOR LOCAL (SEL) - WITHOUT ANY MAINTENANCE"}, {"rate": "350.00", "description": "SERVICE CHARGE FOR OUTSTATION - WITHOUT ANY MAINTENANCE"}]',
                'rate' => 0,
                'status' => NULL,
                'effectivedate' => '2019-01-01',
                'created_at' => '2021-01-13 07:48:00',
                'updated_at' => '2021-01-14 11:50:09',
            ),
        ));
        
        
    }
}