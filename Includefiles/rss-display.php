<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" dir="ltr" lang="en">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<?php
	require_once("rsslib.php");
?>

<title>Demo of displaying of an RSS feed</title></head>

	
<body bgcolor="#FFFFFF">
<h1>RSS Display Demo </h1>
<hr>
<div id="zone" > 
  <p>Loading an RSS file and displaying the list of articles. </p>

	<?php

		if (isset( $_POST ))
			$postArray = &$_POST ;			
		else
			$postArray = &$HTTP_POST_VARS ;	

		$url= $postArray["dyn"];

		echo RSS_display($url, 10);
	?>

</div>


</body>
</html>
