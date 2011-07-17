<?php include_once 'includes/header.php';?>
<?php include_once 'includes/ads.php';?>
<?php include_once 'includes/signuphelper.php'; ?>

<?php 
if (isset($_POST['MemberFirstname']) && isset($_POST['MemberLastname']) && isset($_POST['MemberAdress']) && isset($_POST['MemberZip']) && isset($_POST['MemberEmail']) && (isset($_POST['MemberPhone']) || isset($_POST['MemberMobile'])) && isset($_POST['MemberComment'])){
	
	save_and_request_confirmation($_POST);
}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-type" content="text/html; charset=utf-8" />
<link href="stylesheets/stylesheet.css" media="screen" rel="stylesheet"	type="text/css" />
<link rel="icon" type="image/icon"  href="favicon.ico" />

<?php show_validate_js(); ?>

<?php ads_js_include(); ?>

<?php analytics_js(); ?>

<title>Indmeldelse i Nordjysk Kampsportscenter</title>
<meta http-equiv="description"
	content="" />
</head>
<body onload="setAd();">
	<div class="thestyle" id="top">
	<?php show_topbanner(); ?>
	</div>
	<div id="menu" class="thestyle">
		<!-- Her begynder menuen  -->
	<?php show_menu(); ?>
		<!-- Her ender menuen  -->
	</div>
	<div class="thestyle" id="whitebox">
		<div id="content">
			<h1>Indmeldelsesformular</h1>
			<p>Jeg ønsker medlemskab af Nordjysk Kampsportscenter. Jeg har læst klubbens vedtægter og ordensregler, og forpligter mig til at overholde disse. Jeg er indforstået med, at træning er under eget ansvar, og derfor kan jeg ikke gøre krav overfor klubben eller trænerne, ved eventuelle skader opstået under træningen.
			</p>
			<p>Ved udmeldelse skal der rettes skriftlig henvendelse til klubbens kasserer, enten via mail til kasserer@nordjyskkampsport.dk eller ved at lægge skrivelsen i bestyrelsesskabet i klublokalet. Vær opmærksom på, at vi af og til bruger både fotografering og videooptagelser for at promovere og dokumentere klubben. Hvis du foretrækker ikke at blive fotograferet og filmet, er det vigtigt, du meddeler din instruktør om dette. Vær også opmærksom på at du skal betale kontingentet via PBS. Spørg din instruktør eller kassereren hvis du er i tvivl om hvordan.</p>
			<p>Deltager du på børnehold skal vi have underskrift fra dine forældre/værge. Der er <a href="indmeldelse.pdf">indmeldelsesblanketter</a> i klubben men du kan også hente en <a href="indmeldelse.pdf">her</a> og printe den ud.</p>
			<hr/>
			<p>Jeg accepterer NKCs <a href="NKCStatutes.pdf">vedtægter</a> og forstår at de beskriver de regler og rettigheder der gælder mig som medlem af klubben. <input type="checkbox" id="accept_bylaws" /></p>
			
			<!-- <FORM ACTION="https://portal.foreningsadministrator.dk/tilmeld.php" method="POST" autocomplete="OFF" id="FOADMEMBERSIGNUPFORM" onsubmit="return validateMe()">  -->
			<form action="indmeldelse.php" method="post" id="FOADMEMBERSIGNUPFORM" onsubmit="return testme()">
			<p>
			Fornavn <input type="text" size="25" maxlength="100" name="MemberFirstname" value=""/><br/>
			Mellemnavn <input type="text" size="25" maxlength="100" name="MemberMiddlename" value=""/><br/>
			Efternavn <input type="text" size="25" maxlength="100" name="MemberLastname" value=""/><br/>
			Adresse <input type="text" size="25" maxlength="100" name="MemberAdress" value=""/><br/>
			Post nr. <input type="text" size="4" maxlength="4" name="MemberZip" value=""/><br/>
			E-mail <input type="text" size="25" maxlength="100" name="MemberEmail" value=""/><br/>
			Telefon <input type="text" size="8" maxlength=8 name="MemberPhone" value="" /><br/>
			Mobil <input type="text" size="8" maxlength="8" name="MemberMobile" value="" /><br/>
			Fødselsdag <input type="text" size="10" maxlength="10" name="MemberBirth" value="" /> (dd.mm.åååå)<br />
			Køn <select name="MemberSex"><option value="1">Mand</option><option value="2">Kvinde</option></select>
			<input type="hidden" name="MemberComment" value="" /><br />
			Deltager på børnehold <input type="checkbox" id="BARN" /><br/>
			Deltager på MMA <input type="checkbox" id="MMA" /><br/>
			Deltager på BJJ <input type="checkbox" id="BJJ" /><br/>
			Deltager på Muay Thai <input type="checkbox" id="MT" /><br/>
			Deltager på Capoeira <input type="checkbox" id="CAP" /><br/>
			Deltager på Jiu Jitsu <input type="checkbox" id="JJ" /><br/>
			Deltager på Aikido <input type="checkbox" id="AKD" /><br/>
			Betaling<br />
			Halvårligt forudbetalt (175kr/mnd)<input type="radio" value="HALVAARLIGT" id="betal" name="betal" checked="checked" /><br />
			Månedligt forudbetalt (200kr/mnd)<input type="radio" value="MAANEDLIGT" id="betal" name="betal" /><br />
			<input type="submit" value="Tilmeld" />
			<input type="hidden" name="MemberEmailNotice" value="0" />
			<input type="hidden" name="MemberSMSNotice" value="1" />
			<input type="hidden" name="ACCEPTURL" value="http://www.nordjyskkampsport.dk/acceptform.html" />
			<input type="hidden" name="DECLINEURL" value="http://www.nordjyskkampsport.dk/afvistform.html" />
			<input type="hidden" name="FOADACC" value="40" />
			<input type="hidden" name="FOADCOS" value="52" />
			<input type="hidden" name="FOADSEC" value="8931e79a97958c3452461ec9cf4192b2" />
			<input type="hidden" name="FOADNOTSEC" value="04045ytjhkghfdg324ddc521:1:1:1:0:1:1:1:1:1:1:1:1:1:0:0:0:0:0:0:0:0:0:0:0:0:0:0:0:0:0:0:0:0:0:0:0:0:0:0:0:0:0:0:0:0:0:0:0:0:" />
			<input type="hidden" name="FOADELM" value="1:1:1:1:0:1:1:1:1:1:1:1:1:1:0:0:0:0:0:0:0:0:0:0:0:0:0:0:0:0:0:0:0:0:0:0:0:0:0:0:0:0:0:0:0:0:0:0:0:0:" />
			</p>
			</form>
			
		</div>
	</div>
	<div id="footer" class="thestyle"></div>
</body>
</html>
