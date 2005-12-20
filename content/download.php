<h1>Downloads</h1>
<p>Use these links to find the download section for each game/server etc.</p>
<ul class="menubar">
<li><a href="#games">Games</a></li>
<li><a href="#server">Server</a></li>
<li><a href="#CVS">CVS</a></li>
</ul>
<p>Make sure you have the required dependencies before downloading files.</p>

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

  /* echo '<a name="engine"></a><h1>Client engine</h1>';
   echo 'If you are developing you own game, or if you want to compile Arianne, grab the following files.';

  renderDownloads("client"); <- arianne XP removed at least for now*/ 
?>

<a name="CVS"></a><h1>CVS</h1>
If you need to grab the latest copy of Arianne and you can't wait for a release, use CVS.<p>
<a href="http://cvs.sourceforge.net/viewcvs.py/arianne/">http://cvs.sourceforge.net/viewcvs.py/arianne/</a>
