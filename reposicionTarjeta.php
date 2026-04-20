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
 
$sql="SELECT * from privadas where estatus_id=1 order by descripcion";
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

$conexion->close(); //cerramos la conexi贸n
?>
<html>
<head><meta http-equiv="Content-Type" content="text/html; charset=gb18030">
<link href='http://fonts.googleapis.com/css?family=Montserrat:400,700' rel='stylesheet' type='text/css'>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<!-- Optional theme -->
<link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap-theme.min.css">

<!-- Latest compiled and minified JavaScript -->
<script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>

<title>Reponer Tarjeta</title>
		<script>
        $( document ).ready(function() {
            //$("#scan_code").hide();
	        $("#reposicion").hide();
	        //$("#btnValidarCodigo").hide();
	        $("#tarjetaAnterior").focus();
        });
		function validNumber(e) 
		{
			var tecla = document.all ? tecla = e.keyCode : tecla = e.which;
			return ((tecla > 47 && tecla < 58) || tecla == 8);
		}
		function validLetter(e) 
		{
			var tecla = document.all ? tecla = e.keyCode : tecla = e.which;
			var especiales = [8, 32, 13];/*back, space, enter */
			for (var i in especiales) 
			{
			  if (tecla == especiales[i]) { return true;/*break; */}
			}
			return (((tecla > 96 && tecla < 123) || (tecla > 64 && tecla < 91)) || tecla == 8);
		}

		function  buscarDatosTarjeta(){
	    var tarjetaAnterior= $("#tarjetaAnterior").val();
	    if(tarjetaAnterior != "")
	    {
    	    $.ajax({                           
    	      url: 'buscarDatosTarjetaReposicion.php',
    	      data: "tarjetaAnterior="+tarjetaAnterior,
    	      type: "post",
    	      dataType: 'json',     
    	      success: function(data)
    	      {
    	        if(data.tipoFolio == "H")
    	        {
    	            if(data.folioSalida == "")
    	            {
        	            if (data.seguro != "1" && $("#motivo").val() == 1)
        	            {
        	                alert("Esta tarjeta no tiene seguro");
        	            }
        	            else if (data.privada == "")
        	            {
        	            $("#nombre").val("");
            	        $("#domicilio").val("");
            	        $("#folio").val("");
            	        $("#tipoFolio").val("");
            	        $("#cmbPrivadas").val(18);
            	        $("#nombrePrivada").val("");
        	            alert("Tarjeta no encontrada.");
            	        }
            	        else
            	        {
                	        $("#nombre").val(data.nombre);
                	        $("#domicilio").val(data.domicilio);
                	        $("#folio").val(data.folio);
                	        $("#tipoFolio").val(data.tipoFolio);
                	        $("#cmbPrivadas").val(data.privada);
                	        $("#nombrePrivada").val(data.nombrePrivada);
            	        }
    	            }
    	            else
    	            {
    	                alert("Esta tarjeta se repuso en el folio: "+data.folioSalida+" R")
    	            }
    	        }
    	        if(data.tipoFolio == "B")
    	        {
    	            if(data.folioSalida == "")
    	            {
        	            if (data.privada == "")
        	            {
        	            $("#nombre").val("");
            	        $("#domicilio").val("");
            	        $("#folio").val("");
            	        $("#tipoFolio").val("");
            	        $("#cmbPrivadas").val(18);
            	        $("#nombrePrivada").val("");
        	            alert("Tarjeta no encontrada.");
            	        }
            	        else
            	        {
                	        $("#nombre").val(data.nombre);
                	        $("#domicilio").val(data.domicilio);
                	        $("#folio").val(data.folio);
                	        $("#tipoFolio").val(data.tipoFolio);
                	        $("#cmbPrivadas").val(data.privada);
                	        $("#nombrePrivada").val(data.nombrePrivada);
            	        }
    	            }
    	            else
    	            {
    	                alert("Esta tarjeta se repuso en el folio: "+data.folioSalida+" R")
    	            }
    	        }
    	        if(data.tipoFolio == "MC")
    	        {
    	            if(data.folioSalida == "")
    	            {
        	            if (data.privada == "")
        	            {
        	            $("#nombre").val("");
            	        $("#domicilio").val("");
            	        $("#folio").val("");
            	        $("#tipoFolio").val("");
            	        $("#cmbPrivadas").val(18);
            	        $("#nombrePrivada").val("");
        	            alert("Tarjeta no encontrada.");
            	        }
            	        else
            	        {
                	        $("#nombre").val(data.nombre);
                	        $("#domicilio").val(data.domicilio);
                	        $("#folio").val(data.folio);
                	        $("#tipoFolio").val(data.tipoFolio);
                	        $("#cmbPrivadas").val(data.privada);
                	        $("#nombrePrivada").val(data.nombrePrivada);
            	        }
    	            }
    	            else
    	            {
    	                alert("Esta tarjeta se repuso en el folio: "+data.folioSalida+" R")
    	            }
    	        }
    	        if(data.tipoFolio == "")
    	        {
    	            $("#nombre").val("");
        	        $("#domicilio").val("");
        	        $("#folio").val("");
        	        $("#tipoFolio").val("");
        	        $("#cmbPrivadas").val(18);
        	        $("#nombrePrivada").val("");
    	            alert("Tarjeta no encontrada.");
    	        }
    	        
    	      } 
    	    });
	    }
	}
	
	function  buscarDatosTarjetaNueva(){
	    var tarjetaNueva= $("#tarjetaNueva").val();
	    if(tarjetaNueva != "")
	    {
    	    $.ajax({                           
    	      url: 'buscarDatosTarjetaNueva.php',
    	      data: "tarjetaNueva="+tarjetaNueva,
    	      type: "post",
    	      dataType: 'json',     
    	      success: function(data)
    	      {
    	        if (data.estatus != "1")
    	        {
    	            $("#tarjetaNueva").val("");
    	            alert("Tarjeta no disponible para la venta.");
    	        }
    	      } 
    	    });
	    }
	}
	
	function  buscarFolioReposicion(){
	    var folioReposicion= $("#folioReposicion").val();
	    if (folioReposicion != "")
	    {
    	    $.ajax({                           
    	      url: 'buscarDatosFolioReposicion.php',
    	      data: "folioReposicion="+folioReposicion,
    	      type: "post",
    	      dataType: 'json',     
    	      success: function(data)
    	      {
    	        if (data.nombre == "")
    	        {
    	            alert("No se ha encontrado este folio.");
    	        }
    	        else
    	        {
    	            $("#nombre").val(data.nombre);
        	        $("#domicilio").val(data.domicilio);
        	        $("#folio").val(data.folio);
        	        $("#cmbPrivadas").val(data.privada);
        	        $("#tarjetaAnterior").val(data.numTarjetaVieja);
        	        $("#tarjetaNueva").val(data.numTarjetaNueva);
        	        $("#motivo").val(data.motivo);
        	        $("#observaciones").val(data.observaciones);
    	        }
    	      } 
    	    });
	    }
	}
	
	//FUNCION QUE SE EJECUTA AL DAR CLIC EN VALIDAR CÓDIGO (BOTÓN DENTRO DEL MODAL)
    $(document).on('click', '#btnValidarCodigo', function(ev){
      var data = $("#frmReposicion").serialize();
      //EJECUTAMOS EL WEBSERVICE CHECK_USER.PHP Y LE ENVIAMOS COMO PARÁMETRO EL CÓDIGO QUE COLOCÓ EL USUARIO
      $.post('../google/check_userReposicion.php', data, function(data,status){
        //console.log("submitnig result ====> Data: " + data + "\nStatus: " + status);
        //CACHAMOS LA RESPUESTA DEL WEB SERVICE PARA SABER SI EL CÓDIGO COLOCADO ES CORRECTO O INCORRECTO
        if( data == "done"){
          //SI FUE CORRECTO EL CÓDIGO COLOCADO ENTONCES INICIAMOS SESIÓN
          $("#reposicion").show();
          $("#scan_code").hide();
	      $("#btnValidarCodigo").hide();
        }
        else{
          //SI FUE INCORRECTO ENTONCES MANDAMOS MENSAJE DE ERROR
          alert("Código Incorrecto");
        }
        
      });
    });
    </script>
<style>
body {
    background-image: url('ticket/imagenes/bgFondo.jpg');
    background-size: cover;
    font-family: Montserrat;
}

a {color:#013ADF}
.logo {
    width: 250px;
    height: 70px;
    background: url('ticket/imagenes/videoaccesos.png') no-repeat;
    margin: 30px auto;
}

.login-block {
    width: 320px;
    padding: 20px;
    background: #fff;
    border-radius: 5px;
    border-top: 5px solid #0040FF;
    margin: 0 auto;
}

.login-block h1 {
    text-align: center;
    color: #000;
    font-size: 18px;
    text-transform: uppercase;
    margin-top: 0;
    margin-bottom: 20px;
}

.login-block input {
    width: 100%;
    height: 42px;
    box-sizing: border-box;
    border-radius: 5px;
    border: 1px solid #ccc;
    margin-bottom: 20px;
    font-size: 14px;
    font-family: Montserrat;
    padding: 0 20px 0 50px;
    outline: none;
color:#013ADF;
}

.login-block input#fechaInicial, input#fechaFinal,#cmbPrivadas,#cmbTecnicos,cmbEstatus{
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
color:#013ADF;
}
.login-block input#username {
    background: #fff url('http://i.imgur.com/u0XmBmv.png') 20px top no-repeat;
    background-size: 16px 80px;
}

.login-block input#username:focus {
    background: #fff url('http://i.imgur.com/u0XmBmv.png') 20px bottom no-repeat;
    background-size: 16px 80px;
}

.login-block #cmbPrivadas{
margin-top:6px;
    background: #fff url('ticket/imagenes/casa3.png') 12px 4px no-repeat;
    background-size: 26px 26px ;
}

.login-block #cmbPrivadas:focus {
margin-top:6px;
    background: #fff url('ticket/imagenes/casa3.png') 12px 4px no-repeat;
    background-size: 26px 26px ;
}

.login-block #nombre{
margin-top:6px;
    background: #fff url('ticket/imagenes/user.png') 12px 4px no-repeat;
    background-size: 26px 26px;
}

.login-block #nombre:focus {
margin-top:6px;
    background: #fff url('ticket/imagenes/user.png') 12px 4px no-repeat;
    background-size: 26px 26px;
}

.login-block #motivo{
margin-top:6px;
    background: #fff url('ticket/imagenes/info.png') 12px 4px no-repeat;
    background-size: 26px 26px  ;
}

.login-block #motivo:focus {
margin-top:6px;
    background: #fff url('ticket/imagenes/info.png') 12px 4px no-repeat;
    background-size: 26px 26px ;
}
.login-block input:active, .login-block input:focus {
    border: 1px solid #0040FF;
}

.login-block #domicilio{
margin-top:6px;
    background: #fff url('ticket/imagenes/direccion.png') 12px 4px no-repeat;
    background-size: 26px 26px  ;
}

.login-block #domicilio:focus {
margin-top:6px;
    background: #fff url('ticket/imagenes/direccion.png') 12px 4px no-repeat;
    background-size: 26px 26px ;
}
.login-block input:active, .login-block input:focus {
    border: 1px solid #0040FF;
}

.login-block #folio{
margin-top:6px;
    background: #fff url('ticket/imagenes/folio.jpg') 12px 4px no-repeat;
    background-size: 34px 30px  ;
}

.login-block #folio:focus {
margin-top:6px;
    background: #fff url('ticket/imagenes/folio.jpg') 12px 4px no-repeat;
    background-size: 34px 30px ;
}
.login-block input:active, .login-block input:focus {
    border: 1px solid #0040FF;
}



.login-block #tarjetaAnterior{
margin-top:6px;
    background: #fff url('ticket/imagenes/tarjeta.png') 12px 4px no-repeat;
    background-size: 28px 28px ;
}

.login-block #tarjetaAnterior:focus {
margin-top:6px;
    background: #fff url('ticket/imagenes/tarjeta.png') 12px 4px no-repeat;
    background-size: 28px 28px ;
}
.login-block input:active, .login-block input:focus {
    border: 1px solid #0040FF;
}

.login-block #tarjetaNueva{
margin-top:6px;
    background: #fff url('ticket/imagenes/tarjeta.png') 12px 4px no-repeat;
    background-size: 28px 28px ;
}

.login-block #tarjetaNueva:focus {
margin-top:6px;
    background: #fff url('ticket/imagenes/tarjeta.png') 12px 4px no-repeat;
    background-size: 28px 28px ;
}
.login-block input:active, .login-block input:focus {
    border: 1px solid #0040FF;
}

#reposicion, #btnValidarCodigo{
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

#reposicion, #btnValidarCodigo{
    background: #0040FF;
border-color:white;
}


</style>
</head>

<body>


<div class="logo"></div>
<div class="login-block">
<form id="frmReposicion" name="frmReposicion" action="reposicionPDF.php" method="post">
	<h1>Reposici&oacute;n</h1>
    <a>Buscar folio de reposición:</a>
	<input type="hidden" value="" id="nombrePrivada" name="nombrePrivada"/>
	<input type="hidden" value="" id="tipoFolio" name="tipoFolio"/>
    <input type="text" value="" placeholder="Ingrese el número de folio" id="folioReposicion" name="folioReposicion" onkeypress="return validNumber(event);" onblur="return buscarFolioReposicion();"/>
	<select name="motivo" id="motivo">
	<option value="0">Seleccione un motivo...</option>
	<option value="1">Seguro</option>
	<option value="2">Garant&iacute;a</option>
	<option value="3">Robo</option>
	</select>
	<input type="text" value="" placeholder="Tarjeta Anterior" id="tarjetaAnterior" name="tarjetaAnterior" onkeypress="return validNumber(event);" onblur="return buscarDatosTarjeta();"/>
    <select name="cmbPrivadas" id="cmbPrivadas">
	    <?php echo $combobit; ?>
	</select>
	<input type="text" value="" placeholder="Nombre del Residente" id="nombre" name="nombre" onkeypress="return validLetter(event);" required readonly/>
	<input type="text" value="" placeholder="Domicilio" id="domicilio" name="domicilio" required readonly/>
	<input type="text" value="" placeholder="Folio Origen" id="folio" name="folio" required readonly/>

	<input type="text" value="" placeholder="Tarjeta Nueva" id="tarjetaNueva" name="tarjetaNueva" onkeypress="return validNumber(event);" onblur="return buscarDatosTarjetaNueva();" required/>
	
	<input type="textarea" value="" placeholder="Observaciones" id="observaciones" name="observaciones"/>
	<input type="hidden" id="process_name" name="process_name" value="verify_code" />
	<input type="text" value="" placeholder="Token" id="scan_code" name="scan_code"/>
	<input id="btnValidarCodigo" name="btnValidarCodigo" type="button" value="Validar Código">
	<input id="reposicion" name="reposicion" type="submit" value="Generar Reposici&oacute;n">
    
</form>
</div>
</body>

</html>