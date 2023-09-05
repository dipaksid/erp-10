<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\SalesInvoice;
use Illuminate\Http\Request;

class SalesInvoicesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function getcustinfo(Request $request)
    {
        $data = Customer::select('id','termid','contactperson','phoneno1','companyname as customername','remarks','email','email2')
                            ->where('id', $request->input("customerid"))
                            ->get()
                            ->first();

        return $data;
    }

    public function savesalesnote(Request $request)
    {
        $salesinvoice = SalesInvoice::find($request->input("invid"));
        $salesinvoice->sales_note=$request->input("mnote");
        $salesinvoice->save();
        $arr_return["msg"] = "Sales Note Saved!";

        return $arr_return;
    }

    public function pdftoprinter(Request $request){
        if($request->has('posttoken')){
            $posttoken=$request->session()->get('_posttoken');
            $request->session()->forget('_posttoken');
            if($posttoken!=$request->input('posttoken')) {
                echo json_encode(array("status"=>"error !! Redundance printing process"));
                exit;
            }
        }
        $smsg="";
        $printfile= new Printfile();
        $dd = "";
        if($request->has("mode") && $request->input("mode")=="prtinvdo"){
            $invid=$request->input("id");
            if($request->has("cpdinv") && $request->input("cpdinv")=="1" && $request->has("cpddo") && $request->input("cpddo")=="1") {
                $salesinvoice = SalesInvoice::where('salesinvoicecode',$invid)->get()->first();
                if($salesinvoice){
                    $storagepath = Storage::disk('app')->path('acct');
                    $csalesinvoicedate = Carbon::parse($salesinvoice['salesinvoicedate']);
                    $salesinvoicedate =  $csalesinvoicedate->format('d/m/Y');
                    $year = substr($salesinvoicedate,6,4);
                    $yearmonth = substr($salesinvoicedate,6,4).substr($salesinvoicedate,3,2);
                    $fileprint = $storagepath."/acct".$year."/invoice/".$yearmonth."/".$invid.".pdf";
                    if(file_exists($fileprint)){
                        $invrcv = SalesInvoice::getcustsaleslist($salesinvoice->customerid)
                            ->selectRaw("salesinvoices.id, cast(ROUND(ifnull(sum(armatched.amount),0),1) as decimal(11,2)) as rcv_amt")
                            ->where("salesinvoices.id",$salesinvoice->id)
                            ->first();
                        $rcvamt = $invrcv->rcv_amt;
                        if($rcvamt>0){
                            //$dd="Yes got receipt";
                            $pages = $printfile->count_pdf_pages($fileprint);
                            $pages = $pages-1;
                            $printfile->printtoprinter($fileprint,"Letter","1",$request->input("cp"),false,"-o page-ranges=1-".$pages);
                            sleep(1);
                            $printfile->printtoprinter($fileprint,"A5","3",$request->input("cp"),true,"-o page-ranges=".($pages+1));
                        } else {
                            //$dd="No receipt";
                            $printfile->printtoprinter($fileprint,"Letter","1",$request->input("cp"));
                        }
                    }
                }
            } else if($request->has("cpdinv") && $request->input("cpdinv")=="1") {
                $this->invoicepdf($request,$request->input('id'));
                $printfile->printtoprinter(public_path().'/pdf/invoice_'.$invid.'.pdf',"Letter","1","1");
            } else if($request->has("cpddo") && $request->input("cpddo")=="1") {
                $this->dopdf($request,$request->input('id'));
                $printfile->printtoprinter(public_path().'/pdf/do_'.$invid.'.pdf',"Letter","1","1");
            }
        } else {
            if($request->input('invcp')>0){
                if($request->has("cpinvid")){
                    foreach($request->input("cpinvid") as $invid){
                        $printfile->printtoprinter(public_path().'/pdf/invoice_'.$invid.'.pdf',"Letter","1",$request->input("invcp"));
                    }
                } else {
                    $printfile->printtoprinter(public_path().'/pdf/invoice_'.$request->input('id').'.pdf',"Letter","1",$request->input("invcp"));
                }
            }
            if($request->input('docp')>0){
                if($request->has("cpinvid")){
                    foreach($request->input("cpinvid") as $invid){
                        $printfile->printtoprinter(public_path().'/pdf/do_'.$invid.'.pdf',"Letter","1",$request->input("docp"));
                    }
                } else {
                    $printfile->printtoprinter(public_path().'/pdf/do_'.$request->input('id').'.pdf',"Letter","1",$request->input("docp"));
                }
            }
            if($request->has('mfcp') && $request->input('mfcp')>0){
                if($request->has("cpinvid")){
                    foreach($request->input("cpinvid") as $invid){
                        $printfile->printtoprinter(public_path().'/pdf/mf_'.$invid.'.pdf',"Letter","1",$request->input("mfcp"));
                    }
                }
                $smsg = ", ".$request->input('mfcp')." Maintainance Form.";
            }
        }
        if($request->has("id")){
            echo json_encode(array("status"=>"Printed ".$request->input('id')." (".$request->input('invcp')." Invoice, ".$request->input('docp')." DO".$smsg.")"));
        } else {
            echo json_encode(array("status"=>"success"));
        }
    }

    public function checkcustnote(Request $request)
    {
        $dateutl = date("Y-m-d");

        $salesinvoice = SalesInvoice::getoutstandingsaleslist()
            ->selectRaw("salesinvoices.id as 'id', DATE_FORMAT(salesinvoices.salesinvoicedate, '%d/%m/%Y') as salesinvoicedate,
                        salesinvoices.salesinvoicecode as salesinvoicecode, ifnull(salesinvoices.sales_note,'') as sales_note,
                        cast(salesinvoices.nettotalamount-ifnull(sum(if((receipts.receiptdate<='".$dateutl."' and armatched.artype='OR') or (arcn.cndate<='".$dateutl."' and armatched.artype='CN') , armatched.amount,0) ),0) as decimal(11,2))
                         as outstanding")
            ->where('salesinvoices.customerid',$request->input("customerid"))
            ->groupBy('salesinvoices.id')
            ->having('outstanding','>',0.05)
            ->orderBy('salesinvoices.salesinvoicedate','desc')
            ->orderBy('salesinvoices.salesinvoicecode','desc');
        $arr_return["list"]=$salesinvoice->get();

        return $arr_return;
    }

    public function checkcust(Request $request)
    {
        return $this->create($request,['checkcust'=>'Y']);
    }
}
