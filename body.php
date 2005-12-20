<?php

$arianne_url="content/news";

if(isset($_REQUEST["arianne_url"]))
  {
  global $arianne_url;
  
  $arianne_url=$_REQUEST["arianne_url"];
  
  if(!strpos(".",$arianne_url)===false or strpos("/",$arianne_url)==1)
    {    
    $arianne_url="content/news";
    } 
  } 


  // build side menu
  ?>
      <div id="left_menu">
      
   
      <ul>
        <li class="menu_title"><div id="game-menu-image">Games</div></li>
            <?php
            include_once("renderContent.php");
            renderGameBriefing(false);     
            ?>
        <li><p class="footer"><i>(Add your game here!)</i></p></li>
      </ul>

      <ul>
        <li class="menu_title"><div id="pw-menu-image">Powered By...</div>
        </li>
        <li><a href="http://sourceforge.net/projects/arianne"><IMG SRC="http://sourceforge.net/sflogo.php?group_id=1111&amp;type=1" ALT="SourceForge Logo"></a>
        </li>
        <li><a href="http://www.java.com"><IMG SRC="images/partners/get_java_green_button.gif" ALT="Java Logo" ></a>
        </li>
        <li><a href="http://www.libSDL.org"><IMG SRC="images/partners/SDLPowered.gif" ALT="SDL Logo"></a>
        </li>
        <li><a href="http://www.mysql.com"><IMG SRC="images/partners/MySQLPowered.gif" ALT="MySQL Logo"></a>
        </li>
        <li><a href="http://www.pygame.org"><IMG SRC="images/partners/pygamePowered.gif" ALT="pygame Logo"></a>
        </li>
        <li><a href="http://www.python.org"><IMG SRC="images/partners/PythonPoweredSmall.gif" ALT="Python Logo"></a>
      </ul>
      <ul>      
        <li class="menu_title"><div id="rate-menu-image">Rate Us</div>
        </li>
            
        <li><a href="http://happypenguin.org/show?Arianne+RPG"><img src="http://happypenguin.org/rateomatic?Arianne+RPG" alt="Happy Penguin Rate"></a>
        </li>
      </ul>
      
      
      </div>

  
  
<?php

echo '<div id="pagecontent">';
include($arianne_url.".php"); 
echo '</div>';

 
?>