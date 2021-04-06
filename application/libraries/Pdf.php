<?php 
if(!defined('BASEPATH')) exit('No direct script access allowed');

use Fpdf\Fpdf;

class Pdf extends Fpdf
{
    private string $status;
    private string $pjlp;
    private string $dateSigned;
    private array $verificators; // to iterate over verificator 
    var $widths;
    var $aligns;

    public function __construct($status='',$pjlp='',$dateSigned='',$verificators=[]){
        parent::__construct();
        $this->status = $status;
        $this->pjlp = $pjlp;
        $this->dateSigned = $dateSigned;
        $this->verificators = $verificators;
    }

    function Header() {
        $this->SetMargins(10,10,10);
        $this->SetFont('Times','B',13);
        $this->Image('assets/img/logo-dki.png',10,8,20);
        $this->Cell(0,0,'',0,1,'C');
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

    function SetWidths($w){
        $this->width=$w;
    }

    function SetAligns($a){
        $this->aligns=$a;
    }

    function row($data,$leftMargin){
        $nb=0;
        for($i=0;$i<sizeof($data);$i++) 
            $nb=max($nb,$this->NbLines($this->widths[$i],$data[$i]));
        $h=5*$nb;
        //Issue a page break first if needed
        $this->CheckPageBreak($h,$leftMargin);
        //Draw the cells of the row
        for($i=0;$i<count($data);$i++)
        {
            $w=$this->widths[$i];
            $a=isset($this->aligns[$i]) ? $this->aligns[$i] : 'L';
            //Save the current position
            $x=$this->GetX();
            $y=$this->GetY();
            //Draw the border
            $this->Rect($x,$y,$w,$h);
            //Print the text
            $this->MultiCell($w,5,$data[$i],0,$a);
            //Put the position to the right of the cell
            $this->SetXY($x+$w,$y);
        }
        //Go to the next line
        $this->Ln($h);
    }

    function CheckPageBreak($h,$leftMargin){
    //If the height h would cause an overflow, add a new page immediately
    if($this->GetY()+$h>$this->PageBreakTrigger)
        $this->AddPage($this->CurOrientation);
        $this->SetLeftMargin($leftMargin);
    }

    function NbLines($w,$txt){
        //Computes the number of lines a MultiCell of width w will take
        $cw=&$this->CurrentFont['cw'];
        if($w==0)
            $w=$this->w-$this->rMargin-$this->x;
        $wmax=($w-2*$this->cMargin)*1000/$this->FontSize;
        $s=str_replace("\r",'',$txt);
        $nb=strlen($s);
        if($nb>0 and $s[$nb-1]=="\n")
            $nb--;
        $sep=-1;
        $i=0;
        $j=0;
        $l=0;
        $nl=1;
        while($i<$nb)
        {
            $c=$s[$i];
            if($c=="\n")
            {
                $i++;
                $sep=-1;
                $j=$i;
                $l=0;
                $nl++;
                continue;
            }
            if($c==' ')
                $sep=$i;
            $l+=$cw[$c];
            if($l>$wmax)
            {
                if($sep==-1)
                {
                    if($i==$j)
                        $i++;
                }
                else
                    $i=$sep+1;
                $sep=-1;
                $j=$i;
                $l=0;
                $nl++;
            }
            else
                $i++;
        }
        return $nl;
    }

    function TabelKinerja($header,$data,$width){
        $this->SetAutoPageBreak(true,50);
        $this->ln(15);
        $totalWidth = 0;

        foreach($width as $w){
            $totalWidth = $totalWidth + $w;
        }
        $this->widths = $width;
        $this->SetLeftMargin((280-$totalWidth)/2);

        $i=0;
        foreach($header as $col){
            $this->Cell($width[$i],7,$col,1,0,'C');
            $i++;
        }
        $this->ln();

        foreach($data as $d){
            $this->row([$d->job_date,$d->job_start,$d->job_end,$d->job,$d->job_desc],(280-$totalWidth)/2);
        }

        //foreach is faster
        /*
        $i=0;
        foreach($header as $col){
            $this->Cell($width[$i],7,$col,1,0,'C');
            $i++;
        }
        $this->ln();

        $i=0;

        foreach($data as $row){
            $this->SetLeftMargin((280-$totalWidth)/2);
            foreach($row as $col){
                if($i == 0){
                    $tanggal;
                    preg_match('/^[0-9]{4}-[0-9][0-9]-[0-9][0-9]/',$col,$tanggal);
                    $this->Cell($width[$i],7,$tanggal[0],1);
                    $i++;
                } else if($i < 5){
                    $this->Cell($width[$i],7,$col,1);
                    $i++;
                }
            }
            $i = 0;
            $this->ln();
        }
         */
    }

    function Footer(){
        /*
         * verificator max = 2 (3 total signer - 1 pjlp 2 asn)
         * if  len verificator == 0 format ?
         * else if len verificator == 1 format ?
         * else if len verificator == 2 format ?
        */
        if (sizeof($this->verificators) == 1){
            $this->SetY(-45);
            $this->SetFont('Times','',12);
            $this->SetLeftMargin(220);
            $this->MultiCell(70,5,'Jakarta, '.$this->dateSigned,0,'C');
            $this->MultiCell(70,5,$this->verificators[0]->vfcJobTitle,0,'C');
            $this->ln(5);
            $this->MultiCell(70,5,'Telah ditandatangani secara digital oleh '.$this->verificators[0]->vfcName,'LRT','C');
            $this->MultiCell(70,5,'NIP. '.$this->verificators[0]->vfcNIP,'LRB','C');
        } else if (sizeof($this->verificators) == 2){
            if($this->verificators[1]->vfcOOI > $this->verificators[0]->vfcOOI){
                $this->SetY(-45);
                $this->SetFont('Times','',12);
                $this->SetLeftMargin(110);
                $this->MultiCell(70,5,$this->verificators[1]->vfcJobTitle,0,'C');
                $this->ln(5);
                $this->MultiCell(70,5,'Telah ditandatangani secara digital oleh '.$this->verificators[1]->vfcName,'LRT','C');
                $this->MultiCell(70,5,'NIP. '.$this->verificators[1]->vfcNIP,'LRB','C');
                $this->SetY(-45);
                $this->SetFont('Times','',12);
                $this->SetLeftMargin(220);
                $this->MultiCell(70,5,'Jakarta, '.$this->dateSigned,0,'C');
                $this->MultiCell(70,5,$this->verificators[0]->vfcJobTitle,0,'C');
                $this->ln(5);
                $this->MultiCell(70,5,'Telah ditandatangani secara digital oleh '.$this->verificators[0]->vfcName,'LRT','C');
                $this->MultiCell(70,5,'NIP. '.$this->verificators[0]->vfcNIP,'LRB','C');
            } else {
                $this->SetY(-45);
                $this->SetFont('Times','',12);
                $this->SetLeftMargin(110);
                $this->MultiCell(70,5,$this->verificators[0]->vfcJobTitle,0,'C');
                $this->ln(5);
                $this->MultiCell(70,5,'Telah ditandatangani secara digital oleh '.$this->verificators[0]->vfcName,'LRT','C');
                $this->MultiCell(70,5,'NIP. '.$this->verificators[0]->vfcNIP,'LRB','C');
                $this->SetY(-45);
                $this->SetFont('Times','',12);
                $this->SetLeftMargin(220);
                $this->MultiCell(70,5,'Jakarta, '.$this->dateSigned,0,'C');
                $this->MultiCell(70,5,$this->verificators[1]->vfcJobTitle,0,'C');
                $this->ln(5);
                $this->MultiCell(70,5,'Telah ditandatangani secara digital oleh '.$this->verificators[1]->vfcName,'LRT','C');
                $this->MultiCell(70,5,'NIP. '.$this->verificators[1]->vfcNIP,'LRB','C');
            }

        } else if (sizeof($this->verificators) == 3){
            if(($this->verificators[2]->vfcOOI > $this->verificators[1]->vfcOOI) &&
                ($this->verificators[2]->vfcOOI > $this->verificators[0]->vfcOOI)) {

                $this->SetLeftMargin((280-270)/2);
                $this->SetY(-45);
                $this->SetFont('Times','',12);
                $this->MultiCell(70,5,$this->verificators[2]->vfcJobTitle,0,'C');
                $this->ln(5);
                $this->MultiCell(70,5,'Telah ditandatangani secara digital oleh '.$this->verificators[2]->vfcName,'LRT','C');
                $this->MultiCell(70,5,'NIP. '.$this->verificators[2]->vfcNIP,'LRB','C');

                if($this->verificators[1]->vfcOOI > $this->verificators[0]->vfcOOI){
                    $this->SetLeftMargin(((280-270)/2)+110);
                    $this->SetY(-45);
                    $this->SetFont('Times','',12);
                    $this->MultiCell(70,5,$this->verificators[1]->vfcJobTitle,0,'C');
                    $this->ln(5);
                    $this->MultiCell(70,5,'Telah ditandatangani secara digital oleh '.$this->verificators[1]->vfcName,'LRT','C');
                    $this->MultiCell(70,5,'NIP. '.$this->verificators[1]->vfcNIP,'LRB','C');

                    $this->SetLeftMargin(((280-270)/2)+215);
                    $this->SetY(-45);
                    $this->SetFont('Times','',12);
                    $this->MultiCell(70,5,'Jakarta, '.$this->dateSigned,0,'C');
                    $this->MultiCell(70,5,$this->verificators[0]->vfcJobTitle,0,'C');
                    $this->ln(5);
                    $this->MultiCell(70,5,'Telah ditandatangani secara digital oleh '.$this->verificators[0]->vfcName,'LRT','C');
                    $this->MultiCell(70,5,'NIP. '.$this->verificators[0]->vfcNIP,'LRB','C');
                } else {
                    $this->SetLeftMargin(((280-270)/2)+110);
                    $this->SetY(-45);
                    $this->SetFont('Times','',12);
                    $this->MultiCell(70,5,$this->verificators[0]->vfcJobTitle,0,'C');
                    $this->ln(5);
                    $this->MultiCell(70,5,'Telah ditandatangani secara digital oleh '.$this->verificators[0]->vfcName,'LRT','C');
                    $this->MultiCell(70,5,'NIP. '.$this->verificators[0]->vfcNIP,'LRB','C');

                    $this->SetLeftMargin(((280-270)/2)+215);
                    $this->SetY(-45);
                    $this->SetFont('Times','',12);
                    $this->MultiCell(70,5,'Jakarta, '.$this->dateSigned,0,'C');
                    $this->MultiCell(70,5,$this->verificators[1]->vfcJobTitle,0,'C');
                    $this->ln(5);
                    $this->MultiCell(70,5,'Telah ditandatangani secara digital oleh '.$this->verificators[1]->vfcName,'LRT','C');
                    $this->MultiCell(70,5,'NIP. '.$this->verificators[1]->vfcNIP,'LRB','C');
                }
            }
            if(($this->verificators[1]->vfcOOI > $this->verificators[2]->vfcOOI) &&
                ($this->verificators[1]->vfcOOI > $this->verificators[0]->vfcOOI)) {

                $this->SetLeftMargin((280-270)/2);
                $this->SetY(-45);
                $this->SetFont('Times','',12);
                $this->MultiCell(70,5,$this->verificators[1]->vfcJobTitle,0,'C');
                $this->ln(5);
                $this->MultiCell(70,5,'Telah ditandatangani secara digital oleh '.$this->verificators[1]->vfcName,'LRT','C');
                $this->MultiCell(70,5,'NIP. '.$this->verificators[1]->vfcNIP,'LRB','C');

                if($this->verificators[2]->vfcOOI > $this->verificators[0]->vfcOOI){
                    $this->SetLeftMargin(((280-270)/2)+110);
                    $this->SetY(-45);
                    $this->SetFont('Times','',12);
                    $this->MultiCell(70,5,$this->verificators[2]->vfcJobTitle,0,'C');
                    $this->ln(5);
                    $this->MultiCell(70,5,'Telah ditandatangani secara digital oleh '.$this->verificators[2]->vfcName,'LRT','C');
                    $this->MultiCell(70,5,'NIP. '.$this->verificators[2]->vfcNIP,'LRB','C');

                    $this->SetLeftMargin(((280-270)/2)+215);
                    $this->SetY(-45);
                    $this->SetFont('Times','',12);
                    $this->MultiCell(70,5,'Jakarta, '.$this->dateSigned,0,'C');
                    $this->MultiCell(70,5,$this->verificators[0]->vfcJobTitle,0,'C');
                    $this->ln(5);
                    $this->MultiCell(70,5,'Telah ditandatangani secara digital oleh '.$this->verificators[0]->vfcName,'LRT','C');
                    $this->MultiCell(70,5,'NIP. '.$this->verificators[0]->vfcNIP,'LRB','C');
                } else {
                    $this->SetLeftMargin(((280-270)/2)+110);
                    $this->SetY(-45);
                    $this->SetFont('Times','',12);
                    $this->MultiCell(70,5,$this->verificators[0]->vfcJobTitle,0,'C');
                    $this->ln(5);
                    $this->MultiCell(70,5,'Telah ditandatangani secara digital oleh '.$this->verificators[0]->vfcName,'LRT','C');
                    $this->MultiCell(70,5,'NIP. '.$this->verificators[0]->vfcNIP,'LRB','C');

                    $this->SetLeftMargin(((280-270)/2)+215);
                    $this->SetY(-45);
                    $this->SetFont('Times','',12);
                    $this->MultiCell(70,5,'Jakarta, '.$this->dateSigned,0,'C');
                    $this->MultiCell(70,5,$this->verificators[2]->vfcJobTitle,0,'C');
                    $this->ln(5);
                    $this->MultiCell(70,5,'Telah ditandatangani secara digital oleh '.$this->verificators[2]->vfcName,'LRT','C');
                    $this->MultiCell(70,5,'NIP. '.$this->verificators[2]->vfcNIP,'LRB','C');
                }
            }
            if(($this->verificators[0]->vfcOOI > $this->verificators[2]->vfcOOI) &&
                ($this->verificators[0]->vfcOOI > $this->verificators[1]->vfcOOI)) {

                $this->SetLeftMargin((280-270)/2);
                $this->SetY(-45);
                $this->SetFont('Times','',12);
                $this->MultiCell(70,5,$this->verificators[0]->vfcJobTitle,0,'C');
                $this->ln(5);
                $this->MultiCell(70,5,'Telah ditandatangani secara digital oleh '.$this->verificators[0]->vfcName,'LRT','C');
                $this->MultiCell(70,5,'NIP. '.$this->verificators[0]->vfcNIP,'LRB','C');

                if($this->verificators[1]->vfcOOI > $this->verificators[2]->vfcOOI){
                    $this->SetLeftMargin(((280-270)/2)+110);
                    $this->SetY(-45);
                    $this->SetFont('Times','',12);
                    $this->MultiCell(70,5,$this->verificators[1]->vfcJobTitle,0,'C');
                    $this->ln(5);
                    $this->MultiCell(70,5,'Telah ditandatangani secara digital oleh '.$this->verificators[1]->vfcName,'LRT','C');
                    $this->MultiCell(70,5,'NIP. '.$this->verificators[1]->vfcNIP,'LRB','C');

                    $this->SetLeftMargin(((280-270)/2)+215);
                    $this->SetY(-45);
                    $this->SetFont('Times','',12);
                    $this->MultiCell(70,5,'Jakarta, '.$this->dateSigned,0,'C');
                    $this->MultiCell(70,5,$this->verificators[2]->vfcJobTitle,0,'C');
                    $this->ln(5);
                    $this->MultiCell(70,5,'Telah ditandatangani secara digital oleh '.$this->verificators[2]->vfcName,'LRT','C');
                    $this->MultiCell(70,5,'NIP. '.$this->verificators[2]->vfcNIP,'LRB','C');
                } else {
                    $this->SetLeftMargin(((280-270)/2)+110);
                    $this->SetY(-45);
                    $this->SetFont('Times','',12);
                    $this->MultiCell(70,5,$this->verificators[2]->vfcJobTitle,0,'C');
                    $this->ln(5);
                    $this->MultiCell(70,5,'Telah ditandatangani secara digital oleh '.$this->verificators[2]->vfcName,'LRT','C');
                    $this->MultiCell(70,5,'NIP. '.$this->verificators[2]->vfcNIP,'LRB','C');

                    $this->SetLeftMargin(((280-270)/2)+215);
                    $this->SetY(-45);
                    $this->SetFont('Times','',12);
                    $this->MultiCell(70,5,'Jakarta, '.$this->dateSigned,0,'C');
                    $this->MultiCell(70,5,$this->verificators[1]->vfcJobTitle,0,'C');
                    $this->ln(5);
                    $this->MultiCell(70,5,'Telah ditandatangani secara digital oleh '.$this->verificators[1]->vfcName,'LRT','C');
                    $this->MultiCell(70,5,'NIP. '.$this->verificators[1]->vfcNIP,'LRB','C');
                }
            }
        }
    }
}
