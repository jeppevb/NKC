<?php

include 'dbqueryconfig.php';

function fetch_galleries(){
	global $qcon;
	$result = mysql_query('select id, name, posterimage.filename as posterimage, foldername, created from galleries inner join (select filename, gallery_id from images order by created asc) posterimage on posterimage.gallery_id = galleries.id group by galleries.id', $qcon);
	$i = 0;
	echo '<table class="center"><tr>';
	while ($row = mysql_fetch_array($result)){
		echo '<td class="gal"><a href="/foto/' . $row['id'] . '/' . str_replace(' ', '_', urldecode($row['name'])) . '"><img src="/billeder/' . $row['foldername'] . '/thumbnails/' . $row['posterimage'] . '"/></a><br /><span class="galcap">' . $row['name'] . '</span><br /><span class="galdate">' . $row['created'] . '</span></td>';
		if ($i > 0 && $i % 4 == 0)
			echo '</tr><tr>';
		$i++;
	}
	echo '</tr></table>';
}

function gallery($gal_id){
	global $qcon;
	$result = mysql_query('select images.id as img_id, images.filename as img_filename, foldername from galleries inner join images on images.gallery_id = galleries.id where galleries.id = ' . $gal_id . ' order by images.created desc', $qcon);
	while ($row = mysql_fetch_array($result)){
		echo '<a href="/billeder/' . $row['foldername'] . "/" . $row['img_filename'] . '"><img src="/billeder/' . $row['foldername'] . "/frontnails/" . $row['img_filename'] . '" /></a>' . PHP_EOL;
	}
}
?>

