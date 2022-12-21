<?php
class Tutorial extends Page {
	public function writeHtmlHeader() {
		echo '<title>How to write games using Arianne'.ARIANNE_TITLE.'</title>';

	}

	public function writeContent() {
		echo 'This webpage has been moved to <a href="https://stendhalgame.org/wiki/HowToWriteGamesUsingArianne">'
		. 'https://stendhalgame.org/wiki/HowToWriteGamesUsingArianne</a>.';
	}
}
$page = new Tutorial();
