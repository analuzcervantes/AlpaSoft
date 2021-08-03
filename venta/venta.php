<?php 
/*
 * This file is part of the AlpaSoft package
 * 
 * (c) Ana Luz Cervantes <analuzcervantes.s@gmail.com>
 * 
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
*/
  $title= 'Alpa Bikini | Ventas';
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
  
  date_default_timezone_set("America/Mazatlan");
	$fecha=date('l jS \of F Y');
	$hora=date('h:i:s A');
	echo '<p ALIGN="center"><font color="white" size="4px">';
	echo $fecha;
	echo '<br>';
	echo $hora;
	echo '</p></font>';
        
   $na=0;
   $totalF= 0.00;
   $cambio='0,00';
?>         
<!DOCTYPE html>
  <html>
    <body>

      <form action="" method="post">
        <div align="center">
          <table width="10%" border="0">
            <tbody>

              <tr>
                <td>&nbsp;</td>
              </tr>

              <tr>   
                <td width="2%" rowspan="2">
                  <div>
                    <form method="post">
                      <label>
                       <input type="text" id="codigo" name="codigo" placeholder="Codigo del producto">
                       <input type="text" id="cantidadArt" name="cantidadArt" placeholder="Cantidad del producto">
                      </label>
                    </form>
                  </div>
                </td>
                <td>
                  <div align="right"> 
                    <input type="submit" value="Agregar" name="Agregar" class="btn btn-primary"> 
                  </div>
                </td>
              </tr>
                 
              <tr>
                <td>&nbsp;</td>
              </tr>
                 
            </tbody>
          </table>

          <table border="0" class="table table-hover">
            <tbody>
              <tr class="info">
                <td width="10%"><strong align="center">Codigo</strong></td>
                <td width="20%"><strong>Descripcion del Producto</strong></td>
                <td width="10%"><strong>Cantidad</strong></td>
                <td width="10%"><strong><center>Precio</center></strong></td>
                <td width="10%"><strong><center>Existencia</center></strong></td>
                <td width="10%"><strong><center>Sub Total</center></strong></td>
                <td width="10%">&nbsp;</td>
              </tr>
              <?php 
                if(!empty($_POST['codigo'])){
                  $codigo = $_POST['codigo'];
                 
                  $sql = "SELECT* FROM caja WHERE codigo='$codigo'";
		              $resultado = mysqli_query($conDB,$sql);
		            
		              if($dato=mysqli_fetch_array($resultado)){
                    $codigo=$dato['codigo'];
		                $precio=$dato['precio'];
		                $cantidadArt=$dato['cantidadArt']+1;
		                $total=$precio*$cantidadArt;
		                $sql="UPDATE caja SET total='$total', cantidadArt='$cantidadArt' Where codigo='$codigo'";
		                $resultado = mysqli_query($conDB,$sql);
		              }   

		              $sql = "SELECT* FROM articulos WHERE codigo='$codigo'";
		              $resultado = mysqli_query($conDB,$sql);
                  
                  if(empty($_POST['cantidadArt'])){
                    $cantidadArt=1;
		              }
                  else{
                    $cantidadArt = $_POST['cantidadArt'];
		              }
                  if($dato=mysqli_fetch_array($resultado)){
		                $codigo = $dato['codigo'];
					          $descripcion=$dato['descripcion'];
					          $cantidad=$dato['cantidad'];
					          $costo=$dato['costo'];
					          $precio=$dato['precio'];
					          $total = $precio*$cantidadArt;
					       
					          if(($cantidad<1)||($cantidadArt>$cantidad)){
					        	  echo '<div class="alert alert-error" align="center">
		             	          <button type="button" class="close" data-dismiss="alert">×</button>
		             	          <strong>No hay producto en existencia</strong>
		             	          </div>';
					          }
					          else {
                      $sql="INSERT caja VALUES 
					                  ('$codigo','$descripcion','$cantidad','$cantidadArt','$costo','$precio','$total')";
					            $resultado=mysqli_query($conDB,$sql);
					          }
		              }
		              else{
                    echo '<div class="alert alert-error" align="center">
		             	        <button type="button" class="close" data-dismiss="alert">×</button>
		             	        <strong>Producto no encontrado en la base de datos
		             	          <br>
		             	            <a href="../articulos/index.php" role="button" class="btn btn-success" data-toggle="modal">
		             	              Crear Nuevo Producto 
		             	            </a>
		             	        </strong>
		             	        </div>';
		              }
                }
			          $sql= "SELECT* FROM caja";
			          $resultado= mysqli_query($conDB,$sql);
			           
			          while($dato=mysqli_fetch_array($resultado)){
			          	$na=$na+$dato['cantidadArt'];
			          	$totalF = $totalF+$dato['total'];
		          ?>
                  <tr class"odd">
                    <td><center><?php echo $dato['codigo'];?></center></td>
                    <td><center><?php echo $dato['descripcion'];?></center></td>
                    <td><center><?php echo $dato['cantidadArt'];?></center></td>
                    <td><center><?php echo $dato['precio'];?></center></td>
                    <td><center><?php echo $dato['cantidad']-$dato['cantidadArt'];?></center></td>
                    <td><center><?php echo $dato['total'];?></center></td>
                    <td>
                      <form action="delete.php" method="POST">
                        <input type="hidden" name='codigo' value="<?php echo $dato['codigo'];?>" />
                        <input type="submit" name="dl" value="Eliminar ">
                      </form>
                    </td>
                  </tr>
          <?php }?>
            </tbody>
          </table>
          
          <br>
          
          <table width="75%" border="0">
            <tbody>
              <tr>
                <td width="35%">
                  <pre style="font-size:24px">
                    <center><?php echo $na; ?> Articulos en venta</center>
                  </pre>
                </td>
                
                <td width="5%">&nbsp;</td>
                <td width="25%"></td>
                
                <td width="50%">
                  <div align="right">
                    <pre2 style="font-size:24px">Total: $ <?php echo $totalF; ?></pre2>
                  </div>
                </td>
              </tr>
              
              <tr>
                <td colspan="4"></td>
              </tr>
                 
              <tr>
                <td>
                  <label>
                    <input type="number" class="input-xlarge" min="0" name="recibido" placeholder="Dinero Recibido">
                  </label>
                </td>
                <td width="3%">&nbsp;</td>
                
                <?php
                if(!empty($_POST['recibido'])){
                  if($_POST['recibido'] < $totalF){
                    $faltante = $totalF - $_POST['recibido'];
                    echo '<div class="alert alert-error" align="center">
		             	        <button type="button" class="close" data-dismiss="alert">×</button>
		             	        <strong>Cantidad recebida no cubre el total a pagar<br> $'.$faltante.' es el faltante. 
		             	          <br>
		             	        </strong>
		             	        </div>';
                  }
                  else{
                    $recibido = $_POST['recibido'];
                    $cambio = $recibido-$totalF;
                  }
                }?>
                <td width="10%">
                  <div align="center">
                    <pre2 style="font-size:20px">Cambio: $ <?php echo $cambio; ?></pre2>
                  </div>
                </td>
                
                <br>
                
                <tr>
                  <td width="3%">&nbsp;</td>
                  <td width="3%">&nbsp;</td>
                  <td><br><center>
                    <form action="ventaF.php" method="post">
                     <input type="hidden" name="totalF" value="<?php echo $totalF;?>" />
                     <input type="hidden" name='recibido' value="<?php echo $recibido;?>" />
                     <input type="hidden" name='cambio' value="<?php echo $cambio;?>" />
                     <input type="submit" value="COMPRAR" name="comprar" class="btn btn-primary"> 
                    </form>
                  </td>
                </tr>
              </tr>
            </tbody>
          </table> 

            </div>
      </form>
    </body>
  </html>