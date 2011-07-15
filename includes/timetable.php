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
	return '#'. substr(md5($param), 3, 6);	
}

$image_info = array();

$result = mysql_query('select begin, end from schedules', $qcon);

$first_hour = 25;
$final_hour = -1;
while ($row = mysql_fetch_array($result)) {
	if(date('H', strtotime($row['begin']))<$first_hour)
		$first_hour=date('H', strtotime($row['begin']));
	if(date('H', strtotime($row['end']))>$final_hour)
		$final_hour=date('H', strtotime($row['end']));
}


$image_info['first_hour'] = $first_hour;
$image_info['final_hour'] = $final_hour;

$image_info['width'] = 750;
$image_info['height'] = (90 + 40*($image_info['final_hour']-$image_info['first_hour']));

$image_info['time_column_y_offset'] = 35;

$image_info['day_space'] = floor(($image_info['width'] - $image_info['time_column_y_offset'])/7);
$image_info['first_day_y_offset'] = floor($image_info['day_space']/2) + $image_info['time_column_y_offset'];



echo '<?xml version="1.0" standalone="no" encoding="utf-8" ?>
<!DOCTYPE svg PUBLIC "-//W3C//DTD SVG 1.1//EN"
"http://www.w3.org/Graphics/SVG/1.1/DTD/svg11.dtd">
<svg width="' . $image_info['width'] . '" height="' . $image_info['height'] . '" version="1.1" xmlns="http://www.w3.org/2000/svg">
<!-- <rect x="100" y="50" width="40" height="40" stroke="#cb391d" stroke-width="2" fill-opacity="0.75" fill="#000000" /> -->
';
for ($i = 0; $i < count($days) ; $i++) {
	echo '<text text-anchor="middle" font-family="helvetica" x="'. ($image_info['first_day_y_offset'] + ($i * $image_info['day_space'])) .'" y="10" font-size="10">' . $days[$i] . '</text>' . PHP_EOL;
	echo '<text text-anchor="middle" font-family="helvetica" x="'. ($image_info['first_day_y_offset'] + ($i * $image_info['day_space']) - 17) .'" y="20" font-size="8">Dojo 1</text>' . PHP_EOL;
	echo '<text text-anchor="middle" font-family="helvetica" x="'. ($image_info['first_day_y_offset'] + ($i * $image_info['day_space']) + 17) .'" y="20" font-size="8">Dojo 2</text>' . PHP_EOL;
}

for ($i = 0; $i < $image_info['final_hour']-$image_info['first_hour']; $i++) {
	echo '
<text text-anchor="middle" font-family="helvetica" x="13" y="' . (34+(40*$i)) . '" font-size="10">' . date('H:i', (($i + $image_info['first_hour']-1)*3600)) . '</text>
<path d="M 28 ' . (30+(40*$i)) . ' L ' . $image_info['width'] . ' ' . (30+(40*$i)) . '" stroke="black" stroke-width="1" fill="none" stroke-opacity="1" />
<path d="M 0 ' . (40+(40*$i)) . ' L ' . $image_info['width'] . ' ' . (40+(40*$i)) . '" stroke="black" stroke-width="0.5" fill="none" stroke-opacity="0.35" />
<path d="M 0 ' . (50+(40*$i)) . ' L ' . $image_info['width'] . ' ' . (50+(40*$i)) . '" stroke="black" fill="none" stroke-width="1" stroke-opacity="0.55" />
<path d="M 0 ' . (60+(40*$i)) . ' L ' . $image_info['width'] . ' ' . (60+(40*$i)) . '" stroke="black" stroke-width="0.5" fill="none" stroke-opacity="0.35" />
	';
}
echo '
<text text-anchor="middle" font-family="helvetica" x="13" y="' . (34+(40*($image_info['final_hour']-$image_info['first_hour']))) . '" font-size="10">' . date('H:i', (($image_info['final_hour']-1)*3600)) . '</text>
<path d="M 28 ' . (30+(40*($image_info['final_hour']-$image_info['first_hour']))) . ' L ' . $image_info['width'] . ' ' . (30+(40*($image_info['final_hour']-$image_info['first_hour']))) . '" stroke="black" stroke-width="1" fill="none" stroke-opacity="1" />';

for ($i = 0; $i < count($days); $i++) {
	$result = mysql_query('select begin, end, note, area, styles.name as name from schedules inner join styles on styles.id = schedules.style_id where schedules.day = \'' . $days[$i] . '\';', $qcon);
	while ($row = mysql_fetch_array($result)) {
		echo '
<rect x="'. ($image_info['first_day_y_offset'] + (($i * $image_info['day_space'])-10 + ($row['area']=='Dojo 1'?-17:17))) . '" y="' . 
		(30+40*(date('H', strtotime($row['begin']))-$image_info['first_hour'])+10*(floor(date('i', strtotime($row['begin']))/15)))
 . '" width="20" height="' . 
		(
			floor(
				10*(
					(date('i', strtotime($row['end']))-date('i', strtotime($row['begin']))+
					(60*(date('H', strtotime($row['end']))-date('H', strtotime($row['begin'])))))/15)))
 . '" stroke="none" fill-opacity="0.75" fill="' . nameToColor($row['name']) . '" />
';
	}
	
}

echo '</svg>';
?>