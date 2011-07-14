<?php

include 'dbqueryconfig.php';

function fetch_style_for($id) {
	global $qcon;
	$result = mysql_query('SELECT * FROM styles WHERE id = ' . $id, $qcon);

	if($row = mysql_fetch_array($result))
	{
		return $row;
	}else{
		die('could not find style with id =' . $id);
	}
}

function fetch_style_index() {
	global $qcon;
	$result = mysql_query('SELECT * FROM styles', $qcon);
	$name = 'Stilarter';
	$meta_desc = 'Vi tilbyder træning i mange spændende kampsportsdiscipliner. Her kan du se en oversigt.';
	$description = '<ul>';
	while($row = mysql_fetch_array($result))
	{
		$description .= '<li><a href="stilart.php?id=' . $row['id'] . '">' . $row['name'] . '</a></li>';	
	}
	
	$description = $description . '</ul><p>Hvis du er interesseret i at prøve, så mød friskt op eller tag kontakt til en af vore instruktører. Det er også muligt at arrangere workshops for foreninger og uddannelsesinstitutioner via workshop@nordjyskkampsport.dk</p>';
	
	$index = array();
	$index['name'] = $name;
	$index['meta_desc'] = $meta_desc;
	$index['description'] = $description;
	
	return $index;
}

function show_instructor_list() {
	global $qcon;
	
	echo '<ul>';
	$styles = mysql_query('select id, name, head_coach_id, email from styles', $qcon);
	while ($myStyle = mysql_fetch_array($styles)) {
		$headcoach = mysql_fetch_array(mysql_query('select * from coaches where id = ' . $myStyle['head_coach_id'], $qcon));
		echo '<li><b>' . $myStyle['name'] . '</b> - <em>' . $headcoach['name'] . '</em> - ' . $myStyle['email'];
		$coaches = mysql_query('select * from coaches where id in (select coach_id from coaches_styles where style_id = ' . $myStyle['id'] . ') and id != ' . $myStyle['head_coach_id'], $qcon);
		echo '<ul>';
		while ($mycocoach = mysql_fetch_assoc($coaches)) {
			echo '<li><em>' . $mycocoach['name'] . '</em></li>';
		}
		echo '</ul>' . '</li>';
		
	}
	echo '</ul>';
}

?>