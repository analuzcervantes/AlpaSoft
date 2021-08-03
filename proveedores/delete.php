<?php
/*
 * This file is part of the AlpaSoft package
 * 
 * (c) Ana Luz Cervantes <analuzcervantes.s@gmail.com>
 * 
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
*/
    $title= 'Alpa Bikini | Eliminar Proveedor';
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
		echo "<center><br><br><b>";
		echo '<font color="white">IMPOSIBLE ABRIR LA BASE DE DATOS';
		echo "</b></center>";
	}
	else{
     	if(isset($_POST['dl'])){
     		$nombre=$_POST['nombre'];
     		 $sql="DELETE FROM proveedores WHERE nombre='$nombre'";
     		  $resultado=mysqli_query($conDB,$sql);
     		    if(! $resultado){
     		 	  echo "<center>";
     		 	    echo 'Imposible borrar el registro'.mysqli_error($conDB);
     		 	  echo "</center>";
     		    }
     	}
     	$sql='SELECT* FROM proveedores';
     	$resultado=mysqli_query($conDB,$sql);
     	 echo "<br><br><center><b>";
     	  echo '<font color="white">REGISTRO ELIMINADO';
     	 echo "</b></center><br>";
     	  if(! $resultado){
     	  	 echo 'Imposible borrar registro';
     	  }
     	  else{
     	  	$i=0;
     	  	 while($dato=mysqli_fetch_array($resultado)){
     	  	 	$registros[$i]['nombre']=$dato['nombre'];
    			$registros[$i]['direccion']=$dato['direccion'];
    			$registros[$i]['pais']=$dato['pais'];
    			$registros[$i]['ciudad']=$dato['ciudad'];
    			$registros[$i]['telefono']=$dato['telefono'];
    			$registros[$i]['celular']=$dato['celular'];
    			$registros[$i]['email']=$dato['email'];
    			$i=$i+1;
     	  	 }
     	  }
     	  include_once 'tabla.php';
     }
     include_once '../include/pie.inc.php';
?>