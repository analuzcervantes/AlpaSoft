<?php
/*
 * This file is part of the AlpaSoft package
 * 
 * (c) Ana Luz Cervantes <analuzcervantes.s@gmail.com>
 * 
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
*/
session_start();
//manejamos en sesion el nombre del usuario que se ha logeado
if (!isset($_SESSION["usuario"])){
    header("location:index.php?nologin=false");
    
}
$_SESSION["usuario"];
?>
<!DOCTYPE html>
<html>
    <head>
		<meta charset="UTF-8" /> 
        <title>Alpa Bikini | Home</title>
        <link rel="stylesheet" type="text/css" href="css/menu.css" />
        
    </head>
    <body>
      <div align="right">
       <img width='250px' height='75px' src="./img/p.png">
      </div>
		  <ul class="ch-grid">
		  
			<li>
			  <div class="ch-item ch-img-1">
			   <div class="ch-info">
			     <a href="venta/venta.php"><h3>Ventas</h3></a>
			     <p></p>
			   </div>
			  </div>
		    </li>
		    
		    <li>
		      <div class="ch-item ch-img-8">
				<div class="ch-info">
				 <a href="devoluciones/index.php"><h3>Devoluciones</h3></a><br>
				  <p></p>
			    </div>
			  </div>
		    </li>
		    
		    <li>
		      <div class="ch-item ch-img-2">
		         <div class="ch-info">
		          <a href="consultarArticulos/index.php"><h3>Consulta de Articulos</h3></a>
		            <p></p>
		         </div>
			  </div>
		    </li>
		    
		    <li>
		      <div class="ch-item ch-img-3">
				<div class="ch-info">
				 <a href="articulos/index.php"><h3>Registrar Articulos</h3></a><br>
				  <p></p>
			    </div>
			  </div>
		    </li>
		    
		    <br>
		    
		    <li>
		      <div class="ch-item ch-img-4">
				<div class="ch-info">
				 <a href="configuracion/index.php"><h3>Configuracion</h3></a><br>
				  <p></p>
			    </div>
			  </div>
		    </li>
		    
		    <li>
		      <div class="ch-item ch-img-5">
				<div class="ch-info">
				 <a href="consultaVentas/select.php"><h3>Consulta de Ventas</h3></a><br>
				  <p></p>
			    </div>
			  </div>
		    </li>
		    
		    <li>
		      <div class="ch-item ch-img-7">
				<div class="ch-info">
				 <a href="reportes/index.php"><h3>Reportes</h3></a><br>
				  <p></p>
			    </div>
			  </div>
		    </li>
		    
		    <li>
		      <div class="ch-item ch-img-6">
				<div class="ch-info">
				 <a href="proveedores/index.php"><h3>Proveedores</h3></a><br>
				  <p></p>
			    </div>
			  </div>
		    </li>
		    
		 </ul>	
    </body>
</html>