<?php
$server     = 'localhost'; //servidor
$username   = 'wwwvideo_root'; //usuario de la base de datos
$password   = 'V1de0@cces0s'; //password del usuario de la base de datos
$database   = 'wwwvideo_video_accesos'; //nombre de la base de datos
 
$conexion = @new mysqli($server, $username, $password, $database);
 
if ($conexion->connect_error) //verificamos si hubo un error al conectar, recuerden que pusimos el @ para evitarlo
{
    die('Error de conexi贸n: ' . $conexion->connect_error); //si hay un error termina la aplicaci贸n y mostramos el error
}
 
$sql="SELECT * from tipos_metas where estatus_id = 1 order by meta";
$result = $conexion->query($sql); //usamos la conexion para dar un resultado a la variable
 
if ($result->num_rows > 0) //si la variable tiene al menos 1 fila entonces seguimos con el codigo
{
    $combobit="";
    while ($row = $result->fetch_array(MYSQLI_ASSOC)) 
    {
        $combobit .=" <option value='".$row['meta_id']."'>".$row['meta']."</option>"; //concatenamos el los options para luego ser insertado en el HTML
    }
}
else
{
    echo "No hubo resultados";
}

$conexion->close(); //cerramos la conexi贸n
?>
<html>
<head><meta http-equiv="Content-Type" content="text/html; charset=gb18030">
<link href='http://fonts.googleapis.com/css?family=Montserrat:400,700' rel='stylesheet' type='text/css'>
<script src="imprimirContrato/js/jquery.js"></script>
<script src="imprimirContrato/js/myjava.js"></script>
<link href="imprimirContrato/bootstrap/css/bootstrap.css" rel="stylesheet">
<link href="imprimirContrato/bootstrap/css/bootstrap.min.css" rel="stylesheet">
<link href="imprimirContrato/bootstrap/css/bootstrap-theme.css" rel="stylesheet">
<link href="imprimirContrato/bootstrap/css/bootstrap-theme.min.css" rel="stylesheet">
<script src="imprimirContrato/bootstrap/js/bootstrap.min.js"></script>
<script src="imprimirContrato/bootstrap/js/bootstrap.js"></script>

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
    width: 320px;
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

.login-block select {
    width: 100%;
    height: 34px;
    box-sizing: border-box;
    border-radius: 5px;
    border: 1px solid #ccc;
    margin-bottom: 20px;
    font-size: 14px;
    font-family: Montserrat;
    padding: 0 0 0 30px;
    outline: none;
}

.login-block input:active, .login-block input:focus {
    border: 1px solid #0040FF;
}

#login{
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

#login {
    background: #0040FF;
border-color:white;
}


</style>
</head>

<body>

<div class="logo"></div>
<div class="login-block">
<form name="consulta_reporte" method="POST" action="reporte_metas.php" target="_blank" >
    <h3 style="text-align:center;color:#0040FF">Reporte de Metas</h3>
    <a style="color:black;">Mes Inicial:<a/>
    <select id="cmbMesesInicial" name="cmbMesesInicial">
      <option value="01">Enero</option>
      <option value="02">Febrero</option>
      <option value="03">Marzo</option>
      <option value="04">Abril</option>
      <option value="05">Mayo</option>
      <option value="06">Junio</option>
      <option value="07">Julio</option>
      <option value="08">Agosto</option>
      <option value="09">Septiembre</option>
      <option value="10">Octubre</option>
      <option value="11">Noviembre</option>
      <option value="12">Diciembre</option>
    </select>
    <a style="color:black;">A&ntilde;o Inicial:<a/>
    <select id="cmbAnosInicial" name="cmbAnosInicial">
      <option value="2017">2017</option>
      <option value="2018">2018</option>
      <option value="2019">2019</option>
      <option value="2020">2020</option>
    </select>
    <a style="color:black;">Mes Final:<a/>
    <select id="cmbMesesFinal" name="cmbMesesFinal">
      <option value="01">Enero</option>
      <option value="02">Febrero</option>
      <option value="03">Marzo</option>
      <option value="04">Abril</option>
      <option value="05">Mayo</option>
      <option value="06">Junio</option>
      <option value="07">Julio</option>
      <option value="08">Agosto</option>
      <option value="09">Septiembre</option>
      <option value="10">Octubre</option>
      <option value="11">Noviembre</option>
      <option value="12">Diciembre</option>
    </select>
    <a style="color:black;">A&ntilde;o Final:<a/>
    <select id="cmbAnosFinal" name="cmbAnosFinal">
      <option value="2017">2017</option>
      <option value="2018">2018</option>
      <option value="2019">2019</option>
      <option value="2020">2020</option>
    </select>
    <a style="color:black;">Tipo de Meta:<a/>
   <select name="cmbTipoMeta" id="cmbTipoMeta">
       <?php echo $combobit; ?>
   </select>
    <input id="login" type="submit" value="Generar Reporte">

</form>
</div>
</body>

</html>