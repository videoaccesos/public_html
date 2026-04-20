<?php 	

$localhost = "localhost:3306";
$username = "wwwvideo_mzamora";
$password = "Ab97099541.";
$dbname = "wwwvideo_solicitudes";

// db connection
$connect = new mysqli($localhost, $username, $password, $dbname);
// check connection
if($connect->connect_error) {
  die("Connection Failed : " . $connect->connect_error);
} else {
  // echo "Successfully connected";
}

?>