<table>
  <tr valign="top">
    <td width="15%">
      <font color="#FFFFFF">
      <table width="100%" bgcolor="#1B2193" STYLE="border: 2px dotted #000000;" valign="top">        
        <tr>
          <td width="10%"/>
            <td align="center" width="80%"><img src="images/gameLogo.gif"/></td>
            <td width="10%"/>
        </tr>
        <tr>
          <td/>
          <td align="center">
            <?php
              $all=isset($HTTP_GET_VARS['all']);

              include_once('renderXML.php');
              renderGamesListXML($all);
            ?>
            <p class="footer"><i>(Add your game here!)</i>
          </td>
          <td/>
        </tr>
      </table><p>
      <table width="100%" bgcolor="#1B2193" STYLE="border: 2px dotted #000000;">
        <tr height="40"><td/><td align="center"/><img src="images/poweredByLogo.gif"/><td/></tr>
        <tr height="40"><td/><td align="center">
            <a href="http://sourceforge.net/projects/arianne"><IMG SRC="http://sourceforge.net/sflogo.php?group_id=1111&type=1" ALT="SourceForge Logo" BORDER=0></a>
        </td><td/></tr>
        <tr height="40"><td/><td align="center">
            <a href="http://www.java.com"><IMG SRC="images/partners/get_java_green_button.gif" ALT="Java Logo" BORDER=0></a>
        </td><td/></tr>
        <tr height="40"><td/><td align="center">
            <a href="http://www.libSDL.org"><IMG SRC="images/partners/SDLPowered.gif" ALT="SDL Logo" BORDER=0></a>
        </td><td/></tr>
        <tr height="40"><td/><td align="center">
            <a href="http://www.mysql.com"><IMG SRC="images/partners/MySQLPowered.gif" ALT="MySQL Logo" BORDER=0></a>
        </td><td/></tr>
        <tr height="40"><td/><td align="center">
            <a href="http://www.pygame.org"><IMG SRC="images/partners/pygamePowered.gif" ALT="pygame Logo" BORDER=0></a>
        </td><td/></tr>
        <tr height="40"><td/><td align="center">
            <a href="http://www.python.org"><IMG SRC="images/partners/PythonPoweredSmall.gif" ALT="Python Logo" BORDER=0></a>
        </td><td/></tr>
        </tr>
      </table>
      </font>
    </td>
    <td width="2%"/>
    <td width="78%">
      <h1>News items</h1>
         If you wish to keep up to date with the latest changes, 
         <a href="http://lists.sourceforge.net/mailman/listinfo/arianne-announce">click here</a>
         or if you are looking for help please see the Get Help! section.
         <p/>
      <h1>Latest news</h1>
      <?php
        $all=isset($HTTP_GET_VARS['all']);
        include_once('renderXML.php');
        renderNewsXML($all);
       ?>
      <div align="center"><a href="?arianne_url=content/news&all=100">Read all the news items</a>
    </td>
  </tr>
</table>