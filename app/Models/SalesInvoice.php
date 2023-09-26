<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
class SalesInvoice extends Model
{
    use HasFactory;

    protected $table = ['sales_invoices'];

    protected $fillable = ['salesinvoicecode', 'salesinvoicedate', '  customers_id', 'customername', 'attention', 'fax', 'address1',
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
        return $this->belongsTo('App\Models\Currency', 'currencies_id', 'id');
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
        return DB::table('sales_invoices')
            ->leftjoin('armatches',function($join) {
                $join->on('sales_invoices.id', '=', 'armatches.payforid');
                $join->where('armatches.payfortype', '=', 'INV');
                //$join->where('armatches.artype', '=', 'OR');
            })
            ->leftjoin('receipts',function($join) {
                $join->on('armatches.artranid', '=', 'receipts.id');
                $join->where('armatches.artype', '=', 'OR');
            })
            ->where("sales_invoices.customers_id",$customerid)
            ->groupBy('sales_invoices.id');
    }
    public static function getoutstandingsaleslist(){
        return DB::table('sales_invoices')
            ->leftjoin(' armatches',function($join) {
                $join->on('sales_invoices.id', '=', ' armatches.payforid');
                $join->where(' armatches.payfortype', '=', 'INV');
                //$join->where(' armatches.artype', '=', 'OR');
            })
            ->leftjoin('receipts',function($join) {
                $join->on(' armatches.artranid', '=', 'receipts.id');
                $join->where(' armatches.artype', '=', 'OR');
            })
            ->leftjoin('arcn',function($join) {
                $join->on(' armatches.artranid', '=', 'arcn.id');
                $join->where(' armatches.artype', '=', 'CN');
            })
            ->leftjoin('customers',function($join) {
                $join->on('sales_invoices.customers_id', '=', 'customers.id');
            })
            ->leftjoin('areas',function($join) {
                $join->on('customers.areaid', '=', 'areas.id');
            })
            ->leftjoin('terms',function($join) {
                $join->on('sales_invoices.termid', '=', 'terms.id');
            })
            ->leftjoin('customer_group_details',function($join) {
                $join->on('sales_invoices.customers_id', '=', 'customer_group_details.customers_id');
            })
            ->leftjoin('customer_groups',function($join) {
                $join->on('customer_group_details.customergroupid', '=', 'customer_groups.id');
            })
            ->whereNull("sales_invoices.cancelled_at");
    }
    public static function getstocksaleslist($request){
        $stockcode = $request->input("stockcode");
        return DB::table('sales_invoices')
            ->join('customers', 'sales_invoices.customers_id', '=', 'customers.id')
            ->join('sales_invoices_details', 'sales_invoices.id', '=', 'sales_invoices_details.invoiceid')
            ->join('stocks', 'sales_invoices_details.stockid', '=', 'stocks.id')
            ->selectRaw("sales_invoices.id, DATE_FORMAT(sales_invoices.salesinvoicedate, '%d/%m/%Y') as date,sales_invoices.salesinvoicecode as invoiceno, customers.companyname as name,sales_invoices.nettotalamount as sal_amt, if(sales_invoices.cancelled_at is null,'','C') as 'status', if(sales_invoices.companyid='2','red','blue') as 'color'")
            ->whereRaw("stocks.stockcode like '%".$stockcode."%'")
            ->groupBy('sales_invoices.id')
            ->orderBy('sales_invoices.salesinvoicedate','desc')
            ->orderBy('sales_invoices.salesinvoicecode','desc');
    }
    public static function getserialsaleslist($request){
        $serialno = $request->input("serialno");
        return DB::table('sales_invoices')
            ->join('customers', 'sales_invoices.customers_id', '=', 'customers.id')
            ->join('sales_invoices_details', 'sales_invoices.id', '=', 'sales_invoices_details.invoiceid')
            ->selectRaw("sales_invoices.id, DATE_FORMAT(sales_invoices.salesinvoicedate, '%d/%m/%Y') as date,sales_invoices.salesinvoicecode as invoiceno, customers.companyname as name,sales_invoices.nettotalamount as sal_amt, if(sales_invoices.cancelled_at is null,'','C') as 'status', if(sales_invoices.companyid='2','red','blue') as 'color'")
            ->whereRaw("sales_invoices_details.note like '%".$serialno."%'")
            ->groupBy('sales_invoices.id')
            ->orderBy('sales_invoices.salesinvoicedate','desc')
            ->orderBy('sales_invoices.salesinvoicecode','desc');
    }
    public static function getinvsaleslist($request){
        $datefr = Carbon::createFromFormat('d/m/Y', $request->input("invdatfr"))->format('Y-m-d');
        $dateto = Carbon::createFromFormat('d/m/Y', $request->input("invdatto"))->format('Y-m-d');
        return DB::table('sales_invoices')
            ->join('customers', 'sales_invoices.customers_id', '=', 'customers.id')
            ->selectRaw("sales_invoices.id, DATE_FORMAT(sales_invoices.salesinvoicedate, '%d/%m/%Y') as date,sales_invoices.salesinvoicecode as invoiceno, customers.companyname as name,sales_invoices.nettotalamount as sal_amt, if(sales_invoices.cancelled_at is null,'','C') as 'status', if(sales_invoices.companyid='2','red','blue') as 'color'")
            ->whereDate("salesinvoicedate",">=",$datefr)
            ->whereDate("salesinvoicedate","<=",$dateto)
            ->orderBy('sales_invoices.salesinvoicedate','desc')
            ->orderBy('sales_invoices.salesinvoicecode','desc');
    }
    public static function getsalesreportlist($request){
        return DB::table('sales_invoices')
                    ->leftjoin('sales_invoices_details',function($join) {
                        $join->on('sales_invoices.id', '=', 'sales_invoices_details.invoiceid');
                    })
                    ->leftjoin('customers',function($join) {
                        $join->on('sales_invoices.customers_id', '=', 'customers.id');
                    });
    }
    public static function getsalescreditnotelist($request){
        return DB::table('sales_invoices')
            ->leftjoin('sales_invoices_details',function($join) {
                $join->on('sales_invoices.id', '=', 'sales_invoices_details.invoiceid');
            })
            ->leftjoin('customers',function($join) {
                $join->on('sales_invoices.customers_id', '=', 'customers.id');
            })
            ->join(' armatches',function($join) {
                $join->on('sales_invoices.id', '=', ' armatches.payforid');
                $join->where(' armatches.payfortype', '=', 'INV');
            })
            ->join('arcns',function($join) {
                $join->on(' armatches.artranid', '=', 'arcns.id');
                $join->where(' armatches.artype', '=', 'CN');
            });
    }
}
