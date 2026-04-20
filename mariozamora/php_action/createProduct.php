<?php 	

require_once 'core.php';

$valid['success'] = array('success' => false, 'messages' => array());

if($_POST) {	
	//nombre del solicitante
  	$productName 		= $_POST['productName'];
  	// $productImage 	= $_POST['productImage'];
  	// telefono 
  	$quantity 		= $_POST['quantity'];
  	// correo
  	$rate 			= $_POST['rate'];
  	// municipio
  	$productStatus 	= $_POST['productStatus'];
  	//$categoryName 	= $_POST['categoryName'];
  	// peticion
  	$brandName 		= $_POST['brandName'];



				
				$sql = "INSERT INTO product (nombresolicitante, telefono, correo, municipio, peticion, estado) 
				VALUES ('$productName', $quantity', '$rate', '$productStatus', '$brandName', 1)";

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