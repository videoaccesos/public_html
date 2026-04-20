<?php 	

require_once 'core.php';

$valid['success'] = array('success' => false, 'messages' => array());

if($_POST) {	

  $vinculacion 	= $_POST['vinculacion'];
  $materia		= $_POST['materia'];
  $anotaciones	= $_POST['anotaciones'];
  $seguimiento	= $_POST['seguimiento'];
  $requerimiento= $_POST['requerimiento'];
  $brandStatus  = $_POST['editBrandStatus']; 
  $hoy			= date('Y-m-d'); 
  $brandId 		= $_POST['brandId'];

	$sql = "UPDATE product SET vinculacion = '$vinculacion', materia = '$materia', anotaciones ='$anotaciones', seguimiento ='$seguimiento', apoyo ='$requerimiento', estado = '$brandStatus', ultimaact = '$hoy' WHERE idsolicitud = '$brandId'";

	if($connect->query($sql) === TRUE) {
	 	$valid['success'] = true;
		$valid['messages'] = "Actualizado exitosamente";	
	} else {
	 	$valid['success'] = false;
	 	$valid['messages'] = "Error no se ha podido actualizar";
	}
	 
	$connect->close();

	echo json_encode($valid);
 
} // /if $_POST