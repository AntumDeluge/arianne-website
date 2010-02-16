<?php 

$name='xml/tool_'.substr(strstr(decidePageToLoad($_REQUEST["arianne_url"]), "tool_"), 5).'.xml';
$content=implode("",file($name));
$xml = XML_unserialize($content);

WriteGameHTML($xml,"tool");
?>