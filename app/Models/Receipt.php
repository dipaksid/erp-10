<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class Receipt extends Model
{
    use HasFactory;
    public function salescurrency(){

        return $this->belongsTo('App\Models\Currency', 'currencies_id', 'id');
    }

    public function receiptdetails(){

        return $this->belongsTo('App\Models\Armatch', 'id', 'artranid')->where('artype', 'OR');
    }

    public function bankdetails(){

        return $this->belongsTo('App\Models\Bank', 'banks_id', 'id');
    }

    public function receiptcustomer(){

        return $this->belongsTo('App\Models\Customer', 'customers_id', 'id');
    }

    public function generate_or_code($request, $companyid)
    {
        $lastnum = $this->where(DB::raw("(DATE_FORMAT(receiptdate,'%Y%m'))"), "=", Carbon::createFromFormat('d/m/Y', $request->session()->get('login_date'))
                        ->format('Ym'))
                        ->where("companyid",$companyid)
                        ->max("receiptcode");

        //$lastnum = $this->where('receiptdate',)->max("receiptcode");
        if(!is_null($lastnum)){
            $lastrun = substr($lastnum,-3);
            $result = sprintf("%s%03d",substr($lastnum,0,(strlen($lastnum)-3)),($lastrun+1));
        } else {
            $result="OR".substr($request->session()->get('login_date'),8,2).substr($request->session()->get('login_date'),3,2)."/001";
        }

        return $result;
    }

    public static function getcustpaylist($customerid){

        return DB::table('receipts')
            ->leftjoin('armatches',function($join) {
                $join->on('receipts.id', '=', 'armatches.artranid');
                $join->where('armatches.artype', '=', 'OR');
            })
            ->leftjoin('sales_invoices',function($join) {
                $join->on('armatches.payforid', '=', 'sales_invoices.id');
                $join->where('armatches.payfortype', '=', 'INV');
            })
            ->where("receipts.customerid",$customerid)
            ->groupBy('receipts.id');
    }

    public static function getrecppaylist($receiptid){

        return DB::table('receipts')
            ->leftjoin('armatches',function($join) {
                $join->on('receipts.id', '=', 'armatches.artranid');
                $join->where('armatches.artype', '=', 'OR');
            })
            ->leftjoin('sales_invoices',function($join) {
                $join->on('armatches.payforid', '=', 'sales_invoices.id');
                $join->where('armatches.payfortype', '=', 'INV');
            })
            ->where("receipts.id",$receiptid);
    }

    public static function getreceiptlist($request){
        $datefr = Carbon::createFromFormat('d/m/Y', $request->input("rcptdatfr"))->format('Y-m-d');
        $dateto = Carbon::createFromFormat('d/m/Y', $request->input("rcptdatto"))->format('Y-m-d');

        return DB::table('receipts')
            ->join('customers', 'receipts.customerid', '=', 'customers.id')
            ->selectRaw("receipts.id, DATE_FORMAT(receipts.receiptdate, '%d/%m/%Y') as date, receipts.receiptcode as receiptcode, customers.companyname as name, receipts.nettotalamount as paid_amt, if(receipts.companyid='2','red','blue') as 'color' ")
            ->whereDate("receipts.receiptdate",">=",$datefr)
            ->whereDate("receipts.receiptdate","<=",$dateto)
            ->where("receipts.companyid",$request->input("companyid"))
            ->orderBy('receipts.receiptdate','desc')
            ->orderBy('receipts.receiptcode','desc');
    }

    public static function getreceiptinvlist($request){
        $datefr = Carbon::createFromFormat('d/m/Y', $request->input("datfr"))->format('Y-m-d');
        $dateto = Carbon::createFromFormat('d/m/Y', $request->input("datto"))->format('Y-m-d');

        return DB::table('receipts')
            ->leftjoin('armatches',function($join) {
                $join->on('receipts.id', '=', 'armatches.artranid');
                $join->where('armatches.artype', '=', 'OR');
            })
            ->leftjoin('sales_invoices',function($join) {
                $join->on('armatches.payforid', '=', 'sales_invoices.id');
                $join->where('armatches.payfortype', '=', 'INV');
            })
            ->leftjoin('customers', 'receipts.customers_id', '=', 'customers.id')
            ->whereDate("receipts.receiptdate",">=",$datefr)
            ->whereDate("receipts.receiptdate","<=",$dateto);
    }

}
