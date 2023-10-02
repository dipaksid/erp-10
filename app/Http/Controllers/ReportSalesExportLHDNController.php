<?php

namespace App\Http\Controllers;

use App\Services\DataService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Report;
use App\Models\SalesInvoice;
use App\Models\Receipt;
use App\Models\Area;
use App\Models\CompanySetting;
use Carbon\Carbon;
use PDF;
use LynX39\LaraPdfMerger\Facades\PdfMerger;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\SalesExport;
use App\Exports\PaymentExport;
use App\Models\Customer;
use App\Models\PaymentVoucher;
use App\Models\Supplier;
class ReportSalesExportLHDNController extends Controller
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
        $data["customer"] = Customer::where('status', '1')->get();
        $data["area"] = Area::where('description', '!=' , '')->get();
        $data["company"] = CompanySetting::get();
        $data["logindate"] = $request->session()->get('login_date');
        $customers = $this->dataService->fetchCustomers($request);

        return view('reports.salesexportlhdn',compact('data','customers'));
    }

    public function reportexcel(Request $request){
        $customerfr = Customer::where("id",$request->input("customerfrom"))->first();
        $customerto = Customer::where("id",$request->input("customerto"))->first();
        if($request->input("area")!=""){
            $area = Area::where("areacode",$request->input("area"))->first();
        }
        $datefr = Carbon::createFromFormat('d/m/Y', $request->input("datfr"))->format('Y-m-d');
        $dateto = Carbon::createFromFormat('d/m/Y', $request->input("datto"))->format('Y-m-d');

        $condsql=""; $arrfilter=array(); $acust=array();
        if($request->input("exp_typ")=="2"){
            $paymentto = PaymentVoucher::getpaymentreportlist()
                ->selectRaw("payment_vouchers.suppliername as 'companyname', if(suppliers.registrationno!='',suppliers.registrationno,suppliers.registrationno2) as 'registrationno', suppliers.phoneno1, suppliers.address1, suppliers.address2, suppliers.address3, suppliers.bandar,
								suppliers.bandar, suppliers.zipcode, suppliers.areas_id, DATE_FORMAT(payment_vouchers.paymentdate, '%d/%m/%Y') as date, payment_vouchers.supplierid, suppliers.contactperson,
								payment_vouchers.sup_inv_no as 'sup_inv_no', payment_vouchers.amount as 'amount'")
                ->whereDate("payment_vouchers.paymentdate",">=",$datefr)
                ->whereDate("payment_vouchers.paymentdate","<=",$dateto)
                ->whereNotNull('payment_vouchers.sup_inv_no')
                ->where('payment_vouchers.sup_inv_no',"!=","[]")
                ->where('payment_vouchers.sup_inv_no',"not like","%null%")
                ->where('payment_vouchers.amount',">",0)
                ->whereNull('payment_vouchers.cancelled_at');
            if($request->has("companyid") && $request->input("companyid")!=""){
                $paymentto->where("payment_vouchers.companyid",$request->input("companyid"));
            }
            if($request->has("area") && $request->input("area")!=""){
                $paymentto->where("suppliers.areas_id",$area->id);
            }
            $paymentto->orderBy('payment_vouchers.suppliername','asc');

            if(1) {
                $arr_payment=$paymentto->get();
                $arr_data[1]=$arr_payment;

                return Excel::download(new PaymentExport($arr_data), 'PEMBEKAL_MAKLUMAT_PEMBAYAR.xlsx');
            } else {
                return view('reports.norecord');
                //abort('404');
            }
        } else {
            $salespawn = SalesInvoice::getsalesreportlist($request)
                ->selectRaw("sales_invoices.customername as 'companyname', if(customers.registrationno!='',customers.registrationno,customers.registrationno2) as 'registrationno', customers.phoneno1, customers.address1, customers.address2, customers.address3, customers.bandar,
								customers.bandar, customers.zipcode, customers.areas_id, DATE_FORMAT(sales_invoices.salesinvoicedate, '%d/%m/%Y') as date, sales_invoices.customers_id,
								sales_invoices_details.description as 'description', sales_invoices_details.note as 'note', sales_invoices_details.netamount as 'netamount'")
                ->whereDate("sales_invoices.salesinvoicedate",">=",$datefr)
                ->whereDate("sales_invoices.salesinvoicedate","<=",$dateto)
                ->where("sales_invoices_details.description","like","%WIN PAWN MANAGEMENT%")
                ->where('sales_invoices_details.netamount',">",0)
                ->whereNull('sales_invoices.cancelled_at');

            $salesgold = SalesInvoice::getsalesreportlist($request)
                ->selectRaw("sales_invoices.customername as 'companyname', if(customers.registrationno!='',customers.registrationno,customers.registrationno2) as 'registrationno', customers.phoneno1, customers.address1, customers.address2, customers.address3, customers.bandar,
								customers.bandar, customers.zipcode, customers.areas_id, DATE_FORMAT(sales_invoices.salesinvoicedate, '%d/%m/%Y') as date, sales_invoices.customers_id,
								sales_invoices_details.description as 'description', sales_invoices_details.note as 'note', sales_invoices_details.netamount as 'netamount'")
                ->whereDate("sales_invoices.salesinvoicedate",">=",$datefr)
                ->whereDate("sales_invoices.salesinvoicedate","<=",$dateto)
                ->where("sales_invoices_details.description","like","%WIN GOLDSMITH MANAGEMENT%")
                ->where('sales_invoices_details.netamount',">",0)
                ->whereNull('sales_invoices.cancelled_at');

            $salesmoney = SalesInvoice::getsalesreportlist($request)
                ->selectRaw("sales_invoices.customername as 'companyname', if(customers.registrationno!='',customers.registrationno,customers.registrationno2) as 'registrationno', customers.phoneno1, customers.address1, customers.address2, customers.address3, customers.bandar,
								customers.bandar, customers.zipcode, customers.areas_id, DATE_FORMAT(sales_invoices.salesinvoicedate, '%d/%m/%Y') as date, sales_invoices.customers_id,
								sales_invoices_details.description as 'description', sales_invoices_details.note as 'note', sales_invoices_details.netamount as 'netamount'")
                ->whereDate("sales_invoices.salesinvoicedate",">=",$datefr)
                ->whereDate("sales_invoices.salesinvoicedate","<=",$dateto)
                ->where("sales_invoices_details.description","like","%WIN MONEY LENDER MANAGEMENT%")
                ->where('sales_invoices_details.netamount',">",0)
                ->whereNull('sales_invoices.cancelled_at');

            $salesmaintain = SalesInvoice::getsalesreportlist($request)
                ->selectRaw("sales_invoices.customername as 'companyname', if(customers.registrationno!='',customers.registrationno,customers.registrationno2) as 'registrationno', customers.phoneno1, customers.address1, customers.address2, customers.address3, customers.bandar,
								customers.bandar, customers.zipcode, customers.areas_id, DATE_FORMAT(sales_invoices.salesinvoicedate, '%d/%m/%Y') as date, sales_invoices.customers_id,
								'SOFTWARE MAINTENANCE FEE' as 'description', sales_invoices_details.note as 'note', sales_invoices_details.netamount as 'netamount'")
                ->whereDate("sales_invoices.salesinvoicedate",">=",$datefr)
                ->whereDate("sales_invoices.salesinvoicedate","<=",$dateto)
                ->where('sales_invoices_details.netamount',">",0)
                ->where(function($q) {
                    $q->where('sales_invoices_details.note',"like","%SOFTWARE MAINTENANCE FEE%")
                        ->orWhere('sales_invoices_details.note',"like","%SOFTWARE  MAINTENANCE FEE%");
                })
                ->whereNull('sales_invoices.cancelled_at');

            $saleshardwaremaintain = SalesInvoice::getsalesreportlist($request)
                ->selectRaw("sales_invoices.customername as 'companyname', if(customers.registrationno!='',customers.registrationno,customers.registrationno2) as 'registrationno', customers.phoneno1, customers.address1, customers.address2, customers.address3, customers.bandar,
								customers.bandar, customers.zipcode, customers.areas_id, DATE_FORMAT(sales_invoices.salesinvoicedate, '%d/%m/%Y') as date, sales_invoices.customers_id,
								'SOFTWARE & HARDWARE MAINTENANCE' as 'description', sales_invoices_details.note as 'note', sales_invoices_details.netamount as 'netamount'")
                ->whereDate("sales_invoices.salesinvoicedate",">=",$datefr)
                ->whereDate("sales_invoices.salesinvoicedate","<=",$dateto)
                ->where("sales_invoices_details.note","like","%SOFTWARE & HARDWARE MAINTENANCE%")
                ->where('sales_invoices_details.netamount',">",0)
                ->whereNull('sales_invoices.cancelled_at');

            $salescctvsystem = SalesInvoice::getsalesreportlist($request)
                ->selectRaw("sales_invoices.customername as 'companyname', if(customers.registrationno!='',customers.registrationno,customers.registrationno2) as 'registrationno', customers.phoneno1, customers.address1, customers.address2, customers.address3, customers.bandar,
								customers.bandar, customers.zipcode, customers.areas_id, DATE_FORMAT(sales_invoices.salesinvoicedate, '%d/%m/%Y') as date, sales_invoices.customers_id,
								'CCTV SYSTEM' as 'description', sales_invoices_details.note as 'note', sales_invoices_details.netamount as 'netamount'")
                ->whereDate("sales_invoices.salesinvoicedate",">=",$datefr)
                ->whereDate("sales_invoices.salesinvoicedate","<=",$dateto)
                ->where("sales_invoices_details.description","like","%CCTV SYSTEM%")
                ->where('sales_invoices_details.netamount',">",0)
                ->whereNull('sales_invoices.cancelled_at');

            $salescctvmaintain = SalesInvoice::getsalesreportlist($request)
                ->selectRaw("sales_invoices.customername as 'companyname', if(customers.registrationno!='',customers.registrationno,customers.registrationno2) as 'registrationno', customers.phoneno1, customers.address1, customers.address2, customers.address3, customers.bandar,
								customers.bandar, customers.zipcode, customers.areas_id, DATE_FORMAT(sales_invoices.salesinvoicedate, '%d/%m/%Y') as date, sales_invoices.customers_id,
								'CCTV MAINTENANCE' as 'description', sales_invoices_details.note as 'note', sales_invoices_details.netamount as 'netamount'")
                ->whereDate("sales_invoices.salesinvoicedate",">=",$datefr)
                ->whereDate("sales_invoices.salesinvoicedate","<=",$dateto)
                ->where("sales_invoices_details.description","like","%CCTV MAINTENANCE%")
                ->where('sales_invoices_details.netamount',">",0)
                ->whereNull('sales_invoices.cancelled_at');

            $salesokiprinter = SalesInvoice::getsalesreportlist($request)
                ->selectRaw("sales_invoices.customername as 'companyname', if(customers.registrationno!='',customers.registrationno,customers.registrationno2) as 'registrationno', customers.phoneno1, customers.address1, customers.address2, customers.address3, customers.bandar,
								customers.bandar, customers.zipcode, customers.areas_id, DATE_FORMAT(sales_invoices.salesinvoicedate, '%d/%m/%Y') as date, sales_invoices.customers_id,
								'OKI DOT MATRIX PRINTER' as 'description', sales_invoices_details.note as 'note', sales_invoices_details.netamount as 'netamount'")
                ->whereDate("sales_invoices.salesinvoicedate",">=",$datefr)
                ->whereDate("sales_invoices.salesinvoicedate","<=",$dateto)
                ->whereIn('sales_invoices_details.description', array("OIK ML391T PLUS 136 COL PRINTER","OKI 391T 132COL PRINTER","OKI ML320T 80 COL DOT-MATRIX PRINTER","OKI ML321T 136 COL PRINTER"
                ,"OKI ML321T PLUS 136 COL DOT-MATRIX PRINTER","OKI ML321T PLUS 136 COL PRINTER","OKI ML3410 136 COL DOT-MATRIX PRINTER","OKI ML390T 80 COL DOT-MATRIX PRINTER","OKI ML390T 80 COL PRINTER"
                ,"OKI ML390T PLUS 136 COL PRINTER","OKI ML390T PLUS 80 COL DOT-MATRIX PRINTER","OKI ML390T PLUS 80 COL PRINTER","OKI ML391T 136 COL DOT - MATRIX PRINTER","OKI ML391T 136 COL DOT-MATRIX PRINTER"
                ,"OKI ML391T 136 COL PRINTER","OKI ML391T 80 COL PRINTER","OKI ML391T PLUS 136 CO DOT-MATRIX PRINTER","OKI ML391T PLUS 136 COL DOT-MATRIX PRINTER","OKI ML391T PLUS 136 COL PRINTER"
                ,"OKI ML391T PLUS 136 COLUMN DOT-MATRIX PRINTER","OKI ML391T PLUS DOT-MATRIX PRINTER","OKI ML790T PLUS 80 COL PRINTER","OKI ML791 PLUS 136 COL PRINTER","OKI ML791T PLUS 136 COL DOT-MATRIX PRINTER"
                ,"OKI ML791T PLUS 136 COL PRINTER"))
                ->where('sales_invoices_details.netamount',">",0)
                ->whereNull('sales_invoices.cancelled_at');

            $salespawnticket = SalesInvoice::getsalesreportlist($request)
                ->selectRaw("sales_invoices.customername as 'companyname', if(customers.registrationno!='',customers.registrationno,customers.registrationno2) as 'registrationno', customers.phoneno1, customers.address1, customers.address2, customers.address3, customers.bandar,
								customers.bandar, customers.zipcode, customers.areas_id, DATE_FORMAT(sales_invoices.salesinvoicedate, '%d/%m/%Y') as date, sales_invoices.customers_id,
								'PAWN TICKET' as 'description', sales_invoices_details.note as 'note', sales_invoices_details.netamount as 'netamount'")
                ->whereDate("sales_invoices.salesinvoicedate",">=",$datefr)
                ->whereDate("sales_invoices.salesinvoicedate","<=",$dateto)
                ->where('sales_invoices_details.note',"like","%PAWN TICKET%")
                ->where('sales_invoices_details.netamount',">",0)
                ->whereNull('sales_invoices.cancelled_at');

            $salesgoldresit = SalesInvoice::getsalesreportlist($request)
                ->selectRaw("sales_invoices.customername as 'companyname', if(customers.registrationno!='',customers.registrationno,customers.registrationno2) as 'registrationno', customers.phoneno1, customers.address1, customers.address2, customers.address3, customers.bandar,
								customers.bandar, customers.zipcode, customers.areas_id, DATE_FORMAT(sales_invoices.salesinvoicedate, '%d/%m/%Y') as date, sales_invoices.customers_id,
								'GOLD RESIT' as 'description', sales_invoices_details.note as 'note', sales_invoices_details.netamount as 'netamount'")
                ->whereDate("sales_invoices.salesinvoicedate",">=",$datefr)
                ->whereDate("sales_invoices.salesinvoicedate","<=",$dateto)
                ->where('sales_invoices_details.note',"like","%GOLD RESIT%")
                ->where('sales_invoices_details.netamount',">",0)
                ->whereNull('sales_invoices.cancelled_at');

            $salesreminder = SalesInvoice::getsalesreportlist($request)
                ->selectRaw("sales_invoices.customername as 'companyname', if(customers.registrationno!='',customers.registrationno,customers.registrationno2) as 'registrationno', customers.phoneno1, customers.address1, customers.address2, customers.address3, customers.bandar,
								customers.bandar, customers.zipcode, customers.areas_id, DATE_FORMAT(sales_invoices.salesinvoicedate, '%d/%m/%Y') as date, sales_invoices.customers_id,
								'REMINDER LETTER' as 'description', sales_invoices_details.note as 'note', sales_invoices_details.netamount as 'netamount'")
                ->whereDate("sales_invoices.salesinvoicedate",">=",$datefr)
                ->whereDate("sales_invoices.salesinvoicedate","<=",$dateto)
                ->where('sales_invoices_details.note',"like","%SURAT PERINGATAN%")
                ->where('sales_invoices_details.netamount',">",0)
                ->whereNull('sales_invoices.cancelled_at');

            $salesribbon = SalesInvoice::getsalesreportlist($request)
                ->selectRaw("sales_invoices.customername as 'companyname', if(customers.registrationno!='',customers.registrationno,customers.registrationno2) as 'registrationno', customers.phoneno1, customers.address1, customers.address2, customers.address3, customers.bandar,
								customers.bandar, customers.zipcode, customers.areas_id, DATE_FORMAT(sales_invoices.salesinvoicedate, '%d/%m/%Y') as date, sales_invoices.customers_id,
								'ORIGINAL RIBBON' as 'description', sales_invoices_details.note as 'note', sales_invoices_details.netamount as 'netamount'")
                ->whereDate("sales_invoices.salesinvoicedate",">=",$datefr)
                ->whereDate("sales_invoices.salesinvoicedate","<=",$dateto)
                ->where('sales_invoices_details.description',"like","%ORIGINAL RIBBON%")
                ->where('sales_invoices_details.netamount',">",0)
                ->whereNull('sales_invoices.cancelled_at');

            $salesplainform = SalesInvoice::getsalesreportlist($request)
                ->selectRaw("sales_invoices.customername as 'companyname', if(customers.registrationno!='',customers.registrationno,customers.registrationno2) as 'registrationno', customers.phoneno1, customers.address1, customers.address2, customers.address3, customers.bandar,
								customers.bandar, customers.zipcode, customers.areas_id, DATE_FORMAT(sales_invoices.salesinvoicedate, '%d/%m/%Y') as date, sales_invoices.customers_id,
								'PLAIN FORM' as 'description', sales_invoices_details.note as 'note', sales_invoices_details.netamount as 'netamount'")
                ->whereDate("sales_invoices.salesinvoicedate",">=",$datefr)
                ->whereDate("sales_invoices.salesinvoicedate","<=",$dateto)
                ->where('sales_invoices_details.description',"like","%PLAIN FORM%")
                ->where('sales_invoices_details.netamount',">",0)
                ->whereNull('sales_invoices.cancelled_at');

            $salesdomain = SalesInvoice::getsalesreportlist($request)
                ->selectRaw("sales_invoices.customername as 'companyname', if(customers.registrationno!='',customers.registrationno,customers.registrationno2) as 'registrationno', customers.phoneno1, customers.address1, customers.address2, customers.address3, customers.bandar,
								customers.bandar, customers.zipcode, customers.areas_id, DATE_FORMAT(sales_invoices.salesinvoicedate, '%d/%m/%Y') as date, sales_invoices.customers_id,
								sales_invoices_details.description as 'description', sales_invoices_details.note as 'note', sales_invoices_details.netamount as 'netamount'")
                ->whereDate("sales_invoices.salesinvoicedate",">=",$datefr)
                ->whereDate("sales_invoices.salesinvoicedate","<=",$dateto)
                ->where('sales_invoices_details.description',"like","%DOMAIN NAME%")
                ->where('sales_invoices_details.netamount',">",0)
                ->whereNull('sales_invoices.cancelled_at');

            $salesbattery = SalesInvoice::getsalesreportlist($request)
                ->selectRaw("sales_invoices.customername as 'companyname', if(customers.registrationno!='',customers.registrationno,customers.registrationno2) as 'registrationno', customers.phoneno1, customers.address1, customers.address2, customers.address3, customers.bandar,
								customers.bandar, customers.zipcode, customers.areas_id, DATE_FORMAT(sales_invoices.salesinvoicedate, '%d/%m/%Y') as date, sales_invoices.customers_id,
								sales_invoices_details.description as 'description', sales_invoices_details.note as 'note', sales_invoices_details.netamount as 'netamount'")
                ->whereDate("sales_invoices.salesinvoicedate",">=",$datefr)
                ->whereDate("sales_invoices.salesinvoicedate","<=",$dateto)
                ->where('sales_invoices_details.description',"like","%BATTERY%")
                ->where('sales_invoices_details.netamount',">",0)
                ->whereNull('sales_invoices.cancelled_at');

            $salesother = SalesInvoice::getsalesreportlist($request)
                ->selectRaw("sales_invoices.customername as 'companyname', if(customers.registrationno!='',customers.registrationno,customers.registrationno2) as 'registrationno', customers.phoneno1, customers.address1, customers.address2, customers.address3, customers.bandar,
								customers.bandar, customers.zipcode, customers.areas_id, DATE_FORMAT(sales_invoices.salesinvoicedate, '%d/%m/%Y') as date, sales_invoices.customers_id,
								sales_invoices_details.description as 'description', sales_invoices_details.note as 'note', sales_invoices_details.netamount as 'netamount'")
                ->whereDate("sales_invoices.salesinvoicedate",">=",$datefr)
                ->whereDate("sales_invoices.salesinvoicedate","<=",$dateto)
                ->where('sales_invoices_details.description',"not like","%WIN PAWN MANAGEMENT%")
                ->where('sales_invoices_details.description',"not like","%WIN GOLDSMITH MANAGEMENT%")
                ->where('sales_invoices_details.description',"not like","%WIN MONEY LENDER MANAGEMENT%")
                ->where('sales_invoices_details.note',"not like","%SOFTWARE  MAINTENANCE FEE%")
                ->where('sales_invoices_details.note',"not like","%SOFTWARE MAINTENANCE FEE%")
                ->where('sales_invoices_details.note',"not like","%SOFTWARE & HARDWARE MAINTENANCE%")
                ->where('sales_invoices_details.description',"not like","%CCTV SYSTEM%")
                ->where('sales_invoices_details.description',"not like","%CCTV MAINTENANCE%")
                ->whereNotIn('sales_invoices_details.description', array("OIK ML391T PLUS 136 COL PRINTER","OKI 391T 132COL PRINTER","OKI ML320T 80 COL DOT-MATRIX PRINTER","OKI ML321T 136 COL PRINTER"
                ,"OKI ML321T PLUS 136 COL DOT-MATRIX PRINTER","OKI ML321T PLUS 136 COL PRINTER","OKI ML3410 136 COL DOT-MATRIX PRINTER","OKI ML390T 80 COL DOT-MATRIX PRINTER","OKI ML390T 80 COL PRINTER"
                ,"OKI ML390T PLUS 136 COL PRINTER","OKI ML390T PLUS 80 COL DOT-MATRIX PRINTER","OKI ML390T PLUS 80 COL PRINTER","OKI ML391T 136 COL DOT - MATRIX PRINTER","OKI ML391T 136 COL DOT-MATRIX PRINTER"
                ,"OKI ML391T 136 COL PRINTER","OKI ML391T 80 COL PRINTER","OKI ML391T PLUS 136 CO DOT-MATRIX PRINTER","OKI ML391T PLUS 136 COL DOT-MATRIX PRINTER","OKI ML391T PLUS 136 COL PRINTER"
                ,"OKI ML391T PLUS 136 COLUMN DOT-MATRIX PRINTER","OKI ML391T PLUS DOT-MATRIX PRINTER","OKI ML790T PLUS 80 COL PRINTER","OKI ML791 PLUS 136 COL PRINTER","OKI ML791T PLUS 136 COL DOT-MATRIX PRINTER"
                ,"OKI ML791T PLUS 136 COL PRINTER"))
                ->where('sales_invoices_details.note',"not like","%PAWN TICKET%")
                ->where('sales_invoices_details.note',"not like","%GOLD RESIT%")
                ->where('sales_invoices_details.note',"not like","%SURAT PERINGATAN%")
                ->where('sales_invoices_details.description',"not like","%ORIGINAL RIBBON%")
                ->where('sales_invoices_details.description',"not like","%PLAIN FORM%")
                ->where('sales_invoices_details.description',"not like","%DOMAIN NAME%")
                ->where('sales_invoices_details.description',"not like","%BATTERY%")
                ->where('sales_invoices_details.netamount',">",0)
                ->whereNull('sales_invoices.cancelled_at');

            $salesother2 = SalesInvoice::getsalesreportlist($request)
                ->selectRaw("sales_invoices.customername as 'companyname', if(customers.registrationno!='',customers.registrationno,customers.registrationno2) as 'registrationno', customers.phoneno1, customers.address1, customers.address2, customers.address3, customers.bandar,
								customers.bandar, customers.zipcode, customers.areas_id, DATE_FORMAT(sales_invoices.salesinvoicedate, '%d/%m/%Y') as date, sales_invoices.customers_id,
								sales_invoices_details.description as 'description', sales_invoices_details.note as 'note', sales_invoices_details.netamount as 'netamount'")
                ->whereDate("sales_invoices.salesinvoicedate",">=",$datefr)
                ->whereDate("sales_invoices.salesinvoicedate","<=",$dateto)
                ->whereNull("sales_invoices_details.note")
                ->where('sales_invoices_details.netamount',">",0)
                ->whereNull('sales_invoices.cancelled_at');

            if($request->has("area") && $request->input("area")!=""){
                $salespawn->where("customers.areas_id",$area->id);
                $salesgold->where("customers.areas_id",$area->id);
                $salesmoney->where("customers.areas_id",$area->id);
                $salesmaintain->where("customers.areas_id",$area->id);
                $saleshardwaremaintain->where("customers.areas_id",$area->id);
                $salescctvsystem->where("customers.areas_id",$area->id);
                $salescctvmaintain->where("customers.areas_id",$area->id);
                $salesokiprinter->where("customers.areas_id",$area->id);
                $salespawnticket->where("customers.areas_id",$area->id);
                $salesgoldresit->where("customers.areas_id",$area->id);
                $salesreminder->where("customers.areas_id",$area->id);
                $salesribbon->where("customers.areas_id",$area->id);
                $salesplainform->where("customers.areas_id",$area->id);
                $salesdomain->where("customers.areas_id",$area->id);
                $salesbattery->where("customers.areas_id",$area->id);
                $salesother->where("customers.areas_id",$area->id);
                $salesother2->where("customers.areas_id",$area->id);
            }

            if($request->has("companyid") && $request->input("companyid")!=""){
                $salespawn->where("sales_invoices.companyid",$request->input("companyid"));
                $salesgold->where("sales_invoices.companyid",$request->input("companyid"));
                $salesmoney->where("sales_invoices.companyid",$request->input("companyid"));
                $salesmaintain->where("sales_invoices.companyid",$request->input("companyid"));
                $saleshardwaremaintain->where("sales_invoices.companyid",$request->input("companyid"));
                $salescctvsystem->where("sales_invoices.companyid",$request->input("companyid"));
                $salescctvmaintain->where("sales_invoices.companyid",$request->input("companyid"));
                $salesokiprinter->where("sales_invoices.companyid",$request->input("companyid"));
                $salespawnticket->where("sales_invoices.companyid",$request->input("companyid"));
                $salesgoldresit->where("sales_invoices.companyid",$request->input("companyid"));
                $salesreminder->where("sales_invoices.companyid",$request->input("companyid"));
                $salesribbon->where("sales_invoices.companyid",$request->input("companyid"));
                $salesplainform->where("sales_invoices.companyid",$request->input("companyid"));
                $salesdomain->where("sales_invoices.companyid",$request->input("companyid"));
                $salesbattery->where("sales_invoices.companyid",$request->input("companyid"));
                $salesother->where("sales_invoices.companyid",$request->input("companyid"));
                $salesother2->where("sales_invoices.companyid",$request->input("companyid"));
            }

            if($customerfr){
                $salespawn->where("sales_invoices.customername",">=",$customerfr->companyname);
                $salesgold->where("sales_invoices.customername",">=",$customerfr->companyname);
                $salesmoney->where("sales_invoices.customername",">=",$customerfr->companyname);
                $salesmaintain->where("sales_invoices.customername",">=",$customerfr->companyname);
                $saleshardwaremaintain->where("sales_invoices.customername",">=",$customerfr->companyname);
                $salescctvsystem->where("sales_invoices.customername",">=",$customerfr->companyname);
                $salescctvmaintain->where("sales_invoices.customername",">=",$customerfr->companyname);
                $salesokiprinter->where("sales_invoices.customername",">=",$customerfr->companyname);
                $salespawnticket->where("sales_invoices.customername",">=",$customerfr->companyname);
                $salesgoldresit->where("sales_invoices.customername",">=",$customerfr->companyname);
                $salesreminder->where("sales_invoices.customername",">=",$customerfr->companyname);
                $salesribbon->where("sales_invoices.customername",">=",$customerfr->companyname);
                $salesplainform->where("sales_invoices.customername",">=",$customerfr->companyname);
                $salesdomain->where("sales_invoices.customername",">=",$customerfr->companyname);
                $salesbattery->where("sales_invoices.customername",">=",$customerfr->companyname);
                $salesother->where("sales_invoices.customername",">=",$customerfr->companyname);
                $salesother2->where("sales_invoices.customername",">=",$customerfr->companyname);
            }
            if($customerto){
                $salespawn->where("sales_invoices.customername","<=",$customerto->companyname);
                $salesgold->where("sales_invoices.customername","<=",$customerto->companyname);
                $salesmoney->where("sales_invoices.customername","<=",$customerto->companyname);
                $salesmaintain->where("sales_invoices.customername","<=",$customerto->companyname);
                $saleshardwaremaintain->where("sales_invoices.customername","<=",$customerto->companyname);
                $salescctvsystem->where("sales_invoices.customername","<=",$customerto->companyname);
                $salescctvmaintain->where("sales_invoices.customername","<=",$customerto->companyname);
                $salesokiprinter->where("sales_invoices.customername","<=",$customerfr->companyname);
                $salespawnticket->where("sales_invoices.customername","<=",$customerfr->companyname);
                $salesgoldresit->where("sales_invoices.customername","<=",$customerfr->companyname);
                $salesreminder->where("sales_invoices.customername","<=",$customerfr->companyname);
                $salesribbon->where("sales_invoices.customername","<=",$customerfr->companyname);
                $salesplainform->where("sales_invoices.customername","<=",$customerfr->companyname);
                $salesdomain->where("sales_invoices.customername","<=",$customerfr->companyname);
                $salesbattery->where("sales_invoices.customername","<=",$customerfr->companyname);
                $salesother->where("sales_invoices.customername","<=",$customerfr->companyname);
                $salesother2->where("sales_invoices.customername","<=",$customerfr->companyname);
            }
            $salespawn->orderBy('sales_invoices.customername','asc');
            $salesgold->orderBy('sales_invoices.customername','asc');
            $salesmoney->orderBy('sales_invoices.customername','asc');
            $salesmaintain->orderBy('sales_invoices.customername','asc');
            $saleshardwaremaintain->orderBy('sales_invoices.customername','asc');
            $salescctvsystem->orderBy('sales_invoices.customername','asc');
            $salescctvmaintain->orderBy('sales_invoices.customername','asc');
            $salesokiprinter->orderBy('sales_invoices.customername','asc');
            $salespawnticket->orderBy('sales_invoices.customername','asc');
            $salesgoldresit->orderBy('sales_invoices.customername','asc');
            $salesreminder->orderBy('sales_invoices.customername','asc');
            $salesribbon->orderBy('sales_invoices.customername','asc');
            $salesplainform->orderBy('sales_invoices.customername','asc');
            $salesdomain->orderBy('sales_invoices.customername','asc');
            $salesbattery->orderBy('sales_invoices.customername','asc');
            $salesother->orderBy('sales_invoices.customername','asc');
            $salesother2->orderBy('sales_invoices.customername','asc');

            if ($salespawn->exists() || $salesgold->exists() || $salesmoney->exists() || $salesmaintain->exists() || $saleshardwaremaintain->exists() || $salescctvsystem->exists()
                || $salescctvmaintain->exists() || $salesokiprinter->exists() || $salespawnticket->exists() || $salesgoldresit->exists() || $salesreminder->exists() || $salesribbon->exists()
                || $salesplainform->exists() || $salesdomain->exists() || $salesbattery->exists() || $salesother->exists() || $salesother2->exists()) {
                $arr_pawn=$salespawn->get();
                $arr_gold=$salesgold->get();
                $arr_money=$salesmoney->get();
                $arr_maintain=$salesmaintain->get();
                $arr_hardwaremaintain=$saleshardwaremaintain->get();
                $arr_cctvsys=$salescctvsystem->get();
                $arr_cctvmain=$salescctvmaintain->get();
                $arr_okiprinter=$salesokiprinter->get();
                $arr_pawnticket=$salespawnticket->get();
                $arr_goldresit=$salesgoldresit->get();
                $arr_reminder=$salesreminder->get();
                $arr_ribbon=$salesribbon->get();
                $arr_plainform=$salesplainform->get();
                $arr_salesdomain=$salesdomain->get();
                $arr_battery=$salesbattery->get();
                $arr_other=$salesother->get();
                $arr_other2=$salesother2->get();
                $arr_data[1]=$arr_pawn;
                $arr_data[2]=$arr_gold;
                $arr_data[3]=$arr_money;
                $arr_data[4]=$arr_maintain;
                $arr_data[5]=$arr_hardwaremaintain;
                $arr_data[6]=$arr_cctvsys;
                $arr_data[7]=$arr_cctvmain;
                $arr_data[8]=$arr_okiprinter;
                $arr_data[9]=$arr_pawnticket;
                $arr_data[10]=$arr_goldresit;
                $arr_data[11]=$arr_reminder;
                $arr_data[12]=$arr_ribbon;
                $arr_data[13]=$arr_plainform;
                $arr_data[14]=$arr_salesdomain;
                $arr_data[15]=$arr_battery;
                $arr_data[16]=$arr_other;
                $arr_data[17]=$arr_other2;

                $arr_data = [
                    $arr_pawn, $arr_gold, $arr_money, $arr_maintain, $arr_hardwaremaintain, $arr_cctvsys, $arr_cctvmain,
                    $arr_okiprinter, $arr_pawnticket, $arr_goldresit, $arr_reminder, $arr_ribbon, $arr_plainform, $arr_salesdomain,
                    $arr_battery, $arr_other, $arr_other2
                ];

                return Excel::download(new SalesExport($arr_data), 'PEMBELI_DAN_PENERIMA_PERKHIDMATAN_Pawnbroker_Management_Software.xlsx');
            } else {
                return view('reports.norecord');
                //abort('404');
            }
        }
    }
}
