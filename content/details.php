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
			$this->writeDetails($this->xml, 'page');
		} else {
			echo 'Unfortunately this page does not exist.';
			echo '<!-- '.htmlspecialchars($_REQUEST['name']).'-->';
		}
	}

	
	function writeDetails($game, $base) {
		echo '<h1>'.ucfirst($game['page']['0 attr']['name']).'</h1>';
		echo '<p>&copy; 2005-2011 (See Authors list). Released under GNU-GPL license.</p>';

		// in page navigation
		echo '<ul class="gamepagemenu">';
	
		echo '<li><a href="#about">About</a></li>';
		if (isset($game['page'][0]['manual'])) {
			echo '<li><a href="#manual">Manual</a></li>';
		} else if (isset($game['page'][0]['screenshots'])) {
			echo '<li><a href="#screens">Screenshots</a></li>';
		} else if (isset($game['page'][0]['servers'])) {
			echo '<li><a href="#servers">Servers</a></li>';
		}
		echo '<li><a href="#downloads">Downloads</a></li>';
		if (isset($game['page'][0]['changelog'])) {
			echo '<li><a href="#changes">ChangeLog</a></li>';
		}
		echo '<li><a href="#authors">Authors</a></li>';
		echo '</ul>';
	
		WriteGameStatusTag($game,true);

		// right column
		echo '<div id="game_topimage"></div>';
	
		if (isset($game['page'][0]['rated'])) {
			echo '<div class="rategame"><p>Rate us at:</p> ';
			foreach ($game['page'][0]['rated'][0]['entry'] as $tag=>$rated) {
				echo $rated;
			}
			echo '</div>';
		}

		// long description
		echo '<div class="game_description"><a name="about"></a><h2>What is '.$game['page']['0 attr']['name'].'?</h2>'.$game['page'][0]['description'][0];
		if (isset($game['page'][0]['extended'])) {
			echo $game['page'][0]['extended'][0];
		}
		echo '</div>';

		// manual
		if (isset($game['page'][0]['manual'])) {
			echo '<div class="game_manual"><a name="manual"></a><h2>Manual</h2>You can read '.$game['page']['0 attr']['name'].'\'s manual <a href="'.$game['page'][0]['manual']['0 attr']['url'].'">here</a>';
			echo '</div>';
		}

		// screenshots
		if (isset($game['page'][0]['screenshots'])) {
			echo '<div class="game_screens"><a name="screens"></a><h2>Screenshots</h2><ul class="screenshots">';
			$i = 0;
			foreach ($game['page'][0]['screenshots'][0]['image'] as $key=>$image) {
				if (is_array($image)) {
					echo '<li><a href="/screens/'.$game['page']['0 attr']['name'].'/'.$image['name'].'"><img src="/screens/'.$game['page']['0 attr']['name'].'/THM_'.$image['name'].'" alt="Game screenshot"></a></li>';
					$i++;
				}
				if ($i > 3) break;
			}
			echo '</ul></div>';
		}

		// game server links
		if (isset($game['page'][0]['servers'])) {
			echo '<div class="game_servers"><a name="servers"></a><h2>Online servers</h2>';
			echo $game['page']['0 attr']['name'].' is a online game, so you need to connect to a server in order to be able to play.</p>';
			echo '<p>Choose any of the followings and read the instructions there about how to get an account and connect:<ul>';
			foreach ($game['page'][0]['servers'][0]['server'] as $key=>$server) {
				if (is_array($server)) {
					echo '<li><a href="'.$server['url'].'">'.$server['name'].'</a></li>';
				}
			}
			echo '</ul></div>';
		}

		// downloads
		echo '<div class="game_downloads"><a name="downloads"></a>';
		$this->writeDownloadSection($game, true);
		echo '</div>';

		// change log
		if (isset($game['page'][0]['changelog'])) {
			echo '<div class="game_changelog"><a name="changes"></a>';
			if (isset($game['page'][0]['changelog'])) {
				echo '<div class="section"><h2>Change Log</h2>';
				echo $game['page'][0]['changelog'][0];
				echo '</div>';
			}
			echo '</div>';
		}

		// authors
		echo '<div class="game_authors"><a name="authors"></a><h2>Authors</h2><p>'.$game['page']['0 attr']['name'].' has been developed by:</p><ul>';
		foreach ($game['page'][0]['authors'][0]['entry'] as $author) {
			if (is_array($author)) {
				echo '<li><a href="'.$author['url'].'">'.$author['name'].'</a></li>';
			}
		}
		echo '</ul></div>';
	}
	
	
	
	function writeDownloadSection($game, $section=false) {
	
		// section specifies if this is being called from download page or from games page
		if ($section === false) {
			echo '<div class="downloads"><div class="link_title"><h2><a href="/game/'.$game['page']['0 attr']['name'].'.html">'.ucfirst($game['page']['0 attr']['name']).'</a></h2><p><a href="/game/'.$game['page']['0 attr']['name'].'.html">Click here to see information about this package</a></p></div>';
		} else {
			echo '<h2>Download</h2><div class="download"><a name="downloadsection"></a>';
		}
	
		echo '<ul>';
		foreach (array_keys($game['page'][0]['files'][0]['file']) as $key) {
			if (strpos($key,"attr")!=FALSE) {
				continue;
			}
	
			$file=$game['page'][0]['files'][0]['file'][$key];
			foreach ($game['page'][0]['files'][0]['file'][$key.' attr'] as $akey=>$avalue) {
				$file[$akey]=$avalue;
			}
	
			$filename=str_replace("XXX",$game['page'][0]['version']['0 attr']['id'],$file['name']);
			if ($section === false) {
				echo '<li>';
			} else {
				echo '<li class="gamepage">';
			}
	
			echo '<div class="filedesc">'.$file['description'][0].'</div>';
			echo '<div class="releaseinfo">('.$file['type'].') released on '.$game['page'][0]['updated']['0 attr']['date'].'</div>';
			echo '<div class="link"><a href="http://prdownloads.sourceforge.net/arianne/'.$filename.'?download" class="download_file">'.$filename.'</a></div>';
	
			echo '<ul class="OS_images">';
	
			foreach ($file['os'][0]['entry'] as $key=>$worksOnOS) {
				if (is_array($worksOnOS)) {
					echo '<li><img src="/images/platforms/'.$worksOnOS['name'].'.png" alt="Operating System Logo"></li>';
				}
			}
			echo '</ul>';
			if (isset($file['dependencies'])) {
				echo '<div class="dependancies"><b>Dependencies</b>: (This file depends on)<ul>';
				foreach ($file['dependencies'][0]['entry'] as $key=>$dependsOn) {
					if (is_array($dependsOn)) {
						echo '<li><a href="'.$dependsOn['url'].'">'.$dependsOn['name'].'</a></li>';
					}
				}
				echo '</ul></div>';
			} else {
				echo ' ';
			}
			echo '<div class="clearright">&nbsp;</div></li>';
		}
		echo '</ul>';
	
		//echo '</div>';
		echo '<div class="clearright">&nbsp;</div></div>';
	}
	
}
$page = new DetailPage();
