<?php
$host = "localhost";
$user = "wwwvideo_root";
$pass = "V1de0@cces0s";
$databaseName = "wwwvideo_monte_carlo";
$con = mysql_connect($host,$user,$pass);
$dbs = mysql_select_db($databaseName, $con);

$numeroFolio=$_POST['numeroFolio'];
$usuarioID=$_POST['usuarioID'];
$fecha= date("Y-m-d");

$sql = "UPDATE pagos_mantenimiento SET total=0, estatus_id =0, usuario_id='$usuarioID' WHERE pago_id = $numeroFolio";
$editarRegistro= mysql_query($sql);

echo json_encode($array);

?>