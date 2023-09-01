<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
class Armatch extends Model
{
    use HasFactory;

    protected $fillable = ['artype', 'artranid', 'arcode', 'payfortype', 'payforid', 'payforcode', 'description','amount '];

    public function invdetails() {

        return $this->belongsTo('App\Models\SalesInvoice', 'payforid', 'id');
    }
    public function outstandingamt($id,$orid) {
        $GLOBALS['orid'] = $orid;

        return DB::table('salesinvoices')
                    ->selectRaw("cast(ROUND(salesinvoices.nettotalamount-ifnull(sum(armatched.amount),0),1) as decimal(11,2)) as out_amt")
                    ->leftjoin('armatched',function($join) {
                        $join->on('salesinvoices.id', '=', 'armatched.payforid');
                        $join->where('armatched.payfortype', 'INV');
                        $join->where('armatched.artranid', '<', $GLOBALS["orid"]);
                    })
                    ->leftjoin('receipts',function($join) {
                        $join->on('armatched.artranid', '=', 'receipts.id');
                        $join->where('armatched.artype',  'OR');
                    })
                    ->where("salesinvoices.id",$id)
                    ->groupBy("salesinvoices.id")
                    ->get();
    }

    public function getdate($date){

        return Carbon::parse($date)->format('d/m/Y');
    }

}
