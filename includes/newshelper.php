<?php

include 'dbqueryconfig.php';

function fetch_news_for($id) {
	global $qcon;
	$result = mysql_query('SELECT * FROM news WHERE id = ' . $id, $qcon);

	if($row = mysql_fetch_array($result))
	{
		return $row;
	}else{
		die('could not find news with id =' . $id);
	}
}

function show_news_headlines($number_of_rows) {
	global $qcon;
	$result = mysql_query('SELECT id, title, meta_desc, UNIX_TIMESTAMP(created) as created FROM news where not deleted order by created desc limit ' . $number_of_rows, $qcon);
	session_start();
	
	setlocale(LC_TIME, 'da_DK', 'dk', 'Danish');
	while($row = mysql_fetch_array($result))
	{
		echo '<span class="newsheadline"><a href="/nyheder/' . $row['id'] . '/'. str_replace(' ', '_', $row['title']) . '">' . $row['title'] . '</a></span>&nbsp;<span class="newstimestamp">' . strftime('%H:%M - %#d. %B %Y',$row['created']) . '</span>' . PHP_EOL;
		echo '<p class="newsdesc">' . myTags($row['meta_desc']) . '</p>' . PHP_EOL;
		if(isset($_SESSION['SESS_ADMIN_ID'])){
			echo '<p><a href="/opret_nyheder/rmnews/' . $row['id'] . '">slet</a>&nbsp<a href="/opret_nyheder/chnews/' . $row['id'] . '">ret</a></p>';
		}
		echo '<hr />' . PHP_EOL;
	}
}

function myTags($param) {

	$str = preg_replace('/([^\s]+\.(png|jpg|gif))(\s|$)/', '<img¤src="\1"¤/>\3', $param);

	$str = preg_replace('/(http[^\s]+(?<!(png|jpg|gif)))\s([^\s$]+)(\s|$)/', '<a href="\1">\3</a>\4', $str);

	$str = preg_replace('/' . PHP_EOL . PHP_EOL . '/', '</p><p>', $str);

	$str = preg_replace('/\n/', '<br/>', $str);

	$str = str_replace('¤',	' ', $str);

	$str = str_replace('</p>', '</p>'.PHP_EOL, $str);

	return $str;
}
?>