<!DOCTYPE html>
<html>
    <head>
		<meta charset="UTF-8" /> 
        <title>Alpa Bikini | Home</title>
        <link rel="stylesheet" type="text/css" href="../css/menu.css" />
        <link rel="stylesheet" type="text/css" href="../css/demo.css"/>
    </head>
    <body>
    
            <!-- BARRA DE ARRIBA -->
            <div class="codrops-top">
                <a href="../home.php">
                    <strong>&laquo; Home: </strong>Menu Princial
                </a>
                <span class="right">
                 <img width='170px' height='50px' src="../img/p.png">..
                </span>
            </div>
            
		  <ul class="ch-grid">
		  
			<li>
			  <div class="ch-item almacen-img-1">
			   <div class="ch-info">
			     <a href="accesorios.php"><h3>Accesorios</h3></a>
			     <p></p>
			   </div>
			  </div>
		    </li>
		    
		    <li>
		      <div class="ch-item almacen-img-2">
		         <div class="ch-info">
		          <a href="ropa.php"><h3>Ropa</h3></a>
		            <p></p>
		         </div>
			  </div>
		    </li>
		    
		     
		     <form class="buscador" action="buscador.php" method="POST">
		      <input type="number"  min="1" placeholder="Buscar Articulos con Codigo" name="buscar" required>
		       <button type="submit">BUSCAR</button>
		     </form>
		     
		    
		 </ul>	
    </body>
</html>