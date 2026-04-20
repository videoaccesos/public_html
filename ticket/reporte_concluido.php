<?php 
	
	require('conexion.php');

	$folio=$_POST['folio'];
	$detalleDiagnostico=$_POST['detalleDiagnostico'];
$diagnosticoID=$_POST['cmbDiagnosticos'];
$tiempo=$_POST['tiempo'];
	$query="UPDATE ordenes_servicio SET detalle_diagnostico = '$detalleDiagnostico', diagnostico_id='$diagnosticoID', tiempo='$tiempo', estatus_id=2 WHERE folio = '$folio' ";
	
	$resultado=$mysqli->query($query);
	
?>

<html>
	<head>
		<title>Concluir Reporte</title>
	</head>
	<body>
		<center>	
			
			<?php if($resultado>0){ ?>
				<h1>Reporte concluido correctamente</h1>
				<?php }else{ ?>
				<h1>Error al guardar el reporte</h1>		
			<?php	} ?>		
			
			<p></p>	
			
			<a href="index.php">Ir al inicio</a>
			
		</center>
	</body>
	</html>	