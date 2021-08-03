<?php
/*
 * This file is part of the AlpaSoft package
 * 
 * (c) Ana Luz Cervantes <analuzcervantes.s@gmail.com>
 * 
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
*/
    $title= 'Alpa Bikini | Eliminar Articulo';
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
     	   $codigo=$_POST['codigo'];
     		$sql="DELETE FROM caja WHERE codigo='$codigo';";
     		 $resultado=mysqli_query($conDB,$sql);
     		    if(! $resultado){
     		 	     echo "<center>";
     		 	      echo 'Imposible borrar el registro'.mysqli_error($conDB);
     		 	     echo "</center>";
     		    }
     	}
     	 $sql="SELECT* FROM caja;";
     	  $resultado=mysqli_query($conDB,$sql);
     	      echo '<center><br><b><font color="white">';
     	       echo 'REGISTRO ELIMINADO<br>';
     	       echo '<b><a href="venta.php">CONTINUAR CON VENTA</b>';
     	      echo "</b></center><br>";
     }
     include_once '../include/pie.inc.php';
?>