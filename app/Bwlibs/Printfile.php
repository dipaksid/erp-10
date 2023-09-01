<?php
namespace App\Bwlibs;
use App\Models\Printlog;

class Printfile {
	/**
	 * print file to printer
	 *
	 * @param string /filelocation/invoice.pdf $file
	 * @param string A5, Letter, $papersize
	 * @param string 1,2,3,4 $tray
	 * @param int 1,2,3,4 ..... $copies
	 * @param boolean true, false $landscape default false
	 *
	 */
	public function printtoprinter($file,$papersize,$tray,$copies=1,$landscape=false, $printrange="") {
		$printlog = new Printlog();
		$printlog->printfile=$file;
		$printlog->module="printtoprinter";
		$printlog->startprint=date("Y-m-d H:i:s");
		$printlog->save();
		shell_exec("cupsenable lpr3");
		$landcmd = ($landscape)?" -o landscape":"";
        $cmd="lp -d lpr3 -o fit-to-page -o media=".$papersize.$landcmd." ".$printrange." -n ".$copies." -o InputSlot=".$tray."Tray ".$file;
		// -o page-ranges=6
		// -o page-ranges=1-4
		// -o page-ranges=1-4,7,9-12
		/*
		$pdfname = $file;//'/mnt/data/appfiles/APP/acct/acct2021/invoice/202103/BW-A05945.pdf'; // Put your PDF path
		$pages = $this->count_pdf_pages($pdfname);
		*/

		shell_exec($cmd);
		$printlog->printcmd=$cmd;
		$printlog->endprint=date("Y-m-d H:i:s");
		$printlog->save();
    }

	public function printtxtoprinter($file,$prt,$copies=1){
		$printlog = new Printlog();
		$printlog->printfile=$file;
		$printlog->module="printtxtoprinter";
		$printlog->startprint=date("Y-m-d H:i:s");
		$printlog->save();
		shell_exec("cupsenable lpr".$prt);
		$cmd="lp -d lpr".$prt." -o raw ".$file." -n ".$copies."";
		shell_exec($cmd);
		$printlog->printcmd=$cmd;
		$printlog->endprint=date("Y-m-d H:i:s");
		$printlog->save();
	}

	public function count_pdf_pages($pdfname) {
		$pdftext = file_get_contents($pdfname);
		$num = preg_match_all("/\/Page\W/", $pdftext, $dummy);
		return $num;
	}
}
?>
