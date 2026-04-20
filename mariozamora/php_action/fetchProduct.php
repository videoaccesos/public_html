<?php 	

require_once 'core.php';
// cargamos Solicitudes
$sql = "SELECT product.idsolicitud, product.nombresolicitante, product.municipio,   product.vinculacion,
 			   product.telefono,    product.correo,            product.materia,     product.peticion,
 		       product.fechainicio, product.anotaciones,       product.estado,         product.seguimiento,  
 		       product.ultimaact,   product.apoyo FROM product";

$result = $connect->query($sql);

$output = array('data' => array());
		
if($result->num_rows > 0) { 

 // $row = $result->fetch_array();
 $active = ""; 

 while($row = $result->fetch_array()) {
 	$productId = $row[0];
 	// Revisar estatus
 	if($row[10] == 1) {
 		// Sin atender
 		$active = "<label class='label label-danger'>Pendiente</label>";
 	}
 	if ($row[10]== 2) {
 		// En seguimiento
 		$active = "<label class='label label-warning'>Seguimiento</label>";
 	}
 	if ($row[10]== 3) {	
 		// Concluida
 		$active = "<label class='label label-success'>Concluida</label>";
 	} // /else

 	$button = '<!-- Single button -->
	<div class="btn-group">
	  <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
	    Acción <span class="caret"></span>
	  </button>
	  <ul class="dropdown-menu">
	    <li><a type="button" data-toggle="modal" id="editProductModalBtn" data-target="#editProductModal" onclick="editProduct('.$productId.')"> <i class="glyphicon glyphicon-edit"></i> Editar</a></li>
	    <li><a type="button" data-toggle="modal" data-target="#removeProductModal" id="removeProductModalBtn" onclick="removeProduct('.$productId.')"> <i class="glyphicon glyphicon-trash"></i> Eliminar</a></li>       
	  </ul>
	</div>';

	// $brandId = $row[3];
	// $brandSql = "SELECT * FROM brands WHERE brand_id = $brandId";
	// $brandData = $connect->query($sql);
	// $brand = "";
	// while($row = $brandData->fetch_assoc()) {
	// 	$brand = $row['brand_name'];
	// }

	// $brand = $row[9];
	// $category = $row[10];

	// $imageUrl = substr($row[2], 3);
	// $productImage = "<img class='img-round' src='".$imageUrl."' style='height:30px; width:50px;'  />";

 	$output['data'][] = array( 		
 		// Id solicitud
 		$productId,
 		// Estatus
 		$active,
 		// Fecha inicio
 		$row[8],
 		// Nombre solicitante
 		$row[1], 
 		//Telefono
 		$row[5],
 		// Correo
 		$row[6],
 		// Municipio 
 		$row[2],
		// Petición
 		$row[7],
 	// 	// Vinculación
		// $row[3],
 	// 	// Materia
		// $row[6],
 		// Boton de acciones
 		$button 		
 		); 	
 } // /while 

}// if num_rows

$connect->close();

echo json_encode($output);