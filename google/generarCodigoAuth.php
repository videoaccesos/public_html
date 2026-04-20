<?php
require_once '../google/googleLib/GoogleAuthenticator.php';
$gauth = new GoogleAuthenticator();
$secret_key = $gauth->createSecret();

if($secret_key != ""){
	echo $secret_key;
}
else{
	echo "No se pudo generar el c¨®digo de autenticaci¨®n.";
}

?>