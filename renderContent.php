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
      if(strpos($file,$type)!==false)
        {
        $gameList[]=$file;
        }
      }
    }
  closedir($handle);

  foreach($gameList as $file)
    {
    $content=implode("",file("xml/".$file));
    $xml = simplexml_load_string($content);
    WriteDownloadHTML($xml);
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
    $xml = simplexml_load_string($content);
    WriteGameBriefingHTML($xml,$long_briefing);
    }  
  }
  
?>