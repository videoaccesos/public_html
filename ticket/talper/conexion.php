<?php
	
	
	$mysqli=new mysqli("localhost","videoacc_root","a1b2c3d4","videoacc_video_accesos"); //servidor, usuario de base de datos, contraseña del usuario, nombre de base de datos
	
	if(mysqli_connect_errno()){
		echo 'Conexion Fallida : ', mysqli_connect_error();
		exit();
	}
?>