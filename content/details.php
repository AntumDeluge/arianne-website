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

		WriteGameStatusTag($game,true);

			// screenshots
		if (isset($game['page'][0]['screenshots'])) {
			echo '<div class="game_screens"><ul class="screenshots">';
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

		// right column

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
		$this->writeDownloadSection($game);
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
		echo '<div class="game_authors"><a name="authors"></a><h2>Authors</h2><p>'.ucfirst($game['page']['0 attr']['name']).' has been developed by:</p><p>';
		$first = true;
		foreach ($game['page'][0]['authors'][0]['entry'] as $author) {
			if (is_array($author)) {
				if ($first) {
					$first = false;
				} else {
					echo ', ';
				}
				echo '<a href="'.$author['url'].'">'.$author['name'].'</a>';
			}
		}
		echo '</p>&copy; 2005-2011. Released under <a href="/docs/gpl-2.0.html">GNU General Public License</a>.</p></div>';
	}
	
	
	
	function writeDownloadSection($game) {
	
		echo '<h2>Download</h2><div class="download"><a name="downloadsection"></a>';
	
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
	
			echo '</li>';
		}
		echo '</ul>';
	
		//echo '</div>';
		echo '<div class="clearright">&nbsp;</div></div>';
	}
	
}
$page = new DetailPage();
