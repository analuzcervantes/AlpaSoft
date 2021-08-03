
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<link rel="stylesheet" type="text/css" href="../css/tabla.css" />

<center>
<table>
 <th>Nombre</th>
 
 <th>Direccion</th>
 
 <th>Pais</th>
 
 <th>Ciudad</th>
 
 <th>Telefono</th>

 <th>Telefono Movil</th>

 <th>E-mail</th>
 
 <th></th>
 
 	<?php for($j=0; $j<$i; $j++){?>
 		<tr class"odd">
 			<td><center><?php echo $registros[$j]['nombre']?></center></td>
 			<td><center><?php echo $registros[$j]['direccion']?></center></td>
 			<td><center><?php echo $registros[$j]['pais']?></center></td>
 			<td><center><?php echo $registros[$j]['ciudad']?></center></td>
 			<td><center><?php echo $registros[$j]['telefono']?></center></td>
 			<td><center><?php echo $registros[$j]['celular']?></center></td>
 			<td><center><?php echo $registros[$j]['email']?></center></td>
 			<td>
 			  <form action="delete.php" method="POST">
 			     <input type="hidden" name='nombre' value="<?php echo $registros[$j]['nombre'];?>" />
 			    <input type="submit" name="dl" value="Eliminar ">
 			  </form>
 			  
 			  <form action="update.php" method="POST">
              <input type="hidden" name='nombre' value="<?php echo $registros[$j]['nombre'];?>"/>
               <input type="hidden" name='direccion' value="<?php echo $registros[$j]['direccion'];?>"/>
               <input type="hidden" name='pais' value="<?php echo $registros[$j]['pais'];?>"/>
                <input type="hidden" name='ciudad' value="<?php echo $registros[$j]['ciudad'];?>"/>
               <input type="hidden" name='telefono' value="<?php echo $registros[$j]['telefono'];?>"/>
               <input type="hidden" name='celular' value="<?php echo $registros[$j]['celular'];?>"/>
               <input type="hidden" name='email' value="<?php echo $registros[$j]['email'];?>"/>
               <input type="submit" name="modificar" value="Modificar" >
              </form>  
     
            </td>
 	    </tr>
 		 
 	<?php }?>
</table>
</center>