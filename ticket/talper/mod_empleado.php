<?php 
	
	require('conexion.php');
	
	$claveEmpleado=$_POST['Clave_Emp'];
	$nombre=$_POST['Nombre'];
	$apellidoMaterno=$_POST['ApMaterno'];
	$apellidoPaterno=$_POST['ApPaterno'];
	$fechaNacimiento=$_POST['FecNac'];
	$departamento=$_POST['Departamento'];
	$sueldo=$_POST['Sueldo'];
	
	
	$query="UPDATE Empleados SET Nombre='$nombre', ApPaterno='$apellidoPaterno', ApMaterno='$apellidoMaterno', FecNac='$fechaNacimiento', Departamento='$departamento', Sueldo='$sueldo' WHERE Clave_Emp='$claveEmpleado'";
	
	$resultado=$mysqli->query($query);
	
?>

<html>
<link rel=StyleSheet href="estilos.css" type="text/css" media=screen>
	<head>
		<title>Modificar empleado</title>
	</head>
	
	<body>
		<center>
			
			<?php 
				if($resultado>0){
				?>
				
				<h1>Empleado Modificado</h1>
				
					<?php 	}else{ ?>
				
				<h1>Error al Modificar Empleado</h1>
				
			<?php	} ?>
			
			<p></p>	
			
			<a href="index.php">Ir al inicio</a>
			
		</center>
	</body>
</html>
				
				