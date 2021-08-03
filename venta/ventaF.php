<!DOCTYPE html>
<?php 
/*
 * This file is part of the AlpaSoft package
 * 
 * (c) Ana Luz Cervantes <analuzcervantes.s@gmail.com>
 * 
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
*/
  $title= 'Alpa Bikini | Venta Realizada';
  include_once '../include/cabeza.inc.php'; 
    
  include '../include/data.inc.php';
  include '../include/conMysql.inc.php';
  include '../include/conDB.inc.php';

  if(!$conMysql){
    echo "<center><br><br><b>";
    echo '<font color="white">IMPOSIBLE ESTABLECER LA CONEXION A MYSQL';
    echo "</b></center>";
    exit();
  } 
  if(!$conDB){
    echo 'Imposibe abrir la base de datos';
  }
  
  $totalF=$_POST['totalF'];
  $recibido=$_POST['recibido'];
  $cambio=$_POST['cambio'];  
?>
  <br><br><br>
  
  <center>

    <table width="100%" border="0">
      <tbody>
        <tr>

          <td width="20%">
            <center>
              <pre2 style="font-size:24px">Total: $ <?php echo $totalF;?></pre2>
              <pre2 style="font-size:24px">Recibido: $ <?php echo $recibido;?></pre2>
              <pre2 style="font-size:24px">Cambio: $ <?php echo $cambio;?></pre2>
              <br><br><br>
              <a href="venta.php" role="button" class="btn btn-success" data-toggle="modal">
                REGRESAR A CAJA 
              </a>
            </center>
          </td>
         
          <center>
            <td width="30%">
              <embed src="ticket.php" width="400" height="450″ href="ticket.php">
              </embed>
            </td>
          </center>
        
        </tr>
      </tbody>
    </table>
 
  </center>
<?php 
    include_once '../include/pie.inc.php'; 
?>