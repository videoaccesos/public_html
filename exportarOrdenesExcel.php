<?php
$server     = 'localhost'; //servidor
$username   = 'wwwvideo_root'; //usuario de la base de datos
$password   = 'V1de0@cces0s'; //password del usuario de la base de datos
$database   = 'wwwvideo_video_accesos'; //nombre de la base de datos
 
$fechaInicial=$_POST['fechaInicial'];
$fechaFinal=$_POST['fechaFinal'];
$privada=$_POST['cmbPrivadas'];
$tecnico=$_POST['cmbTecnicos'];
// $material=$_POST['cmbMateriales'];
$estatus=$_POST['cmbEstatus'];
$fechaLevanto=$_POST['chkFechaLevanto'];
$fechaResolvio=$_POST['chkFechaResolvio'];
$consultaPrivada='';
// $consultaTecnico='';
// $consultaMaterial='';
$consultaEstatus='';
$fechaActual = date("Y-m-d");
$fechaHoraActual = date("Y-m-d H:i:s");


if ($fechaLevanto==0 && $fechaResolvio ==0)
{
$fechaLevanto=1;
}

if ($fechaResolvio== 1)
{
$fechaResuelto ='OS.fecha_modificacion';
}
if ($fechaLevanto== 1)
{
$fechaLevantado ='OS.fecha';
}

if ($privada!=0)
{
$consultaPrivada=' and OS.privada_id ='.$privada;
}

// if ($tecnico!=0)
// {
// $consultaTecnico=' and OS.tecnico_id='.$tecnico;
// }

// if ($material!=0)
// {
// $consultaMaterial=' and OSM.material_id='.$material;
// }

if ($estatus!=0)
{
$consultaEstatus=' and OS.estatus_id='.$estatus;
}

/*echo $fechaInicial;
echo $fechaFinal;
echo $privada;
echo $tecnico;
echo $estatus;
echo $mostrarFolio;
echo $mostrarPrivada;
echo $mostrarFalla;
echo $mostrarDiagnostico;
echo $mostrarTecnico;
echo $mostrarTiempo;
echo $mostrarFechaInicio;
echo $mostrarFechaSolucion;
echoMostrarEstatus;*/

$conexion = @new mysqli($server, $username, $password, $database);
 
if ($conexion->connect_error) //verificamos si hubo un error al conectar, recuerden que pusimos el @ para evitarlo
{
    die('Error de conexi贸n: ' . $conexion->connect_error); //si hay un error termina la aplicaci贸n y mostramos el error
}
 
$sql="SELECT * from privadas where estatus_id=1";
$result = $conexion->query($sql); //usamos la conexion para dar un resultado a la variable
 
if ($result->num_rows > 0) //si la variable tiene al menos 1 fila entonces seguimos con el codigo
{
    $combobit="";
    while ($row = $result->fetch_array(MYSQLI_ASSOC)) 
    {
        $combobit .=" <option value='".$row['privada_id']."'>".$row['descripcion']."</option>"; //concatenamos el los options para luego ser insertado en el HTML
    }
}
else
{
    echo "No hubo resultados";
}

$sql2="SELECT * from usuarios_tecnicos";
$result2 = $conexion->query($sql2); //usamos la conexion para dar un resultado a la variable
 
if ($result2->num_rows > 0) //si la variable tiene al menos 1 fila entonces seguimos con el codigo
{
    $combobit2="";
    while ($row2 = $result2->fetch_array(MYSQLI_ASSOC)) 
    {
        $combobit2 .=" <option value='".$row2['tecnico_id']."'>".$row2['usuario']."</option>"; //concatenamos el los options para luego ser insertado en el HTML
    }
}
else
{
    echo "No hubo resultados";
}

// if ($estatus==1)
// {
// $query="SELECT DATEDIFF('$fechaHoraActual',fecha) AS 'dias', ((TIME_TO_SEC('$fechaHoraActual') - TIME_TO_SEC(OS.fecha))/60) AS 'minutes', OS.orden_servicio_id, OS.folio,OS.fecha,OS.empleado_id,OS.privada_id, P.descripcion as privada, CS.descripcion as codigo_servicio,OS.cierre_tecnico_id, OS.codigo_servicio_id,OS.detalle_servicio,OS.detalle_diagnostico,OS.estatus_id,OS.tecnico_id,OS.tiempo,OS.fecha_modificacion,U.usuario FROM ordenes_servicio as OS inner join privadas as P on P.privada_id=OS.privada_id inner join usuarios_tecnicos as U on U.tecnico_id = OS.tecnico_id inner join codigos_servicio as CS on OS.codigo_servicio_id = CS.codigo_servicio_id where OS.estatus_id=1 $consultaPrivada";
// 	$resultado=$conexion->query($query);
// }

if ($fechaLevanto== 1)
{
	$query="SELECT DATEDIFF('$fechaActual',fecha) AS 'dias', ((TIME_TO_SEC('$fechaHoraActual') - TIME_TO_SEC(fecha))/60) AS 'minutes', OS.orden_servicio_id, OS.folio,OS.fecha,OS.empleado_id,OS.privada_id, P.descripcion as privada, CS.descripcion as codigo_servicio,OS.cierre_tecnico_id, OS.codigo_servicio_id,OS.detalle_servicio,OS.detalle_diagnostico,OS.estatus_id,OS.tecnico_id,OS.tiempo,OS.fecha_modificacion,U.usuario FROM ordenes_servicio as OS inner join privadas as P on P.privada_id=OS.privada_id inner join usuarios_tecnicos as U on U.tecnico_id = OS.tecnico_id inner join codigos_servicio as CS on OS.codigo_servicio_id = CS.codigo_servicio_id where $fechaLevantado >= '$fechaInicial' and $fechaLevantado <= '$fechaFinal' $consultaPrivada $consultaTecnico $consultaEstatus";
	$resultado=$conexion->query($query);
}

if ($fechaResolvio== 1)
{
	$query="SELECT DATEDIFF('$fechaActual',fecha) AS 'dias', ((TIME_TO_SEC('$fechaHoraActual') - TIME_TO_SEC(fecha))/60) AS 'minutes', OS.orden_servicio_id, OS.folio,OS.fecha,OS.empleado_id,OS.privada_id, P.descripcion as privada, CS.descripcion as codigo_servicio,OS.cierre_tecnico_id, OS.codigo_servicio_id,OS.detalle_servicio,OS.detalle_diagnostico,OS.estatus_id,OS.tecnico_id,OS.tiempo,OS.fecha_modificacion,U.usuario FROM ordenes_servicio as OS inner join privadas as P on P.privada_id=OS.privada_id inner join usuarios_tecnicos as U on U.tecnico_id = OS.tecnico_id inner join codigos_servicio as CS on OS.codigo_servicio_id = CS.codigo_servicio_id  where $fechaResuelto >= '$fechaInicial' and $fechaResuelto <= '$fechaFinal' $consultaPrivada $consultaTecnico $consultaEstatus";
	$resultado=$conexion->query($query);
}

$conexion->close(); //cerramos la conexi贸n

header("Content-Type: application/vnd.ms-excel");
header("Expires: 0");
header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
header("content-disposition: attachment;filename=reporte_ordenes_servicio.xls");
?>
<html>
<head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<link href='http://fonts.googleapis.com/css?family=Montserrat:400,700' rel='stylesheet' type='text/css'>
<script src="imprimirContrato/js/jquery.js"></script>
<script src="imprimirContrato/js/myjava.js"></script>
<link href="imprimirContrato/bootstrap/css/bootstrap.css" rel="stylesheet">
<link href="imprimirContrato/bootstrap/css/bootstrap.min.css" rel="stylesheet">
<link href="imprimirContrato/bootstrap/css/bootstrap-theme.css" rel="stylesheet">
<link href="imprimirContrato/bootstrap/css/bootstrap-theme.min.css" rel="stylesheet">
<script src="imprimirContrato/bootstrap/js/bootstrap.min.js"></script>
<script src="imprimirContrato/bootstrap/js/bootstrap.js"></script>

<title>Reportes de Ordenes de Servicio</title>
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
height:100%;
}

</style>
</head>

<body>

<div class="logo"></div>
<div class="login-block">
<form name="consulta_reporte" method="POST" action="#" target="_blank" >
    <h3 style="text-align:center;color:#0040FF">Reporte de &Oacute;rdenes de Servicio</h3>
<br>
<table name"tabla" id="tabla" class="tabla" border="1px" style="color:black;text-align: center;" bordercolor="#0B2161" >
            <thead style="text-align: center; background-color:#0B2161">
                <tr>
                    <tr name="columnas "id="columnas" style="font-size:16px;">
<?php 

echo "<td style='text-align: center; padding:5px'><b>Folio</b></td>";
echo "<td style='text-align: center; padding:5px'><b>Privada</b></td>";
// echo "<td style='text-align: center; padding:5px'><b>C&oacute;odigo Servicio</b></td>";
echo "<td style='text-align: center; padding:5px'><b>Falla</b></td>";
echo "<td style='text-align: center; padding:5px'><b>Di&aacute;gnostico</b></td>";
// echo "<td style='text-align: center; padding:5px'><b>Materiales Utilizados</b></td>";
echo "<td style='text-align: center; padding:5px'><b>Duraci&oacute;n Trabajo</b></td>";
echo "<td style='text-align: center; padding:5px'><b>Fecha Inicio</b></td>";
if ($estatus==1)
{
echo "<td style='text-align: center; padding:5px'><b>Tiempo Transcurrido</b></td>";
}
else
{
echo "<td style='text-align: center; padding:5px'><b>Fecha Soluci&oacute;n</b></td>";
}
echo "<td style='text-align: center; padding:5px'><b>T&eacute;cnico</b></td>";
echo "<td style='text-align: center; padding:5px'><b>Estatus</b></td>";

?>
                    <tr>
                </tr>
<tbody style="background-color:white; color:black;font-size:12px;">
    <?php for($i=1;$row=$resultado->fetch_assoc();$i++){ ?>
        <tr>
<?php

    echo "<td style='text-align: center; padding:5px'>";
    echo utf8_decode($row['folio']);
    echo "</td>";

    echo "<td style='text-align: center; padding:5px'>";
    echo utf8_decode($row['privada']);
    echo "</td>";

    echo "<td style='text-align: center; padding:5px' rowspan='".$totalContador."'>";
    echo utf8_decode($row['detalle_servicio']);
    echo "</td>";

    echo "<td style='text-align: center; padding:5px' rowspan='".$totalContador."'>";
    echo utf8_decode($row['detalle_diagnostico']);
    echo "</td>";

    echo "<td style='text-align: center; padding:5px' rowspan='".$totalContador."'>";
    echo utf8_decode($row['tiempo']).' Min.';
    echo "</td>";
    
    echo "<td style='text-align: center; padding:5px' rowspan='".$totalContador."'>";
    echo utf8_decode($row['fecha']);
    echo "</td>";

    
    echo "<td style='text-align: center; padding:5px'>";
    if ($row['estatus_id']==1)
    {
        $minutos = round($row['minutes']-60);
        $horas = round($minutos /60);
        $dias=$row['dias'];
        if ($dias > 0)
        {
        //echo $dias.' Días ';
        $diasHoras = $dias*24;
        $minutos = $minutos % 60;
        if ($minutos < 0)
        {
            $minutos = $minutos * -1;
            $horas = $horas-1;
        }
        if ($minutos < 10)
        {
            $minutos = "0".$minutos;
        }
        echo $diasHoras+$horas.':'.$minutos.":00";
        }
        if ($horas >0 && $dias < 1)
        {
        $minutos = $minutos % 60;
        if ($minutos < 0)
        {
            $minutos = $minutos * -1;
            $horas = $horas-1;
        }
        if ($minutos < 10)
        {
            $minutos = "0".$minutos;
        }
        if ($horas < 10)
        {
            $horas = "0".$horas;
        }
        echo $horas.':'.$minutos.":00";
        }
        if ($minutos < 60 && $minutos > 0  && $dias < 1 && $horas < 1)
        {
        echo "00:".$minutos."00";
        }
    }
    else
    {
    echo $row['fecha_modificacion'];
    }
    echo "</td>";

    echo "<td style='text-align: center; padding:5px' rowspan='".$totalContador."'>";
    echo utf8_decode($row['usuario']);
    echo "</td>";

    echo "<td style='text-align: center; padding:5px' rowspan='".$totalContador."'>";
    if ($row['estatus_id'] == 1)
    {
    $row['estatus_id']='Abierto';
    }

    if ($row['estatus_id'] == 2)
    {
    $row['estatus_id']='Solucionado';
    }

    if ($row['estatus_id'] == 3)
    {
    $row['estatus_id']='Cerrado';
    }
    echo utf8_decode($row['estatus_id']);
    echo "</td>";
?>
        </tr>
    <?php } ?>
</tbody>
</table>

</form>
<form name="consulta_reporte" method="POST" action="exportarOrdenesExcel.php" target="_blank" >
<input type="hidden" id="fechaInicial" name="fechaInicial" value="<?php echo $fechaInicial;?>">
<input type="hidden" id="fechaFinal" name="fechaFinal" value="<?php echo $fechaFinal;?>">
<input type="hidden" id="privada" name="privada" value="<?php echo $privada;?>">
<input type="hidden" id="tecnico" name="tecnico" value="<?php echo $tecnico;?>">
<input type="hidden" id="estatus" name="estatus" value="<?php echo $estatus;?>">
<input type="hidden" id="fechaLevanto" name="fechaLevanto" value="<?php echo $fechaLevanto;?>">
<input type="hidden" id="fechaResolvio" name="fechaResolvio" value="<?php echo $fechaResolvio;?>">
    <!--<input id="enviarDatos" type="submit" value="Exportar a Excel">-->

</form>
</div>
</body>

</html>