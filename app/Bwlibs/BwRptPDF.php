<?php
namespace App\Bwlibs;

use Elibyy\TCPDF\Facades\TCPDF;

class BwRptPDF extends TCPDF {
    //Page header
    public function Header() {

        // Set font
       // $this->SetFont('helvetica', 'B', 20);
        // Title
       // $this->Cell(0, 15, 'Something new ridsfsdfsdf dsf dsf sdf sdf sdfght here!!!', 0, false, 'C', 0, '', 0, false, 'M', 'M');
		// Set font
		$this->SetFont('helvetica', 'I', 8);
		$this->SetXY(10, 8);
		// Title
		$this->Cell(0, 25, "hello world", 0, false, 'L', 0, '', 0, false, 'M', 'M');
    }

    // Page footer
    public function Footer() {
        // Position at 15 mm from bottom
        $this->SetY(-15);
        // Set font
        $this->SetFont('helvetica', 'I', 8);
        // Page number
        $this->Cell(0, 10, 'Page '.$this->getAliasNumPage().'/'.$this->getAliasNbPages(), 0, false, 'C', 0, '', 0, false, 'T', 'M');
    }
}
?>
