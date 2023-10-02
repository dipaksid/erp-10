<?php

namespace App\Http\Controllers;

use App\Models\Report;
use App\Models\SalesInvoice;
use App\Models\Receipt;
use App\Models\Area;
use Carbon\Carbon;
use Barryvdh\DomPDF\Facade\Pdf as PDF;
use LynX39\LaraPdfMerger\Facades\PdfMerger;
use Illuminate\Http\Request;

class ReportCreditNotesController extends Controller
{
    public function index(Request $request)
    {
        $data["area"] = Area::where('description', '!=' , '')->get();
        $data["logindate"] = $request->session()->get('login_date');

        return view('reports.creditnote',compact('data'));
    }

    public function reportpdf(Request $request)
    {
        $datefr = Carbon::createFromFormat('d/m/Y', $request->input("datfr"))->format('Y-m-d');
        $dateto = Carbon::createFromFormat('d/m/Y', $request->input("datto"))->format('Y-m-d');
        $condsql=""; $arrfilter=array(); $acust=array();

        $sales = SalesInvoice::getsalescreditnotelist($request);

        $sales->selectRaw("sales_invoices.id, DATE_FORMAT(arcns.cndate, '%d/%m/%Y') as cndate, DATE_FORMAT(sales_invoices.salesinvoicedate, '%d/%m/%Y') as date, DATE_FORMAT(sales_invoices.salesinvoicedate, '%m/%Y') as period, sales_invoices.salesinvoicecode as salesinvoicecode, customers.companyname as name,
						group_concat(distinct(sales_invoices_details.description)) as 'description', arcns.nettotalamount as 'cn_amt'");
        $sales->whereDate("arcns.cndate",">=",$datefr)
                ->whereDate("arcns.cndate","<=",$dateto)
                ->groupBy('arcns.id', 'sales_invoices.id', 'arcns.cndate', 'sales_invoices.salesinvoicedate', 'sales_invoices.salesinvoicecode', 'customers.companyname', 'arcns.nettotalamount');

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
            $pdf = PDF::loadView('reports.creditnotepdf');
            $pdf->getDomPDF()->set_option("enable_php", true);
            return $pdf->stream();
        } else {
            return view('reports.norecord');
            //abort('404');
        }
    }
}
