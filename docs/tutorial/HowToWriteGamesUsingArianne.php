<?php
class Tutorial extends Page {

	public function writeContent() {
		echo 'This webpage has been moved to <a href="http://stendhalgame.org/wiki/HowToWriteGamesUsingArianne">'
		. 'http://stendhalgame.org/wiki/HowToWriteGamesUsingArianne</a>.';
	}
}
$page = new Tutorial();