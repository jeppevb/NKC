<?php
require_once 'dbqueryconfig.php';

$days = array();
$days[] = 'Mandag';
$days[] = 'Tirsdag';
$days[] = 'Onsdag';
$days[] = 'Torsdag';
$days[] = 'Fredag';
$days[] = 'L&#248;rdag';
$days[] = 'S&#248;ndag';

function nameToColor($param) {
	return '#'. substr(hash('sha256', $param), 2, 6);
}

$image_info = array();

$result = mysql_query('select areas.name as area, days.name as day, styles.name as style, begin, end, note from schedules inner join areas on areas.id = schedules.area_id inner join days on days.id = schedules.day_id inner join styles on styles.id = schedules.style_id order by day_id, begin, area_id', $qcon);
echo '<table>' . PHP_EOL;
while ($row = mysql_fetch_array($result)) {
	echo '<tr style="color: ' . nameToColor($row['style']) . ';"><td>' . $row['day'] . '</td><td> kl.: ' . $row['begin'] . ' til ' . $row['end'] . ' - </td><td style="text-align:right;">' . $row['style'] . '</td><td> i ' . $row['area'] . '</td><td>' . (($row['note']!='')?' - ':'') . $row['note'] . '</td></tr>' . PHP_EOL; 
}
echo '</table>' . PHP_EOL;

?>