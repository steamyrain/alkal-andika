<?php 
if(!defined('BASEPATH')) exit('No direct script access allowed');

use Fpdf\Fpdf;

class Pdf extends Fpdf
{
    private string $status;
    private string $pjlp;
    private string $dateSigned;

    public function __construct($status='',$pjlp='',$dateSigned=''){
        parent::__construct();
        $this->status = $status;
        $this->pjlp = $pjlp;
        $this->dateSigned = $dateSigned;
    }

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

    function Nama($data) {
        $this->SetFont('Times','',12);
        $this->Cell(40,10,'Nama',0);
        $this->Cell(10,10,': '.$data,0);
        $this->ln(5);
    }

    function Jabatan($data) {
        $this->SetFont('Times','',12);
        $this->Cell(40,10,'Jabatan',0);
        $this->Cell(10,10,': '.$data,0);
        $this->ln(5);
    }

    function Tanggal($awal,$akhir) {
        $this->SetFont('Times','',12);
        $this->Cell(40,10,'Tanggal',0);
        $this->Cell(10,10,': '.$awal.' s/d '.$akhir,0);
        $this->ln(5);
    }

    function TabelKinerja($header,$data,$width){
        $this->ln(15);
        $totalWidth = 0;

        foreach($width as $w){
            $totalWidth = $totalWidth + $w;
        }
        $this->SetLeftMargin((280-$totalWidth)/2);

        //foreach is faster
        $i=0;
        foreach($header as $col){
            $this->Cell($width[$i],7,$col,1,0,'C');
            $i++;
        }
        $this->ln();

        $i=0;
        foreach($data as $row){
            foreach($row as $col){
                if($i == 0){
                    $tanggal;
                    preg_match('/^[0-9]{4}-[0-9][0-9]-[0-9][0-9]/',$col,$tanggal);
                    $this->Cell($width[$i],7,$tanggal[0],1);
                    $i++;
                } else {
                    $this->Cell($width[$i],7,$col,1);
                    $i++;
                }
            }
            $i = 0;
            $this->ln();
        }
    }

    function Footer(){
        if ($this->status == 'signed'){
            $this->SetY(-25);
            $this->SetFont('Times','',12);
            $this->SetLeftMargin(220);
            $date;
            preg_match('/^[0-9]{4}-[0-9][0-9]-[0-9][0-9]/',$this->dateSigned,$date);
            $this->MultiCell(70,5,'Jakarta, '.$date[0],0,'C');
            $this->ln(5);
            $this->MultiCell(70,5,'Telah ditandatangani secara digital oleh '.$this->pjlp,1,'C');
        }
    }
}
