<?php 
/*
 * This file is part of the AlpaSoft package
 * 
 * (c) Ana Luz Cervantes <analuzcervantes.s@gmail.com>
 * 
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
*/

include '../include/data.inc.php';
include '../include/conMysql.inc.php';

if(isset($_POST['Instalar'])){
    
    if (!$conMysql) {
        die("Error: Fallo al conectarse a MySQL " . mysqli_connect_error());
    } 
    else {
        //crea base de datos si no existe 
	    $dbSQL = "CREATE DATABASE IF NOT EXISTS ".$db." CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci";
        if ($conMysql->query($dbSQL) === FALSE){
			return true;
		}

        include '../include/conDB.inc.php';

        /** USUARIO */
        //crea tabla usuario, necesaria para login
        $userTable = "CREATE TABLE IF NOT EXISTS user (
            id bigint(20) UNSIGNED NOT NULL,
            email varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
            contrasena varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
            user_name varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
            user_lastname varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
            registered datetime NOT NULL,
            PRIMARY KEY (id),
            UNIQUE KEY email (email)
        ) ENGINE=InnoDB DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci";
        //crea tabla de "user", necesaria para login
	    //CUIDADO AL MODIFOCAR, SE RECOMIENDA INGRESAR LOS DATOS DIRECTAMENTE DESDE phpMyAdmin y contrasena como MD5 
	    if ($conDB->query($userTable) === TRUE) {
		    $userValues = "INSERT user VALUES 
                (1, 'ventas@alpabikini.com', 'f4bd6b4635683153c4a3b3b3d49a1221', 'Alpa', 'Bikini', '2021-05-20 06:30:13'),
                (2, 'test@gmail.com', '202cb962ac59075b964b07152d234b70', 'Test', 'Test', '2021-05-20 06:40:10');";
		    $result = mysqli_query($conDB,$userValues);
	    } else {
		    echo "Error al crear la tabla: " . $conDB->error;
	    }

        /** ARTICULOS */
        //crea tabla articulos
	    $articulosTable = "CREATE TABLE IF NOT EXISTS articulos (
            codigo varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
            cantidad int(10) NOT NULL,
            descripcion varchar(1000) COLLATE utf8mb4_unicode_ci NOT NULL,
            linea varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
            proveedor varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
            proveedor2 varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
            proveedor3 varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
            costo decimal(10,0) NOT NULL,
            precio decimal(10,0) NOT NULL,
            PRIMARY KEY (codigo)
	    ) ENGINE=InnoDB DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci";
        //ingresa datos a tabla articulos
	    if ($conDB->query($articulosTable) === TRUE) {
		    $articulosValues = "INSERT articulos VALUES 
			    ('032103', 33, 'Bañador bikini halter con tira cruzada de canalé', 'Ropa', 'Elisa Aguila', 'Horizonte', 'Shein', '292.0', '400.0'),
                ('232101', 5, 'Bañador bikini de cintura alta fruncido tropical', 'Ropa', 'Industrias Zelina', 'Orvar', 'Perla Negra', '99.00', '292.0'),
                ('320022', 15, 'Bikini floral top de espalda con cordón bajo hanky', 'Ropa', 'Liverpool', 'Orvar', 'Perla Negra', '317.0', '560.0'),
                ('232011', 20, 'EMERY ROSE Bañador bikini bajo fruncido con estampado de cadena', 'Ropa', 'Liverpool', 'Orvar', 'Horizonte', '240.0', '420.0'),
                ('232010', 40, 'Bañador bikini bajo hanky floral', 'Ropa', 'Shein', 'Orvar', 'Horizonte', '290.0', '600.0'),
                ('169631', 19, 'Conjunto de visor y snorkel para niños de vidrio templado', 'Accesorios', 'Amazon', 'Wave', 'Marfed', '200.0', '472.67'),
                ('874840', 23, 'Lentes de sol Hypson para hombre', 'Accesorios', 'Hypson', '', '', '347.0', '472.0'),
                ('262427', 18, 'Tabla de surf de dibujos animados', 'Accesorios', 'Kickboard', 'Surf Stuff', '', '116.0', '350.0'),
                ('620157', 7, 'Piscina inflable con estampado de cisne', 'Accesorios', 'Swan', 'Wave', 'Marfed', '489.0', '899.0'),
                ('131696', 29, 'Bloqueador solar Caribbean Beach FPS 50', 'Accesorios', 'Caribbean Beach', 'Walmart', '', '35.0', '79.0');";
		    $result = mysqli_query($conDB,$articulosValues);
	    } else {
		    echo "Error al crear la tabla: " . $conDB->error;
	    }

        /** EMPRESA */
        //crea tabla empresa, necesaria para tikect
        $empresaTable = "CREATE TABLE IF NOT EXISTS empresa (
            nombre varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
            rfc varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
            direccion varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
            telefono varchar(13) COLLATE utf8mb4_unicode_ci NOT NULL,
            PRIMARY KEY (rfc)
	    ) ENGINE=InnoDB DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci";
        //ingresa datos a tabla empresa
        if ($conDB->query($empresaTable) === TRUE) {
		    $empresaValues = "INSERT empresa VALUES 
			    ('Alpa Bikini', '4LP481K1N1 493', 'Av Camarón Sábalo 326, Zona Dorada, 82110 Mazatlán, Sin.', '669 113 00 00')";
		    $result = mysqli_query($conDB,$empresaValues);
	    } else {
		    echo "Error al crear la tabla: " . $conDB->error;
	    }

        /** PROVEEDORES */
        //crea tabla proveedores
	    $proveedoresTable = "CREATE TABLE IF NOT EXISTS proveedores (
            id bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
            nombre varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
            direccion varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
            pais varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
            ciudad varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
            telefono varchar(16) COLLATE utf8mb4_unicode_ci NOT NULL,
            celular varchar(16) COLLATE utf8mb4_unicode_ci NOT NULL,
            email varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
            PRIMARY KEY (id)
	    ) ENGINE=InnoDB DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci";
        //ingresa datos a tabla proveedores
	    if ($conDB->query($proveedoresTable) === TRUE) {
		    $proveedoresValues = "INSERT proveedores VALUES 
			    ('', 'Alpa Bikini', 'Av Camarón Sábalo 326, Zona Dorada, 82110 Mazatlán, Sin.', 'Mexico', 'Mazatlán', '669 113 00 00', '669 113 00 00', 'ventas@alpabikini.com'),
			    ('', 'Alco Distribuciones', 'Polígono de Pocomaco A2 14/15 15190 A Coruña', 'España', 'Coruña', '+34 981 13 16 00', '+34 981 13 16 00', 'ventas@alcodistribuciones.com'),
			    ('', 'Kay Internacional', 'San Jerónimo, Núm. 550, Col. Jardines del Pedregal, Del. Álvaro Obregón, C.P. 01900', 'Mexico', 'Ciudad de México', '(222) 281 0393', '01 800 347 4020', 'dirplanta@kayinternacional.com'),
			    ('', 'Arktual', 'Tecoyotitla # 260 Álvaro Obregón', 'Mexico', 'Ciudad de México', '55 8526 5948', '', 'ventas@arktual.com'),
			    ('', 'Gimbel Mexicana', 'Avenida De Las Granjas 388', 'Mexico', 'Ciudad de México', '55 5791 2837', '', 'contacto@gimbelmexicana.com'),
			    ('', 'Recologic', 'Privada, Del Rincón 115, 20908 Los Arenales', 'Mexico', 'Aguascalientes', '+52 44 9973 6405', '', 'ventas@recologic.mx');";
		    $result = mysqli_query($conDB,$proveedoresValues);
	    } else {
		    echo "Error al crear la tabla: " . $conDB->error;
	    }

        /** CAJA */
        $cajaTable = "CREATE TABLE IF NOT EXISTS caja (
            codigo varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
            descripcion varchar(1000) COLLATE utf8mb4_unicode_ci NOT NULL,
            cantidad int(10) NOT NULL,
            cantidadArt int(10) NOT NULL,
            costo int(10) NOT NULL,
            precio int(10) NOT NULL,
            total int(10) NOT NULL,
            PRIMARY KEY (codigo)
	    ) ENGINE=InnoDB DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci";
        
        
        /** VENTAS */
        $ventasTable = "CREATE TABLE IF NOT EXISTS ventas (
            id int(20) NOT NULL,
            fecha date NOT NULL,
            codigo varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
            descripcion varchar(1000) COLLATE utf8mb4_unicode_ci NOT NULL,
            cantidadArt int(10) NOT NULL,
            costo int(10) NOT NULL,
            precio int(10) NOT NULL,
            total int(10) NOT NULL
          ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci";
        
        
        
        if (($conDB->query($userTable) === TRUE) && ($conDB->query($articulosTable) === TRUE) && ($conDB->query($empresaTable) === TRUE) && ($conDB->query($proveedoresTable) === TRUE) && ($conDB->query($cajaTable) === TRUE) && ($conDB->query($ventasTable) === TRUE)) {
            echo '<section class="main">
                    <header>
                        <h1>BASE DE DATOS CREADA CON EXITO!</h1>
                    </header>
                </section>';
        } 
        else {
            echo "Error al crear la tabla: " . $conDB->error;
        }
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8" />
	<title>Alpa Bikini | Inistalar</title>
    <link rel="stylesheet" type="text/css" href="../css/style.css" />
		<style>	
			body {
				background: #7f9b4e;
			}
            .container {
                width: 100%;
                height: 100%;
                display: grid;
                place-items: center;
                position: absolute;
            }
            .container::before {
                content: "";
                top: 0;
                left: 0;
                width: 100%;
                height: 100%;
                position: absolute;
                filter: brightness(0.8) saturate(0.8);
                background-size: cover;
                -moz-background-size: cover;
                -webkit-background-size: cover;
                background-image: url(../img/3.jpg);
            }
            header h1 {
                text-align: center;
                position: relative;
                color: #fff;
                text-shadow: 0 1px 1px rgba(0,0,0,0.7);
			}
		</style>
    </head>
    <body>
        <div class="container">
            <section class="main">
                <header>
                    <h1>Instalar base de datos</h1>
                </header>
                <form class="form-4" method="post">
                    <input type="submit" name="Instalar" value="Instalar">
                </form>
            </section>
        </div>
    </body>
</html>