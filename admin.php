<?php include_once 'includes/auth.php'; ?>
<?php include_once 'includes/dbcrudconfig.php'; ?>
<?php require_once 'includes/dbqueryconfig.php'; ?>
<?php include_once 'includes/header.php';?>
<?php
if(isset($_GET['action'])){
	switch ($_GET['action']) {
		case 'rmadmin':
			$myAdmins = mysql_query('select * from admins', $qcon);
			if(mysql_num_rows($myAdmins) > 1 && isset($_GET['adminid'])){
				mysql_query('delete from admins where id =' . htmlentities($_GET['adminid']), $inscon);
			}
			header('Location: /admin');
			exit();
			break;
		case 'mkadmin':
			if(isset($_GET['login']) && isset($_GET['passHash'])){
				mysql_query('insert into admins (login, password) values (\'' . htmlentities($_GET['login']) . '\', \'' . htmlentities($_GET['passHash']). '\');', $inscon);
			}
			header('Location: /admin');
			exit();
			break;
		case 'chpass':
			if(isset($_GET['adminid']) && isset($_GET['passHash'])){
				mysql_query('update admins set password = \'' . htmlentities($_GET['passHash']) . '\' where id =' . htmlentities($_GET['adminid']), $inscon);
			}
			header('Location: /admin');
			exit();
			break;
		case 'chsched':
			if(isset($_GET['schedid']) && isset($_POST['begin']) && isset($_POST['end']) && isset($_POST['note']) && isset($_POST['day']) && isset($_POST['style']) && isset($_POST['area'])){
				mysql_query('update schedules set begin = \'' . htmlentities($_POST['begin']) . '\', end = \''  . htmlentities($_POST['end']) . '\', note =\'' . fixDanString($_POST['note']) . '\', day_id =\'' . htmlentities($_POST['day']) . '\', style_id = \'' . htmlentities($_POST['style']) . '\', area_id = ' . htmlentities($_POST['area']) . ' where id =' . htmlentities($_GET['schedid']), $inscon);
			}
			break;
		case 'mksched':
			if(isset($_POST['begin']) && isset($_POST['end']) && isset($_POST['note']) && isset($_POST['day']) && isset($_POST['style']) && isset($_POST['area'])){
				mysql_query('insert into schedules (begin, end, note, day_id, style_id, area_id) values (\'' . htmlentities($_POST['begin']) . '\', \''  . htmlentities($_POST['end']) . '\', \'' . htmlentities($_POST['note']) . '\', \'' . htmlentities($_POST['day']) . '\', \'' . htmlentities($_POST['style']) . '\', \'' . htmlentities($_POST['area']) . '\')', $inscon);
			}
			break;
		case 'rmsched':
			if(isset($_GET['schedid'])){
				mysql_query('delete from schedules where id =' . htmlentities($_GET['schedid']), $inscon);
			}
			break;
	}
}

function fixDanString($param) {
	$str = $param;
	$str = str_replace('æ', '&aelig;', $str);
	$str = str_replace('ø', '&oslash;', $str);
	$str = str_replace('å', '&aring;', $str);
	$str = str_replace('Æ', '&AElig;', $str);
	$str = str_replace('Ø', '&Oslash;', $str);
	$str = str_replace('Å', '&Aring;', $str);
	
	return $str;
	
}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>

<meta http-equiv="Content-type" content="text/html; charset=utf-8" />
<link href="/stylesheets/stylesheet.css" media="screen" rel="stylesheet"
	type="text/css" />
<link rel="icon" type="image/icon" href="/favicon.ico" />
<title>administrer Nordjysk Kampsportscenter</title>

<script src="includes/sha256.js" type="text/javascript"></script>

<script type="text/javascript">
function createAdmin() {
	if (document.getElementById("newPass").value == ""){
		alert("fejl: password blankt");
		
	}else 
		window.location ="/admin/mkadmin/" + document.getElementById("newLogin").value + "/" + sha256_digest(document.getElementById("newPass").value);
	
}

function changePass(adminid) {
	var pass1 = prompt("Hvad er den nye kode?");
	if (pass1 == ""){
		alert("fejl: password blankt");
	}else{ 
		window.location = "/admin/chpass/" + adminid + "/" + sha256_digest(pass1);
	}
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
		<h2>Tider</h2>
			<?php 
			
			$result = mysql_query('select * from days order by id asc', $qcon);
			$days = array();
			while ($row = mysql_fetch_array($result)){
				$days[] = $row;
			}
			
			$result = mysql_query('select * from styles', $qcon);
			$styles = array();
			while ($row = mysql_fetch_array($result)){
				$styles[] = $row;
			}
			
			$result = mysql_query('select * from areas', $qcon);
			$areas = array();
			while ($row = mysql_fetch_array($result)){
				$areas[] = $row;
			}
			
			$result = mysql_query('select * from schedules order by day_id, begin asc', $qcon);
			while ($row = mysql_fetch_array($result)){
				echo '
<form method="post" action="/admin/chsched/' . $row['id'] . '">
	<div>
		<select name="day">';
				foreach ($days as $day) {
					echo '			<option ' . (($day['id'] == $row['day_id'])?'selected="selected"':'') . 'value="' . $day['id'] . '">' . $day['name'] . '</option>' . PHP_EOL;
				}
				echo '		</select>
		<input style="width:3em;" type="text" name="begin" value="' . $row['begin'] . '"/>
		<span>&nbsp;til&nbsp;</span><input style="width:3em;" type="text" name="end" value="' . $row['end'] . '"/>
		<span>note:</span><input type="text" name="note" style="width: 22em;" value="' . $row['note'] . '"/>
		
		<select name="style">' . PHP_EOL;
				foreach ($styles as $style) {
					echo '			<option ' . (($style['id'] == $row['style_id'])?'selected="selected"':'') . 'value="' . $style['id'] . '">' . $style['name'] . '</option>' . PHP_EOL;
				}
				echo '		</select>
		<select name="area">' . PHP_EOL;
				foreach ($areas as $area) {
					echo '			<option ' . (($area['id'] == $row['area_id'])?'selected="selected"':'') . 'value="' . $area['id'] . '">' . $area['name'] . '</option>' . PHP_EOL;
				}
				echo '		</select>
		<input type="submit" value="Gem" />
		<a href="/admin/rmsched/' . $row['id'] . '">slet</a>' . PHP_EOL;
				
				echo '	</div>
</form>
				' . PHP_EOL;
			}
			
			//new schedule
			echo '
			<form method="post" action="/admin/mksched">
				<div>
					<select name="day">';
			foreach ($days as $day) {
				echo '			<option value="' . $day['id'] . '">' . $day['name'] . '</option>' . PHP_EOL;
			}
			echo '		</select>
					<input style="width:3em;" type="text" name="begin" value=""/>
					<span>&nbsp;til&nbsp;</span><input style="width:3em;" type="text" name="end" value=""/>
					<span>note:</span><input style="width: 22em;" type="text" name="note" value=""/>
					<select name="style">' . PHP_EOL;
			foreach ($styles as $style) {
				echo '			<option value="' . $style['id'] . '">' . $style['name'] . '</option>' . PHP_EOL;
			}
			echo '		</select>
					<select name="area">' . PHP_EOL;
			foreach ($areas as $area) {
				echo '			<option value="' . $area['id'] . '">' . $area['name'] . '</option>' . PHP_EOL;
			}
			echo '		</select>
					<input type="submit" value="Opret" />' . PHP_EOL;
			
			echo '	</div>
			</form>
							' . PHP_EOL;
			?>
			<h2>Nyheder</h2>
			<a href="/opret_nyheder">Opret nyhed</a><br />
			<p>
				<em class="legend">slettede:</em><br />
				
				
				
				
				
				
				
				
	
			<?php 
			$deleted_news = mysql_query('select * from news where deleted order by created desc', $qcon);
			while ($row = mysql_fetch_array($deleted_news)) {
				echo (strlen($row['title'])>20)?substr($row['title'], 0, 20) . '...':$row['title'];
				echo '&nbsp;<a href="/opret_nyheder/unrmnews/' . $row['id'] . '">genopret</a><br />' . PHP_EOL;	
			} 
			?>
			</p>
			<h2>Administratorer</h2>
			
			
			
			
			
			
			
			

			<?php 
			$admin_result = mysql_query('select login, id from admins', $qcon);
			while($row = mysql_fetch_array($admin_result)){
				echo $row['login'] . '&nbsp;<a href="/admin/rmadmin/' . $row['id'] .'">slet</a>&nbsp;<a href="javascript:changePass(' . $row['id'] . ')">ny kode</a><br />' . PHP_EOL;
			}
			
			?>
			<input id="newLogin" type="text" /><input id="newPass" type="password"/><a href="javascript:createAdmin()">opret administrator</a>
			
		</div>
	</div>
	<div id="footer" class="thestyle"></div>
</body>
</html>

