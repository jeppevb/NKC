<?php include_once 'includes/header.php';?>
<?php include_once 'includes/ads.php';?>
<?php include_once 'includes/newshelper.php';?>
<?php include_once 'includes/dbqueryconfig.php';?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-type" content="text/html; charset=utf-8" />
<link href="/stylesheets/stylesheet.css" media="screen" rel="stylesheet"
	type="text/css" />
<link rel="alternate" type="application/atom+xml" title="Nordjysk Kampsportscenters Atom Feed" href="/feed" />
<link rel="icon" type="image/icon" href="/favicon.ico" />

<?php ads_js_include(); ?>
<?php analytics_js(); ?>
<title>Nyheder fra Nordjysk Kampsportscenter</title>
<meta http-equiv="description" content="Her finder man nyheder som vedrører Nordjysk Kampsportscenter." />
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
		<h1>Velkommen til Nordjysk Kampsportscenter</h1>
		<table>
		<tr><td style="width:20em; vertical-align: top;">
		<?php 
		$result = mysql_query('select galleries.foldername as foldername, images.filename as filename from galleries inner join images on images.gallery_id = galleries.id order by rand() limit 5', $qcon);
		while ($row = mysql_fetch_array($result)) {
			echo '<a href="/billeder/' . $row['foldername'] . '/' . $row['filename'] . '"><img src="/billeder/' . $row['foldername'] . '/frontnails/' . $row['filename'] . '" /></a><br />';
		}
		?>
		</td><td style="vertical-align: top;"><?php show_news_headlines(6); ?><a href="/nyheder" style="font-size: x-small;">flere...</a></td></tr>
		</table>
			
		</div>
	</div>
	<div id="footer" class="thestyle"></div>
</body>
</html>
