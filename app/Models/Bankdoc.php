<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bankdoc extends Model
{
    use HasFactory;

    protected $fillable = ['bankdoc', 'banks_id', 'receiptdetails', 'remark'];

    public static function getModule($request){

        if($request->segment(2)=="edit"){
            $result='EDIT BANK DOC';
        } elseif($request->segment(2)=="" && $request->method()=="POST"){
            $result='ADD BANK DOC';
        } elseif(is_numeric($request->segment(2)) && ($request->method()=="PATCH" || $request->method()=="PUT")){
            $result='EDIT BANK DOC';
        } else {
            $result='BANK DOC';
        }
        return $result;
    }
    public function generate_bdoc_code($request){
        $lastnum = $this->where(DB::raw("(DATE_FORMAT(bankdoc_dat,'%Y%m'))"), "=", Carbon::createFromFormat('d/m/Y', $request->input('bankdoc_dat'))->format('Ym'))
            ->where("companyid",$request->input('companyid'))
            ->max("bankdoc");
        //$lastnum = $this->where('receiptdate',)->max("receiptcode");
        if(!is_null($lastnum)){
            $lastrun = substr($lastnum,-3);
            $result = sprintf("%s%03d",substr($lastnum,0,(strlen($lastnum)-3)),($lastrun+1));
        } else {
            $result="BD".substr($request->input('bankdoc_dat'),8,2).substr($request->input('bankdoc_dat'),3,2)."/001";
        }

        return $result;
    }
    public static function getinvreceipt(){

        return DB::table('receipts')
            ->leftjoin('armatched',function($join) {
                $join->on('receipts.id', '=', 'armatched.artranid');
                $join->where('armatched.artype', '=', 'OR');
            })
            ->leftjoin('salesinvoices',function($join) {
                $join->on('armatched.payforid', '=', 'salesinvoices.id');
                $join->where('armatched.payfortype', '=', 'INV');
            })
            ->leftjoin('customers', 'receipts.customerid', '=', 'customers.id');
    }
}
