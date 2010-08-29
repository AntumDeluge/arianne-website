<?php
class Tutorial extends Page {
	public function writeHtmlHeader() {
		echo '<title>How to write games using Arianne'.ARIANNE_TITLE.'</title>';
		
	}
	
	public function writeContent() {
		echo 'This webpage has been moved to <a href="http://stendhalgame.org/wiki/HowToWriteGamesUsingArianne">'
		. 'http://stendhalgame.org/wiki/HowToWriteGamesUsingArianne</a>.';
	}
}
$page = new Tutorial();