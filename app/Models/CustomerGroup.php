<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Agent;

class CustomerGroup extends Model
{
    use HasFactory;

    protected $table = 'customer_groups';

    protected $fillable = ['groupcode', 'description', 'foldername'];

    const CUSTOMER_GROUPS_PER_PAGE = 15;

    public function customergroupdetails()
    {
        return $this->belongsTo('App\Models\customerGroupsCustomer', 'id', 'customer_groups_id');
    }

    public function category()
    {
        return $this->belongsTo('App\Models\CustomerCategory', 'categories_id', 'id');
    }

    public function agent()
    {
        return $this->belongsTo('App\Models\Agent', 'agents_id', 'id');
    }

    public static function getModule($request)
    {
        if($request->segment(2)=="create") {
            $result='ADD CUSTOMER GROUP';
        } elseif($request->segment(3)=="edit") {
            $result='EDIT CUSTOMER GROUP';
        } elseif(is_numeric($request->segment(2)) && $request->input('_method')!="DELETE" ) {
            $result='VIEW CUSTOMER GROUP';
        } elseif(is_numeric($request->segment(2)) && $request->input('_method')=="DELETE" ) {
            $result='DELETE CUSTOMER GROUP';
        } else {
            $result='CUSTOMER GROUP LIST';
        }

        return $result;
    }

    protected function scopeSearchCustomerGroupsWithFilters(Builder $query, $filters)
    {
        if(isset($filters['searchvalue']) && $filters['searchvalue'] != ''){
            $query->selectRaw("customer_groups.id as 'id', customer_groups.groupcode as 'code', customer_groups.description as 'name', customer_categories.description as 'system', concat(company_settings.companycode,' - ',company_settings.companyname) as 'companyfrom', group_concat(customers.companyname) as 'company', if(customer_groups.cfgpassword!='',concat(customer_categories.categorycode,'(',customer_groups.cfgpassword,')'),'') as 'cfg' ");
            $query->where('customer_groups.groupcode','like','%'.$filters['searchvalue'].'%')
                  ->orwhere('customer_groups.description','like','%'.$filters['searchvalue'].'%');
        }else{
            $query->selectRaw("customer_groups.id as 'id', customer_groups.groupcode as 'code', customer_groups.description as 'name', customer_categories.description as 'system', concat(company_settings.companycode,' - ',company_settings.companyname) as 'companyfrom', group_concat(customers.companyname) as 'company', if(customer_groups.cfgpassword!='',concat(customer_categories.categorycode,'(<a href=\"javascript:void(0);\" onclick=\"js_openfile(\'".url('/')."',customer_groups.cfgfile,'\')\">',customer_groups.cfgpassword,')</a>'),'') as 'cfg' ");
        }

        $query->leftjoin('customer_groups_customers', 'customer_groups.id', '=', 'customer_groups_customers.customer_groups_id')
            ->leftjoin('customers', 'customer_groups_customers.customers_id', '=', 'customers.id')
            ->leftjoin('customer_categories', 'customer_groups.customer_categories_id', '=', 'customer_categories.id')
            ->leftjoin('company_settings', 'customer_groups.companyid', '=', 'company_settings.id');

        return $query->groupBy("customer_groups.id")
            ->orderBy("customer_groups.groupcode")->paginate(self::CUSTOMER_GROUPS_PER_PAGE);
    }

    public function customerGroupsCustomer()
    {
        return $this->hasMany(customerGroupsCustomer::class, 'customer_groups_id');
    }
}
