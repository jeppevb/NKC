<?php
	//Start session
	session_start();
	
	if(!isset($_SESSION['SESS_ADMIN_ID']) || trim($_SESSION['SESS_ADMIN_ID']) == '') {
		$_SESSION['target'] = $_SERVER["REQUEST_URI"];
		header('location: /login');
		exit();
	}
?>