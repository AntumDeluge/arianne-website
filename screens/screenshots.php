<h1>Screenshots</h1>
Here are several screenshots of our projects.<br>
Most of them are taken from the developers version accessible through CVS.

<?php
$scan  = array();
$files = array();
$dirs  = array();

$scan = scan_dir("screens/");

$dirs = $scan['directories'];
foreach($dirs as $key => $val)
  {
  if(((isset($_REQUEST['archived']) and $val=="screens/archived") or
     (!isset($_REQUEST['archived']) and $val!="screens/archived")) and
     ($val!="screens/CVS"))
    {
    $scan = scan_dir($val);
    $files = $scan['files'];

    $ab = 0;
    $dirname = substr($val,strlen("screens/"),strlen($val));
	echo '<p><h2>'.ucfirst($dirname).'</h2><table border="0" width="100%">';
	
	$i=0;

	foreach($files as $key => $THMfilename)
      {
      if($ab%5 == 0) echo '<tr>';
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
        
        /** TODO: Scale correctly to don't deform the image */
        $image_size = getimagesize("$THMfilename");
        $html_size = imageResize($image_size[0], $image_size[1], 150);

        echo "<td width=\"20%\"><a href=\"$filename1$filename2\"><img src=\"$THMfilename\" border=\"1\" ".$html_size.">";
        echo "<br/>$year/$month/$day</a></td>";
        $ab++;
        $i++;
        }
      }
    /* if we end on odd entry, then end row */
    if($ab%5 == 4) echo '</tr>';
    echo "</table></p>";
    }
  }

if(isset($_REQUEST['archived']))
  {
  echo "<p><a href=\"index.php?arianne_url=screens/screenshots\">Click here to see all the news images!</a>";
  }
else
  {
  echo "<p><a href=\"index.php?arianne_url=screens/screenshots&archived\">Click here to see all the old images!</a>";
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
