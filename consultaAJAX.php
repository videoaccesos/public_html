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

$nombreCliente=$_POST['cliente'];
  //--------------------------------------------------------------------------
  // 2) Query database for data
  //--------------------------------------------------------------------------
$bandera=0;
$queryNombre= mysql_query("SELECT nombre, apellido_paterno, apellido_materno FROM clientes");          //query 


while($registroNombre= mysql_fetch_array($queryNombre)){
if ($bandera==0)
{
$nombreCompleto = $registroNombre['nombre'].' '.$registroNombre['apellido_paterno'].' '.$registroNombre['apellido_materno'];
if($nombreCompleto == $nombreCliente)
{
$bandera=1;
$nombre=$registroNombre['nombre'];
$apellidoPaterno=$registroNombre['apellido_paterno'];
$apellidoMaterno=$registroNombre['apellido_materno'];
}
}
}

$result = mysql_query("SELECT cliente_id, rfc FROM clientes where nombre='$nombre' and apellido_paterno='$apellidoPaterno' and apellido_materno='$apellidoMaterno'");
  $array= mysql_fetch_row($result);
  //--------------------------------------------------------------------------
  // 3) echo result as json 
  //--------------------------------------------------------------------------
  echo json_encode($array);


?>