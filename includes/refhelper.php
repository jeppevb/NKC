<?php 
function printRefs() {
	$refs = array();
	if ($handle = opendir('/ref')) {
		while (false !== ($file = readdir($handle))) {
			//110609_referat_nkc.pdf
			if (preg_match("/^[0-9]{6}_[a-z]+\.pdf/i", $file)) {
				$refs[] = $file;
			}
		}
		closedir($handle);
	}
	sort($refs, SORT_STRING);
	$refs = array_reverse($refs);
	
	echo '' . PHP_EOL;
}

?>

