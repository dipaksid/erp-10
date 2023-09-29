<?php

namespace App\Http\Controllers;

use App\Models\CustomerService;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Barryvdh\DomPDF\Facade\Pdf as PDF;

class ReportServiceMainController extends Controller
{
    public function index(Request $request)
    {
        $date = Carbon::createFromFormat('Y-m-d H:i:s', $request->session()->get('login_date'));
        $data["logindate"] = $date->format('m').'/'.$date->format('Y');

        return view('reports.servicemain',compact('data'));
    }

    public function reportpdf(Request $request)
    {
        $utldat = Carbon::createFromFormat('d/m/Y',date("t", mktime(0,0,0,substr($request->input("period"),0,2),1,substr($request->input("period"),3,4)))."/".$request->input("period"))
                        ->format('Y-m-d');
        $condsql=""; $arrfilter=array(); $acust=array();
        $subsql = ($request->input("inc_inv")=="N")?" AND salesinvoicedate=''":"";
        $sales = CustomerService::customerservicereportlist()
            ->selectRaw("customer_services.id, if(customer_services.pay_before='Y',DATE_FORMAT(concat(substr(customer_services.end_date,7,4),'-',substr(customer_services.end_date,4,2),'-',substr(customer_services.end_date,1,2)), '%d/%m/%Y'),
												if(customer_services.contract_typ=1, DATE_FORMAT(date_add(date_add(concat(substr(customer_services.service_date,7,4),'-',substr(customer_services.service_date,4,2),'-',substr(customer_services.service_date,1,2)),INTERVAL 1 YEAR), INTERVAL -1 DAY), '%d/%m/%Y'),
													if(customer_services.contract_typ=2, DATE_FORMAT(date_add(date_add(concat(substr(customer_services.service_date,7,4),'-',substr(customer_services.service_date,4,2),'-',substr(customer_services.service_date,1,2)),INTERVAL 1 MONTH), INTERVAL -1 DAY), '%d/%m/%Y'),
														if(customer_services.contract_typ=3, DATE_FORMAT(date_add(date_add(concat(substr(customer_services.service_date,7,4),'-',substr(customer_services.service_date,4,2),'-',substr(customer_services.service_date,1,2)),INTERVAL 2 MONTH), INTERVAL -1 DAY), '%d/%m/%Y'),
															if(customer_services.contract_typ=4, DATE_FORMAT(date_add(date_add(concat(substr(customer_services.service_date,7,4),'-',substr(customer_services.service_date,4,2),'-',substr(customer_services.service_date,1,2)),INTERVAL 6 MONTH), INTERVAL -1 DAY), '%d/%m/%Y'),
																if(customer_services.contract_typ=5, DATE_FORMAT(date_add(date_add(concat(substr(customer_services.service_date,7,4),'-',substr(customer_services.service_date,4,2),'-',substr(customer_services.service_date,1,2)),INTERVAL 3 MONTH), INTERVAL -1 DAY), '%d/%m/%Y'),'')
															)
														)
													)
												)
											)  as end_date1,
											DATE_FORMAT(concat(substr(customer_services.service_date,7,4),'-',substr(customer_services.service_date,4,2),'-',substr(customer_services.service_date,1,2)), '%d/%m/%Y') as service_date, customer_categories.categorycode,
											customer_services.inc_hw as inc_hw, customer_services.pay_before,  customer_services.amount as 'amount', customers.companyname, areas.areacode, areas.description as area_desc,
											if(customer_services.contract_typ=1,'YEARLY', if(customer_services.contract_typ=2,'MONTHLY', if(customer_services.contract_typ=3,'BI-MONTHLY', if(customer_services.contract_typ=4,'HALF YEAR',
											if(customer_services.contract_typ=5,'QUARTERLY',''))))) as contract,
											(
												SELECT sales_invoices.salesinvoicecode FROM sales_invoices INNER JOIN sales_invoices_details ON sales_invoices_details.invoiceid=sales_invoices.id WHERE sales_invoices.customers_id=customers.id AND
												((sales_invoices_details.note like '%MAINTENANCE FEE%' AND (sales_invoices_details.note like '%PWS%' OR sales_invoices_details.note like '%PAWN%') AND customer_categories.categorycode='PWS' )
												OR (sales_invoices_details.note like '%MAINTENANCE FEE%' AND (sales_invoices_details.note like '%GSS%' OR sales_invoices_details.note like '%GOLD%') AND customer_categories.categorycode='GSS' )
												OR (sales_invoices_details.note like '%MAINTENANCE FEE%' AND sales_invoices_details.note like '%CCTV%' AND customer_categories.categorycode='CCTV' )
												OR (sales_invoices_details.note like '%MAINTENANCE FEE%' AND sales_invoices_details.note like '%DNS%' AND customer_categories.categorycode LIKE '%DNS%' ) )
												AND date_format(sales_invoices.salesinvoicedate,'%Y%m')>=if(customer_services.pay_before='Y',DATE_FORMAT(date_add(concat(substr(customer_services.end_date,7,4),'-',substr(customer_services.end_date,4,2),'-',substr(customer_services.end_date,1,2)),INTERVAL -2 MONTH), '%Y%m'),
													if(customer_services.contract_typ=1, DATE_FORMAT(date_add(date_add(date_add(concat(substr(customer_services.service_date,7,4),'-',substr(customer_services.service_date,4,2),'-',substr(customer_services.service_date,1,2)),INTERVAL 1 YEAR), INTERVAL -1 DAY),INTERVAL -2 MONTH), '%Y%m'),
														if(customer_services.contract_typ=2, DATE_FORMAT(date_add(date_add(date_add(concat(substr(customer_services.service_date,7,4),'-',substr(customer_services.service_date,4,2),'-',substr(customer_services.service_date,1,2)),INTERVAL 1 MONTH), INTERVAL -1 DAY),INTERVAL -2 MONTH), '%Y%m'),
															if(customer_services.contract_typ=3, DATE_FORMAT(date_add(date_add(date_add(concat(substr(customer_services.service_date,7,4),'-',substr(customer_services.service_date,4,2),'-',substr(customer_services.service_date,1,2)),INTERVAL 2 MONTH), INTERVAL -1 DAY),INTERVAL -2 MONTH), '%Y%m'),
																if(customer_services.contract_typ=4, DATE_FORMAT(date_add(date_add(date_add(concat(substr(customer_services.service_date,7,4),'-',substr(customer_services.service_date,4,2),'-',substr(customer_services.service_date,1,2)),INTERVAL 6 MONTH), INTERVAL -1 DAY),INTERVAL -2 MONTH), '%Y%m'),
																	if(customer_services.contract_typ=5, DATE_FORMAT(date_add(date_add(date_add(concat(substr(customer_services.service_date,7,4),'-',substr(customer_services.service_date,4,2),'-',substr(customer_services.service_date,1,2)),INTERVAL 3 MONTH), INTERVAL -1 DAY),INTERVAL -2 MONTH), '%Y%m'),'')
																)
															)
														)
													)
												) LIMIT 1
											) as 'salesinvoicecode',
											(
												SELECT DATE_FORMAT(sales_invoices.salesinvoicedate,'%d/%m/%Y') as 'salesinvoicedate' FROM sales_invoices INNER JOIN sales_invoices_details ON sales_invoices_details.invoiceid=sales_invoices.id WHERE sales_invoices.customers_id=customers.id AND
												((sales_invoices_details.note like '%MAINTENANCE FEE%' AND (sales_invoices_details.note like '%PWS%' OR sales_invoices_details.note like '%PAWN%') AND customer_categories.categorycode='PWS' )
												OR (sales_invoices_details.note like '%MAINTENANCE FEE%' AND (sales_invoices_details.note like '%GSS%' OR sales_invoices_details.note like '%GOLD%') AND customer_categories.categorycode='GSS' )
												OR (sales_invoices_details.note like '%MAINTENANCE FEE%' AND sales_invoices_details.note like '%CCTV%' AND customer_categories.categorycode='CCTV' )
												OR (sales_invoices_details.note like '%MAINTENANCE FEE%' AND sales_invoices_details.note like '%DNS%' AND customer_categories.categorycode LIKE '%DNS%' ) )
												AND date_format(sales_invoices.salesinvoicedate,'%Y%m')>=if(customer_services.pay_before='Y',DATE_FORMAT(date_add(concat(substr(customer_services.end_date,7,4),'-',substr(customer_services.end_date,4,2),'-',substr(customer_services.end_date,1,2)),INTERVAL -2 MONTH), '%Y%m'),
													if(customer_services.contract_typ=1, DATE_FORMAT(date_add(date_add(date_add(concat(substr(customer_services.service_date,7,4),'-',substr(customer_services.service_date,4,2),'-',substr(customer_services.service_date,1,2)),INTERVAL 1 YEAR), INTERVAL -1 DAY),INTERVAL -2 MONTH), '%Y%m'),
														if(customer_services.contract_typ=2, DATE_FORMAT(date_add(date_add(date_add(concat(substr(customer_services.service_date,7,4),'-',substr(customer_services.service_date,4,2),'-',substr(customer_services.service_date,1,2)),INTERVAL 1 MONTH), INTERVAL -1 DAY),INTERVAL -2 MONTH), '%Y%m'),
															if(customer_services.contract_typ=3, DATE_FORMAT(date_add(date_add(date_add(concat(substr(customer_services.service_date,7,4),'-',substr(customer_services.service_date,4,2),'-',substr(customer_services.service_date,1,2)),INTERVAL 2 MONTH), INTERVAL -1 DAY),INTERVAL -2 MONTH), '%Y%m'),
																if(customer_services.contract_typ=4, DATE_FORMAT(date_add(date_add(date_add(concat(substr(customer_services.service_date,7,4),'-',substr(customer_services.service_date,4,2),'-',substr(customer_services.service_date,1,2)),INTERVAL 6 MONTH), INTERVAL -1 DAY),INTERVAL -2 MONTH), '%Y%m'),
																	if(customer_services.contract_typ=5, DATE_FORMAT(date_add(date_add(date_add(concat(substr(customer_services.service_date,7,4),'-',substr(customer_services.service_date,4,2),'-',substr(customer_services.service_date,1,2)),INTERVAL 3 MONTH), INTERVAL -1 DAY),INTERVAL -2 MONTH), '%Y%m'),'')
																)
															)
														)
													)
												) LIMIT 1
											) as 'salesinvoicedate'
                           ")
            ->whereRaw("((customer_services.pay_before='Y' AND concat(substr(customer_services.end_date,7,4),'-',substr(customer_services.end_date,4,2),'-',substr(customer_services.end_date,1,2))<='".$utldat."')
						OR (customer_services.pay_before='N' AND customer_services.contract_typ=1 AND date_format(date_add(date_add(concat(substr(customer_services.service_date,7,4),'-',substr(customer_services.service_date,4,2),'-',substr(customer_services.service_date,1,2)),INTERVAL 1 YEAR), INTERVAL -1 DAY),'%Y-%m-%d')<='".$utldat."')
						OR (customer_services.pay_before='N' AND customer_services.contract_typ=2 AND date_format(date_add(date_add(concat(substr(customer_services.service_date,7,4),'-',substr(customer_services.service_date,4,2),'-',substr(customer_services.service_date,1,2)),INTERVAL 1 MONTH), INTERVAL -1 DAY),'%Y-%m-%d')<='".$utldat."')
						OR (customer_services.pay_before='N' AND customer_services.contract_typ=3 AND date_format(date_add(date_add(concat(substr(customer_services.service_date,7,4),'-',substr(customer_services.service_date,4,2),'-',substr(customer_services.service_date,1,2)),INTERVAL 2 MONTH), INTERVAL -1 DAY),'%Y-%m-%d')<='".$utldat."')
						OR (customer_services.pay_before='N' AND customer_services.contract_typ=4 AND date_format(date_add(date_add(concat(substr(customer_services.service_date,7,4),'-',substr(customer_services.service_date,4,2),'-',substr(customer_services.service_date,1,2)),INTERVAL 6 MONTH), INTERVAL -1 DAY),'%Y-%m-%d')<='".$utldat."')
						OR (customer_services.pay_before='N' AND customer_services.contract_typ=5 AND date_format(date_add(date_add(concat(substr(customer_services.service_date,7,4),'-',substr(customer_services.service_date,4,2),'-',substr(customer_services.service_date,1,2)),INTERVAL 3 MONTH), INTERVAL -1 DAY),'%Y-%m-%d')<='".$utldat."')
						) AND customer_services.amount>0 AND customer_services.active='Y' ")
            ->orderBy('areas.areacode','asc')
            ->orderBy('end_date1','asc')
            ->orderBy('customer_categories.id','asc')
            ->orderBy('customers.companyname','asc');

        if($sales->exists()){
            $arr_data=$sales->get();

            view()->share('data',$arr_data);
            view()->share('request',$request);

            PDF::setOptions(['dpi' => 150, 'defaultFont' => 'sans-serif']);
            // pass view file
            $pdf = PDF::loadView('reports.servicemainpdf');
            $pdf->getDomPDF()->set_option("enable_php", true);
            return $pdf->stream();
        } else {
            return view('reports.norecord');
            //abort('404');
        }
    }

}
