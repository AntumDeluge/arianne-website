<?php


function WriteNewsHTML($website, $all) {
	$maxNewsItems=5;

	echo '<ul class="newslist">';

	foreach ($website['website'][0]['item'] as $key=>$item) {
		if ($maxNewsItems==0) {
			break;
		}
		if (!$all) {
			$maxNewsItems--;
		}
		WriteNewsItemHtml($item);
	}

	echo '</ul>';
}


function WriteNewsHTMLHeaderForFirstItem($website, $title) {
	foreach ($website['website'][0]['item'] as $key=>$item) {
		if ($title == getNiceURL($item['title'][0])) {
			echo '<title>'.$item['title'][0].ARIANNE_TITLE.'</title>'."\r\n";
			// meta title is for facebook
			echo '<meta name="title" content="'.$item['title'][0].'">'."\r\n";
			$description = trim($item['content'][0]);
			$pos = strpos($description, '<p>', 10);
			if ($pos) {
				$description = substr($description, 0, $pos);
			}
			$description = preg_replace('/(\r\n|\r|\n|")/s',' ', preg_replace('/<[^>]*>/', '', $description));
			echo '<meta name="description" content="'.$description.'">'."\r\n";

			if (isset($item['images'])) {
				foreach ($item['images'][0]['image'] as $key=>$image) {
					if (is_array($image)) {
						echo '<link rel="image_src" href="http://arianne.sourceforge.net/'.$image['url'].'">';
						return;
					}
				}
			}

			break;
		}
	}
}


function WriteNewsHTMLForNamedItem($website, $title) {
	echo '<ul class="newslist">';

	foreach ($website['website'][0]['item'] as $key=>$item) {
		if ($title == getNiceURL($item['title'][0])) {
			WriteNewsItemHtml($item);
		}
	}

	echo '</ul>';
}

function WriteNewsItemHtml($item)
{
	$strippedTitle = getNiceURL($item['title'][0]);
	echo '<li class="clearright"><div class="newsitem"><div class="newstitle">'
	.'<h2 style="padding:0; margin:0; margin-top:1em; font-weight: bold"><a class="newsitemtitle" href="/news/'.$strippedTitle.'.html">'.$item['title'][0].'</a></h2>'
	.'</div><p class="itemdate">'.$item['date'][0].'</p>';

	if (isset($item['images'])) {

		foreach ($item['images'][0]['image'] as $key=>$image) {
			if (is_array($image)) {
				echo '<img class="news_image" src="/'.$image['url'].'" alt="Game screenshot">'."\r\n";
			}
		}
		if (isset($item['playnow'])) {
			echo '<a href="'.$item['playnow']['0 attr']['url'].'" style="display:block;float:right;width:250px;height:42;clear:right">';
			echo '<img style="margin-right:40px; width:170px; height:42" class="news_image" src="/'.$item['playnow']['0 attr']['image'].'"></a>'."\r\n";
		}
		echo '<div class="newscontent_image">'.$item['content'][0].'</div>';
		echo '</div>';
	} else {
		echo '<div class="newscontent_noimage">'.$item['content'][0].'</div></div>';
	}
	// the sharing buttons should go here
	echo '<div id="social_buttons">';
	$urlToPost = 'http://arianne.sourceforge.net/news/'.$strippedTitle.'.htm';
	// echo buildTweetButton($urlToPost, '@stendhalgame');
	// echo buildFacebookButton($item['title'][0], $urlToPost);
	// echo buildGoogleBuzzButton($urlToPost);
	echo '</div>';
	echo '</li>';
}


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