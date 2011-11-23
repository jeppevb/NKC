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
			if (isset($_FILES["file"]) && isset($_POST["gallery"])) {
				global $qcon;
				$result = mysql_query('SELECT foldername FROM galleries where id = ' . mysql_real_escape_string($_POST['gallery']) , $qcon);
				$row = mysql_fetch_array($result);
								
				$galleryfolder = $row['foldername'];
				foreach ($_FILES["file"]["error"] as $key => $error) {
					if ($error == UPLOAD_ERR_OK) {
						$tmp_name = $_FILES["file"]["tmp_name"][$key];
						if (isset($_POST["newname"]) && $_POST["newname"][$key] != "")
							$name = mysql_real_escape_string($_POST["newname"][$key]) . '.' . end(explode(".", $_FILES["file"]["name"][$key]));
						else
							$name = mysql_real_escape_string($_FILES["file"]["name"][$key]);
						
						if (!file_exists("billeder/" . $galleryfolder . "/" . $name)) {
							copy($tmp_name, "billeder/" . $galleryfolder . "/" . $name);
							
							list($width_orig, $height_orig) = getimagesize("billeder/" . $galleryfolder . "/" . $name);
							
							$src = "billeder/" . $galleryfolder . "/" . $name;
							switch(strtolower(end(explode(".", $name)))){
								case 'bmp': $img = imagecreatefromwbmp($src); break;
								case 'gif': $img = imagecreatefromgif($src); break;
								case 'jpg': $img = imagecreatefromjpeg($src); break;
								case 'png': $img = imagecreatefrompng($src); break;
								default : return "Unsupported picture type!";
							}
							
							$thumbnail = imagecreatetruecolor(50, floor((50/$width_orig)*$height_orig));
							$frontnail = imagecreatetruecolor(272, floor((272/$width_orig)*$height_orig));
								
							imagecopyresampled($thumbnail, $img, 0, 0, 0, 0,  50, floor(( 50/$width_orig)*$height_orig), $width_orig, $height_orig);
							imagecopyresampled($frontnail, $img, 0, 0, 0, 0, 272, floor((272/$width_orig)*$height_orig), $width_orig, $height_orig);
							
							switch(strtolower(end(explode(".", $name)))){
								case 'bmp': imagewbmp($thumbnail, "billeder/" . $galleryfolder . "/thumbnails/" . $name);
											imagewbmp($frontnail, "billeder/" . $galleryfolder . "/frontnails/" . $name); 
											break;
								case 'gif': imagegif($thumbnail, "billeder/" . $galleryfolder . "/thumbnails/" . $name);
											imagegif($frontnail, "billeder/" . $galleryfolder . "/frontnails/" . $name);
											break;
								case 'jpg': imagejpeg($thumbnail, "billeder/" . $galleryfolder . "/thumbnails/" . $name);
											imagejpeg($frontnail, "billeder/" . $galleryfolder . "/frontnails/" . $name); 
											break;
								case 'png': imagepng($thumbnail, "billeder/" . $galleryfolder . "/thumbnails/" . $name);
											imagepng($frontnail, "billeder/" . $galleryfolder . "/frontnails/" . $name);
											break;
								default : return "Unsupported picture type!";
							}
							imagedestroy($img);
							imagedestroy($thumbnail);
							imagedestroy($frontnail);
							
						}
						mysql_query('insert into images (gallery_id, filename) values (\'' . mysql_real_escape_string($_POST['gallery']) . '\', \''  . $name . '\')', $inscon);
					}
					else
					{
						switch ($error) {
							case UPLOAD_ERR_INI_SIZE:
							$_SESSION['notification'] = 'Filen var for stor. Max er 2 megabyte.';
							header('location: /notifikation');
							break;
						}
					}	
				}
			}
		break;
		case "gallery":
			mysql_query('insert into galleries (foldername, name, created) values (\'' . mysql_real_escape_string($_POST['foldername']) . '\', \'' . mysql_real_escape_string($_POST['galleryname']) . '\', sysdate())', $inscon);
			echo mysql_error($inscon);
			mkdir('billeder/'. addslashes($_POST['foldername']));
			mkdir('billeder/'. addslashes($_POST['foldername'] . '/thumbnails'));
			mkdir('billeder/'. addslashes($_POST['foldername'] . '/frontnails'));
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
<title>Upload Billeder - Nordjysk Kampsportscenter</title>

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
	extraRow = document.createElement("tr");
	extraRow.innerHTML = "<td><input type=\"file\" name=\"file[]\" accept=\"image/*\" /></td><td><input type=\"text\" name=\"newname[]\" /></td>";
	document.getElementById("filestbl").appendChild(extraRow);
	
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
			<hr />
			<br />
			
			<form onsubmit="return validateUpl();" action="/upload_billede/upload" method="post" enctype="multipart/form-data" >
				<select name="gallery">
				<?php printGalleries(); ?>	
				</select>
				<br /><br />
				<input type="button" value="Flere linier?" onclick="addLine();" />
				<table>
				<tbody id="filestbl">
				<tr><th>billede</th><th>omdøb til</th></tr>
				<tr><td><input type="file" name="file[]" accept="image/*" /></td><td><input type="text" name="newname[]" /></td></tr>
				</tbody>
				</table>
				<input type="submit" name="submit" value="Upload filer" />
			</form>
		</div>
	</div>
	<div id="footer" class="thestyle"></div>
</body>
</html>

