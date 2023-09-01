<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CompanySetting extends Model
{
    use HasFactory;

    protected $table = 'company_settings';

    protected $fillable = ['companycode', 'companyname', 'registrationno', 'registrationno2', 'gstno', 'address1', 'address2', 'address3', 'address4', 'zipcode', 'city', 'areaid', 'contactperson', 'contactperson2', 'phoneno1', 'phoneno2', 'email', 'email2', 'bankid1', 'bankacc1', 'bankid2', 'bankacc2', 'b_default'];
    const COMPANY_SETTINGS_PER_PAGE = 15;
    public static function getModule($request){

        if($request->segment(2)=="create"){
            $result='ADD COMPANY SETTINGS';
        } elseif($request->segment(3)=="edit"){
            $result='EDIT COMPANY SETTINGS';
        } elseif(is_numeric($request->segment(2)) && $request->input('_method')!="DELETE" ){
            $result='VIEW COMPANY SETTINGS';
        } elseif(is_numeric($request->segment(2)) && $request->input('_method')=="DELETE" ){
            $result='DELETE COMPANY SETTINGS';
        } else {
            $result='COMPANY SETTINGS LIST';
        }
        return $result;
        //return 'COMPANY SETTING';
    }

    public function scopeSearchCompanySettingWithFilters(Builder $query, $filters){
        if(isset($filters['searchvalue'])) {
            $query->where(function ($query) use ($filters) {
                if (isset($filters['searchvalue'])) {
                    $query->where('companycode','like','%'. $filters['searchvalue'] .'%')
                            ->orwhere('companyname','like','%'. $filters['searchvalue'] .'%')
                            ->orwhere('registrationno','like','%'. $filters['searchvalue'] .'%');
                }
            });
        }

        return $query->orderBy('id', 'desc')->paginate(self::COMPANY_SETTINGS_PER_PAGE);
    }
}
