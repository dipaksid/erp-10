<?php

namespace App\Http\Controllers;

use App\Models\Area;
use App\Models\SalesInvoice;
use App\Services\DataService;
use Carbon\Carbon;
use Illuminate\Http\Request;
use RPTPDF;

class ReportSalesController extends Controller
{
    /**
     * Constructor for the class.
     *
     * @param App\Services\DataService $dataService An instance of the DataService class used for data operations.
     */
    public function __construct(DataService $dataService)
    {
        $this->dataService = $dataService;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = [
            'area' => Area::where('description', '!=' , '')->get(),
            'login_date' => \request()->session()->get('login_date'),
            'customers' => $this->dataService->fetchCustomers(request()),
        ];

        return view('reports.sales',compact('data'));
    }

    public function reportpdf(Request $request){
        $datefr = Carbon::createFromFormat('d/m/Y', $request->input("datfr"))->format('Y-m-d');
        $dateto = Carbon::createFromFormat('d/m/Y', $request->input("datto"))->format('Y-m-d');
        $condsql=""; $arrfilter=array(); $acust=array();

        $sales = SalesInvoice::getsalesreportlist($request);
        if(in_array($request->input("rptoption"),array("2","3"))) {
            $sales->leftjoin('armatched',function($join) {
                $join->on('sales_invoices.id', '=', 'armatched.payforid');
                $join->where('armatched.payfortype', '=', 'INV');
                $join->where('armatched.artype', '=', 'CN');
            });
            if(in_array($request->input("rptoption"),array("3"))) {
                $sales->leftjoin('arcn',function($join) {
                    $join->on('armatched.artranid', '=', 'arcn.id');
                });
            }
            if(in_array($request->input("rptoption"),array("3"))) {
                $sales->selectRaw("sales_invoices.id, DATE_FORMAT(sales_invoices.salesinvoicedate, '%d/%m/%Y') as date, DATE_FORMAT(sales_invoices.salesinvoicedate, '%m/%Y') as period, sales_invoices.salesinvoicecode as salesinvoicecode, customers.companyname as name,
                            group_concat(distinct(sales_invoices_details.description)) as 'description', sales_invoices.nettotalamount-if(arcn.cndate is not null and arcn.cndate<='".$dateto."',ifnull(armatched.amount,0),0) as 'sal_amt', ifnull(sales_invoices.cancelled_at,'') as 'cancelled_at', sales_invoices.companyid as 'companyid'");
            } else {
                $sales->selectRaw("sales_invoices.id, DATE_FORMAT(sales_invoices.salesinvoicedate, '%d/%m/%Y') as date, DATE_FORMAT(sales_invoices.salesinvoicedate, '%m/%Y') as period, sales_invoices.salesinvoicecode as salesinvoicecode, customers.companyname as name,
                            group_concat(distinct(sales_invoices_details.description)) as 'description', sales_invoices.nettotalamount-ifnull(armatched.amount,0) as 'sal_amt', ifnull(sales_invoices.cancelled_at,'') as 'cancelled_at', sales_invoices.companyid as 'companyid'");
            }
        } else {
            $sales->selectRaw("sales_invoices.id, DATE_FORMAT(sales_invoices.salesinvoicedate, '%d/%m/%Y') as date, DATE_FORMAT(sales_invoices.salesinvoicedate, '%m/%Y') as period, sales_invoices.salesinvoicecode as salesinvoicecode, customers.companyname as name,
                            group_concat(distinct(sales_invoices_details.description)) as 'description', sales_invoices.nettotalamount as 'sal_amt', ifnull(sales_invoices.cancelled_at,'') as 'cancelled_at', sales_invoices.companyid as 'companyid'");
        }
        $sales->whereDate("sales_invoices.salesinvoicedate",">=",$datefr)
            ->whereDate("sales_invoices.salesinvoicedate","<=",$dateto)
            ->groupBy('sales_invoices.id')
            ->orderBy('sales_invoices.companyid','asc')
            ->orderBy('sales_invoices.salesinvoicedate','asc')
            ->orderBy('sales_invoices.salesinvoicecode','asc')
            ->orderBy('customers.companycode','asc');

        if($request->has("area") && $request->input("area")!=""){
            $area = Area::where("areacode",$request->input("area"))->first();
            $sales->where("customers.areaid",$area->id);
        }
        if($sales->exists()){
            $arr_data=$sales->get();
            RPTPDF::SetTitle('Sales Report');
            $data=array();
            $npage=1;
            $keepdate=""; $nrow=0; $arrpage=array(); $arrcomp=array();
            $sum=array(); $sum2=array();
            $totsum["sal_amt"]=0;
            $totsum["sal_qty"]=0;
            $recpage=39;
            $keepcomp = "";
            foreach($arr_data as $row_data){
                if($request->input("det_sum")=="S") {
                    if($keepdate!=substr($row_data->date,3)){
                        $nrow++;
                        if($nrow==$recpage){
                            array_push($arrpage,$data);
                            array_push($arrcomp,false);
                            $nrow=0; unset($data); $data=array();
                        }
                    } else if($keepcomp!=$row_data->companyid && $keepcomp!=""){
                        $nrow++;
                        if($nrow==$recpage){
                            array_push($arrpage,$data);
                            array_push($arrcomp,true);
                            $nrow=0; unset($data); $data=array();
                        }
                    }
                    $keepdate=substr($row_data->date,3);
                } else {
                    if($keepdate!=$row_data->date){
                        $nrow++;
                        if($nrow==$recpage){
                            array_push($arrpage,$data);
                            array_push($arrcomp,false);
                            $nrow=0; unset($data); $data=array();
                        }else if($keepcomp!=$row_data->companyid && $keepcomp!=""){
                            array_push($arrpage,$data);
                            array_push($arrcomp,true);
                            $nrow=0; unset($data); $data=array();
                        }
                    } else if($keepcomp!=$row_data->companyid && $keepcomp!=""){
                        array_push($arrpage,$data);
                        array_push($arrcomp,true);
                        $nrow=0; unset($data); $data=array();
                    }
                    $nrow++;
                    $keepdate=$row_data->date;
                }
                array_push($data,$row_data);
                if($nrow==$recpage){
                    array_push($arrpage,$data);
                    array_push($arrcomp,false);
                    $nrow=0; unset($data); $data=array();
                }
                if($row_data->cancelled_at==""){
                    //$sum[$row_data->date]["sal_amt"] = (isset($sum[$row_data->date]["sal_amt"]))?$sum[$row_data->date]["sal_amt"]+$row_data->sal_amt:$row_data->sal_amt;
                    $sum[$row_data->companyid][$row_data->date]["sal_amt"] = (isset($sum[$row_data->companyid][$row_data->date]["sal_amt"]))?$sum[$row_data->companyid][$row_data->date]["sal_amt"]+$row_data->sal_amt:$row_data->sal_amt;
                    $sum2[$row_data->companyid]["sal_amt"] = (isset($sum2[$row_data->companyid]["sal_amt"]))?$sum2[$row_data->companyid]["sal_amt"]+$row_data->sal_amt:$row_data->sal_amt;
                    $totsum["sal_amt"]+=$row_data->sal_amt;
                    $totsum["sal_qty"]++;
                }
                $keepcomp = $row_data->companyid;
            }
            if($nrow<$recpage && $nrow>0){
                array_push($arrpage,$data);
                array_push($arrcomp,false);
                $nrow=0; unset($data); $data=array();
            }
            $totpage=count($arrpage);
            $companylist = CompanySetting::get();
            if($companylist){
                foreach($companylist as $rcomplist){
                    $company[$rcomplist->id] = $rcomplist;
                }
            }

            if($arrpage) foreach($arrpage as $npg=> $rowpage){
                $data=$rowpage;
                $bcompg = $arrcomp[$npg];
                $finalpage = ($totpage==$npage)?true:false;
                RPTPDF::SetMargins(10, 10, 10, true);
                RPTPDF::SetAutoPageBreak(false, 10);
                RPTPDF::AddPage();
                RPTPDF::writeHTML(view('report.salespdf1',compact('data','request','npage','totpage','finalpage','sum','totsum','company','bcompg','sum2')), true, false, true, false, '');
                $npage++;
            }
            return RPTPDF::Output(storage_path("sales_report.pdf"));

            view()->share('data',$arr_data);
            view()->share('request',$request);
            PDF::setOptions(['dpi' => 150, 'defaultFont' => 'sans-serif']);
            // pass view file
            $pdf = PDF::loadView('report.salespdf');
            $pdf->getDomPDF()->set_option("enable_php", true);
            return $pdf->stream();
        } else {
            return view('reports.norecord');
            //abort('404');
        }
    }
}
