<?php
function printRefs() {
	$refs = array();
	if ($handle = opendir('referater')) {
		while (false !== ($file = readdir($handle))) {
			//110609_referat_nkc.pdf
			$file = utf8_encode($file);
			if (preg_match("/^[0-9]{6}_[a-zæøå]+\.pdf/i", $file)) {
				$refs[] = $file;
			}
		}
		closedir($handle);
	}
	sort($refs, SORT_STRING);
	$refs = array_reverse($refs);

	$months = array("Januar", "Februar", "Marts", "April", "Maj", "Juni", "Juli", "August", "September", "Oktober", "Movember", "December");


	foreach($refs as $refname){
		
		preg_match("/^([0-9]{2})([0-9]{2})([0-9]{2})_([a-zæøå]+)\.pdf/i", $refname, $matches);
		$meetingstring;

		if (preg_match("/best/i",$matches[4]) == 1){
			$meetingstring = "Bestyrelsesmøde";
		}elseif (preg_match("/general/i",$matches[4]) == 1){
			$meetingstring = "Generalforsamling";
		}elseif (preg_match("/instru/i",$matches[4]) == 1){
			$meetingstring = "Instruktørmøde";
		}else {
			$meetingstring = $matches[4];
		}

		echo '<li><a href="/referater/' . $refname . '">' . $meetingstring . ' ' . (ltrim($matches[3], '0')==''?'':'d. ' . ltrim($matches[3], '0') . '. ') . $months[ltrim($matches[2], '0') - 1] . ' 20' . $matches[1] . '</a></li>' . PHP_EOL;

	}

}

?>

