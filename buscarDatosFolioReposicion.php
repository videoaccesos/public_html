<?php 
$host = "localhost";
$user = "wwwvideo_root";
$pass = "V1de0@cces0s";
$databaseName = "wwwvideo_video_accesos";
$con = mysql_connect($host,$user,$pass);
$dbs = mysql_select_db($databaseName, $con);

$folioReposicion=$_POST['folioReposicion'];
$folio="";
$seguro="";
$domicilio="";
$nombre="";
$tipoFolio="";
$privadaID="";

$consultaFolioReposicion= mysql_query("SELECT * FROM  reposiciones WHERE id_reposicion =$folioReposicion");
	while($registroConsultaFolioReposicion= mysql_fetch_array($consultaFolioReposicion)){
	$privadaID = $registroConsultaFolioReposicion['id_privada'];
	$nombre = $registroConsultaFolioReposicion['residente'];
	$domicilio = $registroConsultaFolioReposicion['domicilio'];
	$folio = $registroConsultaFolioReposicion['folio'];
	$numTarjetaVieja = $registroConsultaFolioReposicion['num_tarjeta_vieja'];
	$numTarjetaNueva = $registroConsultaFolioReposicion['num_tarjeta_nueva'];
	$motivo = $registroConsultaFolioReposicion['motivo'];
	$observaciones = $registroConsultaFolioReposicion['observaciones'];
}

if ($motivo == "Seguro")
{
$motivo= 1;
}
if ($motivo == "Garantía")
{
$motivo= 2;
}
if ($motivo == "Robo")
{
$motivo= 3;
}

$arrDatos= array(
               'privada'  =>  $privadaID,
               'nombre'  =>  $nombre,
               'domicilio'  =>  $domicilio,
               'folio'  =>  $folio,
               'numTarjetaVieja'  =>  $numTarjetaVieja,
               'numTarjetaNueva'  =>  $numTarjetaNueva,
               'motivo'  =>  $motivo,
               'observaciones'  =>  $observaciones
       		);

//$this->output->set_content_type('application/json')->set_output(json_encode($arrDatos));
echo json_encode($arrDatos);

?>