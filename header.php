
  <div id="title_section">
  <a href="/"><img src="images/arianneLogo.jpg" alt="Arianne logo" class="left"></a>
  <img src="images/gnuLogo.jpg" alt="GNU Logo" class="right">
  <p>an open source multiplayer online framework to easily create games!</p>
  </div>

    <div id="menubarcontainer">
    <div id="topmenubar">
     <ul class="menubar">
               <?php 
            include_once('WriteHTML.php');
            
            $content=implode("",file('xml/website_menu.xml'));
            $xml = XML_unserialize($content);
            WriteMenuHTML($xml);      
          ?>
     </ul>
     </div>
     </div>

