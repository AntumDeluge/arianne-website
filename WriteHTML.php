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
      echo '<li><a href="'.$item['url'].'">'.$item['name'].'</a></li>';
      }
    }
  }

function WriteNewsHTML($website,$all)
  {
  $maxNewsItems=5;
  
  echo '<ul class="newslist">';
  
  foreach($website['website'][0]['item'] as $key=>$item)
    {
    if($maxNewsItems==0) break;
    if(!$all) $maxNewsItems--;


    echo '<li><div class="newsitem"><h3>'.$item['title'][0].'</h3><p class="itemdate">'.$item['date'][0].'</p>';

    if(isset($item['images']))
      {
      foreach($item['images'] as $key=>$image) 
        {
        if(is_array($image))
          {
          echo '<img src="'.$image['image']['0 attr']['url'].'" alt="Game screenshot">';
          }
        }
        echo '<div class="newscontent_image">'.$item['content'][0].'</div><div class="clearright">&nbsp;</div></div>';
      }
      else
      {
        echo '<div class="newscontent_noimage">'.$item['content'][0].'</div><div class="clearright">&nbsp;</div></div>';

      }
      echo '</li>';
    }

  echo '</ul>';  
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

  // Create the list of games on the Games page
function WriteGamePageListHTML($game )
  {
    echo '<li><a href="#'.$game['game']['0 attr']['name'].'">'.ucfirst($game['game']['0 attr']['name']).'</a></li>';
  }
  
function WriteGameBriefingHTML($game,$long_briefing)
  {
  if($long_briefing)
    {
    
    echo '<div class="game_entry">';
     
    echo '<div class="link_title"><a name="'.$game['game']['0 attr']['name'].'"></a><h1><a href="?arianne_url=games/game_'.$game['game']['0 attr']['name'].'">'.ucfirst($game['game']['0 attr']['name']).'</a></h1><p><a href="?arianne_url=games/game_'.$game['game']['0 attr']['name'].'">Click here to see information about this package</a></p></div>';
    echo '<h2>'.$game['game']['0 attr']['shortdescription'].'</h2>';

    $time=explode("/",GameUpdateTime($game,"game"));
    if(time()-mktime(0,0,0,$time[2],$time[1],$time[0])<15*24*60*60)
      {
      echo '<img src="images/updated.gif" class="update_image" alt="Recently Updated!">';
      }
      
    echo '<p>'.$game['game'][0]['description'][0].'</p>';
    echo '<p><a href="?arianne_url=games/game_'.$game['game']['0 attr']['name'].'">'.ucfirst($game['game']['0 attr']['name']).' - Click here to see information about this package</a></p>';
    
    if(isset($game['game'][0]['screenshots']))
      {
      foreach($game['game'][0]['screenshots'] as $key=>$image) 
        {
        if(is_array($image))
          {
          echo '<a href="screens/'.$game['game']['0 attr']['name'].'/'.$image['image']['0 attr']['name'].'"><img src="screens/'.$game['game']['0 attr']['name'].'/THM_'.$image['image']['0 attr']['name'].'" alt="Game screenshot"></a>';
          }
        }
      }
    else
      {
      echo '&nbsp;';
      }    
    echo '<hr></div>';
    
    }
  else
    {
    echo '<li class="text">';
    echo '<a href="?arianne_url=games/game_'.$game['game']['0 attr']['name'].'" class="naviLight">'.ucfirst($game['game']['0 attr']['name']).'</a>';
    $time=explode("/",GameUpdateTime($game,"game"));
    if(time()-mktime(0,0,0,$time[2],$time[1],$time[0])<15*24*60*60)
      {
      echo '<img src="images/updated.gif" class="update_image" alt="Recently Updated">';
      }
    echo '</li>';
    echo '<li>';
    if(isset($game['game'][0]['screenshots']))
      {
      foreach($game['game'][0]['screenshots'] as $key=>$image) 
        {
        if(is_array($image))
          {
          $image_size = getimagesize('screens/'.$game['game']['0 attr']['name'].'/THM_'.$image['image']['0 attr']['name']);
          $html_size = imageResize($image_size[0], $image_size[1], 130);
        
          echo '<a href="?arianne_url=games/game_'.$game['game']['0 attr']['name'].'"><img src="screens/'.$game['game']['0 attr']['name'].'/THM_'.$image['image']['0 attr']['name'].'" alt="Game screenshot" '.$html_size.'></a>';
          }
        }
      }
    else
      {
      echo '&nbsp;';
      }
    echo '</li>';
    }
  }

function WriteDownloadHTML($game, $base, $section=false)
  {
      
  // section specifies if this is being called from download page or from games page
  if( $section === false )
  {
    echo '<div class="download"><div class="link_title"><h2><a href="?arianne_url=games/game_'.$game[$base]['0 attr']['name'].'">'.ucfirst($game[$base]['0 attr']['name']).'</a></h2><p><a href="?arianne_url=games/game_'.$game[$base]['0 attr']['name'].'">Click here to see information about this package</a></p></div>';
  } else {
     echo '<h2>Download</h2><div class="download">';
  }
  /*if(isset($game[$base][0]['screenshots']))
    {
    foreach($game[$base][0]['screenshots'][0]['image'] as $image) 
      {
      if(is_array($image))
        {
        echo '<a href="screens/'.$game[$base]['0 attr']['name'].'/'.$image['name'].'"><img src="screens/'.$game[$base]['0 attr']['name'].'/THM_'.$image['name'].'" alt="Game screenshot" class="download_screenshot"></a>';
        }
      }
    }
  else
    {
    echo ' ';
    }
  */
    
  echo '<ul>';
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
    if( $section === false )
      {
        echo '<li>';
      } else {
         echo '<li class="gamepage">';
      }
    
    echo '<a href="http://prdownloads.sourceforge.net/arianne/'.$filename.'?download" class="download_file">'.$filename.'</a><br>';
    echo '('.$file['type'].') released on '.$game[$base][0]['updated']['0 attr']['date'];
    echo '<div class="filedesc"><b>Description</b>: '.$file['description'][0];
    echo '<ul class="OS_images">';

    foreach($file['os'][0]['entry'] as $key=>$worksOnOS)
      {
      if(is_array($worksOnOS))
        {
        echo '<li class="inline"><img src="images/platforms/'.$worksOnOS['name'].'.png" alt="Operating System Logo"></li>';
        }
      }
    echo '</ul>';
    if(isset($file['dependencies']))
      {
      echo '<b>Dependancies</b>: (This file depends on)<ul class="dependancy">';
      foreach($file['dependencies'][0]['entry'] as $key=>$dependsOn)
        {
        if(is_array($dependsOn))
          {
          echo '<li class="inline"><a href="'.$dependsOn['url'].'">'.$dependsOn['name'].'</a></li>';
          }
        }
      echo '</ul>';
      }
    else
      {
      echo ' ';
      }
     
      echo '</div></li>'; 
   }
  echo '</ul>';
 

  //echo '</div>';
  echo '<div class="clearright">&nbsp;</div></div>';
  }

function WriteGameHTML($game,$base)
  {
  echo '<h1>'.ucfirst($game[$base]['0 attr']['name']).'</h1>';
  echo '&copy; 2005 (See Authors list). Released under GNU/GPL license.';
  if(isset($game[$base][0]['rated']))
    {
    echo ' Rate us at<br> ';
    foreach($game[$base][0]['rated'][0]['entry'] as $tag=>$rated) 
      {
      echo $rated;
      }
    }
  else
    {
    echo '&nbsp;';
    }
  
  
  echo '<div class="section"><h2>What is '.$game[$base]['0 attr']['name'].'?</h2>'.$game[$base][0]['description'][0];
  if(isset($game[$base][0]['extended']))
    {
    echo $game[$base][0]['extended'][0];
    }
    
    echo '</div>';
  
  if(isset($game[$base][0]['manual']))
    {
    echo '<div class="section"><h2>Manual</h2>You can read '.$game[$base]['0 attr']['name'].'\'s manual <a href="'.$game[$base][0]['manual']['0 attr']['url'].'">here</a>';
    echo '</div>';
    }
  
  if(isset($game[$base][0]['screenshots']))
    {
    echo '<div class="section"><h2>Screenshots</h2><ul class="screenshots">';  
    $i = 0;
    foreach($game[$base][0]['screenshots'][0]['image'] as $key=>$image) 
      {
      if(is_array($image))
        {
        echo '<li><a href="screens/'.$game[$base]['0 attr']['name'].'/'.$image['name'].'"><img src="screens/'.$game[$base]['0 attr']['name'].'/THM_'.$image['name'].'" alt="Game screenshot"></a></li>';
        $i++;
        }
      if( $i > 4) break;
      }
      echo '</ul></div>';
    }

  if(isset($game[$base][0]['servers']))
    {
    echo '<div class="section"><h2>Online servers</h2>';
    echo $game[$base]['0 attr']['name'].' is a online game, so you need to connect to a server in order to be able to play.</p>';
    echo '<p>Choose any of the followings and read the instructions there about how to get an account and connect:<ul>';
    foreach($game[$base][0]['servers'][0]['server'] as $key=>$server)
      {
      if(is_array($server))
        {
        echo '<li><a href="'.$server['url'].'">'.$server['name'].'</a></li>';
        }
      }
    echo '</ul></div>';
    }

  echo '<div class="section">';
  WriteDownloadHTML($game, $base, true);
  echo '</div>';

  
  echo '<div class="section"><h2>Authors</h2><p>'.$game[$base]['0 attr']['name'].' has been developed by:</p><ul>';
  foreach($game[$base][0]['authors'][0]['entry'] as $author)
    {
    if(is_array($author))
      {
      echo '<li><a href="'.$author['url'].'">'.$author['name'].'</a></li>';
      }
    }
  echo '</ul></div>';
  }

  
function WriteScreenshotsHTML( $game, $base, $archived=false )
  {
      // load shots from dir by name 
      // line up thumbnails
      
      if( !$archived ) {
        echo '<div class="screenshots_entry"><div class="link_title"><h2><a href="?arianne_url=games/game_'.$game[$base]['0 attr']['name'].'">'.ucfirst($game[$base]['0 attr']['name']).'</a></h2><p><a href="?arianne_url=games/game_'.$game[$base]['0 attr']['name'].'">Click here to see information about this package</a></p></div>';
        $val = "screens/".$game[$base]['0 attr']['name'];
      } else {
        echo '<div class="screenshots_entry"><div class="link_title"><h2>Archived</h2></div>';      
        $val = "screens/archived";
      }
      $scan  = array();
      $files = array();


  if((($archived==TRUE) and $val=="screens/archived") or
     (($archived==FALSE) and $val!="screens/archived") and
     ($val!="screens/CVS"))
    {
    $scan = scan_dir($val);
    $files = $scan['files'];

    $ab = 0;

	$i=0;
    echo '<ul>';
	foreach($files as $key => $THMfilename)
      {
      if( !$archived ) 
        if( $i > 3 ) break;
      
      $pos = strpos($THMfilename,"THM_");
      if($pos===false)
        {
        //$ab = 0;
        }
      else 
        {
        $filename1 = substr($THMfilename, 0, $pos);
        $filename2 = substr($THMfilename, $pos+4, strlen($THMfilename));
        $year = substr($THMfilename, $pos+4 , 4);
        $month = substr($THMfilename, $pos+8, 2);
        $day = substr($THMfilename, $pos+10, 2);
        
        // TODO: Scale correctly to don't deform the image 
        $image_size = getimagesize("$THMfilename");
        $html_size = imageResize($image_size[0], $image_size[1], 150);

        echo "<li class=\"thumbnail\"><a href=\"$filename1$filename2\"><img src=\"$THMfilename\"  alt=\"Screenshot\">";
        echo "</a></li>";
        $ab++;
        $i++;
        }
      }

    echo "</ul>";


    if($archived)
      {
      echo "<p class=\"archive\"><a href=\"index.php?arianne_url=content/screenshots\">Click here to see all the new images!</a></p>";
      }
    else
      {
      echo "<p class=\"archive\"><a href=\"index.php?arianne_url=content/screenshots&amp;archived=1\">Click here to see all the old images!</a></p>";
      }
  }
  
  echo '<div class="clearright">&nbsp;</div></div>';
}  

//******************************************************
// This functions was named list_dir by whoever 
// originally wrote it.
// if this is your code. Thanks for the start.
//*******************************************************

function scan_dir($dirname,$recurse=FALSE,$sort_flag=SORT_REGULAR)
  {
  if($dirname[strlen($dirname)-1]!='/') $dirname.='/';

  $file_array=array();
  $dir_array=array();
  $ret_array=array();

  $handle=opendir($dirname);
  while (false !== ($file = readdir($handle)))
    {
    if($file=='.'||$file=='..') continue;
    if(is_dir($dirname.$file))
      {
      $dir_array[]=$dirname.$file;
      if($recurse)
        {
        scan_dir($dirname.$file.'/',$recurse);
        }
      }
    else
      {
      $file_array[]=$dirname.$file;
      }
    }
  closedir($handle);

  sort($file_array,$sort_flag);
  $file_array=array_reverse($file_array);
  
  for($i=0;$i<count($file_array);$i++)
    {
    for($j=$i;$j<count($file_array);$j++)
      {
      if(filemtime($file_array[$j])>filemtime($file_array[$i]))
        {
        $tmp=$file_array[$j];
        $file_array[$j]=$file_array[$i];
        $file_array[$i]=$tmp;
        }
      }
    }
  sort($dir_array,$sort_flag);
  reset($file_array);
  reset($dir_array);

  $ret_array['files']=$file_array;
  $ret_array['directories']=$dir_array;

  return $ret_array;
  }
?>