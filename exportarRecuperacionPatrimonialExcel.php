<?php
$server     = 'localhost';
$username   = 'wwwvideo_root';
$password   = 'V1de0@cces0s';
$database   = 'wwwvideo_video_accesos';
 
$fechaInicial=$_POST['fechaInicial'];
$fechaFinal=$_POST['fechaFinal'];
$estatus ="";

$conexion = @new mysqli($server, $username, $password, $database);
 
if ($conexion->connect_error)
{
    die('Error de conexi贸n: ' . $conexion->connect_error);
}

$sql="SELECT DISTINCT RP.folio, RP.fecha, E.nombre, E.ape_paterno, E.ape_materno, P.descripcion, RP.orden_servicio_id, RP.relato_hechos, RP.tipo_dano, RP.responsable_nombre, RP.responsable_domicilio, RP.responsable_telefono, RP.responsable_celular, RP.responsable_relacion, RP.vehiculo_placas, RP.vehiculo_modelo, RP.vehiculo_color, RP.vehiculo_marca, RP.seguro, RP.seguro_nombres, RP.testigos, RP.testigos_nombres, RP.videos, RP.videos_direccion, RP.aviso_administrador, RP.aviso_administrador_fecha, RP.observaciones, RP.estatus_id, RP.fecha_modificacion, U.usuario FROM recuperacion_patrimonial as RP INNER JOIN empleados as E ON E.empleado_id = RP.empleado_id INNER JOIN privadas as P on P.privada_id = RP.privada_id INNER JOIN usuarios as U on U.usuario_id = RP.usuario_id WHERE RP.fecha >= '$fechaInicial' AND RP.fecha <= '$fechaFinal'";
$resultado = $conexion->query($sql);

$conexion->close();
header("Content-Type: application/vnd.ms-excel");
header("Expires: 0");
header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
header("content-disposition: attachment;filename=recuperacion_patrimonial.xls");
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

<title>Reportes de Recuperaci&oacute;n Patrimonial</title>
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
height:100%;
}

</style>
</head>

<body>

<div class="logo"></div>
<div class="login-block">
<form name="consulta_reporte" method="POST" action="#" target="_blank" >
    <h3 style="text-align:center;color:#0040FF">Reporte de Recuperaci&oacute;n Patrimonial</h3>
<br>
<table name"tabla" id="tabla" class="tabla" border="1px" style="color:black;text-align: center;" bordercolor="#0B2161" >
    <thead style="text-align: center; background-color:#0B2161">
        <tr>
            <tr name="columnas "id="columnas" style="font-size:16px;">
                <?php 
                    echo "<td style='text-align: center; padding:5px'><b>Folio</b></td>";
                    echo "<td style='text-align: center; padding:5px'><b>Fecha</b></td>";
                    // echo "<td style='text-align: center; padding:5px'><b>Empleado</b></td>";
                    echo "<td style='text-align: center; padding:5px'><b>Privada</b></td>";
                    echo "<td style='text-align: center; padding:5px'><b>Hechos</b></td>";
                    echo "<td style='text-align: center; padding:5px'><b>Tipo Daño</b></td>";
                    // echo "<td style='text-align: center; padding:5px'><b>Responsable Nombre</b></td>";
                    // echo "<td style='text-align: center; padding:5px'><b>Responsable Domicilio</b></td>";
                    // echo "<td style='text-align: center; padding:5px'><b>Responsable Telefono</b></td>";
                    // echo "<td style='text-align: center; padding:5px'><b>Responsable Celular</b></td>";
                    // echo "<td style='text-align: center; padding:5px'><b>Responsable Relacion</b></td>";
                    echo "<td style='text-align: center; padding:5px'><b>Vehiculo Placas</b></td>";
                    echo "<td style='text-align: center; padding:5px'><b>Vehiculo Modelo</b></td>";
                    echo "<td style='text-align: center; padding:5px'><b>Vehiculo Color</b></td>";
                    echo "<td style='text-align: center; padding:5px'><b>Vehiculo Marca</b></td>";
                    // echo "<td style='text-align: center; padding:5px'><b>Seguro</b></td>";
                    // echo "<td style='text-align: center; padding:5px'><b>Seguro Nombres</b></td>";
                    // echo "<td style='text-align: center; padding:5px'><b>Testigos</b></td>";
                    // echo "<td style='text-align: center; padding:5px'><b>Testigos Nombres</b></td>";
                    // echo "<td style='text-align: center; padding:5px'><b>Videos</b></td>";
                    // echo "<td style='text-align: center; padding:5px'><b>Videos Direccion</b></td>";
                    // echo "<td style='text-align: center; padding:5px'><b>Aviso Administrador</b></td>";
                    // echo "<td style='text-align: center; padding:5px'><b>Aviso Administrador Fecha</b></td>";
                    echo "<td style='text-align: center; padding:5px'><b>Observaciones</b></td>";
                    echo "<td style='text-align: center; padding:5px'><b>Estatus</b></td>";
                    echo "<td style='text-align: center; padding:5px'><b>Fecha Captura</b></td>";
                    echo "<td style='text-align: center; padding:5px'><b>Usuario</b></td>";
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
                echo utf8_decode($row['fecha']);
                echo "</td>";
               
                // echo "<td style='text-align: center; padding:5px'>";
                // echo utf8_decode($row['nombre'].' '.$row['ape_paterno'].' '.$row['ape_materno']);
                // echo "</td>";

                echo "<td style='text-align: center; padding:5px'>";
                echo utf8_decode($row['descripcion']);
                echo "</td>";

                echo "<td style='text-align: center; padding:5px'>";
                echo utf8_decode($row['relato_hechos']);
                echo "</td>";

                echo "<td style='text-align: center; padding:5px'>";
                echo utf8_decode($row['tipo_dano']);
                echo "</td>";

                // echo "<td style='text-align: center; padding:5px'>";
                // echo utf8_decode($row['responsable_nombre']);
                // echo "</td>";

                // echo "<td style='text-align: center; padding:5px'>";
                // echo utf8_decode($row['responsable_domicilio']);
                // echo "</td>";

                // echo "<td style='text-align: center; padding:5px'>";
                // echo utf8_decode($row['responsable_telefono']);
                // echo "</td>";

                // echo "<td style='text-align: center; padding:5px'>";
                // echo utf8_decode($row['responsable_celular']);
                // echo "</td>";

                // echo "<td style='text-align: center; padding:5px'>";
                // echo utf8_decode($row['responsable_relacion']);
                // echo "</td>";
                
                echo "<td style='text-align: center; padding:5px'>";
                echo utf8_decode($row['vehiculo_placas']);
                echo "</td>";

                echo "<td style='text-align: center; padding:5px'>";
                echo utf8_decode($row['vehiculo_modelo']);
                echo "</td>";

                echo "<td style='text-align: center; padding:5px'>";
                echo utf8_decode($row['vehiculo_color']);
                echo "</td>";

                echo "<td style='text-align: center; padding:5px'>";
                echo utf8_decode($row['vehiculo_marca']);
                echo "</td>";
                
                // if ($row['seguro']==1)
                // {
                //     echo "<td style='text-align: center; padding:5px'>";
                //     echo utf8_decode("X");
                //     echo "</td>";
                // }
                // else
                // {
                //     echo "<td style='text-align: center; padding:5px'>";
                //     echo utf8_decode("");
                //     echo "</td>";
                // }

                // echo "<td style='text-align: center; padding:5px'>";
                // echo utf8_decode($row['seguro_nombres']);
                // echo "</td>";

                // if ($row['testigos']==1)
                // {
                //     echo "<td style='text-align: center; padding:5px'>";
                //     echo utf8_decode("X");
                //     echo "</td>";
                // }
                // else
                // {
                //     echo "<td style='text-align: center; padding:5px'>";
                //     echo utf8_decode("");
                //     echo "</td>";
                // }

                // echo "<td style='text-align: center; padding:5px'>";
                // echo utf8_decode($row['testigos_nombres']);
                // echo "</td>";

                // if ($row['videos']==1)
                // {
                //     echo "<td style='text-align: center; padding:5px'>";
                //     echo utf8_decode("X");
                //     echo "</td>";
                // }
                // else
                // {
                //     echo "<td style='text-align: center; padding:5px'>";
                //     echo utf8_decode("");
                //     echo "</td>";
                // }

                // echo "<td style='text-align: center; padding:5px'>";
                // echo utf8_decode($row['videos_direccion']);
                // echo "</td>";

                // if ($row['aviso_administrador']==1)
                // {
                //     echo "<td style='text-align: center; padding:5px'>";
                //     echo utf8_decode("X");
                //     echo "</td>";
                // }
                // else
                // {
                //     echo "<td style='text-align: center; padding:5px'>";
                //     echo utf8_decode("");
                //     echo "</td>";
                // }

                // echo "<td style='text-align: center; padding:5px'>";
                // echo utf8_decode($row['aviso_administrador_fecha']);
                // echo "</td>";

                echo "<td style='text-align: center; padding:5px'>";
                echo utf8_decode($row['observaciones']);
                echo "</td>";

                if ($row['estatus_id']==1)
                {
                    $estatus= "Pendiente";
                }
                if ($row['estatus_id']==2)
                {
                    $estatus= "Recuperado";
                }
                echo "<td style='text-align: center; padding:5px'>";
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
</form>
<form  method="POST" action="exportarRecuperacionPatrimonialExcel.php" target="_blank" >
<input type="hidden" id="fechaInicial" name="fechaInicial" value="<?php echo $fechaInicial;?>">
<input type="hidden" id="fechaFinal" name="fechaFinal" value="<?php echo $fechaFinal;?>">
<input id="enviarDatos" type="hidden" value="Exportar a Excel">
</form>
</div>
</body>

</html>