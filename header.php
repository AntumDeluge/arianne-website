<table width="100%">
  <tr height="100">
    <td>
      <table width="100%">
        <tr height="100">
          <td align="left"><a href="/"><img src="images/arianneLogo.jpg" alt="Arianne logo"/ border="0"></a></td>
          <td>an open source multiplayer online framework to easily create games!</td>
          <td align="right"><img src="images/gnuLogo.jpg" alt="GNU Logo"/></td>
        </tr>
      </table>
    </td>
  </tr>
  <tr>
    <td>
      <table width="100%" cellspacing="0" border="0" cellpadding="0" height="30" background="images/menubar.png">
        <tr height="30">
          <td width="5"><img src="images/menubar_left.png" height="30"></td>
          <?php 
            include_once('WriteHTML.php');
            
            $content=implode("",file('xml/website_menu.xml'));
            $xml = XML_unserialize($content);
            WriteMenuHTML($xml);     
          ?>
          <td width="5" align="right"><img src="images/menubar_right.png"></td>
        </tr>
      </table>        
    </td>
  </tr>
</table>
