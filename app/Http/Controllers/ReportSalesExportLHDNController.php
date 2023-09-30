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
    public function reportexcel(Request $request)
    {
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

            if ($paymentto->exists()) {
                $arr_payment = $paymentto->get();
                $arr_data[1] = $arr_payment;

                $excel = \Maatwebsite\Excel\Excel::create('PEMBEKAL MAKLUMAT/PEMBAYAR', function($excel) use ($arr_data) {
                    $excel->setTitle('PEMBEKAL')
                        ->setCreator('Brightwin')
                        ->setCompany('Brightwin');

                    $excel->sheet('DETAIL', function($sheet) use ($arr_data) {
                        $sheet->setColumnFormat([
                            'E' => '@',
                            'O' => '0.00',
                            'R' => 'dd/mm/yyyy',
                        ]);

                        $sheet->row(1, [
                            'BIL', 'NAMA', 'KP LAMA', 'KP BARU', 'NO ROC / ROB', 'NO RUJUKAN CUKAI PENDAPATAN', 'ALAMAT 1', 'ALAMAT 2', 'ALAMAT 3', 'POSKOD', 'BANDAR', 'NEGERI', 'KOD LUAR NEGARA', 'NO TELEFON', 'JUMLAH BAYARAN/ KOMISEN', 'JUMLAH INSENTIF BUKAN BERUPA TUNAI', 'JENIS INSENTIF BUKAN BERUPA TUNAI', 'TARIKH', 'JENIS BAYARAN KERJA', 'NAMA', 'KP LAMA', 'KP BARU', 'NO RUJUKAN CUKAI PENDAPATAN', 'NO PENDAFTARAN SYKT', 'ALAMAT 1', 'ALAMAT 2', 'ALAMAT 3', 'POSKOD', 'BANDAR1', 'NEGERI1', 'KOD LUAR NEGARA', 'NO TELEFON'
                        ]);

                        $nlop = 2;
                        $nrno = 1;
                        $totnetamount = 0;

                        foreach ($arr_data as $n_f => $arr_data1) {
                            if ($arr_data1) {
                                foreach ($arr_data1 as $row_data) {
                                    $supplier = Supplier::where('id', $row_data->supplierid)->first();
                                    $version = (in_array($n_f, [1, 2, 3, 6])) ? "VER 1.0" : "";
                                    $arr_inv = json_decode($row_data->sup_inv_no, true);
                                    $payfor = "Bayar Untuk Inv: ";
                                    $ff = 0;

                                    if ($arr_inv) {
                                        foreach ($arr_inv as $row_inv) {
                                            if ($ff > 0) {
                                                $payfor .= "," . $row_inv;
                                            } else {
                                                $payfor .= $row_inv;
                                            }
                                            $ff++;
                                        }
                                    }

                                    $sheet->row($nlop, [
                                        $nrno, $row_data->companyname, '', '', $row_data->registrationno, '', $row_data->address1, $row_data->address2, $row_data->address3, $row_data->zipcode, $row_data->bandar, $supplier->area1->description, '', $row_data->phoneno1, $row_data->amount, '', '', $row_data->date, $payfor, $row_data->contactperson, "", "", "", "", "", "", "", "", "", "", "", $row_data->phoneno1
                                    ]);

                                    $sheet->setCellValueExplicit('E' . $nlop, $row_data->registrationno); // number to string

                                    $nrno++;
                                    $nlop++;
                                    $totnetamount += $row_data->amount;
                                }
                            }
                        }

                        $sheet->row($nlop, [
                            '', '', '', '', '', '', '', '', '', '', '', '', '', '', $totnetamount, '', '', '', '', '', '', '', '', '', '', ''
                        ]);
                    });
                });

                return $excel->download("xls");
            } else {
                return view('reports.norecord');
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

            if(true) {
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

                $excel = \Maatwebsite\Excel\Excel::create('PEMBELI_DAN_PENERIMA_PERKHIDMATAN_Pawnbroker_Management_Software', function($excel) use($arr_data) {
                    $excel->setTitle('PERKHIDMATAN')
                        ->setCreator('Brightwin')
                        ->setCompany('Brightwin');

                    $excel->sheet('DETAIL', function($sheet) use($arr_data) {
                        $sheet->setColumnFormat([
                            'E' => '@',
                            'Y' => '0.00',
                            'X' => 'dd/mm/yyyy',
                        ]);

                        $sheet->row(1, [
                            'BIL', 'NAMA PELANGGAN', 'KP LAMA', 'KP BARU', 'NO PENDAFTARAN SYKT', 'NO RUJUKAN CUKAI PENDAPATAN', 'ALAMAT 1', 'ALAMAT 2', 'ALAMAT 3', 'POSKOD', 'BANDAR', 'NEGERI', 'KOD LUAR NEGARA', 'NO TELEFON', 'JENIS PERISIAN ATAU PERKHIDMATAN', 'MODEL / VERSI', 'ALAMAT ASET 1', 'ALAMAT ASET 2', 'ALAMAT ASET 3', 'POSKOD', 'BANDAR', 'NEGERI', 'KOD LUAR NEGARA', 'TARIKH JUALAN / PERKHIDMATAN', 'JUM BYR PERISIAN / PERKHIDMATAN', 'TAHUN BERAKHIR'
                        ]);

                        $nlop = 2;
                        $nrno = 1;
                        $totnetamount = 0;

                        foreach ($arr_data as $n_f => $arr_data1) {
                            if ($arr_data1) {
                                foreach ($arr_data1 as $row_data) {
                                    $customer = Customer::where('id', $row_data->customers_id)->first();
                                    $version = (in_array($n_f, [1, 2, 3, 6])) ? "VER 1.0" : "";
                                    $sheet->row($nlop, [
                                        $nrno, $row_data->companyname, '', '', $row_data->registrationno, '', $row_data->address1, $row_data->address2, $row_data->address3, $row_data->zipcode, $row_data->bandar, $customer->area1->description, '', $row_data->phoneno1, $row_data->description, $version, $row_data->address1, $row_data->address2, $row_data->address3, $row_data->zipcode, $row_data->bandar, $customer->area1->description, 'D', $row_data->date, $row_data->netamount, substr($row_data->date, 6, 4)
                                    ]);

                                    $sheet->setCellValueExplicit('E' . $nlop, $row_data->registrationno); // number to string

                                    $nrno++;
                                    $nlop++;
                                    $totnetamount += $row_data->netamount;
                                }
                            }
                        }

                        $sheet->row($nlop, [
                            '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', $totnetamount, ''
                        ]);
                    });
                });
                return $excel->download("xls");

            } else {
                return view('reports.norecord');
                //abort('404');
            }
        }
    }
}
