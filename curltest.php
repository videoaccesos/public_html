<?php
// reinitialize curl resource
$ch = curl_init();// set url
curl_setopt($ch, CURLOPT_URL, "http://www.avrisoft.com");
//return the as a string
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

//echo output string;
$output = curl_exec($ch);

echo "imprimimos la salida del archivo";
echo $output;

        // close curl resource to free up system resources
curl_close($ch);
?>