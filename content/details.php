<?php 
class DetailPage extends Page {

	public function writeContent() {
		$name = $_REQUEST['name'];
		if (!checkFilenameParameter($name)) {
			// TODO: error message, return 404
			return;
		}
		$temp = explode("/", $name);
		
		$content=implode("", file('xml/'.$temp[0].'_'.$temp[1].'.xml'));
		$xml = XML_unserialize($content);

		WriteGameHTML($xml, $temp[0]);
	}
}
$page = new DetailPage();
