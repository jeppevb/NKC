<?php
include_once 'dbcrudconfig.php';

function send_confirmation_mail($link_hash, $email_addr, $name) {
	$subject = 'Velkommen til NKC';
	$message = '
			<html>
			<head>
			<title>Indmeldelse i Nordjysk Kampsportscenter</title>
			<style type="text/css">
			p {
				font-family: helvetica, verdana, courier;
				color: #999999;
			}
			
			div {
				width: 45em;
			}
			
			</style>
			</head>
			<body>
				<div style="text-align: center;"><img src="http://www.nordjyskkampsport.dk/images/nkclogo.png" width="150px" /></div>
				<div>
					<p>Hej ' . $name . ',</p>
					<p>
						Du har meldt dig ind i Nordjysk Kampsportscenter gennem <a
							href="http://nordjyskkampsport.dk">vores hjemmeside</a>. Inden vi
						registrerer dig som medlem skal vi sikre os at du har opgivet en
						korrekt email adresse. Derfor skal du klike på linket herunder eller
						kopiere det over i din browser.
					</p>
					<a href="http://nordjyskkampsport.dk/godkend.php?krums=' . $link_hash . '">http://nordjyskkampsport.dk/godkend.php?krums='
						. $link_hash . '</a>
				</div>
			</body>
			</html>';

	
// To send HTML mail, the Content-type header must be set
$headers  = 'MIME-Version: 1.0' . PHP_EOL;
$headers .= 'Content-type: text/html; charset=UTF-8' . PHP_EOL;

// Additional headers
$headers .= 'To:' . $name .  '<' . $email_addr . '>' . PHP_EOL;
$headers .= 'From: Nordjysk Kampsportscenter <noreply@nordjyskkampsport.dk>' . PHP_EOL;
#$headers .= 'Cc: birthdayarchive@example.com' . PHP_EOL;
#$headers .= 'Bcc: birthdaycheck@example.com' . PHP_EOL;

	return mail($email_addr, $subject , $message, $headers, 'O DeliveryMode=b');
}
function save_and_request_confirmation($thePostArray){
	global $inscon;
	
	$thePostArray['MemberFirstname'] = htmlentities($thePostArray['MemberFirstname'],ENT_QUOTES, 'UTF-8');
	$thePostArray['MemberMiddlename'] = htmlentities($thePostArray['MemberMiddlename'],ENT_QUOTES, 'UTF-8');
	$thePostArray['MemberLastname'] = htmlentities($thePostArray['MemberLastname'],ENT_QUOTES, 'UTF-8');
	$thePostArray['MemberAdress'] = htmlentities($thePostArray['MemberAdress'],ENT_QUOTES, 'UTF-8');
	$thePostArray['MemberZip'] = htmlentities($thePostArray['MemberZip'],ENT_QUOTES, 'UTF-8');
	$thePostArray['MemberEmail'] = htmlentities($thePostArray['MemberEmail'],ENT_QUOTES, 'UTF-8');
	$thePostArray['MemberPhone'] = htmlentities($thePostArray['MemberPhone'],ENT_QUOTES, 'UTF-8');
	$thePostArray['MemberMobile'] = htmlentities($thePostArray['MemberMobile'],ENT_QUOTES, 'UTF-8');
	$thePostArray['MemberSex'] = htmlentities($thePostArray['MemberSex'],ENT_QUOTES, 'UTF-8');
	$thePostArray['MemberBirth'] = htmlentities($thePostArray['MemberBirth'],ENT_QUOTES, 'UTF-8');
	$thePostArray['MemberComment'] = htmlentities($thePostArray['MemberComment'],ENT_QUOTES, 'UTF-8');
	$thePostArray['MemberEmailNotice'] = htmlentities($thePostArray['MemberEmailNotice'],ENT_QUOTES, 'UTF-8');
	$thePostArray['MemberSMSNotice'] = htmlentities($thePostArray['MemberSMSNotice'],ENT_QUOTES, 'UTF-8');
	$thePostArray['ACCEPTURL'] = htmlentities($thePostArray['ACCEPTURL'],ENT_QUOTES, 'UTF-8');
	$thePostArray['DECLINEURL'] = htmlentities($thePostArray['DECLINEURL'],ENT_QUOTES, 'UTF-8');
	$thePostArray['FOADACC'] = htmlentities($thePostArray['FOADACC'],ENT_QUOTES, 'UTF-8');
	$thePostArray['FOADCOS'] = htmlentities($thePostArray['FOADCOS'],ENT_QUOTES, 'UTF-8');
	$thePostArray['FOADSEC'] = htmlentities($thePostArray['FOADSEC'],ENT_QUOTES, 'UTF-8');
	$thePostArray['FOADNOTSEC'] = htmlentities($thePostArray['FOADNOTSEC'],ENT_QUOTES, 'UTF-8');
	$thePostArray['FOADELM'] = htmlentities($thePostArray['FOADELM'],ENT_QUOTES, 'UTF-8');
	
	mysql_query('begin');
	mysql_query('INSERT INTO waiting_signups(firstname, middlename, lastname, address, zip, email, phone, mobile, sex, dob, comment, emailnotice, smsnotice, accepturl, declineurl, foadacc, foadcos, foadsec, foadnotsec, foadelm) values (\'' . $thePostArray['MemberFirstname'] . '\', \'' . $thePostArray['MemberMiddlename'] . '\', \'' . $thePostArray['MemberLastname'] . '\', \'' . $thePostArray['MemberAdress'] . '\', \'' . $thePostArray['MemberZip'] . '\', \'' . $thePostArray['MemberEmail'] . '\', \'' . $thePostArray['MemberPhone'] . '\', \'' . $thePostArray['MemberMobile'] . '\', \'' . $thePostArray['MemberSex'] . '\', \'' . $thePostArray['MemberBirth'] . '\', \'' . $thePostArray['MemberComment'] . '\', \'' . $thePostArray['MemberEmailNotice'] . '\', \'' . $thePostArray['MemberSMSNotice'] . '\', \'' . $thePostArray['ACCEPTURL'] . '\', \'' . $thePostArray['DECLINEURL'] . '\', \'' . $thePostArray['FOADACC'] . '\', \'' . $thePostArray['FOADCOS'] . '\', \'' . $thePostArray['FOADSEC'] . '\', \'' . $thePostArray['FOADNOTSEC'] . '\', \'' . $thePostArray['FOADELM'] . '\');', $inscon);
	$justinserted = mysql_insert_id($inscon);
	$myhash = hash('sha256', $thePostArray['MemberFirstname'] . $justinserted . $thePostArray['MemberEmail']); 
	mysql_query('UPDATE waiting_signups SET urlhash = \'' . $myhash . '\' where id = \'' . $justinserted . '\';', $inscon);
	
	if(mysql_error($inscon)){
		mysql_query('rollback');
		die('we had a terrible error: ' . mysql_error());
	} else {
		mysql_query('commit');
	}
	
	session_start();
	if (send_confirmation_mail($myhash, $thePostArray['MemberEmail'], $thePostArray['MemberFirstname'])){
		$_SESSION['notification'] = 'Tak for din indmeldelse. For at færdiggøre indmeldelsen skal du bekræfte din e-mail adresse ved at følge det link vi har sendt dig.';
	}
	else{
		$_SESSION['notification'] = 'Der skete en fejl da vi sendte din bekræftelse. Gennemse venligst de oplysninger du har givet os.';
	}
	session_write_close();
	header('location: notifikation.php');
}

function show_validate_js() {
echo '<script type="text/javascript">' . PHP_EOL;
echo '	function testme(){' . PHP_EOL;
echo '		emailfilter = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;' . PHP_EOL;
echo '		telefonfilter = /^([0-9])+$/;' . PHP_EOL;
echo '		navnefilter = /^([^0-9\+]){2,}$/;' . PHP_EOL;
echo '		adressefilter = /^.{5,}$/;' . PHP_EOL;
echo '		postnummerfilter = /^([0-9]){4}$/;' . PHP_EOL;
echo '		DOBfilter = /^([0-3])([0-9])\.([0-2])([0-9])\.([12])([90])([0-9]){2}$/;' . PHP_EOL;
echo '		if (!emailfilter.test(document.getElementsByName("MemberEmail")[0].value)){' . PHP_EOL;
echo '			alert("Indtast en gyldig emailaddresse");' . PHP_EOL;
echo '			return false;' . PHP_EOL;
echo '		}' . PHP_EOL;
echo '		if (document.getElementsByName("MemberPhone")[0].value != "" && !telefonfilter.test(document.getElementsByName("MemberPhone")[0].value)){' . PHP_EOL;
echo '			alert("Indtast et gyldigt telefonnummer");' . PHP_EOL;
echo '			return false;' . PHP_EOL;
echo '		}' . PHP_EOL;
echo '		if (document.getElementsByName("MemberMobile")[0].value != "" && !telefonfilter.test(document.getElementsByName("MemberMobile")[0].value)){' . PHP_EOL;
echo '			alert("Indtast et gyldigt mobilnummer");' . PHP_EOL;
echo '			return false;' . PHP_EOL;
echo '		}' . PHP_EOL;
echo '		if (document.getElementsByName("MemberMobile")[0].value == "" && document.getElementsByName("MemberPhone")[0].value == ""){' . PHP_EOL;
echo '			alert("Du skal opgive dit telefonnummer og/eller mobilnummer");' . PHP_EOL;
echo '			return false;' . PHP_EOL;
echo '		}' . PHP_EOL;
echo '		if (!navnefilter.test(document.getElementsByName("MemberFirstname")[0].value)){' . PHP_EOL;
echo '			alert("Du skal opgive dit fornavn");' . PHP_EOL;
echo '			return false;' . PHP_EOL;
echo '		}' . PHP_EOL;
echo '		if (!navnefilter.test(document.getElementsByName("MemberLastname")[0].value)){' . PHP_EOL;
echo '			alert("Du skal opgive dit efternavn");' . PHP_EOL;
echo '			return false;' . PHP_EOL;
echo '		}' . PHP_EOL;
echo '		if (!adressefilter.test(document.getElementsByName("MemberAdress")[0].value)){' . PHP_EOL;
echo '			alert("Du skal opgive hele din adresse");' . PHP_EOL;
echo '			return false;' . PHP_EOL;
echo '		}' . PHP_EOL;
echo '		if (!postnummerfilter.test(document.getElementsByName("MemberZip")[0].value)){' . PHP_EOL;
echo '			alert("Du skal opgive dit postnummer");' . PHP_EOL;
echo '			return false;' . PHP_EOL;
echo '		}' . PHP_EOL;
echo '		if(!(document.getElementById("MMA").checked || document.getElementById("MT").checked || document.getElementById("BJJ").checked || document.getElementById("CAP").checked || document.getElementById("AKD").checked || document.getElementById("JJ").checked)){' . PHP_EOL;
echo '			alert("Du skal vælge mindst et hold");' . PHP_EOL;
echo '			return false;' . PHP_EOL;
echo '		}' . PHP_EOL;
echo '		if(!DOBfilter.test(document.getElementsByName("MemberBirth")[0].value)){' . PHP_EOL;
echo '			alert("Du skal opgive din fødselsdato");' . PHP_EOL;
echo '			return false;' . PHP_EOL;
echo '		}' . PHP_EOL;
echo '		if(!document.getElementById("accept_bylaws").checked){' . PHP_EOL;
echo '			alert("Du skal acceptere NKCs vedtægter for at blive medlem");' . PHP_EOL;
echo '			return false;' . PHP_EOL;
echo '		} ' . PHP_EOL;
echo '		if (document.getElementById("MMA").checked){' . PHP_EOL;
echo '			document.getElementsByName("MemberComment")[0].value += "MMA ";' . PHP_EOL;
echo '		}' . PHP_EOL;
echo '		if (document.getElementById("BJJ").checked){' . PHP_EOL;
echo '			document.getElementsByName("MemberComment")[0].value += "BJJ ";' . PHP_EOL;
echo '		}' . PHP_EOL;
echo '		if (document.getElementById("MT").checked){' . PHP_EOL;
echo '			document.getElementsByName("MemberComment")[0].value += "MT ";' . PHP_EOL;
echo '		}' . PHP_EOL;
echo '		if (document.getElementById("CAP").checked){' . PHP_EOL;
echo '			document.getElementsByName("MemberComment")[0].value += "CAP ";' . PHP_EOL;
echo '		}' . PHP_EOL;
echo '		if (document.getElementById("AKD").checked){' . PHP_EOL;
echo '			document.getElementsByName("MemberComment")[0].value += "AKD ";' . PHP_EOL;
echo '		}' . PHP_EOL;
echo '		if (document.getElementById("JJ").checked){' . PHP_EOL;
echo '			document.getElementsByName("MemberComment")[0].value += "JJ ";' . PHP_EOL;
echo '		}' . PHP_EOL;
echo '		if (document.getElementById("BARN").checked){' . PHP_EOL;
echo '			document.getElementsByName("MemberComment")[0].value += "BARN ";' . PHP_EOL;
echo '		}' . PHP_EOL;
echo '		document.getElementsByName("MemberComment")[0].value += document.getElementById("betal").value;' . PHP_EOL;
echo '		document.getElementById("MMA").disabled = "disabled";' . PHP_EOL;
echo '		document.getElementById("BJJ").disabled = "disabled";' . PHP_EOL;
echo '		document.getElementById("MT").disabled = "disabled";' . PHP_EOL;
echo '		document.getElementById("CAP").disabled = "disabled";' . PHP_EOL;
echo '		document.getElementById("AKD").disabled = "disabled";' . PHP_EOL;
echo '		document.getElementById("JJ").disabled = "disabled";' . PHP_EOL;
echo '		document.getElementById("BARN").disabled = "disabled";' . PHP_EOL;
echo '		document.getElementById("betal").disabled = "disabled";' . PHP_EOL;
echo '		return true;' . PHP_EOL;
echo '	}' . PHP_EOL;
echo '</script>' . PHP_EOL;
} 
?>
