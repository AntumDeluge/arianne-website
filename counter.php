<?php
$COUNT_FILE="counter.data";

$fp = fopen("$COUNT_FILE", "r+");
if($fp==false)
  {
  die();
  }

$found=false;
$copyContent=array();

flock($fp, LOCK_EX);

while(($line = fgets($fp, 4096)))
  {
  $content=explode("\t",$line);
  if(count($content)>1)
    {
    if($content[0]== $_SERVER["PHP_SELF"]."?".$_SERVER["QUERY_STRING"])
      {
      $found=true;
      $content[1]=$content[1]+1;
      }

    $copyContent[]=$content[0]."\t".$content[1]."\n";
    }
  }

fseek($fp,0);

foreach($copyContent as $line)
  {
  fputs($fp, $line);
  }

if($found==false)
  {
  fputs($fp, $_SERVER["PHP_SELF"]."?".$_SERVER["QUERY_STRING"]."\t1\n");
  }

flock($fp, LOCK_UN);
fclose($fp);

?>