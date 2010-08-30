
  <div id="title_section">
  <div class="left-title-image"></div>
  <a href="/"><div class="right-title-image"></div></a>
  <p>an open source multiplayer online framework to easily create games!</p>
  </div>

    <div id="menubarcontainer">
    <div id="topmenubar">
     <ul class="menubar">
               <?php 
            $content=implode("",file('xml/website_menu.xml'));
            $xml = XML_unserialize($content);
            WriteMenuHTML($xml);
          ?>
     </ul>
     </div>
     </div>

