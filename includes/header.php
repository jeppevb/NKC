<?php 
include_once 'dbqueryconfig.php';

function show_menu() {

	global $qcon; 
	
	echo '		<ul id="nav">' . PHP_EOL;
	echo '			<li><a href="omnordjyskkampsportscenter.php">Om Nordjysk' . PHP_EOL;
	echo '					Kampsportscenter</a>' . PHP_EOL;
	echo '				<ul>' . PHP_EOL;
	echo '					<li><a href="bestyrelse.php">Bestyrelse</a>' . PHP_EOL;
	echo '					</li>' . PHP_EOL;
	echo '					<li><a href="faciliteter.php">Faciliteter</a>' . PHP_EOL;
	echo '					</li>' . PHP_EOL;
	echo '					<li><a href="herfinderduos.php">Her finder du os</a>' . PHP_EOL;
	echo '					</li>' . PHP_EOL;
	echo '					<li><a href="historie.php">Historie</a>' . PHP_EOL;
	echo '					</li>' . PHP_EOL;
	echo '					<li><a href="instruktoerer.php">Instruktører</a>' . PHP_EOL;
	echo '					</li>' . PHP_EOL;
	echo '					<li><a href="referater.php">Referater</a>' . PHP_EOL;
	echo '					</li>' . PHP_EOL;
	echo '				</ul></li>' . PHP_EOL;
	echo '			<li><a href="stilart.php">Aktiviteter</a>' . PHP_EOL;
	echo '				<ul>' . PHP_EOL;
					$result = mysql_query('SELECT name, id FROM styles', $qcon);
					while ($row = mysql_fetch_array($result)) {
						echo '					<li><a href="stilart.php?id=' . $row['id'] . '">' . $row['name'] . '</a>' . PHP_EOL;
						echo '					</li>' . PHP_EOL;
					}
	echo '				</ul></li>' . PHP_EOL;
	echo '			<li><a href="tider.php">Tider</a>' . PHP_EOL;
	echo '			</li>' . PHP_EOL;
	echo '			<li><a href="kalender.php">Kalender</a>' . PHP_EOL;
	echo '			</li>' . PHP_EOL;
	echo '			<li><a href="indmeldelse.php">Indmeldelse</a>' . PHP_EOL;
	echo '			</li>' . PHP_EOL;
	echo '			<li><a href="kontakt.php">Kontakt</a>' . PHP_EOL;
	echo '			</li>' . PHP_EOL;
	echo '			<li><a href="nyhedsindex.php">Nyheder</a>' . PHP_EOL;
	echo '			</li>' . PHP_EOL;
	echo '		</ul>' . PHP_EOL;
}

function show_topbanner() {
echo '		<span><img alt="Nkclogo" src="images/nkclogo.png" />' . PHP_EOL;
echo '		</span> <span><img alt="Aikido" src="images/aikido.png" />' . PHP_EOL;
echo '		</span> <span><img alt="Fairtex" src="images/fairtex2.png" />' . PHP_EOL;
echo '		</span> <span><img alt="Muay" src="images/muay.png" />' . PHP_EOL;
echo '		</span> <span><img alt="Jj" src="images/jj.png" />' . PHP_EOL;
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
