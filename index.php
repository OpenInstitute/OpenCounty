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

    <link type="text/css" rel="stylesheet" href="css/nv.d3.css" />
    <link href="css/chart.css" rel="stylesheet">
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
  <body ng-app='nvd3TestApp'>
    
    <!-- Top Title -->
    <div class="top title">
      <div class="container">
        <div class="row">
          <div class="col-md-4">
            <p class="welcome">
              Welcome <b>USERNAME</b>
            </p>
          </div>
          <div class="col-md-8 contacts">
            <p>
              <i class="fa fa-phone"></i>
              <span class="number">+254 (0)20 1234 5678</span>


              <i class="fa fa-envelope-o"></i>
              <a href="mailto: info@openinstitute.com">info@openinstitute.com</a>
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
              <li class="active"><a href="#">Home</a></li>
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
            <div class="col-md-4">
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
		echo  $region .' Allocations';
		?>
              </h1>
            </div>
            <div class="col-md-4 col-md-offset-4">
              <div class="toggles">
                <ul class="nav nav-pills">
                  <li class="active">
                    <a href="index.php">Allocation</a>
                  </li>
                  <li> 
                    <a href="performance.php">Performance</a>
                  </li>
                </ul>
            </div>
          </div>
        </div>
        <!-- //End Header -->


        <!-- Bullet Chart -->
        <div class="overall">
          <div class="row">
            <div class="col-md-12">
              <div ng-controller="ExampleCtrl">
		    <nvd3-bullet-chart
			    data="exampleData"
			    id="exampleId"
			    margin="{left:75,top:30,bottom:30,right:10}"
			    width="550"
			    height="75"
			    interactive="true"
        		    tooltips="true">
			<svg></svg>
		    </nvd3-bullet-chart>
		</div>
            </div>
          </div>
        </div>
        <!-- End overall -->

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
                  <li <?php if ((int)$_GET['cid'] == 0){ echo 'class="active"';} ?>" cid="0"><a role="menuitem" tabindex="-1" href="#">National</a></li>
                  <li class="divider"></li>
                  <?php
                $query_Contents_1 =mysql_query("SELECT DISTINCT county.id , county.countyname FROM county INNER JOIN  quarterexpenditure ON county.id = quarterexpenditure.countyid WHERE county.viewed =1");
		while ($row_Contents_1=mysql_fetch_array($query_Contents_1)) {
		 $cid = $row_Contents_1['id'];
		?>
                  <li <?php if ((int)$_GET['cid'] == $cid){ echo 'class="active"';} ?>" cid="<?php echo $cid; ?>"><a role="menuitem" tabindex="-1" href="#"><?php echo $row_Contents_1['countyname']; ?></a></li>
                <?php } ?>
                  
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
                $cid = (int)$_GET['cid'];
                $letter = 'a';
                if ($cid == 0 ){
                $query_Contents_2 =mysql_query("SELECT id, indicators AS Name, ExchIssues_1 as Val FROM nationalexpenditure ");
                }
                else {
                $query_Contents_2 =mysql_query("SELECT departments.id, (quarterexpenditure.AllocationQ1/1000000) as Val, departments.Name  FROM quarterexpenditure INNER JOIN departments ON quarterexpenditure.departmentid = departments.id WHERE quarterexpenditure.countyid = $cid ORDER BY  quarterexpenditure.AllocationQ1 ASC");
                }
		while ($row_Contents_2=mysql_fetch_array($query_Contents_2)) {
		$did = $row_Contents_2['id'];
		if ($letter=='i'){$letter++;}
		?>
                  <tr>
                    <td class="level2 <?php if ((int)$_GET['did'] == $did){ echo 'active';} ?> legend <?php echo $letter;?>" cid="<?php echo $cid;?>" did="<?php echo $did; ?>"><i class="pointer"></i><?php echo $row_Contents_2['Name'] .' - '. number_format($row_Contents_2['Val']);?> M</td>
                  </tr>
                <?php $letter++; } ?>
                </tbody>
              </table>
            </div>  
            <!-- //End Sidebar -->
            
            <!-- Chart             -->
            <div class="col-md-9" id="pieChart">
            </div>
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
              <h4>News Letter</h4>
              <p class="social">Join our Newsletter to stay up to date...
              Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
              tempor incididunt ut labore et dolore
              </p>
              <form>
                    <div class="row" style="padding-top: 10px;">
                    <div class="col-md-8">
                    <input type="text" placeholder="Enter Email" class="input placeholder">
                    </div>
                    <div class="col-md-4" style="padding-left: 0px">
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
    <!-- // <script src="js/d3.pie.min.js"></script> -->
    <script src="js/d3.pie.min.js"></script>

    <script type="text/javascript">
    
     // document.styleSheets[1].cssRules[0].style['height']

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
         

          var pie = new d3pie(document.getElementById("pieChart"), {
            "size": {
                "canvasWidth": 800,
                "pieInnerRadius": "0%",
                "pieOuterRadius": "50%"
            },
            "data": {
                "sortOrder": "random",
                "content": <?php
                $cid = (int)$_GET['cid'];
                $pieData='[';
                $letter = 'a';
                if ($cid == 0 ){
                $query_Contents_2 =mysql_query("SELECT id, indicators AS Name, ExchIssues_1 as Val FROM nationalexpenditure ");
                }
                else {
                $query_Contents_2 =mysql_query("SELECT (quarterexpenditure.AllocationQ1/1000000) as Val, departments.Name  FROM quarterexpenditure INNER JOIN departments ON quarterexpenditure.departmentid = departments.id WHERE quarterexpenditure.countyid = $cid ORDER BY  quarterexpenditure.AllocationQ1 ASC");
                }
		while ($row_Contents_2=mysql_fetch_array($query_Contents_2)) {
		$did = $row_Contents_2['id'];
		if ($letter=='i'){$letter++;}
		$pieData.='{';
		$pieData.='            "label": "'. $row_Contents_2['Name'] .'",';
		$pieData.='            "value": '. number_format($row_Contents_2['Val']) .',';
		$pieData.='            "color": getStyleSheetPropertyValue(".legends td.legend.'. $letter .'", "border-right-color")';
		$pieData.='        },';
		$letter++; 
                }            
                $pieData.=']';
                $pieData = str_replace('},]', '}]', $pieData);
                echo $pieData;
                ?>
            },
            "labels": {
                "outer": {
                    "pieDistance": 32
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
            }
        });
      })();
      
       $(".dropdown-menu").on("click", "li", function(){
	     	var cid =$(this).attr('cid');// $(this).text();
	       	window.location.href='index.php?cid=' + cid;
      	});
      
      $("td.level2").click(function(){
     	var cid = $(this).attr('cid');
     	var did = $(this).attr('did');
     // alert(cid);
       	window.location.href='performance.php?cid=' + cid +'&did=' + did;
      });
    </script>
  </body>
</html>
