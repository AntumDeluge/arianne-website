<?php
include_once('xml.php');
define('ARIANNE_TITLE', ' &ndash; The Arianne Project');
$page_url="content/news";

/**
 * Scan the name module to load and reset it to safe default if something strange appears.
 *
 * @param string $url The name of the module to load without .php
 * @return string the name of the module to load.
 */
function decidePageToLoad($url) {
  $ERROR="content/news";

  if(strpos($url,"/")===0) {
    return $ERROR;
  }

  if(strpos($url,"\0")!==false) {
    return $ERROR;
  }

  if(strpos($url,".")!==false) {
    return $ERROR;
  }
  
  if(strpos($url,"//")!==false) {
    return $ERROR;
  }
  
  if(strpos($url,":")!==false) { // http://, https://, ftp://
    return $ERROR;
  }
  
  if(strpos($url,"/")==0) {
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
include($page_url.".php"); 
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd"> 
<html>
  <head>
    <LINK REL="SHORTCUT ICON" HREF="/favicon.ico">
    <META HTTP-EQUIV="Content-Type" CONTENT="text/html; charset=UTF-8">
<?php
$page->writeHtmlHeader();

$name = substr($page_url,strpos($page_url,"/")+1, strlen($page_url));
if( file_exists('xml/'.$name.'.xml')) {
	$content=implode("",file('xml/'.$name.'.xml'));
	$xml = XML_unserialize($content);

	if( $xml['game'][0]['cssdoc']['0 attr']['url'] != "") {
 		echo '<link rel="stylesheet" type="text/css" href="/'.$xml['game'][0]['cssdoc']['0 attr']['url'].'">'; 
	} else {
		echo '<link rel="stylesheet" type="text/css" href="/css/cssdef.css">';
	}
} else {
  echo '<link rel="stylesheet" type="text/css" href="/css/cssdef.css">';
}
?>

</head>

<body>
<?php
$starttime = explode(' ', microtime());
$starttime = $starttime[1] + $starttime[0];
?>
<div id="main_contain">  
  <div id="pageheader"><?php include("header.php"); ?></div>
  <div id="pagemain"><?php include("body.php"); ?></div>
  <div id="pagefooter"><?php include("footer.php"); ?></div>
</div>
</body>
</html>
