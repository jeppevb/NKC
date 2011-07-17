<?php include_once 'includes/header.php';?>
<?php include_once 'includes/ads.php';?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-type" content="text/html; charset=utf-8" />
<link href="stylesheets/stylesheet.css" media="screen" rel="stylesheet"
	type="text/css" />
<link rel="icon" type="image/icon" href="favicon.ico" />
<?php ads_js_include(); ?>
<?php analytics_js(); ?>
<title>Nordjysk Kampsportscenter - Hvad sker der i klubben?</title>
<meta http-equiv="description"
	content="Her findes oversigten over vores planer i Nordjysk Kampsportscenter" />
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
			<h1>Kontaktinformation</h1>
			<p>Adresse: Østre fælledvej 15, 9400 Nørresundby</p>
			<ul>
				<li>bestyrelse@nordjyskkampsport.dk</li>
				<li>formand@nordjyskkampsport.dk - 20774166</li>
				<li>kasserer@nordjyskkampsport.dk</li>
				<li>info@nordjyskkampsport.dk</li>
			</ul>
			<p>Vi har også grupper på facebook:</p>
			<ul>
				<li><a href="http://www.facebook.com/group.php?gid=124352814837">Nordjysk
						Kampsportscenter</a></li>
				<li><a href="http://www.facebook.com/group.php?gid=7484287620">X-Gym
						MMA</a></li>
				<li><a href="http://www.facebook.com/group.php?gid=62488053256">X-Gym
						Muay Thai</a></li>
				<li><a href="http://www.facebook.com/group.php?gid=144373765599843">X-Gym
						MMA Junior</a></li>
			</ul>
		</div>
	</div>
	<div id="footer" class="thestyle"></div>
</body>
</html>
