<?php 
include_once('renderXML.php'); 
$name='xml/server_'.substr(strstr($_REQUEST["arianne_url"],"server_"),6).'.xml';
renderServerXML($name); ?>