<h2>Games</h2>
<p>Arianne is a framework, an engine to create online multiplayer games.<p/>
So here are the games! :) <a href="?show_archive=1&arianne_url=content/games">(Show Archived Games Too...)</a></p>
<?php
  // Render game list and then games
  include_once("renderContent.php");
  
  renderGameList();

  renderGameBriefing(TRUE);     
?>
