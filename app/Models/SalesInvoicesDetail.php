<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SalesInvoicesDetail extends Model
{
    use HasFactory;

    protected $fillable = ['invoiceid', 'stocks_id', 'pos', 'qty', 'uomid', 'unitprice', 'description', 'referenceno', 'note',
        'amount', 'discount', 'subamount', 'taxrate', 'taxamount', 'netamount'];

    public function salesdetailstock(){
        //return $this->belongsToMany('App\SalesInvoiceDetails', 'salesinvoices', 'id', 'invoiceid');
        return $this->belongsTo('App\Models\Stock', 'stocks_id', 'id');
    }
    public function salesdetailuom(){
        //return $this->belongsToMany('App\SalesInvoiceDetails', 'salesinvoices', 'id', 'invoiceid');
        return $this->belongsTo('App\Models\UOM', 'uomid', 'id');
    }
}
