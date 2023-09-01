<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;


class Customer extends Model
{
    use HasFactory;

    protected $fillable = ['companyname', 'companycode', 'registrationno', 'registrationno2', 'address1', 'address2', 'address3', 'address4', 'contactperson', 'phoneno1', 'phoneno2', 'faxno1', 'faxno2', 'email', 'email2', 'email3', 'homepage', 'categoryid', 'areas_id', 'terms_id', 'status', 'startdate', 'zipcode','bandar','shortname','foldername','remarks','b_aiservice','serviceremarks'];

    public static function getModule($request){
        if($request->segment(2)=="create"){
            $result='ADD CUSTOMER';
        } elseif($request->segment(3)=="edit"){
            $result='EDIT CUSTOMER';
        } elseif(is_numeric($request->segment(2)) && $request->input('_method')!="DELETE" ){
            $result='VIEW CUSTOMER';
        } elseif(is_numeric($request->segment(2)) && $request->input('_method')=="DELETE" ){
            $result='DELETE CUSTOMER';
        } else {
            $result='CUSTOMER LIST';
        }

        return $result;
    }

    public function area()
    {
        return $this->belongsTo('App\Area', 'areas_id', 'id');
    }

    public function term()
    {
        return $this->belongsTo('App\Term', 'termid', 'id');
    }

    public function customercategory()
    {
        return $this->belongsTo('App\CustomerCategory', 'categoryid', 'id');
    }

    public function scopeSearch(Builder $query, $searchValue)
    {
        return $query->where(function ($query) use ($searchValue) {
            $query->where('areas.description', 'like', '%' . $searchValue . '%')
                ->orWhere('customers.companyname', 'like', '%' . $searchValue . '%')
                ->orWhere('customers.contactperson', 'like', '%' . $searchValue . '%')
                ->orWhere('customers.phoneno1', 'like', '%' . $searchValue . '%')
                ->orWhere('customers.phoneno2', 'like', '%' . $searchValue . '%')
                ->orWhere('customers.registrationno', 'like', '%' . $searchValue . '%')
                ->orWhere('customers.registrationno2', 'like', '%' . $searchValue . '%')
                ->orWhere('customers.companycode', 'like', '%' . $searchValue . '%')
                ->orWhere('customers.email', 'like', '%' . $searchValue . '%');
        });
    }

    public function scopeFilterByArea(Builder $query, $areaId)
    {
        return $query->where('areas.id', $areaId);
    }

    public static function customertablelist(Builder $query, $searchValue)
    {
        return DB::table('customers')
            ->join('areas', 'customers.areas_id', '=', 'areas.id')
            ->select(
                "customers.id",
                "customers.companyname",
                "areas.description",
                "customers.companycode",
                "customers.registrationno",
                "customers.registrationno2",
                "customers.contactperson",
                "customers.phoneno1",
                "customers.phoneno2",
                "customers.email",
                "customers.status"
            );
    }

    public function scopeSearchCustomer(Builder $query, $filters){
        $query->join('areas', 'customers.areas_id', '=', 'areas.id')
                ->select(
                    "customers.id",
                    "customers.companyname",
                    "areas.description",
                    "customers.companycode",
                    "customers.registrationno",
                    "customers.registrationno2",
                    "customers.contactperson",
                    "customers.phoneno1",
                    "customers.phoneno2",
                    "customers.email",
                    "customers.status"
                );

        if(isset($filters['searchvalue'])) {
            $query->where(function($query) use ($filters){
                $query->where('areas.description','like','%'.$filters['searchvalue'].'%');
                $query->orWhere('customers.companyname','like','%'.$filters['searchvalue'].'%');
                $query->orWhere('customers.contactperson','like','%'.$filters['searchvalue'].'%');
                $query->orWhere('customers.phoneno1','like','%'.$filters['searchvalue'].'%');
                $query->orWhere('customers.phoneno2','like','%'.$filters['searchvalue'].'%');
                $query->orWhere('customers.registrationno','like','%'.$filters['searchvalue'].'%');
                $query->orWhere('customers.registrationno2','like','%'.$filters['searchvalue'].'%');
                $query->orWhere('customers.companycode','like','%'.$filters['searchvalue'].'%');
                $query->orWhere('customers.email','like','%'.$filters['searchvalue'].'%');
            });
        }
        if(isset($filters['srch_area'])) {

            $query->where('areas.id', $filters['srch_area']);
        }

        return $query->orderBy('customers.companycode', 'desc');
    }

    /**
     * Accessor to format the 'startdate' attribute.
     *
     * @param  string  $value
     * @return string
     */
    public function getStartDateFormattedAttribute($value)
    {
        return date('d/m/Y', strtotime($value));
    }

    public function customerGroupsCustomer()
    {
        return $this->hasMany(customerGroupsCustomer::class, 'customers_id');
    }

    public function customerServices()
    {
        return $this->hasMany(CustomerService::class, 'customers_id', 'id');
    }
}
