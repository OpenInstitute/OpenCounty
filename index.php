<?php require('./Includefiles/conn.inc'); ?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Open Institute | Open County</title>

    <!-- Bootstrap -->
    <link href="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css" rel="stylesheet">
    <link type="text/css" rel="stylesheet" href="http://fonts.googleapis.com/css?family=Lato:400,700|Raleway:400,500,700|Roboto:400,700">
    <link href="css/font-awesome.min.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
    <link href="css/bullet.css" rel="stylesheet">
    <link href="css/chart.css" rel="stylesheet">
    <link href="css/home.css" rel="stylesheet">

    <link href='http://fonts.googleapis.com/css?family=Lato:400,300,700,900,400italic|Roboto:400,300,500,700' rel='stylesheet' type='text/css'>

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesnt work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <body>
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

    <!-- Hero -->
    <div class="hero">
      <div class="container">
        <h1>Welcome to the Open County Dashboard</h1>
	<?php 
	$query_Contents_ =mysql_query("SELECT  (SUM(NetEst_1)*1000000) as Exp, (SUM(ExchIssues_1)*1000000) as Alloc FROM nationalexpenditure WHERE used =1 ");
	$row_Contents_=mysql_fetch_assoc($query_Contents_);
	?>
        <div class="stats">
          <h2><small class="spent"><?php echo number_format($row_Contents_['Alloc'],2);?></small><small class="unit">KES</small> of the allocated <small class="allocated"><?php echo number_format($row_Contents_['Exp'],2);?></small><small class="unit">KES</small></h2>
        </div>

        <div class="highlights">
          <h3><small class="desc">has been spent in the</small> 16 <small>counties present in Open County</small></h3>
        </div>

        <div class="navigation">
          <h2 class="heading">Find out what your county is accomplishing.</h2>
		  <form name="toPerform" action="perfomance.php" method="get" id="toPerform">
          <div class="options">
            
            <div class="dropdown">
                <select class="btn btn-default dropdown-toggle" type="button" name="countyid" id="county" data-toggle="dropdown">
                	<option value="">Choose a Government</option>
                	<option value="0">National</option>
                  <?php
                    $query_Contents_2 =mysql_query("SELECT DISTINCT county.id , county.countyname, '0' as Val FROM county INNER JOIN  Department ON county.id = Department.countyid WHERE county.viewed =1");

                    while ($row_Contents_2=mysql_fetch_array($query_Contents_2)) {
                      $cid = $row_Contents_2['id'];
                  ?>
                   	<option class="level1" value="<?php echo $row_Contents_2['id'];?>"><?php echo $row_Contents_2['countyname']; ?></option>
                  <?php  } ?>
                </select>
            </div>

            <div class="dropdown">
              <select class="btn btn-default dropdown-toggle" type="button" name="mwaka" id="mwaka" data-toggle="dropdown">
                <option value="">Reporting Year</option>
                <option>2013</option>
	              </select>
            </div>

            <button type="button" class="btn btn-default btn-go" id="submit"> Go
              <span class="glyphicon glyphicon-play"></span>
            </button>
          </div>
          </form>
        </div>
      </div>
    </div>
    <!-- End of hero -->
	<div id="partners" class="row">
		
		<div id="partner-logos">
		<h1>Launched in partnership with</h1>
			<a href="http://www.worldbank.org/" target="blank" class="col-lg-12 col-md-12 col-sm-12">
				<img class="img-responsive" style="max-height:100px !important" src="img/wb.png">
			</a>
			
		</div>
	</div>
    <!-- Footer -->
    <div class="footer">
      <div class="footer-nav">
        <div class="container">
          <div class="row">
            <div class="col-md-4 about">
              <h4>Open County</h4>
              <p>Open Institute is working to develop Open County Dashboards that seek to publish county level open data - especially that which relates to progress and development at county level. The purpose of the Open County Dashboard is to strengthen the county governments’ efforts to be transparent and accountable to their citizens.</p>

              <div class="contacts">
                <ul>
                  <li>
                    <i class="fa fa-map-marker"></i>Kaya I/O, Shikunga, South B
                  </li>
                  <li>
                    <i class="fa fa-phone"></i>+254 020 5231480 
                  </li>
                  <li>
                    <i class="fa fa-envelope-o"></i>hello@openinstitute.com
                  </li>

                </ul>
              </div>
            </div>
            <div class="col-md-4 menu">
              <h4 class="footermenu">Learn More</h4>
                <ul class="footer-menu">
                    <li>
                    <a href="http://www.opencounty.org/public-participation/">Pubic Participation</a>
                    </li>
                    <li>
                    <a href="http://www.opencounty.org/building-frameworks/">Building Frameworks</a>
                    </li>
                    <li>
                    <a href="http://www.opencounty.org/building-capacity/">Building Capacity</a>
                    </li>
                    
                  </ul>
            </div>
            <div class="col-md-4 ">
              <h4>Newsletter</h4>
              <p class="social">Subscribe to our newsletter to stay up to date...
              
              </p>
              <form>
                <div class="row" style="padding-top: 10px;">
                  <div class="col-md-8">
                    <input type="text" placeholder="Enter Email" class="input placeholder">
                  </div>
                  <div class="col-md-4 submit">
                    <a href="#" class="Button">Submit</a>
                  </div>

              </form>
                <div class="socialicons">
                <a href="http://facebook.com/theopeninstitute">
                  <img src="img/facebook.png">
                </a>
                <a href="http://twitter.com/open_institute">
                <img src="img/twitter.png">
                </a>
                <a href="http://plus.google.com/+OpenInstitute">
                <img src="img/google.png">
                </a>
                <a href="https://github.com/OpenInstitute/OpenCounty">
                  <img src="img/github_icon.png">
                </a>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

      <!-- Attribution -->
      <div class="attribution">
        <div class="container">
          <div class="row">
            <div class="col-md-8">
              <p>
                <img class="license" alt="Creative Commons License" style="border-width:0" src="http://i.creativecommons.org/l/by/4.0/80x15.png">
                Open County Initiative by Open Institute is licensed under a Creative Commons Attribution 4.0 International License
              </p>
            </div>
            <div class="col-md-4 built">
              <p>Built by <a href="http://openinstitute.com">Open Institute</a></p>
            </div>
          </div>
      </div>
    <!-- End of Footer -->
     <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
     <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
    <script type="text/javascript">
   $("#submit").click(function(){
       var cid = $("#county").val();
       var mwaka = $("#mwaka").val();
      if (cid!="") {
          window.location.href='performance.php?cid=' + cid;
      }
    });
  
     </script>   
  </body>
</html>
