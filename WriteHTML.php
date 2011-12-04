<?php

function GameUpdateTime($game) {
	return $game['page'][0]['updated']['0 attr']['date'];
}


/**
 * gets a nice url
 *
 * @return nice url
 */
function getNiceURL($title) {
	$res = strtolower($title);
	$res = preg_replace('/[ _,;.:<>|!?\'"()\/*] /', ' ', $res);
	$res = preg_replace('/[ _,;.:<>|!?\'"()\/*]/', '-', $res);
	return urlencode($res);
}


function imageResize($width, $height, $target) {
	//takes the larger size of the width and height and applies the formula accordingly...this is so this script will work dynamically with any size image

	if ($width > $height) {
		$percentage = ($target / $width);
	} else {
		$percentage = ($target / $height);
	}

	//gets the new value and applies the percentage, then rounds the value
	$width = round($width * $percentage);
	$height = round($height * $percentage);

	//returns the new sizes in html image tag format...this is so you can plug this function inside an image tag and just get the
	return "width=\"$width\" height=\"$height\"";
}

// Create the list of games on the Games page
function WriteGamePageListHTML($game) {
	if (($game['page'][0]['status']['0 attr']['value'] === 'archived')) {
		$showarchive=0;
		if (isset($_REQUEST["show_archive"])) {
			$showarchive=$_REQUEST["show_archive"];
		}
		if ($showarchive == 1) {
			echo '<li><a href="#'.$game['page']['0 attr']['name'].'">'.ucfirst($game['page']['0 attr']['name']).'</a></li>';
		}
	} else {
		echo '<li><a href="#'.$game['page']['0 attr']['name'].'">'.ucfirst($game['page']['0 attr']['name']).'</a></li>';
	}
}


function WriteShortGameDesc($game) {
	$type = $game['page'][0]['type']['0 attr']['value'];
	echo '<li class="text">';
	echo '<a href="/'.$type.'/'.$game['page']['0 attr']['name'].'.html" class="naviLight">'.ucfirst($game['page']['0 attr']['name']).'</a>';
	$time=explode("-",GameUpdateTime($game));
	if (time()-mktime(0,0,0,$time[1],$time[2],$time[0])<30*24*60*60) {
		echo '<img src="/images/updated.gif" class="update_image" alt="Recently Updated">';
	}
	echo '</li>';
	echo '<li>';
	if (isset($game['page'][0]['screenshots'])) {
		foreach ($game['page'][0]['screenshots'] as $key=>$image) {
			if (is_array($image)) {
				$image_size = getimagesize(dirname(__FILE__).'/screens/'.$game['page']['0 attr']['name'].'/THM_'.$image['image']['0 attr']['name']);
				$html_size = imageResize($image_size[0], $image_size[1], 130);

				echo '<a href="/'.$type.'/'.$game['page']['0 attr']['name'].'.html"><img src="/screens/'.$game['page']['0 attr']['name'].'/THM_'.$image['image']['0 attr']['name'].'" alt="Screenshot" '.$html_size.'></a>';
			}
		}
	} else {
		echo '&nbsp;';
	}
	echo '</li>';
}


function WriteLongGameDesc($game) {
	$type = $game['page'][0]['type']['0 attr']['value'];

	echo '<div class="game_entry">';

	echo '<div class="link_title"><a name="'.$game['page']['0 attr']['name'].'"></a><h1><a href="/'.$type.'/'.$game['page']['0 attr']['name'].'.html">'.ucfirst($game['page']['0 attr']['name']).'</a></h1><p><a href="/'.$type.'/'.$game['page']['0 attr']['name'].'.html">Click here to see information about this package</a></p></div>';
	echo '<h2>'.$game['page']['0 attr']['shortdescription'].'</h2>';

	$time=explode("-",GameUpdateTime($game));
	if (time()-mktime(0,0,0,$time[1],$time[2],$time[0])<30*24*60*60) {
		echo '<img src="/images/updated.gif" class="update_image" alt="Recently Updated!">';
	}
	WriteGameStatusTag($game);

	if (isset($game['page'][0]['screenshots'])) {
		foreach ($game['page'][0]['screenshots'] as $key=>$image) {
			if (is_array($image)) {
				$image_size = getimagesize(dirname(__FILE__).'/screens/'.$game['page']['0 attr']['name'].'/THM_'.$image['image']['0 attr']['name']);
				$html_size = imageResize($image_size[0], $image_size[1], 120);

				echo '<a href="/'.$type.'/'.$game['page']['0 attr']['name'].'.html"><img src="/screens/'.$game['page']['0 attr']['name'].'/THM_'.$image['image']['0 attr']['name'].'" alt="Screenshot" '.$html_size.'></a>';
			}
		}
	}
	echo '<p>'.$game['page'][0]['description'][0].'</p>';
	echo '<p><a href="/'.$type.'/'.$game['page']['0 attr']['name'].'.html">'.ucfirst($game['page']['0 attr']['name']).' - Click here to see information about this package</a></p>';

	echo '</div>';
}


function WriteGameBriefingHTML($game,$long_briefing) {
	if ($long_briefing) {
		if (($game['page'][0]['status']['0 attr']['value'] === 'archived')) {
			$showarchive=0;
			if (isset($_REQUEST["show_archive"])) {
				$showarchive=$_REQUEST["show_archive"];
			}
			if ($showarchive == 1) {
				WriteLongGameDesc($game);
			}
		} else {
			WriteLongGameDesc($game);
		}

	} else {
		if (($game['page'][0]['status']['0 attr']['value'] === 'archived')) {
			$showarchive=0;
			if (isset($_REQUEST["show_archive"])) {
				$showarchive=$_REQUEST["show_archive"];
			}
			if ($showarchive == 1) {
				WriteShortGameDesc($game);
			}
		} else {
			WriteShortGameDesc($game);
		}
	}
}


function WriteGameStatusTag($game,$length=false) {
	if ($game['page'][0]['status']) {
		echo '<div class="statustag">';
		$type = $game['page'][0]['type']['0 attr']['value'];
		if ($length) {
			switch($game['page'][0]['status']['0 attr']['value']) {
			case "broken":
				echo '<p>This '.$type.' is marked as BROKEN. This implies it does not work with the current server version and is therefore unsupported. We are working towards restoring the broken '.$type.'s. Sorry for any inconvenience.</p>';
				break;
			case "beta":
				echo '<p>This '.$type.' is marked as BETA. This implies it is still under construction and may contain bugs or be feature incomplete, <b>however</b> it may still be playable so please have a go!</p>';
				break;
			case "alpha":
				echo '<p>This '.$type.' is marked as ALPHA. This implies it is still in early days of construction and will possibly not be playable. Please join us and help complete it!</p>';
				break;
			case "stable":
				echo '<p>This '.$type.' is marked as STABLE. Have Fun! :)</p>';
				break;
			case "complete":
				echo '<p>This '.$type.' is marked as COMPLETE. Have Fun! :)</p>';
				break;
			case "archived":
				echo '<p>This '.$type.' is marked as ARCHIVED. It has probably been dropped and is not supported anymore.</p>';
				break;
			}
		} else {
			switch($game['page'][0]['status']['0 attr']['value']) {
				case "broken":
					echo '<p>This '.$type.' is marked as BROKEN. </p>';
					break;
				case "beta":
					echo '<p>This '.$type.' is marked as BETA.</p>';
					break;
				case "stable":
					echo '<p>This '.$type.' is marked as STABLE.</p>';
					break;
				case "alpha":
					echo '<p>This '.$type.' is marked as ALPHA.</p>';
					break;
				case "complete":
					echo '<p>This '.$type.' is marked as COMPLETE.</p>';
					break;
				case "archived":
					echo '<p>This '.$type.' is marked as ARCHIVED.</p>';
					break;
			}
		}
		echo '</div>';
	}
}


function WriteLinkDownloadHTML($xml, $type) {
	if (($xml['page'][0]['status']['0 attr']['value'] === 'archived')) {
		$showarchive=0;
		if (isset($_REQUEST["show_archive"])) {
			$showarchive=$_REQUEST["show_archive"];
		}
		if ($showarchive == 1) {
			WriteDownloadLink($xml, $type);
		}
	} else {
		WriteDownloadLink($xml, $type);
	}
}


function WriteDownloadLink($xml, $type) {

	echo '<div class="downloadpagesection"><h2>'.ucfirst($xml[$type]['0 attr']['name']).'</h2>';

	if (isset($xml['page'][0]['screenshots'])) {
		foreach ($xml['page'][0]['screenshots'] as $key=>$image) {
			if (is_array($image)) {
				$image_size = getimagesize(dirname(__FILE__).'/screens/'.$xml['page']['0 attr']['name'].'/THM_'.$image['image']['0 attr']['name']);
				$html_size = imageResize($image_size[0], $image_size[1], 130);
				echo '<a href="/'.$type.'/'.$xml['page']['0 attr']['name'].'.html#downloadsection"><img src="/screens/'.$xml['page']['0 attr']['name'].'/THM_'.$image['image']['0 attr']['name'].'" alt="Screenshot" '.$html_size.'></a>';
			}
		}
	} else {
		echo '<a href="/'.$type.'/'.$xml[$type]['0 attr']['name'].'.html#downloadsection"><img src="/images/oneszeros.png" alt=ones zeros"></a>';
	}

	if ($type === 'game') {
		echo '<p class="linktodownload"><a href="/game/'.$xml['page']['0 attr']['name'].'.html#downloadsection">Click here to go to this games download links</a></p>';
	} else if ($type === 'server') {
		echo '<p class="linktodownload"><a href="/engine/'.$xml['page']['0 attr']['name'].'.html#downloadsection">Click here to go to the engine download links</a></p>';
	} else if ($type === 'client') {
		echo '<p class="linktodownload"><a href="/client/'.$xml['page']['0 attr']['name'].'.html#downloadsection">Click here to go to this clients download links</a></p>';
	} else if ($type === 'tool') {
		echo '<p class="linktodownload"><a href="/tool/'.$xml['page']['0 attr']['name'].'.html#downloadsection">Click here to go to this tools download links</a></p>';
	}

	echo '</div>';
}


function WriteDownloadHTML($game, $base, $section=false) {

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


function WriteChangeLogHTML($game,$base) {
	if (isset($game['page'][0]['changelog'])) {
		echo '<div class="section"><h2>Change Log</h2>';
		echo $game['page'][0]['changelog'][0];
		echo '</div>';
	}
}


function WriteGameHTML($game,$base) {
	echo '<h1>'.ucfirst($game['page']['0 attr']['name']).'</h1>';
	echo '<p>&copy; 2005-2011 (See Authors list). Released under GNU/GPL license.</p>';

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

	echo '<div id="game_topimage"></div>';

	if (isset($game['page'][0]['rated'])) {
		echo '<div class="rategame"><p>Rate us at:</p> ';
		foreach ($game['page'][0]['rated'][0]['entry'] as $tag=>$rated) {
			echo $rated;
		}
		echo '</div>';
	}

	echo '<div class="game_description"><a name="about"></a><h2>What is '.$game['page']['0 attr']['name'].'?</h2>'.$game['page'][0]['description'][0];
	if (isset($game['page'][0]['extended'])) {
		echo $game['page'][0]['extended'][0];
	}

	echo '</div>';

	if (isset($game['page'][0]['manual'])) {
		echo '<div class="game_manual"><a name="manual"></a><h2>Manual</h2>You can read '.$game['page']['0 attr']['name'].'\'s manual <a href="'.$game['page'][0]['manual']['0 attr']['url'].'">here</a>';
		echo '</div>';
	}

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

	echo '<div class="game_downloads"><a name="downloads"></a>';
	WriteDownloadHTML($game, $base, true);
	echo '</div>';

	if (isset($game['page'][0]['changelog'])) {
		echo '<div class="game_changelog"><a name="changes"></a>';
		WriteChangeLogHTML($game,$base);
		echo '</div>';
	}

	echo '<div class="game_authors"><a name="authors"></a><h2>Authors</h2><p>'.$game['page']['0 attr']['name'].' has been developed by:</p><ul>';
	foreach ($game['page'][0]['authors'][0]['entry'] as $author) {
		if (is_array($author)) {
			echo '<li><a href="'.$author['url'].'">'.$author['name'].'</a></li>';
		}
	}
	echo '</ul></div>';
}


function WriteScreenshotsHTML($game, $base, $archived=false) {
	// load shots from dir by name
	// line up thumbnails
	if (!$archived) {
		echo '<div class="screenshots_entry"><div class="link_title"><h2><a name="'.$game['page']['0 attr']['name'].'" href="/'.$base.'/'.$game['page']['0 attr']['name'].'.html">'.ucfirst($game['page']['0 attr']['name']).'</a></h2><p><a href="/'.$base.'/'.$game['page']['0 attr']['name'].'.html">Click here to see information about this package</a></p></div>';
		$val = "screens/".$game['page']['0 attr']['name'];
	} else {
		echo '<div class="screenshots_entry"><div class="link_title"><h2>Archived</h2></div>';
		$val = "screens/archived";
	}
	$scan  = array();
	$files = array();

	if ((($archived==TRUE) and $val=="screens/archived") or
	(($archived==FALSE) and $val!="screens/archived") and
	($val!="screens/CVS")) {
		$scan = scan_dir($val);
		$files = $scan['files'];

		$ab = 0;

		$i=0;
		echo '<ul>';
		foreach ($files as $key => $THMfilename) {
			if (!$archived) {
				if ($i > 3) {
					break;
				}
			}

			$pos = strpos($THMfilename,"THM_");
			if ($pos===false) {
				//$ab = 0;
			} else {
				$filename1 = substr($THMfilename, 0, $pos);
				$filename2 = substr($THMfilename, $pos+4, strlen($THMfilename));
				$year = substr($THMfilename, $pos+4 , 4);
				$month = substr($THMfilename, $pos+8, 2);
				$day = substr($THMfilename, $pos+10, 2);

				// Scale correctly to don't deform the image
				$image_size = getimagesize(dirname(__FILE__).'/'.$THMfilename);
				$html_size = imageResize($image_size[0], $image_size[1], 150);

				echo "<li class=\"thumbnail\"><a href=\"$filename1$filename2\"><img src=\"/$THMfilename\"  alt=\"Screenshot\">";
				echo "</a></li>";
				$ab++;
				$i++;
			}
		}

		echo "</ul>";

		if ($archived) {
			echo "<p class=\"archive\"><a href=\"/screenshots.html\">Click here to see all the new images!</a></p>";
		} else {
			echo "<p class=\"archive\"><a href=\"/screenshots-archived.html\">Click here to see all the old images!</a></p>";
		}
	}

	echo '<div class="clearright">&nbsp;</div></div>';
}

//******************************************************
// This functions was named list_dir by whoever
// originally wrote it.
// if this is your code. Thanks for the start.
//*******************************************************

function scan_dir($dirname,$recurse=FALSE,$sort_flag=SORT_REGULAR)
{
	if ($dirname[strlen($dirname)-1]!='/') {
		$dirname.='/';
	}

	$file_array=array();
	$dir_array=array();
	$ret_array=array();

	$handle=opendir($dirname);
	while (false !== ($file = readdir($handle))) {
		if ($file=='.'||$file=='..') {
			continue;
		}
		if (strpos($file, '~')!==false) {
			continue;
		}
		if (is_dir($dirname.$file)) {
			$dir_array[]=$dirname.$file;
			if ($recurse) {
				scan_dir($dirname.$file.'/',$recurse);
			}
		} else {
			$file_array[]=$dirname.$file;
		}
	}
	closedir($handle);

	sort($file_array,$sort_flag);
	$file_array=array_reverse($file_array);

	for ($i=0;$i<count($file_array);$i++) {
		for ($j=$i;$j<count($file_array);$j++) {
			if (filemtime($file_array[$j])>filemtime($file_array[$i])) {
				$tmp=$file_array[$j];
				$file_array[$j]=$file_array[$i];
				$file_array[$i]=$tmp;
			}
		}
	}
	sort($dir_array,$sort_flag);
	reset($file_array);
	reset($dir_array);

	$ret_array['files']=$file_array;
	$ret_array['directories']=$dir_array;

	return $ret_array;
}
