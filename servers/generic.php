<?php 

$name='xml/server_'.substr(strstr($_REQUEST["arianne_url"],"server_"),7).'.xml';
$content=implode("",file($name));
$xml = XML_unserialize($content);

WriteGameHTML($xml,"server");
?>