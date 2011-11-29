<?php
$starttime = explode(' ', microtime());
$starttime = $starttime[1] + $starttime[0];

include_once('xml.php');
define('ARIANNE_TITLE', ' &ndash; The Arianne Project');
$page_url="content/news";

/**
 * checks a file name parameter to prevent directory traversing or remote includes
 * 
 * @param string $filename
 */
function checkFilenameParameter($filename) {
	if(strpos($url,"/")===0) {
		return false;
	}
	if(strpos($url,"\0")!==false) {
		return false;
	}
	
	if(strpos($url,".")!==false) {
		return false;
	}
	
	if(strpos($url,"//")!==false) {
		return false;
	}
	
	if(strpos($url,":")!==false) {
		// http://, https://, ftp://
		return false;
	}
	
	return true;
}

/**
 * Scan the name module to load and reset it to safe default if something strange appears.
 *
 * @param string $url The name of the module to load without .php
 * @return string the name of the module to load.
 */
function decidePageToLoad($url) {
	$ERROR = "content/news";

	if (!checkFilenameParameter($url)) {
		return $ERROR;
	}

	if(strpos($url.'.php',".php")===false) {
		return $ERROR;
	}

	if(!file_exists($url.'.php')) {
		return $ERROR;
	}

	return $url;
}

$page_url="content/news";
if(isset($_REQUEST["arianne_url"])) {
	$page_url=decidePageToLoad($_REQUEST["arianne_url"]);
}
include 'page.php';
include_once('WriteHTML.php');
include($page_url.".php");

if ($page->writeHttpHeader()) {
	header('Content-Type: text/html; charset=utf-8')
?>



<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<LINK REL="SHORTCUT ICON" HREF="/favicon.ico">
<META HTTP-EQUIV="Content-Type" CONTENT="text/html; charset=UTF-8">
<?php
	echo '<link rel="stylesheet" type="text/css" href="/css/cssdef.css">';
	$page->writeHtmlHeader();
?>

</head>

<body>


	<div id="main_contain">
		<div id="pageheader">
			<div id="title_section">
				<span class="left-title-image"></span> <a href="/"><span
					class="right-title-image"></span> </a>
				<p>an open source multiplayer online framework to easily create games!</p>
			</div>

			<div id="menubarcontainer">
				<div id="topmenubar">
					<ul class="menubar">
					<?php
					$content=implode("",file('xml/website_menu.xml'));
					$xml = XML_unserialize($content);
					WriteMenuHTML($xml);
					?>
					</ul>
				</div>
			</div>



		</div>
		<div id="pagemain">
			<div id="left_menu">
				<ul>
					<li class="menu_title"><div id="game-menu-image">Games</div></li>
					<?php
						include_once("renderContent.php");
						renderGameBriefing(false, game);
					?>
					<li><p><i>(Add your game here!)</i></p></li>
				</ul>
			
				<ul>
					<li class="menu_title"><div id="tool-menu-image">Tools</div></li>
						<?php
						include_once("renderContent.php");
						renderGameBriefing(false, tool);
						?>
					<li><p><i>(Add your tool here!)</i></p></li>
				</ul>
			
			
				<ul>
					<li class="menu_title"><div id="pw-menu-image">Powered By...</div></li>
					<li><a href="http://sourceforge.net/projects/arianne"><IMG SRC="http://sourceforge.net/sflogo.php?group_id=1111&amp;type=1" ALT="SourceForge Logo"></a></li>
					<li><a href="http://www.java.com"><IMG SRC="/images/partners/get_java_green_button.gif" ALT="Java Logo" ></a></li>
					<li><a href="http://www.mysql.com"><IMG SRC="/images/partners/MySQLPowered.gif" ALT="MySQL Logo"></a></li>
				</ul>
				<ul>
					<li class="menu_title"><div id="rate-menu-image">Rate Us</div></li>
					<li><a href="http://sourceforge.net/projects/arianne/reviews/"><IMG SRC="http://sourceforge.net/sflogo.php?group_id=1111&amp;type=1" ALT="SourceForge Logo"></a></li>
					<!-- <li><a href="http://happypenguin.org/show?Stendhal"><img src="http://happypenguin.org/rateomatic?Stendhal" alt="Happy Penguin Rate"></a></li>-->
				</ul>
			
			</div>
			
			<?php
			
			echo '<div id="pagecontent">';
			$page->writeContent();
			echo '</div>'; ?>
		</div>



		<div id="pagefooter">
			<p class="footer">
			&copy; 1999-2012 <a href="http://arianne.sourceforge.net" class="navi">Arianne RPG</a>
			<?php
			$mtime = explode(' ', microtime());
			$totaltime = $mtime[0] + $mtime[1] - $starttime;
			printf(' (Page loaded in %.3f seconds.)', $totaltime);
			?>
			</p>
			<div class="footerimages">
				<a href="http://sourceforge.net/projects/arianne">
					<IMG SRC="http://sourceforge.net/sflogo.php?group_id=1111&amp;type=1"
					ALT="SourceForge Logo" BORDER=0>
				</a>
				<a href="http://validator.w3.org/check?uri=referer">
					<img style="border: 0; width: 88px; height: 31px"
					src="http://www.w3.org/Icons/valid-html401" alt="Valid HTML 4.01!">
				</a>
				<a href="http://jigsaw.w3.org/css-validator/">
					<img style="border: 0; width: 88px; height: 31px"
					src="http://jigsaw.w3.org/css-validator/images/vcss" alt="Valid CSS!">
				</a>
			</div>
		</div>
	</div>
</body>
</html>

<?php
}