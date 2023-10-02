<?php

namespace App\Http\Controllers;

use App\Models\Area;
use App\Models\Customer;
use App\Models\Report;
use App\Models\SalesInvoice;
use App\Models\TaSalesReceipt;
use App\Models\CompanySetting;
use App\Services\DataService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App;
use Carbon\Carbon;
use Barryvdh\DomPDF\Facade\Pdf as PDF;
use LynX39\LaraPdfMerger\Facades\PdfMerger;

class ReportOutstandingsController extends Controller
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

    public function index(Request $request)
    {
        $data["area"] = Area::where('description', '!=' , '')->get();
        $data["logindate"] = $request->session()->get('login_date');
        $customers = $this->dataService->fetchCustomers($request);

        return view('reports.outstanding', compact('data','customers'));
    }

    public function reportpdf(Request $request)
    {
        $dateutl = Carbon::createFromFormat('d/m/Y', $request->input("untildate"))->format('Y-m-d');

        $condsql=""; $arrfilter=array(); $acust=array(); $acomp = array();

        if($request->input("customerfrom_text")!="" || $request->input("customerto_text")!="" || $request->input("areafr")!="" || $request->input("areato")!="")
        {

            if($request->input("customerfrom_text")!="") {
                $acsfr = explode("-", $request->input("customerfrom_text"));
                $condsql.="customers.companycode >= ?";
                //$request->input("customerfrom_text")=$acsfr[0];
                $request->customerfrom_text=$acsfr[0];
                array_push($arrfilter,$acsfr[0]);
            }

            if($request->input("customerto_text")!=""){
                $acsto = explode("-", $request->input("customerto_text"));
                $condsql.=($condsql!="")?" AND ":"";
                $condsql.="customers.companycode <= ?";
                //$request->input("customerto_text")=$acsto[0];
                $request->customerto_text=$acsto[0];
                array_push($arrfilter,$acsto[0]);
            }

            if($request->input("areafr")!=""){
                $condsql.=($condsql!="")?" AND ":"";
                $condsql.="areas.areacode >= ?";
                array_push($arrfilter,$request->input("areafr"));
            }

            if($request->input("areato")!=""){
                $condsql.=($condsql!="")?" AND ":"";
                $condsql.="areas.areacode <= ?";
                array_push($arrfilter,$request->input("areato"));
            }

            $customer = Customer::customertablelist()
                                    ->whereRaw($condsql, $arrfilter)
                                    ->selectRaw('customers.id as id')
                                    ->orderBy('areas.description')
                                    ->orderBy('customers.companycode');

            if($customer->exists()){
                $customerdata = $customer->get();
                foreach($customerdata as $rcust){
                    array_push($acust, $rcust->id);
                }
            }
        }

        if($request->has("comp_id")){
            foreach($request->input("comp_id") as $d => $compid){
                array_push($acomp, $compid);
            }
        }

        if($request->has("custgroup")) {
            $outstanding = SalesInvoice::getoutstandingsaleslist()
                ->selectRaw("customer_groups.description as 'groupname',
                         areas.areacode as areacode,
                         areas.description as area_desc,
                         DATE_FORMAT(sales_invoices.salesinvoicedate, '%d/%m/%Y') as date,
                         sales_invoices.salesinvoicecode as invoiceno,
                         customers.companyname as name,
                         terms.term as term,
                         sales_invoices.nettotalamount as sal_amt,
                         CAST(sales_invoices.nettotalamount - IFNULL(
                             SUM(
                                 IF(
                                     (receipts.receiptdate <= '$dateutl' AND armatches.artype = 'OR') OR
                                     (arcns.cndate <= '$dateutl' AND armatches.artype = 'CN'),
                                     armatches.amount,
                                     0
                                 )
                             ),
                             0
                         ) AS DECIMAL(11, 2)) as out_amt")
                ->whereDate("sales_invoices.salesinvoicedate", "<=", $dateutl)
                ->groupBy('sales_invoices.id', 'customer_groups.description')
                ->having('out_amt', '>', 0.05)
                ->orderByRaw('customer_groups.id IS NULL, customer_groups.id,
                          areas.seq ASC, customers.areas_id ASC, customers.companycode ASC,
                          sales_invoices.salesinvoicedate ASC, sales_invoices.salesinvoicecode ASC');

        }else {
            $outstanding = SalesInvoice::getoutstandingsaleslist()
                ->selectRaw("areas.areacode as areacode, areas.description as area_desc, DATE_FORMAT(sales_invoices.salesinvoicedate, '%d/%m/%Y') as date, sales_invoices.salesinvoicecode as invoiceno, customers.companyname as name, terms.term as term,
							sales_invoices.nettotalamount as sal_amt, cast(sales_invoices.nettotalamount-ifnull(sum(if((receipts.receiptdate<='".$dateutl."' and armatches.artype='OR') or (arcns.cndate<='".$dateutl."' and armatches.artype='CN') , armatches.amount,0) ),0) as decimal(11,2)) as out_amt,
							sales_invoices.companyid as 'companyid'")
                ->whereDate("sales_invoices.salesinvoicedate","<=",$dateutl)
                ->groupBy('sales_invoices.id')
                ->having('out_amt','>',0.05)
                ->orderBy('sales_invoices.companyid','asc')
                ->orderBy('areas.seq','asc')
                ->orderBy('customers.areas_id','asc')
                ->orderBy('customers.companycode','asc')
                ->orderBy('sales_invoices.salesinvoicedate','asc')
                ->orderBy('sales_invoices.salesinvoicecode','asc');
        }

        if(!empty($acust)) {
            $outstanding->whereIn('customers.id', $acust);
        }
        //if(!empty($acomp)) {
        $outstanding->whereIn('sales_invoices.companyid', $acomp);
        //}
        if($request->input("areadesc")!=""){
            $outstanding->where('areas.description', $request->input("areadesc"));
        }
        $outauc = Tasalesreceipt::selectRaw("substr(salesinvoicecode,4,3) as areacode, if(substr(salesinvoicecode,4,3)='MAL','MELAKA',if(substr(salesinvoicecode,4,3)='SBH','SABAH',if(substr(salesinvoicecode,4,3)='SWK','SARAWAK','OTHER'))) as area_desc,
							DATE_FORMAT(salesinvoicedate, '%d/%m/%Y') as date, salesinvoicecode as invoiceno, customername as name, '' as term,
							nettotalamount as sal_amt, nettotalamount as out_amt, '11' as 'companyid'")
            ->whereDate("salesinvoicedate","<=",$dateutl)
            ->whereNull("receiptcode")
            ->orderByRaw('substr(salesinvoicecode,4,3) asc, salesinvoicecode asc, customername asc');

        if((!empty($acomp) && !in_array("11",$acomp)) || empty($acomp)) {
            $outauc->where('salesinvoicecode', 'aa1');
        }
        if($request->input("areafr")!="" && $request->input("areato")!=""){
            $area = Area::select("auc_cod")->where("areacode",">=",$request->input("areafr"))->where("areacode","<=",$request->input("areato"))->where("auc_cod","!=","")->get();
            if($area->count()>0) {
                $arrarea = array();
                $tara = "";
                foreach($area as $rarea) {
                    array_push($arrarea,$rarea->auc_cod);
                    $tara .= ($tara=="")?$rarea->auc_cod:$rarea->auc_cod.'","';
                }
                $outauc->whereRaw('substr(salesinvoicecode,4,3) in ("'.$tara.'")' );
            }
        }
        if($outstanding->exists() || $outauc->exists()){
            $arr_data=$outstanding->get();
            $arr_data2=$outauc->get();
            $acompany = CompanySetting::get();
            $company=array();
            if($acompany) foreach($acompany as $rcompany) {
                $company[$rcompany->id]["code"]=$rcompany->companycode;
                $company[$rcompany->id]["name"]=$rcompany->companyname;
            }
            view()->share('data',$arr_data);
            view()->share('company',$company);
            view()->share('request',$request);
            view()->share('aucdata',$arr_data2);
            PDF::setOptions(['dpi' => 150, 'defaultFont' => 'sans-serif']);
            // pass view file
            if($request->has("custgroup")) {
                $pdf = PDF::loadView('reports.outstandingbycustgrppdf');
            } else {
                $pdf = PDF::loadView('reports.outstandingpdf');
            }
            $pdf->getDomPDF()->set_option("enable_php", true);
            return $pdf->stream();
        } else {
            return view('reports.norecord');
            //abort('404');
        }
    }

}
