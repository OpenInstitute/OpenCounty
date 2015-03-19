<?php require('Includefiles/header.php'); ?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>

<?php
  $cid = (int)$_GET['cid'];
  if ($cid == 0) {$cid=3;}
?>
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
		  
        <?php require('Includefiles/banner.php'); ?>

        <div class="download row" style="padding: 3rem 0;">
          <nav class="col-md-3 bs-docs-sidebar">
            <ul id="sidebar" class="nav nav-stacked">
              <li>
                <a href="#CountyBudget">County Budget</a>
                <ul class="nav nav-stacked">
                  <li><a href="#BudgetDocs">County Budget Documents</a></li>
                  <li><a href="#Revenue">Revenue</a></li>
                  <li><a href="#Expenditure">Expenditure</a></li>
                  <li><a href="#Online">Budget Information Published Online</a></li>
                  <li><a href="#AllocExp">Allocation and Expenditure</a></li>
                </ul>
              </li>
              <li>
                <a href="#Leadership">County Leadership & Contacts</a>
                <ul class="nav nav-stacked">
                  <li><a href="#Administration">Administration</a></li>
                  <li><a href="#Contacts">Contacts</a></li>
                  <li><a href="#MCAs">MCAs</a></li>
                  <li><a href="#MPs">MPs</a></li>
                  <li><a href="#MCAData">Distribution of County Assembly Wards</a></li>
                </ul>
              </li>
            </ul>
          </nav>
          <div class="col-md-9">
            <section id="CountyBudget" class="group">
              <h2>County Budget</h2>
              <div id="BudgetDocs" class="subgroup">
                <table class="table table-condensed table-hover">
                  <caption>County Budget Documents</caption>
                  <thead>
                    <th>Document Name</th>
                    <th>Source</th>
                    <!-- <th>Author</th> -->
                    <!-- <th>Published</th> -->
                    <!-- <th>Uploaded on</th> -->
                    <!-- <th>Source URL</th> -->
                    <!-- <th>Format</th> -->
                    <th>Download</th>
                  </thead>
                  <?php
                    $query_Contents_3 = mysql_query("SELECT * FROM budgetdocs WHERE countyid = $cid");
                    while ($row_Contents_3 = mysql_fetch_array($query_Contents_3)) {
                  ?>
                  <tr>
                    <td><?php echo $row_Contents_3['docname']; ?></td>
                    <td><?php if(!empty($row_Contents_3['Source_Website'])) { echo '<a href="'.$row_Contents_3["Source_Website"].'" target="_blank">'.$row_Contents_3['Source'].'</a>'; } else { echo $row_Contents_3['Source']; } ?></td>
                    <!-- <td><?php if(!empty($row_Contents_3['Author_URL'])) { echo '<a href="'.$row_Contents_3["Author_URL"].'" target="_blank">'.$row_Contents_3['Author'].'</a>'; } else { echo $row_Contents_3['Author']; } ?></td> -->
                    <!-- <td><?php echo $row_Contents_3['Pub_Date']; ?></td> -->
                    <!-- <td><?php echo $row_Contents_3['UploadDate']; ?></td> -->
                    <!-- <td><a href="<?php echo $row_Contents_3['DocSource_URL']; ?>" target="_blank"><?php echo $row_Contents_3['DocSource_URL']; ?></a></td> -->
                    <!-- <td><?php echo $row_Contents_3['Format']; ?></td> -->
                    <td><a href="./docs/<?php echo $row_Contents_3['docurl']; ?>">Download <?php echo $row_Contents_3['Format']; ?></a></td>
                  </tr>
                  <?php } ?>
                </table> 
              </div>
              <div id="Revenue" class="subgroup">
                <?php
                  $query_Contents_4 = mysql_query("SELECT * FROM WB_Revenue WHERE countyid = $cid");
                  $row_Contents_4=mysql_fetch_array($query_Contents_4);
                ?>
                <table class="table table-hover">
                  <caption>
                    Funds Available to <?php echo $row_Contents_4['County']; ?> County in the Period July to December, 2013
                  </caption>
                  <tr>
                    <td>Funds Released From Consolidated Fund to County Revenue Fund</td>
                    <td class="num"><?php echo number_format($row_Contents_4['CDFReleased']); ?></td>
                  </tr>
                  <tr>
                    <td>Local Revenue Collection</td>
                    <td class="num"><?php echo number_format($row_Contents_4['LocalRevenueCollected']); ?></td>
                  </tr>
                  <tr>
                    <td>Total Revenue for the Quarter</td>
                    <td class="num"><?php echo number_format($row_Contents_4['TotRevenue']); ?></td>
                  </tr>
                  <tr>
                    <td>Exechequer Release to County</td>
                    <td class="num"><?php echo number_format($row_Contents_4['Allocation']); ?></td>
                  </tr>
                </table>
              </div>
              <div id="Expenditure" class="subgroup">
                <?php
                  $query_Contents_4 = mysql_query("SELECT * FROM WB_Revenue WHERE countyid = $cid");
                  $row_Contents_4=mysql_fetch_array($query_Contents_4);
                ?>
                <table class="table table-hover">
                  <caption>
                    <?php echo $row_Contents_4['County']; ?> County Expenditure in the Period July to December, 2013
                  </caption>
                  <tr>
                    <td>Personnel Emoluments</td>
                    <td class="num"><?php echo number_format($row_Contents_4['PEEXP']); ?></td>
                  </tr>
                  <tr>
                    <td>Operation & Maintenance</td>
                    <td class="num"><?php echo number_format($row_Contents_4['OMExp']); ?></td>
                  </tr>
                  <tr>
                    <td>Development Expenditure</td>
                    <td class="num"><?php echo number_format($row_Contents_4['DevelopmentExp']); ?></td>
                  </tr>
                  <tr>
                    <td>Debt Repayment & Pending Bills</td>
                    <td class="num"><?php echo number_format($row_Contents_4['DebtRepayment']); ?></td>
                  </tr>
                  <tr>
                    <td>Total Expenditure</td>
                    <td class="num"><?php echo number_format($row_Contents_4['Expenditure']); ?></td>
                  </tr>
                </table>
              </div>
              <div id="Online" class="subgroup">
                <h4>Budget Information Published Online</h4>
                <table class="table table-condensed table-bordered table-hover metadata">
                  <caption>About this Dataset</caption>
                  <tr>
                    <td>Source</td>
                    <td><a href="internationalbudget.org/kenya" target="_blank">International Budget Partnership (IBP)</a></td>
                  </tr>
                  <tr>
                    <td>Title</td>
                    <td>Kenya: How Much Budget Information are Counties Publishing Online?</td>
                  </tr>
                  <tr>
                    <td>Published</td>
                    <td>January 2015</td>
                  </tr>
                  <tr>
                    <td>Added to Open County Dashboard</td>
                    <td>February 27, 2015</td>
                  </tr>
                  <tr>
                    <td>Last accessed on</td>
                    <td>March 12, 2015</td>
                  </tr>
                  <tr>
                    <td>Source URL</td>
                    <td><a href="http://internationalbudget.org/tracking-county-budget-information-kenya/" target="_blank">http://internationalbudget.org/tracking-county-budget-information-kenya/</a></td>
                  </tr>
                  <tr>
                  </tr>
                </table>
                <?php
                  $query_Contents_5 = mysql_query("SELECT * FROM IBPOnlineBudget2014 WHERE countyid = $cid");
                  $row_Contents_5=mysql_fetch_array($query_Contents_5);
                ?>
                <table class="table table-hover online">
                  <caption>
                    <?php echo $row_Contents_5['County']; ?> County Budget Information Published Online
                  </caption>
                  <tr>
                    <td>County Assembly Website/Email</td>
                    <td><?php if(!empty($row_Contents_5['CAWebEmail'])) { ?><a href="<?php echo $row_Contents_5['CAWebEmail']; ?>" target="_blank"><?php echo $row_Contents_5['CAWebEmail']; ?></a><?php } else { echo 'Not available'; } ?></td>
                  </tr>
                  <tr>
                    <td>Budget Estimates (Proposed Budgets) 2014/15</td>
                    <td><?php if(!empty($row_Contents_5['IBP_BudgetEstimates1415'])) { ?><a href="<?php echo $row_Contents_5['IBP_BudgetEstimates1415']; ?>" target="_blank"><?php echo $row_Contents_5['IBP_BudgetEstimates1415']; ?></a><?php } else { echo 'Not available'; } ?></td>
                  </tr>
                  <tr>
                    <td>Approved Estimates (Enacted Budgets)2014/15</td>
                    <td><?php if(!empty($row_Contents_5['IBP_ApprovedEstimates1415'])) { ?><a href="<?php echo $row_Contents_5['IBP_ApprovedEstimates1415']; ?>" target="_blank"><?php echo $row_Contents_5['IBP_ApprovedEstimates1415']; ?></a><?php } else { echo 'Not available'; } ?></td>
                  </tr>
                  <tr>
                    <td>County Fiscal Strategy Paper, 2014</td>
                    <td><?php if(!empty($row_Contents_5['IBP_CFSP14'])) { ?><a href="<?php echo $row_Contents_5['IBP_CFSP14']; ?>" target="_blank"><?php echo $row_Contents_5['IBP_CFSP14']; ?></a><?php } else { echo 'Not available'; } ?></td>
                  </tr>
                  <tr>
                    <td>Implementation Reports, 2014/15</td>
                    <td><?php if(!empty($row_Contents_5['IBP_ImplementationReport1415'])) { ?><a href="<?php echo $row_Contents_5['IBP_ImplementationReport1415']; ?>" target="_blank"><?php echo $row_Contents_5['IBP_ImplementationReport1415']; ?></a><?php } else { echo 'Not available'; } ?></td>
                  </tr>
                  <tr>
                    <td>County Budget Review and Outlook Paper, 2014</td>
                    <td><?php if(!empty($row_Contents_5['IBP_BudgetROPaper14'])) { ?><a href="<?php echo $row_Contents_5['IBP_BudgetROPaper14']; ?>" target="_blank"><?php echo $row_Contents_5['IBP_BudgetROPaper14']; ?></a><?php } else { echo 'Not available'; } ?></td>
                  </tr>
                  <tr>
                    <td>Annual Plans, 2015/16</td>
                    <td><?php if(!empty($row_Contents_5['IBP_AnnualPlan1516'])) { ?><a href="<?php echo $row_Contents_5['IBP_AnnualPlan1516']; ?>" target="_blank"><?php echo $row_Contents_5['IBP_AnnualPlan1516']; ?></a><?php } else { echo 'Not available'; } ?></td>
                  </tr>
                  <tr>
                    <td>CIDP</td>
                    <td><?php if(!empty($row_Contents_5['IBP_CIDP'])) { ?><a href="<?php echo $row_Contents_5['IBP_CIDP']; ?>" target="_blank"><?php echo $row_Contents_5['IBP_CIDP']; ?></a><?php } else { echo 'Not available'; } ?></td>
                  </tr>
                  <tr>
                    <td>Access Date</td>
                    <td><?php if(!empty($row_Contents_5['IBP_AccessDate'])) { ?><?php echo $row_Contents_5['IBP_AccessDate']; ?><?php } else { echo 'Not available'; } ?></td>
                  </tr>
                  <tr>
                    <td>Notes</td>
                    <td><?php if(!empty($row_Contents_5['IBP_Notes'])) { ?><?php echo $row_Contents_5['IBP_Notes']; ?><?php } else { echo 'Not available'; } ?></td>
                  </tr>
                </table>
              </div>
              <div id="AllocExp" class="subgroup">
                <table class="table table-condensed table-hover">
                  <caption>Allocations and Expenditure</caption>
                  <!-- BENJ - CODE GOES HERE -->
                  <caption>Year: <span class="year">2014/15 | <a href="#">2013/14</a> | 2012/13</span> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Period: <span class="period"><a href="#">Q1</a> | Q2 | Q3 | Q4</span></caption>
                  <thead>
                    <th>Department</th>
                    <th>Project</th>
                    <th>Allocation</th>
                    <th>Expenditure</th>
                  </thead>
                  <?php
                    $allocexp = mysql_query("SELECT * FROM Department WHERE countyid = $cid");
                    while ($alloc = mysql_fetch_array($allocexp)) {
                      $year = $alloc['mwaka'];
                        $y14 = '2014/2015';
                        $y13 = '2013/2014';
                        $y12 = '2012/2013';
                      $allocq1 = $alloc['AllocationQ1'];
                      $allocq2 = $alloc['AllocationQ2'];
                      $allocq3 = $alloc['AllocationQ3'];
                      $allocq4 = $alloc['AllocationQ4'];
                      $expq1 = $alloc['ExpendedQ1'];
                      $expq2 = $alloc['ExpendedQ2'];
                      $expq3 = $alloc['ExpendedQ3'];
                      $expq4 = $alloc['ExpendedQ4'];
                      if ($year == $y13) {
                  ?>
                  <tr>
                    <td><?php echo $alloc['Dname']; ?></td>
                    <td><?php echo $alloc['Projects']; ?></td>
                    <td class="num"><?php echo number_format($alloc['AllocationQ1']); ?></td>
                    <td class="num"><?php echo number_format($alloc['ExpendedQ1']); ?></td>
                  </tr>
                  <?php } } ?>
                </table> 
              </div>
            </section>
            <section id="Leadership" class="group">
              <h2>County Leadership</h2>
              <div id="Administration" class="subgroup">
                <?php
                  $query_Contents_6 = mysql_query("SELECT * FROM countyInfo WHERE countyid = $cid");
                  $row_Contents_6=mysql_fetch_array($query_Contents_6);
                ?>
                <table class="table table-condensed table-hover">
                  <caption>Administration</caption>
                  <tr>
                    <td>Governor</td>
                    <td><?php echo $row_Contents_6['Governor']; ?></td>
                  </tr>
                  <tr>
                    <td>Deputy Governor</td>
                    <td><?php echo $row_Contents_6['DeputyGovernor']; ?></td>
                  </tr>
                  <tr>
                    <td>Senator</td>
                    <td><?php echo $row_Contents_6['Senator']; ?></td>
                  </tr>
                  <tr>
                    <td>Women Representative</td>                    
                    <td><?php echo $row_Contents_6['WomenRep']; ?></td>
                  </tr>
                </table> 
              </div>
              <div id="Contacts" class="subgroup">
                <table class="table table-condensed table-hover">
                  <caption>Contacts</caption>
                  <tr>
                    <td>County Website</td>
                    <td><?php if(!empty($row_Contents_6['Website'])) { ?><a href="<?php echo $row_Contents_6['Website']; ?>" target="_blank"><?php echo $row_Contents_6['Website']; ?></a><?php } else { echo 'Not available'; } ?></td>
                  </tr>
                  <tr>
                    <td>County Assembly Website</td>
                    <td><?php if(!empty($row_Contents_5['CAWebEmail'])) { ?><a href="<?php echo $row_Contents_5['CAWebEmail']; ?>" target="_blank"><?php echo $row_Contents_5['CAWebEmail']; ?></a><?php } else { echo 'Not available'; } ?></td>
                  </tr>
                  <tr>
                    <td>Email</td>
                    <td><?php if(!empty($row_Contents_6['Email'])) { ?><a href="mailto:<?php echo $row_Contents_6['Email']; ?>"><?php echo $row_Contents_6['Email']; ?></a><?php } else { echo 'Not available'; } ?></td>
                  </tr>
                  <tr>
                    <td>Office of the Governor Email</td>
                    <td><?php if(!empty($row_Contents_6['OfficeGovernorEmail'])) { ?><a href="mailto:<?php echo $row_Contents_6['OfficeGovernorEmail']; ?>"><?php echo $row_Contents_6['OfficeGovernorEmail']; ?></a><?php } else { echo 'Not available'; } ?></td>
                  </tr>
                  <tr>
                    <td>Office of the Deputy Governor Email</td>
                    <td><?php if(!empty($row_Contents_6['OfficeDeputyGovernorEmail'])) { ?><a href="mailto:<?php echo $row_Contents_6['OfficeDeputyGovernorEmail']; ?>"><?php echo $row_Contents_6['OfficeDeputyGovernorEmail']; ?></a><?php } else { echo 'Not available'; } ?></td>
                  </tr>
                  <tr>
                    <td>Twitter</td>
                    <td><?php if (!empty($row_Contents_6['Twitter'])) { ?><a href="<?php echo $row_Contents_6['Twitter']; ?>" target="_blank">@<?php echo $row_Contents_6['Twitter']; ?></a><?php } else { echo 'Not available'; } ?></td>
                  </tr>
                  <tr>
                    <td>Facebook</td>
                    <td><?php if(!empty($row_Contents_6['Facebook'])) { ?><a href="<?php echo $row_Contents_6['Facebook']; ?>" target="_blank"><?php echo $row_Contents_6['Facebook']; ?></a><?php } else { echo 'Not available'; } ?></td>
                  </tr>
                  <tr>
                    <td>YouTube</td>                    
                    <td><?php if(!empty($row_Contents_6['YouTube'])) { ?><a href="<?php echo $row_Contents_6['YouTube']; ?>" target="_blank"><?php echo $row_Contents_6['YouTube']; ?></a><?php } else { echo 'Not available'; } ?></td>
                  </tr>
                  <tr>
                    <td>Postal Address</td>
                    <td><?php if(!empty($row_Contents_6['PostalAddress'])) { ?><?php echo $row_Contents_6['PostalAddress']; ?><?php } else { echo 'Not available'; } ?></td>
                  </tr>
                  <tr>
                    <td>Telephone</td>
                    <td><?php if(!empty($row_Contents_6['Telephone'])) { ?><?php echo $row_Contents_6['Telephone']; ?><?php } else { echo 'Not available'; } ?></td>
                  </tr>
                </table> 
              </div>
              <div id="MCAs" class="subgroup">
                <table class="table table-condensed table-hover">
                  <caption>MCAs</caption>
                  <thead>
                    <th>Constituency</th>
                    <th>Ward</th>
                    <th>MCA</th>
                    <th>Political Party</th>
                  </thead>
                  <?php
                    $query_Contents_7 = mysql_query("SELECT * FROM mcas WHERE countyid = $cid");
                    while($row_Contents_7=mysql_fetch_array($query_Contents_7)){
                  ?>
                  <tr>
                    <td><?php echo $row_Contents_7['Constituency']; ?></td>
                    <td><?php echo $row_Contents_7['Ward']; ?></td>
                    <td><?php echo $row_Contents_7['MCAName']; ?><?php if(empty($row_Contents_7['Constituency'])) { echo ' (Nominated)'; } ?></td>
                    <td><?php echo $row_Contents_7['Party']; ?></td>
                  </tr>
                  <?php } ?>
                </table> 
              </div>
              <div id="MPs" class="subgroup">
                <table class="table table-condensed table-hover">
                  <caption>MPs</caption>
                  <thead>
                    <th>Constituency</th>
                    <th>MP</th>
                    <th>Political Party</th>
                  </thead>
                  <?php
                    $query_Contents_8 = mysql_query("SELECT * FROM MPs WHERE countyid = $cid");
                    while($row_Contents_8=mysql_fetch_array($query_Contents_8)){
                  ?>
                  <tr>
                    <td><?php echo $row_Contents_8['Constituency']; ?></td>
                    <td><?php echo $row_Contents_8['MPName']; ?></td>
                    <td><?php echo $row_Contents_8['Party']; ?></td>
                  </tr>
                  <?php } ?>
                </table> 
              </div>
              <div id="MCAData" class="subgroup">
                <?php
                  $query_Contents_9 = mysql_query("SELECT * FROM MCAData WHERE countyid = $cid");
                  $row_Contents_9=mysql_fetch_array($query_Contents_9);
                ?>
                <table class="table table-condensed table-hover">
                  <caption>Distribution of County Assembly Wards</caption>
                  <tr>
                    <td>Population</td>
                    <td><?php echo number_format($row_Contents_9['Population']); ?></td>
                  </tr>
                  <tr>
                    <td>Number of Constituencies</td>
                    <td><?php echo $row_Contents_9['ConstituencyNo']; ?></td>
                  </tr>
                  <tr>
                    <td>Number of County Assembly Wards</td>
                    <td><?php echo $row_Contents_9['AssemblyWardsNo']; ?></td>
                  </tr>
                  <tr>
                    <td>MCAs Nominated to County Assembly Wards: Number of Seats Allocated (Marginalized)</td>
                    <td><?php echo $row_Contents_9['SeatsAllocMarginalized']; ?></td>
                  </tr>
                  <tr>
                    <td>MCAs Nominated to County Assembly Wards: Number of Seats Allocated (Gender top up list)</td>
                    <td><?php echo $row_Contents_9['SeatsAllocated']; ?></td>
                  </tr>
                  <tr>
                    <td>MCAs Nominated to County Assembly Wards: Total No. of MCAs</td>
                    <td><?php echo $row_Contents_9['TotNomMCAs']; ?></td>
                  </tr>
                  <tr>
                    <td>Total No. of MCAs (Elected and Norminated)</td>
                    <td><?php echo $row_Contents_9['TotMCAs']; ?></td>
                  </tr>
                  <tr>
                    <td>MCA Expenditure (Kshs. Millions)</td>
                    <td><?php echo number_format($row_Contents_9['MCAExpenditure']); ?></td>
                  </tr>
                  <tr>
                    <td>Allowance per MCA</td>
                    <td><?php echo number_format($row_Contents_9['AllowancePerMCA']); ?></td>
                  </tr>
                  <tr>
                    <td>Monthly per person</td>
                    <td><?php echo number_format($row_Contents_9['MonthlyPerPerson']); ?></td>
                  </tr>
                </table> 
              </div>
            </section>
          </div>
        </div>
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
	$(document).ready(function() {

    $('body').scrollspy({
        target: '.bs-docs-sidebar',
        offset: 40
    });
    $("#sidebar").affix({
        offset: {
          top: 500
        }
    });
		
		$(".dropdown-menu").on("click", "li", function(){
		  var cid =$(this).attr('cid');// $(this).text();
		  window.location.href='performance.php?cid=' + cid;
		});
		
		$('.selectpicker').selectpicker({
        maxOptions: 1
		});
      

       $(".selectpicker").change(function() {
		   
         var element = $('option:selected',this);
         var countyid = element.attr('value');
         window.location.href = './downloads.php?cid='+countyid;
       });
	});
    </script>
    
    <?php 
	function formatter($text){
		//echo $text; 
		$list="<ul>";
		$t = explode('|', $text);
		for($i=0; $i < count($t); $i++){
			$tCont = explode(':', $t[$i]);
			$list .= "<span>". $tCont[0] ."</span>";
			
			$tD = explode(';', $tCont[1]);
			for($j=0; $j<count($tD); $j++){
				$list .= "<li>".  $tD[$j] ."</li>";
			}
		}
		$list.="</ul>";
		echo $list;
	}
?>

  </body>
</html>
