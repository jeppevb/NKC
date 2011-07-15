<?php include_once 'includes/auth.php'; ?>
<?php include_once 'includes/dbcrudconfig.php'; ?>
<?php

function myTags($param) {
	
	$str = preg_replace('/([^\s]+\.(png|jpg|jpeg|gif))(\s)/', '<img¤src="\1"¤/>\3', $param);

	$str = preg_replace('/(http[^\s]+(?<!(png|jpg|gif)))\s([^\s]+)(\s)/', '<a href="\1">\3</a>\4', $str);
	
	$str = str_replace('¤',	' ', $str);
	return $str;
}

if (isset($_POST['title']) AND isset($_POST['newscontent']) AND isset($_POST['meta_desc'])){

	$title = htmlentities($_POST['title'],ENT_QUOTES, 'UTF-8');
	$content = myTags(htmlentities($_POST['newscontent'],ENT_QUOTES, 'UTF-8'));
	$meta_desc = htmlentities($_POST['meta_desc'],ENT_QUOTES, 'UTF-8');
	$admin_id = $_SESSION['SESS_ADMIN_ID'];
	
	mysql_query('begin');
	mysql_query('INSERT into NEWS (admin_id, title, meta_desc, content) values (' . $admin_id . ', \'' . $title . '\', \'' . $meta_desc . '\', \'' . $content	. '\');', $inscon) or die(mysql_error());
	$justinserted = mysql_insert_id();

	if(mysql_error())
		mysql_query('rollback');
	else
		mysql_query('commit');
	mysql_close($con);
	header('location: nyheder.php?id=' . $justinserted);
}
?>

<?php include_once 'includes/header.php';?>
<?php include_once 'includes/newshelper.php';?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-type" content="text/html; charset=utf-8" />
<link href="stylesheets/stylesheet.css" media="screen" rel="stylesheet"
	type="text/css" />
<link rel="icon" type="image/icon" href="favicon.ico" />
<title>Skriv nye nyheder til nordjyskkampsportscenter</title>
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
			<form id="" method="post" action="opret_nyheder.php">
				<table>
					<tr>
						<td style="text-align: right;" class="legend">titel</td>
						<td class="input"><input style="width: 66%;" name="title"
							id="title" type="text" /></td>
						<td class="legend">feltet kan indeholde 128 tegn. Det er titelen
							som står i toppen af browseren og er linket på googles
							søgeresultat.</td>
					</tr>
					<tr>
						<td style="text-align: right;" class="legend">kort beskrivelse</td>
						<td class="input"><input style="width: 66%;" name="meta_desc"
							id="meta_desc" type="text" /></td>
						<td class="legend">feltet kan indeholde 155 tegn. Den korte
							beskrivelse bruges på nyheds indexsiden, forsiden og står under
							overskriften på googles søgeresultat.</td>
					</tr>
					<tr>
						<td style="text-align: right;" class="legend">indhold</td>
						<td class="input"><textarea style="width: 66%;" name="newscontent"
								id="newscontent" rows="10"></textarea></td>
						<td class="legend">feltet indeholder din nyhed.</td>
					</tr>
					<tr>
						<td><input type="submit" /></td>
					</tr>
				</table>
			</form>
		</div>
	</div>
	<div id="footer" class="thestyle"></div>
</body>
</html>

