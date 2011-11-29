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

	/**
	 * writes the content of the sub project page
	 */
	public function writeContent() {
		if (isset($this->xml)) {
			WriteGameHTML($this->xml, $this->category);
		} else {
			echo 'Unfortunately this page does not exist.';
		}
	}
}
$page = new DetailPage();
