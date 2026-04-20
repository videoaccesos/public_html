<?php 

$host = "localhost";
$user = "wwwvideo_root";
$pass = "V1de0@cces0s";
$databaseName = "wwwvideo_video_accesos";
$con = mysql_connect($host,$user,$pass);
$dbs = mysql_select_db($databaseName, $con);

$ocr=$_POST['ocr'];
$registroID=$_POST['registroID'];

$result6 = "UPDATE registros_accesos SET OCR='$ocr' WHERE registro_acceso_id=$registroID";          //query
  $final= mysql_query($result6);
  
echo $ocr." al id: ".$registroID;
?>