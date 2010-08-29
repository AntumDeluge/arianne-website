<?php 
class Generic extends Page {

	public function writeContent() {
		$name='xml/tool_'.substr(strstr(decidePageToLoad($_REQUEST["arianne_url"]), "tool_"), 5).'.xml';
		$content=implode("",file($name));
		$xml = XML_unserialize($content);

		WriteGameHTML($xml, "game");
	}
}
$page = new Generic();
?>