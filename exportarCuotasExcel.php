<?php
$server     = 'localhost';
$username   = 'wwwvideo_root';
$password   = 'V1de0@cces0s';
$database   = 'wwwvideo_monte_carlo'; 
 
$fechaInicial=$_POST['fechaInicial'];
$fechaFinal=$_POST['fechaFinal'];
$usuarioID=$_POST['cmbUsuarios'];
$totalCuotas=0;

if ($usuarioID!=0)
{
$consultaUsuarioMantenimiento=' AND PM.usuario_id ='.$usuarioID;
$consultaUsuarioGasto=' AND G.usuario_id ='.$usuarioID;
}

$conexion = @new mysqli($server, $username, $password, $database);
 
if ($conexion->connect_error)
{
    die('Error de conexi贸n: ' . $conexion->connect_error);
}

$sql="SELECT DISTINCT PM.pago_id,PM.residente_id,PM.meses,PM.fecha_ultimo_pago,PM.fecha_cubierta,PM.total,PM.descuento,PM.tipo_pago,PM.fecha_modificacion, U.usuario,PM.estatus_id,RR.nombre,RR.ape_paterno,RR.ape_materno FROM pagos_mantenimiento AS PM INNER JOIN residencias_residentes AS RR ON RR.residente_id = PM.residente_id INNER JOIN usuarios as U on U.usuario_id = PM.usuario_id WHERE PM.fecha_modificacion >= '$fechaInicial' and PM.fecha_modificacion <= '$fechaFinal' $consultaUsuarioMantenimiento ORDER BY PM.pago_id";
$resultado = $conexion->query($sql);

$sql5="SELECT TG.gasto, G.descripcion_gasto,G.comprobante,G.total, (CASE G.tipo_pago WHEN 1 THEN 'Efectivo' WHEN 2 THEN 'Bancos' END ) AS tipopago, (CASE TG.tipo_gasto WHEN 1 THEN 'Fijo' WHEN 2 THEN 'Variable' END ) AS tipo_gasto, G.fecha, U.usuario FROM gastos as G INNER JOIN tipos_gastos as TG on G.tipo_gasto = TG.gasto_id LEFT JOIN usuarios as U on G.usuario_id = U.usuario_id WHERE G.estatus_id=1 AND G.fecha >= '$fechaInicial 00:00:01' AND G.fecha <= '$fechaFinal 23:59:59' $consultaUsuarioGasto ORDER BY G.fecha ASC";
$resultado5 = $conexion->query($sql5);

$conexion->close(); //cerramos la conexi璐竛
header("Content-Type: application/vnd.ms-excel");
header("Expires: 0");
header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
header("content-disposition: attachment;filename=reporte_cuotas.xls");
?>
<html>
<head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>Reportes de Finanzas MC</title>
<style>
body {

    background-image: url('imagenes/bgFondoMC.png');
    background-size: cover;
    font-family: Montserrat;
}

a{
font-size:14px;
font-weight:bold;
color:#0431B4;
}

.logo {
    width: 250px;
    height: 70px;
    background: url('imagenes/logoMC.png') no-repeat;
    margin: 30px auto;
}

.login-block {
    width: 80%;
    padding: 7px 20px 7px 20px;
    background: #fff;
    border-radius: 5px;
    border-top: 7px solid #8c0d1b;
    margin: 0 auto;
    margin-bottom:20px;
}

.login-block h1 {
    text-align: center;
    color: #000;
    font-size: 18px;
    text-transform: uppercase;
    margin-top: 0;
    margin-bottom: 18px;
}

.login-block input {
    width: 100%;
    height: 34px;
    box-sizing: border-box;
    border-radius: 5px;
    border: 1px solid #ccc;
    margin-bottom: 20px;
    font-size: 14px;
    font-family: Montserrat;
    padding: 0 20px 0 50px;
    outline: none;
}
.login-block select {
    width: 100%;
    height: 34px;
    box-sizing: border-box;
    border-radius: 5px;
    border: 1px solid #ccc;
    margin-bottom: 20px;
    font-size: 14px;
    font-family: Montserrat;
    padding: 0 20px 0 50px;
    outline: none;
}

.login-block input:active, .login-block input:focus {
    border: 1px solid #8c0d1b;
}

#enviarDatos{
    width: 100%;
    height: 40px;
    background: #8c0d1b;
    box-sizing: border-box;
    border-radius: 5px;
    border: 1px solid #8c0d1b;
    border-color:white;
    color: #fff;
    font-weight: bold;
    text-transform: uppercase;
    font-size: 14px;
    font-family: Montserrat;
    outline: none;
    cursor: pointer;
}

#tabla{
width:100%;
height:100%;
}

</style>
</head>

<body>

<div class="logo"></div>
<div class="login-block">
<form name="consulta_reporte" method="POST" action="#" target="_blank" >
    <h3 style="text-align:center;color:#8c0d1b">Cuotas de Mantenimiento</h3>
<br>
<table name"tabla" id="tabla" class="tabla" border="1px" style="color:black;text-align: center;" bordercolor="#8c0d1b" >
            <thead style="text-align: center; background-color:#8c0d1b">
                <tr>
                    <tr name="columnas "id="columnas" style="font-size:16px;">
<?php 
    echo "<td style='text-align: center; padding:5px'><b>Folio</b></td>";
    echo "<td style='text-align: center; padding:5px'><b>Nombre</b></td>";
    echo "<td style='text-align: center; padding:5px'><b>Meses</b></td>";
    echo "<td style='text-align: center; padding:5px'><b>Total</b></td>";
    echo "<td style='text-align: center; padding:5px'><b>Descuento</b></td>";
    echo "<td style='text-align: center; padding:5px'><b>Tipo Pago</b></td>";
    echo "<td style='text-align: center; padding:5px'><b>Estatus</b></td>";
    echo "<td style='text-align: center; padding:5px'><b>Fecha</b></td>";
    echo "<td style='text-align: center; padding:5px'><b>Usuario</b></td>";
?>
                    <tr>
                </tr>
<tbody style="background-color:white; color:black;font-size:12px;">
    <?php for($i=1;$row=$resultado->fetch_assoc();$i++){ ?>
        <tr>
<?php

    echo "<td style='text-align: center; padding:5px'>";
    echo utf8_decode($row['pago_id'].' M');
    echo "</td>";
    echo "<td style='text-align: center; padding:5px'>";
    echo utf8_decode($row['nombre'].' '.$row['ape_paterno'].' '.$row['ape_materno']);
    echo "</td>";
   
    echo "<td style='text-align: center; padding:5px'>";
    echo utf8_decode($row['meses']);
    echo "</td>";

    echo "<td style='text-align: center; padding:5px'>";
    echo utf8_decode('$'.number_format($row['total'], 2, '.', ','));
    $totalCuotas = $totalCuotas+$row['total'];
    echo "</td>";
    
    echo "<td style='text-align: center; padding:5px'>";
    echo utf8_decode('$'.number_format($row['descuento'], 2, '.', ','));
    echo "</td>";
   
    echo "<td style='text-align: center; padding:5px'>";
    if ($row['tipo_pago']==1)
    {
    $tipoPago= "Efectivo";
    $ventasEfectivo = $ventasEfectivo + $row['total'];
    }
    if ($row['tipo_pago']==2)
    {
    $tipoPago= "Bancos";
    $ventasBancos = $ventasBancos + $row['total'];
    }
    echo utf8_decode($tipoPago);
    echo "</td>";
    
    echo "<td style='text-align: center; padding:5px'>";
    if ($row['estatus_id']==1)
    {
    $estatus= "Activo";
    }
    if ($row['estatus_id']==0)
    {
    $estatus= "Cancelado";
    }
    echo utf8_decode($estatus);
    echo "</td>";

    echo "<td style='text-align: center; padding:5px'>";
    echo utf8_decode($row['fecha_modificacion']);
    echo "</td>";

    echo "<td style='text-align: center; padding:5px'>";
    echo utf8_decode($row['usuario']);
    echo "</td>";

?>
        </tr>
    <?php } ?>
</tbody>
</table>
<br>

<b><h5 style="text-align: right; color: black;"><?php echo 'Total de Cuotas: $'.number_format($totalCuotas, 2, '.', ','); ?></h5></b>

<br><br><br>
<h3 style="text-align:center;color:#8c0d1b">Reporte de Gastos</h3>
<table name"tabla" id="tabla" class="tabla" border="1px" style="color:black;text-align: center;" bordercolor="#8c0d1b" >
            <thead style="text-align: center; background-color:#8c0d1b">
                <tr>
                    <tr name="columnas "id="columnas" style="font-size:16px;">
<?php 

echo "<td style='text-align: center; padding:5px'><b>Gasto</b></td>";
echo "<td style='text-align: center; padding:5px'><b>Descripci&oacute;n</b></td>";
echo "<td style='text-align: center; padding:5px'><b>Comprobante</b></td>";
echo "<td style='text-align: center; padding:5px'><b>Total</b></td>";
echo "<td style='text-align: center; padding:5px'><b>Tipo Gasto</b></td>";
echo "<td style='text-align: center; padding:5px'><b>Tipo Pago</b></td>";
echo "<td style='text-align: center; padding:5px'><b>Fecha</b></td>";
echo "<td style='text-align: center; padding:5px'><b>Usuario</b></td>";
?>
                    <tr>
                </tr>
<tbody style="background-color:white; color:black;font-size:12px;">
    <?php for($i=1;$row=$resultado5->fetch_assoc();$i++){ ?>
        <tr>
<?php

    echo "<td style='text-align: center; padding:5px'>";
    echo utf8_decode($row['gasto']);
    echo "</td>";

    echo "<td style='text-align: center; padding:5px'>";
    echo utf8_decode($row['descripcion_gasto']);
    echo "</td>";

    echo "<td style='text-align: center; padding:5px'>";
    echo utf8_decode($row['comprobante']);
    echo "</td>";
    
    echo "<td style='text-align: center; padding:5px'>";
    echo utf8_decode('$'.number_format($row['total'], 2, '.', ','));
    $totalGastos=$totalGastos+$row['total'];
    echo "</td>";

    if ($row['tipopago'] == "Bancos")
    {
        $gastosBancos=$gastosBancos+$row['total'];
    }

    if ($row['tipopago'] == "Efectivo")
    {
        $gastosEfectivo=$gastosEfectivo+$row['total'];
    }
    
    if ($row['tipopago'] == "Caja")
    {
        $gastosCaja=$gastosCaja+$row['total'];
    }

    echo "<td style='text-align: center; padding:5px'>";
    echo utf8_decode($row['tipo_gasto']);
    if ($row['tipo_gasto'] == "Fijo")
    {
        $gastosFijos=$gastosFijos+$row['total'];
    }
    if ($row['tipo_gasto'] == "Variable")
    {
        $gastosVariables=$gastosVariables+$row['total'];
    }
    echo "</td>";

    echo "<td style='text-align: center; padding:5px'>";
    echo utf8_decode($row['tipopago']);
    echo "</td>";

    echo "<td style='text-align: center; padding:5px'>";
    echo utf8_decode($row['fecha']);
    echo "</td>";

    echo "<td style='text-align: center; padding:5px'>";
    echo utf8_decode($row['usuario']);
    echo "</td>";

?>
        </tr>
    <?php } ?>
</tbody>
</table>
<br>
<b><h5 style="text-align: right; color: black;"><?php echo 'Total de Gastos: $'.number_format($totalGastos, 2, '.', ','); ?></h5></b><br>

<h5 style="text-align: right; color: black;"><?php echo 'Cuotas por Bancos: $'.number_format($ventasBancos, 2, '.', ','); ?></h5>
<h5 style="text-align: right; color: black;"><?php echo 'Cuotas por Efectivo: $'.number_format($ventasEfectivo, 2, '.', ','); ?></h5>
<b><h4 style="text-align: right; color: black;"><?php echo 'Total de Cuotas: $'.number_format($totalCuotas, 2, '.', ',').'(+)'; ?></h4></b><br>
<h5 style="text-align: right; color: black;"><?php echo 'Gastos por Bancos: $'.number_format($gastosBancos, 2, '.', ','); ?></h5>
<h5 style="text-align: right; color: black;"><?php echo 'Gastos por Efectivo: $'.number_format($gastosEfectivo, 2, '.', ','); ?></h5>
<b><h4 style="text-align: right; color: black;"><?php echo 'Total de Gastos: $'.number_format($totalGastos, 2, '.', ',').'(-)'; ?></h4></b><br>

<b><h3 style="text-align: right; color: black;"><?php $totalGeneral = $totalCuotas-$totalGastos; echo 'Total General: $'.number_format($totalGeneral, 2, '.', ','); ?></h3></b><br>

</form>
<form  method='POST' action='exportarCuotasExcel.php' target='_blank' >
<input type="hidden" id="fechaInicial" name="fechaInicial" value="<?php echo $fechaInicial;?>">
<input type="hidden" id="fechaFinal" name="fechaFinal" value="<?php echo $fechaFinal;?>">
<input type="hidden" id="cmbUsuarios" name="cmbUsuarios" value="<?php echo $usuarioID;?>">
<input id="enviarDatos" type="hidden" value="Exportar a Excel">

</form>
</div>
</body>

</html>