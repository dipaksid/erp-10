<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    use HasFactory;

    public static function getModule($request)
    {
        if($request->segment(2)=="outstanding"){
            $result='OUTSTANDING REPORT';
        } elseif($request->segment(2)=="invoice"){
            $result='PRINT SALES INVOICE';
        } elseif($request->segment(2)=="sales"){
            $result='SALES REPORT';
        } elseif($request->segment(2)=="sticker"){
            $result='PRINT CUSTOMER/SUPPLIER STICKER';
        } elseif($request->segment(2)=="receipt"){
            $result='RECEIPT REPORT';
        } elseif($request->segment(2)=="salesexportlhdn"){
            $result='CUSTOMER SALES DATA EXPORT (LHDN)';
        } elseif($request->segment(2)=="servicemain"){
            $result='SERVICE MAINTENANCE REPORT';
        } elseif($request->segment(2)=="filemanage"){
            $result='FILE MANAGEMENT REPORT';
        } elseif($request->segment(2)=="staffservice"){
            $result='STAFF SERVICE REPORT';
        } elseif($request->segment(2)=="serialcategory"){
            $result='SERIALIZATION CATEGORY REPORT';
        } else {
            $result='SALES INVOICE';
        }

        return $result;
    }

}
