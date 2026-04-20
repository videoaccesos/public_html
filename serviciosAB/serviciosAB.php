<?php 
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
$idPrivada=58;
$boolDomicilioActivo=false;
$boolResidenteActivo=false;
$speech="";
$numeroCasa="";
$nombreCalle="";
$residenciaID="";
$nombreSolicitante="";
$residenteID="";


if($intencion == "residente_avisitar")
{
	$numeroCasa = $json->queryResult->parameters->numeroCasa;
	$nombreCalle = $json->queryResult->parameters->nombreCalle;
	$nombreResidenteV = $json->queryResult->parameters->nombreResidenteV;
	$nombreSolicitante = $json->queryResult->parameters->nombreSolicitante;

	//CONSULTAMOS SI EL DOMICILIO ES VALIDO Y ESTE NO TIENE ADEUDOS
	$sqlDomicilio="SELECT residencia_id FROM residencias WHERE nro_casa='".$numeroCasa."' AND calle='".$nombreCalle."' AND estatus_id=1 AND privada_id='".$idPrivada."'";
	$consultaDomicilio = $conexion->query($sqlDomicilio);

	while($registroDomicilio=$consultaDomicilio->fetch_assoc())
	{
		$residenciaID=$registroDomicilio["residencia_id"];
		$boolDomicilioActivo=true;
	}

	$sqlResidente="SELECT residente_id FROM residencias_residentes WHERE residencia_id='".$residenciaID."' AND CONCAT(nombre,' ',ape_paterno,' ',ape_materno) LIKE '%".$nombreResidenteV."%'";
	$consultaResidente = $conexion->query($sqlResidente);

	while($registroResidente=$consultaResidente->fetch_assoc())
	{
		$residenteID=$registroResidente["residente_id"];
		$boolResidenteActivo=true;
	}
	
	if($boolResidenteActivo == true)
	{
		
		$speech = "Bienvenido ".$nombreSolicitante.", que tenga un excelente día";
	}
	else
	{
		$speech = "El residente ".$nombreResidenteV." no está registrado en ese domicilio, proporcione el nombre de nuevo por favor";
	}
	
}

//PRIMERA INTENCION PARA CREAR LA BANDEJA
if($intencion == "solicitante_nombre")
{
    $nombreSolicitante = $json->queryResult->parameters->nombreSolicitante;
    $nombreSolicitanteOriginal = strtoupper($json->queryResult->parameters->nombreSolicitante);

    $no_permitidas= array ("á","é","í","ó","ú","Á","É","Í","Ó","Ú","ñ","À","Ã","Ì","Ò","Ù","Ã™","Ã ","Ã¨","Ã¬","Ã²","Ã¹","ç","Ç","Ã¢","ê","Ã®","Ã´","Ã»","Ã‚","ÃŠ","ÃŽ","Ã”","Ã›","ü","Ã¶","Ã–","Ã¯","Ã¤","«","Ò","Ã","Ã„","Ã‹");
    $permitidas= array ("a","e","i","o","u","A","E","I","O","U","n","N","A","E","I","O","U","a","e","i","o","u","c","C","a","e","i","o","u","A","E","I","O","U","u","o","O","i","a","e","U","I","A","E");
    $nombreSolicitante = str_replace($no_permitidas, $permitidas ,$nombreSolicitante);

	//CREAMOS LA BANDEJA
	$query_nuevaBandeja = "INSERT INTO accessbot_bandeja VALUES (NULL,'','','','',0,'".$nombreSolicitante."','1','0','1','','','',0,'','','','')";

    $final= $conexion->query($query_nuevaBandeja);
    $speech="Muy bien ".$nombreSolicitante.", podría colocar su identificación por favor? Una vez que la coloque diga 'listo'.";
}

//INTENCION QUE SOLICITA LA IDENTIFICACIÓN
if ($intencion == "solicitante_nombre - yes")
{
    $nombreSolicitante = strtoupper($json->queryResult->parameters->nombreSolicitante);
    $nombreSolicitanteOriginal = strtoupper($json->queryResult->parameters->nombreSolicitante);
    
    //QUITAMOS LOS ACENTOS
    $no_permitidas= array ("á","é","í","ó","ú","Á","É","Í","Ó","Ú","ñ","À","Ã","Ì","Ò","Ù","Ã™","Ã ","Ã¨","Ã¬","Ã²","Ã¹","ç","Ç","Ã¢","ê","Ã®","Ã´","Ã»","Ã‚","ÃŠ","ÃŽ","Ã”","Ã›","ü","Ã¶","Ã–","Ã¯","Ã¤","«","Ò","Ã","Ã„","Ã‹");
    $permitidas= array ("a","e","i","o","u","A","E","I","O","U","n","N","A","E","I","O","U","a","e","i","o","u","c","C","a","e","i","o","u","A","E","I","O","U","u","o","O","i","a","e","U","I","A","E");
    //$no_permitidas= array ("á","é","í","ó","ú","Á","É","Í","Ó","Ú","ñ","Ñ","Ã","È","Ì","Ò","Ù","Ã™","Ã ","Ã¨","Ã¬","Ã²","Ã¹","ç","Ç","Ã¢","ê","Ã®","Ã´","Ã»","Ã‚","ÃŠ","ÃŽ","Ã”","Ã›","ü","Ã¶","Ã–","Ã¯","Ã¤","«","Ò","Ã","Ã„","Ã‹");//45
    //$permitidas= array ("a","e","i","o","u","A","E","I","O","U","n","N","A","E","I","O","U","a","a","a","a","a","c","a","a","a","a","a","a","u","A","A","A","A","u","o","a","a","a");//45 ,"a","a","a","a","a"

    $nombreSolicitante = str_replace($no_permitidas, $permitidas ,$nombreSolicitante);
    
    //SACAMOS EL ID DEL ULTIMO REGISTRO DE LA BANDEJA
 	$sqlID="SELECT MAX(id) AS id FROM accessbot_bandeja";
 	$consultaID = $conexion->query($sqlID);
    while($registroID=$consultaID->fetch_assoc())
 	{
 		$id = $registroID["id"];
 	}

	//Marcamos con valor "1" el estatus del ID
    $sqlQuery="UPDATE accessbot_bandeja SET estatus_identificacion = 1 WHERE id =".$id; 
    $final= $conexion->query($sqlQuery);
    
    //TIEMPO DE ESPERA PARA QUE LA APLICACION ANALICE LA IMAGEN DE LA IDENTIFICACION Y REGRESE EL VALOR
    //añadir un ciclo para consultar constantemente la bandeja
    $bool = false;
    $i = 0;
    //while (!$bool){
    //    $i++;
    //    sleep(1);
    //    $query="SELECT estatus_identificacion FROM accessbot_bandeja WHERE id =".$id; 
    //    
    //    if ($query == 2){
    //        $bool = true;
    //        break;
    //    }
    //    if ($i >= 7 ){
    //        $bool = true;
    //        //se detiene el ciclo por haber sobrepasado el tiempo de espera (10s)
    //        break;
    //    }
    //}
    sleep(7);
    
    //REVISAMOS SI EL CAMPO TEXTO_IDENTIFICACION SE GUARDO CORRECTAMENTE
 	$sqlTextoIdentificacion="SELECT texto_identificacion FROM accessbot_bandeja";
 	$consultaTextoIdentificacion = $conexion->query($sqlTextoIdentificacion);
    while($registroTextoIdentificacion=$consultaTextoIdentificacion->fetch_assoc())
 	{
 		$textoIdentificacion = $registroTextoIdentificacion["texto_identificacion"];
 	}
     
 	//SI LA IDENTIFICACION FUE LEIDA CORRECTAMENTE DEJAMOS CONTINUAR
 	if ($textoIdentificacion != "")
 	{
     	$boolEncontrado=false; //BANDERA PARA VALIDAR QUE ENCONTRÓ EL NOMBRE
     	$arregloNombre = explode(" ",$nombreSolicitante); //ARREGLO PARA SEPARAR EL NOMBRE
     	$max = sizeof($arregloNombre); //VARIABLE CON EL TOTAL DE POSICIONES DEL ARREGLO
     	
     	//BUSCAMOS SI EL NOMBRE PROPORCIONADO SE ENCUENTRA DENTRO DE EL TEXTO_IDENTIFICACIÓN GUARDADO
     	for($i=0;$i<$max;$i++)
     	{
     	    if ($boolEncontrado == false)
     	    {
     	        $boolEncontrado = strpos($textoIdentificacion, $arregloNombre[$i]);
     	    }
     	    else
     	    {
     	        continue;
     	    }
     	}
     	// SI LO ENCONTRO LE ENVIO EL MENSAJE DE QUE RETIRE LA IDENTIFICACION Y SI NO LE PIDO QUE PONGA OTRA IDENTIFICACION
 	    if ($boolEncontrado == true)
 	    {
            //$speech = "Gracias ".$nombreSolicitanteOriginal.", ya puede retirar su identificación, a qué domicilio se dirige?";
            $speech = "Gracias ".$nombreSolicitanteOriginal.", ya puede retirar su identificación, cual es el nombre de la calle a la que se dirige?";//cambiamos el dialogo para hacer mas robusto la confirmacion del domicilio

 	    }
 	    else
 	    {
 	        $speech = $nombreSolicitanteOriginal." su nombre no coincide con el de la identificación que está colocando, coloque otra identificación con su nombre, una vez que la coloque diga 'listo'";
 	        $sqlQuery="UPDATE accessbot_bandeja SET estatus_identificacion = 1 WHERE id =".$id; 
            $final= $conexion->query($sqlQuery);
 	    }
 	}
 	else
 	{
 	    $speech = $nombreSolicitanteOriginal." coloque correctamente su identificación por favor, una vez que la coloque diga 'listo'";
 	}
 }

//INTENCION PARA CACHAR EL DOMICILIO AL QUE SE DIRIGE
if($intencion == "residente_domicilio")
{
	$numeroCasa = $json->queryResult->parameters->numeroCasa;
	$nombreCalle = $json->queryResult->parameters->nombreCalle;
	$nombreSolicitante = $json->queryResult->parameters->nombreSolicitante;
	$boolCompleto=false;
	//CONSULTAMOS SI EL DOMICILIO ES VALIDO
	$sqlDomicilio="SELECT residencia_id FROM residencias WHERE nro_casa='".$numeroCasa."' AND calle='".$nombreCalle."' AND estatus_id=1 AND privada_id='".$idPrivada."'";
	$consultaDomicilio = $conexion->query($sqlDomicilio);

	while($registroDomicilio=$consultaDomicilio->fetch_assoc())
	{
		$residenciaID=$registroDomicilio["residencia_id"];
		$boolDomicilioActivo=true;
		//Aqui deberemos de revisar dos estatus, el primero tiene que ver con que el cliente sea moroso o no y el segundo tiene que ver con el hecho de que el residente haya
		//puesto no una restriccion de acceso a su domicilio a traves del servicio de interfon o access bot para ello tendremos que cachar 2 variables, estatus_id y la otra
		//el estatus_residencia_accesos <<-- este no existe habra que crearlo en la base de datos.
	}
	
	if($boolDomicilioActivo == true)
	{
	    //SACAMOS EL ID DEL ULTIMO REGISTRO DE LA BANDEJA
     	$sqlID="SELECT MAX(id) AS id FROM accessbot_bandeja";
     	$consultaID = $conexion->query($sqlID);
        while($registroID=$consultaID->fetch_assoc())
     	{
     		$id = $registroID["id"];
     	}
	    //Agregamos el domicilio a la bandeja
        $sqlQuery="UPDATE accessbot_bandeja SET calle ='".$nombreCalle."', nro_casa ='".$numeroCasa."' WHERE id =".$id; 
        $final= $conexion->query($sqlQuery);	
        
        //CONSULTAMOS SI TODOS LOS DATOS FUERON GUARDADOS CORRECTAMENTE
    	$sqlDatosCompletos="SELECT estatus_placa, estatus_identificacion, estatus_rostro FROM accessbot_bandeja WHERE id =".$id;
    	$consultaDatosCompletos = $conexion->query($sqlDatosCompletos);
    
    	while($registroDatosCompletos=$consultaDatosCompletos->fetch_assoc())
    	{
    		$estatusPlaca= $registroDatosCompletos["estatus_placa"];
    		$estatusIdentificacion= $registroDatosCompletos["estatus_identificacion"];
    		$estatusRostro= $registroDatosCompletos["estatus_rostro"];
    		if ($estatusPlaca == "2" && $estatusIdentificacion == "2" && $estatusRostro == "2")
    		{
    		    $boolCompleto=true;
    		}
    	}
	    
	    if ($boolCompleto == true)
	    {
		    //$speech = "Perfecto ".$nombreSolicitante.", se dirige a ".$nombreCalle." ".$numeroCasa.", bienvenido!";
		    $speech = "Acceso correcto, bienvenido ".$nombreSolicitante;
	    }
	    else
	    {
	        if ($estatusPlaca == 1)
	        {
	            $speech = "Acceso denegado, no hemos podido detectar las placas de su carro.";
	        }
	        if ($estatusIdentificacion == 1)
	        {
	            $speech = "Acceso denegado, no hemos podido detectar su identificación.";
	        }
	        if ($estatusRostro == 1)
	        {
	            $speech = "Acceso denegado, no hemos podido detectar su rostro.";
	        }
	    }
	}
	else
	{
		$speech = "El domicilio que proporcionó es incorrecto, podría proporcionarlo de nuevo por favor?";
	}
	
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