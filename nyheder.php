<?php include_once 'includes/header.php';?>
<?php include_once 'includes/ads.php';?>
<?php include_once 'includes/newshelper.php';?>
<?php $mynews = array(); if(!isset($_GET['id'])) header('location: /nyheder'); else $myNews = fetch_news_for(mysql_real_escape_string($_GET['id'])); ?>
<?php session_start();?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-type" content="text/html; charset=utf-8" />
<link href="/stylesheets/stylesheet.css" media="screen" rel="stylesheet"
	type="text/css" />
<link rel="icon" type="image/icon" href="/favicon.ico" />
<?php ads_js_include(); ?>
<?php analytics_js(); ?>
<title><?php echo $myNews['title']; ?></title>
<meta http-equiv="description" content="<?php echo $myNews['meta_desc']; ?>" />
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
			<span class="newsheadline"><?php echo $myNews['title'];?></span><span class="newstimestamp"><?php echo $myNews['created']; ?></span>
			<p><?php echo myTags($myNews['content']);?></p>
			<?php
			
			if(isset($_SESSION['SESS_ADMIN_ID'])){
				echo '<p><a href="/opret_nyheder/rmnews/' . mysql_real_escape_string($_GET['id']) . '">slet</a>&nbsp<a href="/opret_nyheder/chnews/' . mysql_real_escape_string($_GET['id']) . '">ret</a></p>';
			}
			?>
		</div>
	</div>
	<div id="footer" class="thestyle"></div>
</body>
</html>