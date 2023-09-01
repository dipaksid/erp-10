<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Stock extends Model
{
    use HasFactory;

    public $fillable = ['stockcode', 'stockname', 'description', 'stock_categories_id', 'sellingprice', 'purchaseprice', 'lastsellingprice','lastpurchaseprice','stockspec','categoryid','seq','b_serial','min_order_qty','min_lvl_qty','opening_year','opening_year_qty','auto_send_purchase','loan_flag','alw_pls'];

    public function stockcategory(){

        return $this->belongsToMany('App\StockCategory', 'stocks', 'id', 'stock_categories_id');
    }

    public function customercategory(){

        return $this->belongsTo('App\CustomerCategory', 'id', 'customer_categories_id');
    }

    public function uom(){

        return $this->belongsTo('App\UOMs', 'id', 'stock_id');
    }

    public function saveStock($data)
    {
        foreach($data as $key => $val){
            if(in_array($key, $this->fillable)) {
                $this->$key=$val;
            }
        }
        $this->save();

        return 1;
    }

    public function updateStock($data)
    {
        $stock = $this->find($data['id']);
        foreach($data as $key => $val){
            if(in_array($key, $this->fillable)) {
                $stock->$key=$val;
            } else {
                $stock->$key="";
            }
        }
        foreach($this->fillable as $tky){
            if(!in_array($tky,array_keys($data))){
                $stock->$tky="";
            }
        }
        $stock->save();

        return 1;
    }

    public static function getModule($request){
        if($request->segment(2)=="create"){
            $result='ADD STOCK';
        } elseif($request->segment(3)=="edit"){
            $result='EDIT STOCK';
        } elseif(is_numeric($request->segment(2)) && $request->input('_method')!="DELETE" ){
            $result='VIEW STOCK';
        } elseif(is_numeric($request->segment(2)) && $request->input('_method')=="DELETE" ){
            $result='DELETE STOCK';
        } else {
            $result='STOCK LIST';
        }

        return $result;
    }
    public static function stocktablelist(){

        return DB::table('stocks')
            ->leftjoin('stock_categories', 'stocks.catgid', '=', 'stock_categories.id');
    }
}
