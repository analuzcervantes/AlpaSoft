<?php
/*
 * This file is part of the AlpaSoft package
 * 
 * (c) Ana Luz Cervantes <analuzcervantes.s@gmail.com>
 * 
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
*/
	$title= 'Alpa Bikini | Actualizar Proveedor';
    include_once '../include/cabeza.inc.php';
	
	$nombre = $_POST['nombre'];
	$direccion = $_POST['direccion'];
	$pais = $_POST['pais'];
	$ciudad = $_POST['ciudad'];
	$telefono = $_POST['telefono'];
	$celular = $_POST['celular'];
	$email = $_POST['email'];
		
	if (! isset($_POST['Agregar'])){
		include 'actualizaProveedor.php';
	}
	else{
	    $nombre = $_POST['nombre'];
	    $direccion = $_POST['direccion'];
	    $pais = $_POST['pais'];
	    $ciudad = $_POST['ciudad'];
		$telefono = $_POST['telefono'];
		$celular = $_POST['celular'];
		$email = $_POST['email'];
		
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
			$sql = "UPDATE proveedores
		     	    SET nombre='$nombre',
		     	        direccion='$direccion',
		     	        pais='$pais', 
		     	        ciudad='$ciudad',
		     	        telefono='$telefono',
		     	        celular='$celular',
		     	        email='$email'
		     	    WHERE nombre='$nombre'";
		    
			$resultado = mysqli_query($conDB,$sql);
		     	
		    if(!$resultado){
		     	echo "<center><br><br><b>";
		     	echo '<font color="white">IMPOSIBLE ACTUALIZAR LOS DATOS'.mysqli_error($conDB);
		     	echo "</b></center>";
		     	exit();
		    } 
		    else{
				echo "<center><br><br><b>";
				echo '<font color="white">DATOS ACTIALIZADOS EXITOSAMENTE';
				echo "</center>";
		    }
		}
	}
	include_once '../include/pie.inc.php';
?>