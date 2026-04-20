<?php
$server     = 'localhost'; //servidor
$username   = 'wwwvideo_root'; //usuario de la base de datos
$password   = 'V1de0@cces0s'; //password del usuario de la base de datos
$database   = 'wwwvideo_video_accesos'; //nombre de la base de datos
 
$privada=$_GET['privada'];
$calleNoCasa=$_GET['calleNoCasa'];

$conexion = @new mysqli($server, $username, $password, $database);
 
if ($conexion->connect_error)
{
    die('Error de conexi贸n: ' . $conexion->connect_error);
}

$sql="SELECT R.residencia_id,R.nro_casa, R.calle, R.telefono1,R.interfon, 
                            (   CASE R.estatus_id
                                    WHEN 1 THEN 'Interfon Activo'
                                    WHEN 2 THEN 'Sin Interfon'
                                    WHEN 3 THEN 'Moroso'
                                    WHEN 4 THEN 'Sin Derechos'
                                END) AS estatus, P.descripcion AS privada, R.estatus_id FROM residencias AS R INNER JOIN privadas AS P ON R.privada_id = P.privada_id WHERE CONCAT_WS(' ',R.nro_casa,R.calle) LIKE '%$calleNoCasa%' AND P.descripcion LIKE '%$privada%' AND R.estatus_id <> 5 ORDER BY privada,R.nro_casa,R.calle";
$resultado = $conexion->query($sql);

$conexion->close();

header("Content-Type: application/vnd.ms-excel");
header("Expires: 0");
header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
header("content-disposition: attachment;filename=reporte_residencias.xls");

?>
<html>

<title>Reportes de Residencias</title>
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
    <form name="consulta_reporte" method="POST" action="exportarResidenciasExcel.php" target="_blank" >
        <h3 style="text-align:center;color:#000000">Reporte de Residencias</h3>
    <br>
        <table name"tabla" id="tabla" class="tabla" border="1px" style="color:black;text-align: center;" bordercolor="black" >
            <thead style="text-align: center; background-color:black">
                <tr>
                    <tr name="columnas "id="columnas" style="font-size:16px;">
                    <?php 
                    echo "<td style='text-align: center; padding:5px'><b># Casa</b></td>";
                    echo "<td style='text-align: center; padding:5px'><b>Privada, Calle</b></td>";
                    echo "<td style='text-align: center; padding:5px'><b>Tel&eacute;fono</b></td>";
                    echo "<td style='text-align: center; padding:5px'><b>Interf&oacute;n</b></td>";
                    echo "<td style='text-align: center; padding:5px'><b>Estatus</b></td>";
                    ?>
                    <tr>
                </tr>
            <tbody style="background-color:white; color:black;font-size:12px;">
                <?php for($i=1;$row=$resultado->fetch_assoc();$i++){ ?>
                    <tr>
                        <?php

                            echo "<td style='text-align: center; padding:5px'>";
                            echo utf8_decode($row['nro_casa']);
                            echo "</td>";
                           
                            echo "<td style='text-align: center; padding:5px'>";
                            echo utf8_decode($row['privada'].', '.$row['calle']);
                            echo "</td>";

                            echo "<td style='text-align: center; padding:5px'>";
                            echo utf8_decode($row['telefono1']);
                            echo "</td>";
                           
                            echo "<td style='text-align: center; padding:5px'>";
                            echo utf8_decode($row['interfon']);
                            echo "</td>";

                            echo "<td style='text-align: center; padding:5px'>";
                            echo utf8_decode($row['estatus']);
                            echo "</td>";
                            
                        ?>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </form>

</div>
</body>

</html>