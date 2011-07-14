<?php

include 'dbqueryconfig.php';

function show_board() {
	global $qcon;
	$result = mysql_query('SELECT * FROM board_of_directors order by rank asc', $qcon);
	while($row = mysql_fetch_array($result))
	{
		echo '<tr><td style="text-align: right; padding-left:3em; font-style: italic;">' . $row['title'] . ':</td><td>' . $row['name'] . '</td></tr>' . PHP_EOL;
	}
}

?>