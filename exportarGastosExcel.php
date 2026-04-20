<?php
$server     = 'localhost'; //servidor
$username   = 'wwwvideo_root'; //usuario de la base de datos
$password   = 'V1de0@cces0s'; //password del usuario de la base de datos
$database   = 'wwwvideo_video_accesos'; //nombre de la base de datos
 
$fechaInicial=$_POST['fechaInicial'];
$fechaFinal=$_POST['fechaFinal'];
$privada=$_POST['cmbPrivadas'];
$consultaPrivada='';
$totalGastos=0;

if ($privada!=0)
{
$consultaPrivada=' and G.privada_id ='.$privada;
}

$conexion = @new mysqli($server, $username, $password, $database);
 
if ($conexion->connect_error) //verificamos si hubo un error al conectar, recuerden que pusimos el @ para evitarlo
{
    die('Error de conexi贸n: ' . $conexion->connect_error); //si hay un error termina la aplicaci贸n y mostramos el error
}

$sql="SELECT G.gasto_id, G.tipo_gasto, G.privada_id, G.tipo_pago, P.descripcion AS privada,TG.gasto, G.descripcion_gasto,G.comprobante,G.total, (CASE G.tipo_pago WHEN 1 THEN 'Efectivo' WHEN 2 THEN 'Bancos' WHEN 3 THEN 'Caja' END ) AS tipopago, G.fecha, U.usuario FROM gastos as G INNER JOIN tipos_gastos as TG on G.tipo_gasto = TG.gasto_id INNER JOIN usuarios as U on G.usuario_id = U.usuario_id INNER JOIN privadas as P on G.privada_id = P.privada_id where G.fecha >= '$fechaInicial' and G.fecha <= '$fechaFinal' $consultaPrivada ORDER BY G.fecha DESC ";
$resultado = $conexion->query($sql);

$conexion->close(); //cerramos la conexi贸n
header("Content-Type: application/vnd.ms-excel");
header("Expires: 0");
header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
header("content-disposition: attachment;filename=reporte_gastos.xls");
?>
<html>

<title>Reportes de Gastos</title>
<style>
body {

    background-image: url('ticket/imagenes/bgFondo.jpg');
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
    background: url('ticket/imagenes/videoaccesos.png') no-repeat;
    margin: 30px auto;
}

.login-block {
    width: 80%;
    padding: 7px 20px 7px 20px;
    background: #fff;
    border-radius: 5px;
    border-top: 7px solid #000000;
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
    border: 1px solid #000000;
}

#enviarDatos{
    width: 100%;
    height: 40px;
    background: #000000;
    box-sizing: border-box;
    border-radius: 5px;
    border: 1px solid #000000;
    color: #fff;
    font-weight: bold;
    text-transform: uppercase;
    font-size: 14px;
    font-family: Montserrat;
    outline: none;
    cursor: pointer;
}

#enviarDatos{
    background: #000000;
border-color:white;
}
#tabla{
width:100%;
height:100%;
}

</style>

<body>

<div class="logo"></div>
<div class="login-block">
<form name="consulta_reporte" method="POST" action="exportarGastosExcel.php" target="_blank" >
    <h3 style="text-align:center;color:#000000">Reporte de Gastos</h3>
<br>
<table name"tabla" id="tabla" class="tabla" border="1px" style="color:black;text-align: center;" bordercolor="black" >
            <thead style="text-align: center; background-color:black">
                <tr>
                    <tr name="columnas "id="columnas" style="font-size:16px;">
<?php 

echo "<td style='text-align: center; padding:5px'><b>Tipo Gasto</b></td>";
echo "<td style='text-align: center; padding:5px'><b>Privada</b></td>";
echo "<td style='text-align: center; padding:5px'><b>Descripcion</b></td>";
echo "<td style='text-align: center; padding:5px'><b>Comprobante</b></td>";
echo "<td style='text-align: center; padding:5px'><b>Total</b></td>";
echo "<td style='text-align: center; padding:5px'><b>Tipo Pago</b></td>";
echo "<td style='text-align: center; padding:5px'><b>Fecha/Hora</b></td>";
echo "<td style='text-align: center; padding:5px'><b>Usuario</b></td>";

?>
                    <tr>
                </tr>
<tbody style="background-color:white; color:black;font-size:12px;">
    <?php for($i=1;$row=$resultado->fetch_assoc();$i++){ ?>
        <tr>
<?php

    echo "<td style='text-align: center; padding:5px'>";
    echo utf8_decode($row['gasto']);
    echo "</td>";
   
    echo "<td style='text-align: center; padding:5px'>";
    echo utf8_decode($row['privada']);
    echo "</td>";

    echo "<td style='text-align: center; padding:5px'>";
    echo utf8_decode($row['descripcion_gasto']);
    echo "</td>";
   
    echo "<td style='text-align: center; padding:5px'>";
    echo utf8_decode($row['comprobante']);
    echo "</td>";

    echo "<td style='text-align: center; padding:5px'>";
    echo utf8_decode("$".$row['total']);
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
    
    $totalGastos = $totalGastos + $row['total'];
    
?>
        </tr>
    <?php } ?>
</tbody>
</table>
<br>
<b><h5 style="text-align: right; color: black;"><?php echo 'Total de Gastos: $'.$totalGastos; ?></h5></b>

</form>

</div>
</body>

</html>