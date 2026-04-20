<?php
$server     = 'localhost'; //servidor
$username   = 'wwwvideo_root'; //usuario de la base de datos
$password   = 'V1de0@cces0s'; //password del usuario de la base de datos
$database   = 'wwwvideo_video_accesos'; //nombre de la base de datos
 
$mesInicial=$_POST['cmbMesesInicial'];
$anoInicial=$_POST['cmbAnosInicial'];
$mesFinal=$_POST['cmbMesesFinal'];
$anoFinal=$_POST['cmbAnosFinal'];
$tipoMeta=$_POST['cmbTipoMeta'];
$totalAlcanzado=0;
$porcentaje=0;
$fechaInicial = $anoInicial.'-'.$mesInicial.'-01'.' 00:00:01';
$fechaFinal = $anoFinal.'-'.$mesFinal.'-01'.' 23:59:59';

$conexion = @new mysqli($server, $username, $password, $database);
 
if ($conexion->connect_error) //verificamos si hubo un error al conectar, recuerden que pusimos el @ para evitarlo
{
    die('Error de conexi贸n: ' . $conexion->connect_error); //si hay un error termina la aplicaci贸n y mostramos el error
}
if ($tipoMeta == 1)
{
$sql="SELECT M.meta_id, M.mes, M.ano, M.meta, U.usuario,(CASE M.mes WHEN 1 THEN 'Enero' WHEN 2 THEN 'Febrero' WHEN 3 THEN 'Marzo' WHEN 4 THEN 'Abril' WHEN 5 THEN 'Mayo' WHEN 6 THEN 'Junio' WHEN 7 THEN 'Julio' WHEN 8 THEN 'Agosto' WHEN 9 THEN 'Septiembre' WHEN 10 THEN 'Octubre' WHEN 11 THEN 'Noviembre' WHEN 12 THEN 'Diciembre' END) AS mesNombre, (CASE M.estatus_id WHEN 1 THEN 'Activo' WHEN 2 THEN 'Baja' END) AS estatus, M.estatus_id FROM metas as M INNER JOIN usuarios as U on M.usuario_id = U.usuario_id WHERE M.tipo_meta_id = 1 AND M.mes >= $mesInicial AND M.mes <= $mesFinal AND M.ano >= $anoInicial AND M.ano <= $anoFinal AND M.estatus_id <> 3 ORDER BY M.mes";
$resultado = $conexion->query($sql);
}
if ($tipoMeta == 2)
{
$sql="SELECT M.meta_id, M.mes, M.ano, M.meta, U.usuario,(CASE M.mes WHEN 1 THEN 'Enero' WHEN 2 THEN 'Febrero' WHEN 3 THEN 'Marzo' WHEN 4 THEN 'Abril' WHEN 5 THEN 'Mayo' WHEN 6 THEN 'Junio' WHEN 7 THEN 'Julio' WHEN 8 THEN 'Agosto' WHEN 9 THEN 'Septiembre' WHEN 10 THEN 'Octubre' WHEN 11 THEN 'Noviembre' WHEN 12 THEN 'Diciembre' END) AS mesNombre, (CASE M.estatus_id WHEN 1 THEN 'Activo' WHEN 2 THEN 'Baja' END) AS estatus, M.estatus_id FROM metas as M INNER JOIN usuarios as U on M.usuario_id = U.usuario_id WHERE M.tipo_meta_id = 2 AND M.mes >= $mesInicial AND M.mes <= $mesFinal AND M.ano >= $anoInicial AND M.ano <= $anoFinal AND M.estatus_id <> 3 ORDER BY M.mes";
$resultado = $conexion->query($sql);
}
if ($tipoMeta == 3)
{
$sql="SELECT M.meta_id, M.mes, M.ano, M.meta, U.usuario,(CASE M.mes WHEN 1 THEN 'Enero' WHEN 2 THEN 'Febrero' WHEN 3 THEN 'Marzo' WHEN 4 THEN 'Abril' WHEN 5 THEN 'Mayo' WHEN 6 THEN 'Junio' WHEN 7 THEN 'Julio' WHEN 8 THEN 'Agosto' WHEN 9 THEN 'Septiembre' WHEN 10 THEN 'Octubre' WHEN 11 THEN 'Noviembre' WHEN 12 THEN 'Diciembre' END) AS mesNombre, (CASE M.estatus_id WHEN 1 THEN 'Activo' WHEN 2 THEN 'Baja' END) AS estatus, M.estatus_id FROM metas as M INNER JOIN usuarios as U on M.usuario_id = U.usuario_id WHERE M.tipo_meta_id = 3 AND M.mes >= $mesInicial AND M.mes <= $mesFinal AND M.ano >= $anoInicial AND M.ano <= $anoFinal AND M.estatus_id <> 3 ORDER BY M.mes";
$resultado = $conexion->query($sql);
}

$conexion->close(); //cerramos la conexi贸n
header("Content-Type: application/vnd.ms-excel");
header("Expires: 0");
header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
header("content-disposition: attachment;filename=reporte_metas.xls");
?>
<html>

<title>Reportes de Metas</title>
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
    border-top: 7px solid #0040FF;
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
    border: 1px solid #0040FF;
}

#enviarDatos{
    width: 100%;
    height: 40px;
    background: #0040FF;
    box-sizing: border-box;
    border-radius: 5px;
    border: 1px solid #0040FF;
    color: #fff;
    font-weight: bold;
    text-transform: uppercase;
    font-size: 14px;
    font-family: Montserrat;
    outline: none;
    cursor: pointer;
}

#enviarDatos{
    background: #0040FF;
border-color:white;
}
#tabla{
width:100%;
height:200px;
}

</style>
</head>

<body>

<div class="logo"></div>
<div class="login-block">
<form name="consulta_reporte" method="POST" action="#" target="_blank" >
    <h3 style="text-align:center;color:#0040FF">Reporte de Metas</h3>
<br>
<table name"tabla" id="tabla" class="tabla" border="1px" style="color:black;text-align: center;" bordercolor="#0B2161" >
            <thead style="text-align: center; background-color:#0B2161">
                <tr>
                    <tr name="columnas "id="columnas" style="font-size:16px;">
<?php 

echo "<td style='text-align: center; padding:5px'><b>Mes</b></td>";
echo "<td style='text-align: center; padding:5px'><b>Año</b></td>";
echo "<td style='text-align: center; padding:5px'><b>Total</b></td>";
echo "<td style='text-align: center; padding:5px'><b>Meta</b></td>";
echo "<td style='text-align: center; padding:5px'><b>Porcentaje</b></td>";

?>
                    <tr>
                </tr>
<tbody style="background-color:white; color:black;font-size:12px;">
    <?php for($i=1;$row=$resultado->fetch_assoc();$i++){ ?>
        <tr>
<?php
$server     = 'localhost'; //servidor
$username   = '
wwwvideo_root'; //usuario de la base de datos
$password   = '
V1de0@cces0s'; //password del usuario de la base de datos
$database   = 'wwwvideo_video_accesos'; //nombre de la base de datos
$anoActual = $row['ano'];
$mesActual = $row['mes'];
$conexion = @new mysqli($server, $username, $password, $database);
if ($conexion->connect_error) //verificamos si hubo un error al conectar, recuerden que pusimos el @ para evitarlo
{
    die('Error de conexi贸n: ' . $conexion->connect_error); //si hay un error termina la aplicaci贸n y mostramos el error
}
if ($tipoMeta == 1)
{
    $sql2="SELECT SUM(G.total) as total FROM gastos as G INNER JOIN tipos_gastos as TG on G.tipo_gasto = TG.gasto_id INNER JOIN usuarios as U on G.usuario_id = U.usuario_id INNER JOIN privadas as P on G.privada_id = P.privada_id WHERE G.fecha LIKE '%".$anoActual.'-0'.$mesActual."%' ";
    $resultado2 = $conexion->query($sql2);
    while($row2=$resultado2->fetch_assoc()){ 
    $totalAlcanzado = $row2['total'];
    }
}
if ($tipoMeta == 2)
{
    $sql2="SELECT SUM(total) as total FROM folios_mensualidades WHERE estatus = 1 AND fecha LIKE '%".$anoActual.'-0'.$mesActual."%' ";
    $resultado2 = $conexion->query($sql2);
    while($row2=$resultado2->fetch_assoc()){ 
    $totalAlcanzado = $row2['total'];
    }
}
if ($tipoMeta == 3)
{
    $sql2="SELECT SUM(G.total) as total FROM gastos as G INNER JOIN tipos_gastos as TG on G.tipo_gasto = TG.gasto_id INNER JOIN usuarios as U on G.usuario_id = U.usuario_id INNER JOIN privadas as P on G.privada_id = P.privada_id WHERE TG.tipo_gasto = 1 AND G.fecha LIKE '%".$anoActual.'-0'.$mesActual."%' ";
    $resultado2 = $conexion->query($sql2);
    while($row2=$resultado2->fetch_assoc()){ 
    $totalAlcanzado = $row2['total'];
    }
}
$conexion->close(); //cerramos la conexi贸n

$totalAlcanzado = number_format($totalAlcanzado, 2, '.', '');
$porcentaje = ($totalAlcanzado * 100)/$row['meta'];
$porcentaje = round($porcentaje);

    echo "<td style='text-align: center; padding:5px'>";
    echo utf8_decode($row['mesNombre']);
    echo "</td>";
   
    echo "<td style='text-align: center; padding:5px'>";
    echo utf8_decode($row['ano']);
    echo "</td>";

    echo "<td style='text-align: center; padding:5px'>";
    echo utf8_decode('$'.$totalAlcanzado);
    echo "</td>";

    echo "<td style='text-align: center; padding:5px'>";
    echo utf8_decode('$'.$row['meta']);
    echo "</td>";
   
    if ($porcentaje > 100)
    {
    echo "<td style='text-align: center; color:red; padding:5px'>";
    echo utf8_decode($porcentaje.'%');
    echo "</td>";
    }
    if ($porcentaje < 100)
    {
    echo "<td style='text-align: center; color:green; padding:5px'>";
    echo utf8_decode($porcentaje.'%');
    echo "</td>";
    }
    if ($porcentaje == 100)
    {
    echo "<td style='text-align: center; padding:5px'>";
    echo utf8_decode($porcentaje.'%');
    echo "</td>";
    }
    
?>
        </tr>
    <?php } ?>
</tbody>
</table>

</form>
<form  method="POST" action="exportarMetasGastosExcel.php" target="_blank" >
<input type="hidden" id="cmbMeses" name="cmbMeses" value="<?php echo $mes;?>">
<input type="hidden" id="cmbAnos" name="cmbAnos" value="<?php echo $ano;?>">

</form>

</div>
</body>

</html>