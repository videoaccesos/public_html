<?php
$url = 'https://api-ssl.bitly.com/v3/shorten?longUrl=https://videoaccesos.net/&access_token=ca4d8aa93120f420181bfdba886f19b1ca216955';
$ch = curl_init($url);
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET"); 
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

$arr_result = curl_exec($ch);

$arr_response = json_decode($arr_result);

echo $arr_response->data->url;
?>