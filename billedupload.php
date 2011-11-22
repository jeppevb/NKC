<?php include_once 'includes/auth.php'; ?>
<?php include_once 'includes/dbcrudconfig.php'; ?>
<?php require_once 'includes/dbqueryconfig.php'; ?>
<?php include_once 'includes/header.php';?>

<?php 
function printGalleries(){
	
	global $qcon;
	$result = mysql_query('SELECT id, name FROM galleries', $qcon);
	
	while($row = mysql_fetch_array($result))
	{
		echo '<option value="' . $row['id'] . '">' . $row['name'] . '</option>' . PHP_EOL;
	}
}
if (isset($_GET['action'])) {
	switch ($_GET['action']){
		case "upload":
			if (isset($_FILES["file"]) && isset($_POST["newname"]) && isset($_POST["gallery"])) {
				$i = 0;
				global $qcon;
				$result = mysql_query('SELECT id, name FROM galleries', $qcon);
				$galleryfoldername;
				foreach ($_FILES["pictures"]["error"] as $key => $error) {
					if ($error == UPLOAD_ERR_OK) {
						$tmp_name = $_FILES["pictures"]["tmp_name"][$key];
						if ($_POST["newname"][$i] == "")
							$name = $_POST["newname"][$i] . '.' . end(explode(".", $_FILES["pictures"]["name"][$key]));
						else
							$name = $_FILES["pictures"]["name"][$key];
						
						//vi skal lige tilføje et insert til db
						//vi skal lige finde ud af hvad der skal stå i $galleryfolder
						
						move_uploaded_file($tmp_name, "billeder/" . $galleryfolder . "/" . $name);
						$i++;
					}
				}
			}
		break;
		case "gallery":
			mysql_query('insert into galleries (foldername, name, created) values (\'' . htmlentities($_POST['foldername']) . '\', \''  . htmlentities($_POST['galleryname']) . '\', sysdate())', $inscon);
			echo mysql_error($inscon);
		break;
	}
}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>

<meta http-equiv="Content-type" content="text/html; charset=utf-8" />
<link href="/stylesheets/stylesheet.css" media="screen" rel="stylesheet"
	type="text/css" />
<link rel="icon" type="image/icon" href="/favicon.ico" />
<title>Upload Referat - Nordjysk Kampsportscenter</title>

<script type="text/javascript" src="includes/calendarDateInput.js">
/***********************************************
* Jason's Date Input Calendar- By Jason Moon http://calendar.moonscript.com/dateinput.cfm
* Script featured on and available at http://www.dynamicdrive.com
* Keep this notice intact for use.
***********************************************/
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

function validateGal()
{
	var gallerypattern=/^[a-z0-9æøå\ ]+$/i;
	var folderpattern=/^[a-z0-9]+$/i;
	
	if(!gallerypattern.test(document.getElementById("galleryname").value)){
		alert("du har ikke skrevet noget fornuftigt i gallerinavn");
		return false;	
	}else if(!folderpattern.test(document.getElementById("foldername").value)){
		alert("du har skrevet noget juks i mappenavn");
		return false;	
	}else
		return true;
}

function addLine()
{
	document.getElementById("filestbl").innerHTML += "<tr><td><input type=\"file\" name=\"file[]\" accept=\"image/*\" /></td><td><input type=\"text\" id=\"newname[]\" /></td></tr>";
	
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
			<a href="/logout">Log ud</a><br />
			<form onsubmit="return validateGal();" action="/upload_billede/gallery" method="post" >
				<table>
				<tr><th>mappenavn</th><th>gallerinavn</th></tr>
				<tr><td><input type="text" id="foldername" name="foldername" /></td><td><input type="text" id="galleryname" name="galleryname"/></td></tr>
				</table>
				<input type="submit" name="submit" value="Opret galleri" />
			</form>
			<br />
			<form onsubmit="return validateUpl();" action="/upload_billede/upload" method="post" enctype="multipart/form-data" >
				<select name="gallery">
				<?php printGalleries(); ?>	
				</select>
				<br /><br />
				<input type="button" value="Flere linier?" onclick="addLine();" />
				<table id="filestbl">
				<tr><th>billede</th><th>omdøb til</th></tr>
				<tr><td><input type="file" name="file[]" accept="image/*" /> </td><td><input type="text" id="newname[]" /></td></tr>
				</table>
				<input type="submit" name="submit" value="Upload filer" />
			</form>
		</div>
	</div>
	<div id="footer" class="thestyle"></div>
</body>
</html>

