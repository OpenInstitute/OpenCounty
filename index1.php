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
    <link href="css/font-awesome.min.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
    <link href="css/bullet.css" rel="stylesheet">
    <link href="css/chart.css" rel="stylesheet">
    <link href="css/charticons.css" rel="stylesheet">
    <link type="text/css" rel="stylesheet" href="css/nv.d3.css" />

    <script src="js/angular.js"></script>
    <script src="js/d3.js"></script>
    <script src="js/nv.d3.js"></script>
    <script src="js/angularjs-nvd3-directives.js"></script>

    <script>

      var app = angular.module("nvd3TestApp", ['nvd3ChartDirectives']);

      <?php 
      $cid = (int)$_GET['cid'];
        if ($cid != 0){
          $query_Contents =mysql_query("SELECT SUM(AllocationQ1) / 1000000 AS Net, SUM(ExpendedQ1) / 1000000 AS issues FROM quarterexpenditure where countyid = $cid");
        } else {
          $query_Contents =mysql_query("SELECT SUM( GrossEst_1 ) AS Gross, SUM( NetEst_1 ) AS Net, SUM( ExchIssues_1 ) AS issues FROM  nationalexpenditure WHERE  used =1");
        }
          $row_Contents=mysql_fetch_assoc($query_Contents);
          $issue = $row_Contents['issues'];
          $net = $row_Contents['Net'];
          //$pending = $cob + ($net - $cob);
      ?>
     
      function ExampleCtrl($scope){
        $scope.exampleData =  {"title":"Expenditure","subtitle":"KES, in Millions","ranges":[<?php echo $net;?>],"measures":[<?php echo $issue;?>],"markers":[<?php echo $net;?>]};

          $scope.rangesFunction = function(){
            console.log('rangesFunction called');
            return function(d){
            return [50,100,200];
          }
        }
      }
       
    </script>

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <body>
    
    <!-- Top Title -->
    <div class="top title">
      <div class="container">
        <div class="row">
          <div class="col-md-4">
            <p class="welcome">
              Welcome <b>guest</b>
            </p>
          </div>
          <div class="col-md-8 contacts">
            <p>
              <i class="fa fa-phone"></i>
              <span class="number">+254 (0)20 1234 5678</span>


              <i class="fa fa-envelope-o"></i>
              <a href="mailto: hello@openinstitute.com">hello@openinstitute.com</a>
            </p>
          </div>
        </div>
      </div>
    </div>
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

    <!-- Main Menu  -->
    <div class="main menu">
      <div class="container">
        <nav class="navbar navbar-default" role="navigation">
          <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav">
              <li class="#"><a href="#">Home</a></li>
              <li class="active"><a href="#">Allocations and Performance</a></li>
              <li><a href="#">About Open County</a></li>
              <li class="divider"></li>
              <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">About the Initiative<span class="caret"></span></a>
                <ul class="dropdown-menu" role="menu">
                  <li><a href="#">Counties</a></li>
                  <li><a href="#">Budgets</a></li>
                </ul>
              </li>
              <li class="divider"></li>
              <li><a href="#">Contacts</a></li>
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
      <div class="container">

        <!-- Header -->
        <div class="header">
          <div class="row">
            <div class="col-md-12">
              <h1 class="title">
                <?php
                  $cid = (int)$_GET['cid'];
                  if ($cid != 0) {
                    $query_Contents_0 =mysql_query("SELECT county.id , county.countyname FROM county WHERE county.id = $cid ");
                    $row_Contents_0=mysql_fetch_array($query_Contents_0);
                    $region = $row_Contents_0['countyname'];
                  } else {
                    $region = 'National';
                  }
                    echo  $region .' Allocation & Performance';
              ?>
              </h1>
            </div>
          </div>
        <!-- //End Header -->

        <!-- Allocation -->
        <div class="allocation">
          <div class="row">          

            <!-- Sidebar -->
            <div class="col-md-3 regions">

              <div class="dropdown">
                <button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown">
                  Choose a Region
                  <span class="caret"></span>
                </button>
                <ul class="dropdown-menu" role="menu" aria-labelledby="dropdownMenu1">
                  <li class="<?php if ((int)$_GET['cid'] == 0){ echo 'active';} ?>"><a role="menuitem" tabindex="-1" href="#">National</a></li>
                  <li class="divider"></li>
                  <?php
                    $query_Contents_2 =mysql_query("SELECT DISTINCT county.id , county.countyname, '0' as Val FROM county INNER JOIN  Department ON county.id = Department.countyid WHERE county.viewed =1");

                    while ($row_Contents_2=mysql_fetch_array($query_Contents_2)) {
                      $cid = $row_Contents_2['id'];
                    	
                  ?>
                  <li class="level1 <?php if ((int)$_GET['cid'] == $cid){ echo 'active';} ?>" cid="<?php echo $row_Contents_2['id'];?>">
                    <a role="menuitem" tabindex="-1" href="#"><?php echo $row_Contents_2['countyname']; ?></a>
                  </li>
                  <?php  } ?>
                </ul>
              </div>

              <table class="table table-bordered table-hover">
                <thead>
                  <th>
                    DEPARTMENTS
                  </th>
                </thead>
                <tbody class="legends">
                  <?php
                    if ($mwaka == "") {$mwaka='2013'; }
                      $cid = (int)$_GET['cid'];
                      $did = (int)$_GET['did'];
                    
                    if ($cid == 0) {
                      $result = mysql_query("SELECT id, indicators as 'Name', NetEst_1 as 'AllocationQ1', ExchIssues_1 as 'ExpendedQ1' FROM  nationalexpenditure WHERE  used =1");
                    } else {
                      $result =mysql_query("SELECT departments.id, departments.Name , quarterexpenditure.AllocationQ1 , quarterexpenditure.ExpendedQ1   FROM quarterexpenditure inner join departments on quarterexpenditure.departmentid= departments.id where quarterexpenditure.countyid = $cid AND quarterexpenditure.mwaka = $mwaka AND departments.viewed =1");
                    }

                    // Write rows
                    $k=1;
                    $letter = 'a';
                    //mysql_data_seek($projects, 0);
                    while ($row_Contents_2 = mysql_fetch_assoc($result)) {
                    $did =  $row_Contents_2['id'];
			if ($letter=='i'){ $letter++; }
                  ?>
                  <tr>
                    <td id="dept_<?php echo $row_Contents_2['id'];?>" class="level2 <?php if ((int)$_GET['did'] == $did){ echo 'active';} ?> legend <?php echo $letter;?>" did="<?php echo $row_Contents_2['id'];?>" cid="<?php echo $cid;?>"><i class="pointer"></i><?php echo $row_Contents_2['Name'] .' - '. number_format($row_Contents_2['Val']);?> M</td>
                  </tr>
                  <?php $letter++; } ?>
              </table>
            </div>  
            <!-- //End Sidebar -->

            <div class="overall col-md-9">
              <div class="row">
              	
              	<!-- Bullet Chart -->
                <div class="overview col-md-12">
                  <div class="panel">

                    <div class="col-md-6">
                      <h1 class="title"><?php echo number_format($row_Contents_['Alloc'],2);?>m</h1> <span>allocated to 
                        <?php
                          $cid = (int)$_GET['cid'];
                          if ($cid != 0) {
                            $query_Contents_0 =mysql_query("SELECT county.id , county.countyname FROM county WHERE county.id = $cid ");
                            $row_Contents_0=mysql_fetch_array($query_Contents_0);
                            $region = $row_Contents_0['countyname'] . ' County';
                          } else {
                            $region = 'all counties';
                          }
                          echo  $region;
                        ?>
                        </span>
                    </div>
 			<?php
		        $cid = (int)$_GET['cid'];
		        if ($cid == 0 ){
		          $query_Contents_ =mysql_query("SELECT  SUM(NetEst_1) as Exp, SUM(ExchIssues_1) as Alloc FROM nationalexpenditure WHERE used =1 ");
		        }
		        else {
		          $query_Contents_ =mysql_query("SELECT  SUM(Department.AllocationQ1/1000000) as Alloc, SUM(Department.ExpendedQ1/1000000) as Exp, county.countyname as Name, county.population, county.area, county.constituencies, county.image FROM Department INNER JOIN county ON county.id = Department.countyid WHERE Department.countyid = $cid ");
		        }   
		        $row_Contents_=mysql_fetch_assoc($query_Contents_);
              		?>
                    <div class="col-md-6">
                      <h1 class="title spent"><?php echo number_format($row_Contents_['Exp'],2);?>m</h1> <span>of allocation spent</span>
                    </div>

                    <div id="chart" class="bullet chart"></div>

                    <h5 class="tester">Reporting period: <span>May 2014</span></h5>

                    <div class="col-md-12 glance panel">
                      <div class="col-md-3">
                        <br> 
                          <?php if ($cid == 0) { ?> 
                            <img src="http://www.vectorportal.com/img_novi/kenya-vector-map_2481.jpg" width="auto" height="140px">
                          <?php } else {?>
                            <img src="./img/<?php echo $row_Contents_['image'];?>" width="auto" height="140px">
                          <?php }?>
                      </div>
                      <div class="col-md-9">
                        <div class="subtitle"> 
                          <h5>At a glance - </h5><h1 class="title">
                            <?php if ($cid == 0) { ?> Kenya<?php } else { echo $row_Contents_['Name']; }?>
                          </h1>
                        </div>
                        <div class="col-md-6">
                          <h5>Population -  <span><?php if ($cid == 0) { ?> 44,037,656<?php } else { echo $row_Contents_['population']; }?></span></h5>
                          <h5>Population density -  <span>67.2/km<sup>2</sup></span></h5>
                          <h5>Area -  <span><?php if ($cid == 0) { ?> 581,309 km<sup>2</sup><?php } else { echo $row_Contents_['area']; }?></span></h5>
                        </div>
                        <div class="col-md-6">
                          <h5>Constituencies - 
                                <p><span>Constituency A </span> | <span>Constituency B </span> | 
                                <span>Constituency C </span> | <span>Constituency D </span> | 
                                <span>Constituency E </span></p>
                          </h5>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="col-md-offset-10">
		    <div class="toggles">
		      <div class="btn-group">
		        <button type="button" class="btn btn-default active pie">
		          <i class="icon-pie"></i>
		        </button>
		        <button type="button" class="btn btn-default bars">
		          <i class="icon-bars"></i>
		        </button>
		        <button type="button" class="btn btn-default dataTable">
		          <i class="icon-table"></i>
		        </button>
		      </div>
		    </div>
                </div>
                
                <!-- Chart -->
            	<div class="col-md-12 allocation-pie" id="pie">
             	 <h2 class="section-title">
               	 <?php
                  $cid = (int)$_GET['cid'];
                  if ($cid != 0) {
                    $query_Contents_0 =mysql_query("SELECT county.id , county.countyname FROM county WHERE county.id = $cid ");
                    $row_Contents_0=mysql_fetch_array($query_Contents_0);
                    $region = ' County Allocation';
                  } else {
                    $region = 'National Allocation';
                  }
                  echo $region;
                  ?>
              	</h2>
              	<div class="divider"></div>
              	<div class="col-md-12" id="pieChart"></div>
               </div>
            
            <!-- End chart -->
            
            <!-- Performance -->
            <div class="performance col-md-12" id="bars">
              <h2 class="section-title">
                <?php
                  $cid = (int)$_GET['cid'];
                  if ($cid != 0) {
                    $query_Contents_0 =mysql_query("SELECT county.id , county.countyname FROM county WHERE county.id = $cid ");
                    $row_Contents_0=mysql_fetch_array($query_Contents_0);
                    $region = ' County Performance';
                  } else {
                    $region = 'Overall Performance';
                  }
                  echo  $region;
                  ?>
              </h2>
              <div class="row">
                <?php
                  $cid = (int)$_GET['cid'];
                  if ($cid == 0 ){
                    $query_Contents_C = mysql_query("SELECT id, indicators AS Name, ExchIssues_1 as Alloc,NetEst_1 as Exp FROM nationalexpenditure ");
                  }
                  else {
                    $query_Contents_C = mysql_query("SELECT id, (AllocationQ1/1000000) as Alloc, (ExpendedQ1/1000000) as Exp, Name  FROM Department WHERE countyid = $cid ORDER BY AllocationQ1 ASC");
                  }
                  while ($row_Contents_C=mysql_fetch_array($query_Contents_C)) {
                    $chart_id = 'chart_'.$row_Contents_C['id'];
                ?>
                <div class="col-md-6 panel">
                  <h5><?php echo $row_Contents_C['Name']; ?></h5>
                  <h1 class="title"><?php echo (int)$row_Contents_C['Exp']; ?>m</h1> spent of <span class="req-amt"><?php echo (int)$row_Contents_C['Alloc']; ?></span>m requested
                 <div class="progress">
                    <div class="progress-bar" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 60%;">60%</div>
                  </div>
                  <!-- <div id="<?php //echo $chart_id; ?>" class="bar"></div>-->
                  percentage spent from total amount issued
                </div>
                <?php } ?> 
              </div>
            </div>
            <!-- End performance -->
            
            <!-- Table -->
            <div class="col-md-12" id="dataTable">
              <h2 class="section-title">Data Table</h2>
              <i class="fa fa-download col-md-offset-11"></i>
            <br>
            
            <div id="data_table" class="col-md-12 ">
              <?php
                if ($mwaka == "") {$mwaka='2013'; }
                  $cid = (int)$_GET['cid'];
                
                if ($cid == 0) {
                  $result = mysql_query("SELECT indicators as 'Name', NetEst_1 as 'AllocationQ1', ExchIssues_1 as 'ExpendedQ1' FROM  nationalexpenditure WHERE  used =1");
                } else {
                $result =mysql_query("SELECT departments.Name , quarterexpenditure.AllocationQ1 , quarterexpenditure.ExpendedQ1   FROM quarterexpenditure inner join departments on quarterexpenditure.departmentid= departments.id where quarterexpenditure.countyid = $cid AND quarterexpenditure.mwaka = $mwaka AND departments.viewed =1");
                }
              ?>
              <table class="col-md-12 table table-bordered">
                <caption><i>Amounts in KES</i></caption>
              <thead>
                <tr>
                  <th>&nbsp;</th>
                  <th>Department Name</th>
                  <th class="center">Amount Released<br> (in Millions)</th>
                  <th class="center">Amount Expenses<br> (in Millions)</th>
                  <th class="center">Absorption</th>
                </tr>
              </thead>
              <tbody>
                <?php
                  // Write rows
                  $k=1;
                  //mysql_data_seek($projects, 0);
                  while ($row = mysql_fetch_assoc($result)) {
                ?>
                <tr>
                  <td><?php echo $k++; ?></td>
                  <td><?php echo $row['Name']; ?></td>
                  <td align="right"><?php echo number_format($row['AllocationQ1'],2); ?></td>
                  <td align="right"><?php echo number_format($row['ExpendedQ1'],2); ?></td>
                  <td align="center"><?php echo number_format(($row['ExpendedQ1']/$row['AllocationQ1'])*100); ?>%</td>
                  <?php $ar += $row['AllocationQ1']; ?>
                  <?php $ae += $row['ExpendedQ1']; ?>
                </tr>
                <?php } ?>
                <tr>
                  <td>&nbsp;</td>
                  <td><b>Totals</b></td>
                  <td align="right"><b><?php echo number_format($ar,2); ?></b></td>
                  <td align="right"><b><?php echo number_format($ae,2); ?></b></td>
                  <td align="center"><b><?php echo number_format(($ae/$ar)*100); ?>%</b></td>
                </tr>
              </tbody>
            </table>
                            
            </div>
          </div>
            
              </div>
            </div>
            <!-- End overall -->


            

          </div>
        </div>
        <!-- //End Allocation -->

      </div>
    </div>
    <!-- //End Content -->



    <!-- Footer -->
    <div class="footer">

      <div class="footer-nav">
        <div class="container">
          <div class="row">
            <div class="col-md-4 about">
              <h4>Open County</h4>
              <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>

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
              <h4 class="footermenu">Footer Menu</h4>
                <ul class="footer-menu">
                    <li>
                    About the initiative
                    </li>
                    <li>
                    About Open County Dashboard
                    </li>
                    <li>
                    Disseminating knowledge
                    </li>
                    <li>
                    Disseminating knowledge
                    </li>
                  </ul>
            </div>
            <div class="col-md-4 ">
              <h4>Newsletter</h4>
              <p class="social">Join our Newsletter to stay up to date...
              Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
              tempor incididunt ut labore et dolore
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
                <a href="">
                  <img src="img/facebook.png">
                </a>
                <a href="">
                <img src="img/twitter.png">
                </a>
                <a href="">
                <img src="img/google.png">
                </a>
                <a href="">
                  <img src="img/rss.png">
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
      <!-- //End Attribution -->
    </div>

    <!-- //End Footer -->

    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
    <script src="js/d3.min.js"></script>
    <script src="js/d3.bullet.js"></script>
    <script src="js/d3.pie.js"></script>
    <script src="js/d3.opencounty.barchart.js"></script>
<!-- //	 <script src="js/d3.pie.min.js"></script> -->
    
    <script type="text/javascript">
    
      function getStyleSheetPropertyValue(selectorText, propertyName) {
    // search backwards because the last match is more likely the right one
	    for (var s= document.styleSheets.length - 1; s >= 0; s--) {
		var cssRules = document.styleSheets[s].cssRules ||
		        document.styleSheets[s].rules || []; // IE support
		for (var c=0; c < cssRules.length; c++) {
		    if (cssRules[c].selectorText === selectorText) 
		        return cssRules[c].style[propertyName];
		}
	    }
	    return null;
	}

      (function() {
      	<?php 
	if ($mwaka == "") {$mwaka='2013';}
	$cid = (int)$_GET['cid'];
	$did = (int)$_GET['did'];
	if ($cid == 0) {

	$query_ContentsB =mysql_query("SELECT SUM( GrossEst_1 ) AS Gross, SUM( NetEst_1 ) AS netbudget, SUM( ExchIssues_1 ) AS cob FROM nationalexpenditure WHERE  used =1");
	} else {
	$query_ContentsB =mysql_query("SELECT  SUM(AllocationQ1)/1000000 as 'netbudget' , SUM(ExpendedQ1)/1000000 as 'cob' FROM Department WHERE countyid = $cid ");
	}
	$row_ContentsB=mysql_fetch_assoc($query_ContentsB);
	$cobB = $row_ContentsB['cob'];
	$netB = $row_ContentsB['netbudget'];
	$pending = $cobB + ($netB - $cobB);

	?>
          console.log("Preparing bullet chart");
          var margin = {top: 5, right: 40, bottom: 20, left: 120};
          width = $('.overall .col-md-12').width();
	
	 data = [{"title":"Expenditure","subtitle":"KES, in Millions","ranges":[<?php echo $netB?>],"measures":[<?php echo $cobB;?>],"markers":[<?php echo $pending;?>]}];

          var margin = {top: 5, right: 40, bottom: 20, left: 120};
          width = width - margin.left - margin.right,
          height = 50 - margin.top - margin.bottom;

          var chart = d3.bullet()
              .width(width)
              .height(height);

          var svg = d3.select(".bullet.chart").selectAll("svg")
              .data(data)
            .enter().append("svg")
              .attr("class", "bullet")
              .attr("width", width + margin.left + margin.right)
              .attr("height", height + margin.top + margin.bottom)
            .append("g")
              .attr("transform", "translate(" + margin.left + "," + margin.top + ")")
              .call(chart);

          var title = svg.append("g")
              .style("text-anchor", "end")
              .attr("transform", "translate(-6," + height / 2 + ")");

          title.append("text")
              .attr("class", "title")
              .text(function(d) { return d.title; });

          title.append("text")
              .attr("class", "subtitle")
              .attr("dy", "1em")
              .text(function(d) { return d.subtitle; });

alert(getStyleSheetPropertyValue(".legends td.legend.d", "border-right-color"));
          var pie = new d3pie(document.getElementById("pieChart"), {
            "size": {
                "canvasWidth": 800,
                "pieInnerRadius": "0%",
                "pieOuterRadius": "100%"
            },
            "data": {
                "sortOrder": "random",
                "content": [{
                    "label": "The Governance, Justice, Law and Order (GJLOS)",
                    "value": 400,
                    "color": getStyleSheetPropertyValue(".legends td.legend.d", "border-right-color"),
                    "id": "dept-1"
                }, {
                    "label": "Health",
                    "value": 120,
                    "color": "#cc0066",
                    "id": "dept-2"
                }, {
                    "label": "General Economic & Commercial Affairs (GECLA)",
                    "value": 50,
                    "color": "#99cc33",
                    "id": "dept-3"
                },  {
                    "label": "The Energy,Infrastructure and ICT",
                    "value": 150,
                    "color": "#3366cc",
                    "id": "dept-4"
                }, {
                    "label": "The Public Administration and International Relations ",
                    "value": 90,
                    "color": "#ffff66",
                    "id": "dept-5"
                }, {
                    "label": "Transport & Infrastracture",
                    "value": 50,
                    "color": "#90c469",
                    "id": "dept-6"
                }, {
                    "label": "Defence",
                    "value": 10,
                    "color": "#daca61",
                    "id": "dept-7"
                }, {
                    "label": "Education",
                    "value": 30,
                    "color": "#e4a14b",
                    "id": "dept-8"
                }, {
                    "label": "Sports, Culture and the Arts",
                    "value": 20,
                    "color": "#e98125",
                    "id": "dept-9"
                }]
            },
            "labels": {
                "outer": {
                    "format": "none",
                    // "pieDistance": 32
                },
                "inner": {
                    "format": "none"
                },
                "mainLabel": {
                    "fontSize": 10
                },
                "percentage": {
                    "color": "#ffffff",
                    "decimalPlaces": 0
                },
                "value": {
                    "color": "#ffffff",
                    "fontSize": 15,
                    "font": "Helvetica Neue"
                },
                "lines": {
                    "enabled": true,
                    "style": "straight"
                }
            },
            "effects": {
                "pullOutSegmentOnClick": {
                    "effect": "linear",
                    "speed": 400,
                    "size": 8
                }
            },
            "misc": {
                "gradient": {
                    "enabled": true,
                    "percentage": 100
                }
            },
            "callbacks" : {
              onClickSegment: function(a) {
                $('.legends td.active').removeClass('active');
                $(".legends td#" + a.data.id).addClass('active');

              }
            }
        });
        
         <?php
                $cid = (int)$_GET['cid'];
                if ($cid == 0 ){
                $query_Contents_A =mysql_query("SELECT id, indicators AS Name, NetEst_1 as Exp, ExchIssues_1 as Alloc FROM nationalexpenditure ");
                }
                else {
                $query_Contents_A =mysql_query("SELECT  id, (AllocationQ1/1000000) as Alloc, (ExpendedQ1/1000000) as Exp, Name  FROM Department WHERE countyid = $cid ORDER BY AllocationQ1 ASC");
                }
		while ($row_Contents_A=mysql_fetch_array($query_Contents_A)) {
		$alloc = (int)$row_Contents_A['Alloc'];
		$expend= (int)$row_Contents_A['Exp'];
		$over = ($expend>$alloc) ? ($expend - $alloc) : 0;
		$expend = ($over>0) ? 0 : $alloc-$expend ;
		
		     echo 'ocstackedbarchart.create('.$alloc.', '.$expend .','. $over .', "#chart_'. $row_Contents_A['id'] .'", "%");';
		       
                } 
                ?>                 
               
     
      })();
	
	

      $(".dropdown-menu").on("click", "li", function(){
        var cid =$(this).attr('cid');// $(this).text();
          window.location.href='index.php?cid=' + cid;
        });

      $("td.level2").click(function(){
        var cid = $(this).attr('cid');
        var did = $(this).attr('did');
        // alert(cid);
        window.location.href='index.php?cid=' + cid +'&did=' + did;
       });
       
      $("button").click(function(){
       $("button").removeClass("active");
      	
       	if ($(this).hasClass('pie')){
        	$(this).addClass("active");
        	$("#pie").show("slow");
        	$("#bars").hide("slow");

         }
        
        if ($(this).hasClass('bars')){
        	$(this).addClass("active");
        	$("#pie").hide("slow");
        	$("#bars").show("slow");

         }
         if ($(this).hasClass('dataTable')){
        	$(this).addClass("active");
        	$("#pie").hide("slow");
        	$("#bars").hide("slow");

         }
        //window.location.href='index.php?cid=' + cid +'&did=' + did;
       });
       
       
       $( ".tester" ).click(function() {
	  $( ".glance" ).slideToggle( "slow" );
      });
    </script>
  </body>
</html>
