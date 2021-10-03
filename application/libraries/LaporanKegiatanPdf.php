<?php 
if(!defined('BASEPATH')) exit('No direct script access allowed');

use Fpdf\Fpdf;

class LaporanKegiatanPdf extends Fpdf
{

    var $widths;

    public function __construct(){
        parent::__construct();
    }

    function Header() {
      $this->SetMargins(10,10,10);
      $this->SetFont('Times','B',8);
      $this->Image('assets/img/logo-dki.png',25,12,10,10);
      $this->Cell(40,14,'',1,0,'C');
      $this->Cell(110,14,'LAPORAN KEGIATAN HARIAN',1,0,'C');
      $this->Cell(40,6,'INSTANSI UNIT PERALATAN','LTR',2,'C');
      $this->Cell(40,4,'DAN PERBEKALAN','LR',2,'C');
      $this->Cell(40,4,'BINA MARGA','LBR',1,'C');
      $this->Cell(190,2,'','LTR',1,'C');
    }

    function KopSurat($isian,$data) {
      $this->SetFont('Times','',8);
      $this->Cell(40,6,$isian,'L',0);
      $this->Cell(150,6,': '.$data,'R',1);
    }

    function SubHeader($subHeader){
      $this->SetFont('Times','B',8);
      $this->SetFillColor(255,255,0);
      $this->Cell(190,6,$subHeader,1,1,'C',TRUE);
    }

    function ItemTHead($colHeaders,$totalWidth){
      $width = $totalWidth/count($colHeaders);
      $counter = 0;
      $this->SetFont('Times','B',8);
      $this->SetFillColor(169,169,169);
      foreach($colHeaders as $colHeader){
        if($counter<(count($colHeaders)-1)){
          $this->Cell($width,6,$colHeader,'LTRB',0,"C",TRUE);
        } else {
          $this->Cell($width,6,$colHeader,'LTRB',1,"C",TRUE);
        }
        $counter++;
      }
    }

    function ItemKegiatanItems($data,$totalWidth){
      $width = $totalWidth/4;
      $this->SetFont('Times','',8);
      $this->widths = [$width,$width,$width,$width];
      $this->row($data,10);
    }

    function JenisTKItems($datas,$totalWidth){
      $width = $totalWidth/2;
      $this->SetFont('Times','',8);
      $this->widths = [$width,$width];
      if(count($datas)!=0){
        foreach($datas as $data){
          $this->row([$data->JobName,$data->Jumlah],10);
        }
      } else {
          $this->row(["-","-"],10);
      }
    }

    function JenisABItems($datas,$totalWidth){
      $width = $totalWidth/2;
      $this->SetFont('Times','',8);
      $this->widths = [$width,$width];
      if(count($datas)!=0){
        foreach($datas as $data){
          $this->row([$data->JenisAB,$data->Jumlah],10);
        }
      } else {
          $this->row(["-","-"],10);
      }
    }

    function JenisDTItems($datas,$totalWidth){
      $width = $totalWidth/2;
      $this->SetFont('Times','',8);
      $this->widths = [$width,$width];
      if(count($datas)!=0){
        foreach($datas as $data){
          $this->row([$data->JenisDT,$data->Jumlah],10);
        }
      } else {
      }
    }

    function DKItems($datas,$totalWidth){
      $width = $totalWidth/4;
      $leftMargin = 10;
      $padding=2;
      if(count($datas)!=0){
        for($i=0;$i<count($datas);$i++){
          $this->Image('./assets/upload/'.$datas[$i]->FileName,$leftMargin+($i*$width)+$padding,$this->GetY()+$padding,$width-2*$padding,$width-2*$padding);
        }
        $this->Cell($width,$width,'',1,0,'C');
        $this->Cell($width,$width,'',1,0,'C');
        $this->Cell($width,$width,'',1,0,'C');
        $this->Cell($width,$width,'',1,1,'C');
      } else {
        $this->Cell($width,$width,'',1,0,'C');
        $this->Cell($width,$width,'',1,0,'C');
        $this->Cell($width,$width,'',1,0,'C');
        $this->Cell($width,$width,'',1,1,'C');
      }
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
            $a=isset($this->aligns[$i]) ? $this->aligns[$i] : 'C';
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
}
