<?php 
	$qcon = mysql_connect("localhost:3306","query_uname","password");
	if (!$qcon){
		die('Could not connect: ' . mysql_error());
	}
	mysql_select_db("nkc", $qcon);
	mysql_set_charset('utf8',$qcon);
?>	