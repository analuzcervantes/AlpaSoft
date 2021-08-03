<!-- COMIENZO DE FROMILARIO DE REGISTRO DE ARTICULOS-->   
     
            <!-- FORMA PARA EL FORMULARIO -->         
            <form id="slick-login" method="post" action="" class="legend">
            
            <!-- CAMPO DE TEXTO DE CODIGO -->
             
            <p>
             <div>
              <label>Codigo</label>
              <input type="number" min="1" id="codigo" name="codigo" value="<?php if(isset($codigo)) echo $codigo;?>" readonly="readonly"> 
             </div>
            </p>
            
            <!-- CAMPO DE CANTIDAD --> 
             <p>
              <div>
                <label>Catidad de Articulos</label>
                <input type="number" min="1" name="cantidad" id="cantidad" value="<?php if(isset($cantidad)) echo $cantidad;?>" readonly="readonly">
               </div>
             </p>
             <!-- CAMPO DE CANTIDAD DE NUEVOS ARTICULOS --> 
             <p>
              <div>
                <input type="number" min="1" name="cantidadN" id="cantidadN" placeholder="Catidad de Nuevos Articulos" required >
               </div>
             </p>
            
            <!-- CAMPO DE TEXTO PARA LA DESCRIPCION DEL PRODUCTO --> 
            <p>
             <div>
              <label>Descripcion</label>
              <input type="text" id="descripcion" name="descripcion" value="<?php if(isset($descripcion)) echo $descripcion;?>" required> 
             </div>
            </p>
            
            <!-- CAMPO DE SELECCION DEL TIPO DE PRODUCTO (O LINEA) --> 
            <p><label>Linea</label>
              <select type="text" class="placeholder" name="linea" required>
                <option value="Accesorios"><?php if ($linea=="Accesorios") echo "Accesorios";?></option>
                <option value="Ropa"><?php if ($linea=="Ropa") echo "Ropa";?></option> 
               </option>
              </select>
            </p>
            
            <!-- CAMPO DE TEXTO PARA PROVEEDOR --> 
            <p>
             <div>
              <label>Proveedor</label>
              <input type="text" id="proveedor" name="proveedor" value="<?php if(isset($proveedor)) echo $proveedor;?>" required> 
             </div>
            </p>
            
            <p>
             <div>
              <label>Proveedor 2</label>
              <input type="text" id="proveedor2" name="proveedor2" value="<?php if(isset($proveedor2)) echo $proveedor2;?>"> 
             </div>
            </p>
            
            <p>
             <div>
              <label>Proveedor 3</label>
              <input type="text" id="proveedor3" name="proveedor3" value="<?php if(isset($proveedor3)) echo $proveedor3;?>"> 
             </div>
            </p>
            
            <!-- CAMPO DE TEXTO PARA EL COSTO DEL PRODUCTO --> 
            <p>
             <div>
              <label>Costo</label>
              <input type="number" min="1" id="costo" name="costo" value="<?php if(isset($costo)) echo $costo;?>" required> 
             </div>
            </p>
             
            
            
            <!-- BOTON DE AGREGAR --> 
            <p>
             <input type="submit" value="Modificar" name="Modificar">
            </p>
            <br><br>
            </form>
