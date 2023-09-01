<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class CustomerTotalPayApp extends Model
{
    use HasFactory;

    protected $table = 'customer_total_pay_apps';

    protected $fillable = ['customers_id', 'customer_services_id', 'shopname', 'apiurl', 'client_id', 'client_secret', 'username', 'password', 'b_acpt_op', 'b_dealforyou', 'b_locate', 'b_getgprc', 'b_reduce_principle', 'b_floating', 'b_payslip', 'b_productimage', 'merchant_code', 'merchant_key', 'chrg_amt', 'cust_chrg_amt', 'contactno', 'email', 'map_address', 'slogan', 'active','latitude','longitude'];

    public static function getModule($request)
    {
        if($request->segment(2)=="create") {
            $result='ADD TOTALPAY APP SERVICE';
        } elseif($request->segment(3)=="edit" || $request->input('_method')=="PUT"){
            $result='EDIT TOTALPAY APP SERVICE';
        } elseif(is_numeric($request->segment(2)) && $request->input('_method')=="DELETE" ){
            $result='DELETE TOTALPAY APP SERVICE';
        } else {
            $result='TOTALPAY APP SERVICE LIST';
        }
        return $result;
    }

    public function customer()
    {
        return $this->belongsTo('App\Models\Customer', 'customers_id', 'id');
    }

    public function service()
    {
        return $this->belongsTo(CustomerService::class, 'customer_services_id', 'id');
    }

    public function scopeSearchByCodeOrName(Builder $query, $searchValue)
    {
        return $query->selectRaw("customer_total_pay_apps.id,
                                  customers.companycode as 'companycode',
                                  customers.companyname,
                                  customer_total_pay_apps.b_acpt_op,
                                  customer_total_pay_apps.b_dealforyou,
                                  customer_total_pay_apps.b_locate,
                                  customer_total_pay_apps.b_getgprc,
                                  customer_total_pay_apps.active,
                                  customer_total_pay_apps.qrpdfurl")
                        ->join('customers', 'customer_total_pay_apps.customers_id', '=', 'customers.id')
                        ->join('customer_services', 'customer_total_pay_apps.customer_services_id', '=', 'customer_services.id')
                        ->where(function ($query) use ($searchValue) {
                            if (strlen($searchValue) > 3) {
                                $query->where('customers.companyname', 'like', '%' . $searchValue . '%');
                            } else {
                                $query->where('customers.companycode', 'like', '%' . $searchValue . '%');
                            }
                        })
                        ->orderBy("customers.companycode");
    }
}
