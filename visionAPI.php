<?php

require 'vendor/autoload.php';
use Google\Cloud\Vision\VisionClient;

$img="identificaciones/IFE.jpg";

$vision = new VisionClient(['keyFile' => json_decode(file_get_contents("apiVision.json"), true)]);

$foto = fopen($img, 'r');

$image = $vision->image($foto,['TEXT_DETECTION']);

$result = $vision->annotate($image);
$jsonTexto =$result->text()[0]->description();

//var_dump($jsonTexto);

if (stristr($jsonTexto, 'FEDERAL ELECTORAL') != "")
{
    $nombre = stristr($jsonTexto, 'NOMBRE');
    echo "Este es el nombre: ". stristr($nombre, 'DOMICILIO', TRUE);
    
    $domicilio = stristr($jsonTexto, 'DOMICILIO');
    echo "Este es el domicilio: ". stristr($domicilio, 'FOLIO', TRUE);
    
    $claveElector = stristr($jsonTexto, 'CLAVE DE ELECTOR');
    echo "Esta es la clave de elector: ". stristr($claveElector, 'CURP', TRUE);
    
    $curp = stristr($jsonTexto, 'CURP');
    echo "Esta es la curp: ". stristr($curp, 'ESTADO', TRUE);
    echo "ES UNA IFE";
}

if (stristr($jsonTexto, 'NACIONAL ELECTORAL') != "")
{
    $nombre = stristr($jsonTexto, 'NOMBRE');
    echo "Este es el nombre: ". stristr($nombre, 'DOMICILIO', TRUE);
    
    $domicilio = stristr($jsonTexto, 'DOMICILIO');
    echo "Este es el domicilio: ". stristr($domicilio, 'SEXO', TRUE);
    
    $claveElector = stristr($jsonTexto, 'CLAVE DE ELECTOR');
    echo "Esta es la clave de elector: ". stristr($claveElector, 'RP', TRUE);
    
    $fechaNacimiento = stristr($jsonTexto, 'NACIMIENTO');
    echo "Esta es la fecha de nacimiento: ". stristr($fechaNacimiento, 'NOMBRE', TRUE);
    
    echo "ES UNA INE";
}

if (stristr($jsonTexto, 'LICENCIA') != "")
{
    echo "ES UNA LICENCIA\n";
}

?>