<?php

namespace App\Http\Controllers;

use App\Models\CustomerService;
use Illuminate\Http\Request;

class ReportServiceMainController extends Controller
{
    public function index(Request $request)
    {
        $data["logindate"] = $request->session()->get('login_date');

        return view('reports.servicemain',compact('data'));
    }

    public function reportpdf(Request $request)
    {
        $utldat = Carbon::createFromFormat('d/m/Y',date("t",mktime(0,0,0,substr($request->input("period"),0,2),1,substr($request->input("period"),3,4)))."/".$request->input("period"))
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
												SELECT salesinvoices.salesinvoicecode FROM salesinvoices INNER JOIN salesinvoicedetails ON salesinvoicedetails.invoiceid=salesinvoices.id WHERE salesinvoices.customerid=customers.id AND
												((salesinvoicedetails.note like '%MAINTENANCE FEE%' AND (salesinvoicedetails.note like '%PWS%' OR salesinvoicedetails.note like '%PAWN%') AND customer_categories.categorycode='PWS' )
												OR (salesinvoicedetails.note like '%MAINTENANCE FEE%' AND (salesinvoicedetails.note like '%GSS%' OR salesinvoicedetails.note like '%GOLD%') AND customer_categories.categorycode='GSS' )
												OR (salesinvoicedetails.note like '%MAINTENANCE FEE%' AND salesinvoicedetails.note like '%CCTV%' AND customer_categories.categorycode='CCTV' )
												OR (salesinvoicedetails.note like '%MAINTENANCE FEE%' AND salesinvoicedetails.note like '%DNS%' AND customer_categories.categorycode LIKE '%DNS%' ) )
												AND date_format(salesinvoices.salesinvoicedate,'%Y%m')>=if(customer_services.pay_before='Y',DATE_FORMAT(date_add(concat(substr(customer_services.end_date,7,4),'-',substr(customer_services.end_date,4,2),'-',substr(customer_services.end_date,1,2)),INTERVAL -2 MONTH), '%Y%m'),
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
												SELECT DATE_FORMAT(salesinvoices.salesinvoicedate,'%d/%m/%Y') as 'salesinvoicedate' FROM salesinvoices INNER JOIN salesinvoicedetails ON salesinvoicedetails.invoiceid=salesinvoices.id WHERE salesinvoices.customerid=customers.id AND
												((salesinvoicedetails.note like '%MAINTENANCE FEE%' AND (salesinvoicedetails.note like '%PWS%' OR salesinvoicedetails.note like '%PAWN%') AND customer_categories.categorycode='PWS' )
												OR (salesinvoicedetails.note like '%MAINTENANCE FEE%' AND (salesinvoicedetails.note like '%GSS%' OR salesinvoicedetails.note like '%GOLD%') AND customer_categories.categorycode='GSS' )
												OR (salesinvoicedetails.note like '%MAINTENANCE FEE%' AND salesinvoicedetails.note like '%CCTV%' AND customer_categories.categorycode='CCTV' )
												OR (salesinvoicedetails.note like '%MAINTENANCE FEE%' AND salesinvoicedetails.note like '%DNS%' AND customer_categories.categorycode LIKE '%DNS%' ) )
												AND date_format(salesinvoices.salesinvoicedate,'%Y%m')>=if(customer_services.pay_before='Y',DATE_FORMAT(date_add(concat(substr(customer_services.end_date,7,4),'-',substr(customer_services.end_date,4,2),'-',substr(customer_services.end_date,1,2)),INTERVAL -2 MONTH), '%Y%m'),
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
            $pdf = PDF::loadView('report.servicemainpdf');
            $pdf->getDomPDF()->set_option("enable_php", true);
            return $pdf->stream();
        } else {
            return view('report.norecord');
            //abort('404');
        }
    }

}
