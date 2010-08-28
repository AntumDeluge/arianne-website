<?php

$page_url="content/news";

if(isset($_REQUEST["arianne_url"]))
  {  
  $page_url=decidePageToLoad($_REQUEST["arianne_url"]);
  }

  // build side menu
  ?>
      <div id="left_menu">
      
   
      <ul>
        <li class="menu_title"><div id="game-menu-image">Games</div></li>
            <?php
            include_once("renderContent.php");
            renderGameBriefing(false, game);     
            ?>
        <li><p><i>(Add your game here!)</i></p></li>
      </ul>

      <ul>
        <li class="menu_title"><div id="game-menu-image">Tools</div></li>
            <?php
	include_once("renderContent.php");
        renderGameBriefing(false,tool);
            ?>
       <li><p><i>(Add your tool here!)</i></p></li>
      </ul>


      <ul>
        <li class="menu_title"><div id="pw-menu-image">Powered By...</div>
        </li>
        <li><a href="http://sourceforge.net/projects/arianne"><IMG SRC="http://sourceforge.net/sflogo.php?group_id=1111&amp;type=1" ALT="SourceForge Logo"></a>
        </li>
        <li><a href="http://www.java.com"><IMG SRC="/images/partners/get_java_green_button.gif" ALT="Java Logo" ></a>
        </li>
<!--        <li><a href="http://www.libSDL.org"><IMG SRC="/images/partners/SDLPowered.gif" ALT="SDL Logo"></a>
        </li>-->
        <li><a href="http://www.mysql.com"><IMG SRC="/images/partners/MySQLPowered.gif" ALT="MySQL Logo"></a>
        </li>
<!--        <li><a href="http://www.pygame.org"><IMG SRC="/images/partners/pygamePowered.gif" ALT="pygame Logo"></a>
        </li>
        <li><a href="http://www.python.org"><IMG SRC="/images/partners/PythonPoweredSmall.gif" ALT="Python Logo"></a>-->
      </ul>
      <ul>      
        <li class="menu_title"><div id="rate-menu-image">Rate Us</div>
        </li>
       <li><a href="http://sourceforge.net/projects/arianne/reviews/"><IMG SRC="http://sourceforge.net/sflogo.php?group_id=1111&amp;type=1" ALT="SourceForge Logo"></a>
        <li><a href="http://happypenguin.org/show?Stendhal"><img src="http://happypenguin.org/rateomatic?Stendhal" alt="Happy Penguin Rate"></a>
        </li>
      </ul>
      
      
      </div>

  
  
<?php

echo '<div id="pagecontent">';
include($page_url.".php"); 
echo '</div>';

 
?>
