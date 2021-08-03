<?php
/*
 * This file is part of the AlpaSoft package
 * 
 * (c) Ana Luz Cervantes <analuzcervantes.s@gmail.com>
 * 
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
*/
    require('../fpdf/fpdf.php');
     
	include '../include/data.inc.php';
	include '../include/conMysql.inc.php';
	include '../include/conDB.inc.php';
      
    date_default_timezone_set("America/Mazatlan");
    $fecha = date('j/F/Y');
    $hora = date('h:i:s A');
     
    class MiPDF extends FPDF{

     	public function Header(){
			$this -> Image("../img/p.png", .3, .3, 6, 2);
			$this -> SetFont('Helvetica', '', 'helvetica.php'); //Letra Arial, tam. 20
        	$this -> SetFont('Helvetica', 'B', 16); 
			$this -> SetAuthor('Alpa Bikini');
			$this -> SetMargins(1, 3);
			$this -> SetDisplayMode('fullwidth', 'continuous');
     	}

		function SetWidths($w){
			
			$this -> widths=$w;
		}

		function SetAligns($a) {
			
			$this -> aligns=$a;
		}

		function Row($data) {
			
			$nb=0;
			for($i=0;$i<count($data);$i++)
				$nb=max($nb,$this->NbLines($this->widths[$i],$data[$i]));
			$h=1*$nb;
			
			$this->CheckPageBreak($h);
		
			for($i=0;$i<count($data);$i++){
				$w=$this->widths[$i];
				$a=isset($this->aligns[$i]) ? $this->aligns[$i] : 'L';
				
				$x=$this->GetX();
				$y=$this->GetY();
				
				$this->Rect($x,$y,$w,$h);
				
				$this->MultiCell($w,0.7,$data[$i],0,$a);
				
				$this->SetXY($x+$w,$y);
			}
			
			$this->Ln($h);
		}

		function CheckPageBreak($h){
			
			if($this->GetY()+$h>$this->PageBreakTrigger)
				$this->AddPage($this->CurOrientation);
		}

		function NbLines($w,$txt) {
			
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
			while($i<$nb){
			$c=$s[$i];
				if($c=="\n") {
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
				if($l>$wmax){
					if($sep==-1) {
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
     
    $mipdf = new MiPDF('P','cm','A3');
    $mipdf -> addPage();
     
	if(!$conMysql){
		echo "<center><br><br><b>";
		 echo '<font color="white">IMPOSIBLE ESTABLECER LA CONEXION A MYSQL';
		echo "</b></center>";
		exit();
	} 
	if(!$conDB){
		echo "<center><br><br><b>";
		echo '<font color="white">IMPOSIBLE ABRIR LA BASE DE DATOS';
		echo "</b></center>";
	}
	else {
		$caja="SELECT* FROM articulos WHERE linea='ROPA'";
    	$comprobar=mysqli_query($conDB,$caja);

			$i=0;
    	  	while($dato=mysqli_fetch_array($comprobar)){
    			$registros[$i]['codigo']=$dato['codigo'];
    			$registros[$i]['descripcion']=$dato['descripcion'];
    			$registros[$i]['cantidad']=$dato['cantidad'];
    			$registros[$i]['linea']=$dato['linea'];
    			$registros[$i]['proveedor']=$dato['proveedor'];
    			$registros[$i]['proveedor2']=$dato['proveedor2'];
    			$registros[$i]['proveedor3']=$dato['proveedor3'];
    			$registros[$i]['costo']=$dato['costo'];
    			$registros[$i]['precio']=$dato['precio'];
    			$i=$i+1;
    		}

			$mipdf -> Cell(0, 3,'REPORTE DE ARTICULOS "ROPA"', 0, 0, "C");
    		//$mipdf -> Ln(3);
    		$mipdf -> Ln();
			$mipdf -> SetFont('Helvetica', 'B', 11);
			
			$mipdf -> SetWidths(Array(3,6,2,4,3,3,3,2,2));
    		$mipdf -> SetAligns(Array('C','C','C','C','C','C','C','C','C'));
			$mipdf -> Row(Array(
				utf8_decode("CÓDIGO"), 
				utf8_decode("DESCRIPCIÓN"),
				utf8_decode("CANT"),
				utf8_decode("LÍNEA"),
				utf8_decode("PROV 1"),
				utf8_decode("PROV 2"),
				utf8_decode("PROV 3"),
				utf8_decode("COSTO"),
				utf8_decode("PRECIO"),
			));

			$mipdf -> SetFont('Helvetica', '', 10);
			for($j=0; $j< count($registros); $j++){
				$mipdf -> Row(array(
					utf8_decode($registros[$j]['codigo']),
					utf8_decode($registros[$j]['descripcion']),
					utf8_decode($registros[$j]['cantidad']),
					utf8_decode($registros[$j]['linea']),
					utf8_decode($registros[$j]['proveedor']),
					utf8_decode($registros[$j]['proveedor2']),
					utf8_decode($registros[$j]['proveedor3']),
					utf8_decode($registros[$j]['costo']),
					utf8_decode($registros[$j]['precio'])
				));
			}
		$mipdf -> Output('Reporte-Articulos-Ropa.pdf', 'I');
	}  
?>