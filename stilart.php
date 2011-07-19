<?php include_once 'includes/header.php';?>
<?php include_once 'includes/ads.php';?>
<?php include_once 'includes/stylehelper.php'; ?>
<?php (!isset($_GET['id']))?$style = fetch_style_index():$style = fetch_style_for(htmlentities($_GET['id'])); ?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-type" content="text/html; charset=utf-8" />
<link href="/stylesheets/stylesheet.css" media="screen" rel="stylesheet"
	type="text/css" />
<link rel="icon" type="image/icon" href="/favicon.ico" />
<?php ads_js_include(); ?>
<?php analytics_js(); ?>
<title><?php echo $style['name']; ?> i Nordjysk Kampsportscenter</title>
<meta http-equiv="description" content="<?php echo $style['meta_desc']; ?>" />
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
			<h1><?php echo $style['name'] . ' i Nordjysk Kampsportscenter'; ?></h1>
			<?php echo $style['description']; ?>
		<h2><a href="/tider">Træningstider</a></h2>
		<table>
		<?php 
		for ($i = 0; $i < count($style['schedule']); $i++) {
			echo ' 
		<tr>
		<td>' . $style['schedule'][$i]['day'] . ':</td><td>' . $style['schedule'][$i]['begin'] . ' - ' . $style['schedule'][$i]['end'] . '</td><td class="legend">' . $style['schedule'][$i]['note'] . '</td>
		</tr>
		';
		}
		?>
		</table>
		<h2><a href="/instruktoerer">Instruktører</a></h2>
		
		<?php show_instructors_for($style['id']);?>
		</div>
	</div>
	<div id="footer" class="thestyle"></div>
</body>
</html>