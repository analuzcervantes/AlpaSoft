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
		echo "<center>";
		 echo " IMPOSIBLE ESTABLECER LA CONEXION A MYSQL";
		echo "</center>";
		exit();
	} 
     else{
     	if(isset($_POST['dl'])){
     	   $codigo=$_POST['codigo'];
     		$sql="DELETE FROM articulos WHERE codigo='$codigo';";
     		 $resultado=mysqli_query($conDB,$sql);
     		    if(! $resultado){
     		 	     echo "<center>";
     		 	      echo 'Imposible borrar el registro'.mysqli_error($con);
     		 	     echo "</center>";
     		    }
     	}
     	 $sql="SELECT* FROM articulos WHERE linea='Accesorios';";
     	  $resultado=mysqli_query($conDB,$sql);
     	      echo '<center><br><b><font color="white">';
     	       echo 'REGISTRO ELIMINADO';
     	      echo "</b></center><br>";
     	       
     	      if(!$resultado){
     	  	       echo 'Imposible borrar registro';
     	      }
     	       else{
     	    	    $i=0;
     	  	         while($dato=mysqli_fetch_array($resultado)){
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
     	       }
     	        include_once 'tablaAcc.php';
     }
     include_once '../include/pie.inc.php';
?>