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
		$caja="SELECT* FROM proveedores";
    	$comprobar=mysqli_query($conDB,$caja);

			$i=0;
    	   	while($dato=mysqli_fetch_array($comprobar)){
    			$registros[$i]['nombre']=$dato['nombre'];
    			$registros[$i]['direccion']=$dato['direccion'];
    			$registros[$i]['pais']=$dato['pais'];
    			$registros[$i]['ciudad']=$dato['ciudad'];
    			$registros[$i]['telefono']=$dato['telefono'];
    			$registros[$i]['celular']=$dato['celular'];
    			$registros[$i]['email']=$dato['email'];
    			$i=$i+1;
    		}

			$mipdf -> Cell(0, 3,'REPORTE DE PROVEEDORES', 0, 0, 'C');
    		$mipdf -> Ln();
			$mipdf -> SetFont('Helvetica', 'B', 13);
    		
			$mipdf -> SetWidths(Array(3,7,3,3,3,3,6));
    		$mipdf -> SetAligns(Array('C','C','C','C','C','C', 'C'));
			$mipdf -> Row(Array(
				utf8_decode("NOMBRE"), 
				utf8_decode("DESCRIPCIÓN"),
				utf8_decode("PAÍS"),
				utf8_decode("CIUDAD"),
				utf8_decode("TELÉFONO"),
				utf8_decode("CELULAR"),
				utf8_decode("E-MAIL")
			));
    	
			$mipdf -> SetFont('Helvetica', '', 10);
			for($j=0; $j< count($registros); $j++){
				$mipdf -> Row(array(
					utf8_decode($registros[$j]['nombre']),
					utf8_decode($registros[$j]['direccion']),
					utf8_decode($registros[$j]['pais']),
					utf8_decode($registros[$j]['ciudad']),
					utf8_decode($registros[$j]['telefono']),
					utf8_decode($registros[$j]['celular']),
					utf8_decode( $registros[$j]['email'])
				));
			}
		$mipdf -> Output('Reporte-Proveedores.pdf', 'I');
	}  
?>