<?php
class Download extends Page {

	public function writeHtmlHeader() {
		if (!isset($_REQUEST["show_archive"])) {
			echo '<title>Downloads'.ARIANNE_TITLE.'</title>';
		} else {
			echo '<title>Downloads (including old games)'.ARIANNE_TITLE.'</title>';
		}
		echo '<meta name="robots" content="noindex">';
	}

	public function writeContent() {
?>
<h1>Downloads</h1>
<p>Use these links to find the download section for each game etc.</p>
<ul class="menubar">
<li><a href="#games">Games</a></li>
<li><a href="#engine">Engine</a></li>
<li><a href="#tool">Tool</a></li>
<li><a href="#CVS">CVS</a></li>
</ul>
<p>Make sure you have the required dependencies before downloading files.</p>

<p>
<a href="/download-all.html">(Show Archived Games Too...)</a></p>

<a name="games"></a><h1>Games</h1>
<b>NOTE:</b>To play an arianne game you need to create an account for it. Get more info at each game page.
<?php
	renderDownloads("game");
?>

<a name="engine"></a><h1>Engine</h1>
If you want to create your own Arianne game you need to download Marauroa.
<?php
	renderDownloads("engine");

  /* echo '<a name="engine"></a><h1>Client engine</h1>';
   echo 'If you are developing your own game, or if you want to compile Arianne, grab the following files.';

  renderDownloads("client"); <- arianne XP removed at least for now*/ 
?>
<a name="tool"></a><h1>Tools</h1>
Tools downloads
<?php renderDownloads("tool"); ?>


<a name="CVS"></a><h1>CVS</h1>
If you need to grab the latest copy of Arianne and you can't wait for a release, you can use CVS.<p>

You can use a CVS client to <a href="http://sourceforge.net/scm/?type=cvs&group_id=1111">download our source code</a> 
or you can browse the <a href="http://arianne.cvs.sourceforge.net/arianne">web-based CVS repository</a>

<?php
	}
}
$page = new Download();