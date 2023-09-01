<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SystemSetting extends Model
{
    use HasFactory;

    protected $fillable = ['jobrefreshtime', 'jobnotifyday', 'srvchgsendnotify', 'emailsender', 'invoiceprinter', 'poprinter', 'receiptprinter', 'paymentprinter', 'creditnoteprinter', 'stickerprinter', 'reportprinter', 'allcnlh','softwareservicerefreshtime','uploadfilelimit','sms_username','sms_password','sms_company_name','sms_active','sms_content','opening_year','upload_photo_limit','allow_gst','gst_calculate_total','paginate_page'];
    public static function getModule($request){
        $result='SYSTEM SETTING';

        return $result;
    }
}
