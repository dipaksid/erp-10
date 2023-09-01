<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class SystemsettingTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {


        \DB::table('system_settings')->delete();

        \DB::table('system_settings')->insert(array (
            0 =>
            array (
                'allcnlh' => 'Y',
                'allinvdvylh' => 'Y',
                'allow_gst' => 'N',
                'created_at' => NULL,
                'creditnoteprinter' => NULL,
                'emailsender' => 'SALES@BRIGHTWIN.COM',
                'gst_calculate_total' => 'Y',
                'id' => 1,
                'invoiceprinter' => NULL,
                'jobnotifyday' => 30,
                'jobrefreshtime' => 120,
                'loan_notify_day' => 0,
                'opening_year' => '2021',
                'paginate_page' => 15,
                'paymentprinter' => NULL,
                'poprinter' => NULL,
                'receiptprinter' => NULL,
                'reportprinter' => NULL,
                'sms_active' => 'Y',
                'sms_company_name' => NULL,
                'sms_content' => NULL,
                'sms_password' => 'jowuwAXd',
                'sms_username' => 'brightwin',
                'softwareservicerefreshtime' => 0,
                'srvchgsendnotify' => 'Y',
                'stickerprinter' => NULL,
                'updated_at' => '2021-08-26 13:34:48',
                'upload_photo_limit' => 3,
                'uploadfilelimit' => 10,
            ),
        ));


    }
}
