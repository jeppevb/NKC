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

$result = mysql_query('select begin, end from schedules', $qcon);

$first_hour = 25;
$final_hour = -1;
while ($row = mysql_fetch_array($result)) {
	if(date('H', strtotime($row['begin']))<$first_hour)
	$first_hour=date('H', strtotime($row['begin']));
	if(date('H', strtotime($row['end']))>$final_hour){
		$final_hour=date('H', strtotime($row['end']));
	}
	if(date('i', strtotime($row['end']))>0 && 1+date('H', strtotime($row['end']))>$final_hour ){
		$final_hour=1+date('H', strtotime($row['end']));
	}
}


$image_info['first_hour'] = $first_hour;
$image_info['final_hour'] = $final_hour;

$active_styles = mysql_query('select name, id from styles where id in (select distinct style_id from schedules);', $qcon);

$image_info['y_offset'] = 15+20*mysql_num_rows($active_styles);

$image_info['width'] = 850;
$image_info['height'] = (90 + 40*($image_info['final_hour']-$image_info['first_hour']) + $image_info['y_offset']);

$image_info['time_column_x_offset'] = 35;

$image_info['day_space'] = floor(($image_info['width'] - $image_info['time_column_x_offset'])/7);
$image_info['first_day_x_offset'] = floor($image_info['day_space']/2) + $image_info['time_column_x_offset'];



echo '
<?xml version="1.0" standalone="no" encoding="utf-8" ?>
<!DOCTYPE svg PUBLIC "-//W3C//DTD SVG 1.1//EN"
"http://www.w3.org/Graphics/SVG/1.1/DTD/svg11.dtd">

<svg width="' . $image_info['width'] . '" height="' . $image_info['height'] . '" version="1.1" xmlns="http://www.w3.org/2000/svg">

';
//Day and area labels
for ($i = 0; $i < count($days) ; $i++) {
	echo '<text text-anchor="middle" font-family="helvetica" x="'. ($image_info['first_day_x_offset'] + ($i * $image_info['day_space'])) .'" y="' . (10+$image_info['y_offset']) . '" font-size="10">' . $days[$i] . '</text>' . PHP_EOL;
	echo '<text text-anchor="middle" font-family="helvetica" x="'. ($image_info['first_day_x_offset'] + ($i * $image_info['day_space']) - 17) .'" y="' . (20+$image_info['y_offset']) . '" font-size="8">Dojo 1</text>' . PHP_EOL;
	echo '<text text-anchor="middle" font-family="helvetica" x="'. ($image_info['first_day_x_offset'] + ($i * $image_info['day_space']) + 17) .'" y="' . (20+$image_info['y_offset']) . '" font-size="8">Dojo 2</text>' . PHP_EOL;
	echo '<path d="M ' . ($i * $image_info['day_space'] + 34) . ' ' . ($image_info['y_offset']+12) . ' L ' . ($i * $image_info['day_space'] + 34) . ' ' . ($image_info['y_offset']+30+(40*($image_info['final_hour']-$image_info['first_hour']))) . '" stroke="#cb391d" stroke-width="1" fill="none" stroke-opacity="1" />';
}

//Horizontal grid
for ($i = 0; $i < $image_info['final_hour']-$image_info['first_hour']; $i++) {
	echo '
<text text-anchor="left" font-family="helvetica" x="0" y="' . ($image_info['y_offset']+34+(40*$i)) . '" font-size="10">' . date('H:i', (($i + $image_info['first_hour']-1)*3600)) . '</text>
<path d="M 28 ' . ($image_info['y_offset']+30+(40*$i)) . ' L ' . $image_info['width'] . ' ' . ($image_info['y_offset']+30+(40*$i)) . '" stroke="black" stroke-width="1" fill="none" stroke-opacity="1" />
<path d="M 0 ' . ($image_info['y_offset']+40+(40*$i)) . ' L ' . $image_info['width'] . ' ' . ($image_info['y_offset']+40+(40*$i)) . '" stroke="black" stroke-width="0.5" fill="none" stroke-opacity="0.35" />
<path d="M 0 ' . ($image_info['y_offset']+50+(40*$i)) . ' L ' . $image_info['width'] . ' ' . ($image_info['y_offset']+50+(40*$i)) . '" stroke="black" fill="none" stroke-width="1" stroke-opacity="0.55" />
<path d="M 0 ' . ($image_info['y_offset']+60+(40*$i)) . ' L ' . $image_info['width'] . ' ' . ($image_info['y_offset']+60+(40*$i)) . '" stroke="black" stroke-width="0.5" fill="none" stroke-opacity="0.35" />
	';
}
//last hour label and line
echo '
<text text-anchor="middle" font-family="helvetica" x="13" y="' . ($image_info['y_offset']+34+(40*($image_info['final_hour']-$image_info['first_hour']))) . '" font-size="10">' . date('H:i', (($image_info['final_hour']-1)*3600)) . '</text>
<path d="M 28 ' . ($image_info['y_offset']+30+(40*($image_info['final_hour']-$image_info['first_hour']))) . ' L ' . $image_info['width'] . ' ' . ($image_info['y_offset']+30+(40*($image_info['final_hour']-$image_info['first_hour']))) . '" stroke="black" stroke-width="1" fill="none" stroke-opacity="1" />';

//activities
for ($i = 0; $i < count($days); $i++) {
	$result = mysql_query('select begin, end, note, area, style, id, style, style_id from v_schedules where day = \'' . $days[$i] . '\';', $qcon);
	while ($row = mysql_fetch_array($result)) {
		echo '
<a xlink:href="/stilart/' . $row['style_id'] . '/' . str_replace(' ', '_', $row['style']) . '">
<rect z-index="200" x="'. ($image_info['first_day_x_offset'] + (($i * $image_info['day_space'])-10 + ($row['area']=='Dojo 1'?-17:17))) . '" y="' . 
		($image_info['y_offset']+30+40*(date('H', strtotime($row['begin']))-$image_info['first_hour'])+10*(floor(date('i', strtotime($row['begin']))/15)))
		. '" width="20" height="' .
		(10*(ceil((date('i', strtotime($row['end']))-date('i', strtotime($row['begin']))+
		(60*(date('H', strtotime($row['end']))-date('H', strtotime($row['begin'])))))/15)))
		. '" stroke="none" fill-opacity="0.75" fill="' . nameToColor($row['style']) . '" /></a>
';
	}
}

//First we draw the i's
for ($i = 0; $i < count($days); $i++) {
	$result = mysql_query('select begin, end, note, area, style, id, style, style_id from v_schedules where day = \'' . $days[$i] . '\';', $qcon);
	while ($row = mysql_fetch_array($result)) {
	//if there is a note on the activity we draw an i and a hidden text to display
		if($row['note'] != null){
			echo '
<image id="info_for_' . $row['id'] . '" xlink:href="/images/info2.png" x="'. ($image_info['first_day_x_offset'] - 8  + (($i * $image_info['day_space']) + ($row['area']=='Dojo 1'?-17:17))) . '" y="' . 
			($image_info['y_offset']+43-11+40*(date('H', strtotime($row['begin']))-$image_info['first_hour'])+10*(floor(date('i', strtotime($row['begin']))/15)))
			. '" width="16px" height="16px" />' . PHP_EOL;
		}
	}
}

//then we draw the actual notes
for ($i = 0; $i < count($days); $i++) {
	$result = mysql_query('select begin, end, note, area, style, id, style, style_id from v_schedules where day = \'' . $days[$i] . '\';', $qcon);
	while ($row = mysql_fetch_array($result)) {
		//if there is a note on the activity we draw an i and a hidden text to display
		if($row['note'] != null){
			drawNote($row['note'], $row['id'], $row['begin'], $row['area'], $i);
		}
	}
}

function drawNote($note, $id, $begin, $area, $iteration) {
	global $image_info;
	echo '
<text visibility="visible" opacity="0" fill="none" stroke="white" stroke-width="4" font-family="helvetica" z-index="556" x=0 y=0 font-size="15" ' . 
			'text-anchor="' . ((($image_info['first_day_x_offset'] + (($iteration * $image_info['day_space']) + ($area=='Dojo 1'?-17:17)))<($image_info['width']/2))?'start':'end') . '" >' . $note . '
				<animate begin="info_for_' . $id . '.mouseover" attributeType="CSS" attributeName="opacity" from="0" to="0.8" dur="300ms" fill="freeze" />
				<animate begin="info_for_' . $id . '.mouseout" attributeType="CSS" attributeName="opacity" from="0.8" to="0" dur="1s" fill="freeze" />
				<set attributeName="x" to="'. ($image_info['first_day_x_offset'] + (($iteration * $image_info['day_space']) + ($area=='Dojo 1'?-17:17))
+((($image_info['first_day_x_offset'] + (($iteration * $image_info['day_space']) + ($area=='Dojo 1'?-17:17)))<($image_info['width']/2))?14:-14)) . '" begin="info_for_' . $id . '.mouseover" fill="freeze" />
				<set attributeName="y" to="' .	($image_info['y_offset']+43+40*(date('H', strtotime($begin))-$image_info['first_hour'])+10*(floor(date('i', strtotime($begin))/15)))
			. '" begin="info_for_' . $id . '.mouseover" fill="freeze" />
				<set attributeName="x" to="0" begin="info_for_' . $id . '.mouseout" fill="freeze" />
				<set attributeName="y" to="0" begin="info_for_' . $id . '.mouseout" fill="freeze" />
				

			</text>
<text visibility="visible" opacity="0" fill="black" font-family="helvetica" z-index="560" x=0 y=0 font-size="15" ' . 
			'text-anchor="' . ((($image_info['first_day_x_offset'] + (($iteration * $image_info['day_space']) + ($area=='Dojo 1'?-17:17)))<($image_info['width']/2))?'start':'end') . '" >' . $note . '
				<animate begin="info_for_' . $id . '.mouseover" attributeType="CSS" attributeName="opacity" from="0" to="1" dur="300ms" fill="freeze" />
				<animate begin="info_for_' . $id . '.mouseout" attributeType="CSS" attributeName="opacity" from="1" to="0" dur="1s" fill="freeze" />
				<set attributeName="x" to="'. ($image_info['first_day_x_offset'] + (($iteration * $image_info['day_space']) + ($area=='Dojo 1'?-17:17))
+((($image_info['first_day_x_offset'] + (($iteration * $image_info['day_space']) + ($area=='Dojo 1'?-17:17)))<($image_info['width']/2))?14:-14)) . '" begin="info_for_' . $id . '.mouseover" fill="freeze" />
				<set attributeName="y" to="' .	($image_info['y_offset']+43+40*(date('H', strtotime($begin))-$image_info['first_hour'])+10*(floor(date('i', strtotime($begin))/15)))
			. '" begin="info_for_' . $id . '.mouseover" fill="freeze" />
				<set attributeName="x" to="0" begin="info_for_' . $id . '.mouseout" fill="freeze" />
				<set attributeName="y" to="0" begin="info_for_' . $id . '.mouseout" fill="freeze" />
				

			</text>';
}

//legend in upper left hand corner
for ($i = 0; $i < mysql_num_rows($active_styles); $i++) {
	$row = mysql_fetch_array($active_styles);
	echo '
<a xlink:href="/stilart.php?id=' . $row['id'] . '"><rect x="0" y="' . ($i*20) . '" width="20" height="20" fill-opacity="0.75" stroke="none" fill="' . nameToColor($row['name']) . '"/>' . PHP_EOL;
	echo '<text x="22" y="' . (($i+1)*20-5) . '" font-family="helvetica" font-size="10" >' . $row['name'] . '</text></a>' . PHP_EOL;
}

//EOF
echo '</svg>';
?>