<?php 
include_once 'dbqueryconfig.php';

header("Cache-Control: no-cache, must-revalidate"); // HTTP/1.1
header("Expires: Sat, 26 Jul 1997 05:00:00 GMT"); // Date in the past

function cache_control_headers() {
	
}


function show_menu() {

	global $qcon; 
	
	echo '		<ul id="nav">' . PHP_EOL;
	echo '			<li><a href="/omnordjyskkampsportscenter">Om Nordjysk' . PHP_EOL;
	echo '					Kampsportscenter</a>' . PHP_EOL;
	echo '				<ul>' . PHP_EOL;
	echo '					<li><a href="/bestyrelse">Bestyrelse</a>' . PHP_EOL;
	echo '					</li>' . PHP_EOL;
	echo '					<li><a href="/faciliteter">Faciliteter</a>' . PHP_EOL;
	echo '					</li>' . PHP_EOL;
	echo '					<li><a href="/herfinderduos">Her finder du os</a>' . PHP_EOL;
	echo '					</li>' . PHP_EOL;
	echo '					<li><a href="/historie">Historie</a>' . PHP_EOL;
	echo '					</li>' . PHP_EOL;
	echo '					<li><a href="/instruktoerer">Instruktører</a>' . PHP_EOL;
	echo '					</li>' . PHP_EOL;
	echo '					<li><a href="/referater">Referater</a>' . PHP_EOL;
	echo '					</li>' . PHP_EOL;
	echo '				</ul></li>' . PHP_EOL;
	echo '			<li><a href="/stilart">Aktiviteter</a>' . PHP_EOL;
	echo '				<ul>' . PHP_EOL;
					$result = mysql_query('SELECT name, id FROM styles', $qcon);
					while ($row = mysql_fetch_array($result)) {
						echo '					<li><a href="/stilart/' . $row['id'] . '/' . str_replace(' ', '_', $row['name']) . '">' . $row['name'] . '</a>' . PHP_EOL;
						echo '					</li>' . PHP_EOL;
					}
	echo '				</ul></li>' . PHP_EOL;
	echo '			<li><a href="/tider">Tider</a>' . PHP_EOL;
	echo '			</li>' . PHP_EOL;
	echo '			<li><a href="/kalender">Kalender</a>' . PHP_EOL;
	echo '			</li>' . PHP_EOL;
	echo '			<li><a href="/indmeldelse">Indmeldelse</a>' . PHP_EOL;
	echo '			</li>' . PHP_EOL;
	echo '			<li><a href="/kontakt">Kontakt</a>' . PHP_EOL;
	echo '			</li>' . PHP_EOL;
	echo '			<li><a href="/nyheder">Nyheder</a>' . PHP_EOL;
	echo '			</li>' . PHP_EOL;
	echo '			<li><a href="/foto">Foto</a>' . PHP_EOL;
	echo '			</li>' . PHP_EOL;
	echo '		</ul>' . PHP_EOL;
}

function show_topbanner() {
echo '		<span><img alt="Nkclogo" src="/billeder/nkclogo.png" />' . PHP_EOL;
echo '		</span> <span><img alt="Aikido" src="/billeder/aikido.png" />' . PHP_EOL;
echo '		</span> <span><img alt="Fairtex" src="/billeder/fairtex2.png" />' . PHP_EOL;
echo '		</span> <span><img alt="Muay" src="/billeder/muay.png" />' . PHP_EOL;
echo '		</span> <span><img alt="Jj" src="/billeder/jj.png" />' . PHP_EOL;
echo '		</span>' . PHP_EOL;
}

function analytics_js() {
echo '	<!-- Google Analytics BEGIN -->' . PHP_EOL;
echo '	<script type="text/javascript">' . PHP_EOL;
echo '	var gaJsHost = (("https:" == document.location.protocol) ? "https://ssl." : "http://www.");' . PHP_EOL;
echo '	document.write(unescape("%3Cscript src=\'" + gaJsHost + "google-analytics.com/ga.js\' type=\'text/javascript\'%3E%3C/script%3E"));' . PHP_EOL;
echo '	</script>' . PHP_EOL;
echo '	<script type="text/javascript">' . PHP_EOL;
echo '	var pageTracker = _gat._getTracker("UA-5356812-1"); pageTracker._trackPageview();' . PHP_EOL;
echo '	</script>' . PHP_EOL;
echo '	<!-- Google Analytics END -->' . PHP_EOL;
}



?>
