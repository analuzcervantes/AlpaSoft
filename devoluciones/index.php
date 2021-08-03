<?php
/*
 * This file is part of the AlpaSoft package
 * 
 * (c) Ana Luz Cervantes <analuzcervantes.s@gmail.com>
 * 
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
*/
	$title= 'Alpa Bikini | Devoluciones';
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
	
	if (!isset($_POST['Devolver'])){
		include_once 'devoluciones.php';
	}
	else{
	  	$fecha = $_POST['fecha'];
	  	$codigo = $_POST['codigo'];
	  	
	    $venta="SELECT* FROM ventas WHERE codigo='$codigo' AND fecha='$fecha'";
    	 $comprobar=mysqli_query($conDB,$venta);

    	  if(! $comprobar){		
    	    echo '<div class="alert alert-error" align="center">
    	           <button type="button" class="close" data-dismiss="alert">×</button>
		            <strong>NO SE PUEDE REALIZAR LA DEVOLUCION, POR FAVOR INTENTE DE NUEVO<br>
		             <a href="../devoluciones/index.php" role="button" class="btn btn-success" data-toggle="modal">
		              DEVOLUCION 
		             </a>
		            </strong>
		          </div>';       
    	  	exit();
    	  }
    	  else{
    	 
    	   $i=0;
    	    while($dato=mysqli_fetch_array($comprobar)){
    	   	    $registros[$i]['id']=$dato['id'];
    			$registros[$i]['cantidadArt']=$dato['cantidadArt'];
    			$registros[$i]['precio']=$dato['precio'];
    			$i=$i+1;
    		 }
    		  $cantidadArt=$registros[0]['cantidadArt'];
    		   $id=$registros[0]['id'];
    		    $precio=$registros[0]['precio'];
    	  
    		     $art="SELECT* FROM articulos WHERE codigo='$codigo'";
	  	         $datoArt = mysqli_query($conDB,$art);
	  	   
	  	          while($datoA=mysqli_fetch_array($datoArt)){
    				 $registro[0]['cantidad']=$datoA['cantidad'];
	  	          }
	  	           $cantidad= $registro[0]['cantidad'];
	  	       
	  	            $cant=$cantidad+1;
	  	        
	  	             $sqlArt = "UPDATE articulos SET cantidad='$cant' WHERE codigo='$codigo'";
		     	      $resultado = mysqli_query($conDB,$sqlArt);	

		     	       if($cantidadArt==1){
		     	  	      $venta="DELETE FROM ventas WHERE id='$id'";
		     	  	      $resultado = mysqli_query($conDB,$venta);
		     	  	       if(! $resultado){
		     	  	       	 echo 'NO SE PUEDE REALIZAR LA DEVOLUCION';
		     	  	       }
							if($resultado){
								echo '<div class="alert alert-success" align="center">
										<button type="button" class="close" data-dismiss="alert">×</button>
											<strong>DEVOLUCIÓN REALIZADA EXITOSAMENTE<br>
											<a href="../devoluciones/index.php" role="button" class="btn btn-success" data-toggle="modal">
											DEVOLUCION 
											</a>
											</strong>
										</div>';
						   }

		     	       }
		     	       else{
		     	  	        $cant= $cantidadArt - 1;
		     	  	        $sqlArt = "UPDATE ventas SET cantidadArt='$cant' WHERE codigo='$codigo' AND id='$id'";
		     	            $resultado = mysqli_query($conDB,$sqlArt);	
		     	       if(! $resultado){
		     	  	       	 echo 'NO SE PUEDE REALIZAR LA DEVOLUCION';
		     	  	       }	
		     	       }
    	  }
	  }
?>