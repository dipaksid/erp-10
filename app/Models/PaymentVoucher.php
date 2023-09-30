<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class PaymentVoucher extends Model
{
    use HasFactory;

    protected $fillable = ['paymentcode', 'paymentdate', 'supplierid', 'suppliername', 'description', 'referenceno', 'referencedate','currencies_id','amount','companyid'];
    public function generate_pv_code($request){
        //$lastnum = $this->where(DB::raw("(DATE_FORMAT(paymentdate,'%Y%m'))"), "=", Carbon::createFromFormat('d/m/Y', $request->session()->get('login_date'))->format('Ym'))
        $lastnum = $this->where(DB::raw("(DATE_FORMAT(paymentdate,'%Y%m'))"), "=", Carbon::createFromFormat('d/m/Y', $request->input('paymentdate'))->format('Ym'))
            ->where("companyid",$request->input("companyid"))
            ->max("paymentcode");
        $company = CompanySetting::find($request->input("companyid"));
        //$lastnum = $this->where('receiptdate',)->max("receiptcode");
        if(!is_null($lastnum)){
            $lastrun = substr($lastnum,-3);
            $result = sprintf("%s%03d",substr($lastnum,0,(strlen($lastnum)-3)),($lastrun+1));
        } else {
            $result=$company->companycode."PV".substr($request->input('paymentdate'),8,2).substr($request->input('paymentdate'),3,2)."/001";
        }
        return $result;
    }
    public function salescurrency(){
        return $this->belongsTo('App\Models\Currency', 'currencies_id', 'id');
    }

    public function paymentsupplier(){
        return $this->belongsTo('App\Models\Supplier', 'supplierid', 'id');
    }

    public static function getpaymentlist($request){
        $datefr = Carbon::createFromFormat('d/m/Y', $request->input("pymtdatfr"))->format('Y-m-d');
        $dateto = Carbon::createFromFormat('d/m/Y', $request->input("pymtdatto"))->format('Y-m-d');
        return DB::table('payment_vouchers')
            ->selectRaw("payment_vouchers.id, DATE_FORMAT(payment_vouchers.paymentdate, '%d/%m/%Y') as date, payment_vouchers.paymentcode as paymentcode, payment_vouchers.suppliername as name, payment_vouchers.amount as pay_amt, if(payment_vouchers.cancelled_at is null,'','C') as 'status', if(payment_vouchers.companyid='2','red','blue') as 'color'")
            ->whereDate("payment_vouchers.paymentdate",">=",$datefr)
            ->whereDate("payment_vouchers.paymentdate","<=",$dateto)
            ->where("payment_vouchers.companyid",$request->input("companyid"))
            ->orderBy('payment_vouchers.paymentdate','desc')
            ->orderBy('payment_vouchers.paymentcode','desc');
    }

    public static function getpaymentreportlist(){
        return DB::table('payment_vouchers')
            ->leftjoin('suppliers',function($join) {
                $join->on('payment_vouchers.supplierid', '=', 'suppliers.id');
            });
    }

    public static function getModule($request){
        if($request->segment(2)=="edit"){
            $result='EDIT PAYMENT VOUCHER';
        } elseif($request->segment(2)=="" && $request->method()=="POST"){
            $result='ADD PAYMENT VOUCHER';
        } elseif(is_numeric($request->segment(2)) && ($request->method()=="PATCH" || $request->method()=="PUT")){
            $result='EDIT PAYMENT VOUCHER';
        } elseif($request->segment(2)=="or"){
            $result='PRINT PAYMENT VOUCHER';
        } elseif($request->segment(2)=="checksupp" || $request->segment(2)=="checkpymt"){
            $result="CHECK PAYMENT VOUCHER";
        }else {
            $result='PAYMENT VOUCHER';
        }
        return $result;
    }

}
