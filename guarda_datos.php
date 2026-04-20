<?php 

// CONEXION A LA BASE DE DATOS
$server     = 'localhost'; //servidor
$username   = 'wwwvideo_root'; //usuario de la base de datos
$password   = 'V1de0@cces0s'; //password del usuario de la base de datos
$database   = 'wwwvideo_pagos'; //nombre de la base de datos

$conexion = @new mysqli($server, $username, $password, $database);

if ($conexion->connect_error) //verificamos si hubo un error al conectar, recuerden que pusimos el @ para evitarlo
{
    die('Error de conexi贸n: ' . $conexion->connect_error); //si hay un error termina la aplicaci贸n y mostramos el error
}

$numeroAleatorio = mt_rand(1000000000,2000000000);
$nombre=$_POST['nombreRes'];
$apellidoPaterno=$_POST['apPaternoRes'];
$apellidoMaterno=$_POST['apMaternoRes'];
$calle=$_POST['calle'];
$numeroExterior=$_POST['numExt'];
$id_privada=0;
$totalTarjetas=0;
$resultadoTarjetas="";

$numerosTarjetas = $_REQUEST['numeroTarjeta'];
$residencia=$_POST['residencia'];
$nfilas = count($numerosTarjetas);
$resultadoNumerosTarjetas = "";
$resultadosTiposTarjetas="";
$arregloNumeroTarjetas= new SplFixedArray($nfilas);
$arregloTipoTarjetas= new SplFixedArray($nfilas);
$arregloCosto= new SplFixedArray($nfilas);
$variableLoca="";

	for($i = 0; $i < $nfilas; $i++)
	{
	    for($j = 0; $j < $nfilas-1; $j++)
	    {
	        if ($numerosTarjetas[$j] == $numerosTarjetas[$j+1])
	        {           
	  		echo '<script> alert("Numeros de tarjeta proporcionados repetidos"); window.location="formulario.php"; </script>';
			$variableLoca="Positivo";
	        }
	    }
	}

	if($variableLoca != "Positivo")
	{
		for($i=0;$i<$nfilas;$i++)
		{
			if ($numerosTarjetas[$i] != "")
			{
				$resultadoNumerosTarjetas = $resultadoNumerosTarjetas."| ". $numerosTarjetas[$i]. " |";
				$arregloNumeroTarjetas[$i] = $numerosTarjetas[$i];
			}
			$arregloNumeroTarjetas[$i] = (int) $arregloNumeroTarjetas[$i];
			
			$SQL="SELECT num_tarjeta, tipo_tarjeta, costo FROM tarjetas where num_tarjeta='".$arregloNumeroTarjetas[$i]."' ";
            $resultadoSQL = $conexion->query($SQL);
            while($rowSQL=$resultadoSQL->fetch_assoc()){
    			$tipo_tarjeta = $rowSQL["tipo_tarjeta"];
    			$costo =$rowSQL["costo"];
    			$arregloTipoTarjetas[$i] = $rowSQL["tipo_tarjeta"]; 
    			$arregloCosto[$i] = $rowSQL["costo"]; 
            }

			if ($residencia == 3)
			{
				if ($arregloTipoTarjetas[$i] == "Tag")
				{
					$arregloCosto[$i] = "700";
				}
				if ($arregloTipoTarjetas[$i] == "Vehicular")
				{
					$arregloCosto[$i] = "700";
				}
				if ($arregloTipoTarjetas[$i] == "Peatonal")
				{
					$arregloCosto[$i] = "150";
				}
			}

			$totalTarjetas = $totalTarjetas + $arregloCosto[$i];
			$resultadosTiposTarjetas = $resultadosTiposTarjetas."| ". $arregloTipoTarjetas[$i]. " |";

			if ($arregloNumeroTarjetas[$i] == "")
			{
				echo '<script> alert("Es necesario proporcionar sus numeros de tarjeta."); window.location="formulario.php"; </script>';
			}

			/*if (mysql_num_rows($result) == 0 && $arregloNumeroTarjetas[$i] != "")
			{
				echo '<script> alert("Los numero(s) de tarjeta proporcionados son invalido(s)."); window.location="formulario.php"; </script>';
			}
			else
			{
				$sql1 = "UPDATE tarjetas SET status_tarjeta = 2  WHERE num_tarjeta  = '".$arregloNumeroTarjetas[$i]."'";
			    $result1 = mysql_query($sql1);
			}*/
		}
	}

echo '<html>
	<link rel=StyleSheet href="estilos.css" type="text/css" media=screen>
	<head>
		<title>Compra en Línea</title>
		<meta http-equiv="Content-Type" content="text/html;charset=utf-8" />
	</head>

	<body>

		<style type="text/css">
			#formTarjeta .pagoTarjeta{
			width: 200px;
			height: 50px;
			background: #08088A;
			font-weight: bold;
			font-size:16px;
			color: white;
			border: 0 none;
			border-radius: 3px;
			cursor: pointer;
			}
			#formTarjeta .pagoTarjeta:hover, #formTarjeta .pagoTarjeta:focus {
			box-shadow: 0 0 0 2px white, 0 0 0 3px #08088A;
			}

			#formEfectivo .pagoEfectivo{
			width: 200px;
			height: 50px;
			background: #08088A;
			font-weight: bold;
			font-size:16px;
			color: white;
			border: 0 none;
			border-radius: 3px;
			cursor: pointer;
			}
			#formEfectivo .pagoEfectivo:hover, #formEfectivo .pagoEfectivo:focus {
			box-shadow: 0 0 0 2px white, 0 0 0 3px #08088A;
			}
			#formDeposito .pagoDeposito{
			width: 200px;
			height: 50px;
			background: #08088A;
			font-weight: bold;
			font-size:16px;
			color: white;
			border: 0 none;
			border-radius: 3px;
			cursor: pointer;
			}
			#formDeposito .pagoDeposito:hover, #formDeposito .pagoDeposito:focus {
			box-shadow: 0 0 0 2px white, 0 0 0 3px #08088A;
			}

			#formNoPagar .noPagar{
			width: 200px;
			height: 50px;
			background: #08088A;
			font-weight: bold;
			font-size:16px;
			color: white;
			border: 0 none;
			border-radius: 3px;
			cursor: pointer;
			}
			#formNoPagar .noPagar:hover, #formNoPagar .noPagar:focus {
			box-shadow: 0 0 0 2px white, 0 0 0 3px #08088A;
			}

			#formulario .noComprar{
			width: 250px;
			height: 50px;
			background: #08088A;
			font-weight: bold;
			font-size:16px;
			color: white;
			border: 0 none;
			border-radius: 3px;
			cursor: pointer;
			}
			#formulario .noComprar:hover, #formulario .noComprar:focus {
				box-shadow: 0 0 0 2px white, 0 0 0 3px #08088A;
			}
			#logosPagos
			{
			width: 200px;
			height: 40px;
			}
		</style>

		<center>	
			<br><br>
			<img src="images/videoaccesos.png">
			<br><br><br>
			<h4 style="color:white;width: 55%; text-align: justify;">Sus datos están siendo validados, para activar sus tarjetas es necesario seleccionar su forma de pago. Si no desea comprar presione el botón "Sólo Registro" y posteriormente recibirá un número de tarjeta autorizado para ingresar como moroso.</h4>
			<br><br>
			<p></p>	
			<table id="dataTotal" width="190px" border="1"   class="table table-striped table-bordered table-hover" name="total_table" style="overflow: auto; position: relative; border-color:#DFD326; border-radius: 3px; border-style: groove;  width:280px; " tabindex="5001">
				<thead>
					<tr>
						<th style="color:#DFD326" class="warning"><span class="glyphicon glyphicon-play-circle"> Tarjeta</span></th>
						<th style="color:#DFD326" class="warning"><span class="glyphicon glyphicon-play-circle"> Costo</span></th>
					</tr>
				</thead>
			</table>
			<br>
		</center>
	</body>
</html>';

if ($nfilas == 1) 
{
	echo "<center style='color:#DFD326;'>".$arregloTipoTarjetas[0]."&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp; $".$costo."</center><br><br><br>";
}
else
{
	/* for ($i=0; $i < $nfilas; $i++) 
	{
		//3 Vehiculares y 2 Peatonales
	  	if ($i+4 < $nfilas) 
	  	{
		  	if ($arregloCosto[$i] + $arregloCosto[$i+1] + $arregloCosto[$i+2] + $arregloCosto[$i+3] + $arregloCosto[$i+4] == 2400) 
		  	{
		  		$arregloTipoTarjetas = "Kit   ";
		  		$costo=1850;
		  		$arregloCosto[$i] = 0;
		  		$arregloCosto[$i+1]=0;
		  		$arregloCosto[$i+2]=0;
		  		$arregloCosto[$i+3]=0;
		  		$arregloCosto[$i+4]=0;
		  		$totalTarjetas =$totalTarjetas-550;
		  		echo "<center style='color:#DFD326;'> &nbsp;&nbsp;".$arregloTipoTarjetas."&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; $".$costo."</center><br><br><br>";
	  		}
	  	}
	  	if ($i+5 < $nfilas) 
	  	{
		  	if ($arregloCosto[$i] + $arregloCosto[$i+2] + $arregloCosto[$i+3] + $arregloCosto[$i+4] + $arregloCosto[$i+5] == 2400) 
		  	{
		  		$arregloTipoTarjetas = "Kit   ";
		  		$costo=1850;
		  		$arregloCosto[$i] = 0;
		  		$arregloCosto[$i+2]=0;
		  		$arregloCosto[$i+3]=0;
		  		$arregloCosto[$i+4]=0;
		  		$arregloCosto[$i+5]=0;
		  		$totalTarjetas =$totalTarjetas-550;
		  		echo "<center style='color:#DFD326;'> &nbsp;&nbsp;".$arregloTipoTarjetas."&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; $".$costo."</center><br><br><br>";
	  		}
	  	}
	  	if ($i+6 < $nfilas) 
	  	{
		  	if ($arregloCosto[$i] + $arregloCosto[$i+3] + $arregloCosto[$i+4] + $arregloCosto[$i+5] + $arregloCosto[$i+6] == 2400) 
		  	{
		  		$arregloTipoTarjetas = "Kit   ";
		  		$costo=1850;
		  		$arregloCosto[$i] = 0;
		  		$arregloCosto[$i+3]=0;
		  		$arregloCosto[$i+4]=0;
		  		$arregloCosto[$i+5]=0;
		  		$arregloCosto[$i+6]=0;
		  		$totalTarjetas =$totalTarjetas-550;
		  		echo "<center style='color:#DFD326;'> &nbsp;&nbsp;".$arregloTipoTarjetas."&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; $".$costo."</center><br><br><br>";
	  		}
	  	}
	} */

	/* for ($i=0; $i < $nfilas; $i++) 
	{
		//3 Vehiculares
	  	if ($i+2 < $nfilas) 
	  	{
		  	if ($arregloCosto[$i] + $arregloCosto[$i+1] + $arregloCosto[$i+2] == 2100) {
	  		$arregloTipoTarjetas = "Kit   ";
	  		$costo=1750;
	  		$arregloCosto[$i] = 0;
	  		$arregloCosto[$i+1]=0;
	  		$arregloCosto[$i+2]=0;
	  		$totalTarjetas =$totalTarjetas-350;
	  		echo "<center style='color:#DFD326;'> &nbsp;&nbsp;".$arregloTipoTarjetas."&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; $".$costo."</center><br><br><br>";
	  		}
	  	}
	  	if ($i+3 < $nfilas) 
	  	{
		  	if ($arregloCosto[$i] + $arregloCosto[$i+2] + $arregloCosto[$i+3] == 2100) {
	  		$arregloTipoTarjetas = "Kit   ";
	  		$costo=1750;
	  		$arregloCosto[$i] = 0;
	  		$arregloCosto[$i+2]=0;
	  		$arregloCosto[$i+3]=0;
	  		$totalTarjetas =$totalTarjetas-350;
	  		echo "<center style='color:#DFD326;'> &nbsp;&nbsp;".$arregloTipoTarjetas."&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; $".$costo."</center><br><br><br>";
	  		}
	  	}
	  	if ($i+4 < $nfilas) 
	  	{
		  	if ($arregloCosto[$i] + $arregloCosto[$i+3] + $arregloCosto[$i+4] == 2100) {
	  		$arregloTipoTarjetas = "Kit   ";
	  		$costo=1750;
	  		$arregloCosto[$i] = 0;
	  		$arregloCosto[$i+3]=0;
	  		$arregloCosto[$i+4]=0;
	  		$totalTarjetas =$totalTarjetas-350;
	  		echo "<center style='color:#DFD326;'> &nbsp;&nbsp;".$arregloTipoTarjetas."&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; $".$costo."</center><br><br><br>";
	  		}
	  	}
	  	if ($i+5 < $nfilas) 
	  	{
		  	if ($arregloCosto[$i] + $arregloCosto[$i+4] + $arregloCosto[$i+5] == 2100) {
	  		$arregloTipoTarjetas = "Kit   ";
	  		$costo=1750;
	  		$arregloCosto[$i] = 0;
	  		$arregloCosto[$i+4]=0;
	  		$arregloCosto[$i+5]=0;
	  		$totalTarjetas =$totalTarjetas-350;
	  		echo "<center style='color:#DFD326;'> &nbsp;&nbsp;".$arregloTipoTarjetas."&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; $".$costo."</center><br><br><br>";
	  		}
	  	}
	  	if ($i+6 < $nfilas) 
	  	{
		  	if ($arregloCosto[$i] + $arregloCosto[$i+5] + $arregloCosto[$i+6] == 2100) {
	  		$arregloTipoTarjetas = "Kit   ";
	  		$costo=1750;
	  		$arregloCosto[$i] = 0;
	  		$arregloCosto[$i+5]=0;
	  		$arregloCosto[$i+6]=0;
	  		$totalTarjetas =$totalTarjetas-350;
	  		echo "<center style='color:#DFD326;'> &nbsp;&nbsp;".$arregloTipoTarjetas."&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; $".$costo."</center><br><br><br>";
	  		}
	  	}
	} */

	for ($i=0; $i < $nfilas; $i++) 
	{
		//1 Vehicular 1 Peatonal
	  	if ($i+1 < $nfilas) 
	  	{
		  	if ($arregloCosto[$i] + $arregloCosto[$i+1] == 850) 
		  	{
		  		$arregloTipoTarjetas = "Kit   ";
		  		$costo=750;
		  		$arregloCosto[$i] = 0;
		  		$arregloCosto[$i+1]=0;
		  		$totalTarjetas =$totalTarjetas-100;
		  		echo "<center style='color:#DFD326;'> &nbsp;&nbsp;".$arregloTipoTarjetas."&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; $".$costo."</center><br><br><br>";
	  		}
	  	}
	  	if ($i+2 < $nfilas) 
	  	{
		  	if ($arregloCosto[$i] + $arregloCosto[$i+2] == 850) 
		  	{
		  		$arregloTipoTarjetas = "Kit   ";
		  		$costo=750;
		  		$arregloCosto[$i] = 0;
		  		$arregloCosto[$i+2]=0;
		  		$totalTarjetas =$totalTarjetas-100;
		  		echo "<center style='color:#DFD326;'> &nbsp;&nbsp;".$arregloTipoTarjetas."&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; $".$costo."</center><br><br><br>";
	  		}
	  	}
	  	if ($i+3 < $nfilas) 
	  	{
		  	if ($arregloCosto[$i] + $arregloCosto[$i+3] == 850) 
		  	{
		  		$arregloTipoTarjetas = "Kit   ";
		  		$costo=750;
		  		$arregloCosto[$i] = 0;
		  		$arregloCosto[$i+3]=0;
		  		$totalTarjetas =$totalTarjetas-100;
		  		echo "<center style='color:#DFD326;'> &nbsp;&nbsp;".$arregloTipoTarjetas."&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; $".$costo."</center><br><br><br>";
	  		}
	  	}
	  	if ($i+4 < $nfilas) 
	  	{
		  	if ($arregloCosto[$i] + $arregloCosto[$i+4] == 850) 
		  	{
		  		$arregloTipoTarjetas = "Kit   ";
		  		$costo=750;
		  		$arregloCosto[$i] = 0;
		  		$arregloCosto[$i+4]=0;
		  		$totalTarjetas =$totalTarjetas-100;
		  		echo "<center style='color:#DFD326;'> &nbsp;&nbsp;".$arregloTipoTarjetas."&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; $".$costo."</center><br><br><br>";
	  		}
	  	}
	  	if ($i+5 < $nfilas) 
	  	{
		  	if ($arregloCosto[$i] + $arregloCosto[$i+5] == 850) 
		  	{
		  		$arregloTipoTarjetas = "Kit   ";
		  		$costo=750;
		  		$arregloCosto[$i] = 0;
		  		$arregloCosto[$i+5]=0;
		  		$totalTarjetas =$totalTarjetas-100;
		  		echo "<center style='color:#DFD326;'> &nbsp;&nbsp;".$arregloTipoTarjetas."&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; $".$costo."</center><br><br><br>";
	  		}
	  	}
	  	if ($i+6 < $nfilas) 
	  	{
		  	if ($arregloCosto[$i] + $arregloCosto[$i+6] == 850) 
		  	{
		  		$arregloTipoTarjetas = "Kit   ";
		  		$costo=750;
		  		$arregloCosto[$i] = 0;
		  		$arregloCosto[$i+6]=0;
		  		$totalTarjetas =$totalTarjetas-100;
		  		echo "<center style='color:#DFD326;'> &nbsp;&nbsp;".$arregloTipoTarjetas."&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; $".$costo."</center><br><br><br>";
	  		}
	  	}

		if ($arregloCosto[$i] != 0) 
		{
			if ($arregloCosto[$i] ==150) 
			{
				$arregloTipoTarjetas = "Peatonal";
			}
			if ($arregloCosto[$i] ==700) 
			{
				$arregloTipoTarjetas = "Vehicular";
			}
			if ($arregloCosto[$i] ==1000) 
			{
				$arregloTipoTarjetas = "Tag";
			}
			echo "<center style='color:#DFD326;'>".$arregloTipoTarjetas."&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp; $".$arregloCosto[$i]."</center><br><br><br>";
		}
	}
}

echo "<center style='color:white; font-size:14px;'>"."Usted ha registrado ".$nfilas." tarjeta(s): ".$resultadosTiposTarjetas."<br><br> con los siguientes números: ".$resultadoNumerosTarjetas. "</center><br><br>";
echo "<center style='color:#FFE101; font-size:36px;'>"."Total: $". $totalTarjetas . "</center><br><br> ";

$residentes = $_REQUEST['residentes'];
$nfilas = count($residentes);
$resultadoResidentes="";

for($i=0;$i<$nfilas;$i++)
{
	if ($residentes[$i] != "")
	{
		$resultadoResidentes = $resultadoResidentes." <br> ". $residentes[$i];
	}
}

$visitantes = $_REQUEST['visitantes'];
$nfilas = count($visitantes);
$resultadoVisitantes="";

for($i=0;$i<$nfilas;$i++)
{
	if ($visitantes[$i] != "")
	{
		$resultadoVisitantes = $resultadoVisitantes." <br> ". $visitantes[$i];
	}
}

if ($residencia == 2)
{
	$residencia = "Tosali";
	$id_privada = 61;
}
if ($residencia == 3)
{
	$residencia = "Banus C2";
	$id_privada = 63;
}
$ciudad=$_POST['ciudad'];
$estado=$_POST['estado1'];
$codigoPostal=$_POST['CP'];
$telefonoCasa=$_POST['telCasa'];
$telefonoCelular=$_POST['telCel'];
$correoElectronico=$_POST['correo'];
$dudasComentarios=$_POST['dudasComentarios'];
$interfon=$_POST['chk'];

if ($interfon == 1) 
{
	$interfon = "Casa";
}
if ($interfon == 2) 
{
	$interfon = "Celular";
}

if ($id_privada == 60 )
{
	for ($i=600001; $i < 610000 ; $i++) 
	{ 
		$sql="SELECT * FROM usuarios where id_registro='".$i."'";
		$result = mysql_query($sql);
		if(mysql_num_rows($result)==0) 
		{
			$siguiente_id = $i;
			$i=999999;
		}
	}
}


if ($id_privada == 61 )
{
	for ($i=610001; $i < 620000 ; $i++) 
	{ 
		$sql="SELECT * FROM usuarios where id_registro='".$i."'";
		$result = mysql_query($sql);
		if(mysql_num_rows($result)==0) 
		{
			$siguiente_id = $i;
			$i=999999;
		}
	}
}

if ($id_privada == 62 )
{
	for ($i=620001; $i < 630000 ; $i++) 
	{ 
		$sql="SELECT * FROM usuarios where id_registro='".$i."'";
		$result = mysql_query($sql);
		if(mysql_num_rows($result)==0) 
		{
			$siguiente_id = $i;
			$i=999999;
		}
	}
}

if ($id_privada == 63 )
{
	for ($i=630001; $i < 640000 ; $i++) 
	{ 
		$sql="SELECT * FROM usuarios where id_registro='".$i."'";
		$result = mysql_query($sql);
		if(mysql_num_rows($result)==0) 
		{
			$siguiente_id = $i;
			$i=999999;
		}
	}
}

$id_registro = $siguiente_id;
$banco="BANORTE";
$nombreCuenta = "JOSE MIGUEL RUIZ DIAZ";
$numeroCuenta = "0800973111";
$clabe = "072730008009731117";
$numeroReferencia = $id_registro.$numeroExterior;
/*
echo '<center><table style="width:60%"><tr><td><form  name="formTarjeta" id="formTarjeta" method="post"  action="pagar_tarjeta.php">
    <br><br><br>
    <input type="hidden" name="nombreRes" id="nombreRes" value="'.$nombre.'"/>
    
    <input type="hidden" name="apPaternoRes" id="apPaternoRes" value="'.$apellidoPaterno.'"/>
    
    <input type="hidden" name="apMaternoRes" id="apMaternoRes"  value="'.$apellidoMaterno.'"/>
    
    <input type="hidden" name="calle"  id="calle"  value="'.$calle.'"/>
    
    <input type="hidden" name="numExt" id="numExt"  value="'.$numeroExterior.'"/>

    <input type="hidden" name="residencia" id="residencia"  value="'.$residencia.'" />

    <input type="hidden" name="ciudad" id="ciudad" value="'.$ciudad.'"/>

    <input type="hidden" name="estado1" id="estado1"  value="'.$estado.'"/>

    <input type="hidden" name="CP" id="CP"  value="'.$codigoPostal.'"/>

    <input type="hidden" name="telCasa" id="telCasa"  value="'.$telefonoCasa.'"/>

    <input type="hidden" name="telCel" id="telCel" value="'.$telefonoCelular.'" />

    <input type="hidden" name="interfon" id="interfon" value="'.$interfon.'"/>

    <input type="hidden" name="correo" id="correo" value="'.$correoElectronico.'"/>

	<input type="hidden" name="tarjetasCompradas" id="tarjetasCompradas"  value="'.$resultadosTiposTarjetas.'"/>

    <input type="hidden" name="numerosTarjetas" id="numerosTarjetas" value="'.$resultadoNumerosTarjetas.'" />

    <input type="hidden" name="residentesRegistrados" id="residentesRegistrados" value="'.$resultadoResidentes.'"/>

    <input type="hidden" name="visitantesRegistrados" id="visitantesRegistrados" value="'.$resultadoVisitantes.'"/>

	<input type="hidden" name="dudasComentarios" id="dudasComentarios" value="'.$dudasComentarios.'"/>

	<input type="hidden" name="idPrivada" id="idPrivada" value="'.$id_privada.'"/>

	<input type="hidden" name="idRegistro" id="idRegistro" value="'.$id_registro.'"/>

	<input type="hidden" name="numeroReferencia" id="numeroReferencia" value="'.$numeroReferencia.'"/>

	<input type="hidden" name="total" id="total" value="'.$totalTarjetas.'"/>

<br><br>

<br><br>
</form></td>

<td><form  name="formEfectivo" id="formEfectivo" method="post"  action="pagar_efectivo.php">
<br><br><br>
    <input type="hidden" name="nombreRes" id="nombreRes" value="'.$nombre.'"/>
    
    <input type="hidden" name="apPaternoRes" id="apPaternoRes" value="'.$apellidoPaterno.'"/>
    
    <input type="hidden" name="apMaternoRes" id="apMaternoRes"  value="'.$apellidoMaterno.'"/>
    
    <input type="hidden" name="calle"  id="calle"  value="'.$calle.'"/>
    
    <input type="hidden" name="numExt" id="numExt"  value="'.$numeroExterior.'"/>

    <input type="hidden" name="residencia" id="residencia"  value="'.$residencia.'" />

    <input type="hidden" name="ciudad" id="ciudad" value="'.$ciudad.'"/>

    <input type="hidden" name="estado1" id="estado1"  value="'.$estado.'"/>

    <input type="hidden" name="CP" id="CP"  value="'.$codigoPostal.'"/>

    <input type="hidden" name="telCasa" id="telCasa"  value="'.$telefonoCasa.'"/>

    <input type="hidden" name="telCel" id="telCel" value="'.$telefonoCelular.'" />

    <input type="hidden" name="interfon" id="interfon" value="'.$interfon.'"/>

    <input type="hidden" name="correo" id="correo" value="'.$correoElectronico.'"/>

	<input type="hidden" name="tarjetasCompradas" id="tarjetasCompradas"  value="'.$resultadosTiposTarjetas.'"/>

    <input type="hidden" name="numerosTarjetas" id="numerosTarjetas" value="'.$resultadoNumerosTarjetas.'" />

    <input type="hidden" name="residentesRegistrados" id="residentesRegistrados" value="'.$resultadoResidentes.'"/>

    <input type="hidden" name="visitantesRegistrados" id="visitantesRegistrados" value="'.$resultadoVisitantes.'"/>

	<input type="hidden" name="dudasComentarios" id="dudasComentarios" value="'.$dudasComentarios.'"/>

	<input type="hidden" name="idPrivada" id="idPrivada" value="'.$id_privada.'"/>

	<input type="hidden" name="idRegistro" id="idRegistro" value="'.$id_registro.'"/>

	<input type="hidden" name="numeroReferencia" id="numeroReferencia" value="'.$numeroReferencia.'"/>

	<input type="hidden" name="total" id="total" value="'.$totalTarjetas.'"/>
	<input type="submit" name="pagoEfectivo" class="pagoEfectivo" value="Pago en Efectivo" ></input>
<br><br>
<img name="logosPagos" id="logosPagos" src="images/tiendas.png">
<br><br>
</form></td>

<td><form name="formDeposito" id="formDeposito" method="post"  action="pagar_deposito.php">
    <br><br><br>
    <input type="hidden" name="nombreRes" id="nombreRes" value="'.$nombre.'"/>
    
    <input type="hidden" name="apPaternoRes" id="apPaternoRes" value="'.$apellidoPaterno.'"/>
    
    <input type="hidden" name="apMaternoRes" id="apMaternoRes"  value="'.$apellidoMaterno.'"/>
    
    <input type="hidden" name="calle"  id="calle"  value="'.$calle.'"/>
    
    <input type="hidden" name="numExt" id="numExt"  value="'.$numeroExterior.'"/>

    <input type="hidden" name="residencia" id="residencia"  value="'.$residencia.'" />

    <input type="hidden" name="ciudad" id="ciudad" value="'.$ciudad.'"/>

    <input type="hidden" name="estado1" id="estado1"  value="'.$estado.'"/>

    <input type="hidden" name="CP" id="CP"  value="'.$codigoPostal.'"/>

    <input type="hidden" name="telCasa" id="telCasa"  value="'.$telefonoCasa.'"/>

    <input type="hidden" name="telCel" id="telCel" value="'.$telefonoCelular.'" />

    <input type="hidden" name="interfon" id="interfon" value="'.$interfon.'"/>

    <input type="hidden" name="correo" id="correo" value="'.$correoElectronico.'"/>

	<input type="hidden" name="tarjetasCompradas" id="tarjetasCompradas"  value="'.$resultadosTiposTarjetas.'"/>

    <input type="hidden" name="numerosTarjetas" id="numerosTarjetas" value="'.$resultadoNumerosTarjetas.'" />

    <input type="hidden" name="residentesRegistrados" id="residentesRegistrados" value="'.$resultadoResidentes.'"/>

    <input type="hidden" name="visitantesRegistrados" id="visitantesRegistrados" value="'.$resultadoVisitantes.'"/>

	<input type="hidden" name="dudasComentarios" id="dudasComentarios" value="'.$dudasComentarios.'"/>

	<input type="hidden" name="idPrivada" id="idPrivada" value="'.$id_privada.'"/>

	<input type="hidden" name="idRegistro" id="idRegistro" value="'.$id_registro.'"/>

	<input type="hidden" name="numeroReferencia" id="numeroReferencia" value="'.$numeroReferencia.'"/>

	<input type="hidden" name="total" id="total" value="'.$totalTarjetas.'"/>
	<input type="submit" name="pagoDeposito" class="pagoDeposito" value="Pago por Depósito" ></input>
<br><br>
<img name="logosPagos" id="logosPagos" src="images/banorte.png">
<br><br>
</form></td>

<td><form name="formNoPagar" id="formNoPagar" method="post"  action="no_pagar.php">

    <input type="hidden" name="nombreRes" id="nombreRes" value="'.$nombre.'"/>
    
    <input type="hidden" name="apPaternoRes" id="apPaternoRes" value="'.$apellidoPaterno.'"/>
    
    <input type="hidden" name="apMaternoRes" id="apMaternoRes"  value="'.$apellidoMaterno.'"/>
    
    <input type="hidden" name="calle"  id="calle"  value="'.$calle.'"/>
    
    <input type="hidden" name="numExt" id="numExt"  value="'.$numeroExterior.'"/>

    <input type="hidden" name="residencia" id="residencia"  value="'.$residencia.'" />

    <input type="hidden" name="ciudad" id="ciudad" value="'.$ciudad.'"/>

    <input type="hidden" name="estado1" id="estado1"  value="'.$estado.'"/>

    <input type="hidden" name="CP" id="CP"  value="'.$codigoPostal.'"/>

    <input type="hidden" name="telCasa" id="telCasa"  value="'.$telefonoCasa.'"/>

    <input type="hidden" name="telCel" id="telCel" value="'.$telefonoCelular.'" />

    <input type="hidden" name="interfon" id="interfon" value="'.$interfon.'"/>

    <input type="hidden" name="correo" id="correo" value="'.$correoElectronico.'"/>

	<input type="hidden" name="tarjetasCompradas" id="tarjetasCompradas"  value="'.$resultadosTiposTarjetas.'"/>

    <input type="hidden" name="numerosTarjetas" id="numerosTarjetas" value="'.$resultadoNumerosTarjetas.'" />

    <input type="hidden" name="residentesRegistrados" id="residentesRegistrados" value="'.$resultadoResidentes.'"/>

    <input type="hidden" name="visitantesRegistrados" id="visitantesRegistrados" value="'.$resultadoVisitantes.'"/>

	<input type="hidden" name="dudasComentarios" id="dudasComentarios" value="'.$dudasComentarios.'"/>

	<input type="hidden" name="idPrivada" id="idPrivada" value="'.$id_privada.'"/>

	<input type="hidden" name="idRegistro" id="idRegistro" value="'.$id_registro.'"/>

	<input type="hidden" name="numeroReferencia" id="numeroReferencia" value="'.$numeroReferencia.'"/>

	<input type="hidden" name="total" id="total" value="'.$totalTarjetas.'"/>
	<input type="submit" name="noPagar" class="noPagar" value="Sólo Registro" ></input>
<br><br>
</form></td>

</tr></table><center>';
*/
?>