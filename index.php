<?php
require_once('xml.php');
require_once("WriteHTML.php");
require_once("renderContent.php");
require_once("page.php");
require_once("share_buttons.php");

//header('X-Frame-Options: sameorigin');
header("X-Content-Security-Policy: default-src 'self'; img-src 'self' data: stendhalgame.org arianne.sf.net arianne.sourceforge.net sflogo.sourceforge.net sourceforge.net");


define('ARIANNE_TITLE', ' &ndash; The Arianne Project');

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
include($page_url.".php");

if ($page->writeHttpHeader()) {
	header('Content-Type: text/html; charset=utf-8')



?><!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
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
				<a href="/">
					<span class="left-title-image"></span>
					<span class="right-title-image"></span>
				</a>
				<p>Arianne is an open source multiplayer online framework to easily create games!</p>
			</div>

			<div id="menubarcontainer">
				<a href="/">News</a>
				<a href="/about.html">About</a>
				<a href="/game/stendhal.html">Stendhal</a>
				<a href="/game/jmapacman.html">jMacPacman</a>
				<a href="/engine/marauroa.html">Marauroa</a>
				<a href="/tool/marboard.html">Marboard</a>
				<a href="/contact.html">Contact</a>
				<div class="clear"></div>
			</div>


		</div>
		<div id="pagemain">
			<div id="left_menu">
				<?php renderSideBarNavigationTop(); ?>

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
			echo '<div style="clear:both"></div>';
			echo '</div>';
			?>
		</div>
	</div>
</body>
</html>

<?php
}