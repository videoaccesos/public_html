<?php 

//LIBRERIAS
require 'phpqrcode/qrlib.php';
//CABECERAS
header("Content-type: text/html; charset=UTF-8") ;
header("Content-Type: application/json; charset=UTF-8");
$method = $_SERVER['REQUEST_METHOD'];
//DATOS Y CONEXION A BASE DE DATOS
$server = "localhost";
$username = "wwwvideo_root";
$password = "V1de0@cces0s";
$database = "wwwvideo_video_accesos";
$conexion = @new mysqli($server, $username, $password, $database);

if ($conexion->connect_error)
{
    die('Error de conexion: ' . $conexion->connect_error);
}

//CACHAMOS EL CONTENIDO DEL BODY
if($method == 'POST'){
$requestBody = file_get_contents('php://input');
$json = json_decode($requestBody);

//SACAMOS DEL JSON EL VALOR DE LA INTENCION
$intencion = $json->queryResult->intent->displayName;

//DECLARAMOS LAS VARIABLES GLOBALES PARA VALIDAR
$idPrivada=0;
$telefono="";
$servicio=0;
$estatus=0;
$residenteID="";
$numeroTarjeta="";
$boolTelefonoActivo=false;
$boolServicioActivo=false;
$boolEstatusActivo=false;
$boolNombreUsuario=false;
$speech="";
$fechaAcceso = date("Y-m-d H:i:s");
$rutaInfoQR="";

//INTENCION DE MENSAJE DE BIENVENIDA
if($intencion == "bienvenidaSmsWhatsapp")
{
	$telefonoSms = $json->queryResult->parameters->telefonoSms;
	//CONSULTAMOS SI EL TELEFONO ES VALIDO
	$sqlTelefono="SELECT telefono, residente_id FROM servicio_accesosqr WHERE telefono='".$telefonoSms."'";
	$consultaTelefono = $conexion->query($sqlTelefono);

	while($registroTelefono=$consultaTelefono->fetch_assoc())
	{
		$residenteID=$registroTelefono["residente_id"];
		$boolTelefonoActivo=true;
	}
	
	if($boolTelefonoActivo == true)
	{
		//CONSULTAMOS EL NOMBRE DEL USUARIO
		$sqlNombreUsuario="SELECT nombre FROM residencias_residentes WHERE residente_id='".$residenteID."'";
		$consultaNombreUsuario = $conexion->query($sqlNombreUsuario);
	   
		while($registroNombreUsuario=$consultaNombreUsuario->fetch_assoc())
		{
			$nombreUsuario = $registroNombreUsuario["nombre"];
			$boolNombreUsuario=true;
		}
		
		if($boolNombreUsuario==true)
		{
			$speech = "¡Hola ".$nombreUsuario."! Soy el asistente virtual VB, Para ayudarte elige una de las opciones que te doy a continuación : ACCESOS, AYUDA, QUEJAS.";
		}
	}
	else
	{
		$speech = "¡Hola! soy el asistente virtual VB, Para ayudarte elige una de las opciones que te doy a continuación : ACCESOS, AYUDA, QUEJAS.";
	}
	
}

//INTENCION PARA VALIDAR SI TIENE ACCESO (CON TELEFONO Y PRIVADA)
if($intencion == "accesos - TelPrivada")
{
	//CACHAMOS LAS VARIABLES QUE USAREMOS DEL JSON
	$telefono = $json->queryResult->parameters->telefono;
	$privada = $json->queryResult->parameters->privada;

	//CONSULTAMOS SI LA PRIVADA ES VALIDA
	$sqlPrivada="SELECT privada_id FROM privadas WHERE descripcion='".$privada."'";
	$consultaPrivada = $conexion->query($sqlPrivada);

	while($registroPrivada=$consultaPrivada->fetch_assoc())
	{
	    $idPrivada = $registroPrivada["privada_id"];
	}
	//SI LA PRIVADA ES VALIDA CONTINUAMOS
	if($idPrivada!=0)
	{
		try
		{
			//CONSULTAMOS SI EL TELEFONO ES VALIDO
			$sqlTelefono="SELECT telefono, residente_id FROM servicio_accesosqr WHERE privada_id=$idPrivada 
			AND telefono='".$telefono."'";
			$consultaTelefono = $conexion->query($sqlTelefono);

			while($registroTelefono=$consultaTelefono->fetch_assoc())
			{
			    $telefono = $registroTelefono["telefono"];
			    $residenteID=$registroTelefono["residente_id"];
			    $boolTelefonoActivo=true;
			}

			if ($boolTelefonoActivo == true) 
			{
				//CONSULTAMOS SI TIENE SERVICIO
				$sqlServicio="SELECT servicio FROM servicio_accesosqr WHERE privada_id=$idPrivada AND servicio=1 
				AND telefono='".$telefono."'";
				$consultaServicio = $conexion->query($sqlServicio);

				while($registroServicio=$consultaServicio->fetch_assoc())
				{
				    $servicio = $registroServicio["servicio"];
				    $boolServicioActivo=true;
				}

				if($boolServicioActivo == true)
				{
					//CONSULTAMOS SI ESTA ACTIVO EL SERVICIO (ESTATUS)
					$sqlEstatus="SELECT * FROM servicio_accesosqr WHERE privada_id=$idPrivada AND 
					telefono=$telefono AND servicio=1 AND estatus_id=1";
					$consultaEstatus = $conexion->query($sqlEstatus);

					while($registroEstatus=$consultaEstatus->fetch_assoc())
					{
					    $estatus = $registroEstatus["estatus_id"];
					    $boolEstatusActivo=true;
					}

					if($boolEstatusActivo == true)
					{
						//CONSULTAMOS EL NOMBRE DEL USUARIO
						$sqlNombreUsuario="SELECT nombre FROM residencias_residentes WHERE residente_id='".$residenteID."'";
						$consultaNombreUsuario = $conexion->query($sqlNombreUsuario);

						while($registroNombreUsuario=$consultaNombreUsuario->fetch_assoc())
						{
						    $nombreUsuario = $registroNombreUsuario["nombre"];
						    $boolNombreUsuario = true;
						}

						if($boolNombreUsuario == true)
						{
							$speech = strtoupper($nombreUsuario)." para dar acceso temporal, indique la fecha, hora, duración y número de accesos. (Ejemplo: DAR ACCESO 20 de marzo a las 11am por 15 min a 5 personas)";
						}
						else
						{
							$speech = "Para dar acceso temporal, indique la fecha, hora, duración y número de accesos. (Ejemplo: DAR ACCESO 20 de marzo a las 11am por 15 min a 5 personas)";
						}
					}
					else
					{
						$speech="Tu servicio ha sido dado de baja. Vea AYUDA para más información.";
					}
				}
				else
				{
					$speech="No cuentas con el servicio para dar acceso temporal. Vea AYUDA para más información.";
				}

			}
			else
			{
				$speech="El teléfono proporcionado no esta registrado, vea AYUDA para más información.";
			}

		}
		catch (PDOException $e)
		{
		$speech = "Error al procesar la charla, comuniquese al Tel. (667)**";
		}
	}
	else
	{
		$speech = "El nombre de la privada no está registrado, vea AYUDA para más información.";
	}
}

//INTENCION PARA GUARDAR LOS DATOS DEL ACCESO Y GENERAR QR
if ($intencion == "accesos - TelPrivada - FechaHoraAccesos - yes") 
{
	//CACHAMOS LOS VALORES DEL JSON PARA CONSULTAR Y GUARDAR
	$telefono = $json->queryResult->parameters->telefono;
	$privada = $json->queryResult->parameters->privada;
	$fecha = $json->queryResult->parameters->fecha;
	$hora = $json->queryResult->parameters->hora;
	$minutos = $json->queryResult->parameters->minutos;
	$personas = $json->queryResult->parameters->personas;
	$fechaRecortada = "";
	$horaRecortada = "";

	//CONSULTAMOS LA PRIVADA PARA SACAR EL ID
	$sqlPrivada="SELECT privada_id FROM privadas WHERE descripcion='".$privada."'";
	$consultaPrivada = $conexion->query($sqlPrivada);

	while($registroPrivada=$consultaPrivada->fetch_assoc())
	{
	    $idPrivada = $registroPrivada["privada_id"];
	}

	//CONSULTAMOS EL ID DEL RESIDENTE 
	$sqlTelefono="SELECT residente_id, tarjeta FROM servicio_accesosqr WHERE privada_id=$idPrivada AND telefono='".$telefono."'";
	$consultaTelefono = $conexion->query($sqlTelefono);

	while($registroTelefono=$consultaTelefono->fetch_assoc())
	{
	    $residenteID=$registroTelefono["residente_id"];
	    $numeroTarjeta=$registroTelefono["tarjeta"];
	}

	//RECORTAMOS LAS VARIABLES PARA FECHA Y HORA
	$fechaRecortada = substr($fecha,0,10);
	$horaRecortada = substr($hora, 11, 5);
	$fechaAutorizacion = $fechaRecortada.' '.$horaRecortada;

    //TOMAMOS EL ID DEL ULTIMO ACCESO REGISTRADO Y LE SUMAMOS UNO (ES EL QUE SIGUE DE GUARDARSE) PARA PONERLO EN EL QR
    $sqlUltimoID="SELECT MAX(acceso_id) AS id FROM accesosqr";
	$consultaUltimoID = $conexion->query($sqlUltimoID);

	while($registroUltimoID=$consultaUltimoID->fetch_assoc())
	{
	    $idAcceso = $registroUltimoID["id"]+1;
	}
    
	//GENERAMOS LA URL CODIFICADA PARA EL QR
	$urlCodificada = base64_encode($idAcceso.",".$numeroTarjeta.",".$personas.",".$fechaAutorizacion);
    
	//GENERAMOS EL QR
	$dir = 'imagenesQR/';	
	if(!file_exists($dir))
		mkdir($dir);
	$filename = $dir.'qr'.$urlCodificada.'.png';
	$tamanio = 5;
	$level = 'H';
	$frameSize = 1;
	// $rutaArchivo = "https://www.videoaccesos.net/serviciosVB/".$filename;
	$contenido = $urlCodificada;
	QRcode::png($contenido, $filename, $level, $tamanio, $frameSize);

	//GUARDAMOS LOS DATOS DEL ACCESO
	$insercionAcceso = "INSERT INTO accesosqr VALUES (0,'$residenteID','$numeroTarjeta',$idPrivada,'$telefono','$fechaRecortada','$horaRecortada','$minutos',$personas,'$urlCodificada', '$fechaAcceso')";
      $finalInsercionAcceso= $conexion->query($insercionAcceso);

    //RUTA INFORMACION QR
	$rutaInfoQR="https://www.videoaccesos.com/serviciosVB/infoQR.php?qr=".$urlCodificada;
	
	//RECORTAR URL
	$url = 'https://api-ssl.bitly.com/v3/shorten?longUrl='.$rutaInfoQR.'&access_token=ca4d8aa93120f420181bfdba886f19b1ca216955';//access token de bitly
    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET"); 
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    
    $arr_result = curl_exec($ch);
    
    $arr_response = json_decode($arr_result);
    
    $urlRecortada = $arr_response->data->url;

	//RESPUESTA DEL BOT
    $speech = "¡Tu acceso ha sido creado exitosamente! El link con la información es el siguiente: ".$urlRecortada;

}

//INTENCION PARA VALIDAR SI TIENE ACCESO (CON TELEFONO Y PRIVADA)
if($intencion == "solicitudQR_telefono")
{
	try
	{
    	//CACHAMOS LAS VARIABLES QUE USAREMOS DEL JSON
    	$telefono = $json->queryResult->parameters->telefonoProporcionado;
        
        $boolTelEncontrado = false;
        $idPrivada= "";
        $nroCasa="";
        $calle="";
        
    	$sqlDatosPersona="SELECT privada_id, nro_casa, calle FROM residencias WHERE telefono_interfon='".$telefono."' LIMIT 1";
    	$consultaDatosPersona = $conexion->query($sqlDatosPersona);
    
    	while($registroDatosPersona=$consultaDatosPersona->fetch_assoc())
    	{
    	    $idPrivada = $registroDatosPersona["privada_id"];
    	    $nroCasa = $registroDatosPersona["nro_casa"];
    	    $calle = $registroDatosPersona["calle"];
    	    $boolTelEncontrado = true;
    	}
    	
        if ($boolTelEncontrado == true)
        {
        	$sqlPrivada="SELECT descripcion FROM privadas WHERE privada_id=".$idPrivada;
        	$consultaPrivada = $conexion->query($sqlPrivada);
        
        	while($registroPrivada=$consultaPrivada->fetch_assoc())
        	{
        	    $privada = $registroPrivada["descripcion"];
        	}
        	$speech="Su teléfono se encuentra registrado en el domicilio *".$calle." #".$nroCasa."* de la privada *".$privada."*. Escriba la fecha en la que desea generar el QR, ejemplo: *Fecha 01-01-2019*";
        }
        else
        {
            $speech="Su teléfono no se encuentra registrado, favor de intentar con otro o cumunicarse al 7126043 - 7126045 para mayor información.";
        }
	}
	catch (PDOException $e)
	{
	$speech = "Error al procesar la charla, comuniquese al Tel. (667)**";
	}
}


//INTENCION PARA GUARDAR LOS DATOS DEL ACCESO Y GENERAR QR
if ($intencion == "solicitudQR_fecha") 
{
	//CACHAMOS LOS VALORES DEL JSON PARA CONSULTAR Y GUARDAR
	$telefono = $json->queryResult->parameters->telefonoProporcionado;
	$fecha = $json->queryResult->parameters->fechaProporcionada;
	
    $boolTelEncontrado = false;
    $idPrivada= "";
    $nroCasa="";
    $calle="";
    
    $sqlDatosPersona="SELECT privada_id, nro_casa, calle FROM residencias WHERE telefono_interfon='".$telefono."' LIMIT 1";
    	$consultaDatosPersona = $conexion->query($sqlDatosPersona);
    
	while($registroDatosPersona=$consultaDatosPersona->fetch_assoc())
	{
	    $idPrivada = $registroDatosPersona["privada_id"];
	    $nroCasa = $registroDatosPersona["nro_casa"];
	    $calle = $registroDatosPersona["calle"];
	    $boolTelEncontrado = true;
	}
	
	//GENERAMOS LA URL CODIFICADA PARA EL QR
	$urlCodificada = base64_encode($idPrivada.",".$calle.",".$nroCasa.",".$telefono.",".$fecha);
    
	//GENERAMOS EL QR
	$dir = 'imagenesQR/';	
	if(!file_exists($dir))
		mkdir($dir);
	$filename = $dir.'qr'.$urlCodificada.'.png';
	$tamanio = 5;
	$level = 'H';
	$frameSize = 1;
	// $rutaArchivo = "https://www.videoaccesos.net/serviciosVB/".$filename;
	$contenido = $urlCodificada;
	QRcode::png($contenido, $filename, $level, $tamanio, $frameSize);

	//GUARDAMOS LOS DATOS DEL ACCESO
	$insercionAcceso = "INSERT INTO accessbot_accesosqr VALUES (0,$idPrivada,'$calle','$nroCasa','$telefono','$urlCodificada','$fecha','')";
      $finalInsercionAcceso= $conexion->query($insercionAcceso);

    //RUTA INFORMACION QR
	$rutaInfoQR="https://www.videoaccesos.net/serviciosVB/infoQRBot.php?qr=".$urlCodificada;
	$login="o_13in253bfv";
	$apiKey="R_93b0ae466f8c467cacbd5b3d9d8abb72";
	$url= "https://api-ssl.bitly.com/v3/shorten?login=".$login."&apiKey=".$apiKey."&longUrl=".$rutaInfoQR;
	//RECORTAR URL
	/*$url = 'https://api-ssl.bitly.com/v3/shorten?longUrl='.$rutaInfoQR.'&access_token=a11d972f87c9d530db00fb12b87fb60a37882943';//access token de bitly
    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET"); 
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    
    $arr_result = curl_exec($ch);
    
    $arr_response = json_decode($arr_result);
    
    $urlRecortada = $arr_response->data->url;*/

	//RESPUESTA DEL BOT
    $speech = "¡Tu acceso ha sido creado exitosamente! El link con la información es el siguiente: ".$rutaInfoQR;

}

//REGRESA LA RESPUESTA
$response = new \stdClass();
$response->fulfillmentText = $speech;
//$response->speech = $speech;
//$response->facebook->text = $speech;
//$response->google->items->simpleResponse = $speech;
$response->source = "webhook";
echo json_encode($response);
}
else
{
	$speech = "Error al inicializar la charla, comuniquese al Tel. (667)*";
	$response = new \stdClass();
	$response->fulfillmentText = $speech;
	echo json_encode($response);
}
//CERRAMOS LA CONEXION A LA BASE DE DATOS
$conexion->close();
  
?>