<?php 
$host = "localhost";
$user = "wwwvideo_root";
$pass = "V1de0@cces0s";
$databaseName = "wwwvideo_video_accesos";
$con = mysql_connect($host,$user,$pass);
$dbs = mysql_select_db($databaseName, $con);

$tarjetaAnterior=$_POST['tarjetaAnterior'];
$folio="";
$seguro="";
$domicilio="";
$nombre="";
$tipoFolio="";
$privadaID="";

$consultaTarjetaH= mysql_query("SELECT asignacion_id, seguro, folio_salida FROM residencias_residentes_tarjetas_detalle WHERE lectura='$tarjetaAnterior'");
while($registroConsultaTarjetaH= mysql_fetch_array($consultaTarjetaH)){
	$folio = $registroConsultaTarjetaH['asignacion_id'];
	$seguroH = $registroConsultaTarjetaH['seguro'];
	$folioSalida =$registroConsultaTarjetaH['folio_salida'];
	$tipoFolio = "H";
}

$consultaTarjetaB= mysql_query("SELECT asignacion_id, seguro, folio_salida FROM residencias_residentes_tarjetas_detalle_no WHERE lectura='$tarjetaAnterior'");
while($registroConsultaTarjetaB= mysql_fetch_array($consultaTarjetaB)){
	$folio = $registroConsultaTarjetaB['asignacion_id'];
	$folioSalida =$registroConsultaTarjetaB['folio_salida'];
	$tipoFolio = "B";
}

$consultaTarjetaB= mysql_query("SELECT asignacion_id, seguro, folio_salida FROM residencias_residentes_tarjetas_detalle_monte_carlo WHERE lectura='$tarjetaAnterior'");
while($registroConsultaTarjetaB= mysql_fetch_array($consultaTarjetaB)){
	$folio = $registroConsultaTarjetaB['asignacion_id'];
	$folioSalida =$registroConsultaTarjetaB['folio_salida'];
	$tipoFolio = "MC";
}

if ($tipoFolio == "H")
{
	$consultaDatosPersona= mysql_query("SELECT DISTINCT R.calle, R.nro_casa, P.privada_id, P.descripcion, RR.nombre, RR.ape_paterno, RR.ape_materno FROM residencias_residentes_tarjetas AS RRT INNER JOIN residencias_residentes as RR on RRT.residente_id = RR.residente_id INNER JOIN residencias as R on RR.residencia_id = R.residencia_id INNER JOIN privadas as P on R.privada_id = P.privada_id WHERE RRT.asignacion_id =$folio");
	while($registroConsultaDatosPersona= mysql_fetch_array($consultaDatosPersona)){
		$privadaID = $registroConsultaDatosPersona['privada_id'];
		$nombrePrivada = $registroConsultaDatosPersona['descripcion'];
		$nombre = $registroConsultaDatosPersona['nombre'].' '.$registroConsultaDatosPersona['ape_paterno'].' '.$registroConsultaDatosPersona['ape_materno'];
		$domicilio = $registroConsultaDatosPersona['calle'].' '.$registroConsultaDatosPersona['nro_casa'].' '.$registroConsultaDatosPersona['descripcion'];
	}
}

if ($tipoFolio == "B")
{
	$consultaDatosPersona= mysql_query("SELECT DISTINCT R.calle, R.nro_casa, P.privada_id, P.descripcion, RR.nombre, RR.ape_paterno, RR.ape_materno FROM residencias_residentes_tarjetas_no_renovacion AS RRT INNER JOIN residencias_residentes as RR on RRT.residente_id = RR.residente_id INNER JOIN residencias as R on RR.residencia_id = R.residencia_id INNER JOIN privadas as P on R.privada_id = P.privada_id WHERE RRT.asignacion_id =$folio");
	while($registroConsultaDatosPersona= mysql_fetch_array($consultaDatosPersona)){
		$privadaID = $registroConsultaDatosPersona['privada_id'];
		$nombre = $registroConsultaDatosPersona['nombre'].' '.$registroConsultaDatosPersona['ape_paterno'].' '.$registroConsultaDatosPersona['ape_materno'];
		$domicilio = $registroConsultaDatosPersona['calle'].' '.$registroConsultaDatosPersona['nro_casa'].' '.$registroConsultaDatosPersona['descripcion'];
	}
}

if ($tipoFolio == "MC")
{
	$consultaDatosPersona= mysql_query("SELECT DISTINCT R.calle, R.nro_casa, P.privada_id, P.descripcion, RR.nombre, RR.ape_paterno, RR.ape_materno FROM residencias_residentes_tarjetas_monte_carlo AS RRT INNER JOIN residencias_residentes as RR on RRT.residente_id = RR.residente_id INNER JOIN residencias as R on RR.residencia_id = R.residencia_id INNER JOIN privadas as P on R.privada_id = P.privada_id WHERE RRT.asignacion_id =$folio");
	while($registroConsultaDatosPersona= mysql_fetch_array($consultaDatosPersona)){
		$privadaID = $registroConsultaDatosPersona['privada_id'];
		$nombre = $registroConsultaDatosPersona['nombre'].' '.$registroConsultaDatosPersona['ape_paterno'].' '.$registroConsultaDatosPersona['ape_materno'];
		$domicilio = $registroConsultaDatosPersona['calle'].' '.$registroConsultaDatosPersona['nro_casa'].' '.$registroConsultaDatosPersona['descripcion'];
	}
}

$folioCompleto = $folio.' '.$tipoFolio;
$arrDatos= array(
               'folio'  =>  $folioCompleto,
               'tipoFolio' => $tipoFolio,
               'folioSalida' => $folioSalida,
               'privada'  =>  $privadaID,
               'nombrePrivada'  =>  $nombrePrivada,
               'nombre'  =>  $nombre,
               'seguro' => $seguroH,
               'domicilio'  =>  $domicilio
       		);

//$this->output->set_content_type('application/json')->set_output(json_encode($arrDatos));
echo json_encode($arrDatos);

?>