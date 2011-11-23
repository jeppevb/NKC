<?php

include_once 'includes/dbcrudconfig.php';
if (isset($_GET['krums'])) {

	$hash = mysql_real_escape_string($_GET['krums']);
	$query_result = mysql_query('select * from waiting_signups where urlhash = \'' . $hash . '\'', $inscon);
	$result;
	if (!($result = mysql_fetch_array($query_result))) {
		session_start();
		$_SESSION['notification'] = 'Din e-mail er allerede bekræftet eller også er linket ikke blevet kopieret ind i browseren ordentligt.';
		session_write_close();
		header('location: /notifikation');
		exit();
	}

	$post_string = 'MemberFirstname=' . urlencode($result['firstname']) . '&MemberMiddleName=' . urlencode($result['middlename']) . '&MemberLastname=' . urlencode($result['lastname']) .
	'&MemberAdress=' . urlencode($result['address']) . '&MemberZip=' . urlencode($result['zip']) . '&MemberEmail=' . urlencode($result['email']) . '&MemberPhone=' . urlencode($result['phone']) .
	'&MemberMobile=' . urlencode($result['mobile']) . '&MemberBirth=' . urlencode($result['dob']) . '&MemberSex=' . urlencode($result['sex']) . '&MemberComment=' . urlencode($result['comment']) . '&MemberEmailNotice=' . urlencode($result['emailnotice']) .
	'&MemberSMSNotice=' . urlencode($result['smsnotice']) . '&ACCEPTURL=' . urlencode($result['accepturl']) . '&DECLINEURL=' . urlencode($result['declineurl']) . '&FOADACC=' . urlencode($result['foadacc']) .
	'&FOADCOS=' . urlencode($result['foadcos']) . '&FOADSEC=' . urlencode($result['foadsec']) . '&FOADNOTSEC=' . urlencode($result['foadnotsec']) . '&FOADELM=' . urlencode($result['foadelm']); 

	//we are going to need the length of the data string
	$data_length = strlen($post_string);

	//let's open the connection
	$connection = fsockopen('ssl://foreningsadministrator.dk', 443);

	//sending the data
	fputs($connection, "POST  /tilmeld.php  HTTP/1.1\r\n");
	fputs($connection, "Host:  portal.foreningsadministrator.dk \r\n");
	fputs($connection,
	    "Content-Type: application/x-www-form-urlencoded\r\n");
	fputs($connection, "Content-Length: $data_length\r\n");
	fputs($connection, "Connection: close\r\n\r\n");
	fputs($connection, $post_string);

	//closing the connection
	fclose($connection);

	mysql_query('DELETE from waiting_signups where urlhash = \'' . $hash . '\'', $inscon);
	session_start();
	$_SESSION['notification'] = 'Din e-mail nu bekræftet. Velkommen i klubben';
	session_write_close();
	header('location: /notifikation');
}else{
	header('location: /');
}
?>