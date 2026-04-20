<?php
$url = 'http://api.emailverifyapi.com/api/a/v1';
  $apikey = 'sReWua8qVzhwo294kEvrFUCQKNGJMnTp'; // API Key
  $email = $_POST['txtEmail_Residentes']; // Email to test
  // jSON String for request
  $url .= "?email=$email&key=$apikey";
  // Initializing curl
  $ch = curl_init( $url );
  if($ch == false) {
    die ("Curl failed!");
  } else {
    // Configuring curl options
    $options = array(
      CURLOPT_RETURNTRANSFER => true,
      CURLOPT_HTTPHEADER => array('Content-type: application/json')
    );
    // Setting curl options
    curl_setopt_array( $ch, $options );
    // Getting results
    $result = curl_exec($ch); // Getting jSON result string
    // display JSON data
    $status1 = $result[11];
    
    if ($status1=='O')
    {
    $status= "CORRECTO";
    }
    else
    {
    $status= "INCORRECTO";
    }
    $texto = "El email: ".$email." es ".$status;
    if ($status1=="O")
    {
    echo "<html><body><center><div><h2 style='color:#01DF01;'>$texto</h2></div></center></body></html>";
    }
    else
    {
    echo "<html><body><center><div><h2 style='color:red;'>$texto</h2></div></center></body></html>";
    }
  }
    //curl_close($ch);

?>