<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" dir="ltr" lang="en">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>Demo of RSS 2.0 feed cached</title></head>
<link type="text/css" href="rss-style.css" rel="stylesheet">
	
<body bgcolor="#FFFFFF">


<fieldset class="rsslib">
<?php
$cachename = "rss-cache-tmp.php";
$url = "http://www.scriptol.com/rss.xml"; 
if(file_exists($cachename))
{
  $now = date("G");
  $time = date("G", filemtime($cachename));
  if($time == $now)
  {
     include($cachename);
     exit();
  }
}
require_once("rsslib.php");
$cache = RSS_Display($url, 15, false, true);
file_put_contents($cachename, $cache);
echo $cache;
?>
</fieldset>


</body>
</html>
