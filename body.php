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

if($arianne_url!="content/news")
  {
echo '<table width="100%">'.
     '    <tr>'.
     '      <td width="30">&nbsp;</td>'.
     '      <td>';
  }

include($arianne_url.".php"); 


if($arianne_url!="content/news")
  {
echo '      </td>'.
     '      <td width="30">&nbsp;</td>'.
     '    </tr>'.
     '  </table>';
  }
?>