<?php
/**
 * renders the detail page of a subproject
 *
 * @author hendrik
 */
class DetailPage extends Page {
	private $category;
	private $xml;

	/**
	 * checks the inputs and loads the xml definition
	 */
	public function __construct() {

		// read and validate parameters
		$name = $_REQUEST['name'];
		if (!checkFilenameParameter($name)) {
			return;
		}

		// create file name name and check existence
		$temp = explode("/", $name);
		$filename = 'xml/'.$temp[0].'_'.$temp[1].'.xml';
		if (!file_exists($filename)) {
			return;
		}

		// load xml file
		$this->category = $temp[0];
		$content=implode("", file($filename));
		$this->xml = XML_unserialize($content);
	}

	/**
	 * sends a 404 status code on non existing files
	 */
	public function writeHttpHeader() {
		if (!isset($this->xml)) {
			header('HTTP/1.1 404 Not found');
		}
		return true;
	}

	public function writeHtmlHeader() {
		if (isset($this->xml['page']) && isset($this->xml['page'][0]['cssdoc']) && ($this->xml['page'][0]['cssdoc']['0 attr']['url'] != "")) {
			echo '<link rel="stylesheet" type="text/css" href="/'.$this->xml['page'][0]['cssdoc']['0 attr']['url'].'">';
		}
	}

	/**
	 * writes the content of the sub project page
	 */
	public function writeContent() {
		if (isset($this->xml)) {
			WriteGameHTML($this->xml, 'page');
		} else {
			echo 'Unfortunately this page does not exist.';
			echo '<!-- '.htmlspecialchars($_REQUEST['name']).'-->';
		}
	}
}
$page = new DetailPage();
