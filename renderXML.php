<?php
$depth=array();
$content=array();

function game_startElement($parser, $name, $attrs) 
  {
  global $depth, $content;
  
  if($name=="GAME")
    {
    echo "<table width=\"100%\"><tr><td><h1>".ucfirst($attrs["NAME"])."</h1>\n";
    echo "&copy; 2004 (See Authors list). Released under GNU/GPL license.\n</td>";
    }
  else if($name=="RATED")
    {
    echo "<td align=\"right\"> Rate us at <br/>";
    }
  else if(in_array("GAME",$depth) and $name=="DESCRIPTION")
    {
    echo "<p/><h2>What is ".$content["GAME"]["NAME"]."?</h2>\n";
    }
  else if($name=="MANUAL")
    {
    echo "<p/><h2>Manual</h2>\n";
    echo "You can read the ".$content["GAME"]["NAME"]."'s manual <a href=\"?arianne_url=".$attrs["URL"]."\">here</a>";
    }
  else if($name=="SCREENSHOTS")
    {
    echo "<p/><h2>Screenshots</h2>\n";
    }
  else if(in_array("SCREENSHOTS",$depth) and $name=="IMAGE")
    {
    echo "<a href=\"screens/".$content["GAME"]["NAME"]."/".$attrs["NAME"]."\">".
         "<img src=\"screens/".$content["GAME"]["NAME"]."/THM_".$attrs["NAME"].
         "\" alt=\"Screenshot of the game\" border=\"1\">".
         "</a>\n";
    }
  else if($name=="FILES")
    {
    echo "<p/><h2>Downloads</h2>\n";
    echo "Please make sure to choose the file that matchs your operating system<br>\n";
    }
  else if(in_array("FILES",$depth) and $name=="FILE")
    {
    $filename=str_replace("XXX",$content["VERSION"]["ID"],$attrs["NAME"]);
    echo "<b><a href=\"http://prdownloads.sourceforge.net/arianne/".$filename."?download\">".
         $filename.
         "</a></b> <font size=\"-1\">(".$attrs["TYPE"].") released on ".$content["UPDATED"]["DATE"]."</font><br>\n";
    }
  else if(in_array("FILES",$depth) and in_array("FILE",$depth) and $name=="DEPENDENCIES")
    {
    echo "This file depends on:<ul>\n";
    }
  else if(in_array("FILES",$depth) and in_array("FILE",$depth) and in_array("DEPENDENCIES",$depth) and $name=="ENTRY")
    {
    echo "<li><a href=\"".$attrs["URL"]."\">".$attrs["NAME"]."</a></li>\n";
    }
  else if(in_array("FILES",$depth) and in_array("FILE",$depth) and $name=="OS")
    {
    echo "This file is known to work on the following operating systems:<br>\n";
    }
  else if(in_array("FILES",$depth) and in_array("FILE",$depth) and in_array("OS",$depth) and $name=="ENTRY")
    {
    echo "<img src=\"images/platforms/".$attrs["NAME"].".png\" border=\"1\">&nbsp;\n";
    }
  else if($name=="SERVERS")
    {
    echo "<p><h2>Online servers</h2>\n".
    	 $content["GAME"]["NAME"]." is a online game, so you need to connect to a server.<br/>\n".
    	 "Choose any of the followings and read the instructions there about how to get an account and connect:<ul>";
    }
  else if(in_array("SERVERS",$depth) and $name=="SERVER")
    {
    echo "<li><a href=\"".$attrs["URL"]."\">".
         $attrs["NAME"].
         "</a></li>\n";
    }
  else if($name=="AUTHORS")
    {
    echo "<p/><h2>Authors</h2>";
    echo $content["GAME"]["NAME"]." has been developed by: <ul>\n";    
    }
  else if(in_array("AUTHORS",$depth) and $name=="ENTRY")
    {
    echo "<li><a href=\"".$attrs["URL"]."\">".$attrs["NAME"]."</a></li>\n";
    }
    
  array_push($depth, $name);
  $content[$name]=$attrs;
  }

function game_charData($parser, $data)
  {
  global $depth, $content;

  if(in_array("GAME",$depth) and in_array("DESCRIPTION",$depth))
    {
    if(strlen($data)>1)
      {
      echo $data."\n";    
      }
    }      
  else if(in_array("RATED",$depth) and in_array("ENTRY",$depth))
    {
    if(strlen($data)>1)
      {
      echo $data."\n";    
      }
    }      
  }

function game_endElement($parser, $name) 
  {
  global $depth, $content;

  if($name=="RATED")
    {
    echo "</td></tr></table>";
    }
  else if($name=="AUTHORS")
    {
    echo "</ul>\n";
    }
  else if(in_array("FILES",$depth) and in_array("FILE",$depth) and $name=="DEPENDENCIES")
    {
    echo "</ul>\n";
    }
  else if(in_array("FILES",$depth) and in_array("FILE",$depth) and $name=="OS")
    {
    echo "<br/>\n";
    }
  else if($name=="SERVERS")
    {
    echo "</ul>\n";
    }
    
  array_pop($depth);
  }


function server_startElement($parser, $name, $attrs) 
  {
  global $depth, $content;
  
  if($name=="SERVER")
    {
    echo "<h1>".ucfirst($attrs["NAME"])."</h1>\n";
    echo "&copy; 2004 (See Authors list). Released under GNU/GPL license.\n";
    }
  else if($name=="DESCRIPTION")
    {
    echo "<p/><h2>What is ".$content["SERVER"]["NAME"]."?</h2>\n";
    }
  else if($name=="FILES")
    {
    echo "<p/><h2>Downloads</h2>\n";
    echo "Please make sure to choose the file that matchs your operating system<br>\n";
    }
  else if(in_array("FILES",$depth) and $name=="FILE")
    {
    $filename=str_replace("XXX",$content["VERSION"]["ID"],$attrs["NAME"]);
    echo "<b><a href=\"http://prdownloads.sourceforge.net/arianne/".$filename."?download\">".
         $filename.
         "</a></b> <font size=\"-1\">(".$attrs["TYPE"].") released on ".$content["UPDATED"]["DATE"]."</font><br>\n";
    }
  else if(in_array("FILES",$depth) and in_array("FILE",$depth) and $name=="DEPENDENCIES")
    {
    echo "This file depends on:<ul>\n";
    }
  else if(in_array("FILES",$depth) and in_array("FILE",$depth) and in_array("DEPENDENCIES",$depth) and $name=="ENTRY")
    {
    echo "<li><a href=\"".$attrs["URL"]."\">".$attrs["NAME"]."</a></li>\n";
    }
  else if(in_array("FILES",$depth) and in_array("FILE",$depth) and $name=="OS")
    {
    echo "This file is known to work on the following operating systems:<br>\n";
    }
  else if(in_array("FILES",$depth) and in_array("FILE",$depth) and in_array("OS",$depth) and $name=="ENTRY")
    {
    echo "<img src=\"images/platforms/".$attrs["NAME"].".png\" border=\"1\">&nbsp;\n";
    }
  else if($name=="AUTHORS")
    {
    echo "<p/><h2>Authors</h2>";
    echo $content["SERVER"]["NAME"]." has been developed by: <ul>\n";    
    }
  else if(in_array("AUTHORS",$depth) and $name=="ENTRY")
    {
    echo "<li><a href=\"".$attrs["URL"]."\">".$attrs["NAME"]."</a></li>\n";
    }
    
  array_push($depth, $name);
  $content[$name]=$attrs;
  }

function server_charData($parser, $data)
  {
  global $depth, $content;

  if(in_array("SERVER",$depth) and in_array("DESCRIPTION",$depth))
    {
    if(strlen($data)>1)
      {
      echo $data."\n";    
      }
    }      

  if(in_array("SERVER",$depth) and in_array("EXTENDED",$depth))
    {
    if(strlen($data)>1)
      {
      echo $data."\n";    
      }
    }      
  }

function server_endElement($parser, $name) 
  {
  global $depth, $content;

  if($name=="AUTHORS")
    {
    echo "</ul>\n";
    }
  else if(in_array("FILES",$depth) and in_array("FILE",$depth) and $name=="DEPENDENCIES")
    {
    echo "</ul>\n";
    }
  else if(in_array("FILES",$depth) and in_array("FILE",$depth) and $name=="OS")
    {
    echo "<br/>\n";
    }
    
  array_pop($depth);
  }


function imageResize($width, $height, $target) { 

//takes the larger size of the width and height and applies the formula accordingly...this is so this script will work dynamically with any size image 

if ($width > $height) { 
$percentage = ($target / $width); 
} else { 
$percentage = ($target / $height); 
} 

//gets the new value and applies the percentage, then rounds the value 
$width = round($width * $percentage); 
$height = round($height * $percentage); 

//returns the new sizes in html image tag format...this is so you can plug this function inside an image tag and just get the 

return "width=\"$width\" height=\"$height\""; 

} 


function gameBrief_startElement($parser, $name, $attrs) 
  {
  global $depth, $content;
  
  if($name=="GAME")
    {
    echo "<table width=\"100%\"><tr><td><a href=\"?arianne_url=games/game_".$attrs["NAME"]."\" class=\"naviLight\"><b>".$attrs["NAME"]."</b></a></td></tr>\n";
    }
  else if(in_array("SCREENSHOTS",$depth) and $name=="IMAGE")
    {
    $image_size = getimagesize("screens/".$content["GAME"]["NAME"]."/THM_".$attrs["NAME"]);
    $html_size = imageResize($image_size[0], $image_size[1], 100);
    
    echo "<tr><td><a href=\"?arianne_url=games/game_".$content["GAME"]["NAME"]."\">".
         "<img src=\"screens/".$content["GAME"]["NAME"]."/THM_".$attrs["NAME"].
         "\" alt=\"Screenshot of the game\" border=\"1\" ".$html_size.">".
         "</a></td></tr>\n";
    }
    
  array_push($depth, $name);
  $content[$name]=$attrs;
  }

function gameBrief_charData($parser, $data)
  {
  }

function gameBrief_endElement($parser, $name) 
  {
  global $depth, $content;

  if($name=="GAME")
    {
    echo "</table>\n";
    }
    
  array_pop($depth);
  }



function gameDefBrief_startElement($parser, $name, $attrs) 
  {
  global $depth, $content;
  
  if($name=="GAME")
    {
    echo "<table width=\"100%\"><tr><td><a href=\"?arianne_url=games/game_".$attrs["NAME"]."\" class=\"naviLight\"><b>".ucfirst($attrs["NAME"])."</b></a>: ".$attrs["SHORTDESCRIPTION"]."</td><td/></tr><tr valign=\"top\">\n";
    }
  if($name=="DESCRIPTION")
    {
    echo "<td>";
    }
  else if(in_array("SCREENSHOTS",$depth) and $name=="IMAGE")
    {
    echo "<td><a href=\"screens/".$content["GAME"]["NAME"]."/".$attrs["NAME"]."\">".
         "<img src=\"screens/".$content["GAME"]["NAME"]."/THM_".$attrs["NAME"].
         "\" alt=\"Screenshot of the game\" border=\"1\">".
         "</a></td>\n";
    }
    
  array_push($depth, $name);
  $content[$name]=$attrs;
  }

function gameDefBrief_charData($parser, $data)
  {
  global $depth, $content;

  if(in_array("GAME",$depth) and in_array("DESCRIPTION",$depth))
    {
    if(strlen($data)>1)
      {
      echo $data."\n";    
      }
    }      
  }

function gameDefBrief_endElement($parser, $name) 
  {
  global $depth, $content;

  if($name=="DESCRIPTION")
    {
    echo "</td>";
    }
  else if($name=="GAME")
    {
    echo "</tr></table>\n";
    }
    
  array_pop($depth);
  }



function gameDownload_startElement($parser, $name, $attrs) 
  {
  global $depth, $content;
  
  if($name=="GAME")
    {
    echo "<a href=\"?arianne_url=games/game_".$attrs["NAME"]."\" class=\"navi\"><h2>".ucfirst($attrs["NAME"])."</h2></a><table width=\"100%\"><tr>\n";
    }
  else if(in_array("SCREENSHOTS",$depth) and $name=="IMAGE")
    {
    echo "<td><a href=\"screens/".$content["GAME"]["NAME"]."/".$attrs["NAME"]."\">".
         "<img src=\"screens/".$content["GAME"]["NAME"]."/THM_".$attrs["NAME"].
         "\" alt=\"Screenshot of the game\" border=\"1\">".
         "</a></td><td width=\"20\"/>\n";
    }
  else if($name=="FILES")
    {
    echo "<td><h3>Downloads</h3>\n";
    echo "Please make sure to choose the file that matchs your operating system<br>\n";
    }
  else if(in_array("FILES",$depth) and $name=="FILE")
    {
    $filename=str_replace("XXX",$content["VERSION"]["ID"],$attrs["NAME"]);
    echo "<b><a href=\"http://prdownloads.sourceforge.net/arianne/".$filename."?download\">".
         $filename.
         "</a></b> <font size=\"-1\">(".$attrs["TYPE"].") released on ".$content["UPDATED"]["DATE"]."</font><br>\n";
    }
  else if(in_array("FILES",$depth) and in_array("FILE",$depth) and $name=="DEPENDENCIES")
    {
    echo "This file depends on:<ul>\n";
    }
  else if(in_array("FILES",$depth) and in_array("FILE",$depth) and in_array("DEPENDENCIES",$depth) and $name=="ENTRY")
    {
    echo "<li><a href=\"".$attrs["URL"]."\">".$attrs["NAME"]."</a></li>\n";
    }
  else if(in_array("FILES",$depth) and in_array("FILE",$depth) and $name=="OS")
    {
    echo "This file is known to work on the following operating systems:<br>\n";
    }
  else if(in_array("FILES",$depth) and in_array("FILE",$depth) and in_array("OS",$depth) and $name=="ENTRY")
    {
    echo "<img src=\"images/platforms/".$attrs["NAME"].".png\" border=\"1\">&nbsp;\n";
    }

  array_push($depth, $name);
  $content[$name]=$attrs;
  }

function gameDownload_charData($parser, $data)
  {
  global $depth, $content;

  if(in_array("GAME",$depth) and in_array("DESCRIPTION",$depth))
    {
    if(strlen($data)>1)
      {
      echo $data."\n";    
      }
    }      
  }

function gameDownload_endElement($parser, $name) 
  {
  global $depth, $content;

  if(in_array("FILES",$depth) and in_array("FILE",$depth) and $name=="DEPENDENCIES")
    {
    echo "</ul>\n";
    }
  else if(in_array("FILES",$depth) and in_array("FILE",$depth) and $name=="OS")
    {
    echo "<br/>\n";
    }
  else if($name=="FILES")
    {
    echo "</td>\n";
    }
  else if($name=="GAME")
    {
    echo "</tr></table>\n";
    }
    
  array_pop($depth);
  }


function serverDownload_startElement($parser, $name, $attrs) 
  {
  global $depth, $content;
  
  if($name=="SERVER")
    {
    echo "<h2>".ucfirst($attrs["NAME"])."</h2><table width=\"100%\"><tr valign=\"top\">\n";
    }
  if($name=="DESCRIPTION")  
    {
    echo "<td width=\"100%\">";
    }
  else if($name=="FILES")
    {
    echo "<td><p/><h3>Downloads</h3>\n";
    echo "Please make sure to choose the file that matchs your operating system<br>\n";
    }
  else if(in_array("FILES",$depth) and $name=="FILE")
    {
    $filename=str_replace("XXX",$content["VERSION"]["ID"],$attrs["NAME"]);
    echo "<b><a href=\"http://prdownloads.sourceforge.net/arianne/".$filename."?download\">".
         $filename.
         "</a></b> <font size=\"-1\">(".$attrs["TYPE"].") released on ".$content["UPDATED"]["DATE"]."</font><br>\n";
    }
  else if(in_array("FILES",$depth) and in_array("FILE",$depth) and $name=="DEPENDENCIES")
    {
    echo "This file depends on:<ul>\n";
    }
  else if(in_array("FILES",$depth) and in_array("FILE",$depth) and in_array("DEPENDENCIES",$depth) and $name=="ENTRY")
    {
    echo "<li><a href=\"".$attrs["URL"]."\">".$attrs["NAME"]."</a></li>\n";
    }
  else if(in_array("FILES",$depth) and in_array("FILE",$depth) and $name=="OS")
    {
    echo "This file is known to work on the following operating systems:<br>\n";
    }
  else if(in_array("FILES",$depth) and in_array("FILE",$depth) and in_array("OS",$depth) and $name=="ENTRY")
    {
    echo "<img src=\"images/platforms/".$attrs["NAME"].".png\" border=\"1\">&nbsp;\n";
    }

  array_push($depth, $name);
  $content[$name]=$attrs;
  }

function serverDownload_charData($parser, $data)
  {
  global $depth, $content;

  if(in_array("SERVER",$depth) and in_array("DESCRIPTION",$depth))
    {
    if(strlen($data)>1)
      {
      echo $data."\n";    
      }
    }      
  }

function serverDownload_endElement($parser, $name) 
  {
  global $depth, $content;

  if(in_array("FILES",$depth) and in_array("FILE",$depth) and $name=="DEPENDENCIES")
    {
    echo "</ul>\n";
    }
  else if($name=="DESCRIPTION")  
    {
    echo "</td></tr><tr>";
    echo "";
    }
  else if($name=="FILES")  
    {
    echo "</td>";
    }
  else if($name=="SERVER")  
    {
    echo "</tr></table>";
    }
  else if(in_array("FILES",$depth) and in_array("FILE",$depth) and $name=="OS")
    {
    echo "<br/>\n";
    }
    
  array_pop($depth);
  }


function menu_startElement($parser, $name, $attrs) 
  {
  global $depth, $content;
  
  if(in_array("WEBSITE",$depth) and in_array("MENU",$depth) and $name=="ENTRY")
    {
    $len=strlen($attrs["NAME"]);
    $len=$len>6?$len:6;
    echo "<td width=\"".$len."%\" align=\"center\"><a href=\"".$attrs["URL"]."\" class=\"navi\"><b>".$attrs["NAME"]."</b></a></td><td width=\"10\"/>\n";
    }
    
  array_push($depth, $name);
  $content[$name]=$attrs;
  }

function menu_charData($parser, $data)
  {
  }

function menu_endElement($parser, $name) 
  {
  global $depth, $content;

  array_pop($depth);
  unset($content[$name]);
  }

function news_startElement($parser, $name, $attrs) 
  {
  global $depth, $content, $renderAllNews, $renderNewsRemaining;
 
  if(!$renderAllNews and $renderNewsRemaining==0)
    {
    return;
    }

  array_push($depth, $name);
  $content[$name]=$attrs;

  if($name=="ITEM")
    {
    echo "<table width=\"100%\"><tr><td>";
    }
  else if(in_array("ITEM",$depth) and in_array("IMAGES",$depth) and $name=="IMAGE")
    {
    echo "<img src=\"".$attrs["URL"]."\" alt=\"Image related to the news item\" align=\"right\" border=\"1\">";
    }
  }

function news_charData($parser, $data)
  {
  global $depth, $content, $renderAllNews, $renderNewsRemaining;
  
  if(!$renderAllNews and $renderNewsRemaining==0)
    {
    return;
    }

  if(in_array("ITEM",$depth) and in_array("TITLE",$depth))
    {
    echo "<table width=\"100%\"><tr>\n<td><b>".$data."</b></td>\n";
    }      
  else if(in_array("ITEM",$depth) and in_array("DATE",$depth))
    {
    echo "<td align=\"right\"><font color=\"#000066\">".$data."</font></td>\n</tr></table>\n";
    }
  else if(in_array("ITEM",$depth) and in_array("CONTENT",$depth))
    {
    echo $data;
    }
  }

function news_endElement($parser, $name) 
  {
  global $depth, $content, $renderAllNews, $renderNewsRemaining;
  
  if(!$renderAllNews and $renderNewsRemaining==0)
    {
    return;
    }
  
  if($name=="ITEM")
    {
    $renderNewsRemaining--;    
    echo "</td></tr></table><p>\n";
    }    

  array_pop($depth);
  unset($content[$name]);
  }











/** *private* function to parse a XML file using SAX method. */
function parseXMLFile($file, $startElementFunc, $endElementFunc, $charDataFunc)
  {
  global $depth, $content;
  
  $depth = array();
  $content= array();

  $xml_parser = xml_parser_create();

  xml_set_element_handler($xml_parser, $startElementFunc, $endElementFunc);
  xml_set_character_data_handler($xml_parser, $charDataFunc);

  if(!($fp = fopen($file, "r"))) 
    {
    die("could not open XML input");
    }

  while ($data = fread($fp, 4096)) 
    {
    if (!xml_parse($xml_parser, $data, feof($fp))) 
      {
      die(sprintf("XML error: %s at line %d",
                   xml_error_string(xml_get_error_code($xml_parser)),
                   xml_get_current_line_number($xml_parser)));
      }
    }

  xml_parser_free($xml_parser);
  }

/** This function will render the XML game file into a Game webpage as http://arianne.sourceforge.net/?arianne_url=games/game_stendhal */
function renderGameXML($file)
  {
  parseXMLFile($file,"game_startElement","game_endElement","game_charData");
  }

/** This function will render the XML server file into a Server webpage as http://arianne.sourceforge.net/?arianne_url=servers/server_marauroa */
function renderServerXML()
  {
  parseXMLFile("xml/server_marauroa.xml","server_startElement","server_endElement","server_charData");
  }

/** This function will render the Games box at main page */
function renderGamesListXML()
  {
  $gameList=array();
  $handle=opendir("xml/");
  
  while (false !== ($file = readdir($handle)))
    {
    if($file=='.'||$file=='..') continue;
    if(!is_dir("xml/".$file))
      {
      if(strpos($file,"game_")!==false)
        {
        $gameList[]=$file;
        }
      }
    }
  closedir($handle);

  foreach($gameList as $file)
    {
    parseXMLFile("xml/".$file,"gameBrief_startElement","gameBrief_endElement","gameBrief_charData");
    }  
  }

/** This function will render a Games webpage like http://arianne.sourceforge.net/?arianne_url=content/games */
function renderGamesDefinitionListXML()
  {
  $gameList=array();
  $handle=opendir("xml/");
  
  while (false !== ($file = readdir($handle)))
    {
    if($file=='.'||$file=='..') continue;
    if(!is_dir("xml/".$file))
      {
      if(strpos($file,"game_")!==false)
        {
        $gameList[]=$file;
        }
      }
    }
  closedir($handle);

  foreach($gameList as $file)
    {
    parseXMLFile("xml/".$file,"gameDefBrief_startElement","gameDefBrief_endElement","gameDefBrief_charData");
    }  
  }

/** This function renders the Download section related to games */
function renderGameDownloadsXML()
  {
  $gameList=array();
  $handle=opendir("xml/");
  
  while (false !== ($file = readdir($handle)))
    {
    if($file=='.'||$file=='..') continue;
    if(!is_dir("xml/".$file))
      {
      if(strpos($file,"game_")!==false)
        {
        $gameList[]=$file;
        }
      }
    }
  closedir($handle);

  foreach($gameList as $file)
    {
    parseXMLFile("xml/".$file,"gameDownload_startElement","gameDownload_endElement","gameDownload_charData");
    }  
  }

/** This function renders the Download section related to games */
function renderServerDownloadsXML()
  {
  $gameList=array();
  $handle=opendir("xml/");
  
  while (false !== ($file = readdir($handle)))
    {
    if($file=='.'||$file=='..') continue;
    if(!is_dir("xml/".$file))
      {
      if(strpos($file,"server_")!==false)
        {
        $gameList[]=$file;
        }
      }
    }
  closedir($handle);

  foreach($gameList as $file)
    {
    parseXMLFile("xml/".$file,"serverDownload_startElement","serverDownload_endElement","serverDownload_charData");
    }  
  }
  
/** This function renders the Download section related to client */
function renderClientDownloadsXML()
  {
  $gameList=array();
  $handle=opendir("xml/");
  
  while (false !== ($file = readdir($handle)))
    {
    if($file=='.'||$file=='..') continue;
    if(!is_dir("xml/".$file))
      {
      if(strpos($file,"client_")!==false)
        {
        $gameList[]=$file;
        }
      }
    }
  closedir($handle);

  foreach($gameList as $file)
    {
    parseXMLFile("xml/".$file,"serverDownload_startElement","serverDownload_endElement","serverDownload_charData");
    }  
  }

/** This function renders the Menu on the upper side that appears on all the webpages. */
function renderMenuXML()
  {
  parseXMLFile("xml/website_menu.xml","menu_startElement","menu_endElement","menu_charData");
  }
  
$renderAllNews=false;
$renderNewsRemaining=5;
  
/** This function renders the News main page */
function renderNewsXML($render_all)
  {
  global $renderAllNews, $renderNewsRemaining;
  
  $renderAllNews=$render_all;
  $renderNewsRemaining=5;
  parseXMLFile("xml/website_news.xml","news_startElement","news_endElement","news_charData");
  }
?>