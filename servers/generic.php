<?php 
class Generic extends Page {

	public function writeContent() {
		$name='xml/server_'.substr(strstr(decidePageToLoad($_REQUEST["arianne_url"]), "server_"), 7).'.xml';
		$content=implode("",file($name));
		$xml = XML_unserialize($content);

		WriteGameHTML($xml,"server");
	}
}
$page = new Generic();
?>