<?php
class Screenshots extends Page {

	public function writeContent() {
?>
<h1>Screenshots</h1>

<p>Arianne is a game development system. These screenshots do not exactly represent what Arianne is, but rather are examples of games that 
have been created using Arianne and represent some of what Arianne can do. </p><p>However, please note that these games do not necessarily reflect the limits of Arianne. It would take an amazing game to show those!
</p><p>Some of these screenshots are taken from the developers versions accessible through CVS.</p><div id="clearright"></div>

<?php
		include_once("renderContent.php");
		$do_arch = true;
		if( !isset($_REQUEST['archived']) ) {
			renderGameList("game");
			$do_arch = false;
		}
		renderScreenshots("game", $do_arch);
	}
}

$page = new Screenshots();
