<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class CustomerPwspgapp extends Model
{
    use HasFactory;

    protected $table = 'customer_pwspgapps';

    protected $fillable = ['users_id', 'customers_id', 'apiurl', 'client_id', 'client_secret', 'username', 'password', 'active', 'last_token', 'token_dt'];

    const ITEMS_PER_PAGE = 15;

    public static function getModule($request)
    {
        if ($request->segment(2) == "create") {
            $result = 'ADD PWS PG APP SERVICE';
        } elseif ($request->segment(3) == "edit" || $request->input('_method') == "PUT") {
            $result = 'EDIT PWS PG APP SERVICE';
        } elseif (is_numeric($request->segment(2)) && $request->input('_method') == "DELETE") {
            $result = 'DELETE PWS PG APP SERVICE';
        } else {
            $result = 'PWS PG APP SERVICE LIST';
        }
        return $result;
    }

    public function scopeWithUserData($query)
    {
//        return $query->selectRaw(
//                "api_oauth_users.id as 'id', api_oauth_users.username as 'username', " .
//                "api_oauth_users.mob_pho as 'mob_pho', api_oauth_users.first_name as 'first_name', " .
//                "group_concat(customers.companyname) as 'customer'"
//            )
//            //->leftJoin('api_oauth_users', 'customer_pwspgapps.users_id', '=', 'api_oauth_users.id')
//            ->leftJoin('customers', 'customer_pwspgapps.customerid', '=', 'customers.id')
//            ->groupBy("customer_pwspgapps.users_id")
//            ->orderBy("customer_pwspgapps.users_id");

        return $query->selectRaw(
                "user_details.id as 'id', user_details.username as 'username', " .
                "user_details.mob_pho as 'mob_pho', user_details.first_name as 'first_name', " .
                "group_concat(customers.companyname) as 'customer'"
            )
            ->leftJoin('user_details', 'customer_pwspgapps.users_id', '=', 'user_details.id')
            ->leftJoin('customers', 'customer_pwspgapps.customers_id', '=', 'customers.id')
            ->groupBy("customer_pwspgapps.users_id")
            ->orderBy("customer_pwspgapps.users_id");
    }

    public function scopeSearchByKeyword($query, $keyword)
    {
        if (strlen($keyword) > 3) {
            $field = 'customers.companyname';
        } else {
            $field = 'customers.companycode';
        }

        return $query->where($field, 'like', '%' . $keyword . '%');
    }

    public function scopeCustomerPwspgappTableList($query)
    {
        return $query->with('customer', 'apiOAuthUser');
    }

    public function scopeFetchEditData(Builder $query, $id)
    {
        return $query->selectRaw("user_details.id as 'id', user_details.username as 'username', user_details.password as 'password', user_details.mob_pho as 'mob_pho', user_details.first_name as 'first_name',
            user_details.idle_tim as 'idle_tim', user_details.access_pdf as 'access_pdf', user_details.email as 'email',
            group_concat(customers.id) as 'customerid', group_concat(concat(customers.companycode,'-',customers.companyname)) as 'customer', group_concat(customer_pwspgapps.apiurl) as 'apiurl',
            group_concat(customer_pwspgapps.id) as 'pgappid'")
            ->join('user_details', 'customer_pwspgapps.users_id', '=', 'user_details.id')
            ->join('customers', 'customer_pwspgapps.customers_id', '=', 'customers.id')
            ->join('customer_pwspgapps as cp', 'cp.customers_id', '=', 'customers.id')
            ->where('user_details.id', $id)
            ->groupBy('user_details.id')
            ->first();
    }
}
