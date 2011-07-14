<?php
include_once 'includes/dbqueryconfig.php';
session_start();
$login = htmlentities($_POST['login']);
$password = md5($_POST['password']);

$qry='SELECT id FROM admins WHERE login=\'' . $login . '\' AND password=\'' . $password . '\'';
$result=mysql_query($qry, $qcon);

if(mysql_num_rows($result) == 1) {
	//Login Successful
	//Regenerate session ID to prevent session fixation attacks
	session_regenerate_id();
	$admin=mysql_fetch_assoc($result);
	$_SESSION['SESS_ADMIN_ID']=$admin['id'];

	//Write session to disk
	session_write_close();
	header('location: opret_nyheder.php');
	exit();
}else{
	$_SESSION['ERRMSG_ARR'] = 'login fejlede';
	unset($_SESSION['SESS_ADMIN_ID']);
	session_write_close();
	header('location: login.php');
	exit();
}
?>