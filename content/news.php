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
						$url = $image['url'];
						/*
						// large images are hard to see on discord
						if (isset($image['large'])) {
							$url = $image['large'];
						}*/
						echo '<link rel="image_src" href="/'.$url.'">';
						echo '<meta property="og:image" content="/'.$url.'">';
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

function WriteNewsItemHtml($item) {
	$strippedTitle = getNiceURL($item['title'][0]);
	echo '<li class="clearright"><div class="newsitem"><div class="newstitle">'
	.'<h2 class="newsitemtitle"><a class="newsitemtitle" name="'.$strippedTitle.'" href="/news/'.$strippedTitle.'.html">'.$item['title'][0].'</a></h2>'
	.'</div><p class="itemdate">'.$item['date'][0].'</p>';

	if (isset($item['images']) || isset($item['playnow'])) {
		if (isset($item['images'])) {
			if (is_array($item['images'][0])) {
				foreach ($item['images'][0]['image'] as $key=>$image) {
					if (is_array($image)) {
						echo '<img class="news_image" src="/'.$image['url'].'" alt="Game screenshot">'."\r\n";
					}
				}
			}
		}
		if (isset($item['playnow'])) {
			echo '<a href="'.$item['playnow']['0 attr']['url'].'" class="playnow">';
			echo '<img class="news_image playnow" src="/'.$item['playnow']['0 attr']['image'].'" alt="" title="Play now"></a>'."\r\n";
		}
		echo '<div class="newscontent_image">'.$item['content'][0].'</div>';
		echo '</div>';
	} else {
		echo '<div class="newscontent_noimage">'.$item['content'][0].'</div></div>';
	}
	// the sharing buttons should go here
	echo '<div class="social_buttons">';
	$urlToPost = 'https://arianne-project.org/news/'.$strippedTitle.'.htm';
	// echo buildTweetButton($urlToPost, '@stendhalgame');
	// echo buildFacebookButton($item['title'][0], $urlToPost);
	echo '</div>';
	echo '</li>';
}


class News extends Page {
	private $all;
	private $title;
	private $xml;

	public function __construct() {
		$this->all = isset($_REQUEST['all']) || (isset($_REQUEST['title']) && $_REQUEST['title'] == 'all');
		if (isset($_REQUEST['title'])) {
			$this->title = $_REQUEST['title'];
		}
		$content = implode("",file('xml/website_news.xml'));
		$this->xml = XML_unserialize($content);
	}

	public function writeHtmlHeader() {
		if (!$this->all && isset($this->title)) {
			WriteNewsHTMLHeaderForFirstItem($this->xml, $this->title);
		} else {
			echo '<title>A Multiplayer Online Role Playing Framework to develop games'.ARIANNE_TITLE.'</title>';
			echo '<meta name="keywords" content="arianne, java, python, jython, multiplayer, play, online, game, engine, framework, content creation, free, open source, gpl, MySQL, documentation, design, MMORPG">';
			echo '<meta name="description" content="Arianne is a multiplayer online games framework and engine to develop turn based and real time games. It provides a simple way of creating games on a portable and robust server architecture. The server is coded in Java and you may use Python for your game description, provides a MySQL or H2 database backend and uses an TCP transport channel to communicate with hundreds of players.">';
		}
		echo '<link rel="alternate" type="application/rss+xml" title="Arianne News" href="https://arianne-project.org/rss/news.rss" >'."\n";
	}

	public function writeContent() {
		echo '<a href="https://arianne-project.org/rss/news.rss" class="rss"><img src="/images/buttons/feed-icon-28x28.webp" width="28px" height="28px" alt="" title="News Feed" class="borderless"></a>';
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
