<?php include_once 'includes/header.php';?>
<?php include_once 'includes/ads.php';?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-type" content="text/html; charset=utf-8" />
<link href="/stylesheets/stylesheet.css" media="screen" rel="stylesheet"
	type="text/css" />
<link rel="icon" type="image/icon" href="/favicon.ico" />
<?php ads_js_include(); ?>
<?php analytics_js(); ?>
<title>Nordjysk Kampsportscenter - Hvad sker der i klubben?</title>
<meta http-equiv="description" content="Her findes oversigten over vores planer i Nordjysk Kampsportscenter" />
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
			<h1>Kalender</h1>
			<object data="http://www.google.com/calendar/embed?src=hk19bs6jh188rpphkc0gps9so8%40group.calendar.google.com&ctz=Europe/Copenhagen" style="border: 0; width:800px; height: 600px;"></object>
		</div>
	</div>
	<div id="footer" class="thestyle"></div>
</body>
</html>