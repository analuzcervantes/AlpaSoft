
    <!-- COMIENZO DE FROMILARIO DE CONFIGURACION DE DATOS DE LA EMPRESA -->   

            <!-- FORMA PARA EL FORMULARIO -->         
            <form id="slick-login" method="post" action="" class="legend">
            
            <!-- CAMPO DE TEXTO DE CODIGO -->
            <br>
          
            <p>
             <div>
              <input type="text" id="nombre" name="nombre" placeholder="Nombre de la empresa" value="<?php echo $registros[0]['nombre'];?>"required> 
             </div>
            </p>
            
            
            <!-- CAMPO DE TEXTO PARA LA DESCRIPCION DEL PRODUCTO --> 
            <p>
             <div>
              <input type="text" id="rfc" name="rfc" value="<?php echo $registros[0]['rfc'];?>" required> 
             </div>
            </p>
                       
            <!-- CAMPO DE TEXTO PARA PROVEEDOR --> 
            <p>
             <div>
              <input type="text" id="direccion" name="direccion" value="<?php echo $registros[0]['direccion'];?>" required> 
             </div>
            </p>
            
            <p>
             <div>
              <input type="text" id="telefono" name="telefono" value="<?php echo $registros[0]['telefono'];?>"> 
             </div>
            </p>
                     
            
            <!-- BOTON DE AGREGAR --> 
            <p>
             <input type="submit" value="Guardar" name="Guardar">
            </p>
            <br><br>
            </form>