<?php 
include_once('writeHTML.php'); 
$name='xml/server_'.substr(strstr($_REQUEST["arianne_url"],"server_"),7).'.xml';
$content=implode("",file($name));
$xml = simplexml_load_string($content);

WriteGameHTML($xml);
?>