<?php
$params = array(
    'to'            => '+526674136892',         //destination number  
    'from'          => 'Test',                //sender name has to be active  
    'message'       => 'Qué onda soy Miguel calando el código de verificación',    //message content
    'format'        => 'json',           
);
function smsSend($params, $token, $backup = false)
{

    static $content;

    if ($backup == true) {
        $url = 'https://api2.smsapi.com/sms.do';
    } else {
        $url = 'https://api.smsapi.com/sms.do';
    }

    $c = curl_init();
    curl_setopt($c, CURLOPT_URL, $url);
    curl_setopt($c, CURLOPT_POST, true);
    curl_setopt($c, CURLOPT_POSTFIELDS, $params);
    curl_setopt($c, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($c, CURLOPT_HTTPHEADER, array(
        "Authorization: Bearer $token"
    ));

    $content = curl_exec($c);
    $http_status = curl_getinfo($c, CURLINFO_HTTP_CODE);

    if ($http_status != 200 && $backup == false) {
        $backup = true;
        smsSend($params, $token, $backup);
    }

    curl_close($c);
    return $content;
}

$token = "cttqcWZmda9RSie8ChJ3tbdt1MpJ2P8FE2q814aI"; //https://ssl.smsapi.com/webapp#/oauth/manage

echo smsSend($params, $token);
?>