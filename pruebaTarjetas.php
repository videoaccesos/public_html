<?php
  $host = "localhost";
  $user = "wwwvideo_root";
  $pass = "V1de0@cces0s";
  $databaseName = "wwwvideo_video_accesos";
  $con = mysql_connect($host,$user,$pass);
  $dbs = mysql_select_db($databaseName, $con);

$rs = mysql_query("SELECT MAX(asignacion_id) AS id FROM residencias_residentes_tarjetas");
      if ($row = mysql_fetch_row($rs)) {
      $id = trim($row[0]);
}
      if (1!= 0)
      {
      $insert1 = "INSERT INTO residencias_residentes_tarjetas_detalle VALUES (0,$id,'1234','5678',0,200 )";          
      $finalInsert1= mysql_query($insert1);
      }

?>