<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tasalesreceipt extends Model
{
    use HasFactory;
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'ta_sales_receipts';

    protected $fillable = ['salesinvoicecode', 'salesinvoicedate', 'receiptcode', 'receiptdate', 'customername', 'nettotalamount', 'bankdoc_id', 'companyid'];
}
