<?php

function cmp($a,$b) {
	if ($a == $b) {
		return 0;
	}
	return ($a > $b) ? -1 : 1;
}

function sortByDate($files) {
	$result=array();

	foreach ($files as $file) {
		$content=implode("",file($file));
		$xml = XML_unserialize($content);
		$result[GameUpdateTime($xml)]=$file;
	}

	usort($result,"cmp");
	return array_values($result);
}

/** 
 * This function renders the Download section related to games
 * $type should be "game_","server_" or "client_"
 */
function renderDownloads($type) {
	$gameList=array();
	$handle=opendir("xml/");

	while (false !== ($file = readdir($handle))) {
		if (strpos($file, '.') === 0) {
			continue;
		}
		if (strpos($file, '~')!==false) {
			continue;
		}
		if (!is_dir("xml/".$file))
		{
			if (strpos($file,$type.'_')!==false) {
				$gameList[]="xml/".$file;
			}
		}
	}
	closedir($handle);

	$gameList=sortByDate($gameList);

	foreach ($gameList as $file) {
		$content=implode("",file($file));
		$xml = XML_unserialize($content);
		WriteLinkDownloadHTML($xml,$type);
	}
}

function renderGameList($type) {
	$gameList=array();
	$handle=opendir("xml/");
	while (false !== ($file = readdir($handle))) {
		if (strpos($file, '.') === 0) {
			continue;
		}
		if (strpos($file, '~')!==false) {
			continue;
		}
		if (!is_dir("xml/".$file)) {
			if (strpos($file, $type.'_')!==false) {
				$gameList[]="xml/".$file;
			}
		}
	}
	closedir($handle);

	$gameList=sortByDate($gameList);

	echo '<div id="gamelist"><ul class="menubar">';

	foreach ($gameList as $file) {
		$content=implode("",file($file));
		$xml = XML_unserialize($content);
		WriteGamePageListHTML($xml);

	}

	echo '</ul></div>';
}

function renderSideBarNavigationTopEntry($type, $name, $updated) {
	echo '<li class="text">';
	echo '<a href="/'.$type.'/'.$name.'.html" class="naviLight">'.ucfirst($name).'</a>';
	if ($updated) {
		echo '<img src="/images/updated.gif" class="update_image" alt="Recently Updated">';
	}
	echo '</li><li>';
	echo '<a href="/'.$type.'/'.$name.'.html"><img src="/images/navigation/'.$name.'.png" alt="Screenshot"></a>';
	echo '</li>';
}

function renderSideBarNavigationTop() {
	echo '<ul><li class="menu_title"><div id="game-menu-image">Games</div></li>';
	renderSideBarNavigationTopEntry('game', 'stendhal', true);
	echo '</ul><ul><li class="menu_title"><div id="tool-menu-image">Tools</div></li>';
	renderSideBarNavigationTopEntry('tool', 'marboard', false);
	echo '</ul>';
}

function renderGameBriefing($long_briefing=TRUE, $type) {
	$gameList=array();
	$handle = opendir("xml/");

	while (false !== ($file = readdir($handle))) {
		if (strpos($file, '.') === 0) {
			continue;
		}
		if (strpos($file, '~') !== false) {
			continue;
		}
		if (!is_dir("xml/".$file)) {
			if (strpos($file,$type.'_') !== false) {
				$gameList[]="xml/".$file;
			}
		}
	}
	closedir($handle);

	$gameList=sortByDate($gameList);

	foreach ($gameList as $file) {
		$content=implode("",file($file));
		$xml = XML_unserialize($content);
		WriteGameBriefingHTML($xml,$long_briefing);
	}
}


function renderScreenshots($type, $archived=FALSE) {
	$gameList=array();
	$handle=opendir("xml/");

	while (false !== ($file = readdir($handle))) {
		if (strpos($file, '.') === 0) {
			continue;
		}
		if (strpos($file, '~') !== false) {
			continue;
		}
		if (!is_dir("xml/".$file)) {
			if (strpos($file,$type.'_')!==false) {
				$gameList[]="xml/".$file;
			}
		}
	}
	closedir($handle);

	$gameList=sortByDate($gameList);

	if (!$archived) {
		foreach ($gameList as $file) {
			$content=implode("",file($file));
			$xml = XML_unserialize($content);
			WriteScreenshotsHTML($xml,$type, $archived);
		}
	} else {
		WriteScreenshotsHTML(0,$type, $archived);
	}
}
