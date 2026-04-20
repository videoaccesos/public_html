<?php

require 'vendor/autoload.php';
use Google\Cloud\Vision\VisionClient;

$img=$_POST['img'];

$vision = new VisionClient(['keyFile' => json_decode(file_get_contents("apiVision.json"), true)]);

$foto = fopen($img, 'r');

$image = $vision->image($foto,['TEXT_DETECTION']);

$result = $vision->annotate($image);
$jsonTexto =$result->text()[0]->description();

var_dump($jsonTexto);

?>