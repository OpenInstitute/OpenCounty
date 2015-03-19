<?php require('./Includefiles/header.php'); ?>
<style type="text/css">
  p.error{ color:red;}
  .success{ color: green;
          border:2px solid green;}
</style>

<?php 



/*
$name = $_POST["name"];
$email = $_POST["email"];
$subject = $_POST["subject"];
$comment = $_POST["comment"];






/*
$to = "kevinkavaiw@gmail.com";
$headers = "MIME-Version: 1.0\n" ;
$headers .= "Content-Type: text/html; charset=\"iso-8859-1\"\n";
$headers .= "From: ". $name . "Email: ". $email ."\r\n";
$headers .= "Sensitivity: Personal\n";
$headers .= "Cc: hello@openinstitute.com";
*/





  //mail($to, $subject, $message, $headers);



?>

    <!-- Main Menu  -->
    <div class="main menu">
      <div class="container">
        <nav class="navbar navbar-default" role="navigation">
          <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav">
              <li class="#"><a href="index.php">Home</a></li>
              <li class="divider"></li>
              <li class="#"><a href="performance.php">Allocations and Performance</a></li>
              <li class="divider"></li>
              <li class="#"><a href="http://opencounty.org">About Open County</a></li>
              <li class="divider"></li>
              <li class="active"><a href="contact.php">Contacts</a></li>
              <li class="divider"></li>
              <li><a href="#">Login</a></li>
              <li class="divider"></li>
            </ul>   
          </div>
        </nav>
      </div>
    </div>
    <!-- //End of Main Menu -->

    <!-- Main Content -->
    <div class="main">
      <div class="container fnt" style="padding: 3rem 0">
        <div class="col-md-4">
          <h2>Talk to us</h2>
          <p>Please fill out the contact form below and we will be in touch as soon as we can:</p>
          <div class="col-md-12 error"></div>
          <?php
          if (!isset($_POST["submit"])) { ?>
          <form action="<?php echo $_SERVER["PHP_SELF"];?>" method="post">
            <p>
              <label for="name" id="name">Name</label><br>
              <input type="text" id="name" name="name"  size="40" placeholder="Enter your name here (required)" required/>
              <p class="error"><?php echo $nameErr;?></p>
            </p>
            <p>
              <label for="email" id="email">E-mail</label><br>
              <input type="email" id="email" name="email" size="40" placeholder="Enter your email here (required)" required/><br>
              <p class="error"><?php echo $emailErr;?></p>
            </p>
            <p>
              <label for="subject" id="subject">Subject</label><br>
              <input type="text" id="subject" name="subject" size="40" placeholder="Enter Subject"/><br>

            </p>
            <p>
              <label for="comment" id="comment">Message</label><br>
              <textarea  id="comment" name="comment" placeholder="Feel free to share your experience with Open County" cols="42" rows="7"></textarea>
            </p>
            <div class="col-md-12">
              <div class="col-md-6">
                <input type="submit" name="submit" size="20" value="Submit" id="cont-submit"/>
              </div>
              <div class="col-md-6">
                <input type="reset" name="reset" value="Clear" id="reset"/>
              </div>
            </div>        
          </form>
          <?php }
          else{

            if (empty($_POST["name"])) {
              $nameErr = "Invalid. Name cannot be blank";
            } else {
              $name = $_POST["name"];
            }

            if (empty($_POST["email"])) {
              $emailErr = "Invalid email address. Email field is required";
            } else {
              $email = $_POST["name"];
            }

            if (empty($_POST["subject"])) {
              $subErr = "";
            } else {
              $subject = $_POST["subject"];
            }

            if (empty($_POST["comment"])) {
              $commentErr = "";
            } else {
              $comment = $_POST["comment"];
            }
            
           

            $comment .= "\r\n". "<br><br>";
            $comment .= "From: ". $name;

            $comment = wordwrap($comment, 70, "\r\n");

            $to = "hello@openinstitute.com";
            $headers = "MIME-Version: 1.0\n" ;
            $headers .= "Content-Type: text/html; charset=\"iso-8859-1\"\n";
            $headers .= "From: ". $email ."\r\n";
            //$headers .= "Sensitivity: Personal\n";
            //$headers .= "Cc: hello@openinstitute.com" ;

            mail($to, $subject, $comment, $headers);
            echo "<div class=\"success col-md-12\">"."Hi ".$name.", Thank you for the feedback, we will get in touch shortly!"."</div>";
            
          } 
            ?>
        </div>
        
        <div class="col-md-8 mama">
          <div class="col-md-12 cont">
           <h2>Open Institute</h2>
            <p>
              <i class="fa fa-map-marker"></i> &nbsp;&nbsp;&nbsp; Kaya I/O<br> &nbsp; &nbsp;&nbsp;&nbsp;&nbsp; Shikunga Road, South B<br> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; P.O. Box 76203 – 00508 Nairobi, Kenya<br>
              <i class="fa fa-phone"></i> &nbsp; +254 (0)20 523 1480<br>
              <i class="fa fa-envelope-o"></i> &nbsp; <a href="mailto:hello@openinstitute.com">hello@openinstitute.com</a><br>
              <i class="fa fa-link"></i> &nbsp; <a href="http://openinstitute.com" target="_blank">www.openinstitute.com</a>
            </p>
          </div>
          <div class="col-md-12 map">
            <h2>Map</h2>
            <!--maps begin here-->
            <div class="st-gmap" id="gmap_53fdce1e7713a" style="max-width: 100%; height: 350px; padding-bottom:2%; position: relative; overflow: hidden; -webkit-transform: translateZ(0px); background-color: rgb(229, 227, 223);"><div class="gm-style" style="position: absolute; left: 0px; top: 0px; overflow: hidden; width: 100%; height: 100%; z-index: 0;"><div style="position: absolute; left: 0px; top: 0px; overflow: hidden; width: 100%; height: 100%; z-index: 0; cursor: url(https://maps.gstatic.com/mapfiles/openhand_8_8.cur) 8 8, default;"><div style="position: absolute; left: 0px; top: 0px; z-index: 1; width: 100%; transform-origin: 0px 0px 0px; transform: matrix(1, 0, 0, 1, 0, 0);"><div style="-webkit-transform: translateZ(0px); position: absolute; left: 0px; top: 0px; z-index: 100; width: 100%;"><div style="position: absolute; left: 0px; top: 0px; z-index: 0;"><div style="position: absolute; left: 0px; top: 0px; z-index: 1;"><div style="width: 256px; height: 256px; -webkit-transform: translateZ(0px); position: absolute; left: -65px; top: 77px;"></div><div style="width: 256px; height: 256px; -webkit-transform: translateZ(0px); position: absolute; left: 191px; top: 77px;"></div><div style="width: 256px; height: 256px; -webkit-transform: translateZ(0px); position: absolute; left: -65px; top: -179px;"></div><div style="width: 256px; height: 256px; -webkit-transform: translateZ(0px); position: absolute; left: -65px; top: 333px;"></div><div style="width: 256px; height: 256px; -webkit-transform: translateZ(0px); position: absolute; left: 191px; top: -179px;"></div><div style="width: 256px; height: 256px; -webkit-transform: translateZ(0px); position: absolute; left: 191px; top: 333px;"></div><div style="width: 256px; height: 256px; -webkit-transform: translateZ(0px); position: absolute; left: 447px; top: 77px;"></div><div style="width: 256px; height: 256px; -webkit-transform: translateZ(0px); position: absolute; left: 447px; top: -179px;"></div><div style="width: 256px; height: 256px; -webkit-transform: translateZ(0px); position: absolute; left: 447px; top: 333px;"></div><div style="width: 256px; height: 256px; -webkit-transform: translateZ(0px); position: absolute; left: 703px; top: 77px;"></div><div style="width: 256px; height: 256px; -webkit-transform: translateZ(0px); position: absolute; left: 703px; top: -179px;"></div><div style="width: 256px; height: 256px; -webkit-transform: translateZ(0px); position: absolute; left: 703px; top: 333px;"></div></div></div></div><div style="-webkit-transform: translateZ(0px); position: absolute; left: 0px; top: 0px; z-index: 101; width: 100%;"></div><div style="-webkit-transform: translateZ(0px); position: absolute; left: 0px; top: 0px; z-index: 102; width: 100%;"></div><div style="-webkit-transform: translateZ(0px); position: absolute; left: 0px; top: 0px; z-index: 103; width: 100%;"><div style="position: absolute; left: 0px; top: 0px; z-index: -1;"><div style="position: absolute; left: 0px; top: 0px; z-index: 1;"><div style="width: 256px; height: 256px; overflow: hidden; -webkit-transform: translateZ(0px); position: absolute; left: -65px; top: 77px;"><canvas draggable="false" height="256" width="256" style="-webkit-user-select: none; position: absolute; left: 0px; top: 0px; height: 256px; width: 256px;"></canvas></div><div style="width: 256px; height: 256px; overflow: hidden; -webkit-transform: translateZ(0px); position: absolute; left: 191px; top: 77px;"></div><div style="width: 256px; height: 256px; overflow: hidden; -webkit-transform: translateZ(0px); position: absolute; left: -65px; top: -179px;"></div><div style="width: 256px; height: 256px; overflow: hidden; -webkit-transform: translateZ(0px); position: absolute; left: -65px; top: 333px;"></div><div style="width: 256px; height: 256px; overflow: hidden; -webkit-transform: translateZ(0px); position: absolute; left: 191px; top: -179px;"></div><div style="width: 256px; height: 256px; overflow: hidden; -webkit-transform: translateZ(0px); position: absolute; left: 191px; top: 333px;"></div><div style="width: 256px; height: 256px; overflow: hidden; -webkit-transform: translateZ(0px); position: absolute; left: 447px; top: 77px;"></div><div style="width: 256px; height: 256px; overflow: hidden; -webkit-transform: translateZ(0px); position: absolute; left: 447px; top: -179px;"></div><div style="width: 256px; height: 256px; overflow: hidden; -webkit-transform: translateZ(0px); position: absolute; left: 447px; top: 333px;"></div><div style="width: 256px; height: 256px; overflow: hidden; -webkit-transform: translateZ(0px); position: absolute; left: 703px; top: 77px;"></div><div style="width: 256px; height: 256px; overflow: hidden; -webkit-transform: translateZ(0px); position: absolute; left: 703px; top: -179px;"></div><div style="width: 256px; height: 256px; overflow: hidden; -webkit-transform: translateZ(0px); position: absolute; left: 703px; top: 333px;"></div></div></div></div><div style="position: absolute; z-index: 0; left: 0px; top: 0px;"><div style="overflow: hidden; width: 341px; height: 400px;"><img src="https://maps.googleapis.com/maps/api/js/StaticMapService.GetMapImage?1m2&amp;1i2526017&amp;2i2112179&amp;2e1&amp;3u14&amp;4m2&amp;1u341&amp;2u400&amp;5m5&amp;1e0&amp;5sen-US&amp;6sus&amp;10b1&amp;12b1&amp;token=3297" style="width: 341px; height: 400px;"></div></div><div style="position: absolute; left: 0px; top: 0px; z-index: 0;"><div style="position: absolute; left: 0px; top: 0px; z-index: 1;"><div style="width: 256px; height: 256px; -webkit-transform: translateZ(0px); position: absolute; left: -65px; top: 77px; opacity: 1; transition: opacity 200ms ease-out; -webkit-transition: opacity 200ms ease-out;"><img src="https://mts1.googleapis.com/vt?pb=!1m4!1m3!1i14!2i9867!3i8251!2m3!1e0!2sm!3i271411114!3m9!2sen-US!3sUS!5e18!12m1!1e47!12m3!1e37!2m1!1ssmartmaps!4e0" draggable="false" style="width: 256px; height: 256px; -webkit-user-select: none; border: 0px; padding: 0px; margin: 0px; -webkit-transform: translateZ(0px);"></div><div style="width: 256px; height: 256px; -webkit-transform: translateZ(0px); position: absolute; left: 191px; top: 77px; opacity: 1; transition: opacity 200ms ease-out; -webkit-transition: opacity 200ms ease-out;"><img src="https://mts0.googleapis.com/vt?pb=!1m4!1m3!1i14!2i9868!3i8251!2m3!1e0!2sm!3i271419285!3m9!2sen-US!3sUS!5e18!12m1!1e47!12m3!1e37!2m1!1ssmartmaps!4e0" draggable="false" style="width: 256px; height: 256px; -webkit-user-select: none; border: 0px; padding: 0px; margin: 0px; -webkit-transform: translateZ(0px);"></div><div style="width: 256px; height: 256px; -webkit-transform: translateZ(0px); position: absolute; left: -65px; top: -179px; opacity: 1; transition: opacity 200ms ease-out; -webkit-transition: opacity 200ms ease-out;"><img src="https://mts1.googleapis.com/vt?pb=!1m4!1m3!1i14!2i9867!3i8250!2m3!1e0!2sm!3i271411748!3m9!2sen-US!3sUS!5e18!12m1!1e47!12m3!1e37!2m1!1ssmartmaps!4e0" draggable="false" style="width: 256px; height: 256px; -webkit-user-select: none; border: 0px; padding: 0px; margin: 0px; -webkit-transform: translateZ(0px);"></div><div style="width: 256px; height: 256px; -webkit-transform: translateZ(0px); position: absolute; left: -65px; top: 333px;"><img src="https://mts1.googleapis.com/vt?pb=!1m4!1m3!1i14!2i9867!3i8252!2m3!1e0!2sm!3i271000000!3m9!2sen-US!3sUS!5e18!12m1!1e47!12m3!1e37!2m1!1ssmartmaps!4e0" draggable="false" style="width: 256px; height: 256px; -webkit-user-select: none; border: 0px; padding: 0px; margin: 0px; -webkit-transform: translateZ(0px);"></div><div style="width: 256px; height: 256px; -webkit-transform: translateZ(0px); position: absolute; left: 191px; top: -179px; opacity: 1; transition: opacity 200ms ease-out; -webkit-transition: opacity 200ms ease-out;"><img src="https://mts0.googleapis.com/vt?pb=!1m4!1m3!1i14!2i9868!3i8250!2m3!1e0!2sm!3i271290612!3m9!2sen-US!3sUS!5e18!12m1!1e47!12m3!1e37!2m1!1ssmartmaps!4e0" draggable="false" style="width: 256px; height: 256px; -webkit-user-select: none; border: 0px; padding: 0px; margin: 0px; -webkit-transform: translateZ(0px);"></div><div style="width: 256px; height: 256px; -webkit-transform: translateZ(0px); position: absolute; left: 191px; top: 333px; opacity: 1; transition: opacity 200ms ease-out; -webkit-transition: opacity 200ms ease-out;"><img src="https://mts0.googleapis.com/vt?pb=!1m4!1m3!1i14!2i9868!3i8252!2m3!1e0!2sm!3i271419285!3m9!2sen-US!3sUS!5e18!12m1!1e47!12m3!1e37!2m1!1ssmartmaps!4e0" draggable="false" style="width: 256px; height: 256px; -webkit-user-select: none; border: 0px; padding: 0px; margin: 0px; -webkit-transform: translateZ(0px);"></div><div style="width: 256px; height: 256px; -webkit-transform: translateZ(0px); position: absolute; left: 447px; top: 77px; opacity: 1; transition: opacity 200ms ease-out; -webkit-transition: opacity 200ms ease-out;"><img src="https://mts1.googleapis.com/vt?pb=!1m4!1m3!1i14!2i9869!3i8251!2m3!1e0!2sm!3i271453558!3m9!2sen-US!3sUS!5e18!12m1!1e47!12m3!1e37!2m1!1ssmartmaps!4e0" draggable="false" style="width: 256px; height: 256px; -webkit-user-select: none; border: 0px; padding: 0px; margin: 0px; -webkit-transform: translateZ(0px);"></div><div style="width: 256px; height: 256px; -webkit-transform: translateZ(0px); position: absolute; left: 447px; top: -179px; opacity: 1; transition: opacity 200ms ease-out; -webkit-transition: opacity 200ms ease-out;"><img src="https://mts1.googleapis.com/vt?pb=!1m4!1m3!1i14!2i9869!3i8250!2m3!1e0!2sm!3i271000000!3m9!2sen-US!3sUS!5e18!12m1!1e47!12m3!1e37!2m1!1ssmartmaps!4e0" draggable="false" style="width: 256px; height: 256px; -webkit-user-select: none; border: 0px; padding: 0px; margin: 0px; -webkit-transform: translateZ(0px);"></div><div style="width: 256px; height: 256px; -webkit-transform: translateZ(0px); position: absolute; left: 447px; top: 333px; opacity: 1; transition: opacity 200ms ease-out; -webkit-transition: opacity 200ms ease-out;"><img src="https://mts1.googleapis.com/vt?pb=!1m4!1m3!1i14!2i9869!3i8252!2m3!1e0!2sm!3i271453558!3m9!2sen-US!3sUS!5e18!12m1!1e47!12m3!1e37!2m1!1ssmartmaps!4e0" draggable="false" style="width: 256px; height: 256px; -webkit-user-select: none; border: 0px; padding: 0px; margin: 0px; -webkit-transform: translateZ(0px);"></div><div style="width: 256px; height: 256px; -webkit-transform: translateZ(0px); position: absolute; left: 703px; top: -179px; opacity: 1; transition: opacity 200ms ease-out; -webkit-transition: opacity 200ms ease-out;"><img src="https://mts0.googleapis.com/vt?pb=!1m4!1m3!1i14!2i9870!3i8250!2m3!1e0!2sm!3i271125334!3m9!2sen-US!3sUS!5e18!12m1!1e47!12m3!1e37!2m1!1ssmartmaps!4e0" draggable="false" style="width: 256px; height: 256px; -webkit-user-select: none; border: 0px; padding: 0px; margin: 0px; -webkit-transform: translateZ(0px);"></div><div style="width: 256px; height: 256px; -webkit-transform: translateZ(0px); position: absolute; left: 703px; top: 333px; opacity: 1; transition: opacity 200ms ease-out; -webkit-transition: opacity 200ms ease-out;"><img src="https://mts0.googleapis.com/vt?pb=!1m4!1m3!1i14!2i9870!3i8252!2m3!1e0!2sm!3i271419285!3m9!2sen-US!3sUS!5e18!12m1!1e47!12m3!1e37!2m1!1ssmartmaps!4e0" draggable="false" style="width: 256px; height: 256px; -webkit-user-select: none; border: 0px; padding: 0px; margin: 0px; -webkit-transform: translateZ(0px);"></div><div style="width: 256px; height: 256px; -webkit-transform: translateZ(0px); position: absolute; left: 703px; top: 77px; opacity: 1; transition: opacity 200ms ease-out; -webkit-transition: opacity 200ms ease-out;"><img src="https://mts0.googleapis.com/vt?pb=!1m4!1m3!1i14!2i9870!3i8251!2m3!1e0!2sm!3i271000000!3m9!2sen-US!3sUS!5e18!12m1!1e47!12m3!1e37!2m1!1ssmartmaps!4e0" draggable="false" style="width: 256px; height: 256px; -webkit-user-select: none; border: 0px; padding: 0px; margin: 0px; -webkit-transform: translateZ(0px);"></div></div></div></div><div style="position: absolute; left: 0px; top: 0px; z-index: 2; width: 100%; height: 100%;"></div><div style="position: absolute; left: 0px; top: 0px; z-index: 3; width: 100%; transform-origin: 0px 0px 0px; transform: matrix(1, 0, 0, 1, 0, 0);"><div style="-webkit-transform: translateZ(0px); position: absolute; left: 0px; top: 0px; z-index: 104; width: 100%;"></div><div style="-webkit-transform: translateZ(0px); position: absolute; left: 0px; top: 0px; z-index: 105; width: 100%;"></div><div style="-webkit-transform: translateZ(0px); position: absolute; left: 0px; top: 0px; z-index: 106; width: 100%;"></div><div style="-webkit-transform: translateZ(0px); position: absolute; left: 0px; top: 0px; z-index: 107; width: 100%;"></div></div></div><div style="margin-left: 5px; margin-right: 5px; z-index: 1000000; position: absolute; left: 0px; bottom: 0px;"><a target="_blank" href="http://maps.google.com/maps?ll=-1.306873,36.847133&amp;z=14&amp;t=m&amp;hl=en-US&amp;gl=US&amp;mapclient=apiv3" title="Click to see this area on Google Maps" style="position: static; overflow: visible; float: none; display: inline;"><div style="width: 62px; height: 26px; cursor: pointer;"><img src="https://maps.gstatic.com/mapfiles/api-3/images/google_white2.png" draggable="false" style="position: absolute; left: 0px; top: 0px; width: 62px; height: 26px; -webkit-user-select: none; border: 0px; padding: 0px; margin: 0px;"></div></a></div><div class="gmnoprint" style="z-index: 1000001; position: absolute; right: 70px; bottom: 0px; width: 125px;"><div draggable="false" class="gm-style-cc" style="-webkit-user-select: none;"><div style="opacity: 0.7; width: 100%; height: 100%; position: absolute;"><div style="width: 1px;"></div><div style="width: auto; height: 100%; margin-left: 1px; background-color: rgb(245, 245, 245);"></div></div><div style="position: relative; padding-right: 6px; padding-left: 6px; font-family: Roboto, Arial, sans-serif; font-size: 10px; color: rgb(68, 68, 68); white-space: nowrap; direction: ltr; text-align: right;"><a style="color: rgb(68, 68, 68); text-decoration: none; cursor: pointer; display: none;">Map Data</a><span>Map data ©2014 Google</span></div></div></div><div style="padding: 15px 21px; border: 1px solid rgb(171, 171, 171); font-family: Roboto, Arial, sans-serif; color: rgb(34, 34, 34); -webkit-box-shadow: rgba(0, 0, 0, 0.2) 0px 4px 16px; box-shadow: rgba(0, 0, 0, 0.2) 0px 4px 16px; z-index: 10000002; display: none; width: 256px; height: 148px; position: absolute; left: 285px; top: 110px; background-color: white;"><div style="padding: 0px 0px 10px; font-size: 16px;">Map Data</div><div style="font-size: 13px;">Map data ©2014 Google</div><div style="width: 13px; height: 13px; overflow: hidden; position: absolute; opacity: 0.7; right: 12px; top: 12px; z-index: 10000; cursor: pointer;"><img src="https://maps.gstatic.com/mapfiles/api-3/images/mapcnt3.png" draggable="false" style="position: absolute; left: -2px; top: -336px; width: 59px; height: 492px; -webkit-user-select: none; border: 0px; padding: 0px; margin: 0px;"></div></div><div class="gmnoscreen" style="position: absolute; right: 0px; bottom: 0px;"><div style="font-family: Roboto, Arial, sans-serif; font-size: 11px; color: rgb(68, 68, 68); direction: ltr; text-align: right; background-color: rgb(245, 245, 245);">Map data ©2014 Google</div></div><div class="gmnoprint gm-style-cc" draggable="false" style="z-index: 1000001; position: absolute; -webkit-user-select: none; right: 0px; bottom: 0px;"><div style="opacity: 0.7; width: 100%; height: 100%; position: absolute;"><div style="width: 1px;"></div><div style="width: auto; height: 100%; margin-left: 1px; background-color: rgb(245, 245, 245);"></div></div><div style="position: relative; padding-right: 6px; padding-left: 6px; font-family: Roboto, Arial, sans-serif; font-size: 10px; color: rgb(68, 68, 68); white-space: nowrap; direction: ltr; text-align: right;"><a href="http://www.google.com/intl/en-US_US/help/terms_maps.html" target="_blank" style="text-decoration: none; cursor: pointer; color: rgb(68, 68, 68);">Terms of Use</a></div></div><div draggable="false" class="gm-style-cc" style="-webkit-user-select: none; display: none; position: absolute; right: 0px; bottom: 0px;"><div style="opacity: 0.7; width: 100%; height: 100%; position: absolute;"><div style="width: 1px;"></div><div style="width: auto; height: 100%; margin-left: 1px; background-color: rgb(245, 245, 245);"></div></div><div style="position: relative; padding-right: 6px; padding-left: 6px; font-family: Roboto, Arial, sans-serif; font-size: 10px; color: rgb(68, 68, 68); white-space: nowrap; direction: ltr; text-align: right;"><a target="_new" title="Report errors in the road map or imagery to Google" href="http://maps.google.com/maps?ll=-1.306873,36.847133&amp;z=14&amp;t=m&amp;hl=en-US&amp;gl=US&amp;mapclient=apiv3&amp;skstate=action:mps_dialog$apiref:1&amp;output=classic" style="font-family: Roboto, Arial, sans-serif; font-size: 10px; color: rgb(68, 68, 68); text-decoration: none; position: relative;">Report a map error</a></div></div><div class="gmnoprint" style="margin: 5px; z-index: 0; position: absolute; cursor: pointer; right: 0px; top: 0px;"><div class="gm-style-mtc" style="float: left;"><div draggable="false" title="Show street map" style="direction: ltr; overflow: hidden; text-align: center; position: relative; color: rgb(0, 0, 0); font-family: Roboto, Arial, sans-serif; -webkit-user-select: none; font-size: 11px; padding: 1px 6px; border-bottom-left-radius: 2px; border-top-left-radius: 2px; -webkit-background-clip: padding-box; border: 1px solid rgba(0, 0, 0, 0.14902); -webkit-box-shadow: rgba(0, 0, 0, 0.298039) 0px 1px 4px -1px; box-shadow: rgba(0, 0, 0, 0.298039) 0px 1px 4px -1px; min-width: 22px; font-weight: 500; background-color: rgb(255, 255, 255); background-clip: padding-box;">Map</div><div style="z-index: -1; padding-top: 2px; -webkit-background-clip: padding-box; border-width: 0px 1px 1px; border-right-style: solid; border-bottom-style: solid; border-left-style: solid; border-right-color: rgba(0, 0, 0, 0.14902); border-bottom-color: rgba(0, 0, 0, 0.14902); border-left-color: rgba(0, 0, 0, 0.14902); -webkit-box-shadow: rgba(0, 0, 0, 0.298039) 0px 1px 4px -1px; box-shadow: rgba(0, 0, 0, 0.298039) 0px 1px 4px -1px; position: absolute; left: 0px; top: 26px; text-align: left; display: none; background-color: white; background-clip: padding-box;"><div draggable="false" title="Show street map with terrain" style="color: rgb(0, 0, 0); font-family: Roboto, Arial, sans-serif; -webkit-user-select: none; font-size: 11px; padding: 3px 8px 3px 3px; direction: ltr; text-align: left; white-space: nowrap; background-color: rgb(255, 255, 255);"><span role="checkbox" style="box-sizing: border-box; position: relative; line-height: 0; font-size: 0px; margin: 0px 5px 0px 0px; display: inline-block; border: 1px solid rgb(198, 198, 198); border-top-left-radius: 1px; border-top-right-radius: 1px; border-bottom-right-radius: 1px; border-bottom-left-radius: 1px; width: 13px; height: 13px; vertical-align: middle; background-color: rgb(255, 255, 255);"><div style="position: absolute; left: 1px; top: -2px; width: 13px; height: 11px; overflow: hidden; display: none;"><img src="https://maps.gstatic.com/mapfiles/mv/imgs8.png" draggable="false" style="position: absolute; left: -52px; top: -44px; -webkit-user-select: none; border: 0px; padding: 0px; margin: 0px; width: 68px; height: 67px;"></div></span><label style="vertical-align: middle; cursor: pointer;">Terrain</label></div></div></div><div class="gm-style-mtc" style="float: left;"><div draggable="false" title="Show satellite imagery" style="direction: ltr; overflow: hidden; text-align: center; position: relative; color: rgb(86, 86, 86); font-family: Roboto, Arial, sans-serif; -webkit-user-select: none; font-size: 11px; padding: 1px 6px; border-bottom-right-radius: 2px; border-top-right-radius: 2px; -webkit-background-clip: padding-box; border-width: 1px 1px 1px 0px; border-top-style: solid; border-right-style: solid; border-bottom-style: solid; border-top-color: rgba(0, 0, 0, 0.14902); border-right-color: rgba(0, 0, 0, 0.14902); border-bottom-color: rgba(0, 0, 0, 0.14902); -webkit-box-shadow: rgba(0, 0, 0, 0.298039) 0px 1px 4px -1px; box-shadow: rgba(0, 0, 0, 0.298039) 0px 1px 4px -1px; min-width: 38px; background-color: rgb(255, 255, 255); background-clip: padding-box;">Satellite</div><div style="z-index: -1; padding-top: 2px; -webkit-background-clip: padding-box; border-width: 0px 1px 1px; border-right-style: solid; border-bottom-style: solid; border-left-style: solid; border-right-color: rgba(0, 0, 0, 0.14902); border-bottom-color: rgba(0, 0, 0, 0.14902); border-left-color: rgba(0, 0, 0, 0.14902); -webkit-box-shadow: rgba(0, 0, 0, 0.298039) 0px 1px 4px -1px; box-shadow: rgba(0, 0, 0, 0.298039) 0px 1px 4px -1px; position: absolute; right: 0px; top: 26px; text-align: left; display: none; background-color: white; background-clip: padding-box;"><div draggable="false" title="Zoom in to show 45 degree view" style="color: rgb(184, 184, 184); font-family: Roboto, Arial, sans-serif; -webkit-user-select: none; font-size: 11px; padding: 3px 8px 3px 3px; direction: ltr; text-align: left; white-space: nowrap; display: none; background-color: rgb(255, 255, 255);"><span role="checkbox" style="box-sizing: border-box; position: relative; line-height: 0; font-size: 0px; margin: 0px 5px 0px 0px; display: inline-block; border: 1px solid rgb(241, 241, 241); border-top-left-radius: 1px; border-top-right-radius: 1px; border-bottom-right-radius: 1px; border-bottom-left-radius: 1px; width: 13px; height: 13px; vertical-align: middle; background-color: rgb(255, 255, 255);"><div style="position: absolute; left: 1px; top: -2px; width: 13px; height: 11px; overflow: hidden; display: none;"><img src="https://maps.gstatic.com/mapfiles/mv/imgs8.png" draggable="false" style="position: absolute; left: -52px; top: -44px; -webkit-user-select: none; border: 0px; padding: 0px; margin: 0px; width: 68px; height: 67px;"></div></span><label style="vertical-align: middle; cursor: pointer;">45°</label></div><div draggable="false" title="Show imagery with street names" style="color: rgb(0, 0, 0); font-family: Roboto, Arial, sans-serif; -webkit-user-select: none; font-size: 11px; padding: 3px 8px 3px 3px; direction: ltr; text-align: left; white-space: nowrap; background-color: rgb(255, 255, 255);"><span role="checkbox" style="box-sizing: border-box; position: relative; line-height: 0; font-size: 0px; margin: 0px 5px 0px 0px; display: inline-block; border: 1px solid rgb(198, 198, 198); border-top-left-radius: 1px; border-top-right-radius: 1px; border-bottom-right-radius: 1px; border-bottom-left-radius: 1px; width: 13px; height: 13px; vertical-align: middle; background-color: rgb(255, 255, 255);"><div style="position: absolute; left: 1px; top: -2px; width: 13px; height: 11px; overflow: hidden;"><img src="https://maps.gstatic.com/mapfiles/mv/imgs8.png" draggable="false" style="position: absolute; left: -52px; top: -44px; -webkit-user-select: none; border: 0px; padding: 0px; margin: 0px; width: 68px; height: 67px;"></div></span><label style="vertical-align: middle; cursor: pointer;">Labels</label></div></div></div></div><div class="gmnoprint" draggable="false" controlwidth="32" controlheight="271" style="margin: 5px; -webkit-user-select: none; position: absolute; left: 0px; top: 0px;"><div controlwidth="32" controlheight="40" style="cursor: url(https://maps.gstatic.com/mapfiles/openhand_8_8.cur) 8 8, default; position: absolute; left: 0px; top: 0px;"><div style="width: 32px; height: 40px; overflow: hidden; position: absolute; left: 0px; top: 0px;"><img src="https://maps.gstatic.com/mapfiles/api-3/images/cb_scout2.png" draggable="false" style="position: absolute; left: -9px; top: -102px; width: 1028px; height: 214px; -webkit-user-select: none; border: 0px; padding: 0px; margin: 0px;"></div><div style="width: 32px; height: 40px; overflow: hidden; position: absolute; left: 0px; top: 0px; visibility: hidden;"><img src="https://maps.gstatic.com/mapfiles/api-3/images/cb_scout2.png" draggable="false" style="position: absolute; left: -107px; top: -102px; width: 1028px; height: 214px; -webkit-user-select: none; border: 0px; padding: 0px; margin: 0px;"></div><div style="width: 32px; height: 40px; overflow: hidden; position: absolute; left: 0px; top: 0px; visibility: hidden;"><img src="https://maps.gstatic.com/mapfiles/api-3/images/cb_scout2.png" draggable="false" style="position: absolute; left: -58px; top: -102px; width: 1028px; height: 214px; -webkit-user-select: none; border: 0px; padding: 0px; margin: 0px;"></div><div style="width: 32px; height: 40px; overflow: hidden; position: absolute; left: 0px; top: 0px; visibility: hidden;"><img src="https://maps.gstatic.com/mapfiles/api-3/images/cb_scout2.png" draggable="false" style="position: absolute; left: -205px; top: -102px; width: 1028px; height: 214px; -webkit-user-select: none; border: 0px; padding: 0px; margin: 0px;"></div></div><div class="gmnoprint" controlwidth="0" controlheight="0" style="opacity: 0.6; display: none; position: absolute;"><div title="Rotate map 90 degrees" style="width: 22px; height: 22px; overflow: hidden; position: absolute; cursor: pointer;"><img src="https://maps.gstatic.com/mapfiles/api-3/images/mapcnt3.png" draggable="false" style="position: absolute; left: -38px; top: -360px; width: 59px; height: 492px; -webkit-user-select: none; border: 0px; padding: 0px; margin: 0px;"></div></div><div class="gmnoprint" controlwidth="25" controlheight="226" style="position: absolute; left: 4px; top: 45px;"><div title="Zoom in" style="width: 23px; height: 24px; overflow: hidden; position: relative; cursor: pointer; z-index: 1;"><img src="https://maps.gstatic.com/mapfiles/api-3/images/mapcnt3.png" draggable="false" style="position: absolute; left: -17px; top: -400px; width: 59px; height: 492px; -webkit-user-select: none; border: 0px; padding: 0px; margin: 0px;"></div><div title="Click to zoom" style="width: 25px; height: 178px; overflow: hidden; position: relative; cursor: pointer; top: -4px;"><img src="https://maps.gstatic.com/mapfiles/api-3/images/mapcnt3.png" draggable="false" style="position: absolute; left: -17px; top: -87px; width: 59px; height: 492px; -webkit-user-select: none; border: 0px; padding: 0px; margin: 0px;"></div><div title="Drag to zoom" style="width: 21px; height: 14px; overflow: hidden; position: absolute; -webkit-transition: top 0.25s ease; transition: top 0.25s ease; z-index: 2; cursor: url(https://maps.gstatic.com/mapfiles/openhand_8_8.cur) 8 8, default; left: 2px; top: 76px;"><img src="https://maps.gstatic.com/mapfiles/api-3/images/mapcnt3.png" draggable="false" style="position: absolute; left: 0px; top: -384px; width: 59px; height: 492px; -webkit-user-select: none; border: 0px; padding: 0px; margin: 0px;"></div><div title="Zoom out" style="width: 23px; height: 23px; overflow: hidden; position: relative; cursor: pointer; top: -4px; z-index: 3;"><img src="https://maps.gstatic.com/mapfiles/api-3/images/mapcnt3.png" draggable="false" style="position: absolute; left: -17px; top: -361px; width: 59px; height: 492px; -webkit-user-select: none; border: 0px; padding: 0px; margin: 0px;"></div></div></div></div></div>
            <!--end of map-->
          </div>
        </div>
      </div>  
    </div>
    
    <div class="clearfix"></div>

    <!--footer goes here-->
    <?php require("./Includefiles/footer.php"); ?>
    <!--//Footer ends here-->
    </div>
  </body>
</html>

