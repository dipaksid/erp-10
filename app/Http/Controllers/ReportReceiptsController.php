<?php

namespace App\Http\Controllers;

use App\Models\Area;
use App\Models\Receipt;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf as PDF;

class ReportReceiptsController extends Controller
{
    public function index(Request $request)
    {
        $data["area"] = Area::where('description', '!=' , '')->get();
        $data["logindate"] = $request->session()->get('login_date');

        return view('reports.receipt',compact('data'));
    }

    public function reportpdf(Request $request)
    {
        $datefr = Carbon::createFromFormat('d/m/Y', $request->input("datfr"))->format('Y-m-d');
        $dateto = Carbon::createFromFormat('d/m/Y', $request->input("datto"))->format('Y-m-d');
        $condsql = "";
        $arrfilter = array();
        $acust = array();

        $receipts = Receipt::getreceiptinvlist($request)
            ->selectRaw("receipts.id, DATE_FORMAT(receipts.receiptdate, '%d/%m/%Y') as date, receipts.receiptcode as receiptcode, customers.companyname as name, group_concat(armatches.payforcode) as 'inv',
                            if(substr(receipts.referenceno,1,4)='CASH',receipts.nettotalamount,0) as 'CASH', if(substr(receipts.referenceno,1,2)!='TB' && substr(receipts.referenceno,1,4)!='CASH',receipts.nettotalamount,0) as 'CHEQUE',
                                if(substr(receipts.referenceno,1,2)='TB',receipts.nettotalamount,0) as 'TB'")
            ->groupBy('receipts.id')
            ->orderBy('receipts.receiptdate', 'asc')
            ->orderBy('receipts.receiptcode', 'asc')
            ->orderBy('customers.companycode', 'asc');

        if ($receipts->exists()) {
            $arr_data = $receipts->get();

            view()->share('data', $arr_data);
            view()->share('request', $request);

            PDF::setOptions(['dpi' => 150, 'defaultFont' => 'sans-serif']);

            // Pass view file
            $pdf = PDF::loadView('reports.receiptpdf');
            $pdf->getDomPDF()->set_option("enable_php", true);

            return $pdf->stream();
        } else {
            return view('reports.norecord');
            //abort('404');
        }
    }
}
