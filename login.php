<?php include_once 'includes/header.php';?>
<?php include_once 'includes/ads.php';?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-type" content="text/html; charset=utf-8" />
<link href="stylesheets/stylesheet.css" media="screen" rel="stylesheet"
	type="text/css" />
<link rel="icon" type="image/icon" href="favicon.ico" />
<?php #ads_js_include(); ?>
<?php analytics_js(); ?>
<title>Login som administrator</title>
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
			<form id="loginForm" method="post"
				action="login_check.php">
				<table width="300" border="0" cellpadding="2"
					cellspacing="0">
					<tr>
						<td style="width:112px;"><b>Login</b><input id="target" name="target" type="hidden" value="<?php session_start(); if(isset($_SESSION['target'])){ echo $_SESSION['target']; } session_write_close();?>" /></td>
						<td style="width:188px;"><input name="login" type="text" class="textfield"
							id="login" /></td>
					</tr>
					<tr>
						<td><b>Password</b></td>
						<td><input name="password" type="password" class="textfield"
							id="password" /></td>
					</tr>
					<tr>
						<td>&nbsp;</td>
						<td><input type="submit" name="Submit" value="Login" /></td>
					</tr>
				</table>
			</form>
		</div>
	</div>
	<div id="footer" class="thestyle"></div>
</body>
</html>

