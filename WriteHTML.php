<?php

function WriteMenuHTML($website)
  {
  foreach($website->menu->children() as $item)
    {
    $len=strlen($item['name']);
    echo '<td width="'.($len>6?$len:6).'%" align="center"><a href="'.$item['url'].'" class="navi"><b>'.$item['name'].'</b></a></td><td width="10"/>';
    }
  }

function WriteNewsHTML($website,$all)
  {
  $maxNewsItems=5;
  
  foreach($website->children() as $item)
    {
    if($maxNewsItems==0) return;
    if(!$all) $maxNewsItems--;

    echo '<table width="100%">';
    echo '<tr><td><b>'.$item->title.'</b></td><td align="right"><font color="#000066">'.$item->date.'</font></td></tr>';
    echo '<tr><td colspan=2>';
    if(isset($item->content->images))
      {
      foreach($item->content->images->children() as $image) 
        {
        echo '<img src="'.$image['url'].'" alt="Game screenshot" border="1" align="right">';
        }
      }
    echo $item->content.'</td></tr></table><p>';
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
    echo '<tr><td><a href="?arianne_url=games/game_'.$game['name'].'" class="naviLight"><b>'.ucfirst($game['name']).'</b></a>: '.$game['shortdescription'].'</td></tr>';
    echo '<tr><td width="100%" valign="top">'.$game->description.'</td>';
    echo '<td>';
    if(isset($game->screenshots))
      {
      foreach($game->screenshots->children() as $image) 
        {
        echo '<a href="screens/'.$game['name'].'/'.$image['name'].'"><img src="screens/'.$game['name'].'/THM_'.$image['name'].'" alt="Game screenshot" border="1"></a>';
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
    echo '<tr><td><a href="?arianne_url=games/game_'.$game['name'].'" class="naviLight"><b>'.ucfirst($game['name']).'</b></a></td></tr>';
    echo '<tr><td>';
    if(isset($game->screenshots))
      {
      foreach($game->screenshots->children() as $image) 
        {
        $image_size = getimagesize('screens/'.$game['name'].'/THM_'.$image['name']);
        $html_size = imageResize($image_size[0], $image_size[1], 130);
        
        echo '<a href="?arianne_url=games/game_'.$game['name'].'"><img src="screens/'.$game['name'].'/THM_'.$image['name'].'" alt="Game screenshot" border="1" '.$html_size.'></a>';
        }
      }
    else
      {
      echo '&nbsp;';
      }
    echo '</td></tr></table>';
    }
  }

function WriteDownloadHTML($game)
  {
  echo '<a href="?arianne_url=games/game_'.$game['name'].'" class="navi"><h2>'.ucfirst($game['name']).'&nbsp;&nbsp;<img src="images/horizontalrule.png" width="100%" height=9></h2></a>';
  echo '<table width="100%"><tr><td width="100%" colspan="2">'.$game->description.'</td></tr>';
  echo '<tr>';
  echo '<td><h3>Downloads</h3>Please make sure to choose the file that matchs your operating system<br>';
  foreach($game->files->children() as $file)
    {
    $filename=str_replace("XXX",$game->version['id'],$file['name']);
    echo '<b><a href="http://prdownloads.sourceforge.net/arianne/'.$filename.'?download">'.$filename.'</a></b>';
    echo '<font size="-1">('.$file['type'].') released on '.$game->updated['date'].'</font><br>';
    echo 'This file is known to work on the following operating systems:<br>';
    foreach($file->os->children() as $worksOnOS)
      {
      echo '<img src="images/platforms/'.$worksOnOS['name'].'.png" border="1">&nbsp;';
      }
  
    if(isset($file->dependencies))
      {
      echo '<br>This file depends on:<ul>';
      foreach($file->dependencies->children() as $dependsOn)
        {
        echo '<li><a href="'.$dependsOn['url'].'">'.$dependsOn['name'].'</a></li>';
        }
      echo '</ul>';
      }
    else
      {
      echo '<p>';
      }
    }
  echo '</td>';
  echo '<td>';
  if(isset($game->screenshots))
    {
    foreach($game->screenshots->children() as $image) 
      {
      echo '<a href="screens/'.$game['name'].'/'.$image['name'].'"><img src="screens/'.$game['name'].'/THM_'.$image['name'].'" alt="Game screenshot" border="1"></a>';
      }
    }
  else
    {
    echo '&nbsp;';
    }
  echo '</td>';
  echo '</tr></table>';
  }

function WriteGameHTML($game)
  {
  echo '<table width="100%"><tr><td><h1>'.ucfirst($game['name']).'</h1>';
  echo '&copy; 2005 (See Authors list). Released under GNU/GPL license.';
  if(isset($game->rated))
    {
    echo '</td><td align="right"> Rate us at<br> ';
    foreach($game->rated->children() as $tag=>$rated) 
      {
      echo $rated;
      }
    }
  else
    {
    echo '&nbsp;';
    }
  
  echo '</td></tr></table>';
  
  echo '<p/><h2>What is '.$game['name'].'?</h2>'.$game->description;
  if(isset($game->extended))
    {
    echo $game->extended;
    }
  
  if(isset($game->manual))
    {
    echo '<p><h2>Manual</h2>You can read '.$game['name'].'\'s manual <a href="'.$game->manual['URL'].'">here</a>';
    }
  
  if(isset($game->screenshots))
    {
    echo '<p><h2>Screenshots</h2>';  
    foreach($game->screenshots->children() as $image) 
      {
      echo '<a href="screens/'.$game['name'].'/'.$image['name'].'"><img src="screens/'.$game['name'].'/THM_'.$image['name'].'" alt="Game screenshot" border="1"></a>';
      }
    }

  echo '<p><h2>Downloads</h2>Please make sure to choose the file that matchs your operating system:<br>'; 
  foreach($game->files->children() as $file)
    {
    $filename=str_replace("XXX",$game->version['id'],$file['name']);
    echo '<b><a href="http://prdownloads.sourceforge.net/arianne/'.$filename.'?download">'.$filename.'</a></b>';
    echo '<font size="-1">('.$file['type'].') released on '.$game->updated['date'].'</font><br>';
    echo 'This file is known to work on the following operating systems:<br>';
    foreach($file->os->children() as $worksOnOS)
      {
      echo '<img src="images/platforms/'.$worksOnOS['name'].'.png" border="1">&nbsp;';
      }
  
    if(isset($file->dependencies))
      {
      echo '<br>This file depends on:<ul>';
      foreach($file->dependencies->children() as $dependsOn)
        {
        echo '<li><a href="'.$dependsOn['url'].'">'.$dependsOn['name'].'</a></li>';
        }
      echo '</ul>';
      }
    else
      {
      echo '<p>';
      }
    }

  if(isset($game->servers))
    {
    echo '<p><h2>Online servers</h2>';
    echo $game['name'].' is a online game, so you need to connect to a server in order to be able to play.<br/>';
    echo 'Choose any of the followings and read the instructions there about how to get an account and connect:<ul>';
    foreach($game->servers->children() as $server)
      {
      echo '<li><a href="'.$server['url'].'">'.$server['name'].'</a></li>';
      }
    echo '</ul>';
    }
  
  echo '<p><h2>Authors</h2>'.$game['name'].' has been developed by: <ul>';
  foreach($game->authors->children() as $author)
    {
    echo '<li><a href="'.$author['url'].'">'.$author['name'].'</a></li>';
    }
  echo '</ul>';
  }

?>