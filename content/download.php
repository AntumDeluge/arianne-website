<p/>The Arianne framework is build of several components: <a href="#engine">client engine</a>, <a href="#server">server</a> and <a href="#games">games</a>.<br/>
Make sure you have the requiered dependencies before downloading files.
<p/>

<a name="games"></a><p><h1>Games</h1>
Arianne has several games available, download all them and enjoy!.<br>
<b>NOTE:</b>To play an arianne game you need to create an account for it. Get more info at each game page.
<?php
  include_once("renderXML.php");
  renderGameDownloadsXML();
?>

<a name="server"></a><p><h1>Server</h1>
If you want to run your own Arianne server you need to download Marauroa.
<?php
  include_once("renderXML.php");
  renderServerDownloadsXML();
?>

<a name="engine"></a><p><h1>Client engine</h1>
If you are developing you own game, or if you want to compile Arianne, grab the following files.
<?php
  include_once("renderXML.php");
  renderClientDownloadsXML();
?>

<a name="CVS"></a><p><h1>CVS</h1>
If you need to grab the latest copy of Arianne and you can't wait for a release use CVS.<p>
<a href="http://sourceforge.net/tracker/index.php?group_id=1111&atid=101111">http://sourceforge.net/tracker/index.php?group_id=1111&atid=101111</a>
