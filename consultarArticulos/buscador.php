<?php
/*
 * This file is part of the AlpaSoft package
 * 
 * (c) Ana Luz Cervantes <analuzcervantes.s@gmail.com>
 * 
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
*/

   $title= 'Alpa Bikini | Buscar Articulo';
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
    else{
    	$codigo = $_POST['buscar'];
    	
    	$result="SELECT * FROM articulos WHERE codigo='$codigo';";
    	
    	$comprobar=mysqli_query($conDB,$result);
    	
    	if(! $comprobar){
    		echo "<center>";
    		echo 'No se puede realizar la consulta';
    		echo "</center>";
    	}
    	else{
    		echo "<center><br><br><b>";
    		echo '<font color="white">CONSULTA REALIZADA';
    		echo "</b></center><br>";
    		
    		$i=0;
    		if(mysqli_num_rows($comprobar)<1){
    			echo '<center><br><font color="red">';
    		    echo 'EL CODIGO <b>"'.$codigo.'"</b> NO HA SIDO REGISTRADO.<br>Por favor intentalo de nuevo.<br>';
		        echo '<b><a href="index.php">BUSCAR DE NUEVO</b>';
		     	echo "</center>";
    		}
    		else{
    		   while($dato=mysqli_fetch_array($comprobar)){
    			$registros[$i]['codigo']=$dato['codigo'];
    			$registros[$i]['cantidad']=$dato['cantidad'];
    			$registros[$i]['descripcion']=$dato['descripcion'];
    			$registros[$i]['linea']=$dato['linea'];
    			$registros[$i]['proveedor']=$dato['proveedor'];
    			$registros[$i]['proveedor2']=$dato['proveedor2'];
    			$registros[$i]['proveedor3']=$dato['proveedor3'];
    			$registros[$i]['costo']=$dato['costo'];
    			$registros[$i]['precio']=$dato['precio'];
    			$i=$i+1;
    		   }
    		   include_once 'tablaAcc.php';
    		}
    	}
    }
    include_once '../include/pie.inc.php';
?> 