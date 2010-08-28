<h2>Games</h2>
<p>Arianne is a framework, an engine to create online multiplayer games.<br>

So here are the games! <a href="/games-all.html">(Show Archived Games Too...)</a></p>
<?php
  // Render game list and then games
  include_once("renderContent.php");
  
  renderGameList(game);

renderGameBriefing(TRUE,game);     
?>
