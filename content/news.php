<?php
#$all=isset($HTTP_GET_VARS['all']);
$all=isset($_REQUEST['all']);
$title = $_REQUEST['title'];

$content=implode("",file('xml/website_news.xml'));
$xml = XML_unserialize($content);
if (isset($title)) {
  WriteNewsHTMLForNamedItem($xml, $title);
} else {
  WriteNewsHTML($xml, $all);
}
?>
<p><a href="?arianne_url=content/news&amp;all=100">Read all the news items</a></p>
