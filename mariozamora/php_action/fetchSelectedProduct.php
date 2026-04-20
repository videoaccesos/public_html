<?php 	
//realizamos la busqueda de la solicitud seleccionada
require_once 'core.php';

$productId = $_POST['productId'];

$sql = "SELECT idsolicitud, product_name, product_image, brand_id, categories_id, quantity, rate, active, status FROM product WHERE idsolicitud = $productId";
$result = $connect->query($sql);

if($result->num_rows > 0) { 
 $row = $result->fetch_array();
} // if num_rows

$connect->close();

echo json_encode($row);