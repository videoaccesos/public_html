<?php 	

//require_once 'core.php';

$valid['success'] = array('success' => false, 'messages' => array());

if($_POST) {	

  $brandName 	= $_POST['brandName'];
  $brandStatus  = $_POST['brandStatus']; 
  $telefono		= $_POST['telefono']; 
  $correo		= $_POST['correo']; 
  $peticion		= $_POST['peticion'];
  $hoy			= date('Y-m-d'); 

  	$sql = "INSERT INTO product (nombresolicitante, telefono, correo, municipio, peticion, fechainicio, ultimaact, estado) VALUES ('$brandName', '$telefono', '$correo', '$brandStatus', '$peticion', '$hoy', '$hoy', 1)";

	if($connect->query($sql) === TRUE) {
	 	$valid['success'] = true;
		$valid['messages'] = "Creado exitosamente";	
	} else {
	 	$valid['success'] = false;
	 	$valid['messages'] = "Error no se ha podido guardar";
	}
	 

	$connect->close();

	echo json_encode($valid);
 
} // /if $_POST