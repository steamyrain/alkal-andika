<?php 
if(!defined('BASEPATH')) exit('No direct script access allowed');

use Fpdf\Fpdf;

class STPdf extends Fpdf
{
    function Header() {
        $this->Image('assets/img/logo-dki.png',10,8,20);
        $this->SetFont('Times','B',13);
        $this->Cell(0,0,'PEMERINTAH PROVINSI DAERAH KHUSUS IBUKOTA JAKARTA',0,1,'C');
        $this->Cell(0,10,'DINAS BINA MARGA',0,1,'C');
        $this->Cell(0,0,'UNIT PERALATAN DAN PERBEKALAN BINA MARGA',0,1,'C');
        $this->SetFont('Times','',12);
        $this->Cell(0,10,'Jl. D.I. Panjaitan Kav.583 Cipinang Besar Selatan Jakarta Timur',0,1,'C');
        $this->Cell(0,0,'Telp dan Fax. (021) 8564509, email. alkaldbm@gmail.com',0,1,'C');
        $this->Cell(0,10,'Kode Pos 13410',0,1,'R');
        $this->Cell(0,0,'',0,1);
        $this->Cell(0,0,'',1,1,'C');
        $this->ln(5);
    }

    function Esign($signedDate,$jobTitle,$legalName,$nip) {
        $this->SetY(-90);
        $this->SetFont('Times','',12);
        $this->SetLeftMargin(130);
        $date;
        preg_match('/^[0-9]{4}-[0-9][0-9]-[0-9][0-9]/',$signedDate,$date);
        $this->MultiCell(70,5,'Jakarta, '.$date[0],0,'C');
        $this->MultiCell(70,5,$jobTitle,0,'C');
        $this->ln(30);
        $this->MultiCell(70,5,$legalName,0,'C');
        $this->MultiCell(70,5,'NIP. '.$nip,0,'C');
    }
}
