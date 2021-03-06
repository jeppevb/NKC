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
<script type="text/javascript">

function supportsSvg() {
	//   document.implementation.hasFeature("http://www.w3.org/TR/SVG11/feature#BasicStructure"‌​, "1.1")
   if (!(document.implementation.hasFeature('org.w3c.dom.svg', '1.0')))
   {
	   window.location = "/tider/simpel";
   }
}
</script>
<title>Nordjysk Kampsportscenter - Hvornår træner vi?</title>
<meta http-equiv="description" content="Her findes oversigten over de forskellige træningstider" />
</head>
<body onload="setAd();<?php echo (isset($_GET['style']) && $_GET['style'] == 'noSVG')?'':'supportsSvg();'; ?>">
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
			<h1>Træningstider</h1>
			<?php 
			if (isset($_GET['style']) && $_GET['style'] == 'noSVG') {
				require_once 'includes/timetable_nosvg.php';
			}else{
				require_once 'includes/timetable.php';
			} 
			?> 
		</div>
	</div>
	<div id="footer" class="thestyle">&nbsp;</div>
</body>
</html>