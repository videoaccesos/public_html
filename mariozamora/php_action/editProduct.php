<?php 	

require_once 'core.php';

$valid['success'] = array('success' => false, 'messages' => array());

if($_POST) {
  $productId 		= $_POST['productId'];
  $productName 		= $_POST['editProductName']; 
  $quantity 		= $_POST['editQuantity'];
  $rate 			= $_POST['editRate'];
  $brandName 		= $_POST['editBrandName'];
  $categoryName 	= $_POST['editCategoryName'];
  $productStatus 	= $_POST['editProductStatus'];

				
	$sql = "UPDATE product SET nombresolicitante = '$productName', brand_id = '$brandName', categories_id = '$categoryName', quantity = '$quantity', rate = '$rate', active = '$productStatus', estado = 1 WHERE idsolicitud = $productId ";

	if($connect->query($sql) === TRUE) {
		$valid['success'] = true;
		$valid['messages'] = "Actualizado exitosamente";	
	} else {
	 	$valid['success'] = false;
	 	$valid['messages'] = "Error no se ha podido actualizar";
	}

} // /$_POST
	 
$connect->close();

echo json_encode($valid);
 
