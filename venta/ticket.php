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
    $totalTicket=0;
    $date= date("Y-m-d H:i:s"); 
     
    class MiPDF extends FPDF{
     	public function Header() {
        $this -> SetTitle ('Venta - Alpa Bikini');
        $this -> Image("../img/p.png", 3, 3, 32 , 8);
        $this -> SetFont('Helvetica', '', 'helvetica.php'); //Letra Arial, tam. 20
        $this -> SetFont('Helvetica', '', 8); //Letra Arial, tam. 20
        $this -> Cell(100, 10, '', 0, 0, 'C');
        $this -> Ln(.3);
        $this -> setY(2);
        $this -> setX(2);
        $this -> SetAuthor('Alpa Bikini');
        $this -> SetMargins(1, 2);
        $this -> SetDisplayMode('fullwidth', 'continuous');
     	}
    }
     
    $mipdf = new MiPDF('P','mm',array(80,150));
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
      $caja="SELECT* FROM caja";
    	$comprobar=mysqli_query($conDB,$caja);
        
        $i=0;
    	  while($dato=mysqli_fetch_array($comprobar)){
    			$registros[$i]['codigo']=$dato['codigo'];
    			$registros[$i]['descripcion']=$dato['descripcion'];
    			$registros[$i]['cantidadArt']=$dato['cantidadArt'];
    			$registros[$i]['costo']=$dato['costo'];
    			$registros[$i]['precio']=$dato['precio'];
    			$registros[$i]['total']=$dato['total'];
    			$i=$i+1;
    		}
    	       
    		for($j=0; $j<$i; $j++){
    			$codigo = $registros[$j]['codigo'];
    			$descripcion = $registros[$j]['descripcion'];
    			$cantidadArt = $registros[$j]['cantidadArt'];
    			$costo = $registros[$j]['costo'];
    			$precio = $registros[$j]['precio'];
    			$total = $registros[$j]['total'];
    			
    		    $art="SELECT* FROM articulos WHERE codigo='$codigo'";
    		    $comprobar=mysqli_query($conDB,$art);

    		      while($dato=mysqli_fetch_array($comprobar)){
    		    	  $registros[0]['cantidad']=$dato['cantidad'];
    		      }

    		      $cant = $registros[0]['cantidad'];
    			
                    $sqlVentas = "INSERT ventas VALUES
		     	                        ('','$date','$codigo','$descripcion','$cantidadArt','$costo','$precio','$total')";
		     	          $resultado = mysqli_query($conDB,$sqlVentas);
    		    
                    $cant=$registros[0]['cantidad']-$cantidadArt;
                      
                    $sqlArt = "UPDATE articulos SET cantidad='$cant' WHERE codigo='$codigo'";
		     	 	   
                    $resultado = mysqli_query($conDB,$sqlArt);
    		}	
      
        $result="SELECT * FROM empresa";
        $comprobar=mysqli_query($conDB,$result);

        $i=0;
        while($dato=mysqli_fetch_array($comprobar)){
      	  $registro[$i]['nombre']=$dato['nombre'];
      	  $registro[$i]['rfc']=$dato['rfc'];
      	  $registro[$i]['direccion']=$dato['direccion'];
      	  $registro[$i]['telefono']=$dato['telefono'];
      	  $i=$i+1;
        }
        
        $result="SELECT * FROM caja";
        $comprobar=mysqli_query($conDB,$result);

        $i=0;
        while($dato=mysqli_fetch_array($comprobar)){
      	  $registro[$i]['codigo']=$dato['codigo'];
      	  $registro[$i]['descripcion']=$dato['descripcion'];
      	  $registro[$i]['cantidadArt']=$dato['cantidadArt'];
      	  $registro[$i]['precio']=$dato['precio'];
      	  $i=$i+1;
        }
      
        $mipdf -> Ln(8);
        $mipdf -> MultiCell(0, 6, $registro[0]['nombre'], 0, 'C');
        $mipdf -> MultiCell(0, 4, $registro[0]['rfc'], 0, 'C');
        $mipdf -> MultiCell(0, 3, utf8_decode($registro[0]['direccion']), 0, 'C');
        $mipdf -> MultiCell(0, 4, 'Tel: '.$registro[0]['telefono'], 0, 'C');
        $mipdf -> MultiCell(0, 4, $date, 0, 'C');
        $mipdf -> MultiCell(0, 4, $fecha."                             ".$hora, 0, 'C');
        $mipdf -> Ln(3);

        $mipdf -> SetFont('Helvetica', '', 7);
        $mipdf -> Cell(15, 10, 'CODIGO', 0, 0, "C");
        $mipdf -> Cell(25, 10, 'ARTICULO', 0, 0, "C");
        $mipdf -> Cell(9, 10, 'CANT', 0, 0, "C");
        $mipdf -> Cell(13, 10, 'PRECIO', 0, 0, "C");
        $mipdf -> Cell(16, 10, 'SUB TOTAL', 0, 0, 'C');
        $mipdf -> Ln(0);
      
        for($j=0; $j< count($registro); $j++){
          $mipdf -> Ln();
          $mipdf -> Cell(15, 4, $registro[$j]['codigo'], 0, 0, "C");
          $mipdf -> MultiCell(25, 4, utf8_decode($registro[$j]['descripcion']), 0, "C");
          $mipdf -> Cell(47, -15, $registro[$j]['cantidadArt'], 0, 0, "R");
          $mipdf -> Cell(12, -15, $registro[$j]['precio'], 0, 0, "R");
          
          $subT= $registro[$j]['cantidadArt']*$registro[$j]['precio'];
          $totalTicket = $subT + $totalTicket;
          $mipdf -> Cell(15, -15, $subT, 0, 0, 'R');
          $mipdf -> MultiCell(30, 1, '', 0);
        }
        
        $mipdf -> Ln(6);
        $mipdf->MultiCell(73.5, 0,'TOTAL: '.$totalTicket, 0, 'R');

        $mipdf -> Ln(15);
        $mipdf -> Cell(80,0,'GRACIAS POR SU COMPRA',0,1,'C');
        $mipdf -> Output('Ticket.pdf', 'I');
        
        $sql="DELETE FROM caja";
	      $resultado=mysqli_query($conDB,$sql);
    }      
?>