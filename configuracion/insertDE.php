<?php
/*
 * This file is part of the AlpaSoft package
 * 
 * (c) Ana Luz Cervantes <analuzcervantes.s@gmail.com>
 * 
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
*/
	$title= 'Alpa Bikini | Datos de la Empresa';
    include_once '../include/cabeza.inc.php';

	 include '../include/data.inc.php';
	 include '../include/conMysql.inc.php';
	 include '../include/conDB.inc.php';
	 
	 if (! isset($_POST['Guardar'])){

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
			$result="SELECT * FROM empresa";
			$comprobar=mysqli_query($conDB,$result);

			$i=0;
    		while($dato=mysqli_fetch_array($comprobar)){
    			$registros[$i]['nombre']=$dato['nombre'];
    			$registros[$i]['rfc']=$dato['rfc'];
    			$registros[$i]['direccion']=$dato['direccion'];
    			$registros[$i]['telefono']=$dato['telefono'];
    			$i=$i+1;
    		}
			include 'confEmpresa.php'; 	
		}
	}
	else{
		$nombre = $_POST['nombre'];
		$rfc = $_POST['rfc'];
		$direccion = $_POST['direccion'];
		$telefono = $_POST['telefono'];

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
			$sql = "UPDATE empresa
					SET nombre='$nombre',
						rfc='$rfc', 
						direccion='$direccion',
						telefono='$telefono'";

			$resultado = mysqli_query($conDB,$sql); 

			if(!$resultado){
				echo "<center><br><br><b>";
				echo '<font color="white">IMPOSIBLE ABRIR LA BASE DE DATOS '.mysqli_error($conDB);
				echo "</center>";
		     	exit();
		    } 
			else {
				echo "<center><br><br><b>";
				echo '<font color="white">DATOS ACTIALIZADOS EXITOSAMENTE';
				echo "</center>";
			}
		}
		include_once '../include/pie.inc.php';
	}
?>