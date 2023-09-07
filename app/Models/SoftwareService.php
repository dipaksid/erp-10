<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SoftwareService extends Model
{
    use HasFactory;

    protected $fillable = ['id','job_no', 'companycode','customertype', 'phoneno1','contactperson','categorycode','servicedate','complain_problem','status','close_date','signature','sign_date','sign_by','closed_by','solution_save','form_type','servicetype','servicetype_rmk'];

    public function customer()
    {
        return $this->belongsTo('App\Models\Customer', 'companycode', 'companycode');
    }

    public function customergroup()
    {
        return $this->belongsTo('App\Models\CustomerGroup', 'companycode', 'groupcode');
    }

    public function customerservicerelated()
    {
        return $this->belongsTo('App\Models\SoftwareService', 'companycode', 'companycode');
    }

    public static function getModule($request){
        if($request->segment(2)=="create"){
            $result='ADD SOFTWARE SERVICE';
        } elseif($request->segment(3)=="edit"){
            $result='EDIT SOFTWARE SERVICE';
        } elseif(is_numeric($request->segment(2)) && $request->input('_method')!="DELETE" ){
            $result='VIEW SOFTWARE SERVICE';
        } elseif(is_numeric($request->segment(2)) && $request->input('_method')=="DELETE" ){
            $result='DELETE SOFTWARE SERVICE';
        } else {
            $result='SOFTWARE SERVICE LIST';
        }
        return $result;
    }

    public static function softwareservicetablelist()
    {
        return DB::table('softwareservice')
            ->leftjoin('customers', 'softwareservice.companycode', '=', 'customers.companycode')
            ->leftjoin('customer_groups','softwareservice.companycode', '=','customer_groups.groupcode');
    }

    public static function softwareservicetablelist_loan()
    {
        return DB::table('softwareservice')
            ->leftjoin('customers', 'softwareservice.companycode', '=', 'customers.companycode')
            ->leftjoin('customer_groups','softwareservice.companycode', '=','customer_groups.groupcode')
            ->join('hardwareloan','softwareservice.job_no','=','hardwareloan.jobno');
    }

}
