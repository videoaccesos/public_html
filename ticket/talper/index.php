<?php
	require('conexion.php');
	
	$query="SELECT Clave_Emp,Nombre,ApPaterno,ApMaterno,FecNac, Departamento, Sueldo FROM Empleados order by Nombre";
	
	$resultado=$mysqli->query($query);
	
?>

<html>
<link rel=StyleSheet href="estilos.css" type="text/css" media=screen>
	<head>
		
<script language="JavaScript">
function aviso(url){
if (!confirm("¿Está seguro que desea eliminar el registro? \nSi desea eliminarlo de click en 'Aceptar', de lo contrario de click en 'Cancelar'")) {
return false;
}
else {
document.location = url;
return true;
}
}
</script>
		<title>Index</title>
	</head>
	<body>
		<div name="divTabla" id="divTabla">
			<form action="nuevo.php" method="get" >
			<button type="submit"  name="botonNuevo" id="botonNuevo">Nuevo</button>
			</form>
		<table name"tabla" id="tabla" class="tabla" >
			<thead>
				<tr>
					<td colspan="5" name="encabezadoTabla" id="encabezadoTabla"><b>Lista de Empleados</b></td>
					<tr name="columnas "id="columnas">
					<td><b>Nombre Completo</b></td>
					<td><b>Fecha Nacimiento</b></td>
					<td><b>Departamento</b></td>
					<td><b>Sueldo</b></td>
					<td><b>Acciones</b></td>
					<tr>
				</tr>
				<tbody>
					<?php while($row=$resultado->fetch_assoc()){ ?>
						<tr>
							<td><?php echo $row['Nombre'], ' ', $row['ApPaterno'], ' ', $row['ApMaterno'];?>
							</td>
							<td>
								<?php echo $row['FecNac'];?>
							</td>
							<td>
								<?php if ($row['Departamento'] == '1')
								echo "Sistemas";
								elseif($row['Departamento'] == '2')
								{
									echo "Compras";
								}
								elseif($row['Departamento'] == '3')
								{
									echo "Mercadotecnia";
								}
								elseif($row['Departamento'] == '4')
								{
									echo "Recursos Humanos";
								}
								elseif($row['Departamento'] == '5')
								{
									echo "Dirección";
								}
								elseif($row['Departamento'] == '6')
								{
									echo "Bodegas";
								}
								?>
							</td>
							<td>
								<?php echo $row['Sueldo'];?>
							</td>
							<td><a href="modificar.php?Clave_Emp=<?php echo $row['Clave_Emp'];?>"><img src="images/editaUsuario.jpg"  alt="editar" weight="35px" height="35px" ></a> 
							
							<a href="javascript:;" onclick="aviso('eliminar.php?Clave_Emp=<?php echo $row['Clave_Emp'];?>'); return false;"><img src="images/eliminaUsuario.jpg" alt="eliminar"  weight="35px" height="35px" ></a></td>
							
						</tr>
					<?php } ?>
				</tbody>
			</table>
		</div>
		</body>
	</html>	
	
