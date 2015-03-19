<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" dir="ltr" lang="en">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<?php
	require_once("rsslib.php");
?>

<title>How to display an RSS feed into a separate web page</title></head>

	
<body bgcolor="#FFFFFF">
<h1>RSS Demo - Load a Feed Into Another Page</h1>
<hr>
<p>This demo loads an RSS feed and gives the content as parameter to another web 
  page. <br>
  The other page makes use of PHP and rsslib.php to display the content.</p>
<p> Type the URL of an RSS file: </p>
<FORM name="rss" method="POST" action="rss-display.php">
<p>
	<INPUT type="submit" value="Submit">
</p>
<p>
	
    <input type="text" name="dyn" size="32" value="http://www.scriptol.com/rss.xml">
</p>

</FORM>


</body>
</html>
