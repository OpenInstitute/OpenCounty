<?php require('Includefiles/header.php'); ?>
  <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <script>
	$( document ).ready(function() {
      var app = angular.module("nvd3TestApp", ['nvd3ChartDirectives']);

      <?php 
        function bd_nice_number($n) {
          // first strip any formatting;
          $n = (0+str_replace(",","",$n));

          // is this a number?
          if(!is_numeric($n)) return false;

          // now filter it;
          if($n>1000000000000) return round(($n/1000000000000),1).' T';
            else if($n>1000000000) return round(($n/1000000000),1).' B';
            else if($n>1000000) return round(($n/1000000),1).' M';
            else if($n>1000) return round(($n/1000),1).' K';
          return number_format($n);
          }
                      
          $cid = (int)$_GET['cid'];
          if ($cid == 0) {$cid=3;}
          if ($cid != 0){
            $query_Contents =mysql_query("SELECT SUM(AllocationQ1) / 1000000 AS Net, SUM(ExpendedQ1) / 1000000 AS issues FROM quarterexpenditure where countyid = $cid");
          } else {
            $query_Contents =mysql_query("SELECT SUM( GrossEst_1 ) AS Gross, SUM( NetEst_1 ) AS Net, SUM( ExchIssues_1 ) AS issues FROM  nationalexpenditure WHERE  used =1");
          }
          $row_Contents=mysql_fetch_assoc($query_Contents);
          $issue = $row_Contents['issues'];
          $net = $row_Contents['Net'];
          //$pending = $cob + ($net - $cob);
          $mwaka = $_GET['mwaka'];
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

      $('.selectpicker').selectpicker({
        maxOptions: 1
	  });
      

       $(".selectpicker").change(function() {
		   
         var element = $('option:selected',this);
         var countyid = element.attr('value');
         window.location.href = './allocation.php?cid='+countyid;
       });
       
       $(".selectDeptpicker").change(function() {
		   
         var element = $('option:selected',this);
         var cid = element.attr('cid');
         var mwaka = element.attr('value');
         var dept = element.attr('dept');
         window.location.href = './allocation.php?cid='+cid+'&mwaka='+mwaka;
       });

      $('#VizTabs a').click(function (e) {
        e.preventDefault()
        $(this).tab('show')
      });
    }); 
    </script>

    <!-- Main Menu  -->
    <div class="main menu">
      <div class="container">
        <nav class="navbar navbar-default" role="navigation">
          <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav">
              <li class="#"><a href="index.php">Home</a></li>
              <li class="divider"></li>
              <li class="active"><a href="performance.php">County Overview</a></li>
              <li class="divider"></li>
              <li><a href="comparison.php">County Comparison</a></li>
              <li class="divider"></li>
              <li><a href="http://www.opencounty.org/">About Open County</a></li>
              <li class="divider"></li>
              <li><a href="contact.php">Contacts</a></li>
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
       
       <?php require('Includefiles/banner.php'); 
			
			$mwaka = $_GET['mwaka'];
			$dept = $_GET['dept'];
			$query_Contents_4 =mysql_query("SELECT distinct `mwaka` FROM `Department` where `countyid`=$cid ORDER BY `mwaka` ASC ");
			$totalRows_Contents_4 = mysql_num_rows($query_Contents_4);
			//echo $totalRows_Contents_4; exit;
			if ($totalRows_Contents_4!=0) {
		?>
        <div class="allocation row">
          <div class="col-md-3 regions"><!-- Sidebar -->
            <!-- Nav tabs -->
            <?php 
            $mwaka = $_GET['mwaka'];
      		$dept = $_GET['dept'];
            ?>
            <ul class="nav nav-pills" role="tablist">
              <li role="presentation" class="active" style="width:98%;background:#eee"><a id="depts" href="#departments" role="tab" data-toggle="tab"><?php if ($dept==""){ echo "Departments"; } else { echo "Projects";}?></a> 
              <div class="year">
                <small>Select Year: </small>
			          <select class="selectDeptpicker show-tick" data-live-search="true" data-size="10" name="mwaka">
      					<?php
      					while ($row_Contents_4=mysql_fetch_array($query_Contents_4)) {
      						  if ($mwaka == ""){$mwaka= $row_Contents_4['mwaka'];}
      						  if ($mwaka == $row_Contents_4['mwaka']){$sel = 'selected';}
      						  echo '<option cid='.$cid.' dept="'.$dept.'" '. $sel .'  value="'.$row_Contents_4['mwaka'].'">'.$row_Contents_4['mwaka'].'</option>'; 
      						  $sel = '';
      					 } 
      					 ?>
				        </select>
              </div>
            </li>
              <!-- <li role="presentation"><a id="devfns" href="#devolved" role="tab" data-toggle="tab">Devolved Functions</a></li> -->
            </ul>
            <!-- Tab panes -->
            <div class="tab-content">
              <div role="tabpanel" class="tab-pane active" id="departments">
                <table class="table table-bordered table-hover">
                  <tbody class="legends">
                    <?php
                    $QT = $_GET['QT'];
        			if ($cid == 0) {$cid=3;}
        			if ($QT == "") {		  
                    $query_Links5 ="SELECT distinct mwaka, sum(AllocationQ1) as AQ1, sum(AllocationQ2) as AQ2, sum(AllocationQ3) as AQ3, sum(AllocationQ4) as AQ4, sum(ExpendedQ1) as EQ1, sum(ExpendedQ2) as EQ2, sum(ExpendedQ3) as EQ3, sum(ExpendedQ4) as EQ4 FROM Department where countyid=$cid and mwaka = '$mwaka'";
                    $Contents5 = mysql_query($query_Links5, $conn) or die(mysql_error());
                    $row_Contents5 = mysql_fetch_assoc($Contents5);
                    
                    if (($row_Contents5['AQ1']!=0) || ($row_Contents5['EQ1']!=0)) { $AQ = 'AllocationQ1'; $EQ = 'ExpendedQ1';}
                    if (($row_Contents5['AQ2']!=0) || ($row_Contents5['EQ2']!=0)) { $AQ = 'AllocationQ2'; $EQ = 'ExpendedQ2';}
                    if (($row_Contents5['AQ3']!=0) || ($row_Contents5['EQ3']!=0)) { $AQ = 'AllocationQ3'; $EQ = 'ExpendedQ3';}
                    if (($row_Contents5['AQ4']!=0) || ($row_Contents5['EQ4']!=0)) { $AQ = 'AllocationQ4'; $EQ = 'ExpendedQ4';}
                    //echo $query_Links5;
                    } else {
					if ($QT=='AllocationQ1') { $AQ = 'AllocationQ1'; $EQ = 'ExpendedQ1';}
                    if ($QT=='AllocationQ2') { $AQ = 'AllocationQ2'; $EQ = 'ExpendedQ2';}
                    if ($QT=='AllocationQ3') { $AQ = 'AllocationQ3'; $EQ = 'ExpendedQ3';}
                    if ($QT=='AllocationQ4') { $AQ = 'AllocationQ4'; $EQ = 'ExpendedQ4';}
						
					}
					//echo $AQ;
                              if ($cid == 0) {
                                $result = mysql_query("SELECT id, indicators as 'DName', NetEst_1 as 'Allocation', ExchIssues_1 as 'ExpendedQ1' FROM  nationalexpenditure WHERE  used =1 ORDER BY id");
                              } else {
        						  if ($dept==""){
        							//  echo "SELECT Department.DName , (sum(Department.$AQ)/1000000) as Allocation, sum(Department.$EQ) as expenditure  FROM Department  where Department.countyid = $cid AND  Department.mwaka = '$mwaka'  group by  DName";
        							$result =mysql_query("SELECT Department.DName , sum(Department.$AQ) as Allocation, sum(Department.$EQ) as expenditure  FROM Department  where Department.countyid = $cid AND  Department.mwaka = '$mwaka'  group by  DName");
        							} else {
        								//echo "SELECT Department.Projects as DName, ((Department.$AQ)/1000000) as Allocation, (Department.$EQ) as expenditure  FROM Department  where Department.countyid = $cid AND  Department.mwaka = '$mwaka' AND Dname = '$dept'";
        							$result =mysql_query("SELECT Department.Projects as DName, Department.$AQ as Allocation, (Department.$EQ) as expenditure  FROM Department  where Department.countyid = $cid AND  Department.mwaka = '$mwaka' AND Dname = '$dept'");	
        								
        							}
                      }
                      
                      // Write rows
                      $k=1;
                      $letter = 'a';
                      if($_GET['dept']!=""){$level="";}else{$level="level2";}
                      //mysql_data_seek($projects, 0);
                      while ($row_Contents_2 = mysql_fetch_assoc($result)) {
                        $dept =  $row_Contents_2['DName'];
                      if ($letter=='i'){ $letter++; }
                      
                    ?>

                    <tr>
                      <td id="dept_<?php echo $row_Contents_2['id'];?>" class="<?php echo $level;?>  <?php if ((int)$_GET['dept'] == $dept){ echo 'active';} ?> legend <?php echo $letter;?>" dept="<?php echo $row_Contents_2['DName'];?>" cid="<?php echo $cid;?>" QT="<?php echo $AQ;?>"><i class="pointer"></i><?php echo $row_Contents_2['DName'] .' - '. bd_nice_number($row_Contents_2['Allocation']);?></td>
                    </tr>
                    <?php $letter++; } ?>
                  </tbody>
                </table>
              </div>
              <div role="tabpanel" class="tab-pane" id="devolved">
                <table class="table table-bordered table-hover">
                  <tbody class="legends">
                    <?php
                        $totalRows_Contents = mysql_num_rows($query_Contents_3);
                       // if ($mwaka == "") {$mwaka='2013'; }
                          $cid = (int)$_GET['cid'];
                          $did = (int)$_GET['did'];
			                   if ($cid == 0) {$cid=3;}
                        if ($cid == 0) {
                          $result = mysql_query("SELECT id, indicators as 'DName', NetEst_1 as 'Allocation', ExchIssues_1 as 'ExpendedQ1' FROM  nationalexpenditure WHERE  used =1 AND devolved=1 ORDER BY id");
                        } else {
                          $result =mysql_query("SELECT Department.id, Department.DName, (sum(Department.AllocationQ1)/1000000) as Allocation, sum(Department.ExpendedQ1) as expenditure  FROM Department  where Department.countyid = $cid AND devolved=0 AND  Department.mwaka = '$mwaka' group by  DName ORDER BY id");
                          
                        }

                        // Write rows
                        $k=1;
                        $letter = 'a';
                        if($_GET['dept']!=""){$level="";}else{$level="level2";}
                        //mysql_data_seek($projects, 0);
                        while ($row_Contents_2 = mysql_fetch_assoc($result)) {
                          $dept =  $row_Contents_2['DName'];
                        if ($letter=='i'){ $letter++; }
                        
                      ?>

                    <tr>
                      <td id="dept_<?php echo $row_Contents_2['id'];?>" class="<?php echo $level;?> <?php if ($_GET['dept'] == $dept){ echo 'active';} ?> legend <?php echo $letter;?>" dept="<?php echo $row_Contents_2['DName'];?>" cid="<?php echo $cid;?>"><?php echo $row_Contents_2['DName'] .' - '. number_format($row_Contents_2['Allocation']);?> M</td>
                    </tr>
                    <?php $letter++; } ?>
                  </tbody>
                </table>                  
              </div>
            </div>
              
            <table class="table table-bordered table-hover downloads">
              <thead><th>DOWNLOADS</th></thead>
                <tbody class="legends">
                  <tr>
                    <?php
                      $query_Links3 ="SELECT * FROM budgetdocs WHERE countyid=$cid";
                      $Contents3 = mysql_query($query_Links3, $conn) or die(mysql_error());
                      while ($row_Contents3 = mysql_fetch_array($Contents3)){
                        echo "<td class='level2 legend w'>
                                <a target='_blank' href='docs/".$row_Contents3['docurl'] ."'>".$row_Contents3['docname'] ."</a>
                                <!-- <i class='fa fa-download'></i>-->
                              </td>"; 
                      }
                    ?>
                  </tr>
                </tbody>
            </table>
          </div><!-- /.regions -->
          <!-- //End Sidebar -->

          <!-- Visualisations -->
          <div class="overall col-md-9">
            <!-- Toggle Menu -->
            <div class="section-toggle row">
              <div class="col-md-8">
                <ol class="breadcrumb">
                  <?php
                    $cid = (int)$_GET['cid'];
                    $did = (int)$_GET['did'];
                    $dept = $_GET['dept'];
                 if ($cid == 0) {$cid=3;}
                    if (($cid == 0) && ($dept == "")) {
                     echo '<li><h2 class="section-title">Allocation</h2></li><li><span>Departments</span></li>';
                    }
                    elseif (($cid == 0) && ($dept != "")) {
                    $query_Contents_0 =mysql_query("SELECT * FROM nationalexpenditure WHERE id =$did AND   used =1 ");
                    $row_Contents_0=mysql_fetch_array($query_Contents_0);
                       echo '<li><h2 class="section-title">Allocation</h2></li><li><span>'. $row_Contents_0['indicators'] .'</span></li><li>Projects</li>';
                    } 
                    elseif (($cid != 0) && ($dept == "")) {
                    $query_Contents_0 =mysql_query("SELECT county.id , county.countyname FROM county WHERE county.id = $cid ");
                    $row_Contents_0=mysql_fetch_array($query_Contents_0);
                       echo '<li><h2 class="section-title">Allocation</h2></li><li>Departments</li>';
                      
                    }
                    elseif (($cid != 0) && ($dept != "")) {
                    $query_Contents_B =mysql_query("SELECT Department.id, Department.Dname as Name, county.countyname, Department.countyid  FROM Department INNER JOIN county ON Department.countyid = county.id WHERE Department.Dname = '$dept' ");
                  $row_Contents_B=mysql_fetch_array($query_Contents_B);
                
                    echo '<li><h2 class="section-title"><a href="?cid='.$cid.'&mwaka='. $mwaka .'">Allocation</a></h2></li><li><span>' . $row_Contents_B['Name'] . '</span></li><li>Projects</li>';
                    }
                  ?> 
                  <!-- TO DO: activate this as a link for the department view as well -->   
                </ol>
              </div>
              <div class="col-md-4 toggle-menu">
                <div class="toggles">
                  <div class="btn-group">
                    <button type="button" class="btn btn-default active pie" cid="<?php echo $cid;?>" did="<?php echo $did;?>" dept="<?php echo $dept;?>">
                      <i class="icon-pie"></i>
                    </button>
                    <button type="button" class="btn btn-default bars" cid="<?php echo $cid;?>" did="<?php echo $did;?>" dept="<?php echo $dept;?>" QT="<?php echo $QT;?>" mwaka="<?php echo $mwaka;?>">
                      <i class="icon-bars"></i>
                    </button>
                    <button type="button" class="btn btn-default dataTable" cid="<?php echo $cid;?>" did="<?php echo $did;?>" dept="<?php echo $dept;?>" QT="<?php echo $QT;?>" mwaka="<?php echo $mwaka;?>">
                      <i class="icon-table"></i>
                    </button>
<!--
                    <button type="button" class="btn btn-default atAglance" cid="<?php echo $cid;?>" did="<?php echo $did;?>">
                      <i class="icon-info"></i>
                    </button>
-->
                  </div>
                </div><!-- /.toggles -->
              </div><!-- /.toggle-menu -->
          </div><!-- /.section-toggle -->
          <?php
            $AQ="";
      			  $query_Links5 ="SELECT distinct `mwaka`, sum(`AllocationQ1`) as AQ1, sum(`AllocationQ2`) as AQ2, sum(`AllocationQ3`) as AQ3, sum(`AllocationQ4`) as AQ4, sum(`ExpendedQ1`) as EQ1, sum(`ExpendedQ2`) as EQ2, sum(`ExpendedQ3`) as EQ3, sum(`ExpendedQ4`) as EQ4 FROM `Department` where `countyid`=$cid and mwaka ='$mwaka'";
      			  $Contents5 = mysql_query($query_Links5, $conn) or die(mysql_error());
      			  $row_Contents5 = mysql_fetch_assoc($Contents5);
      			  
      				if ((int)$row_Contents5['AQ1']!=0) { echo " <a class='quarter' id='AllocationQ1'  href='?cid=$cid&mwaka=$mwaka&QT=AllocationQ1'>Q1</a>"; $AQ = 'AllocationQ1';  $EQ = 'ExpendedQ1';}
      				
      				if ((int)$row_Contents5['AQ2']!=0) { if($AQ!=""){echo " | ";} echo " <a class='quarter'  id='AllocationQ2' href='?cid=$cid&mwaka=$mwaka&QT=AllocationQ2'>Q2</a>"; $AQ = 'AllocationQ2';  $EQ = 'ExpendedQ2';}
      				
      				if ((int)$row_Contents5['AQ3']!=0) { if($AQ!=""){echo " | ";} echo " <a class='quarter'  id='AllocationQ3' href='?cid=$cid&mwaka=$mwaka&QT=AllocationQ3'>Q3</a>"; $AQ = 'AllocationQ3';  $EQ = 'ExpendedQ3';}
      				
      				if ((int)$row_Contents5['AQ4']!=0) { if($AQ!=""){echo " | ";} echo " <a class='quarter' id='AllocationQ4' href='?cid=$cid&mwaka=$mwaka&QT=AllocationQ4'>Q4</a>"; $AQ = 'AllocationQ4';  $EQ = 'ExpendedQ4';}
      			 // echo $query_Links5;
      			?>      
          <!-- Pie Chart -->
          <div class="row" id="pie">
            <div class="col-md-12">
            
            <div id="pieChart"></div>
            </div>
          </div>
          <!-- /#pie -->

          <!-- Performance -->
          <div class="performance row" id="bars">
			<div class="col-md-12">
				<div id="PerformanceRst"></div>
            </div>
          </div><!-- /#bars -->

          <!-- Table -->            
          <div id="dataTable" class="data-table row">
            <div class="col-md-12" id="TableRst"></div>
          </div><!-- /#data_table /#dataTable -->

          <!-- Bullet Chart -->
<!--
          <div class="row" id="glance">
            <div class="panel" id="OverviewRst"></div>
          </div><!-- /#glance 
-->
                
          </div>
        </div><!-- /.overall -->
        <?php } else { echo "<h2>No Data Available</h2>";}?>
        
        <!-- End overall -->
        
      </div><!-- /.allocation -->
      <!-- //End Allocation -->

    </div><!-- /.container -->
  </div><!-- /.main -->
  <!-- //End Content -->


  <!-- Footer -->
  <?php include ("./Includefiles/footer.php"); ?>
  <!-- //End Footer -->


  <!-- Include all compiled plugins (below), or include individual files as needed -->
  <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
  <script src="js/bootstrap-progressbar.js"></script>
  <script src="js/d3.min.js"></script>
  <script src="js/d3.pie.js"></script>
  <script src="js/angular.js"></script>
  <script src="js/nv.d3.js"></script>
  <script src="js/angularjs-nvd3-directives.js"></script>
    
  <script type="text/javascript" src="js/bootstrap-select.js"></script>
    
  <script src="js/control.js"></script>
  
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
          $mwaka = $_GET['mwaka'];
          $cid = (int)$_GET['cid'];
          $did = (int)$_GET['did'];
          $dept = $_GET['dept'];
          $QT = $_GET['QT'];
           if ($cid == 0) {$cid=3;}
           //~ $query_Links5 ="SELECT distinct `mwaka`, sum(`AllocationQ1`) as AQ1, sum(`AllocationQ2`) as AQ2, sum(`AllocationQ3`) as AQ3, sum(`AllocationQ4`) as AQ4 FROM `Department` where `countyid`=$cid and mwaka ='$mwaka'";
			  //~ $Contents5 = mysql_query($query_Links5, $conn) or die(mysql_error());
			  //~ $row_Contents5 = mysql_fetch_assoc($Contents5);
				//~ if ($row_Contents5['AQ1']!=0) { $AQ = 'AllocationQ1';}
				//~ if ($row_Contents5['AQ2']!=0) { $AQ = 'AllocationQ2';}
				//~ if ($row_Contents5['AQ3']!=0) { $AQ = 'AllocationQ3';}
				//~ if ($row_Contents5['AQ4']!=0) { $AQ = 'AllocationQ4';}
              //~ $QT = $_GET['QT'];
				//~ if ($QT == "") {$QT=$AQ; } 
				
		  $query_Contents_4 =mysql_query("SELECT  distinct mwaka FROM Department where countyid=$cid ORDER BY mwaka ASC LIMIT 1");
		  $row_Contents_4 = mysql_fetch_assoc($query_Contents_4);
		  if ($mwaka == ""){$mwaka= $row_Contents_4['mwaka'];}
                
        if ($QT=="") {$QT = $AQ;}
      //  echo $QT;
        //~ if ($cid == 0) {
          //~ $query_ContentsB =mysql_query("SELECT SUM( GrossEst_1 ) AS Gross, SUM( NetEst_1 ) AS netbudget, SUM( ExchIssues_1 ) AS cob FROM nationalexpenditure WHERE  used =1");
        //~ } else {
          //~ $query_ContentsB =mysql_query("SELECT  SUM($QT)/1000000 as 'netbudget' , SUM($EQ)/1000000 as 'cob' FROM Department WHERE countyid = $cid ");
        //~ }
          //~ $row_ContentsB=mysql_fetch_assoc($query_ContentsB);
          //~ $cobB = $row_ContentsB['cob'];
          //~ $netB = $row_ContentsB['netbudget'];
          //~ $pending = $cobB + ($netB - $cobB);
      ?>
		$('#<?php echo $QT;?>').addClass('active');
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
                $cid = (int)$_GET['cid'];
                $dept = $_GET['dept'];
	if ($cid == 0) {$cid=3;}

              if (($cid == 0) && ($dept == "")){
                $result = mysql_query("SELECT id, indicators AS Name, ExchIssues_1 as Alloc,NetEst_1 as Val FROM nationalexpenditure WHERE  used =1 ");
              } 
              elseif (($cid == 0) && ($dept != "")) {
               $result = mysql_query("SELECT id, indicators AS Name, ExchIssues_1 as Alloc,NetEst_1 as Val FROM nationalexpenditure WHERE id = $did AND   used =1 ");
              }
              elseif (($cid != 0) && ($dept == "")) {
                $result = mysql_query("SELECT id, Department.DName as Name, (sum($QT)/1000000) as Val, sum(Department.$EQ) as Exp  FROM Department  where Department.countyid = $cid AND  Department.mwaka = '$mwaka' group by  DName ORDER BY Name");
              }
              elseif (($cid != 0) && ($dept != "")) {
                $result = mysql_query("SELECT id, ($QT/1000000) as Val, ($EQ/1000000) as Exp, Projects as Name  FROM Department WHERE  Dname = '$dept' AND  mwaka = '$mwaka' AND countyid = $cid");
              }
              //echo "SELECT id, ($QT/1000000) as Val, ($EQ/1000000) as Exp, Projects as Name  FROM Department WHERE  Dname = '$dept' AND  mwaka = '$mwaka' ";
              // Write rows
              $k=1;
              $letter = 'a';
              $separator='';
              //mysql_data_seek($projects, 0);
              while ($row_Contents_2 = mysql_fetch_assoc($result)) {
               // $did =  $row_Contents_2['id'];
              echo $separator;
              if ($letter=='i'){ $letter++; }
                echo '{"label": "'.  $row_Contents_2['Name'] .'",';
                echo '    "value": '.  $row_Contents_2['Val'] .',';
                echo '    "color": getStyleSheetPropertyValue(".legends td.legend.'.$letter.'", "border-right-color"),';
                echo '    "cid": "'. $cid .'",';
                echo '    "dept": "'. $row_Contents_2['Name'] .'"';
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
            "hideWhenLessThanPercentage": 6
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
          var dept = a.data.dept;
          // alert(cid);
          window.location.href='allocation.php?mwaka=<?php echo $mwaka;?>&cid='+ cid +'&dept=' + dept;
          }
        }
      });              
      
    })();
    

    $(".dropdown-menu").on("click", "li", function(){
      var cid =$(this).attr('cid');// $(this).text();
      window.location.href='allocation.php?cid=' + cid;
    });

    $("td.level2").click(function(){
      var cid = $(this).attr('cid');
      var did = $(this).attr('did');
      var dept = $(this).attr('dept');
      var QT = $(this).attr('QT');
      if(dept!=""){
		  $("td").removeClass("level2");
	  }
    //   alert(cid);
      window.location.href='allocation.php?mwaka=<?php echo $mwaka;?>&cid=' + cid +'&dept=' + dept +'&QT=' + QT;
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
         $("#dataTable").hide("slow");
        $(".section-title").html('Allocation');
      }

      if ($(this).hasClass('bars')){
        $(this).addClass("active");
        $("#pie").hide("slow");
        $("#bars").show("slow");
        $("#glance").hide("slow");
         $("#dataTable").hide("slow");
        
          var cid = $(this).attr('cid');
          var did = $(this).attr('did');
          var dept = $(this).attr('dept');
          var qt = $(this).attr('QT');
          var mw = $(this).attr('mwaka');
          if (dept=="") {
			  $(".section-title").html('Performance');
		  } else {
			  $(".section-title a").html('Performance');
		  }
          
          performanceAJAX(cid,did,dept,qt,mw);
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
          var dept = $(this).attr('dept');
          var qt = $(this).attr('QT');
          var mw = $(this).attr('mwaka');
          overviewAJAX(cid,did,dept,qt,mw);
        $(".section-title").html('Information');
      }
      
      if ($(this).hasClass('dataTable')){
        $(this).addClass("active");
        $("#pie").hide("slow");
        $("#bars").hide("slow");
        $("#glance").hide("slow");
        $("#dataTable").show("slow");
        
          var cid = $(this).attr('cid');
          var did = $(this).attr('did');
          var dept = $(this).attr('dept');
          var qt = $(this).attr('QT');
          var mw = $(this).attr('mwaka');
          if (dept=="") {
			  $(".section-title").html('Data Table');
		  } else {
			  $(".section-title a").html('Data Table');
		  }
          tableAJAX(cid,did,dept,qt,mw);
      }
      //window.location.href='performance.php?cid=' + cid +'&did=' + did;
    
    });
        
    //~ function overviewAJAX(c,d,dt) {
      //~ //alert(d);
      //~ // Ent_id = $("input[name='Merge[]']:checked").val();
      //~ $.ajax({
        //~ url: "ajax_overview.php",
        //~ type: "post",
        //~ async: false, 
        //~ data: {cid : c, did : d, dept : dt},
        //~ success:function(dat){
//~ 
          //~ $("#OverviewRst").html(dat);
          //~ // alert(dat);
          //~ //$("#result").html("Update Done");
        //~ },
        //~ error:function(d){
          //~ alert("failure"+d);
          //~ $("#OverviewRst").html('there is error while submit');
        //~ }
      //~ }); 
    //~ }

    function performanceAJAX(c,d,dt,qt,mw) {
      //alert(d);
      // Ent_id = $("input[name='Merge[]']:checked").val();
      $.ajax({
        url: "ajax_performance.php",
        type: "post",
        async: false, 
        data: {cid : c, did : d, dept : dt, QT : qt, mwaka : mw},
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

    function tableAJAX(c,d,dt,qt,mw) {
      // Ent_id = $("input[name='Merge[]']:checked").val();
      $.ajax({
        url: "ajax_table.php?mwaka=<?php echo $mwaka;?>",
        type: "post",
        async: false, 
        data: {cid : c, did : d, dept : dt, QT : qt, mwaka : mw},
        success:function(dat){

          $("#TableRst").html(dat);
          // alert(dat);
          //$("#result").html("Update Done");
        },
        error:function(d){
          alert("failure"+d);
          $("#TableRst").html('there is error while submit');
        }
      }); 
    }
    </script>
  </body>
</html>
