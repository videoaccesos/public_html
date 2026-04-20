<?php

require_once "lib/nusoap.php";

// La funcion que se va a exportar
function saludo($nombre)
{
    return "Hola ".$nombre;
}

function guardarAcceso($idAcceso,$numTarjeta,$numAccesos,$fechaAutorizacion)
{
    return "ID de acceso: ".$idAcceso.", Número de tarjeta: ".$numTarjeta.", Número de Accesos: ".$numAccesos.", Fecha Acceso: ".$fechaAutorizacion;
}

// Se crea el objeto para el webservice
$servicio = new soap_server();

// Se inicializa el webservice
$servicio->configureWSDL("webserv", "urn:webserv");
// Se registra la funcion que se va a exportar, con el tipo de datos deentrada y el tipo de dato de salida

$servicio->register("saludo",array("nombre" =>
"xsd:string"),array("return" => "xsd:string"));

//SERVICIO PARA GUARDAR ACCESO
$servicio->register("guardarAcceso",array("idAcceso","numTarjeta","numAccesos","fechaActual" =>
"xsd:string"),array("return" => "xsd:string"));

// Como el servicio es proveedo por un servidor WEB la informacion del webservice sera recibida en METHOD POST
$servicio->service($HTTP_RAW_POST_DATA);

?>