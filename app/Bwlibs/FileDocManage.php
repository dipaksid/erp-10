<?PHP
namespace App\Bwlibs;

use App\Models\SalesInvoice;
use App\Models\SalesInvoicesDetail;
use App\Models\Customer;
use App\Models\Receipt;
use App\Models\CreditNote;
use App\Models\Armatch;
use App\Models\PaymentVoucher;
use App\Models\CompanySetting;
use App\Models\Bankdoc;
use App\Models\Bank;
use App\Models\Staff;
use App\Models\LeaveForm;
use App\Models\User;
use App\Models\Tasalesreceipt;
use Carbon\Carbon;
use PDF;
use LynX39\LaraPdfMerger\Facades\PdfMerger;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Log;

class FileDocManage  {
	##########################################################################
	# Declare variable
	##########################################################################
	// Tags Variable
	protected $typ = '';
	protected $storagepath='';

	function __construct() {
	}

	function getreadypath($typ,&$storagepath,&$storagepath1,$year,$yearmonth,$foldernam,$banknam=""){
		if(!file_exists($storagepath)) {
			if(!mkdir($storagepath,0777)){
				return false;
			}
		}
		$storagepath = $storagepath."/acct".$year;
		if(!file_exists($storagepath)) {
			if(!mkdir($storagepath,0777)){
				return false;
			}
		}
		$storagepath1=$storagepath;
		if(in_array($typ,array("SI"))) {
			$storagepath = $storagepath."/invoice";
			if(!file_exists($storagepath)) {
				if(!mkdir($storagepath,0777)){
					return false;
				}
			}
			$storagepath = $storagepath."/".$yearmonth;
			if(!file_exists($storagepath)) {
				if(!mkdir($storagepath,0777)){
					return false;
				}
			}
		} else if(in_array($typ,array("CN"))){
			$storagepath = $storagepath."/creditnote";
			if(!file_exists($storagepath)) {
				if(!mkdir($storagepath,0777)){
					return false;
				}
			}
			$storagepath = $storagepath."/".$yearmonth;
			if(!file_exists($storagepath)) {
				if(!mkdir($storagepath,0777)){
					return false;
				}
			}
		} else if(in_array($typ,array("PV"))){
			$storagepath = $storagepath."/paymentvoucher";
			if(!file_exists($storagepath)) {
				if(!mkdir($storagepath,0777)){
					return false;
				}
			}
			$storagepath = $storagepath."/".$yearmonth;
			if(!file_exists($storagepath)) {
				if(!mkdir($storagepath,0777)){
					return false;
				}
			}
		} else if(in_array($typ,array("BD"))){
			$storagepath = $storagepath."/bankdoc";
			if(!file_exists($storagepath)) {
				if(!mkdir($storagepath,0777)){
					return false;
				}
			}
			$storagepath = $storagepath."/".$banknam;
			if(!file_exists($storagepath)) {
				if(!mkdir($storagepath,0777)){
					return false;
				}
			}
			$storagepath = $storagepath."/".$yearmonth;
			if(!file_exists($storagepath)) {
				if(!mkdir($storagepath,0777)){
					return false;
				}
			}
		} else if(in_array($typ,array("LF"))){
			$storagepath = $storagepath."/staffinfo";
			if(!file_exists($storagepath)) {
				if(!mkdir($storagepath,0777)){
					return false;
				}
			}
			$storagepath = $storagepath."/leaveform";
			if(!file_exists($storagepath)) {
				if(!mkdir($storagepath,0777)){
					return false;
				}
			}
			$storagepath = $storagepath."/".$banknam;
			if(!file_exists($storagepath)) {
				if(!mkdir($storagepath,0777)){
					return false;
				}
			}
			return true;
		}
		$storagepath1 = $storagepath1."/customer";
		if(!file_exists($storagepath1)) {
			if(!mkdir($storagepath1,0777)){
				return false;
			}
		}
		if($foldernam!=""){
			$storagepath1 = $storagepath1."/".strtoupper(substr($foldernam,0,1));
			if(!file_exists($storagepath1)) {
				if(!mkdir($storagepath1,0777)){
					return false;
				}
			}
			$storagepath1 = $storagepath1."/".strtoupper($foldernam);
			if(!file_exists($storagepath1)) {
				if(!mkdir($storagepath1,0777)){
					return false;
				}
			}
		}
		return true;
	}

	function savefile($typ,$invid,$bskip=false,$bcancel=false,$dodir="",$pvfile="",$pvfilename="") {
		//$storagepath = storage_path("app/acct");
		//$storagepath1 = storage_path("app/acct");
		$storagepath = Storage::disk('app')->path('acct');
		$storagepath1 = Storage::disk('app')->path('acct');
		//Log::useDailyFiles(storage_path('logs/FileDocManage.log'));
		if($typ=="SI"){
			$salesinvoice = SalesInvoice::find($invid);
			$canceldate = Carbon::parse($salesinvoice->cancelled_at)->format('d/m/Y');
			$salesinvoicedate = Carbon::parse($salesinvoice->salesinvoicedate);
			$salesinvoice->salesinvoicedate =  $salesinvoicedate->format('d/m/Y');
			$year = substr($salesinvoice->salesinvoicedate,6,4);
			$yearmonth = substr($salesinvoice->salesinvoicedate,6,4).substr($salesinvoice->salesinvoicedate,3,2);
			$customer = Customer::find($salesinvoice->customerid);
			if(!$this->getreadypath($typ,$storagepath,$storagepath1,$year,$yearmonth,$customer->foldername)){
				return false;
			}
			if($bskip){
				$invpdffile=$storagepath."/".$salesinvoice->salesinvoicecode.".pdf";
				if(file_exists($invpdffile)){
					return true;
				}
			}

			$tempinvpdffile=$storagepath."/inv_".$salesinvoice->salesinvoicecode.".pdf";
			$tempdopdffile=$storagepath."/do_".$salesinvoice->salesinvoicecode.".pdf";
			$tempdopdffiletemp=$storagepath."/do_".$salesinvoice->salesinvoicecode."_temp.pdf";
			if(file_exists($tempinvpdffile)){
				@unlink($tempinvpdffile);
			}
			if(file_exists($tempdopdffile)){
				@unlink($tempdopdffile);
			}
			$f = new \NumberFormatter("en", \NumberFormatter::SPELLOUT);
			$salesinvoice->totalnetsales =  strtoupper($f->format($salesinvoice->nettotalamount))." ONLY";
			$arr_mergefile = array();
			$bcancelsales=($salesinvoice->cancelled_at)?"Y":"N";
			$companysetting = CompanySetting::where("id",$salesinvoice->companyid)->get()->first();
			view()->share('data',$salesinvoice);
			view()->share('bcancelsales',$bcancelsales);
			view()->share('canceldate',$canceldate);
			view()->share('company',$companysetting);
			// Sales Invoice and DO
			PDF::setOptions(['dpi' => 150, 'defaultFont' => 'sans-serif']);
			// pass view file
			$pdf = PDF::loadView('salesinvoice.lhinvoicepdf');
			$pdf->getDomPDF()->set_option("enable_php", true);
			$pdf->save($tempinvpdffile);
			array_push($arr_mergefile,$tempinvpdffile);
			if($dodir!="" && (is_file($dodir.$salesinvoice->salesinvoicecode.".pdf") || is_file($dodir.str_replace("-","",$salesinvoice->salesinvoicecode).".pdf") ) ){
				$pdfdo= PDF::loadView('salesinvoice.lhdopdf');
				$pdfdo->getDomPDF()->set_option("enable_php", true);
				$pdfdo->save($tempdopdffiletemp);
				$pdfdoMerger = PDFMerger::init(); //Initialize the merger
				$pdfdoMerger->addPDF($tempdopdffiletemp, 'all');
				if(is_file($dodir.$salesinvoice->salesinvoicecode.".pdf")){
					$inv_file = $salesinvoice->salesinvoicecode;
				} else {
					$inv_file = str_replace("-","",$salesinvoice->salesinvoicecode);
				}
				$pdfdoMerger->addPDF($dodir.$inv_file.".pdf", 'all');
				$pdfdoMerger->merge();
				$pdfdoMerger->save($tempdopdffile);
				/*sleep(1);
				$bcpied = false;
				if (!copy($dodir.$inv_file.".pdf", $tempdopdffile)) {
					for($ilp=0;$ilp<10;$ilp++){
						if(copy($dodir.$inv_file.".pdf",$tempdopdffile)){
							$bcpied = true;
							break;
						}
					}
				} else {
					$bcpied = true;
				}
				sleep(1);*/
				@rename($dodir.$inv_file.".pdf",$dodir."previous/".$inv_file.".pdf");
			} else {
				$pdfdo= PDF::loadView('salesinvoice.lhdopdf');
				$pdfdo->getDomPDF()->set_option("enable_php", true);
				$pdfdo->save($tempdopdffiletemp);
				$pdfdoMerger = PDFMerger::init(); //Initialize the merger
				$pdfdoMerger->addPDF($tempdopdffiletemp, 'all');
				$uploaddofolder = Storage::disk('uploaddo')->path('');
				$salesinvoicecode=str_replace("-","",$salesinvoice->salesinvoicecode);
				if(is_file($uploaddofolder."previous/".$salesinvoice->salesinvoicecode.".pdf")){
					$pdfdoMerger->addPDF($uploaddofolder."previous/".$salesinvoice->salesinvoicecode.".pdf", 'all');
					//@copy($uploaddofolder."previous/".$salesinvoice->salesinvoicecode.".pdf", $tempdopdffile);
				} else if(is_file($uploaddofolder."previous/".$salesinvoicecode.".pdf")){
					$pdfdoMerger->addPDF($uploaddofolder."previous/".$salesinvoicecode.".pdf", 'all');
					//@copy($uploaddofolder."previous/".$salesinvoicecode.".pdf", $tempdopdffile);
				}
				$pdfdoMerger->merge();
				$pdfdoMerger->save($tempdopdffile);
			}
			array_push($arr_mergefile,$tempdopdffile);
			// Credit Note
			$salescredit = Armatch::where("artype","CN")->where("payfortype","INV")->where("payforid",$invid)->get();
			foreach($salescredit as $rsalescredit){
				$creditnote = CreditNote::find($rsalescredit->artranid);
				if($creditnote){
					$tempcnpdffile=$storagepath."/cn_".$salesinvoice->salesinvoicecode."_".$rsalescredit->artranid.".pdf";
					if(file_exists($tempcnpdffile)){
						@unlink($tempcnpdffile);
					}
					$f = new \NumberFormatter("en", \NumberFormatter::SPELLOUT);
					$creditnote->totalnetcnword =  strtoupper($f->format($creditnote->nettotalamount))." ONLY";
					$cndate = Carbon::parse($creditnote['cndate']);
					$creditnote->cndate =  $cndate->format('d/m/Y');
					view()->share('data',$creditnote);
					view()->share('bcancelsales',$bcancelsales);
					view()->share('canceldate',$canceldate);
					view()->share('companysetting',$companysetting);
					//return view('receivepayment.orpdf');
					PDF::setOptions(['dpi' => 150, 'defaultFont' => 'sans-serif']);
					// pass view file
					$pdfcn = PDF::loadView('creditnote.lhcnpdf');
					$pdfcn->getDomPDF()->set_option("enable_php", true);
					$pdfcn->save($tempcnpdffile);
					array_push($arr_mergefile,$tempcnpdffile);
				}
			}
			// Receipt Payment
			$salesor = Armatch::where("artype","OR")->where("payfortype","INV")->where("payforid",$invid)->get();
			foreach($salesor as $rsalesor){
				$receipt = Receipt::find($rsalesor->artranid);
				if($receipt){
					$temporpdffile=$storagepath."/or_".$salesinvoice->salesinvoicecode."_".$rsalesor->artranid.".pdf";
					if(file_exists($temporpdffile)){
						@unlink($temporpdffile);
					}
					$f = new \NumberFormatter("en", \NumberFormatter::SPELLOUT);
					$receipt->totalnetpaymentword =  strtoupper($f->format($receipt->nettotalamount))." ONLY";
					$receiptdate = Carbon::parse($receipt->receiptdate);
					$receipt->receiptdate =  $receiptdate->format('d/m/Y');
					view()->share('data',$receipt);
					view()->share('bcancelsales',$bcancelsales);
					view()->share('canceldate',$canceldate);
					PDF::setOptions(['dpi' => 150, 'defaultFont' => 'sans-serif']);
					// pass view file
					$pdfor = PDF::loadView('receivepayment.lhorpdf');
					$pdfor->getDomPDF()->set_option("enable_php", true);
					$pdfor->save($temporpdffile);
					array_push($arr_mergefile,$temporpdffile);
				}
			}
			// Service Form
			@copy(public_path().'/pdf/mf_'.$salesinvoice->salesinvoicecode.'.pdf',public_path().'/pdf/mf/mf_'.$salesinvoice->salesinvoicecode.'.pdf');
			$servicepdf=public_path().'/pdf/mf/mf_'.$salesinvoice->salesinvoicecode.'.pdf';
			if(file_exists($servicepdf)){
				array_push($arr_mergefile,$servicepdf);
			}
			$invpdffile=$storagepath."/".$salesinvoice->salesinvoicecode.".pdf";
			if(file_exists($invpdffile)){
				@unlink($invpdffile);
			}
			$pdfMerger = PDFMerger::init(); //Initialize the merger
			foreach($arr_mergefile as $rmergefile){
				if(is_file($rmergefile)){
					$pdfMerger->addPDF($rmergefile, 'all');
				} else {
					Log::info(date("d/m/Y H:i:s")." - Invoice file : ".$invpdffile.", missing file : ".$rmergefile);
				}
			}
			$pdfMerger->merge();
			$pdfMerger->save($invpdffile);
			if($customer->foldername!=""){
				$cuspdffile=$storagepath1."/".$salesinvoice->salesinvoicecode.".pdf";
				//echo $cuspdffile; exit;
				if(file_exists($cuspdffile)){
					@unlink($cuspdffile);
				}
				$pdfMerger->save($cuspdffile);
			}
			foreach($arr_mergefile as $rmergefile){
				@unlink($rmergefile);
			}
			return array("invfile"=>$invpdffile);
		} else if($typ=="CN"){
			// Credit Note
			$creditnote = CreditNote::find($invid);
			$cndate = Carbon::parse($creditnote->cndate);
			$creditnote->cndate =  $cndate->format('d/m/Y');
			$companysetting = CompanySetting::where("id",$creditnote->companyid)->get()->first();
			$year = substr($creditnote->cndate,6,4);
			$yearmonth = substr($creditnote->cndate,6,4).substr($creditnote->cndate,3,2);
			$customer = Customer::find($creditnote->customerid);
			if(!$this->getreadypath($typ,$storagepath,$storagepath1,$year,$yearmonth,$customer->foldername)){
				return false;
			}
			if($bskip){
				$cncode=str_replace("/","-",$creditnote->cncode);
				$cnpdffile=$storagepath."/".$cncode."_".$siv.".pdf";
				if(file_exists($cnpdffile)){
					return true;
				}
			}
			$salescn = Armatch::where("artype","CN")->where("payfortype","INV")->where("artranid",$invid)->get();
			$siv="";
			if($salescn) foreach($salescn as $rsalescn){
				$siv.=(($siv!="")?",":"").$rsalescn->payforcode;
			}
			if($creditnote){
				$cncode=str_replace("/","-",$creditnote->cncode);
				$tempcnpdffile=$storagepath."/".$cncode."_".$siv.".pdf";
				$tempcnpdffile1=$storagepath1."/".$cncode."_".$siv.".pdf";
				if(file_exists($tempcnpdffile)){
					@unlink($tempcnpdffile);
				}
				if(file_exists($tempcnpdffile1)){
					@unlink($tempcnpdffile1);
				}
				$f = new \NumberFormatter("en", \NumberFormatter::SPELLOUT);
				$creditnote->totalnetcnword =  strtoupper($f->format($creditnote->nettotalamount))." ONLY";
				view()->share('data',$creditnote);
				view()->share('companysetting',$companysetting);
				//return view('receivepayment.orpdf');
				PDF::setOptions(['dpi' => 150, 'defaultFont' => 'sans-serif']);
				// pass view file
				$pdfcn = PDF::loadView('creditnote.lhcnpdf');
				$pdfcn->getDomPDF()->set_option("enable_php", true);
				$pdfcn->save($tempcnpdffile);
				if($customer->foldername!=""){
					$pdfcn1 = PDF::loadView('creditnote.lhcnpdf');
					$pdfcn1->getDomPDF()->set_option("enable_php", true);
					$pdfcn1->save($tempcnpdffile1);
				}
			}
		} else if($typ=="PV"){
			// Payment Voucher
			$paymentvoucher = PaymentVoucher::find($invid);
			$canceldate = Carbon::parse($paymentvoucher->cancelled_at)->format('d/m/Y');
			$companysetting = CompanySetting::where("id",$paymentvoucher->companyid)->get()->first();
			$pvdate = Carbon::parse($paymentvoucher->paymentdate);
			$paymentvoucher->paymentdate =  $pvdate->format('d/m/Y');
			$year = substr($paymentvoucher->paymentdate,6,4);
			$yearmonth = substr($paymentvoucher->paymentdate,6,4).substr($paymentvoucher->paymentdate,3,2);
			if(!$this->getreadypath($typ,$storagepath,$storagepath1,$year,$yearmonth,"")){
				return false;
			}
			if($bskip){
				$paymentcode=str_replace("/","-",$paymentvoucher->paymentcode);
				$pvpdffile=$storagepath."/".$paymentcode.".pdf";
				if(file_exists($pvpdffile)){
					return true;
				}
			}
			if($paymentvoucher){
				$paymentcode=str_replace("/","-",$paymentvoucher->paymentcode);
				if(substr($companysetting->companycode,0,2)==substr($paymentcode,0,2)){
					$temppvpdffile=$storagepath."/".$paymentcode.".pdf";
				} else {
					$temppvpdffile=$storagepath."/".$companysetting->companycode.$paymentcode.".pdf";
				}
				//echo $temppvpdffile;  exit;
				if(file_exists($temppvpdffile)){
					@unlink($temppvpdffile);
				}
				$temppvpdffile1=$storagepath."/".$paymentcode."_temp.pdf";
				if(file_exists($temppvpdffile1)){
					@unlink($temppvpdffile1);
				}
				$f = new \NumberFormatter("en", \NumberFormatter::SPELLOUT);
				$wordnumber = strtoupper($f->format($paymentvoucher->amount));
				$arwordnum = explode(".",$paymentvoucher->amount);
				if($arwordnum[1]>0){
					$wordnumber = strtoupper($f->format($arwordnum[0]));
					$wordnumber .= " AND ";
					$wordnumber .= strtoupper($f->format($arwordnum[1]));
					$wordnumber.=" CENTS ONLY";
				} else {
					$wordnumber.=" ONLY";
				}
				$paymentvoucher->totalamountword =  $wordnumber;
				$paymentvoucher->referencedate = ($paymentvoucher->referencedate)?Carbon::createFromFormat('Y-m-d', $paymentvoucher->referencedate)->format('d/m/Y'):$paymentvoucher->referencedate;//parse($paymentvoucher->referencedate);
				//var_dump($paymentvoucher); exit;
				view()->share('data',$paymentvoucher);
				$bcancelpayment=($paymentvoucher->cancelled_at)?"Y":"N";
				view()->share('bcancelpayment',$bcancelpayment);
				view()->share('canceldate',$canceldate);
				//return view('receivepayment.orpdf');
				PDF::setOptions(['dpi' => 150, 'defaultFont' => 'sans-serif']);
				// pass view file
				$pdf = PDF::loadView('paymentvoucher.lhpvpdf');
				// pass view file
				$pdf->getDomPDF()->set_option("enable_php", true);
				$pdf->save($temppvpdffile1);
				sleep(1);
				if($dodir!=""){
					$arr_supinv=json_decode($paymentvoucher->sup_inv_no,true);
					if(!is_dir($dodir."prcs")){
						mkdir($dodir."prcs",0777);
					}
					$afn = explode("/",$pvfile);
					$tfn = $afn[(count($afn)-1)];
					if(is_file($pvfile) && is_file($temppvpdffile1)) {

						@copy($pvfile,$dodir."prcs/".$tfn);
						$pdfMerger = PDFMerger::init(); //Initialize the merger
						$pdfMerger->addPDF($temppvpdffile1, 'all');
						if(file_exists($dodir."previous/".$tfn)) {
							$pdfMerger->addPDF($dodir."previous/".$tfn, 'all');
						}
						$pdfMerger->addPDF($pvfile, 'all');
						$pdfMerger->merge();
						$pdfMerger->save($temppvpdffile);
						$ilpr=0;
						while(!file_exists($temppvpdffile)) {
							sleep(1);
							if($ilpr<10) {
								Log::info(date("d/m/Y H:i:s")." - Not able to save payment voucher file : ".$temppvpdffile." - ".$ilpr);
								$pdfMerger->save($temppvpdffile);
							} else {
								Log::info(date("d/m/Y H:i:s")." - Not able to save payment voucher file : ".$temppvpdffile);
							}
							$ilpr++;
						}
						if(is_file($pvfile)) {
							if(file_exists($dodir."previous/".$tfn)) {
								$pvpdffile1=$dodir."previous/temp_".$tfn;
								$pdfMerger1 = PDFMerger::init(); //Initialize the merger
								$pdfMerger1->addPDF($dodir."previous/".$tfn, 'all');
								$pdfMerger1->addPDF($pvfile, 'all');
								$pdfMerger1->merge();
								$pdfMerger1->save($pvpdffile1);
								@rename($pvpdffile1,$dodir."previous/".$tfn);
								@unlink($pvfile);
							} else {
								@rename($pvfile,$dodir."previous/".$tfn);
							}
						}
					} else if(file_exists($dodir."previous/".$tfn)) {
						$pdfMerger = PDFMerger::init(); //Initialize the merger
						$pdfMerger->addPDF($temppvpdffile1, 'all');
						$pdfMerger->addPDF($dodir."previous/".$tfn, 'all');
						$pdfMerger->merge();
						$pdfMerger->save($temppvpdffile);
					} elseif($arr_supinv && !empty($arr_supinv) && $arr_supinv[0]!="") {
						$bchkfileexist=false;
						foreach($arr_supinv as $r_supinv){
							if(is_file($pvfile)) {
								$bchkfileexist=true;
							}
						}
						if($bchkfileexist && is_file($temppvpdffile1)) {
							$pdfMerger = PDFMerger::init(); //Initialize the merger
							$pdfMerger->addPDF($temppvpdffile1, 'all');
							foreach($arr_supinv as $r_supinv){
								if(is_file($pvfile)) {
									$pdfMerger->addPDF($pvfile, 'all');
								}
							}
							$pdfMerger->merge();
							$pdfMerger->save($temppvpdffile);
							foreach($arr_supinv as $r_supinv){
								if(is_file($pvfile)) {
									@rename($pvfile,$dodir."previous/".$pvfilename.".pdf");
								}
							}
						} else {
							@rename($temppvpdffile1,$temppvpdffile);
						}
					} else {
						@rename($temppvpdffile1,$temppvpdffile);
					}
				} else {
					@rename($temppvpdffile1,$temppvpdffile);
				}
				if(file_exists($temppvpdffile1)){
					@unlink($temppvpdffile1);
				}
			}
		} else if($typ=="BD"){
			$bankdoc = Bankdoc::find($invid);
			$companysetting = CompanySetting::where("id",$bankdoc->companyid)->get()->first();
			$bank = Bank::find($bankdoc->bankid);
			$arr_receiptdetail = json_decode($bankdoc->receiptdetails);
			$bankdoc_dat = Carbon::parse($bankdoc->bankdoc_dat);
			$bankdoc->bankdoc_dat =  $bankdoc_dat->format('d/m/Y');
			$year = substr($bankdoc->bankdoc_dat,6,4);
			$yearmonth = substr($bankdoc->bankdoc_dat,6,4).substr($bankdoc->bankdoc_dat,3,2);
			if(!$this->getreadypath($typ,$storagepath,$storagepath1,$year,$yearmonth,"",$bank->bankcode)){
				return false;
			}
			$arr_rcpt = array();
			if($arr_receiptdetail) foreach($arr_receiptdetail as $row_receiptdetail) {
				if($bankdoc->companyid==11){
					$rcpt = Tasalesreceipt::selectRaw("customername as 'customername', salesinvoicecode as 'salesinvoicecode', salesinvoicedate as 'salesinvoicedate', nettotalamount as 'amount'")->where("id",$row_receiptdetail->receiptid)->get();
				} else {
					$rcpt = Receipt::getrecppaylist($row_receiptdetail->receiptid)->selectRaw("receipts.customername as 'customername', salesinvoices.salesinvoicecode as 'salesinvoicecode', salesinvoices.salesinvoicedate as 'salesinvoicedate', armatches.amount as 'amount'")->get();
				}
				$row_rcpt["remark"]=$row_receiptdetail->remark;
				$row_rcpt["totalamount"]=$row_receiptdetail->amount;
				$row_rcpt["inv_no"]=array();
				$row_rcpt["inv_dat"]=array();
				$row_rcpt["amount"]=array();
				$row_rcpt["companyname"]="";
				if($rcpt) foreach($rcpt as $rrcpt) {
					$row_rcpt["companyname"]=$rrcpt->customername;
					array_push($row_rcpt["inv_no"],$rrcpt->salesinvoicecode);
					array_push($row_rcpt["inv_dat"],$rrcpt->salesinvoicedate);
					array_push($row_rcpt["amount"],$rrcpt->amount);
				}
				array_push($arr_rcpt,$row_rcpt);
			}
			view()->share('data',$bankdoc);

			view()->share('arr_rcpt',$arr_rcpt);
			$pdfbankdoc= PDF::loadView('bankdoc.bankdocpdf');
			$pdfbankdoc->getDomPDF()->set_option("enable_php", true);
			$filename=str_replace("/", "-", $bankdoc->bankdoc);
			$bankdocpdffile=$storagepath."/".$companysetting->companycode.$filename.".pdf";
			if(file_exists($bankdocpdffile)){
				@unlink($bankdocpdffile);
			}
			$bankdocpdffile1=$storagepath."/".$companysetting->companycode.$filename."_temp.pdf";
			if(file_exists($bankdocpdffile1)){
				@unlink($bankdocpdffile1);
			}
			$pdfbankdoc->save($bankdocpdffile1);
			sleep(1);
			if($dodir!=""){
				if(!is_dir($dodir."prcs")){
					mkdir($dodir."prcs",0777);
				}
				if(!is_dir($dodir."previous")){
					mkdir($dodir."previous",0777);
				}
				$afn = explode("/",$pvfile);
				$tfn = $afn[(count($afn)-1)];
				if(is_file($pvfile) && is_file($bankdocpdffile1)) {

					@copy($pvfile,$dodir."prcs/".$tfn);
					$pdfMerger = PDFMerger::init(); //Initialize the merger
					$pdfMerger->addPDF($bankdocpdffile1, 'all');
					if(file_exists($dodir."previous/".$tfn)) {
						$pdfMerger->addPDF($dodir."previous/".$tfn, 'all');
					}
					$pdfMerger->addPDF($pvfile, 'all');
					$pdfMerger->merge();
					$pdfMerger->save($bankdocpdffile);
					$ilpr=0;
					while(!file_exists($bankdocpdffile)) {
						sleep(1);
						if($ilpr<10) {
							Log::info(date("d/m/Y H:i:s")." - Not able to save payment voucher file : ".$bankdocpdffile." - ".$ilpr);
							$pdfMerger->save($bankdocpdffile);
						} else {
							Log::info(date("d/m/Y H:i:s")." - Not able to save payment voucher file : ".$bankdocpdffile);
						}
						$ilpr++;
					}
					if(is_file($pvfile)) {
						if(file_exists($dodir."previous/".$tfn)) {
							$pvpdffile1=$dodir."previous/temp_".$tfn;
							$pdfMerger1 = PDFMerger::init(); //Initialize the merger
							$pdfMerger1->addPDF($dodir."previous/".$tfn, 'all');
							$pdfMerger1->addPDF($pvfile, 'all');
							$pdfMerger1->merge();
							$pdfMerger1->save($pvpdffile1);
							@rename($pvpdffile1,$dodir."previous/".$tfn);
							@unlink($pvfile);
						} else {
							@rename($pvfile,$dodir."previous/".$tfn);
						}
					}
				} else if(file_exists($dodir."previous/".$tfn)) {
					$pdfMerger = PDFMerger::init(); //Initialize the merger
					$pdfMerger->addPDF($bankdocpdffile1, 'all');
					$pdfMerger->addPDF($dodir."previous/".$tfn, 'all');
					$pdfMerger->merge();
					$pdfMerger->save($bankdocpdffile);
				} else {
					@rename($bankdocpdffile1,$bankdocpdffile);
				}
			} else {
				@rename($bankdocpdffile1,$bankdocpdffile);
			}
			if(file_exists($bankdocpdffile1)){
				@unlink($bankdocpdffile1);
			}
		} else if($typ=="LF") {
			$leaveform = LeaveForm::find($invid);
			$staff = Staff::find($leaveform->staffid);
			$companysetting = CompanySetting::find($staff->comp_id);
			$year = substr($leaveform->leave_dat_frm,6,4);
			$yearmonth = substr($leaveform->leave_dat_frm,6,4).substr($leaveform->leave_dat_frm,3,2);
			if(!$this->getreadypath($typ,$storagepath,$storagepath1,$year,$yearmonth,"",$leaveform->staff_name)){
				return false;
			}
			$filename = "LF".substr($leaveform->leave_dat_frm,6,4).substr($leaveform->leave_dat_frm,3,2).substr($leaveform->leave_dat_frm,0,2);
			$leaveformpdffile=$storagepath."/".$companysetting->companycode.$filename.".pdf";
			@copy($pvfilename,$leaveformpdffile);
		}
	}

	function getservice_file($foldername,$servicestart,$service_month,$servicecode){
		$storagepath = Storage::disk('serviceform')->path('');//storage_path("app/serviceform");

		$storagepath = $storagepath."/".substr($foldername,0,1)."/".$foldername;

		$arr_return=array();
		$iyear=substr($servicestart,6,4);
		$imonth=substr($servicestart,3,2);
		for($ilm=$imonth;$ilm<($imonth+$service_month);$ilm++){
			$checkmonth = date("mY",mktime(0,0,0,$ilm,1,$iyear));
			$servicedir = $storagepath."/YR'".substr($checkmonth,2,4)."/".$checkmonth."/";
			if(is_dir($servicedir)) {
				$arr_file = scandir($servicedir);
				foreach($arr_file as $row_file){
					if($row_file!="." && $row_file!=".."){
						if(is_file($servicedir.$row_file) && strtolower(substr($row_file,-3))=="pdf" ){
							$rawservdat=substr($row_file,0,(strlen($row_file)-4));
							$dispservdate = substr($rawservdat,0,2)."/".substr($rawservdat,2,2)."/".substr($rawservdat,4,4);
							if($servicecode=="CCTV" && strtolower(substr($row_file,-5,1))=="c"){
								array_push($arr_return,$dispservdate);
							} elseif($servicecode!="CCTV" && strtolower(substr($row_file,-5,1))!="c"){
								array_push($arr_return,$dispservdate);
							}
						}
					}
				}
			}
			$loandir = $storagepath."/ONLOAN/";
			if(is_dir($loandir)) {
				$arr_file = scandir($loandir);
				foreach($arr_file as $row_file){
					if($row_file!="." && $row_file!=".."){
						if(is_dir($loandir.$row_file)){
							if(substr($row_file,2)==$checkmonth){
								$rawservdat=$row_file;
								$dispservdate = substr($rawservdat,0,2)."/".substr($rawservdat,2,2)."/".substr($rawservdat,4,4);
								if($servicecode=="CCTV" && strtolower(substr($row_file,-5,1))=="c"){
									array_push($arr_return,$dispservdate);
								} elseif($servicecode!="CCTV" && strtolower(substr($row_file,-5,1))!="c"){
									array_push($arr_return,$dispservdate);
								}
							}
						}
					}
				}
			}
		}
		return $arr_return;
	}

	function saveservice_file($foldername,$servicestart,$service_month,$invid,$servicecode){
		$storagepath = Storage::disk('serviceform')->path('');//storage_path("app/serviceform");
		$storagepath = $storagepath."/".substr($foldername,0,1)."/".$foldername;
		$afile=array();
		$iyear=substr($servicestart,6,4);
		$imonth=substr($servicestart,3,2);
		for($ilm=$imonth;$ilm<($imonth+$service_month);$ilm++){
			$checkmonth = date("mY",mktime(0,0,0,$ilm,1,$iyear));
			$servicedir = $storagepath."/YR'".substr($checkmonth,2,4)."/".$checkmonth."/";
			if(is_dir($servicedir)) {
				$arr_file = scandir($servicedir);
				foreach($arr_file as $row_file){
					if($row_file!="." && $row_file!=".."){
						if(is_file($servicedir.$row_file) && strtolower(substr($row_file,-3))=="pdf" ){
							if($servicecode=="CCTV" && strtolower(substr($row_file,-5,1))=="c"){
								array_push($afile,$servicedir."/".$row_file);
							} elseif($servicecode!="CCTV" && strtolower(substr($row_file,-5,1))!="c"){
								array_push($afile,$servicedir."/".$row_file);
							}
						}
					}
				}
			}
			$loandir = $storagepath."/ONLOAN/";

				//echo $loandir;
			if(is_dir($loandir)) {
				//echo $loandir;
				$arr_file = scandir($loandir);
				//print_r($arr_file);
				foreach($arr_file as $row_file){
					if($row_file!="." && $row_file!=".."){
						if(is_dir($loandir.$row_file)){
							//echo "<li>".substr($row_file,2)."==".$checkmonth;
							if(substr($row_file,2)==$checkmonth){
								$arr_file2 = scandir($loandir.$row_file);
								foreach($arr_file2 as $row_file2){
									if($row_file2!="." && $row_file2!=".."){
										if($servicecode=="CCTV" && strtolower(substr($row_file2,-5,1))=="c"){
											array_push($afile,$loandir.$row_file."/".$row_file2);
										} elseif($servicecode!="CCTV" && strtolower(substr($row_file2,-5,1))!="c"){
											array_push($afile,$loandir.$row_file."/".$row_file2);
										}
									}
								}
							}
						}
					}
				}
			}
		}
		if(!empty($afile)){
			$pdfMerger = PDFMerger::init(); //Initialize the merger
			foreach($afile as $rfile){
				$pdfMerger->addPDF($rfile, 'all');
			}
			$pdfMerger->merge();

			//$mainfolder = storage_path("app/acct/acct".$iyear);
			//Storage::disk('local')->makeDirectory("acct/acct".$iyear."/customer/".substr($foldername,0,1)."/".$foldername."/MAINTENANCE");
			//$mainfolder = storage_path("app/acct/acct".$iyear."/customer/".substr($foldername,0,1)."/".$foldername."/MAINTENANCE");
			$mainfolder = Storage::disk('app')->path('acct/acct'.$iyear);
			if (! File::exists($mainfolder)) {
				File::makeDirectory($mainfolder);
			}
			$mainfolder.="/customer";
			if (! File::exists($mainfolder)) {
				File::makeDirectory($mainfolder);
			}
			$mainfolder.="/".substr($foldername,0,1);
			if (! File::exists($mainfolder)) {
				File::makeDirectory($mainfolder);
			}
			$mainfolder.="/".$foldername;
			if (! File::exists($mainfolder)) {
				File::makeDirectory($mainfolder);
			}
			$mainfolder.="/MAINTENANCE";
			if (! File::exists($mainfolder)) {
				File::makeDirectory($mainfolder);
			}
			$pdfMerger->save($mainfolder."/".$invid.".pdf");
			$pdfMerger->save(public_path().'/pdf/mf_'.$invid.'.pdf');
			return asset("/pdf/mf_".$invid.".pdf");
		} else {
			return false;
		}
		//return asset("../storage/app/acct/acct".$iyear."/customer/".substr($foldername,0,1)."/".$foldername."/MAINTENANCE/".$invid.".pdf");
	}
}
?>
