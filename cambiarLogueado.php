<?php 

$host = "localhost";
$user = "wwwvideo_root";
$pass = "V1de0@cces0s";
$databaseName = "wwwvideo_video_accesos";
$con = mysql_connect($host,$user,$pass);
$dbs = mysql_select_db($databaseName, $con);

$logueado=$_POST['logueado'];
$usuario=$_POST['usuario'];
$usuarioID=$_POST['usuarioID'];

$result6 = "UPDATE usuarios SET ultima_sesion=CURRENT_TIMESTAMP, logueado = $logueado WHERE usuario='$usuario'";          //query
  $final= mysql_query($result6);

if ($logueado == 0)
{
$result7 = "UPDATE bitacora_inicio SET cierre_sesion=CURRENT_TIMESTAMP WHERE usuario_id= $usuarioID";          //query
  $final= mysql_query($result7);
}
  //--------------------------------------------------------------------------
  // 3) echo result as json 
  //--------------------------------------------------------------------------
  echo json_encode($array);

?>