<?php 

  //--------------------------------------------------------------------------
  // Example php script for fetching data from mysql database
  //--------------------------------------------------------------------------
  $host = "localhost";
  $user = "wwwvideo_root";
  $pass = "V1de0@cces0s";

  $databaseName = "wwwvideo_video_accesos";
$privada=$_POST['privada'];
$numeroTarjeta=$_POST['numeroTarjeta'];
  //--------------------------------------------------------------------------
  // 1) Connect to mysql database
  //--------------------------------------------------------------------------
  $con = mysql_connect($host,$user,$pass);
  $dbs = mysql_select_db($databaseName, $con);

  //--------------------------------------------------------------------------
  // 2) Query database for data
  //--------------------------------------------------------------------------
$result = mysql_query("SELECT tipo_id,estatus_id,numero_serie FROM tarjetas WHERE lectura='$numeroTarjeta'");          //query
  $tipoTarjeta= mysql_fetch_row($result);    

if ($tipoTarjeta[0]== "1")
{
$result = mysql_query("SELECT precio_peatonal, vence_contrato FROM privadas WHERE descripcion = '$privada'");
  $array= mysql_fetch_row($result);   
} 

if ($tipoTarjeta[0]== "2")
{
$result = mysql_query("SELECT precio_vehicular, vence_contrato FROM privadas WHERE descripcion = '$privada'");
  $array= mysql_fetch_row($result);
}
  //--------------------------------------------------------------------------
  // 3) echo result as json 
  //--------------------------------------------------------------------------
array_push($array,$tipoTarjeta[1],$tipoTarjeta[2]);
  echo json_encode($array);

?>