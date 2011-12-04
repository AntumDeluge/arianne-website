<?php
class Games extends Page {

	public function writeHtmlHeader() {
		if (!isset($_REQUEST["show_archive"])) {
			echo '<title>Games using Arianne'.ARIANNE_TITLE.'</title>';
		} else {
			echo '<title>Games using Arianne (including old games)'.ARIANNE_TITLE.'</title>';
		}
	}

	public function writeContent() {
?>
<h2>Games</h2>
<p>Arianne is a framework, an engine to create online multiplayer games.<br>

So here are the games! <a href="/games-all.html">(Show Archived Games Too...)</a></p>
<?php
		// Render game list and then games
		renderGameList('game');
		renderGameBriefing(TRUE, 'game');
	}
}
$page = new Games();
?>
