
      <h1>News items</h1>
         If you wish to keep up to date with the latest changes, 
         <a href="http://lists.sourceforge.net/mailman/listinfo/arianne-announce">click here</a>
         or if you are looking for help please see the Get Help! section.
         <p></p>
      <h1>Latest news</h1>
      <?php
        $all=isset($HTTP_GET_VARS['all']);

        $content=implode("",file('xml/website_news.xml'));
        $xml = XML_unserialize($content);
        WriteNewsHTML($xml,$all);
       ?>
      <p><a href="?arianne_url=content/news&amp;all=100">Read all the news items</a></p>

