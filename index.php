<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd"> 
<html>
  <head>
    <LINK REL="SHORTCUT ICON" HREF="http://arianne.game-server.cc/favicon.ico">
    <META HTTP-EQUIV="Content-Type" CONTENT="text/html; charset=UTF-8">
    <meta name="keywords" content="arianne, java, python, jython, multiplayer, play, online, game, engine, framework, content creation, C, portable, free, open source, gpl, MySQL, documentation, design">
    <meta name="description" content="Arianne is a multiplayer online games framework and engine to develop turn based and real time games. It provides a simple way of creating games on a portable and robust server architecture. The server is coded in Java and uses Python for your game description, provides a MySQL backend and uses an UDP transport channel to communicate with dozens of players.">
    <title>Arianne - A Multiplayer Online Role Playing Framework to develop games - </title>
<?php
include_once('xml.php');

$page_url="content/news";

if(isset($_REQUEST["arianne_url"]))
  {
  
  $page_url=$_REQUEST["arianne_url"];
  
  if(!strpos(".",$page_url)===false or strpos("/",$page_url)==1)
    {    
    $page_url="content/news";
    } 
  }

$name =  substr($page_url,strpos($page_url,"/")+1, strlen($page_url));
if( file_exists('xml/'.$name.'.xml' ) )
  {
	$content=implode("",file('xml/'.$name.'.xml'));
	$xml = XML_unserialize($content);
	
	if( $xml['game'][0]['cssdoc']['0 attr']['url'] != "" )
	{
	 echo '<link rel="stylesheet" type="text/css" href="'.$xml['game'][0]['cssdoc']['0 attr']['url'].'">'; 
	} else
	{
		echo '<link rel="stylesheet" type="text/css" href="css/cssdef.css">';
	} 
  }
else
  {
	  echo '<link rel="stylesheet" type="text/css" href="css/cssdef.css">';
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
