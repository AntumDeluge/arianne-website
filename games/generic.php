<?php 
include_once('writeHTML.php'); 
$name='xml/game_'.substr(strstr($_REQUEST["arianne_url"],"game_"),5).'.xml';
$content=implode("",file($name));
$xml = simplexml_load_string($content);

WriteGameHTML($xml);
?>