<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" dir="ltr" lang="en">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<?php
	require_once("rsslib.php");
?>

<title>Demo of loading an RSS feed and displaying it into the same page</title></head>

	
<body bgcolor="#FFFFFF">
<h1>RSS Feed Load and Display</h1>
<hr>
<p>This demo loads a remote RSS feed and displays the content below.<br>
  It makes use of PHP and the rsslib.php library to extract and display the information.</p>
<p> Type the URL of an RSS file: </p>
<FORM name="rss" method="POST" action="rss-single.php">
<p>
	<INPUT type="submit" value="Submit">
</p>
  <p> 
    <input type="text" name="dyn" size="48" value="http://www.scriptol.com/rss.xml">
  </p>
</FORM><?php

if (isset( $_POST ))
	$posted= &$_POST ;			
else
	$posted= &$HTTP_POST_VARS ;	


if($posted!= false && count($posted) > 0)
{	
	$url= $posted["dyn"];
	if($url != false)
	{
		echo RSS_Display($url, 15);
	}
}
?>




</body>
</html>
