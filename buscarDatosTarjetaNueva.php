<?php 
$host = "localhost";
$user = "wwwvideo_root";
$pass = "V1de0@cces0s";
$databaseName = "wwwvideo_video_accesos";
$con = mysql_connect($host,$user,$pass);
$dbs = mysql_select_db($databaseName, $con);

$tarjetaNueva=$_POST['tarjetaNueva'];

$consultaTarjetaH= mysql_query("SELECT estatus_id FROM tarjetas WHERE lectura='$tarjetaNueva'");
while($registroConsultaTarjetaH= mysql_fetch_array($consultaTarjetaH)){
	$estatus = $registroConsultaTarjetaH['estatus_id'];
}

$arrDatos= array(
               'estatus'  =>  $estatus
       		);

echo json_encode($arrDatos);

?>