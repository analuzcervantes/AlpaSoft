
<meta http-equiv="Content-Type" content="text/html" charset="UTF-8" />
<link rel="stylesheet" type="text/css" href="../css/tabla.css" charset="UTF-8"/>

<center>
<table> <!--Esto es un comentario-->
 <th>Codigo</th>
 
 <th>Cantidad de Art.</th>
 
 <th>Descripcion</th>
 
 <th>Linea</th>
 
 <th>Proveedor</th>
 
 <th>Proveedor 2</th>
 
 <th>Proveedor 3</th>
 
 <th>Costo</th>

 <th>Precio</th>
 
 <th></th>
 
 	<?php for($j=0; $j<$i; $j++){?>
 		<tr class"odd">
 			<td><center><?php echo $registros[$j]['codigo']?></center></td>
 	   <?php if(($registros[$j]['cantidad']>10) && ($registros[$j]['cantidad']<20)){?>
 			      <td><center><font color="yellow"><b><?php echo $registros[$j]['cantidad']?></b></font></center></td>
 	   <?php }
 	         else{ 
 	          if($registros[$j]['cantidad']<=10){?>
 	         	  <td><center><font color="red"><b><?php echo $registros[$j]['cantidad']?></b></font></center></td>
 	   <?php  }
 	          else{ ?>
 	              <td><center><?php echo $registros[$j]['cantidad']?></center></td>	
 	   <?php  }
 	         }?>
 			<td><center><?php echo $registros[$j]['descripcion']?></center></td>
 			<td><center><?php echo $registros[$j]['linea']?></center></td>
 			<td><center><?php echo $registros[$j]['proveedor']?></center></td>
 			<td><center><?php echo $registros[$j]['proveedor2']?></center></td>
 			<td><center><?php echo $registros[$j]['proveedor3']?></center></td>
 			<td><center><?php echo $registros[$j]['costo']?></center></td>
 			<td><center><?php echo $registros[$j]['precio']?></center></td>
 			<td>
 			  <form action="deleteRopa.php" method="POST">
 			   <?php if($registros[$j]['cantidad'] == '0'){ ?>
 			     <input type="hidden" name='codigo' value="<?php echo $registros[$j]['codigo'];?>" />
 			     <input type="submit" name="dl" value="Eliminar ">
 			   <?php }?> 
 			  </form>
 			      
 			       <form action="update.php" method="POST">
                     <input type="hidden" name='codigo' value="<?php echo $registros[$j]['codigo'];?>"/>
                     <input type="hidden" name='cantidad' value="<?php echo $registros[$j]['cantidad'];?>"/>
                     <input type="hidden" name='descripcion' value="<?php echo $registros[$j]['descripcion'];?>"/>
                     <input type="hidden" name='linea' value="<?php echo $registros[$j]['linea'];?>"/>
                     <input type="hidden" name='proveedor' value="<?php echo $registros[$j]['proveedor'];?>"/>
                     <input type="hidden" name='proveedor2' value="<?php echo $registros[$j]['proveedor2'];?>"/>
                     <input type="hidden" name='proveedor3' value="<?php echo $registros[$j]['proveedor3'];?>"/>
                     <input type="hidden" name='costo' value="<?php echo $registros[$j]['costo'];?>"/>
                     <input type="hidden" name='precio' value="<?php echo $registros[$j]['precio'];?>"/>
                     <input type="submit" name="modificar" value="Modificar" >
                   </form> 
              
            </td>
 	    </tr>
 		 
 	<?php }?>
</table>
</center>