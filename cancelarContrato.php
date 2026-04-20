<?php 
	
require('imprimirContrato/php/conexion.php');

$folio=$_POST["folio"];
$estatus=0;

$sql = "UPDATE residencias_residentes_tarjetas SET estatus_id = '$estatus', precio=0  WHERE asignacion_id= '$folio'";
								$result = mysql_query($sql);
?>

<html>
	<head>
		<title>Cancelar Contrato</title>
	</head>
	<body>
		<center>	
			
			<?php if($result >0){ ?>
				<h1>Contrato cancelado correctamente</h1>
				<?php }else{ ?>
				<h1>Error al cancelar el contrato</h1>		
			<?php	} ?>		
			
			<p></p>	
			
			<a href="../../app/procesos/asignaciontarjetas">Ir al inicio</a>
			
		</center>
	</body>
	</html>	