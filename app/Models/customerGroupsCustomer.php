<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class customerGroupsCustomer extends Model
{
    use HasFactory;

    protected $table = 'customer_groups_customers';


    protected $fillable = ['customer_groups_id', 'customers_id'];

    public function customer()
    {
        return $this->belongsTo(Customer::class, 'customerid');
    }

//    public function customerServices()
//    {
//        return $this->hasOne(CustomerService::class, 'customers_id')->where('customer_categories_id', $this->customerGroup->customer_categories_id);
//    }

    public function customerServices()
    {
        $customerServices = $this->hasOne(CustomerService::class, 'customers_id')
                                 ->where('customer_categories_id', optional($this->customerGroup)->customer_categories_id);

        return $customerServices;
    }

    public function customerGroup()
    {
        return $this->belongsTo(CustomerGroup::class, 'customer_groups_id'); // Update the column name here
    }
}
