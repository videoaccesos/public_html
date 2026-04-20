<?php 
require('imprimirContrato/php/conexion.php');
$folio=$_POST['folio'];

$registro= mysql_query("SELECT RR.ape_paterno, RR.ape_materno, RR.nombre, R.nro_casa, R.calle, R.telefono1,R.telefono2,R.interfon,RR.email, R.privada_id, P.descripcion, T.lectura, RRT.tarjeta_id,RRT.tarjeta_id2,RRT.tarjeta_id3,RRT.tarjeta_id4,RRT.tarjeta_id5, RRT.fecha, RRT.fecha_vencimiento, RRT.lectura_tipo_id, RRT.comprador_id, RRT.folio_contrato, RRT.precio, RRT.descuento, RRT.IVA, RRT.numero_serie,RRT.numero_serie2,RRT.numero_serie3,RRT.numero_serie4,RRT.numero_serie5, RRT.utilizo_seguro, RRT.utilizo_seguro2, RRT.utilizo_seguro3, RRT.utilizo_seguro4, RRT.utilizo_seguro5, RRT.estatus_id, RRT.usuario_id, U.usuario FROM residencias_residentes_tarjetas as RRT INNER JOIN residencias_residentes as RR ON RR.residente_id = RRT.residente_id INNER JOIN tarjetas as T ON T.tarjeta_id = RRT.tarjeta_id INNER JOIN residencias as R on R.residencia_id=RR.residencia_id INNER JOIN privadas as P on R.privada_id = P.privada_id INNER JOIN usuarios AS U ON RRT.usuario_id = U.usuario_id WHERE RRT.asignacion_id = $folio");
while($todosLosRegistros= mysql_fetch_array($registro)){
$id_tarjeta1 = $todosLosRegistros['tarjeta_id'];
$id_tarjeta2 = $todosLosRegistros['tarjeta_id2'];
$id_tarjeta3 = $todosLosRegistros['tarjeta_id3'];
$id_tarjeta4 = $todosLosRegistros['tarjeta_id4'];
$id_tarjeta5 = $todosLosRegistros['tarjeta_id5'];
$usuario_id = $todosLosRegistros['usuario_id'];


$result1= mysql_query("SELECT lectura FROM tarjetas where tarjeta_id = '$id_tarjeta1'");
$tarjeta1= mysql_fetch_row($result1);
$result2= mysql_query("SELECT lectura FROM tarjetas where tarjeta_id = '$id_tarjeta2'");
$tarjeta2= mysql_fetch_row($result2);
$result3= mysql_query("SELECT lectura FROM tarjetas where tarjeta_id = '$id_tarjeta3'");
$tarjeta3= mysql_fetch_row($result3);
$result4= mysql_query("SELECT lectura FROM tarjetas where tarjeta_id = '$id_tarjeta4'");
$tarjeta4= mysql_fetch_row($result4);
$result5= mysql_query("SELECT lectura FROM tarjetas where tarjeta_id = '$id_tarjeta5'");
$tarjeta5= mysql_fetch_row($result5);


$result= mysql_query("SELECT empleado_id FROM usuarios WHERE usuario_id=$usuario_id");          //query
  $empleado_id= mysql_fetch_row($result);  

$queryNombre= mysql_query("SELECT nombre, ape_paterno, ape_materno FROM empleados WHERE empleado_id=$empleado_id[0]");          //query 


while($registroNombre= mysql_fetch_array($queryNombre)){
$nombreCompleto = $registroNombre['nombre'].' '.$registroNombre['ape_paterno'].' '.$registroNombre['ape_materno'];
}


?>

<link href='http://fonts.googleapis.com/css?family=Montserrat:400,700' rel='stylesheet' type='text/css'>

<script language="javascript" type="text/javascript">

function myFunction()
{
    var cveVendedora= document.getElementById("cveVendedora").value;
var cveSupervisora= document.getElementById("cveSupervisora").value;
var cveGerente= document.getElementById("cveGerente").value;

if (((cveVendedora == "gargolas") || (cveVendedora == "otycroma") || (cveVendedora == "valdez" )) && (cveSupervisora == "otycroma") && (cveGerente=="vale17010396") ) {
var capa = document.getElementById("frmDatos");
    var cancelar = document.createElement("input");
cancelar.type = "submit";
cancelar.name = "cancelar";
cancelar.id = "cancelar";
cancelar.value = "Cancelar";
capa.appendChild(cancelar);
}
}
</script>

<title>Datos del Contrato</title>
<style>
body {
    background-image: url('ticket/imagenes/bgFondo.jpg');
    background-size: cover;
    font-family: Montserrat;
}

.logo {
    width: 250px;
    height: 70px;
    background: url('ticket/imagenes/videoaccesos.png') no-repeat;
    margin: 30px auto;
}

.login-block {
    width: 420px;
    padding: 20px;
    background: #fff;
    border-radius: 5px;
    border-top: 5px solid #0040FF;
    margin: 0 auto;
}

.login-block h3 {
    text-align: center;
    color: #000;
    font-size: 18px;
    text-transform: uppercase;
    margin-top: 0;
    margin-bottom: 20px;
}

.login-block input {
    width: 70%;
    height: 30px;
    box-sizing: border-box;
    border-radius: 5px;
    border: 1px solid #ccc;
    margin-bottom: 20px;
    font-size: 14px;
    font-family: Montserrat;
    outline: none;
text-align:center;
}

.login-block input#username {
    background: #fff url('http://i.imgur.com/u0XmBmv.png') 20px top no-repeat;
    background-size: 16px 80px;
}

.login-block input#username:focus {
    background: #fff url('http://i.imgur.com/u0XmBmv.png') 20px bottom no-repeat;
    background-size: 16px 80px;
}

.login-block input#password {
    background: #fff url('http://i.imgur.com/Qf83FTt.png') 20px top no-repeat;
    background-size: 16px 80px;
}

.login-block input#password:focus {
    background: #fff url('http://i.imgur.com/Qf83FTt.png') 20px bottom no-repeat;
    background-size: 16px 80px;
}

.login-block input:active, .login-block input:focus {
    border: 1px solid #0040FF;
}

#cancelar{
    width: 100%;
    height: 40px;
    background: red;
    box-sizing: border-box;
    border-radius: 5px;
    border: 1px solid white;
    color: #fff;
    font-weight: bold;
    text-transform: uppercase;
    font-size: 14px;
    font-family: Montserrat;
    outline: none;
    cursor: pointer;
}

#cancelar{
    background: red;
border-color:white;
}


</style>
</head>


<div class='logo'></div>
<div class='login-block'>
<form id='frmDatos' name='frmDatos' action='cancelarContrato.php' method='post'>
    <h3>Ingrese el folio del contrato</h3>
<a>Folio:<a/>
    <input type='text' id='folio' name='folio' value='<?php echo $folio; ?>'/><br>
<a>Tarjeta 1:<a/>
<input disabled type='text' id='tarjeta1' name='tarjeta1' value='<?php echo $tarjeta1[0]; ?>'/><br>
<a>Tarjeta 2:<a/>
<input disabled type='text' id='tarjeta2' name='tarjeta2' value='<?php echo $tarjeta2[0]; ?>'/><br>
<a>Tarjeta 3:<a/>
<input disabled type='text' id='tarjeta3' name='tarjeta3' value='<?php echo $tarjeta3[0]; ?>'/><br>
<a>Tarjeta 4:<a/>
<input disabled type='text' id='tarjeta4' name='tarjeta4' value='<?php echo $tarjeta4[0]; ?>'/><br>
<a>Tarjeta 5:<a/>
<input disabled type='text' id='tarjeta5' name='tarjeta5' value='<?php echo $tarjeta5[0]; ?>'/><br>

<a>N&uacute;m. Serie 1:<a/>
<input disabled type='text' id='numSerie1' name='numSerie1' value='<?php echo $todosLosRegistros['numero_serie']; ?>'/><br>
<a>N&uacute;m. Serie 2:<a/>
<input disabled type='text' id='numSerie2' name='numSerie2' value='<?php echo $todosLosRegistros['numero_serie2']; ?>'/><br>
<a>N&uacute;m. Serie 3:<a/>
<input disabled type='text' id='numSerie3' name='numSerie3' value='<?php echo $todosLosRegistros['numero_serie3']; ?>'/><br>
<a>N&uacute;m. Serie 4:<a/>
<input disabled type='text' id='numSerie4' name='numSerie4' value='<?php echo $todosLosRegistros['numero_serie4']; ?>'/><br>
<a>N&uacute;m. Serie 5:<a/>
<input disabled type='text' id='numSerie5' name='numSerie5' value='<?php echo $todosLosRegistros['numero_serie5']; ?>'/><br>

<a>Residente:<a/>
<input disabled type='text' id='residente' name='residente' value='<?php echo $todosLosRegistros['nombre'].' '.$todosLosRegistros['ape_paterno'].' '.$todosLosRegistros['ape_materno']; ?>'/><br>
<a>Comprador:<a/>
<input disabled type='text' id='comprador' name='comprador' value='<?php echo $todosLosRegistros['comprador_id']; ?>'/><br>
<a>Descuento:<a/>
<input disabled type='text' id='descuento' name='descuento' value='<?php echo $todosLosRegistros['descuento']; ?>'/><br>
<a>Iva:<a/>
<input disabled type='text' id='iva' name='iva' value='<?php echo $todosLosRegistros['IVA']; ?>'/><br>
<a>Total:<a/>
<input disabled type='text' id='total' name='total' value='<?php echo $todosLosRegistros['precio']; ?>'/><br>

<a>Seguro 1:<a/>
<input disabled type='text' id='seguro1' name='seguro1' value='<?php echo $todosLosRegistros['utilizo_seguro']; ?>'/><br>
<a>Seguro 2:<a/>
<input disabled type='text' id='seguro2' name='seguro2' value='<?php echo $todosLosRegistros['utilizo_seguro2']; ?>'/><br>
<a>Seguro 3:<a/>
<input disabled type='text' id='seguro3' name='seguro3' value='<?php echo $todosLosRegistros['utilizo_seguro3']; ?>'/><br>
<a>Seguro 4:<a/>
<input disabled type='text' id='seguro4' name='seguro4' value='<?php echo $todosLosRegistros['utilizo_seguro4']; ?>'/><br>
<a>Seguro 5:<a/>
<input disabled type='text' id='seguro5' name='seguro5' value='<?php echo $todosLosRegistros['utilizo_seguro5']; ?>'/><br>

<a>Estatus:<a/>
<input disabled type='text' id='estatus' name='estatus' value='<?php echo $todosLosRegistros['estatus_id']; ?>'/><br>
<a>Vendedora:<a/>
<input disabled type='text' id='vendedora' name='vendedora' value='<?php echo $nombreCompleto ; ?>'/><br> 

<a>Clave Vendedora:<a/>
<input type='password' id='cveVendedora' name='cveVendedora' /><br>
<a>Clave Supervisora:<a/>
<input type='password' id='cveSupervisora' name='cveSupervisora' /><br>
<a>Clave Gerencia:<a/>
<input type='password' id='cveGerente' name='cveGerente'/><br>
<a>Validar datos</a>
<button type='button' id='btnValidar' name='btnValidar' style='margin-bottom:7px' onclick='myFunction()'><img align='center' width='24px' height='24px' src='imagenes/validar.png'></button>
<?php } ?>


</form>
</div>