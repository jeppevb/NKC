<?php
	$inscon = mysql_connect("localhost:3306","crud_uname","password");

	if (!$inscon){
		die('Could not connect: ' . mysql_error());
	}
	mysql_select_db("nkc", $inscon);
	mysql_set_charset('utf8',$inscon);	
?>