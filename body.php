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

include($arianne_url.".php"); 
?>