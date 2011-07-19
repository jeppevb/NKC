<?php include_once 'includes/auth.php'; ?>
<?php include_once 'includes/dbcrudconfig.php'; ?>
<?php include_once 'includes/dbqueryconfig.php'; ?>
<?php

function myTags($param) {

	$str = preg_replace('/([^\s]+\.(png|jpg|gif))(\s|$)/', '<img¤src="\1"¤/>\3', $param);

	$str = preg_replace('/(http[^\s]+(?<!(png|jpg|gif)))\s([^\s$]+)(\s|$)/', '<a href="\1">\3</a>\4', $str);

	$str = preg_replace('/' . PHP_EOL . PHP_EOL . '/', '</p><p>', $str);

	$str = preg_replace('/\n/', '<br/>', $str);

	$str = str_replace('¤',	' ', $str);

	$str = str_replace('</p>', '</p>'.PHP_EOL, $str);

	return $str;
}

$news = array();

if(!isset($_GET['action'])){
	if (isset($_POST['title']) && isset($_POST['newscontent']) && isset($_POST['meta_desc'])){

		$title = htmlentities($_POST['title'],ENT_QUOTES, 'UTF-8');
		$content = myTags(htmlentities($_POST['newscontent'],ENT_QUOTES, 'UTF-8'));
		$meta_desc = myTags(htmlentities($_POST['meta_desc'],ENT_QUOTES, 'UTF-8'));
		$admin_id = $_SESSION['SESS_ADMIN_ID'];

		mysql_query('begin');
		mysql_query('insert into news (admin_id, title, meta_desc, content) values (' . $admin_id . ', \'' . $title . '\', \'' . $meta_desc . '\', \'' . $content	. '\');', $inscon);
		$justinserted = mysql_insert_id($inscon);

		if(mysql_error())
		mysql_query('rollback');
		else
		mysql_query('commit');
		
		header('location: /nyheder/' . $justinserted . '/' . $title);
		exit();
	}else{
	$news['title'] = '';
	$news['newscontent'] = '';
	$news['meta_desc'] = '';
}
}elseif ($_GET['action'] == 'rmnews' && isset($_GET['id'])){
	mysql_query('update news set deleted = 1 where id = ' . htmlentities($_GET['id']), $inscon);
	header('Location: /admin');
	exit();
}elseif ($_GET['action'] == 'unrmnews' && isset($_GET['id'])){
	mysql_query('update news set deleted = 0 where id = ' . htmlentities($_GET['id']), $inscon);
	header('Location: /nyheder/' . htmlentities($_GET['id']));
	exit();
}elseif ($_GET['action'] == 'chnews'){
	if (isset($_POST['title']) && isset($_POST['newscontent']) && isset($_POST['meta_desc'])){
		mysql_query('update news set title = \'' . $_POST['title'] . '\', content = \'' . $_POST['newscontent'] . '\', meta_desc = \'' . $_POST['meta_desc'] . '\' where id = ' . htmlentities($_GET['id']), $inscon);
		header('location: /nyheder/' . htmlentities($_GET['id']));
	}else{
		$news = mysql_fetch_array(mysql_query('select * from news where id = ' . htmlentities($_GET['id']), $qcon));
		if(!$news){
			$news['title'] = '';
			$news['newscontent'] = '';
			$news['meta_desc'] = '';
		}
	}
}
?>

<?php include_once 'includes/header.php';?>
<?php include_once 'includes/newshelper.php';?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>

<meta http-equiv="Content-type" content="text/html; charset=utf-8" />
<link href="/stylesheets/stylesheet.css" media="screen" rel="stylesheet"
	type="text/css" />
<link rel="icon" type="image/icon" href="/favicon.ico" />
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
			<form id="" method="post" action="/opret_nyheder<?php echo (isset($_GET['action'])&&$_GET['action'] == 'chnews')?'/chnews/' . $_GET['id']:'';?>">
				<table>
					<tr>
						<td style="text-align: right;" class="legend">titel&nbsp;<img
							src="/images/info.gif" />
							<div class="legend">Feltet kan indeholde 128 tegn. Det er titelen
								som står i toppen af browseren og er linket på googles
								søgeresultat.</div></td>
						<td class="input"><input style="width: 88%;" name="title"
							id="title" type="text" value="<?php echo htmlentities($news['title']); ?>"/></td>

					</tr>
					<tr>
						<td style="text-align: right;" class="legend">kort
							beskrivelse&nbsp;<img src="/images/info.gif" />
							<div class="legend">Feltet kan indeholde 155 tegn. Den korte
								beskrivelse bruges på nyheds indexsiden, forsiden og står under
								overskriften på googles søgeresultat.</div></td>
						<td class="input"><input style="width: 88%;" name="meta_desc"
							id="meta_desc" type="text" value="<?php echo htmlentities($news['meta_desc']);?>"/></td>

					</tr>
					<tr>
						<td style="text-align: right;" class="legend">indhold&nbsp;<img
							src="/images/info.gif" />
							<div class="legend">
								Feltet indeholder din nyhed. Der er umiddelbart ingen
								begrænsning på længden.<br /> <br /> <em>Links:</em><br />Man
								laver links ved at skrive adressen på det man vil linke til
								inden det ord man vil have til at være et link. f.eks.:<br />http://www.google.com
								link. Man kan ikke lave links der bruger flere ord.<br /> <br />
								<em>Billeder:</em><br />Du tilføjer et billede ved at skrive
								stien til billedet. Billedet skal være af typen jpg, png eller
								gif. f.eks.:<br />http://nordjyskkampsport.dk/images/jeppeguillo.png
								eller images/fairtex.png
							</div></td>
						<td class="input"><textarea style="width: 88%;" name="newscontent"
								id="newscontent" rows="10"><?php echo htmlentities($news['newscontent']);?></textarea></td>

					</tr>
					<tr>
						<td><input type="submit" value="Gem nyhed" /></td>
					</tr>
				</table>
			</form>
		</div>
	</div>
	<div id="footer" class="thestyle"></div>
</body>
</html>

