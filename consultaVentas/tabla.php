
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<link rel="stylesheet" type="text/css" href="../css/tabla.css" />

<center>
<table>
 <th>Fecha</th>
 
 <th>Codigo</th>
 
 <th>Descripcion</th>
 
 <th>Cantidad</th>
 
 <th>Costo</th>

 <th>Precio</th>

 <th>Total</th>
 
 <th></th>
 
 	<?php for($j=0; $j<$i; $j++){?>
 		<tr class"odd">
 			<td><center><?php echo $registros[$j]['fecha']?></center></td>
 			<td><center><?php echo $registros[$j]['codigo']?></center></td>
 			<td><center><?php echo $registros[$j]['descripcion']?></center></td>
 			<td><center><?php echo $registros[$j]['cantidadArt']?></center></td>
 			<td><center><?php echo $registros[$j]['costo']?></center></td>
 			<td><center><?php echo $registros[$j]['precio']?></center></td>
 			<td><center><?php echo $registros[$j]['total']?></center></td>
 			<td>
 			  <form action="delete.php" method="POST">
 			     <input type="hidden" name='id' value="<?php echo $registros[$j]['id'];?>" />
 			    <input type="submit" name="dl" value="Eliminar ">
 			  </form>
            </td>
 	    </tr>
 		 
 	<?php }?>
</table>

<br><br>

<table>
 <th>Costo</th>
 
 <th>Total</th>
 
 <th>Ganancias</th>
 	<?php 
 	$costo=0;
 	$total=0;
 	$ganacia=0;
 	for($j=0; $j<$i; $j++){
 	    $costo = $registros[$j]['costo'] + $costo;
 	    $total = $registros[$j]['total'] + $total;
 	    $ganancia = $total-$costo;
		if ($ganancia == 0 ) {
			echo 'SIN REGISTRO';
		}
	}
?>
	<tr class"odd">
		<td><center><?php echo $costo; ?></center></td>
		<td><center><?php echo $total; ?></center></td>
		<td><center><?php echo $ganancia; ?></center></td>
	</tr>

</table>

</center>

<?php  		
		
?>