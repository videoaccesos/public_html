<?php 
	
require('imprimirContrato/php/conexion.php');

$folio=$_POST["folio"];
$tipoFolio=$_POST['tipoFolio'];
$estatus=0;

$tarjeta1 = $_POST['tarjeta1'];
$tarjeta2 = $_POST['tarjeta2'];
$tarjeta3 = $_POST['tarjeta3'];
$tarjeta4 = $_POST['tarjeta4'];
$tarjeta5 = $_POST['tarjeta5'];

$numTarjetaVieja = $_POST['numTarjetaVieja'];
$numTarjetaNueva = $_POST['numTarjetaNueva'];

$tarjeta1VC = $_POST['tarjeta1VC'];
$tarjeta2VC = $_POST['tarjeta2VC'];
$tarjeta3VC = $_POST['tarjeta3VC'];
$tarjeta4VC = $_POST['tarjeta4VC'];
$tarjeta5VC = $_POST['tarjeta5VC'];
$tarjeta6VC = $_POST['tarjeta6VC'];
$tarjeta7VC = $_POST['tarjeta7VC'];
$tarjeta8VC = $_POST['tarjeta8VC'];
$tarjeta9VC = $_POST['tarjeta9VC'];
$tarjeta10VC = $_POST['tarjeta10VC'];


if ($tipoFolio == 1)
{
$registro= mysql_query("UPDATE residencias_residentes_tarjetas SET estatus_id = '$estatus', precio=0 WHERE asignacion_id = '$folio'");

if ($tarjeta1 != "")
{
$registro1= mysql_query("UPDATE tarjetas SET estatus_id = 1 WHERE lectura= '$tarjeta1'");
}

if ($tarjeta2 != "")
{
$registro2= mysql_query("UPDATE tarjetas SET estatus_id = 1 WHERE lectura= '$tarjeta2'");
}

if ($tarjeta3 != "")
{
$registro3= mysql_query("UPDATE tarjetas SET estatus_id = 1 WHERE lectura= '$tarjeta3'");
}

if ($tarjeta4 != "")
{
$registro4= mysql_query("UPDATE tarjetas SET estatus_id = 1 WHERE lectura= '$tarjeta4'");
}

if ($tarjeta5 != "")
{
$registro5= mysql_query("UPDATE tarjetas SET estatus_id = 1 WHERE lectura= '$tarjeta5'");
}

}
if ($tipoFolio == 2)
{
$registro= mysql_query("UPDATE residencias_residentes_tarjetas_no_renovacion SET estatus_id = '$estatus', precio=0 WHERE asignacion_id = '$folio'");

if ($tarjeta1 != "")
{
$registro1= mysql_query("UPDATE tarjetas SET estatus_id = 1 WHERE lectura= '$tarjeta1'");
}

if ($tarjeta2 != "")
{
$registro2= mysql_query("UPDATE tarjetas SET estatus_id = 1 WHERE lectura= '$tarjeta2'");
}

if ($tarjeta3 != "")
{
$registro3= mysql_query("UPDATE tarjetas SET estatus_id = 1 WHERE lectura= '$tarjeta3'");
}

if ($tarjeta4 != "")
{
$registro4= mysql_query("UPDATE tarjetas SET estatus_id = 1 WHERE lectura= '$tarjeta4'");
}

if ($tarjeta5 != "")
{
$registro5= mysql_query("UPDATE tarjetas SET estatus_id = 1 WHERE lectura= '$tarjeta5'");
}

}
if ($tipoFolio == 3)
{
$registro= mysql_query("UPDATE reposiciones SET estatus = '$estatus' WHERE id_reposicion = '$folio'");

if ($numTarjetaVieja != "")
{
$registro1= mysql_query("UPDATE tarjetas SET estatus_id = 1 WHERE lectura= '$numTarjetaVieja'");
}

if ($numTarjetaNueva != "")
{
$registro2= mysql_query("UPDATE tarjetas SET estatus_id = 2 WHERE lectura= '$numTarjetaNueva'");
}

}
if ($tipoFolio == 4)
{
$registro= mysql_query("UPDATE folios_ventas_consignacion SET estatus = '$estatus' WHERE asignacion_id = '$folio'");

if ($tarjeta1VC != "")
{
$registro1= mysql_query("UPDATE tarjetas SET estatus_id = 1 WHERE lectura= '$tarjeta1VC'");
}

if ($tarjeta2VC != "")
{
$registro2= mysql_query("UPDATE tarjetas SET estatus_id = 1 WHERE lectura= '$tarjeta2VC'");
}

if ($tarjeta3VC != "")
{
$registro3= mysql_query("UPDATE tarjetas SET estatus_id = 1 WHERE lectura= '$tarjeta3VC'");
}

if ($tarjeta4VC != "")
{
$registro4= mysql_query("UPDATE tarjetas SET estatus_id = 1 WHERE lectura= '$tarjeta4VC'");
}

if ($tarjeta5VC != "")
{
$registro5= mysql_query("UPDATE tarjetas SET estatus_id = 1 WHERE lectura= '$tarjeta5VC'");
}

if ($tarjeta6VC != "")
{
$registro6= mysql_query("UPDATE tarjetas SET estatus_id = 1 WHERE lectura= '$tarjeta6VC'");
}

if ($tarjeta7VC != "")
{
$registro7= mysql_query("UPDATE tarjetas SET estatus_id = 1 WHERE lectura= '$tarjeta7VC'");
}

if ($tarjeta8VC != "")
{
$registro8= mysql_query("UPDATE tarjetas SET estatus_id = 1 WHERE lectura= '$tarjeta8VC'");
}

if ($tarjeta9VC != "")
{
$registro9= mysql_query("UPDATE tarjetas SET estatus_id = 1 WHERE lectura= '$tarjeta9VC'");
}

if ($tarjeta10VC != "")
{
$registro10= mysql_query("UPDATE tarjetas SET estatus_id = 1 WHERE lectura= '$tarjeta10VC'");
}

}
if ($tipoFolio == 5)
{
$registro= mysql_query("UPDATE residencias_residentes_tarjetas_monte_carlo SET estatus_id = '$estatus', precio=0 WHERE asignacion_id = '$folio'");

if ($tarjeta1 != "")
{
$registro1= mysql_query("UPDATE tarjetas SET estatus_id = 1 WHERE lectura= '$tarjeta1'");
}

if ($tarjeta2 != "")
{
$registro2= mysql_query("UPDATE tarjetas SET estatus_id = 1 WHERE lectura= '$tarjeta2'");
}

if ($tarjeta3 != "")
{
$registro3= mysql_query("UPDATE tarjetas SET estatus_id = 1 WHERE lectura= '$tarjeta3'");
}

if ($tarjeta4 != "")
{
$registro4= mysql_query("UPDATE tarjetas SET estatus_id = 1 WHERE lectura= '$tarjeta4'");
}

if ($tarjeta5 != "")
{
$registro5= mysql_query("UPDATE tarjetas SET estatus_id = 1 WHERE lectura= '$tarjeta5'");
}

}

?>
<html>
	<head>
		<title>Cancelar Folio</title>
	</head>
	<body>
		<center>	
			
			<?php if($tipoFolio>0){ ?>
				<h1>Folio cancelado correctamente</h1>
				<?php }else{ ?>
				<h1>Error al cancelar el folio</h1>		
			<?php	} ?>		
			
			<p></p>	
			
			<a href="../../syscbctlmonitoreo/procesos/asignaciontarjetas">Ir al inicio</a>
			
		</center>
	</body>
	</html>	