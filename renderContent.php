<?php 
include_once('WriteHTML.php');

/** This function renders the Download section related to games
    $type should be "game_","server_" or "client_"
    */
function renderDownloads($type)
  {
  $gameList=array();
  $handle=opendir("xml/");
  
  while (false !== ($file = readdir($handle)))
    {
    if($file=='.'||$file=='..') continue;
    if(!is_dir("xml/".$file))
      {
      if(strpos($file,$type.'_')!==false)
        {
        $gameList[]=$file;
        }
      }
    }
  closedir($handle);

  foreach($gameList as $file)
    {
    $content=implode("",file("xml/".$file));
    $xml = XML_unserialize($content);
    WriteDownloadHTML($xml,$type);
    }  
  }

function renderGameBriefing($long_briefing=TRUE)
  {
  $gameList=array();
  $handle=opendir("xml/");
  
  while (false !== ($file = readdir($handle)))
    {
    if($file=='.'||$file=='..') continue;
    if(!is_dir("xml/".$file))
      {
      if(strpos($file,'game_')!==false)
        {
        $gameList[]=$file;
        }
      }
    }
  closedir($handle);

  foreach($gameList as $file)
    {
    $content=implode("",file("xml/".$file));
    $xml = XML_unserialize($content);
    WriteGameBriefingHTML($xml,$long_briefing);
    }  
  }
  
?>