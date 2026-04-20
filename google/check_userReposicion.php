<?php
include("../google/connection.php");

require_once '../google/googleLib/GoogleAuthenticator.php';
$gauth = new GoogleAuthenticator();
$secret_key = $gauth->createSecret();

$process_name = $_POST['process_name'];

if($process_name == "verify_code"){
	$scan_code = $_POST['scan_code'];
	
	$empleadoPermisoID1 = 98;
	$empleadoPermisoID2 = 179;
	$empleadoPermisoID3 = 260;
	
	$user_result1 = mysql_query("select * from empleados where empleado_id='$empleadoPermisoID1'") or die(mysql_error());
	$user_row1 = mysql_fetch_array($user_result1);
	$secret_key1	= $user_row1['google_auth_code'];
	
	$user_result2 = mysql_query("select * from empleados where empleado_id='$empleadoPermisoID2'") or die(mysql_error());
	$user_row2 = mysql_fetch_array($user_result2);
	$secret_key2 = $user_row2['google_auth_code'];
	
	$user_result3 = mysql_query("select * from empleados where empleado_id='$empleadoPermisoID3'") or die(mysql_error());
	$user_row3 = mysql_fetch_array($user_result3);
	$secret_key3	= $user_row3['google_auth_code'];
	
	$checkResult1 = $gauth->verifyCode($secret_key1, $scan_code, 2);    // 2 = 2*30sec clock tolerance
	$checkResult2 = $gauth->verifyCode($secret_key2, $scan_code, 2);    // 2 = 2*30sec clock tolerance
	$checkResult3 = $gauth->verifyCode($secret_key3, $scan_code, 2);    // 2 = 2*30sec clock tolerance

	if ($checkResult1 || $checkResult2 || $checkResult3){
		$_SESSION['googleVerifyCode'] = $scan_code;
		echo "done";
	} 
	else{
		echo 'Note : Code not matched.'.$secret_key3." result:".$checkResult;
	}
}
?>