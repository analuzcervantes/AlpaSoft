    
            
    <!-- COMIENZO DE FROMILARIO -->   
    
            <!-- FORMA PARA EL FORMULARIO -->         
            <form id="slick-login" method="post" action="" class="legend">
            
            <!-- CAMPO DE TEXTO DEL NOMBRE --> 
            <p>
             <div>
              <input type="text" id="nombre" name="nombre" value="<?php if(isset($nombre)) echo $nombre;?>" > 
             </div>
            </p>
            
            <!-- CAMPO DE TEXTO DE LA DIRECCI�N --> 
             <p>
             <div>
              <input type="text" id="direccion" name="direccion" value="<?php if(isset($direccion)) echo $direccion;?>"> 
             </div>
            </p>
            
            <!-- CAMPO DE TEXTO DEL PAIS --> 
             <p>
             <div>
              <input type="text" id="pais" name="pais" value="<?php if(isset($pais)) echo $pais;?>"> 
             </div>
            </p>
            
            <!-- CAMPO DE TEXTO DE LA CIUDAD --> 
             <p>
             <div>
              <input type="text" id="ciudad" name="ciudad" value="<?php if(isset($ciudad)) echo $ciudad;?>"> 
             </div>
            </p>
            
            <!-- CAMPO DE TEXTO DEL TELEFONO --> 
             <p>
             <div>
              <input type="text" id="telefono" name="telefono" value="<?php if(isset($telefono)) echo $telefono;?>"> 
             </div>
            </p>
            
            <!-- CAMPO DE TEXTO DEL TELEFONO MOVIL--> 
             <p>
             <div>
              <input type="text" id="celular" name="celular" value="<?php if(isset($celular)) echo $celular;?>"> 
             </div>
            </p>
            
            <!-- CAMPO DE TEXTO DEL EMAIL --> 
             <p>
             <div>
              <input type="text" id="email" name="email" value="<?php if(isset($email)) echo $email;?>"> 
             </div>
            </p>
            
            <!-- BOTON DE AGREGAR --> 
            <p>
             <input type="submit" value="Agregar" name="Agregar">
            </p>
            <br><br>
           </form>