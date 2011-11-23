<?php
include_once 'includes/dbqueryconfig.php';
session_start();
$login = mysql_real_escape_string($_POST['login']);
$password = hash('sha256', $_POST['password']);

$qry='SELECT id FROM admins WHERE upper(login)=\'' . strtoupper($login) . '\' AND password=\'' . $password . '\'';
$result=mysql_query($qry, $qcon);

if(mysql_num_rows($result) == 1) {
	//Login Successful
	//Regenerate session ID to prevent session fixation attacks
	session_regenerate_id();
	$admin=mysql_fetch_assoc($result);
	$_SESSION['SESS_ADMIN_ID']=$admin['id'];

	session_write_close();
	if ($_POST['target'] != '')
		header('location: ' . $_POST['target']);
	else 
		header('location: /admin.php');
	exit();
}else{
	$_SESSION['ERRMSG_ARR'] = 'login fejlede';
	unset($_SESSION['SESS_ADMIN_ID']);
	session_write_close();
	header('location: /login');
	exit();
}
?>