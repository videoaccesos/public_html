<?php 
	
	require('conexion.php');
	
	$claveEmpleado=$_GET['Clave_Emp'];
	
	$query="DELETE FROM Empleados WHERE Clave_Emp='$claveEmpleado'";
	
	$resultado=$mysqli->query($query);
	
?>

<html>
<link rel=StyleSheet href="estilos.css" type="text/css" media=screen>
	<head>
		<title>Eliminar empleado</title>
	</head>
	
	<body>
		<center>
			<?php 
				if($resultado>0){
				?>
				
				<h1>Empleado Eliminado</h1>
				
				<?php 	}else{ ?>
				
				<h1>Error al Eliminar Empleado</h1>
				
			<?php	} ?>
			<p></p>		
			
			<a href="index.php">Ir al inicio</a>
			
		</center>
	</body>
</html>