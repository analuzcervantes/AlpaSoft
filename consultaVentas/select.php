<?php
/*
 * This file is part of the AlpaSoft package
 * 
 * (c) Ana Luz Cervantes <analuzcervantes.s@gmail.com>
 * 
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
*/
   $title= 'Alpa Bikini | Consulta Ventas';
   include_once '../include/cabeza.inc.php';
	
   	include '../include/data.inc.php';
    include '../include/conMysql.inc.php';
    include '../include/conDB.inc.php';
	
	if(!$conMysql){
		echo "<center><br><br><b>";
		 echo '<font color="white">IMPOSIBLE ESTABLECER LA CONEXION A MYSQL';
		echo "</b></center>";
		exit();
	} 
	if(!$conDB){
        echo 'Imposibe abrir la base de datos';
    }
	else {
		$ventasSQL="SELECT * FROM ventas;";
		$result=mysqli_query($conDB,$ventasSQL);

		if(!$result){
			echo "<center><br><br><b>";
			echo '<font color="white">IMPOSIBLE ABRIR LA BASE DE DATOS';
			echo "</b></center>";
			exit();
		}
		else{
			echo "<center><br><br><b>";
    		echo '<font color="white">CONSULTA REALIZADA';
    		echo "</b></center><br>";

			$i=0;
    		while($dato=mysqli_fetch_array($result)){
    			$registros[$i]['id']=$dato['id'];
    			$registros[$i]['fecha']=$dato['fecha'];
    			$registros[$i]['codigo']=$dato['codigo'];
    			$registros[$i]['descripcion']=$dato['descripcion'];
    			$registros[$i]['cantidadArt']=$dato['cantidadArt'];
    			$registros[$i]['costo']=$dato['costo'];
    			$registros[$i]['precio']=$dato['precio'];
    			$registros[$i]['total']=$dato['total'];
    			$i=$i+1;
    		}
		include_once 'tabla.php';
		}
	}
	include_once '../include/pie.inc.php';
?> 