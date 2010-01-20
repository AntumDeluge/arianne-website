     <?php
        #$all=isset($HTTP_GET_VARS['all']);
        $all=isset($_REQUEST['all']);

        $content=implode("",file('xml/website_news.xml'));
        $xml = XML_unserialize($content);
        WriteNewsHTML($xml,$all);
       ?>
      <p><a href="?arianne_url=content/news&amp;all=100">Read all the news items</a></p>

