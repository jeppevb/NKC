<?php include_once 'includes/header.php';?>
<?php include_once 'includes/ads.php';?>
<?php include_once 'includes/boardhelper.php'; ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-type" content="text/html; charset=utf-8" />
<link href="stylesheets/stylesheet.css" media="screen" rel="stylesheet"
	type="text/css" />
<link rel="icon" 
      type="image/icon" 
      href="favicon.ico" />
<?php ads_js_include(); ?>
<?php analytics_js(); ?>
<title>Bestyrelsen i Nordjysk Kampsportscenter</title>
<meta http-equiv="description"
	content="Bestyrelsen i Nordjysk Kampsportscenter tager sig af beslutninger i dagligdagen og udfører den mission som er givet fra generalforsamlingen" />
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
			<h1>Bestyrelsen</h1>
			<p>
				Den fornemste opgave bestyrelsen har er at drive klubben i henhold
				til klubbens vedtægter og den linie der lægges for året som
				godkendes på generalforsamlingen.
			</p>
			<p>
				I <b>2011</b> består <b>bestyrelsen</b> af følgende medlemmer:
			</p>
			<table>
				<?php 
					show_board();
				?>
			</table>
			<p>
				Man kan finde bestyrelsesmøderne og generalforsamlingens referater
				på <a href="referater.php">referatsiden</a>. Du kan altid kontakte
				bestyrelsen ved at sende en email til:<br /> <b>bestyrelse [schnâbel
					A] nordjyskkampsport [punktum] dk</b>
			</p>
		</div>
	</div>
	<div id="footer" class="thestyle"></div>
</body>
</html>
