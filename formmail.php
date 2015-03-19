<?php
$lname=$_POST["lname"];
$fname=$_POST["fname"];
$address=$_POST["address"];
$phone=$_POST["phone"];
$country=$_POST["country"];
$zip=$_POST["zip"];
$email=$_POST["email"];
$comments=$_POST["comments"];
$redirect=$_POST["redirect"];
$subject=$_POST["subject"];
$recipient=$_POST["recipient"];
$formname=$_POST["formname"];


if ($formname=="newsletter"){
	      $strMsg .= " Person with email :: " . $email ;
	      $strMsg .= " activated the newsletter form on the internet.";
	      mail_it($strMsg, "http://kenya.opencounty.org online feedback form","hello@openinstitute.com", $email);
	      header("location:index.php");
}


	      // mail the content we figure out in the following steps
function mail_it($content, $subject, $recipient ,$youremail) {

   //$headers .= "To: $recipient\n"; //"From: ".$email."\n"; 
   $headers = "From:".$youremail."\n"; 
   $headers .= "Reply-to:  ".$youremail." \n";
   $headers .= "Bcc: benjamin@openinstitute.com \n";
   
		$message  = $content;
//echo $message;
   mail($recipient, $subject, $message, $headers);
}

?>
