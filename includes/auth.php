<?php

	include_once 'dbqueryconfig.php';
	//Start session
	session_start();
	
	function logout(){
		unset($_SESSION['SESS_ADMIN_ID']);
		$_SESSION['target'] = $_SERVER["REQUEST_URI"];
		header('location: /login');
		exit();
	}
	
	if(!isset($_SESSION['SESS_ADMIN_ID']) || !preg_match("/^[0-9]+$/", $_SESSION['SESS_ADMIN_ID'])) {
		logout();
	}else{
		$qry='SELECT \'x\' FROM admins WHERE id=\'' . $_SESSION['SESS_ADMIN_ID'] . '\'';
		$result=mysql_query($qry, $qcon);
		if(mysql_num_rows($result) != 1){
			logout();
		}
	}
	
?>