
     <!-- COMIENZO DE FROMILARIO DE CONFIGURACION DE DATOS DE LA EMPRESA -->   
     
            <!-- FORMA PARA EL FORMULARIO -->         
            <form id="slick-login" method="post" action="" class="legend">
            
            <!-- CAMPO DE TEXTO DE CODIGO -->
             
            <p>
             <div>
              <input type="email" id="codigo" name="email" value="<?php echo $registros[0]['email'];?>"required> 
             </div>
            </p>
                     
            <p>
             <div>
              <input type="password" id="proveedor2" name="contrasena" value="<?php echo $registros[0]['contrasena'];?>"required> 
             </div>
            </p>
                     
            
            <!-- BOTON DE AGREGAR --> 
            <p>
             <input type="submit" value="Guardar" name="Guardar">
            </p>
            <br><br>
            </form>