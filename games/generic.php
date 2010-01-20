<?php 

$name='xml/game_'.substr(strstr(decidePageToLoad($_REQUEST["arianne_url"]), "game_"), 5).'.xml';
$content=implode("",file($name));
$xml = XML_unserialize($content);

WriteGameHTML($xml,"game");
?>