<head>

<link href='http://fonts.googleapis.com/css?family=Montserrat:400,700' rel='stylesheet' type='text/css'>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<!-- Optional theme -->
<link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap-theme.min.css">

<!-- Latest compiled and minified JavaScript -->
<script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
<script language="javascript" type="text/javascript">
$( document ).ready(function() {
            $("#btnValidarCodigo").hide();
            $("#scan_code").focus();
        });
//FUNCION QUE SE EJECUTA AL DAR CLIC EN VALIDAR CÓDIGO (BOTÓN DENTRO DEL MODAL)
    $(document).on('click', '#btnValidar', function(ev){
      var data = $("#frmDatos").serialize();
      //EJECUTAMOS EL WEBSERVICE CHECK_USER.PHP Y LE ENVIAMOS COMO PARÁMETRO EL CÓDIGO QUE COLOCÓ EL USUARIO
      $.post('../google/check_userReposicion.php', data, function(data,status){
        //console.log("submitnig result ====> Data: " + data + "\nStatus: " + status);
        //CACHAMOS LA RESPUESTA DEL WEB SERVICE PARA SABER SI EL CÓDIGO COLOCADO ES CORRECTO O INCORRECTO
        if( data == "done"){
          //SI FUE CORRECTO EL CÓDIGO COLOCADO ENTONCES INICIAMOS SESIÓN
            $("#divCodigo").hide();
            var capa = document.getElementById("frmDatos");
            var cancelar = document.createElement("input");
            cancelar.type = "submit";
            cancelar.name = "cancelar";
            cancelar.id = "cancelar";
            cancelar.value = "Cancelar";
            capa.appendChild(cancelar);
        }
        else{
          //SI FUE INCORRECTO ENTONCES MANDAMOS MENSAJE DE ERROR
          alert("Código Incorrecto");
        }
        
      });
    });
</script>

<title>Datos del Folio</title>
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

<?php 
require('imprimirContrato/php/conexion.php');
$folio=$_POST['folio'];
$tipoFolio=$_POST['tipoFolio'];

if ($tipoFolio == 1)
{
$registro= mysql_query("SELECT tarjeta_id,tarjeta_id2,tarjeta_id3,tarjeta_id4,tarjeta_id5 FROM residencias_residentes_tarjetas WHERE asignacion_id = $folio");
}
if ($tipoFolio == 2)
{
$registro= mysql_query("SELECT tarjeta_id,tarjeta_id2,tarjeta_id3,tarjeta_id4,tarjeta_id5 FROM residencias_residentes_tarjetas_no_renovacion WHERE asignacion_id = $folio");
}
if ($tipoFolio == 3)
{
$registro= mysql_query("SELECT num_tarjeta_vieja, num_tarjeta_nueva FROM reposiciones WHERE id_reposicion = $folio");
}
if ($tipoFolio == 4)
{
$registro= mysql_query("SELECT tarjeta1,tarjeta2,tarjeta3,tarjeta4,tarjeta5,tarjeta6,tarjeta7,tarjeta8,tarjeta9,tarjeta10 FROM folios_ventas_consignacion WHERE asignacion_id = $folio");
}
if ($tipoFolio == 5)
{
$registro= mysql_query("SELECT tarjeta_id,tarjeta_id2,tarjeta_id3,tarjeta_id4,tarjeta_id5 FROM residencias_residentes_tarjetas_monte_carlo WHERE asignacion_id = $folio");
}

while($todosLosRegistros= mysql_fetch_array($registro)){

$id_tarjeta1 = $todosLosRegistros['tarjeta_id'];
$id_tarjeta2 = $todosLosRegistros['tarjeta_id2'];
$id_tarjeta3 = $todosLosRegistros['tarjeta_id3'];
$id_tarjeta4 = $todosLosRegistros['tarjeta_id4'];
$id_tarjeta5 = $todosLosRegistros['tarjeta_id5'];


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

$numTarjetaVieja=$todosLosRegistros['num_tarjeta_vieja'];
$numTarjetaNueva=$todosLosRegistros['num_tarjeta_nueva'];

$tarjeta1VC=$todosLosRegistros['tarjeta1'];
$tarjeta2VC=$todosLosRegistros['tarjeta2'];
$tarjeta3VC=$todosLosRegistros['tarjeta3'];
$tarjeta4VC=$todosLosRegistros['tarjeta4'];
$tarjeta5VC=$todosLosRegistros['tarjeta5'];
$tarjeta6VC=$todosLosRegistros['tarjeta6'];
$tarjeta7VC=$todosLosRegistros['tarjeta7'];
$tarjeta8VC=$todosLosRegistros['tarjeta8'];
$tarjeta9VC=$todosLosRegistros['tarjeta9'];
$tarjeta10VC=$todosLosRegistros['tarjeta10'];

?>
<div class='logo'></div>
<div class='login-block'>
<form id='frmDatos' name='frmDatos' action='cancelarFolio.php' method='post'>
<a>Folio:<a/>
    <input readonly type='text' id='folio' name='folio' value='<?php echo $folio; ?>'/><br>
     <input type='hidden' id='tipoFolio' name='tipoFolio' value='<?php echo $tipoFolio; ?>'/><br>
<a>Tarjeta 1:</a>
<input readonly type='text' id='tarjeta1' name='tarjeta1' value='<?php echo $tarjeta1[0]; ?>'/><br>
<a>Tarjeta 2:</a>
<input readonly type='text' id='tarjeta2' name='tarjeta2' value='<?php echo $tarjeta2[0]; ?>'/><br>
<a>Tarjeta 3:</a>
<input readonly type='text' id='tarjeta3' name='tarjeta3' value='<?php echo $tarjeta3[0]; ?>'/><br>
<a>Tarjeta 4:</a>
<input readonly type='text' id='tarjeta4' name='tarjeta4' value='<?php echo $tarjeta4[0]; ?>'/><br>
<a>Tarjeta 5:</a>
<input readonly type='text' id='tarjeta5' name='tarjeta5' value='<?php echo $tarjeta5[0]; ?>'/><br>
<a>Tarjeta 1 VC:</a>
<input readonly type='text' id='tarjeta1VC' name='tarjeta1VC' value='<?php echo $tarjeta1VC; ?>'/><br>
<a>Tarjeta 2 VC:</a>
<input readonly type='text' id='tarjeta2VC' name='tarjeta2VC' value='<?php echo $tarjeta2VC; ?>'/><br>
<a>Tarjeta 3 VC:</a>
<input readonly type='text' id='tarjeta3VC' name='tarjeta3VC' value='<?php echo $tarjeta3VC; ?>'/><br>
<a>Tarjeta 4 VC:</a>
<input readonly type='text' id='tarjeta4VC' name='tarjeta4VC' value='<?php echo $tarjeta4VC; ?>'/><br>
<a>Tarjeta 5 VC:</a>
<input readonly type='text' id='tarjeta5VC' name='tarjeta5VC' value='<?php echo $tarjeta5VC; ?>'/><br>
<a>Tarjeta 6 VC:</a>
<input readonly type='text' id='tarjeta6VC' name='tarjeta6VC' value='<?php echo $tarjeta6VC; ?>'/><br>
<a>Tarjeta 7 VC:</a>
<input readonly type='text' id='tarjeta7VC' name='tarjeta7VC' value='<?php echo $tarjeta7VC; ?>'/><br>
<a>Tarjeta 8 VC:</a>
<input readonly type='text' id='tarjeta8VC' name='tarjeta8VC' value='<?php echo $tarjeta8VC; ?>'/><br>
<a>Tarjeta 9 VC:</a>
<input readonly type='text' id='tarjeta9VC' name='tarjeta9VC' value='<?php echo $tarjeta9VC; ?>'/><br>
<a>Tarjeta 10 VC:</a>
<input readonly type='text' id='tarjeta10VC' name='tarjeta10VC' value='<?php echo $tarjeta10VC; ?>'/><br>
<a>Tarjeta Vieja R:</a>
<input readonly type='text' id='numTarjetaVieja' name='numTarjetaVieja' value='<?php echo $numTarjetaVieja; ?>'/><br>
<a>Tarjeta Nva. R:</a>
<input readonly type='text' id='numTarjetaNueva' name='numTarjetaNueva' value='<?php echo $numTarjetaNueva; ?>'/><br>
<div id="divCodigo" name="divCodigo">
<a>Token Autenticación:<a/>
<input type="hidden" id="process_name" name="process_name" value="verify_code" />
<input type='text' id='scan_code' name='scan_code'/><br>
<a>Validar datos</a>
<button type='button' id='btnValidar' name='btnValidar' style='margin-bottom:7px'><img align='center' width='24px' height='24px' src='imagenes/validar.png'></button>
</div>
<?php } ?>


</form>
</div>