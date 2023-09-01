<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CreditNote extends Model
{
    use HasFactory;

    protected $table = 'arcn';

    protected $fillable = ['cncode', 'cndate', 'customers_id', 'customername', 'description', 'reason', 'referenceno', 'agents_id', 'currencies_id', 'totalamount', 'nettotalamount'];
    public function generate_cn_code($request){
        $lastnum = $this->where(DB::raw("(DATE_FORMAT(cndate,'%Y%m'))"), "=", Carbon::createFromFormat('d/m/Y', $request->session()->get('login_date'))->format('Ym'))->max("cncode");
        if(!is_null($lastnum)){
            $lastrun = substr($lastnum,-3);
            $result = sprintf("%s%03d",substr($lastnum,0,(strlen($lastnum)-3)),($lastrun+1));
        } else {
            $result="CN".substr($request->session()->get('login_date'),8,2).substr($request->session()->get('login_date'),3,2)."/001";
        }
        return $result;
    }

    public function cndetails(){
        return $this->belongsTo('App\Models\Armatch', 'id', 'artranid')->where('artype', 'CN');
    }

    public function salescurrency(){
        return $this->belongsTo('App\Models\Currency', 'currencies_id', 'id');
    }

    public function cncustomer(){
        return $this->belongsTo('App\Models\Customer', 'customers_id', 'id');
    }

    public static function getcompcnlist($companyid){
        return DB::table('arcn')
            ->leftjoin('armatched',function($join) {
                $join->on('arcn.id', '=', 'armatched.artranid');
                $join->where('armatched.artype', '=', 'CN');
            })
            ->leftjoin('salesinvoices',function($join) {
                $join->on('armatched.payforid', '=', 'salesinvoices.id');
                $join->where('armatched.payfortype', '=', 'INV');
            })
            ->where("arcn.companyid",$companyid)
            ->groupBy('arcn.id');
    }

    public static function getcustcnlist($customerid){
        return DB::table('arcn')
            ->leftjoin('armatched',function($join) {
                $join->on('arcn.id', '=', 'armatched.artranid');
                $join->where('armatched.artype', '=', 'CN');
            })
            ->leftjoin('salesinvoices',function($join) {
                $join->on('armatched.payforid', '=', 'salesinvoices.id');
                $join->where('armatched.payfortype', '=', 'INV');
            })
            ->where("arcn.customerid",$customerid)
            ->groupBy('arcn.id');
    }

    public static function getcnlist($request){
        $datefr = Carbon::createFromFormat('d/m/Y', $request->input("cndatfr"))->format('Y-m-d');
        $dateto = Carbon::createFromFormat('d/m/Y', $request->input("cndatto"))->format('Y-m-d');
        return DB::table('arcn')
            ->join('customers', 'arcn.customerid', '=', 'customers.id')
            ->selectRaw("arcn.id, DATE_FORMAT(arcn.cndate, '%d/%m/%Y') as date, arcn.cncode as cncode, customers.companyname as name, arcn.nettotalamount as cn_amt")
            ->whereDate("arcn.cndate",">=",$datefr)
            ->whereDate("arcn.cndate","<=",$dateto)
            ->orderBy('arcn.cndate','desc')
            ->orderBy('arcn.cncode','desc');
    }

    public static function getModule($request){
        if($request->segment(2)=="edit"){
            $result='EDIT CREDIT NOTE';
        } elseif($request->segment(2)=="" && $request->method()=="POST"){
            $result='ADD CREDIT NOTE';
        } elseif(is_numeric($request->segment(2)) && ($request->method()=="PATCH" || $request->method()=="PUT")){
            $result='EDIT CREDIT NOTE';
        } elseif($request->segment(2)=="cn"){
            $result='PRINT CREDIT NOTE';
        } elseif($request->segment(2)=="checkcust" || $request->segment(2)=="checkcn"){
            $result="CHECK CREDIT NOTE";
        }else {
            $result='CREDIT NOTE';
        }
        return $result;
    }

}
