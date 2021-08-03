<?php
/*
 * This file is part of the AlpaSoft package
 * 
 * (c) Ana Luz Cervantes <analuzcervantes.s@gmail.com>
 * 
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
*/
$valido=true;

include 'include/data.inc.php';
include 'include/conMysql.inc.php';
include 'include/conDB.inc.php';

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
else {
	/*Entra solo si se presiona el boton entrar*/
    if(isset($_POST['entrar'])){

		$email = mysqli_real_escape_string($conDB, $_POST['usuario']);
		$contrasena = mysqli_real_escape_string($conDB, $_POST['password']);
		$contrasena = md5($contrasena);
		$consulta = "SELECT id, email,contrasena FROM user where email='$email' AND contrasena='$contrasena'";
		$result = mysqli_query($conDB, $consulta);

		if (mysqli_num_rows($result) > 0) {
			$valido=true;
			//guardamos en sesion el nombre del usuario 
			$_SESSION["usuario"]=$email;
			header("location:home.php?login=true");
		} else {
			if (!$result || isset($_GET['nologin']) ) {
				$valido=false;
			}
			$valido=false;
		}	
	}
}	
		/* NOTAS DE CAMBIOS SOLO PARA EL LOGIN

		1.- SE ACTUALIZO mysql_pconnect POR "mysqli" DEBIDO QUE LA 
		extensión fue declarada obsoleta en PHP 5.5.0 y eliminada en PHP 7.0.0

		2.- Se agrego Script para crear bases de datos automáticamente

		3.- Se cambio mysql por mysqli debido a que se que se consideran 
		obsoletas desde PHP 5 y fueron eliminadas en PHP 7, tambien se agrego
		criptografía MD5 para la constraseña, mejorando la seguridad. 

		DATOS PARA LOGIN:
			1.- ventas@alpabikini.com, alpabikini
			2.- test@gmail.com, 123
		
		*/
?>

<!DOCTYPE html>
<html>
    <head>
		<meta charset="UTF-8" />
		<title>Alpa Bikini | Iniciar Sesion</title>
        <link rel="stylesheet" type="text/css" href="css/style.css" />
		<style>	
			body {
				background: #7f9b4e url(img/3.jpg) no-repeat center top;
				-webkit-background-size: cover;
				-moz-background-size: cover;
				background-size: cover;
			}
			.container > header h1,
			.container > header h2 {
				color: #fff;
				text-shadow: 0 1px 1px rgba(0,0,0,0.7);
			}
		</style>
    </head>
    <body>
        <div class="container">
			
			<section class="main">
				<form class="form-4" method="post">
				    <p>
				        <img src="img/p.PNG" width='290' height='70'>
				        <?php 
						if ($valido==false){
				        	echo  '<p><font color="red">Asegúrate de usar la contraseña y tu cuenta correcta.</font></p>';
				        }
						?>
				        <label for="usuario">Usuario</label>
				        <input type="text" name="usuario" placeholder="Usuario" required>
				    </p>
				    <p>
				        <label for="password">Password</label>
				        <input type="password" name='password' placeholder="Password" required> 
				    </p>

				    <p>
				        <input type="submit" name="entrar" value="Iniciar Sesion">
				    </p>
				</form>
				   <?php 
				        date_default_timezone_set("America/Mazatlan");
				         $fecha=date('l jS \of F Y');?><br><?php
				         $hora=date('h:i:s A');
				          echo '<br><br><br><p ALIGN=right width="10"> 
				                 <font color="white" size="20px">';
				          echo $fecha;
				          echo '</p></font><p ALIGN=right width="200px"><font color="white" size="60px">';
				          echo $hora;
				          echo '</p></font>';
				    ?>​
			</section>
        </div>
<script type="text/javascript">
        $(document).ready(function() {

(function($) { $.InFieldLabels = function(label, field, options) { var base = this; base.$label = $(label); base.$field = $(field); base.$label.data("InFieldLabels", base); base.showing = true; base.init = function() { base.options = $.extend({}, $.InFieldLabels.defaultOptions, options); base.$label.css('position', 'absolute'); var fieldPosition = base.$field.position(); base.$label.css({ 'left': fieldPosition.left, 'top': fieldPosition.top }).addClass(base.options.labelClass); if (base.$field.val() != "") { base.$label.hide(); base.showing = false; }; base.$field.focus(function() { base.fadeOnFocus(); }).blur(function() { base.checkForEmpty(true); }).bind('keydown.infieldlabel', function(e) { base.hideOnChange(e); }).change(function(e) { base.checkForEmpty(); }).bind('onPropertyChange', function() { base.checkForEmpty(); }); }; base.fadeOnFocus = function() { if (base.showing) { base.setOpacity(base.options.fadeOpacity); }; }; base.setOpacity = function(opacity) { base.$label.stop().animate({ opacity: opacity }, base.options.fadeDuration); base.showing = (opacity > 0.0); }; base.checkForEmpty = function(blur) { if (base.$field.val() == "") { base.prepForShow(); base.setOpacity(blur ? 1.0 : base.options.fadeOpacity); } else { base.setOpacity(0.0); }; }; base.prepForShow = function(e) { if (!base.showing) { base.$label.css({ opacity: 0.0 }).show(); base.$field.bind('keydown.infieldlabel', function(e) { base.hideOnChange(e); }); }; }; base.hideOnChange = function(e) { if ((e.keyCode == 16) || (e.keyCode == 9)) return; if (base.showing) { base.$label.hide(); base.showing = false; }; base.$field.unbind('keydown.infieldlabel'); }; base.init(); }; $.InFieldLabels.defaultOptions = { fadeOpacity: 0.5, fadeDuration: 300, labelClass: 'infield' }; $.fn.inFieldLabels = function(options) { return this.each(function() { var for_attr = $(this).attr('for'); if (!for_attr) return; var $field = $("input#" + for_attr + "[type='text']," + "input#" + for_attr + "[type='password']," + "input#" + for_attr + "[type='tel']," + "input#" + for_attr + "[type='email']," + "textarea#" + for_attr); if ($field.length == 0) return; (new $.InFieldLabels(this, $field[0], options)); }); }; })(jQuery);


        							$("#RegisterUserForm label").inFieldLabels();
								   });

  </script>
    </body>
</html>