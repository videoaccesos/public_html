<?php 
	
	require('conexion.php');

	$folio=$_POST['folio'];
	$tecnico_id=$_POST['cmbTecnicos'];



	$query="UPDATE ordenes_servicio SET tecnico_id = '$tecnico_id' where folio = '$folio'";
	
	$resultado=$mysqli->query($query);
?>
<html>
	<head>
		<title>Asignar Reporte</title>
	</head>
	<body>
		<center>	
			
			<?php if($resultado>0){ ?>
				<h1>Reporte asignado correctamente</h1>
				<?php }else{ ?>
				<h1>Error al asignar el reporte</h1>		
			<?php	} ?>		
			
			<p></p>	
			
			<a href="index.php">Ir al inicio</a>
			
		</center>
	</body>
	</html>	