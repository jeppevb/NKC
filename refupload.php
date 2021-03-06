<?php include_once 'includes/auth.php'; ?>
<?php include_once 'includes/dbcrudconfig.php'; ?>
<?php require_once 'includes/dbqueryconfig.php'; ?>
<?php include_once 'includes/header.php';?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>

<meta http-equiv="Content-type" content="text/html; charset=utf-8" />
<link href="/stylesheets/stylesheet.css" media="screen" rel="stylesheet"
	type="text/css" />
<link rel="icon" type="image/icon" href="/favicon.ico" />
<title>Upload Referat - Nordjysk Kampsportscenter</title>

<script type="text/javascript" src="includes/calendarDateInput.js">

</script>

<script type="text/javascript">
function validateUpl()
{
	
	if(document.getElementById("andetradio").checked == "checked" && document.getElementById("andet").value == ""){
		alert("du har ikke skrevet noget i feltet");
		return false;	
	}

	if(document.getElementById("file").value == ""){
		alert("du har ikke valgt en fil");
		return false;
	}
	return true;
}
</script>

</head>
<body>
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
		<a href="/logout">Log ud</a>
		
<?php
	if (isset($_FILES["file"]) && isset($_POST["date"]) && isset($_POST["type"])) {
		if ($_POST["type"] == 'andet')
			$refname = $_POST["date"] . "_" . $_POST["andet"] . ".pdf";
		else
			$refname = $_POST["date"] . "_" . $_POST["type"] . ".pdf";
		
		if ($_FILES["file"]["error"] > 0)
		{
			echo "Error: " . $_FILES["file"]["error"] . "<br />";
		}
		else
		{
			$_POST["date"] = substr($_POST["date"], 2);
			if (file_exists("referater/" . $refname))
			{
				echo "referater/" . $refname . " findes i forvejen.";
			}
			else
			{
				copy($_FILES["file"]["tmp_name"], "referater/" . $refname);
				echo "Referat uploadet: " .  $refname;
			}
		}
		echo "<hr />";
	}
?>
			<form onsubmit="return validateUpl();" action="/upload_referat" method="post" enctype="multipart/form-data">
				<label for="type">Mødetype:</label><span class="legend"><img src="/billeder/info.gif" />
				<div class="legend">Vælg en mødetype. Vælger du den nederste skal du give et alternativ.</div></span><br />
				<input type="radio" name="type" value="bestyrelse" checked="checked" />bestyrelse<br />
				<input type="radio" name="type" value="instruktør" />instruktør<br />
				<input type="radio" name="type" value="generalforsamling" />generalforsamling<br />
				<input type="radio" id="andetradio" name="type" value="andet" /><input type="text" id="andet" />
				<br />
				<label for="date">dato:&nbsp;</label>
				<script>DateInput('date', true, 'YYYYMMDD');</script><br />
				<label for="file">referat:&nbsp;</label>
				<input type="file" name="file" id="file" accept="application/pdf" /> 
				<input type="submit" name="submit" value="Upload Referat" />
			</form>
		</div>
	</div>
	<div id="footer" class="thestyle"></div>
</body>
</html>

