<?php 
include_once('renderXML.php'); 
$name='xml/game_'.substr(strstr($_REQUEST["arianne_url"],"game_"),5).'.xml';
renderGameXML($name); ?>