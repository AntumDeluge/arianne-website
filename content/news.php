<?php
class News extends Page {

	public function writeContent() {
		$all = isset($_REQUEST['all']) || (isset($_REQUEST['title']) && $_REQUEST['title'] == 'all');
		$title = $_REQUEST['title'];

		$content = implode("",file('xml/website_news.xml'));
		$xml = XML_unserialize($content);

		if (!$all && isset($title)) {
			WriteNewsHTMLForNamedItem($xml, $title);
			echo '<p><a href="/">Read recent news items</a></p>';
		} else {
			WriteNewsHTML($xml, $all);
			echo '<p><a href="/news/all.html">Read all the news items</a></p>';
		}
	}
}

$page = new News();