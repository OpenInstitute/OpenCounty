<?php require('./Includefiles/conn.inc'); ?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta charset="UTF-8"/>
	<title>Open County National Budget Sample</title>
	<link type="text/css" rel="stylesheet" href="build/nv.d3.css" />
	<link type="text/css" rel="stylesheet" href="build/foundation.css" />
	<link type="text/css" rel="stylesheet" href="build/normalize.css" />
	<link type="text/css" rel="stylesheet" href="build/custom.css" />

	<link href="//netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css" rel="stylesheet">

	<link type="text/css" rel="stylesheet" href="http://fonts.googleapis.com/css?family=Lato:400,700|Raleway:400,500,700|Roboto:400,700"/>
	
		
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>
<script src="lib/fd-slider/fd-slider.js" type="text/javascript"></script>
<script src="lib/gauge.min.js"></script>
	 <script type="text/javascript">
          		   
			function initGauge(){

				var opts1 = {
				  lines: 12, // The number of lines to draw
				  angle: 0, // The length of each line
				  lineWidth: 0.24, // The line thickness
				  pointer: {
				    length: 0.7, // The radius of the inner circle
				    strokeWidth: 0.035, // The rotation offset
				    color: '#000000' // Fill color
				  },
				  limitMax: 'false',   // If true, the pointer will not go past the end of the gauge
				  colorStart: '#6FADCF',   // Colors
				  colorStop: '#8FC0DA',    // just experiment with them
				  strokeColor: '#E0E0E0',   // to see which ones work best for you
				  generateGradient: false
				};
				var opts2 = {
				  lines: 12, // The number of lines to draw
				  angle: 0, // The length of each line
				  lineWidth: 0.24, // The line thickness
				  pointer: {
				    length: 0.7, // The radius of the inner circle
				    strokeWidth: 0.035, // The rotation offset
				    color: '#000000' // Fill color
				  },
				  limitMax: 'false',   // If true, the pointer will not go past the end of the gauge
				  colorStart: '#6FADCF',   // Colors
				  colorStop: '#F1592A',    // just experiment with them
				  strokeColor: '#E0E0E0',   // to see which ones work best for you
				  generateGradient: false
				};
		   
		<?php 
		$mwaka= (int)$_GET['mwaka'];
		$deptid = (int)$_GET['deptid'];
		$countyid = (int)$_GET['countyid'];
		$deptid = (int)$_GET['deptid'];
		
           	$query_Contents =mysql_query("SELECT  Projects ,  AmountReleased ,  AmountExpenses FROM  projects WHERE  departmentid = $deptid");
           	
		$c=1;
		while($row_Contents=mysql_fetch_array($query_Contents)){
		?>

		<?php if (($row_Contents['AmountReleased']) > ($row_Contents['AmountExpenses'])){ ?>
		var target<?php echo $c?> = document.getElementById("chartdiv_<?php echo $c?>"); // your canvas element
		var gauge<?php echo $c?> = new Gauge(target<?php echo $c?>).setOptions(opts1); // create sexy gauge!
		document.getElementById("preview_<?php echo $c?>").innerHTML = "<?php echo (int)($row_Contents['AmountExpenses']/1000000);?> out of <?php echo (int)($row_Contents['AmountReleased']/1000000);?> Mn";
		document.getElementById("dept_<?php echo $c?>").innerHTML = "<?php echo $row_Contents['Projects'];?>";
		gauge<?php echo $c?>.maxValue = <?php echo (int)($row_Contents['AmountReleased']/1000000);?>; // set max gauge value
		gauge<?php echo $c?>.animationSpeed = 32; // set animation speed (32 is default value)
		<?php  $ex = ((int)($row_Contents['AmountExpenses']/1000000) == 0) ? '0.01' : (int)($row_Contents['AmountExpenses']/1000000);?>
		gauge<?php echo $c?>.set(<?php echo $ex;?>); // set actual value
	
		
		<?php } else { ?>
		var c =  document.getElementById("chartdiv_<?php echo $c?>");
		c.parentNode.removeChild(c);
		
		document.getElementById("preview_<?php echo $c?>").innerHTML = "<?php echo (int)($row_Contents['AmountExpenses']/1000000);?> out of <?php echo (int)($row_Contents['AmountReleased']/1000000);?> Mn";
		document.getElementById("warning_<?php echo $c?>").innerHTML = "<img src='./img/warning.jpg' style='padding-top: 30px;'>";
		document.getElementById("dept_<?php echo $c?>").innerHTML = "<?php echo $row_Contents['Projects'];?>";
		
		<?php } ?>
		
		     
		<?php 
		$c++;
		}
		?>	
		};
		
		window.onload=function(){ 
			initGauge();
		};
		
 </script>
	<?php
		$countyid= (int)$_GET['countyid'];
           	$deptid= (int)$_GET['deptid'];
           	$mwaka = $_GET['mwaka'];
           	
           	
           	if ($mwaka == "") {$mwaka='2013';}?>
	
</head>
<body>
	
	<div class="fixed top-bar">
		<nav class="top-bar" data-topbar>
			<ul class="title-area">
				<li class="name"><a href="/"><img src="img/logo.jpg" /></a></li>
			</ul>

			<section class="top-bar-section">
				<ul class="right">
					<li class="active"><a href="index.php">Home</a></li>
					<!-- <li><a href="#">Data</a></li> -->
					<li><a href="feedback.php">Feedback</a></li>
					<li><a href="about.php">About</a></li>
					<li><a href="login.php">Login</a></li>
					<li><a href="login.php">Share</a></li>
					<li><a href="login.php">API</a></li>
					<li class="divider"></li>
					<li class="has-form">
						<div class="row search">
							<i class="fa fa-search"></i>
							<div class="small-11 large-10 columns">
								<input type="text" class="search-field" placeholder="Search Open County...">
							</div>
						</div>  
					</li>
				</ul>        
			</section>
		</nav>
		
		<ul>
			<li class="small-1 medium-1 large-1 column nowrap">FILTER BY</li>
			<li class="small-7 medium-7 large-7 column">
			<form id="filter" action="" method="get">
				<select name="countyid" class="small-2 medium-2 large-2">
					<option value="">National</option>
					<?php 
					$countyid = (int)$_GET['countyid'];
					$deptid = (int)$_GET['deptid'];
				   	$query_County =mysql_query("SELECT id, countyname FROM  county WHERE  viewed =1");
					while($row_county=mysql_fetch_array($query_County)){
					?>
					<option value="<?php echo $row_county['id']; ?>" <?php if ($row_county['id'] == $countyid) { echo "selected";}?>><?php echo $row_county['countyname']; ?></option>
					<?php } ?>
				</select>
				<select name="mwaka" class="small-2 medium-2 large-2">
					<option value="2013">2013 Budget</option>
				</select>
				<input type="submit" value="submit" name="submit"/>
			</form>
			</li>
			<li class="divider"></li>
			<li class="small-1 medium-1 large-1 column"><a href="index.php?countyid=<?php echo $countyid ?>&deptid=<?php echo $deptid;?>&mwaka=<?php echo $mwaka;?>">Allocation</a></li>
			<li class="small-1 medium-1 large-1 column"><a href="performance.php?countyid=<?php echo $countyid ?>&deptid=<?php echo $deptid;?>&mwaka=<?php echo $mwaka;?>">Performance</a></li>
			<!--<li class="small-1 medium-1 large-1 column"><a href="data.php?countyid=<?php echo $countyid ?>&deptid=<?php echo $deptid;?>&mwaka=<?php echo $mwaka;?>">Data</a></li>-->
		</ul>
		
	</div>
	
	<div class="tabs large-12 header" >
		<h3><a class="anchor" name="allocation"></a>Allocation</h3>
	</div>
	
	<div id="chart">
	  <svg></svg>
	</div>
	<div class="small-12 medium-12 large-12 rows charts">
	<?php for($i=1; $i<$c; $i++) { ?>
	<div class="preview small-3 medium-3 large-3">
		<div class="small-12 medium-12 large-12" id="preview_<?php echo $i;?>"></div>
		<div class="small-12 medium-12 large-12" id="warning_<?php echo $i;?>"></div>
		<canvas id="chartdiv_<?php echo $i;?>" class="small-12 medium-12 large-12" ></canvas>
		<div class="dept" id="dept_<?php echo $i;?>"></div>
	</div> 
	<?php } ?>
	</div>
	<?php
		$countyid= (int)$_GET['countyid'];
           	$deptid= (int)$_GET['deptid'];
           	$mwaka = $_GET['mwaka'];
           	if ($deptid != 0)
           	{
   		$breadcrumbs =mysql_query("SELECT departments.Name  FROM  departments where  departments.id = $deptid");
   		$bread = mysql_fetch_assoc($breadcrumbs);
   		$deptName = $bread['Name'];
   		}
   		
   		$deptName = ($deptName == "") ? 'DEPARTMENT' : $deptName;
         ?>
	<div class="tabs large-12 header" >
		<h3><a name="data"></a>Data</h3>
		<nav class="breadcrumbs small-6 column">
		<a href="index.php">COUNTY</a>
		<a href="performance.php?countyid=<?php echo $countyid?>&deptid=<?php echo $deptid?>">DEPARTMENT</a>
		<a class="current" href="#"><?php echo $deptName; ?></a>
		<a class="current" href="#">Projects</a>
		</nav>
		<img src="img/export.png" style="border: 0;float: right; margin: -25px 5px;" alt="Download" />
	</div>
	<div id="data_table" style="text-align: left;">
		
		      <?php
		
           	if ($mwaka == "") {$mwaka='2013';}
           	
           	if ($deptid == 0){
           	
		   	if ($countyid == 0) {
		   	$result = mysql_query("SELECT indicators as 'Name', NetEst_1 as 'AllocationQ1', ExchIssues_1 as 'ExpendedQ1' FROM  nationalexpenditure WHERE  used =1");
		   	} else {
		   	
		   		if ($deptid == 0){
		   		$result =mysql_query("SELECT CONCAT('<a href=data.php?countyid=$countyid&mwaka=$mwaka&deptid=',departments.id, '>',departments.Name,'</a>') as Name , quarterexpenditure.AllocationQ1 , quarterexpenditure.ExpendedQ1   FROM quarterexpenditure inner join departments on quarterexpenditure.departmentid= departments.id where quarterexpenditure.countyid = $countyid AND quarterexpenditure.mwaka = $mwaka AND departments.viewed =1");
		   		} else {
		   		$result =mysql_query("SELECT departments.Name , quarterexpenditure.AllocationQ1, quarterexpenditure.ExpendedQ1   FROM quarterexpenditure inner join departments on quarterexpenditure.departmentid= departments.id where quarterexpenditure.countyid = $countyid AND quarterexpenditure.mwaka = $mwaka AND departments.id = $deptid");
		   		}
		   	
		   	}
           	?>
           	<table class="large-12">
		  <thead>
		    <tr>
		    		<th>&nbsp;</th>
				<th>Department Name</th>
			   	<th>Amount Released</th>
			   	<th>Amount Expenses</th>
			   	<th>Absorption</th>
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
				<td><?php echo number_format($row['AllocationQ1'],2); ?></td>
				<td><?php echo number_format($row['ExpendedQ1'],2); ?></td>
				<td><?php echo number_format(($row['ExpendedQ1']/$row['AllocationQ1'])*100); ?>%</td>
				<?php $ar += $row['AllocationQ1']; ?>
				<?php $ae += $row['ExpendedQ1']; ?>
		    	</tr>
			<?php } ?>
			<tr>
				<td></td>
				<td><b>Totals</b></td>
				<td><b><?php echo number_format($ar,2); ?></b></td>
				<td><b><?php echo number_format($ae,2); ?></b></td>
				<td><b><?php echo number_format(($ae/$ar)*100); ?>%</b></td>
		    	</tr>
		
			  </tbody>
			</table>
		 <?php }
		    if ($deptid != 0){
           		$projects =mysql_query("SELECT  Projects ,  AmountReleased ,  AmountExpenses FROM  projects 
WHERE  departmentid = $deptid");
           		?>
           		<table class="large-12">
			  <thead>
			    <tr>
			    	<th>&nbsp;</th>
				<th>Project Name</th>
			   	<th>Amount Released</th>
			   	<th>Amount Expenses</th>
			   	<th>Absorption</th>
			     </tr>
			  </thead>
			  <tbody>
		<?php
		  // Write rows
		  $k=1;
		    //mysql_data_seek($projects, 0);
		    while ($rowPr = mysql_fetch_assoc($projects)) {
		?>
		   	 <tr>
				<td><?php echo $k++; ?></td>
				<td><?php echo $rowPr['Projects']; ?></td>
				<td><?php echo number_format($rowPr['AmountReleased'],2); ?></td>
				<td><?php echo number_format($rowPr['AmountExpenses'],2); ?></td>
				<td><?php if ($rowPr['AmountReleased']==0) { echo '0'; } else { echo number_format(($rowPr['AmountExpenses']/$rowPr['AmountReleased'])*100); } ?>%</td>
				<?php $ar += $rowPr['AmountReleased']; ?>
				<?php $ae += $rowPr['AmountExpenses']; ?>
		    	</tr>
		<?php } ?>
			<tr>
				<td></td>
				<td><b>Totals</b></td>
				<td><b><?php echo number_format($ar,2); ?></b></td>
				<td><b><?php echo number_format($ae,2); ?></b></td>
				<td><b><?php if ($rowPr['ar']==0) { echo '0'; } else { echo number_format(($ae/$ar)*100);} ?>%</b></td>
		    	</tr>
		
			  </tbody>
			</table>
		<?php
		}
		?>
	</div>
	<div id="footer">
		<div class="row">
			<div class="small-6 medium-3 large-3 columns">
				<h3>Open County</h3>
				<ul>
					<li><a href="about.php">About the Open County Dashboard</a></li>
					<li><a href="http://opencounty.org">About the Initiative</a></li>
					<li><a href="feedback.php">Contact us</a></li>
				</ul>
				<br>
				<p>Built by <a href="http://openinstitute.com">Open Institute</a></p>
			</div>
			<div class="social-links small-6 medium-3 large-3 columns">
				<h3>Social Media</h3>
				<p><em>Stay connected</em></p>
				<a href="http://www.facebook.com/theopeninstitute"> 
		        	<i class="fa fa-facebook"></i>
		        </a>
		        <a href="http://www.twitter.com/Open_Institute"> 
		        	<i class="fa fa-twitter"></i>
		        </a>
		        <a href="http://plus.google.com/+OpenInstitute"> 
		        	<i class="fa fa-google-plus"></i>
		        </a>
		        <a href="https://github.com/OpenInstitute"> 
		        	<i class="fa fa-github-alt"></i>
		        </a>
			</div>
			<div class="newsletter small-12 medium-6 large-6 columns">
				<h3>Newsletter</h3>
				<p>Sign up to receive updates</p>
				<div class="row collapse">
			        <!-- Begin MailChimp Signup Form -->
					<div id="mc_embed_signup" class="signup-form">
						<form action="http://openinstitute.us4.list-manage.com/subscribe/post?u=febfe314d7711eb78b13abdae&amp;id=63fd3aedc5" method="post" id="mc-embedded-subscribe-form" name="mc-embedded-subscribe-form" class="validate" target="_blank" novalidate>
							<div class="mc-field-group large-6 columns">
								<input type="text" value="" name="FNAME" class="" id="mce-FNAME" placeholder ="First Name">
							</div>
							<div class="mc-field-group large-6 columns">
								<input type="text" value="" name="LNAME" class="" id="mce-LNAME" placeholder="Last Name">
							</div>
							<div class="mc-field-group large-9 columns">
								<input type="email" value="" name="EMAIL" class="required email" id="mce-EMAIL" placeholder="Your Email (required)">
							</div>
							<div id="mce-responses" class="clear">
								<div class="response" id="mce-error-response" style="display:none"></div>
								<div class="response" id="mce-success-response" style="display:none"></div>
							</div>    <!-- real people should not fill this in and expect good things - do not remove this or risk form bot signups-->
					   		<div style="position: absolute; left: -5000px;"><input type="text" name="b_febfe314d7711eb78b13abdae_63fd3aedc5" value=""></div>
							<div class="clear large-3 columns">
								<input type="submit" value="Subscribe" name="subscribe" id="mc-embedded-subscribe" class="button">
							</div>
						</form>
					</div>
					<!--End mc_embed_signup-->
			      </div>
			</div>
		</div>
	</div>
	<div id="copyright">
		<div class="row">
			<div class="small-12 columns">
				<p>
					<a rel="license" href="http://creativecommons.org/licenses/by/4.0/"><img alt="Creative Commons License" style="border-width:0" src="http://i.creativecommons.org/l/by/4.0/80x15.png"></a><span xmlns:dct="http://purl.org/dc/terms/" property="dct:title">Open County Initiative</span> by <a xmlns:cc="http://creativecommons.org/ns#" href="http://openinstitute.com" property="cc:attributionName" rel="cc:attributionURL">Open Institute</a> is licensed under a <a rel="license" href="http://creativecommons.org/licenses/by/4.0/">Creative Commons Attribution 4.0 International License</a>
				</p>
			</div>
		</div>
	</div>
	<script src="lib/d3.v2.js"></script>
<script src="lib/nv.d3.js"></script>
<script src="lib/utils.js"></script>
<script src="lib/bullet.js"></script>
<script>
 <?php 
           	if ($mwaka == "") {$mwaka='2013';}
		$countyid = (int)$_GET['countyid'];
		$deptid = (int)$_GET['deptid'];
		if ($countyid == 0) {
		
           	$query_Contents =mysql_query("SELECT SUM( GrossEst_1 ) AS Gross,SUM( NetEst_1 ) AS netbudget, SUM( ExchIssues_1 ) AS cob FROM nationalexpenditure WHERE  used =1");
           	} else {
           	$query_Contents =mysql_query("SELECT  SUM(quarterexpenditure.AllocationQ1)/1000000 as 'netbudget' , SUM(quarterexpenditure.ExpendedQ1)/1000000 as 'cob' FROM quarterexpenditure WHERE quarterexpenditure.countyid = $countyid AND quarterexpenditure.mwaka = $mwaka AND quarterexpenditure.departmentid = $deptid");
           	}
		$row_Contents=mysql_fetch_assoc($query_Contents);
		$cob = $row_Contents['cob'];
		$net = $row_Contents['netbudget'];
		$pending = $cob + ($net - $cob);
		
		?>
    //alert(<?php echo $pending;?>);
data = {"title":"Expenditure","subtitle":"KES, in Millions","ranges":[<?php echo $net?>],"measures":[<?php echo $cob;?>],"markers":[<?php echo $pending;?>]};

nv.addGraph(function() {
    var chart = nv.models.bulletChart();

    d3.select('#chart svg')
        .datum(data)
        .transition().duration(1000)
        .call(chart)
        ;

    return chart;
});
</script>
</body>
</html>
