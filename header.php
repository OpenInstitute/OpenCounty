<?php require('./Includefiles/conn.inc'); ?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" /> 
    <meta http-equiv="Designers" content="Benjamin Charagu, Open Institute">
    <meta http-equiv="Company" content="Open County">
    <meta http-equiv="Company Email" content="hello@openinstitute.com : www.opencounty.org">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Open County | Open Institute</title>

    <!-- Bootstrap -->
    <link href="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css" rel="stylesheet">
    <link type="text/css" rel="stylesheet" href="http://fonts.googleapis.com/css?family=Lato:400,700|Raleway:400,500,700|Roboto:400,700">
    <link href="css/font-awesome.min.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
    <link href="css/bullet.css" rel="stylesheet">
    <link href="css/chart.css" rel="stylesheet">
    <link href="css/home.css" rel="stylesheet">
    <link href="css/charticons.css" rel="stylesheet">
    <link href="Includefiles/rss-style.css" rel="stylesheet">
    <link type="text/css" rel="stylesheet" href="css/nv.d3.css" />
    <link href="css/bootstrap/css/bootstrap.css" rel="stylesheet" />
    <link href="http://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.5.4/bootstrap-select.min.css" rel="stylesheet" />
    <link href="favicon.gif" rel="shortcut icon"/>

    <script src="js/vendor/jquery.js"></script>
    <script src="js/angular.js"></script>
    <script src="js/d3.js"></script>
    <script src="js/nv.d3.js"></script>
    <script src="js/angularjs-nvd3-directives.js"></script>
    <script src="http://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.5.4/bootstrap-select.js" />

    <script>
      (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
      (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
      m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
      })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

      ga('create', 'UA-34157316-13', 'auto');
      ga('send', 'pageview');

    </script>

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesnt work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>

  <body>
    <!-- Top Title -->
    <!-- <div class="top title">
      <div class="container">
        <div class="row">
          <div class="col-md-4">
            <p class="welcome">
              <?php
                if ((int)$_SESSION['userid']>=1) { 
                  $query_Contents0 = sprintf("select  * from _adminuser where userid = " . $_SESSION['userid'] );
                  $Contents0 = mysql_query($query_Contents0, $conn) or die(mysql_error());
                  $row_Contents0 = mysql_fetch_assoc($Contents0);
                  echo "Welcome <b>".$row_Contents0['fname']."</b>";
                  echo "<form action='session.php' method='post'>
                          <input type='hidden' value='logoff' name='formname'/>
                          <input name='Submit' type='submit' value='Log off' id='button' class='button />
                        </form>'";
                } else {
                  echo "<a href='./admin'>Log in</a>";
                } 
              ?>
            </p>
          </div>
          <div class="col-md-8 contacts">
            <p>
              <i class="fa fa-phone"></i>
              <span class="number">+254 (0) 20 5231480</span>
              <i class="fa fa-envelope-o"></i>
              <a href="mailto: hello@openinstitute.com">hello@openinstitute.com</a>
            </p>
          </div>
        </div>
      </div>
    </div> -->
    <!-- //End of Top Title -->

    <!-- Banner -->
    <div class="banner">
      <div class="container">
        <div class="row">
          <div class="col-md-4">
            <a href="/">
              <img src="img/logo.jpg" class="logo" alt="Open Institute" />
            </a>
          </div>

          <div class="col-md-8 search">
            <form class="form-inline" role="form">
              <div class="form-group has-feedback">
                <input type="text" class="form-control term" placeholder="Search Open County" id="search-term" />
                <span class="glyphicon glyphicon-search form-control-feedback"></span>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
    <!-- //End of Banner -->