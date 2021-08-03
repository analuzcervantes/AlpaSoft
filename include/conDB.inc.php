<?php
/*
 * This file is part of the AlpaSoft package
 * 
 * (c) Ana Luz Cervantes <analuzcervantes.s@gmail.com>
 * 
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
*/
    //establecer la conexion con base de datos 
    $conDB = new mysqli($host, $usuario, $contra, $db);
    
    if (!$conDB) {
        die("Connection failed: " . mysqli_connect_error());
    }

?>