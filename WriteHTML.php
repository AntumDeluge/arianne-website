<?php
include_once('xml.php');

function GameUpdateTime($game, $base)
  {
  return $game[$base][0]['updated']['0 attr']['date'];
  }

function WriteMenuHTML($website)
  {  
  foreach($website['website'][0]['menu'][0]['entry'] as $key=>$item)
    {
    if(is_array($item))
      {
      $len=strlen($item['name']);
      echo '<td width="'.($len>6?$len:6).'%" align="center"><a href="'.$item['url'].'" class="navi"><b>'.$item['name'].'</b></a></td><td width="10"/>';
      }
    }
  }

function WriteNewsHTML($website,$all)
  {
  $maxNewsItems=5;
  
  foreach($website['website'][0]['item'] as $key=>$item)
    {
    if($maxNewsItems==0) return;
    if(!$all) $maxNewsItems--;

    echo '<table width="100%">';
    echo '<tr><td><b>'.$item['title'][0].'</b></td><td align="right"><font color="#000066">'.$item['date'][0].'</font></td></tr>';
    echo '<tr><td colspan=2>';
    if(isset($item['images']))
      {
      foreach($item['images'] as $key=>$image) 
        {
        if(is_array($image))
          {
          echo '<img src="'.$image['image']['0 attr']['url'].'" alt="Game screenshot" border="1" align="right">';
          }
        }
      }
    echo $item['content'][0].'</td></tr></table><p>';
    }
  }
  
function imageResize($width, $height, $target) 
  { 
  //takes the larger size of the width and height and applies the formula accordingly...this is so this script will work dynamically with any size image 

  if ($width > $height)  
    {  
    $percentage = ($target / $width); 
    } 
  else 
    {
    $percentage = ($target / $height); 
    } 
  
  //gets the new value and applies the percentage, then rounds the value 
  $width = round($width * $percentage); 
  $height = round($height * $percentage); 

  //returns the new sizes in html image tag format...this is so you can plug this function inside an image tag and just get the 
  return "width=\"$width\" height=\"$height\""; 
  } 

function WriteGameBriefingHTML($game,$long_briefing)
  {
  if($long_briefing)
    {
    echo '<table>';
    echo '<tr><td><a href="?arianne_url=games/game_'.$game['game']['0 attr']['name'].'" class="naviLight"><b>'.ucfirst($game['game']['0 attr']['name']).'</b></a>: '.$game['game']['0 attr']['shortdescription'].'</td></tr>';
    echo '<tr><td width="100%" valign="top">'.$game['game'][0]['description'][0].'</td>';
    echo '<td>';
    if(isset($game['game'][0]['screenshots']))
      {
      foreach($game['game'][0]['screenshots'] as $key=>$image) 
        {
        if(is_array($image))
          {
          echo '<a href="screens/'.$game['game']['0 attr']['name'].'/'.$image['image']['0 attr']['name'].'"><img src="screens/'.$game['game']['0 attr']['name'].'/THM_'.$image['image']['0 attr']['name'].'" alt="Game screenshot" border="1"></a>';
          }
        }
      }
    else
      {
      echo '&nbsp;';
      }
    echo '</td>';
    echo '</tr></table>';
    }
  else
    {
    echo '<table>';
    echo '<tr><td><a href="?arianne_url=games/game_'.$game['game']['0 attr']['name'].'" class="naviLight"><b>'.ucfirst($game['game']['0 attr']['name']).'</b></a></td></tr>';
    echo '<tr><td>';
    if(isset($game['game'][0]['screenshots']))
      {
      foreach($game['game'][0]['screenshots'] as $key=>$image) 
        {
        if(is_array($image))
          {
          $image_size = getimagesize('screens/'.$game['game']['0 attr']['name'].'/THM_'.$image['image']['0 attr']['name']);
          $html_size = imageResize($image_size[0], $image_size[1], 130);
        
          echo '<a href="?arianne_url=games/game_'.$game['game']['0 attr']['name'].'"><img src="screens/'.$game['game']['0 attr']['name'].'/THM_'.$image['image']['0 attr']['name'].'" alt="Game screenshot" border="1" '.$html_size.'></a>';
          }
        }
      }
    else
      {
      echo '&nbsp;';
      }
    echo '</td></tr></table>';
    }
  }

function WriteDownloadHTML($game, $base)
  {
  echo '<a href="?arianne_url=games/game_'.$game[$base]['0 attr']['name'].'" class="navi"><h2>'.ucfirst($game[$base]['0 attr']['name']).'&nbsp;&nbsp;<img src="images/horizontalrule.png" width="100%" height=9></h2></a>';
  echo '<table width="100%"><tr><td width="100%" colspan="2">'.$game[$base][0]['description'][0].'</td></tr>';
  echo '<tr>';
  echo '<td><h3>Downloads</h3>Please make sure to choose the file that matchs your operating system<br>';
  foreach(array_keys($game[$base][0]['files'][0]['file']) as $key)
    {
    if(strpos($key,"attr")!=FALSE)
      {
      continue;
      }
      
    $file=$game[$base][0]['files'][0]['file'][$key];
    foreach($game[$base][0]['files'][0]['file'][$key.' attr'] as $akey=>$avalue)
      {
      $file[$akey]=$avalue;
      }
    
    $filename=str_replace("XXX",$game[$base][0]['version']['0 attr']['id'],$file['name']);
    echo '<b><a href="http://prdownloads.sourceforge.net/arianne/'.$filename.'?download">'.$filename.'</a></b>';
    echo '<font size="-1">('.$file['type'].') released on '.$game[$base][0]['updated']['0 attr']['date'].'</font><br>';
    echo '<b>Description</b>: '.$file['description'][0].'<p>';
    echo 'This file is known to work on the following operating systems:<br>';
    foreach($file['os'][0]['entry'] as $key=>$worksOnOS)
      {
      if(is_array($worksOnOS))
        {
        echo '<img src="images/platforms/'.$worksOnOS['name'].'.png" border="1">&nbsp;';
        }
      }
  
    if(isset($file['dependencies']))
      {
      echo '<br>This file depends on:<ul>';
      foreach($file['dependencies'][0]['entry'] as $key=>$dependsOn)
        {
        if(is_array($dependsOn))
          {
          echo '<li><a href="'.$dependsOn['url'].'">'.$dependsOn['name'].'</a></li>';
          }
        }
      echo '</ul>';
      }
    else
      {
      echo '<p>';
      }
    }
  echo '</td>';
  echo '<td valign=top>';
  if(isset($game[$base][0]['screenshots']))
    {
    foreach($game[$base][0]['screenshots'][0]['image'] as $image) 
      {
      if(is_array($image))
        {
        echo '<a href="screens/'.$game[$base]['0 attr']['name'].'/'.$image['name'].'"><img src="screens/'.$game[$base]['0 attr']['name'].'/THM_'.$image['name'].'" alt="Game screenshot" border="1"></a>';
        }
      }
    }
  else
    {
    echo '&nbsp;';
    }
  echo '</td>';
  echo '</tr></table>';
  }

function WriteGameHTML($game,$base)
  {
  echo '<table width="100%"><tr><td><h1>'.ucfirst($game[$base]['0 attr']['name']).'</h1>';
  echo '&copy; 2005 (See Authors list). Released under GNU/GPL license.';
  if(isset($game[$base][0]['rated']))
    {
    echo '</td><td align="right"> Rate us at<br> ';
    foreach($game[$base][0]['rated'][0]['entry'] as $tag=>$rated) 
      {
      echo $rated;
      }
    }
  else
    {
    echo '&nbsp;';
    }
  
  echo '</td></tr></table>';
  
  echo '<p/><h2>What is '.$game[$base]['0 attr']['name'].'?</h2>'.$game[$base][0]['description'][0];
  if(isset($game[$base][0]['extended']))
    {
    echo $game[$base][0]['extended'][0];
    }
  
  if(isset($game[$base][0]['manual']))
    {
    echo '<p><h2>Manual</h2>You can read '.$game[$base]['0 attr']['name'].'\'s manual <a href="'.$game[$base][0]['manual']['0 attr']['url'].'">here</a>';
    }
  
  if(isset($game[$base][0]['screenshots']))
    {
    echo '<p><h2>Screenshots</h2>';  
    foreach($game[$base][0]['screenshots'][0]['image'] as $key=>$image) 
      {
      if(is_array($image))
        {
        echo '<a href="screens/'.$game[$base]['0 attr']['name'].'/'.$image['name'].'"><img src="screens/'.$game[$base]['0 attr']['name'].'/THM_'.$image['name'].'" alt="Game screenshot" border="1"></a>';
        }
      }
    }

  echo '<p><h2>Downloads</h2>Please make sure to choose the file that matchs your operating system:<br>'; 
  foreach(array_keys($game[$base][0]['files'][0]['file']) as $key)
    {
    if(strpos($key,"attr")!=FALSE)
      {
      continue;
      }
      
    $file=$game[$base][0]['files'][0]['file'][$key];
    foreach($game[$base][0]['files'][0]['file'][$key.' attr'] as $akey=>$avalue)
      {
      $file[$akey]=$avalue;
      }
    
    $filename=str_replace("XXX",$game[$base][0]['version']['0 attr']['id'],$file['name']);
    echo '<b><a href="http://prdownloads.sourceforge.net/arianne/'.$filename.'?download">'.$filename.'</a></b>';
    echo '<font size="-1">('.$file['type'].') released on '.$game[$base][0]['updated']['0 attr']['date'].'</font><br>';
    echo '<b>Description</b>: '.$file['description'][0].'<p>';
    echo 'This file is known to work on the following operating systems:<br>';
    foreach($file['os'][0]['entry'] as $key=>$worksOnOS)
      {
      if(is_array($worksOnOS))
        {
        echo '<img src="images/platforms/'.$worksOnOS['name'].'.png" border="1">&nbsp;';
        }
      }
  
    if(isset($file['dependencies']))
      {
      echo '<br>This file depends on:<ul>';
      foreach($file['dependencies'][0]['entry'] as $key=>$dependsOn)
        {
        if(is_array($dependsOn))
          {
          echo '<li><a href="'.$dependsOn['url'].'">'.$dependsOn['name'].'</a></li>';
          }
        }
      echo '</ul>';
      }
    else
      {
      echo '<p>';
      }
    }

  if(isset($game[$base][0]['servers']))
    {
    echo '<p><h2>Online servers</h2>';
    echo $game[$base]['0 attr']['name'].' is a online game, so you need to connect to a server in order to be able to play.<br/>';
    echo 'Choose any of the followings and read the instructions there about how to get an account and connect:<ul>';
    foreach($game[$base][0]['servers'][0]['server'] as $key=>$server)
      {
      if(is_array($server))
        {
        echo '<li><a href="'.$server['url'].'">'.$server['name'].'</a></li>';
        }
      }
    echo '</ul>';
    }
  
  echo '<p><h2>Authors</h2>'.$game[$base]['0 attr']['name'].' has been developed by: <ul>';
  foreach($game[$base][0]['authors'][0]['entry'] as $author)
    {
    if(is_array($author))
      {
      echo '<li><a href="'.$author['url'].'">'.$author['name'].'</a></li>';
      }
    }
  echo '</ul>';
  }

?>