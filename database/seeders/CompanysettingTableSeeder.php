<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;

class CompanysettingTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        Schema::disableForeignKeyConstraints();
        \DB::table('company_settings')->delete();

        \DB::table('company_settings')->insert(array (
            0 =>
            array (
                'id' => 1,
                'companycode' => 'BW',
                'companyname' => 'BRIGHT-WIN TECHNOLOGY (M) SDN. BHD.',
                'registrationno' => '199801000716',
                'registrationno2' => '456842-H',
                'gstno' => '',
                'address1' => '21-1A JALAN PERDANA 4/8,',
                'address2' => 'PANDAN PERDANA 55300',
                'address3' => 'KUALA LUMPUR.',
                'address4' => '',
                'areas_id' => 2,
                'zipcode' => '55300',
                'city' => 'PANDAN PERDANA',
                'contactperson' => 'MR TSEN',
                'contactperson2' => 'MS CHAN',
                'phoneno1' => '012.208.3761',
                'phoneno2' => '03.9282.4788',
                'email' => 'PYCHAN@BRIGHTWIN.COM',
                'email2' => '',
                'banks_id' => 1,
                'banks_id2' => 2,
                'bankacc1' => '116.000.13939',
                'bankacc2' => '317.543.6816',
                'companyltrheader' => 'bwheader.jpg',
                'companyltrfooter' => '/tmp/phpkL1wrW',
                'b_default' => 'Y',
                'created_at' => '2021-03-22 06:59:03',
                'updated_at' => '2023-04-13 11:34:42',
            ),
            1 =>
            array (
                'id' => 2,
                'companycode' => 'BWS',
                'companyname' => 'BRIGHT-WIN SOLUTION (M) SDN. BHD.',
                'registrationno' => '202101008466',
                'registrationno2' => '1408765-P',
                'gstno' => '',
                'address1' => '21-1A JALAN PERDANA 4/8,',
                'address2' => 'PANDAN PERDANA 55300',
                'address3' => 'KUALA LUMPUR, MALAYSIA',
                'address4' => '',
                'areas_id' => 2,
                'zipcode' => '55300',
                'city' => '',
                'contactperson' => 'MR TSEN',
                'contactperson2' => 'MS CHAN',
                'phoneno1' => '012.208.3761',
                'phoneno2' => '03.9282.4788',
                'email' => 'PYCHAN@BRIGHTWIN.COM',
                'email2' => '',
                'banks_id' => 2,
                'banks_id2' => 0,
                'bankacc1' => '322.170.3729',
                'bankacc2' => '',
                'companyltrheader' => 'bwheader.jpg',
                'companyltrfooter' => '',
                'b_default' => 'N',
                'created_at' => '2021-03-22 07:03:40',
                'updated_at' => '2023-03-17 11:26:00',
            ),
            2 =>
            array (
                'id' => 11,
                'companycode' => 'TA',
                'companyname' => 'TSEN AUCTIONEER SDN BHD',
                'registrationno' => '201201035839',
                'registrationno2' => '1020321-D',
                'gstno' => '',
                'address1' => '21-2B JALAN PERDANA 4/8,',
                'address2' => 'TAMAN PANDAN PERDANA,',
                'address3' => '55300 KUALA LUMPUR.',
                'address4' => '',
                'areas_id' => 2,
                'zipcode' => '55300',
                'city' => 'CHERAS',
                'contactperson' => 'MR TSEN',
                'contactperson2' => 'MS CHAN',
                'phoneno1' => '016.336.4788',
                'phoneno2' => '012.208.3761',
                'email' => 'TFS163@YAHOO.COM',
                'email2' => '',
                'banks_id' => 2,
                'banks_id2' => 0,
                'bankacc1' => '317.924.9510',
                'bankacc2' => '',
                'companyltrheader' => 'bwheader.jpg',
                'companyltrfooter' => NULL,
                'b_default' => 'N',
                'created_at' => '2021-08-25 07:14:22',
                'updated_at' => '2023-03-17 11:26:14',
            ),
        ));

        Schema::enableForeignKeyConstraints();
    }
}
