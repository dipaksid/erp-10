<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SalesInvoice extends Model
{
    use HasFactory;

    protected $fillable = ['salesinvoicecode', 'salesinvoicedate', 'customerid', 'customername', 'attention', 'fax', 'address1',
        'address2', 'address3', 'address4', 'referenceno', 'docontact', 'dophone', 'dofax', 'doaddress1',
        'doaddress2', 'doaddress3', 'doaddress4', 'doregistationno', 'dogstregno', 'dophone2', 'doemail', 'doremark',
        'doareaid', 'termid', 'currencyid', 'totalamount', 'discountamount', 'subtotalamount', 'taxtotalamount', 'nettotalamount', 'roundingadjustment'];


    public function salesinvoicedetails(){
        return $this->belongsTo('App\Models\SalesInvoiceDetail', 'id', 'invoiceid');
    }
    public function salescustomer(){
        return $this->belongsTo('App\Models\Customer', 'customers_id', 'id');
    }
    public function salesagent(){
        return $this->belongsTo('App\Models\Agent', 'agents_id', 'id');
    }
    public function salesterm(){
        return $this->belongsTo('App\Models\Term', 'terms_id', 'id');
    }
    public function salescurrency(){
        return $this->belongsTo('App\Models\
        ', 'currencies_id', 'id');
    }
    public function generate_inv_code2($companyid){
        $lastnum = $this->where("companyid",$companyid)->max("salesinvoicecode");
        if(!is_null($lastnum)){
            $lastrun = substr($lastnum,-5);
            if($lastrun<99999){
                $result = sprintf("%s%05d",substr($lastnum,0,(strlen($lastnum)-5)),($lastrun+1));
            } else {
                $arr_gh = ["A","B","C","D","E","F","G","H","J","K","L","M","N","P","Q","R","S","T","U","V","W","X","Y","Z"];
                $key = array_search(substr($lastnum,-6,1), $arr_gh);
                $key = ($key<(count($arr_gh)-1))?($key+1):0;
                $result = sprintf("%s%05d",substr($lastnum,0,(strlen($lastnum)-6)).$arr_gh[$key],1);
            }
        } else {
            $companysetting = CompanySetting::find($companyid);
            $result=$companysetting->companycode."-A00001";
        }
        return $result;
    }
    public function generate_inv_code($companyid){
        $lastnum = $this->where("companyid",$companyid)->max("salesinvoicecode");
        if(!is_null($lastnum)){
            $lastrun = substr($lastnum,-5);
            if($lastrun<99999){
                $result = sprintf("%s%05d",substr($lastnum,0,(strlen($lastnum)-5)),($lastrun+1));
            } else {
                $arr_gh = ["A","B","C","D","E","F","G","H","J","K","L","M","N","P","Q","R","S","T","U","V","W","X","Y","Z"];
                $key = array_search(substr($lastnum,-6,1), $arr_gh);
                $key = ($key<(count($arr_gh)-1))?($key+1):0;
                $result = sprintf("%s%05d",substr($lastnum,0,(strlen($lastnum)-6)).$arr_gh[$key],1);
            }
        } else {
            $companysetting = CompanySetting::find($companyid);
            $result=$companysetting->companycode."-A00001";
        }
        return $result;
    }
    public static function getModule($request){
        if($request->segment(2)=="edit"){
            $result='EDIT SALES INVOICE';
        } elseif($request->segment(2)=="" && $request->method()=="POST"){
            $result='ADD SALES INVOICE';
        } elseif(is_numeric($request->segment(2)) && ($request->method()=="PATCH" || $request->method()=="PUT")){
            $result='EDIT SALES INVOICE';
        } elseif($request->segment(2)=="invoice"){
            $result='PRINT SALES INVOICE';
        } elseif($request->segment(2)=="do"){
            $result='PRINT SALES DELIVERY ORDER';
        } elseif($request->segment(2)=="checkcust" || $request->segment(2)=="checkinv"){
            $result="CHECK SALES INVOICE";
        }else {
            $result='SALES INVOICE';
        }
        return $result;
    }
    public static function getcustsaleslist($customerid){
        return DB::table('salesinvoices')
            ->leftjoin('armatched',function($join) {
                $join->on('salesinvoices.id', '=', 'armatched.payforid');
                $join->where('armatched.payfortype', '=', 'INV');
                //$join->where('armatched.artype', '=', 'OR');
            })
            ->leftjoin('receipts',function($join) {
                $join->on('armatched.artranid', '=', 'receipts.id');
                $join->where('armatched.artype', '=', 'OR');
            })
            ->where("salesinvoices.customerid",$customerid)
            ->groupBy('salesinvoices.id');
    }
    public static function getoutstandingsaleslist(){
        return DB::table('salesinvoices')
            ->leftjoin('armatched',function($join) {
                $join->on('salesinvoices.id', '=', 'armatched.payforid');
                $join->where('armatched.payfortype', '=', 'INV');
                //$join->where('armatched.artype', '=', 'OR');
            })
            ->leftjoin('receipts',function($join) {
                $join->on('armatched.artranid', '=', 'receipts.id');
                $join->where('armatched.artype', '=', 'OR');
            })
            ->leftjoin('arcn',function($join) {
                $join->on('armatched.artranid', '=', 'arcn.id');
                $join->where('armatched.artype', '=', 'CN');
            })
            ->leftjoin('customers',function($join) {
                $join->on('salesinvoices.customerid', '=', 'customers.id');
            })
            ->leftjoin('areas',function($join) {
                $join->on('customers.areaid', '=', 'areas.id');
            })
            ->leftjoin('terms',function($join) {
                $join->on('salesinvoices.termid', '=', 'terms.id');
            })
            ->leftjoin('customer_group_details',function($join) {
                $join->on('salesinvoices.customerid', '=', 'customer_group_details.customerid');
            })
            ->leftjoin('customer_groups',function($join) {
                $join->on('customer_group_details.customergroupid', '=', 'customer_groups.id');
            })
            ->whereNull("salesinvoices.cancelled_at");
    }
    public static function getstocksaleslist($request){
        $stockcode = $request->input("stockcode");
        return DB::table('salesinvoices')
            ->join('customers', 'salesinvoices.customerid', '=', 'customers.id')
            ->join('salesinvoicedetails', 'salesinvoices.id', '=', 'salesinvoicedetails.invoiceid')
            ->join('stocks', 'salesinvoicedetails.stockid', '=', 'stocks.id')
            ->selectRaw("salesinvoices.id, DATE_FORMAT(salesinvoices.salesinvoicedate, '%d/%m/%Y') as date, salesinvoices.salesinvoicecode as invoiceno, customers.companyname as name, salesinvoices.nettotalamount as sal_amt, if(salesinvoices.cancelled_at is null,'','C') as 'status', if(salesinvoices.companyid='2','red','blue') as 'color'")
            ->whereRaw("stocks.stockcode like '%".$stockcode."%'")
            ->groupBy('salesinvoices.id')
            ->orderBy('salesinvoices.salesinvoicedate','desc')
            ->orderBy('salesinvoices.salesinvoicecode','desc');
    }
    public static function getserialsaleslist($request){
        $serialno = $request->input("serialno");
        return DB::table('salesinvoices')
            ->join('customers', 'salesinvoices.customerid', '=', 'customers.id')
            ->join('salesinvoicedetails', 'salesinvoices.id', '=', 'salesinvoicedetails.invoiceid')
            ->selectRaw("salesinvoices.id, DATE_FORMAT(salesinvoices.salesinvoicedate, '%d/%m/%Y') as date, salesinvoices.salesinvoicecode as invoiceno, customers.companyname as name, salesinvoices.nettotalamount as sal_amt, if(salesinvoices.cancelled_at is null,'','C') as 'status', if(salesinvoices.companyid='2','red','blue') as 'color'")
            ->whereRaw("salesinvoicedetails.note like '%".$serialno."%'")
            ->groupBy('salesinvoices.id')
            ->orderBy('salesinvoices.salesinvoicedate','desc')
            ->orderBy('salesinvoices.salesinvoicecode','desc');
    }
    public static function getinvsaleslist($request){
        $datefr = Carbon::createFromFormat('d/m/Y', $request->input("invdatfr"))->format('Y-m-d');
        $dateto = Carbon::createFromFormat('d/m/Y', $request->input("invdatto"))->format('Y-m-d');
        return DB::table('salesinvoices')
            ->join('customers', 'salesinvoices.customerid', '=', 'customers.id')
            ->selectRaw("salesinvoices.id, DATE_FORMAT(salesinvoices.salesinvoicedate, '%d/%m/%Y') as date, salesinvoices.salesinvoicecode as invoiceno, customers.companyname as name, salesinvoices.nettotalamount as sal_amt, if(salesinvoices.cancelled_at is null,'','C') as 'status', if(salesinvoices.companyid='2','red','blue') as 'color'")
            ->whereDate("salesinvoicedate",">=",$datefr)
            ->whereDate("salesinvoicedate","<=",$dateto)
            ->orderBy('salesinvoices.salesinvoicedate','desc')
            ->orderBy('salesinvoices.salesinvoicecode','desc');
    }
    public static function getsalesreportlist($request){
        return DB::table('salesinvoices')
            ->leftjoin('salesinvoicedetails',function($join) {
                $join->on('salesinvoices.id', '=', 'salesinvoicedetails.invoiceid');
            })
            ->leftjoin('customers',function($join) {
                $join->on('salesinvoices.customerid', '=', 'customers.id');
            });
    }
    public static function getsalescreditnotelist($request){
        return DB::table('salesinvoices')
            ->leftjoin('salesinvoicedetails',function($join) {
                $join->on('salesinvoices.id', '=', 'salesinvoicedetails.invoiceid');
            })
            ->leftjoin('customers',function($join) {
                $join->on('salesinvoices.customerid', '=', 'customers.id');
            })
            ->join('armatched',function($join) {
                $join->on('salesinvoices.id', '=', 'armatched.payforid');
                $join->where('armatched.payfortype', '=', 'INV');
            })
            ->join('arcn',function($join) {
                $join->on('armatched.artranid', '=', 'arcn.id');
                $join->where('armatched.artype', '=', 'CN');
            });
    }
}
