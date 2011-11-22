<?php include_once 'includes/header.php';?>
<?php include_once 'includes/ads.php';?>
<?php include_once 'includes/refhelper.php';?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-type" content="text/html; charset=utf-8" />
<link href="/stylesheets/stylesheet.css" media="screen" rel="stylesheet"
	type="text/css" />
<link rel="icon" type="image/icon" href="/favicon.ico" />
<?php ads_js_include(); ?>
<?php analytics_js(); ?>
<title>Samling af referater fra møder i Nordjysk Kampsportscenter</title>
<meta http-equiv="description"
	content="Her finder man referaterne fra vores møder Nordjysk Kampsportscenter." />
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
			<h1>Referater</h1>
			<p>Her er en liste af referater sorteret efter dato med de nyeste
				øverst:</p>
			<ul>
			<?php 
				printRefs();
			?>
			</ul>
		</div>
	</div>
	<div id="footer" class="thestyle"></div>
</body>
</html>
