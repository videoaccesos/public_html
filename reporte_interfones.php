<?php
$server     = 'localhost'; //servidor
$username   = 'wwwvideo_root'; //usuario de la base de datos
$password   = 'V1de0@cces0s'; //password del usuario de la base de datos
$database   = 'wwwvideo_video_accesos'; //nombre de la base de datos
 
$privada=$_POST['cmbPrivadas'];
$consultaPrivada='';
$totalGastos=0;

if ($privada!=0)
{
$consultaPrivada=' AND R.privada_id ='.$privada;
}

$conexion = @new mysqli($server, $username, $password, $database);
 
if ($conexion->connect_error) //verificamos si hubo un error al conectar, recuerden que pusimos el @ para evitarlo
{
    die('Error de conexi贸n: ' . $conexion->connect_error); //si hay un error termina la aplicaci贸n y mostramos el error
}

$sql="SELECT R.calle, R.nro_casa, R.telefono_interfon, R.interfon, P.descripcion, R.estatus_id FROM residencias as R INNER JOIN privadas as P on P.privada_id = R.privada_id WHERE R.interfon <> '' AND R.telefono_interfon <> '' $consultaPrivada ORDER BY P.descripcion, R.calle DESC";
$resultado = $conexion->query($sql);

$conexion->close(); //cerramos la conexi贸n
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

<title>Reportes de Interfones</title>
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
    <h3 style="text-align:center;color:#0040FF">Reporte de Interfones</h3>
<br>
<table name"tabla" id="tabla" class="tabla" border="1px" style="color:white;text-align: center;" bordercolor="#0B2161" >
            <thead style="text-align: center; background-color:#0B2161">
                <tr>
                    <tr name="columnas "id="columnas" style="font-size:16px;">
<?php 

echo "<td style='text-align: center; padding:5px'><b>Privada</b></td>";
echo "<td style='text-align: center; padding:5px'><b>Calle</b></td>";
echo "<td style='text-align: center; padding:5px'><b>Nro. Casa</b></td>";
echo "<td style='text-align: center; padding:5px'><b>Teléfono</b></td>";
echo "<td style='text-align: center; padding:5px'><b>Interfon</b></td>";
echo "<td style='text-align: center; padding:5px'><b>Estatus</b></td>";

?>
                    <tr>
                </tr>
<tbody style="background-color:white; color:black;font-size:12px;">
    <?php for($i=1;$row=$resultado->fetch_assoc();$i++){ ?>
        <tr>
<?php


    echo "<td style='text-align: center; padding:5px'>";
    echo utf8_decode($row['descripcion']);
    echo "</td>";
    
    echo "<td style='text-align: center; padding:5px'>";
    echo utf8_decode($row['calle']);
    echo "</td>";
   
    echo "<td style='text-align: center; padding:5px'>";
    echo utf8_decode($row['nro_casa']);
    echo "</td>";

    echo "<td style='text-align: center; padding:5px'>";
    echo utf8_decode($row['telefono_interfon']);
    echo "</td>";
   
    echo "<td style='text-align: center; padding:5px'>";
    echo utf8_decode($row['interfon']);
    echo "</td>";
    if ($row['estatus_id'] == 1)
    {
        $estatusLetra = "Interfon Activo";
    }
    if ($row['estatus_id'] == 2)
    {
        $estatusLetra = "Sin Interfon";
    }
    if ($row['estatus_id'] == 3)
    {
        $estatusLetra = "Moroso";
    }
    if ($row['estatus_id'] == 4)
    {
        $estatusLetra = "Sin Derechos";
    }
    echo "<td style='text-align: center; padding:5px'>";
    echo utf8_decode($estatusLetra);
    echo "</td>";
?>
        </tr>
    <?php } ?>
</tbody>
</table>
</form>
<form  method="POST" action="exportarInterfonesExcel.php" target="_blank" >
<input type="hidden" id="cmbPrivadas" name="cmbPrivadas" value="<?php echo $privada;?>">
    <input id="enviarDatos" type="submit" value="Exportar a Excel">
</form>
</div>
</body>

</html>