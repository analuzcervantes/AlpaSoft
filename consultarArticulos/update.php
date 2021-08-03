<?php
/*
 * This file is part of the AlpaSoft package
 * 
 * (c) Ana Luz Cervantes <analuzcervantes.s@gmail.com>
 * 
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
*/   
    $title = 'Alpa Bikini | Modificar Articulo';
	include_once '../include/cabeza.inc.php';

        $codigo= $_POST['codigo'];
	    $cantidad= $_POST['cantidad'];
	    $descripcion= $_POST['descripcion'];
    	$linea= $_POST['linea'];
    	$proveedor= $_POST['proveedor'];
    	$proveedor2= $_POST['proveedor2'];
    	$proveedor3= $_POST['proveedor3'];
	    $costo= $_POST['costo'];	
	
	if (! isset($_POST['Modificar'])){
		include_once 'modificar.php';
	}
	else{
		$codigo= $_POST['codigo'];
	    $cantidad= $_POST['cantidad'];
	    $cantidadN= $_POST['cantidadN'];
	    $descripcion= $_POST['descripcion'];
    	$linea= $_POST['linea'];
    	$proveedor= $_POST['proveedor'];
	    $proveedor2= $_POST['proveedor2'];
	    $proveedor3= $_POST['proveedor3'];
	    $costo= $_POST['costo'];

			include '../include/data.inc.php';
			include '../include/conMysql.inc.php';
			include '../include/conDB.inc.php';
				 		  
		     if(!$conDB){
		        echo "<center>";
		     	 echo 'Imposible abrir la base de datos';
		     	echo "</center>";
		     	exit();
		     }
		     else{
		             if($linea=='Accesorios'){ 
       	 	         	$precio = $costo*2;
       	 	         }
       	 	          else{ 
       	 	          	$precio = $costo*3;
       	 	          }
       	 	           
       	 	          $cantidad=$cantidad+$cantidadN;
       	 	          
		     	$sql = "UPDATE articulos 
		     	        SET cantidad='$cantidad', 
		     	            descripcion='$descripcion', 
		     	            linea='$linea', 
		     	            proveedor='$proveedor',
		     	            proveedor2='$proveedor2',
		     	            proveedor3='$proveedor3',
		     	            costo='$costo',
		     	            precio='$precio' 
		     	        WHERE codigo='$codigo'";
		     	     $resultado = mysqli_query($conDB,$sql);
		     	
		     	 if(!$resultado){
		     	 	echo "<center>";
		     	 	 echo 'Imposible insertar en la base de datos'.mysqli_error($conDB);
		     	 	echo "</center>";
		     	 	 exit();
		     	 } 
				  else {
					echo "<center>";
					echo "<br><b>";
					echo '<font color="white">SE HAN MODIFICADO LOS DATOS CORRECTAMENTE</font></b>';
				   	echo "</center>";
				  }
		     }
	}
	include_once '../include/pie.inc.php';
?>