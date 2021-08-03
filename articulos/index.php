<?php
/*
 * This file is part of the AlpaSoft package
 * 
 * (c) Ana Luz Cervantes <analuzcervantes.s@gmail.com>
 * 
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
*/

  $title= 'Alpa Bikini | Registro de Articulos';
  include_once '../include/cabeza.inc.php';
   
	if (isset($_POST['Agregar'])){
		$codigo = $_POST['codigo'];
		$cantidad = $_POST['cantidad'];
		$descripcion = $_POST['descripcion'];
		$linea = $_POST['linea'];
		$proveedor = $_POST['proveedor'];
		$proveedor2 = $_POST['proveedor2'];
		$proveedor3 = $_POST['proveedor3'];
		$costo = $_POST['costo'];
		$precio=0;
		 
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
		     	       
   	       	 	        $sql = "INSERT articulos VALUES
		     	               ('$codigo','$cantidad','$descripcion','$linea','$proveedor','$proveedor2','$proveedor3','$costo','$precio')";
		     	                  $resultado = mysqli_query($conDB,$sql);
		     	
		     	           if(!$resultado){
		     	 	            echo '<center><br><font color="red">';
		     	 	            echo 'El cogido <b>"'.$codigo.'"</b> ya fue registrado anteriormente. <br>Por favor intentalo de nuevo.<br>';
		     	 	            echo '<b><a href="index.php">REGISTRAR DE NUEVO</b>';
		     	 	            echo "</center>";
		     	 	            exit();
		     	           }
		     	           else{
		     	           	    echo "<center>";
		                      echo "<br><b>";
		                      echo '<font color="white">SE HAN INSERTADO LOS DATOS CORRECTAMENTE</font></b>';
		                      echo "</center>";
		     	           } 
		       	 	  }
	}
	
?>
             
     <!-- COMIENZO DE FROMILARIO DE REGISTRO DE ARTICULOS-->   
     
            <!-- FORMA PARA EL FORMULARIO -->         
            <form id="slick-login" method="post" action="" class="legend">
            
            <!-- CAMPO DE TEXTO DE CODIGO -->
             
            <p>
             <div>
              <input type="number" min="1" id="codigo" name="codigo" placeholder="Codigo" required> 
             </div>
            </p>
            
            <!-- CAMPO DE CANTIDAD --> 
             <p>
               <div>
                <input type="number" min="1" name="cantidad" id="cantidad" placeholder="Cantidad de Articulos" required>
               </div>
             </p>
            
            <!-- CAMPO DE TEXTO PARA LA DESCRIPCION DEL PRODUCTO --> 
            <p>
             <div>
              <input type="text" id="descripcion" name="descripcion" placeholder="Descripcion del Producto" required> 
             </div>
            </p>
            
            <!-- CAMPO DE SELECCION DEL TIPO DE PRODUCTO (O LINEA) --> 
            <p>
              <select type="text" class="placeholder" name="linea" required>
               <option value="">Selecciona una Linea
                <option value="Accesorios">Accesorios
                <option value="Ropa">Ropa
               </option>
              </select>
            </p>
            
            <!-- CAMPO DE TEXTO PARA PROVEEDOR --> 
            <p>
             <div>
              <input type="text" id="proveedor" name="proveedor" placeholder="Proveedor del Producto" required> 
             </div>
            </p>
            
            <p>
             <div>
              <input type="text" id="proveedor2" name="proveedor2" placeholder="Proveedor del Producto 2"> 
             </div>
            </p>
            
            <p>
             <div>
              <input type="text" id="proveedor3" name="proveedor3" placeholder="Proveedor del Producto 3"> 
             </div>
            </p>
            
            <!-- CAMPO DE TEXTO PARA EL COSTO DEL PRODUCTO --> 
            <p>
             <div>
              <input type="number" min="1" id="costo" name="costo" placeholder="Costo del Producto" required> 
             </div>
            </p>
             
            
            
            <!-- BOTON DE AGREGAR --> 
            <p>
             <input type="submit" value="Agregar" name="Agregar">
            </p>
            <br><br>
            </form>
            
<?php include_once '../include/pie.inc.php';?>