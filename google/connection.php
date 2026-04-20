<?php
session_start();
$conn = mysql_connect("localhost","wwwvideo_root","V1de0@cces0s") or die(mysql_error());
$DB = mysql_select_db("wwwvideo_video_accesos",$conn) or die(mysql_error());
date_default_timezone_set('America/Mazatlan');
?>