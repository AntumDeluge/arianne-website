<?php 
include_once('WriteHTML.php');

function cmp($a,$b)
  {
  if ($a == $b) 
    {
    return 0;
    }
  return ($a > $b) ? -1 : 1;
  }
 
function sortByDate($files)
  {
  $result=array();
  
  foreach($files as $file)
    {
    $content=implode("",file($file));
    $xml = XML_unserialize($content);
    $base=(explode("_",substr($file,strlen('xml_'))));
    $result[GameUpdateTime($xml,$base[0])]=$file;
    }
    
  usort($result,"cmp");
  return array_values($result);
  }

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
    if(strpos($file, '~')!==false) continue;
    if(!is_dir("xml/".$file))
      {
      if(strpos($file,$type.'_')!==false)
        {
        $gameList[]="xml/".$file;
        }
      }
    }
  closedir($handle);
  
  $gameList=sortByDate($gameList);

  foreach($gameList as $file)
    {
    $content=implode("",file($file));
    $xml = XML_unserialize($content);
    WriteLinkDownloadHTML($xml,$type);
    }  
  }

function renderGameList($type)
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
        $gameList[]="xml/".$file;
        }
      }
    }
  closedir($handle);
  
  $gameList=sortByDate($gameList);
 
  echo '<div id="gamelist"><ul class="menubar">';
  
  foreach($gameList as $file)
    {
    $content=implode("",file($file));
    $xml = XML_unserialize($content); 
	WriteGamePageListHTML( $xml );
	 
  }  
    
  echo '</ul></div>';    
      
  }
  
function renderGameBriefing($long_briefing=TRUE,$type)
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
        $gameList[]="xml/".$file;
        }
      }
    }
  closedir($handle);
  
  $gameList=sortByDate($gameList);
  
  foreach($gameList as $file)
    {
    $content=implode("",file($file));
    $xml = XML_unserialize($content);
    WriteGameBriefingHTML($xml,$long_briefing);
    }  
  }
  
  
function renderScreenshots($type, $archived=FALSE)
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
        $gameList[]="xml/".$file;
        }
      }
    }
  closedir($handle);
  
  $gameList=sortByDate($gameList);

  if( !$archived ) {
  foreach($gameList as $file)
    {
    $content=implode("",file($file));
    $xml = XML_unserialize($content);
    WriteScreenshotsHTML($xml,$type, $archived);
    }  
  } else {
    WriteScreenshotsHTML(0,$type, $archived);    
  }
}
?>