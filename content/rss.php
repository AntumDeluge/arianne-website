<?php
/*
 Stendhal website - a website to manage and ease playing of Stendhal game
 Copyright (C) 2010-2011 the Arianne Project

 This program is free software: you can redistribute it and/or modify
 it under the terms of the GNU Affero General Public License as published by
 the Free Software Foundation, either version 3 of the License, or
 (at your option) any later version.

 This program is distributed in the hope that it will be useful,
 but WITHOUT ANY WARRANTY; without even the implied warranty of
 MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 GNU Affero General Public License for more details.

 You should have received a copy of the GNU Affero General Public License
 along with this program.  If not, see <http://www.gnu.org/licenses/>.
 */


class RssPage extends Page {

	public function writeHttpHeader() {
		header('Content-Type: application/rss+xml', true);
		$this->writeRss();
		return false;
	}

	public function writeRss() {
		$this->writeHeader();
		$maxNewsItems = 20;
		$content = implode("",file('xml/website_news.xml'));
		$website = XML_unserialize($content);
		foreach($website['website'][0]['item'] as $key=>$item) {
			if ($maxNewsItems == 0) {
				break;
			}
			$maxNewsItems--;
			$this->writeEntry($item);
		}
		$this->writeFooter();
	}

	private function renderText($text) {
		return htmlspecialchars($text);
	}

	private function writeHeader() {
		echo '<?xml version="1.0" encoding="utf-8"?>';
?>
<rss version="2.0" xmlns:atom="http://www.w3.org/2005/Atom">
<channel>
	<title>Arianne News</title>
	<link>https://arianne-project.org</link>
	<description>A Multiplayer Online Role Playing Framework.</description>
	<language>en</language>
	<copyright>Arianne Project</copyright>
	<pubDate><?php echo date("D, d M Y H:i:s O");?></pubDate>
	<image>
		<url>https://arianne-project.org/favicon.png</url>
		<title>Arianne News</title>
		<link>https://arianne-project.org</link>
	</image>
	<atom:link href="https://arianne-project.org/rss/news.rss" rel="self" type="application/rss+xml" />
<?php
	}

	private function writeEntry($item) {
		// we do not escape admin input here on purpose.
		// only trusted administrators are allowed to add news and they should
		// be allowed to use full html.
		$strippedTitle = getNiceURL($item['title'][0]);
		echo '<item>';
			echo '<title>'.htmlspecialchars($item['title'][0]).'</title>';
			$content = $item['content'][0].'<p>';
			foreach($item['images'][0]['image'] as $key=>$image) {
				if(is_array($image)) {
					$content .= '<img class="news_image" src="/'.$image['url'].'" alt="Game screenshot">'."\r\n";
				}
			}
			echo '<description>'.$this->renderText(trim($content)).'</description>';
			echo '<link>https://arianne-project.org/news/'.$strippedTitle.'.html</link>';
			echo '<author>newsfeed@stendhalgame.org (Arianne Project)</author>';
			echo '<pubDate>'.date("D, d M Y H:i:s O", strtotime($item['date'][0])).'</pubDate>';
			echo '<category>Arianne Accounement</category>';
			echo '<guid>https://arianne-project.org/news/'.$strippedTitle.'.html</guid>';
		echo '</item>'."\r\n";
	}

	private function writeFooter() {
?>
</channel>
</rss>
<?php
	}
}

$page = new RssPage();
?>
