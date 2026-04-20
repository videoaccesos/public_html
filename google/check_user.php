<?php
include("../google/connection.php");

#require_once '../google/googleLib/GoogleAuthenticator.php';
require_once(__DIR__ . '/googleLib/GoogleAuthenticator.php');

$gauth = new GoogleAuthenticator();
$secret_key = $gauth->createSecret();

$process_name = $_POST['process_name'];



if($process_name == "user_registor"){
	$reg_name		= $_POST['reg_name'];
	$reg_email		= $_POST['reg_email'];
	$reg_password	= md5($_POST['reg_password']);
    
	$chk_user = mysql_query("select * from tbl_users where email='$reg_email'") or die(mysql_error());
	if(mysql_num_rows($chk_user) == 0){
    	$query = "insert into tbl_users(profile_name, email, password, google_auth_code) values('$reg_name', '$reg_email', '$reg_password', '$secret_key' )";
		$result = mysql_query($query) or die(mysql_error());
		$_SESSION['user_id'] = mysql_insert_id();
		echo "done";
    }
    else{
		echo "This Email already exits in system.";
    }
}

if($process_name == "user_login"){
	$login_email		= $_POST['login_email'];
	$login_password		= md5($_POST['login_password']);
    
	$user_result = mysql_query("select * from tbl_users where email='$login_email' and password='$login_password'") or die(mysql_error());
	if(mysql_num_rows($user_result) == 1){
    	$user_row = mysql_fetch_array($user_result);
		$_SESSION['user_id'] = $user_row['user_id'];
		echo "done";
    }
    else{
		echo "Check your user login details.";
    }
}

if($process_name == "verify_code"){
	$scan_code = $_POST['scan_code'];
	$user_id = $_POST['user_id'];
	
	$userPrincipal = mysql_query("select * from empleados where empleado_id='$user_id'") or die(mysql_error());
	$userPrincipalRow = mysql_fetch_array($userPrincipal);
	$empleadoPermisoID1 = $userPrincipalRow['permiso_administrador'];
	$empleadoPermisoID2 = $userPrincipalRow['permiso_encargado_administracion'];
	$empleadoPermisoID3 = $userPrincipalRow['permiso_supervisor'];
	
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
