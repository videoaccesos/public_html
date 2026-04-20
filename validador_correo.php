<!doctype html>
<html lang="en">

<head>
	<link href="http://fonts.googleapis.com/css?family=Terminal+Dosis" rel="stylesheet" type="text/css" />
	<style>
		body {background: #F4F4F4;color: #000000;font-family: verdana,Arial,Helvetica,sans-serif;font-size: 11px;margin: 0 auto;padding: 20px}
		div {padding: 10px;margin: 10px;background: #f2f1f0;border: 1px solid #ddd}
		label { display: inline-block; margin-bottom:5px;width: 100px}
		input {border: 1px solid #343434;padding:2px;font-size: 10px}
	</style>
	
</head>

<body>



<?php
$host = "localhost";
  $user = "wwwvideo_root";
  $pass = "V1de0@cces0s";
  $databaseName = "wwwvideo_video_accesos";

  $con = mysql_connect($host,$user,$pass);
  $dbs = mysql_select_db($databaseName, $con);

$result1 = mysql_query("SELECT * FROM residencias_residentes where email <> '' and fecha_modificacion > '2019-01-01 01:01:01' ");

/*while($registro= mysql_fetch_array($result1)){
$email= $registro['email'];
    $key = "rMU391yY2vOggme63xdhq";
    $url = "https://apps.emaillistverify.com/api/verifyEmail?secret=".$key."&email=".$email;
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true );
    $response = curl_exec($ch);

if ($response=='ok')
{
echo $email.' Validado <br>';
}
else
{
echo $email.' Eliminado <br>';
$sql4 = "UPDATE residencias_residentes SET email='' where email= '$email'";
						$result4 = mysql_query($sql4);
}

}*/
while($registro= mysql_fetch_array($result1)){
  // URL which should be requested
  $url = 'http://api.emailverifyapi.com/api/a/v1';
  $apikey = 'sReWua8qVzhwo294kEvrFUCQKNGJMnTp'; // API Key
  $email = $registro['email']; // Email to test
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
    $status = $result[11];
    
    if ($status=='O')
    {
    echo $email.' Validado <br>';
    }
    else
    {
    echo $email.' Eliminado <br>';
    $sql4 = "UPDATE residencias_residentes SET email='' where email= '$email'";
    						$result4 = mysql_query($sql4);
    }
  }
}
?>


<!--<div>
	
	<form id="myForm" method="post" class="searchform" action="">
		<input type="submit" name="submitEmail" value="Verify"><br/>
	</form>
	
</div>-->

</body>
</html>