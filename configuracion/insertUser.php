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
		else {
			$result="SELECT * FROM user";
			$comprobar=mysqli_query($conDB,$result);

			$i=0;
    		while($dato=mysqli_fetch_array($comprobar)){
    			$registros[$i]['email']=$dato['email'];
    			$registros[$i]['contrasena']=$dato['contrasena'];
    			$i=$i+1;
    		}
			include 'user.php'; 
		}	
	}
	else{
		$email = $_POST['email'];
    	$contrasena = $_POST['contrasena'];

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
			$sql = "UPDATE user
		     	    SET email='$email',
		     	        contrasena='$contrasena'";

		    $resultado = mysqli_query($conDB,$sql);

		    if(!$resultado){
				echo "<center>";
				echo 'Imposible ingresar los datos en la base de datos'.mysqli_error($conDB);
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