<?php
session_start();

if(empty($_POST["tarjeta"]))
{
	exit("Falta el numero de tarjeta"); #Terminar el script definitivamente
}
else
{
  $tarjeta = $_POST["tarjeta"];
}

if(empty($_POST["telefono"]))
{
  exit("Falta el numero de telefono"); #Terminar el script definitivamente
}
else
{
  $telefono = "+52".$_POST["telefono"];
}

if(empty($_POST["moroso"]))
{
  exit("Falta seleccionar si el usuario es moroso o no"); #Terminar el script definitivamente
}
else
{
  $moroso = $_POST["moroso"];
}
/*
if(empty($_POST["premium"]))
{
  exit("Falta seleccionar si el usuario es premium o no"); #Terminar el script definitivamente
}
else
{
  $premium = $_POST["premium"];
}
*/
//$data =["tarjeta"=>$tarjeta,"moroso"=>$moroso];


$url1 = "https://firestore.googleapis.com/v1/projects/video-accesos/databases/(default)/documents/tarjetas/".$tarjeta."/";
//$url2 = "https://firestore.googleapis.com/v1/projects/video-accesos/databases/(default)/documents/users/%2B52".$telefono."/";


//****************************************************************************************************** */

$curl1 = curl_init();
//$curl2 = curl_init();

curl_setopt_array($curl1, array(
  CURLOPT_URL => $url1,
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => "",
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => "PATCH",
  CURLOPT_POSTFIELDS =>"{\r\n  \"name\": \"projects/video-accesos/databases/(default)/documents/tarjetas/$tarjeta\",\r\n  \"fields\": {\r\n    \"tarjeta\": {\r\n      \"stringValue\": \"$tarjeta\"\r\n    },\r\n    \"moroso\": {\r\n      \"booleanValue\": \"$moroso\"\r\n    },\r\n    \"celular\": {\r\n      \"stringValue\": \"$telefono\"\r\n    }\r\n }\r\n}",
  CURLOPT_HTTPHEADER => array(
    "Content-Type: application/json"
  ),
));
/*
curl_setopt_array($curl2, array(
  CURLOPT_URL => $url2,
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => "",
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => "PATCH",
  CURLOPT_POSTFIELDS =>"{\r\n  \"name\": \"projects/video-accesos/databases/(default)/documents/users/%2B52$telefono\",\r\n  \"fields\": {\r\n    \"celular\": {\r\n      \"stringValue\": \"+52$telefono\"\r\n    },\r\n    \"tarjeta\": {\r\n      \"stringValue\": \"$tarjeta\"\r\n    },\r\n    \"premium\": {\r\n      \"booleanValue\": \"$premium\"\r\n    }\r\n  }\r\n}",
  CURLOPT_HTTPHEADER => array(
    "Content-Type: application/json"
  ),
));

$mh = curl_multi_init();

curl_multi_add_handle($mh, $curl1);
curl_multi_add_handle($mh, $curl2);

$active=null;


// Ejecuta los recursos
do {
    $mrc = curl_multi_exec($mh, $active);
} while ($mrc == CURLM_CALL_MULTI_PERFORM);

while ($active && $mrc == CURLM_OK) {
    if (curl_multi_select($mh) != -1) {
        do {
            $mrc = curl_multi_exec($mh, $active);
        } while ($mrc == CURLM_CALL_MULTI_PERFORM);
    }
}*/


// Cierra los recursos
/*
if(curl_multi_errno($mh))
{
  $_SESSION['status']= "Ha ocurrido un error!!"; 
}
else
{
  $_SESSION['status'] = "Usuario ".$telefono.", con tarjeta ".$tarjeta." fue registrada exitosamente";
}
*/

curl_exec($curl1);
curl_close($curl1);

$_SESSION['status'] = "Tarjeta ".$tarjeta." con celular: ".$telefono." fue registrada exitosamente";

/*curl_multi_remove_handle($mh, $curl1);
curl_multi_remove_handle($mh, $curl2);
curl_multi_close($mh);*/
header("Location: subirtarjetas.php");


/*
$response = curl_exec($curl);
//echo $response;
if (curl_errno($curl))
{
  $_SESSION['status']="Ha ocurrido un error!!";
  header("Location: subirtarjetas.php");
  curl_close($curl);
}
else
{
  $_SESSION['status']="La tarjeta ".$tarjeta.", fue registrada exitosamente";
  header("Location: subirtarjetas.php");
  curl_close($curl);
}*/

?>