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
    <link href="Includefiles/rss-style.css" rel="stylesheet">
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
      function bd_nice_number($n) {
        // first strip any formatting;
        $n = (0+str_replace(",","",$n));

        // is this a number?
        if(!is_numeric($n)) return false;

        // now filter it;
        if($n>1000000000000) return round(($n/1000000000000),1).' T';
        else if($n>1000000000) return round(($n/1000000000),1).' b';
        else if($n>1000000) return round(($n/1000000),1).' m';
        else if($n>1000) return round(($n/1000),1).' k';

        return number_format($n);
      }
                      
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
              <span class="number">+254 (0) 20 5231480</span>


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
              <li class="#"><a href="index.php">Home</a></li>
              <li class="active"><a href="performance.php">Allocations and Performance</a></li>
              <li><a href="http://www.opencounty.org/">About Open County</a></li>
              <li class="divider"></li>
              <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">About the Initiative<span class="caret"></span></a>
                <ul class="dropdown-menu" role="menu">
                  <li><a href="#">Counties</a></li>
                  <li><a href="#">Budgets</a></li>
                </ul>
              </li>
              <li class="divider"></li>
              <li><a href="http://www.opencounty.org/contact-us/">Contacts</a></li>
              <li class="divider"></li>
              <li><a href="admin">Login</a></li>
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

        <!-- Allocation -->
        <div class="allocation">
          <div class="row">          

            <!-- Sidebar -->
            <div class="col-md-3 regions">
              <div class="dropdown">
                <button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown">
                  Choose a Government<span class="caret"></span>
                </button>
                <ul class="dropdown-menu" role="menu" aria-labelledby="dropdownMenu1">
                  <li class="<?php if ((int)$_GET['cid'] == 0){ echo 'active';} ?> level1" cid="0"><a role="menuitem" tabindex="-1" href="#">National</a></li>
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
                      $result = mysql_query("SELECT id, indicators as 'Name', NetEst_1 as 'Val', ExchIssues_1 as 'ExpendedQ1' FROM  nationalexpenditure WHERE  used =1 ORDER BY id");
                    } else {
                      $result =mysql_query("SELECT Department.id, Department.Name , Department.AllocationQ1/1000000 as Val, Department.ExpendedQ1  FROM Department  where Department.countyid = $cid ORDER BY id");
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
                </tbody>
              </table>
              <div class="col-md-12">
                <h2>Download Budget</h2>
                <?php
						$query_Links3 ="SELECT * FROM budgetdocs WHERE countyid=$cid";
						$Contents3 = mysql_query($query_Links3, $conn) or die(mysql_error());
						while ($row_Contents3 = mysql_fetch_array($Contents3)){
							 echo "<a target='_blank' href='docs/".$row_Contents3['docurl'] ."'>".$row_Contents3['docname'] ."</a><br/>"; 
						}
				?>
              </div>
            </div><!-- /.regions -->
            <!-- //End Sidebar -->
            <!-- Visualisations -->
            <div class="overall col-md-9">
              <div class="row">

                <!-- Header -->
                <div class="col-md-12">
                  <div class="header">
                    <ol class="breadcrumb">
                      <!-- TO DO: activate this as a link that shows the first national/county view -->
                      <?php
                        $cid = (int)$_GET['cid'];
                        $did = (int)$_GET['did'];
                        if (($cid == 0) && ($did == 0)) {
                         echo '<li><h1 class="title">National</h1></li><li><span>Departments</span></li>';
                        }
                        elseif (($cid == 0) && ($did != 0)) {
                        $query_Contents_0 =mysql_query("Select * FROM nationalexpenditure WHERE id =$did AND   used =1 ");
                        $row_Contents_0=mysql_fetch_array($query_Contents_0);
                           echo '<li><h1 class="title"><a href="performance.php?cid=0">National</a></h1></li><li><span>'. $row_Contents_0['indicators'] .'</span></li><li>Projects</li>';
                        } 
                        elseif (($cid != 0) && ($did == 0)) {
                        $query_Contents_0 =mysql_query("SELECT county.id , county.countyname FROM county WHERE county.id = $cid ");
                        $row_Contents_0=mysql_fetch_array($query_Contents_0);
                           echo '<li><h1 class="title">'. $row_Contents_0['countyname'] .'</h1></li><li>Departments</li>';
                          
                        }
                        elseif (($cid != 0) && ($did != 0)) {
                        $query_Contents_B =mysql_query("SELECT Department.id, Department.Name, county.countyname, Department.countyid  FROM Department INNER JOIN county ON Department.countyid = county.id WHERE Department.id = $did ");
                      $row_Contents_B=mysql_fetch_array($query_Contents_B);
                   
                        echo '<li><h1 class="title"><a href="performance.php?cid='. $row_Contents_B['countyid'] .'">'. $row_Contents_B['countyname'] .'</a></h1></li><li><span>' . $row_Contents_B['Name'] . '</span></li><li>Projects</li>';
                        }
                      ?> 
                      <!-- TO DO: activate this as a link for the department view as well -->   
                    </ol>              
                  </div><!-- /.header -->
                </div>
                <!-- End Header -->
                
                <!-- Overview panel -->
                <div class="overview col-md-12">
                  <div class="panel">
                    <div class="row">
                      <!-- Allocated vs Spent -->  
                      <div class="col-md-4">
                        <?php
                          $cid = (int)$_GET['cid'];
                          $did = (int)$_GET['did'];
                          if (($cid == 0) && ($did == 0)) {
                            $query_Contents_ =mysql_query("SELECT  (SUM(NetEst_1)*1000000) as Alloc, (SUM(ExchIssues_1)*1000000) as Exp FROM nationalexpenditure WHERE used =1 ");
                          }
                          elseif (($cid == 0) && ($did != 0)) {
                            $query_Contents_ =mysql_query("SELECT  (NetEst_1*1000000) as Alloc, (ExchIssues_1*1000000) as Exp FROM nationalexpenditure WHERE id =$did AND used =1 ");
                          }
                          elseif (($cid != 0) && ($did == 0)) {
                            $query_Contents_ =mysql_query("SELECT  SUM(Department.AllocationQ1) as Alloc, SUM(Department.ExpendedQ1) as Exp, county.countyname as Name, county.population, county.area, county.constituencies, county.image FROM Department INNER JOIN county ON county.id = Department.countyid WHERE Department.countyid = $cid ");
                          }
                          elseif (($cid != 0) && ($did != 0)) {
                            $query_Contents_ =mysql_query("SELECT Name, BudgetApprovedAnnual, AllocationQ1 as Alloc, ExpendedQ1 as Exp, (ExpendedQ1/AllocationQ1)*100 as Pct FROM Department where id = $did");
                          }
                            $row_Contents_=mysql_fetch_assoc($query_Contents_);
                        ?>
                        <h1 class="title"><?php echo bd_nice_number(number_format($row_Contents_['Alloc'],2));?></h1><span> allocated</span>
                      </div>
                      
                      <div class="col-md-5">
                        <?php

                          $allocation = $row_Contents_['Alloc'];
                          $spent = $row_Contents_['Exp'];
                          
                          if ($allocation > $spent) {
                            $difference = 'primary';
                          }
                          elseif ($allocation == $spent) {
                            $difference = 'success';
                          }
                          else { 
                            $difference = 'danger';
                          }
                        ?>
                        <h1 class="title <?php echo $difference; ?>"><?php echo bd_nice_number(number_format($row_Contents_['Exp'],2));?></h1> <span>of allocation spent</span>
                      </div>
                      
                      <div class="col-md-3">
                        <h5>Reporting period : <span>May 2014</span></h5>
                      </div>
                    </div>
                  </div><!-- /.panel -->
                </div><!-- /.overview -->

                <!-- Toggle Menu -->

                <div class="col-md-12 section-toggle">
                  <div class="row">
                    <div class="col-md-8">
                      <h2 class="section-title">Allocation</h2>
                    </div>
                    <div class="col-md-4 toggle-menu">
                      <div class="toggles">
                        <div class="btn-group">
                          <button type="button" class="btn btn-default active pie" cid="<?php echo $cid;?>" did="<?php echo $did;?>">
                            <i class="icon-pie"></i>
                          </button>
                          <button type="button" class="btn btn-default bars" cid="<?php echo $cid;?>" did="<?php echo $did;?>">
                            <i class="icon-bars"></i>
                          </button>
                          <button type="button" class="btn btn-default dataTable" cid="<?php echo $cid;?>" did="<?php echo $did;?>">
                            <i class="icon-table"></i>
                          </button>
                          <button type="button" class="btn btn-default atAglance" cid="<?php echo $cid;?>" did="<?php echo $did;?>">
                            <i class="icon-info"></i>
                          </button>
                        </div>
                      </div><!-- /.toggles -->
                    </div><!-- /.toggle-menu -->
                  </div>
                </div>
                
                <!-- Pie Chart -->
                <div class="col-md-12" id="pie">
                  <div class="col-md-12" id="pieChart"></div>
                </div>
                <!-- /#pie -->

                <!-- At a Glance -->
                    <!-- Bullet Chart -->
                    <div class="col-md-12" id="glance">
                      <div class="panel">
                         <div id="OverviewRst"></div>
                      </div>
                    </div>
                    <!-- End At A Glance -->
            
                <!-- Performance -->
				   	<div class="performance col-md-12" id="bars">
				          <div class="row">
				          	<div id="PerformanceRst"></div>
				          </div><!-- /.row -->
				   </div><!-- /#bars /.performance -->
                <!-- End performance -->
            
                <!-- Table -->            
                <div id="dataTable" class="col-md-12 data-table">
                  <?php
                    if ($mwaka == "") {$mwaka='2013'; }
                      $cid = (int)$_GET['cid'];
                      $did = (int)$_GET['did'];
                    if (($cid == 0) && ($did == 0)) {
                      $result = mysql_query("SELECT id, indicators as 'Name', NetEst_1 as 'AllocationQ1', ExchIssues_1 as 'ExpendedQ1', (ExchIssues_1/NetEst_1)*100 as Pct FROM  nationalexpenditure WHERE  used =1");
                  ?>
                  <table class="col-md-12 table table-hover">
                    <caption>Amounts in KES</caption>
                    <thead>
                      <tr>
                        <th>&nbsp;</th>
                        <th>Department Name</th>
                        <th>Amount Released<br> (in Millions)</th>
                        <th>Amount Expenses<br> (in Millions)</th>
                        <th>Absorption</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php
                      // Write rows
                      $k=1;
                      //mysql_data_seek($projects, 0);
                      while ($row = mysql_fetch_assoc($result)) {
                        $pct = ($row['Pct'] == "Null") ? 0 : (int)$row['Pct']; 
                      ?>
                      <tr>
                        <td><?php echo $k++; ?></td>
                        <td><a href="performance.php?cid=<?php echo $cid;?>&did=<?php echo $row['id'];?>"><?php echo $row['Name']; ?></a></td>
                        <td align="left"><?php echo number_format($row['AllocationQ1'],2); ?></td>
                        <td align="left"><?php echo number_format($row['ExpendedQ1'],2); ?></td>
                        <td align="left"><?php echo $pct; ?>%</td>
                        <?php $ar += $row['AllocationQ1']; ?>
                        <?php $ae += $row['ExpendedQ1']; ?>
                      </tr>
                      <?php } ?>
                      <tr>
                        <td>&nbsp;</td>
                        <td><b>Totals</b></td>
                        <td><b><?php echo number_format($ar,2); ?></b></td>
                        <td><b><?php echo number_format($ae,2); ?></b></td>
                        <td><b><?php if(($ae==0) || ($ar==0)) { echo '0'; } else {echo number_format(($ae/$ar)*100);} ?>%</b></td>
                      </tr>
                    </tbody>
                  </table>
                  <?php
                  }
                  elseif (($cid == 0) && ($did != 0)) {
                        $result =mysql_query("SELECT indicators as 'Name', NetEst_1 as 'AllocationQ1', ExchIssues_1 as 'ExpendedQ1', (ExchIssues_1/NetEst_1)*100 as Pct FROM nationalexpenditure WHERE id =$did AND   used =1 ");
                      
                    ?>
                    <table class="col-md-12 table table-hover">
                    <caption>Amounts in KES</caption>
                    <thead>
                      <tr>
                        <th>&nbsp;</th>
                        <th>Department Name</th>
                        <th>Amount Released<br> (in Millions)</th>
                        <th>Amount Expenses<br> (in Millions)</th>
                        <th>Absorption</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php
                      // Write rows
                      $k=1;
                      //mysql_data_seek($projects, 0);
                      while ($row = mysql_fetch_assoc($result)) {
                        $pct = ($row['Pct'] == "Null") ? 0 : (int)$row['Pct']; 
                      ?>
                      <tr>
                        <td><?php echo $k++; ?></td>
                        <td><?php echo $row['Name']; ?></td>
                        <td><?php echo number_format($row['AllocationQ1'],2); ?></td>
                        <td><?php echo number_format($row['ExpendedQ1'],2); ?></td>
                        <td><?php echo $pct; ?>%</td>
                        <?php $ar += $row['AllocationQ1']; ?>
                        <?php $ae += $row['ExpendedQ1']; ?>
                      </tr>
                      <?php } ?>
                      <tr>
                        <td>&nbsp;</td>
                        <td><b>Totals</b></td>
                        <td><b><?php echo number_format($ar,2); ?></b></td>
                        <td><b><?php echo number_format($ae,2); ?></b></td>
                        <td><b><?php if(($ae==0) || ($ar==0)) { echo '0'; } else {echo number_format(($ae/$ar)*100);} ?>%</b></td>
                      </tr>
                    </tbody>
                  </table>
                    <?php
                    } elseif (($cid != 0) && ($did == 0)) {
                    $result =mysql_query("SELECT id, Name , BudgetApprovedAnnual, AllocationQ1 , ExpendedQ1, (ExpendedQ1/AllocationQ1)*100 as Pct  FROM Department where countyid = $cid ");
                  ?>
                  <table class="col-md-12 table table-hover">
                    <caption>Amounts in KES</caption>
                    <thead>
                      <tr>
                        <th>&nbsp;</th>
                        <th>Department Name</th>
                        <th>Annual Budget<br> Approved by COB</th>
                        <th>Amount<br>Released</th>
                        <th>Amount<br>Expenses</th>
                        <th>Absorption</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php
                      // Write rows
                      $k=1;
                      //mysql_data_seek($projects, 0);
                      while ($row = mysql_fetch_assoc($result)) {
                        $pct = ($row['Pct'] == "Null") ? 0 : (int)$row['Pct']; 
                      ?>
                      <tr>
                        <td><?php echo $k++; ?></td>
                        <td><a href="performance.php?cid=<?php echo $cid;?>&did=<?php echo $row['id'];?>"><?php echo $row['Name']; ?></a></td>
                        <td><?php echo number_format($row['BudgetApprovedAnnual'],2); ?></td>
                        <td><?php echo number_format($row['AllocationQ1'],2); ?></td>
                        <td><?php echo number_format($row['ExpendedQ1'],2); ?></td>
                        <td><?php echo $pct; ?>%</td>
                        <?php $al += $row['BudgetApprovedAnnual']; ?>
                        <?php $ar += $row['AllocationQ1']; ?>
                        <?php $ae += $row['ExpendedQ1']; ?>
                      </tr>
                      <?php } ?>
                      <tr>
                        <td>&nbsp;</td>
                        <td><b>Totals</b></td>
                        <td><b><?php echo number_format($al,2); ?></b></td>
                        <td><b><?php echo number_format($ar,2); ?></b></td>
                        <td><b><?php echo number_format($ae,2); ?></b></td>
                        <td><b><?php if(($ae==0) || ($ar==0)) { echo '0'; } else {echo number_format(($ae/$ar)*100);} ?>%</b></td>
                      </tr>
                    </tbody>
                  </table>
                  <?php
                    } elseif (($cid != 0) && ($did != 0)) {
                      $result =mysql_query("SELECT Projects ,  AmountExpenses , AmountReleased ,(AmountExpenses/AmountReleased)*100 as Pct  FROM projects where departmentid = $did ");
                  ?>
                  <table class="col-md-12 table table-hover">
                    <caption>Amounts in KES</caption>
                    <thead>
                      <tr>
                        <th>&nbsp;</th>
                        <th>Project Name</th>
                        <th>Amount<br>Released</th>
                        <th>Amount<br>Expenses</th>
                        <th>Absorption</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php
                      // Write rows
                      $k=1;
                      //mysql_data_seek($projects, 0);
                      while ($row = mysql_fetch_assoc($result)) {
                        $pct = ($row['Pct'] == "Null") ? 0 : (int)$row['Pct']; 
                      ?>
                      <tr>
                        <td><?php echo $k++; ?></td>
                        <td><?php echo $row['Projects']; ?></td>
                        <td><?php echo number_format($row['AmountReleased'],2); ?></td>
                        <td><?php echo number_format($row['AmountExpenses'],2); ?></td>
                        <td><?php echo $pct; ?>%</td>
                        <?php $ar += $row['AmountReleased']; ?>
                        <?php $ae += $row['AmountExpenses']; ?>
                      </tr>
                      <?php } ?>
                      <tr>
                        <td>&nbsp;</td>
                        <td><b>Totals</b></td>
                        <td><b><?php echo number_format($ar,2); ?></b></td>
                        <td><b><?php echo number_format($ae,2); ?></b></td>
                        <td><b><?php if(($ae==0) || ($ar==0)) { echo '0'; } else {echo number_format(($ae/$ar)*100);} ?>%</b></td>
                      </tr>
                    </tbody>
                  </table>
                  <?php
                    }
                  ?> 
                </div><!-- /#data_table /#dataTable -->
              </div><!-- /.row -->
            </div><!-- /.overall -->
            <!-- End overall -->

          </div><!-- /.row -->
        </div><!-- /.allocation -->
        <!-- //End Allocation -->

      </div><!-- /.container -->
    </div><!-- /.main -->
    <!-- //End Content -->


    <!-- Footer -->
    <div class="footer">
      <div class="footer-nav">
        <div class="container">
          <div class="row">
            <div class="col-md-4 about">
              <h4>Open County</h4>
              <p>
                Open Institute is working to develop Open County Dashboards that seek to publish county level open data - 
                especially that which relates to progress and development at county level. The purpose of the Open County 
                Dashboard is to strengthen the county governments’ efforts to be transparent and accountable to their citizens.
              </p>

              <div class="contacts">
                <ul>
                  <li>
                    <i class="fa fa-map-marker"></i>Kaya I/O, Shikunga, South B
                  </li>
                  <li>
                    <i class="fa fa-phone"></i>+254 (0) 20 5231480 
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
      <!-- //End Attribution -->
    </div>

    <!-- //End Footer -->

    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
   
    <script src="js/bootstrap-progressbar.js"></script>
    <script src="js/d3.min.js"></script>
    <script src="js/d3.pie.js"></script>
    <!-- <script src="js/d3.pie.min.js"></script> -->
    
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

        var pie = new d3pie(document.getElementById("pieChart"), {
          "size": {
            "canvasWidth": 900,
            "canvasHeight": 440,
            "pieInnerRadius": "0%",
            "pieOuterRadius": "75%"
          },
          "data": {
            "sortOrder": "value-desc",
            "content": [
              <?php
                if ($mwaka == "") {$mwaka='2013'; }
                  $cid = (int)$_GET['cid'];
                  $did = (int)$_GET['did'];

                if (($cid == 0) && ($did == 0)){
                  $result = mysql_query("SELECT id, indicators AS Name, ExchIssues_1 as Alloc,NetEst_1 as Val FROM nationalexpenditure WHERE  used =1 ");
                } 
                elseif (($cid == 0) && ($did != 0)) {
                 $result = mysql_query("SELECT id, indicators AS Name, ExchIssues_1 as Alloc,NetEst_1 as Val FROM nationalexpenditure WHERE id = $did AND   used =1 ");
                }
                elseif (($cid != 0) && ($did == 0)) {
                  $result = mysql_query("SELECT id, (AllocationQ1/1000000) as Val, (ExpendedQ1/1000000) as Exp, Name  FROM Department WHERE countyid = $cid ORDER BY AllocationQ1 ASC");
                }
                elseif (($cid != 0) && ($did != 0)) {
                  $result = mysql_query("SELECT id, (AmountReleased/1000000) as Val, (AmountExpenses/1000000) as Exp, Projects as Name  FROM projects WHERE departmentid = $did ORDER BY AmountReleased ASC");
                }

                // Write rows
                $k=1;
                $letter = 'a';
                $separator='';
                //mysql_data_seek($projects, 0);
                while ($row_Contents_2 = mysql_fetch_assoc($result)) {
                  $did =  $row_Contents_2['id'];
                echo $separator;
                if ($letter=='i'){ $letter++; }
                  echo '{"label": "'.  $row_Contents_2['Name'] .'",';
                  echo '    "value": '.  $row_Contents_2['Val'] .',';
                  echo '    "color": getStyleSheetPropertyValue(".legends td.legend.'.$letter.'", "border-right-color"),';
                  echo '    "cid": "'. $cid .'",';
                  echo '    "did": "'. $did .'"';
                  echo '}';
                  $separator=',';
                  $letter++;
                }
              ?>
            ]
          },
          
          "labels": {
            "outer": {
              "pieDistance": 40
            },
            "inner": {
              "hideWhenLessThanPercentage": 4
            },
            "mainLabel": {
              "fontSize": 13
            },
            "percentage": {
              "color": "#ffffff",
              "fontSize": 12,
              "decimalPlaces": 0
            },
            "value": {
              "color": "#adadad",
              "fontSize": 11
            },
            "lines": {
              "enabled": true
            }
          },
          "effects": {
            "pullOutSegmentOnClick": {
              "effect": "bounce",
              "speed": 400,
              "size": 10
            }
          },
            "misc": {
              "gradient": {
              "enabled": true,
              "percentage": 100
            },
            "canvasPadding": {
              "top": 0,
              "right": 0,
              "bottom": 20,
              "left": 0
            }
          },

          "callbacks" : {
            onClickSegment: function(a) {
            // alert(a.data.id);
            $('.legends td.active').removeClass('active');
            $(".legends td#dept_" + a.data.id).addClass('active');

            var cid = a.data.cid;
            var did = a.data.did;
            // alert(cid);
            window.location.href='performance.php?cid='+ cid +'&did=' + did;
            }
          }
        });

        /* <?php
        $cid = (int)$_GET['cid'];
        $did = (int)$_GET['did'];

        if (($cid == 0) && ($did == 0)){
        $query_Contents_A = mysql_query("SELECT id, indicators AS Name, ExchIssues_1 as Alloc,NetEst_1 as Exp FROM nationalexpenditure ");
        } 
        elseif (($cid != 0) && ($did == 0)) {
        $query_Contents_A = mysql_query("SELECT id, (AllocationQ1/1000000) as Alloc, (ExpendedQ1/1000000) as Exp, Name  FROM Department WHERE countyid = $cid ORDER BY AllocationQ1 ASC");
        }
        elseif (($cid != 0) && ($did != 0)) {
        $query_Contents_A = mysql_query("SELECT id, (AmountReleased/1000000) as Alloc, (AmountExpenses/1000000) as Exp, Projects as Name  FROM projects WHERE departmentid = $did ORDER BY AmountReleased ASC");
        }

        while ($row_Contents_A=mysql_fetch_array($query_Contents_A)) {
        $alloc = (int)$row_Contents_A['Alloc'];
        $expend= (int)$row_Contents_A['Exp'];
        $over = ($expend>$alloc) ? ($expend - $alloc) : 0;
        $expend = ($over>0) ? 0 : $alloc-$expend ;

        echo 'ocstackedbarchart.create('.$alloc.', '.$expend .','. $over .', "#chart_'. $row_Contents_A['id'] .'", "%");';

        }
        ?>*/                 
      
      })();

      $(".dropdown-menu").on("click", "li", function(){
        var cid =$(this).attr('cid');// $(this).text();
        window.location.href='performance.php?cid=' + cid;
      });

      $("td.level2").click(function(){
        var cid = $(this).attr('cid');
        var did = $(this).attr('did');
        // alert(cid);
        window.location.href='performance.php?cid=' + cid +'&did=' + did;
      });

      	$("#bars").hide("slow");
      	$("#glance").hide("slow");
      	$("button").click(function(){
        
        	$("button").removeClass("active");

		    if ($(this).hasClass('pie')){
		      $(this).addClass("active");
		      $("#pie").show("slow");
		      $("#bars").hide("slow");
		      $("#glance").hide("slow");
		       $("#dataTable").show("slow");
		      $(".section-title").html('Allocation');
		    }

		    if ($(this).hasClass('bars')){
		      $(this).addClass("active");
		      $("#pie").hide("slow");
		      $("#bars").show("slow");
		      $("#glance").hide("slow");
		       $("#dataTable").show("slow");
		      $(".section-title").html('Performance');
		      	var cid = $(this).attr('cid');
        		var did = $(this).attr('did');
        		performanceAJAX(cid,did);
		      	$('.progress .progress-bar').progressbar({transition_delay: 2000});
		      // $('.progress .progress-bar').progressbar();
		       
		    }
		
			if ($(this).hasClass('atAglance')){
		      $(this).addClass("active");
		      $("#pie").hide("slow");
		      $("#bars").hide("slow");
		      $("#glance").show("slow");
		      $("#dataTable").hide("slow");
		      
		      	var cid = $(this).attr('cid');
        		var did = $(this).attr('did');
        		overviewAJAX(cid,did);
		      $(".section-title").html('Information');
		    }
		    
		    if ($(this).hasClass('dataTable')){
		      $(this).addClass("active");
		      $("#pie").hide("slow");
		      $("#bars").hide("slow");
		      $("#glance").hide("slow");
		       $("#dataTable").show("slow");
		      $(".section-title").html('Data Table');
		    }
        //window.location.href='performance.php?cid=' + cid +'&did=' + did;
      
      });
      


        
function overviewAJAX(c,d) {

//alert(d);
   // Ent_id = $("input[name='Merge[]']:checked").val();
    $.ajax({
      url: "ajax_overview.php",
      type: "post",
      async: false, 
      data: {cid : c, did : d},
      success:function(dat){

         $("#OverviewRst").html(dat);
       // alert(dat);
         //$("#result").html("Update Done");
      },
      error:function(d){
          alert("failure"+d);
          $("#OverviewRst").html('there is error while submit');
      }
    }); 
}

function performanceAJAX(c,d) {

//alert(d);
   // Ent_id = $("input[name='Merge[]']:checked").val();
    $.ajax({
      url: "ajax_performance.php",
      type: "post",
      async: false, 
      data: {cid : c, did : d},
      success:function(dat){

         $("#PerformanceRst").html(dat);
       // alert(dat);
         //$("#result").html("Update Done");
      },
      error:function(d){
          alert("failure"+d);
          $("#PerformanceRst").html('there is error while submit');
      }
    }); 
}

    </script>
  </body>
</html>
