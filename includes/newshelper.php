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
	$result = mysql_query('SELECT id, title, meta_desc, UNIX_TIMESTAMP(created) as created FROM news order by created desc limit ' . $number_of_rows, $qcon);

	setlocale(LC_TIME, 'da_DK', 'dk', 'Danish');
	while($row = mysql_fetch_array($result))
	{
		echo '<span class="newsheadline"><a href="nyheder.php?id=' . $row['id'] . '">' . $row['title'] . '</a></span>&nbsp;<span class="newstimestamp">' . strftime('%H:%M - %#d. %B %Y',$row['created']) . '</span>' . PHP_EOL;
		echo '<p class="newsdesc">' . $row['meta_desc'] . '</p>' . PHP_EOL;
		echo '<hr />' . PHP_EOL;
	}
}

?>