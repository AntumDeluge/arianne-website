<?php
class News extends Page {
	private $all;
	private $title;
	private $xml;

	public function __construct() {
		$this->all = isset($_REQUEST['all']) || (isset($_REQUEST['title']) && $_REQUEST['title'] == 'all');
		$this->title = $_REQUEST['title'];
		$content = implode("",file('xml/website_news.xml'));
		$this->xml = XML_unserialize($content);
	}

	public function writeHtmlHeader() {
		if (!$this->all && isset($this->title)) {
			WriteNewsHTMLHeaderForFirstItem($this->xml, $this->title);
		} else {
			echo '<title>A Multiplayer Online Role Playing Framework to develop games'.ARIANNE_TITLE.'</title>';
			echo '<meta name="keywords" content="arianne, java, python, jython, multiplayer, play, online, game, engine, framework, content creation, C, portable, free, open source, gpl, MySQL, documentation, design">';
			echo '<meta name="description" content="Arianne is a multiplayer online games framework and engine to develop turn based and real time games. It provides a simple way of creating games on a portable and robust server architecture. The server is coded in Java and uses Python for your game description, provides a MySQL backend and uses an UDP transport channel to communicate with hundreds of players.">';
		}
		echo '<link rel="alternate" type="application/rss+xml" title="Arianne News" href="http://arianne.sourceforge.net/rss/news.rss" >'."\n";
	}

	public function writeContent() {
		if (!$this->all && isset($this->title)) {
			WriteNewsHTMLForNamedItem($this->xml, $this->title);
			echo '<p><a href="/">Read recent news items</a></p>';
		} else {
			WriteNewsHTML($this->xml, $this->all);
			echo '<p><a href="/news/all.html">Read all the news items</a></p>';
		}
	}
}

$page = new News();