<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

$conn = mysql_connect('127.0.0.1', 'wwwvideo_root', 'V1de0@cces0s');
if (!$conn) {
    die('Error de conexión: ' . mysql_error());
}

if (!mysql_select_db('wwwvideo_video_accesos', $conn)) {
    die('No se pudo seleccionar la base de datos: ' . mysql_error());
}

echo "¡Conexión exitosa!";
mysql_close($conn);
?>
