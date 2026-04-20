<?php
  $host = "localhost";
  $user = "wwwvideo_root";
  $pass = "V1de0@cces0s";
  $databaseName = "wwwvideo_monte_carlo";
  $residenciaID=$_POST['residenciaID'];

  $con = mysql_connect($host,$user,$pass);
  $dbs = mysql_select_db($databaseName, $con);

$result = mysql_query("SELECT fecha_ultimo_pago, fecha_cubierta FROM residencias WHERE residencia_id = $residenciaID");
$array= mysql_fetch_row($result);

array_push($array);
echo json_encode($array);

?>