<h2>Game download</h2>
The Arianne framework is build of several components: client engine, server and games.<p>

<p><h1>Games</h1>
Arianne has several games available, download all them and enjoy!.<br>
<b>NOTE:</b>To play an arianne game you need to create an account for it.
<?php
  include_once("renderXML.php");
  renderGameDownloadsXML();
?>

<p><h1>Server</h1>
If you want to run your own Arianne server you need to download Marauroa.
<?php
  include_once("renderXML.php");
  renderServerDownloadsXML();
?>

<p><h1>Client engine</h1>
If you are developing you own game, or if you want to compile Arianne, grab the following files.
<?php
  include_once("renderXML.php");
  renderClientDownloadsXML();
?>
