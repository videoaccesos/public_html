<?php 	

require_once 'core.php';

//$sql = "SELECT brand_id, brand_name, brand_active, brand_status FROM brands WHERE brand_status = 1";
$sql = "SELECT idsolicitud, estado, fechainicio, nombresolicitante, telefono, correo, municipio, peticion, 
			   vinculacion, materia, anotaciones, seguimiento, apoyo, ultimaact FROM product";
$result = $connect->query($sql);

$output = array('data' => array());

if($result->num_rows > 0) { 

 // $row = $result->fetch_array();
 $active = ""; 

 while($row = $result->fetch_array()) {
 	$brandId = $row[0];
 	// active 
 	if($row[1] == 1) {
 		// Sin atender
 		$active = "<label class='label label-danger'>Pendiente</label>";
 	}
 	if ($row[1]== 2) {
 		// En seguimiento
 		$active = "<label class='label label-warning'>Seguimiento</label>";
 	}
 	if ($row[1]== 3) {	
 		// Concluida
 		$active = "<label class='label label-success'>Concluida</label>";
 	} // /else

 	$button = '<!-- Single button -->
	<div class="btn-group">
	  <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
	    Acción <span class="caret"></span>
	  </button>
	  <ul class="dropdown-menu">
	    <li><a type="button" data-toggle="modal" data-target="#editBrandModel" onclick="editBrands('.$brandId.')"> <i class="glyphicon glyphicon-edit"></i> Editar</a></li>
	    <li><a type="button" data-toggle="modal" data-target="#removeMemberModal" onclick="removeBrands('.$brandId.')"> <i class="glyphicon glyphicon-trash"></i> Eliminar</a></li>       
	  </ul>
	</div>';

 	$output['data'][] = array( 	
 		//folio solicitud	
 		$row[0], 	
 		//Estado		
 		$active,
 		// Fecha
 		date("d/m/Y", strtotime($row[2])),
 		//$row[2],
 		// nombre del solicitante
 		$row[3],
 		//telefono
 		$row[4],
 		//correo
 		$row[5],
 		//municipio
 		$row[6],
 		//peticion
 		$row[7],
 		//acciones
 		$button
 		); 	
 } // /while 

} // if num_rows

$connect->close();

echo json_encode($output);