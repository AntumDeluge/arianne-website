<h1>Downloads</h1>
<p>The Arianne framework is built up of several components: </p>
<ul class="menubar">
<li><a href="#games">Games</a></li>
<li><a href="#engine">Client Engine</a></li>
<li><a href="#server">Server</a></li>
</ul>
<p>Make sure you have the required dependencies before downloading files.</p>
<p>In order to play you only need the games binary package and an Internet connection!</p>
<b>For Change Logs please visits each package's home page by clicking on the section title.</p>
<hr>

<a name="games"></a><h1>Games</h1>
<b>NOTE:</b>To play an arianne game you need to create an account for it. Get more info at each game page.
<?php
  include_once("renderContent.php");
  renderDownloads("game");
?>

<a name="server"></a><h1>Server</h1>
If you want to run your own Arianne server you need to download Marauroa.
<?php
  renderDownloads("server");
?>

<a name="engine"></a><h1>Client engine</h1>
If you are developing you own game, or if you want to compile Arianne, grab the following files.
<?php
  renderDownloads("client");
?>

<a name="CVS"></a><h1>CVS</h1>
If you need to grab the latest copy of Arianne and you can't wait for a release use CVS.<p>
<a href="http://cvs.sourceforge.net/viewcvs.py/arianne/">http://cvs.sourceforge.net/viewcvs.py/arianne/</a>
