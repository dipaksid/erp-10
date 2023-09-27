<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App;
use App\Models\Report;
use App\Models\SalesInvoice;
use App\Models\Receipt;
use App\Models\Area;
use Carbon\Carbon;
use Barryvdh\DomPDF\Facade\Pdf as PDF;
use LynX39\LaraPdfMerger\Facades\PdfMerger;

class ReportCancelSalesController extends Controller
{
    public function index(Request $request)
    {
        $data["area"] = Area::where('description', '!=' , '')->get();
        $data["logindate"] = $request->session()->get('login_date');

        return view('reports.cancelsales',compact('data'));
    }
    public function reportpdf(Request $request)
    {
        $datefr = Carbon::createFromFormat('d/m/Y', $request->input("datfr"))->format('Y-m-d');
        $dateto = Carbon::createFromFormat('d/m/Y', $request->input("datto"))->format('Y-m-d');
        $condsql=""; $arrfilter=array(); $acust=array();
        $sales = SalesInvoice::getsalesreportlist($request);
        $sales->selectRaw("sales_invoices.id, DATE_FORMAT(sales_invoices.cancelled_at, '%d/%m/%Y') as canceldate, DATE_FORMAT(sales_invoices.salesinvoicedate, '%d/%m/%Y') as date, DATE_FORMAT(sales_invoices.salesinvoicedate, '%m/%Y') as period, sales_invoices.salesinvoicecode as salesinvoicecode, customers.companyname as name,
						group_concat(distinct(sales_invoices_details.description)) as 'description', sales_invoices.nettotalamount as 'sal_amt', ifnull(sales_invoices.cancelled_at,'') as 'cancelled_at'");
        $sales->whereDate("sales_invoices.cancelled_at",">=",$datefr)
            ->whereDate("sales_invoices.cancelled_at","<=",$dateto)
            ->groupBy('sales_invoices.id')
            ->orderBy('sales_invoices.salesinvoicedate','asc')
            ->orderBy('sales_invoices.salesinvoicecode','asc')
            ->orderBy('customers.companycode','asc');

        if($request->has("area") && $request->input("area")!=""){
            $area = Area::where("areacode",$request->input("area"))->first();
            $sales->where("customers.areas_id",$area->id);
        }
        if($sales->exists()){
            $arr_data=$sales->get();

            view()->share('data',$arr_data);
            view()->share('request',$request);

            PDF::setOptions(['dpi' => 150, 'defaultFont' => 'sans-serif']);
            // pass view file
            $pdf = PDF::loadView('reports.cancelsalespdf');
            $pdf->getDomPDF()->set_option("enable_php", true);

            return $pdf->stream();
        } else {

            return view('reports.norecord');
            //abort('404');
        }
    }

}
