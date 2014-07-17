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
	<script type="text/javascript" src="lib/jquery-1.5.2.min.js"></script>
	<script type="text/javascript" src="lib/jquery.history.js"></script>
	<script type="text/javascript" src="lib/raphael.js"></script>
	<script type="text/javascript" src="lib/vis4.js"></script>
	<script type="text/javascript" src="lib/Tween.js"></script>
	<script type="text/javascript" src="build/bubbletree.js"></script>
	<link rel="stylesheet" type="text/css" href="build/bubbletree.css" />
	<script type="text/javascript" src="styles/cofog.js"></script>
	
	
	<script type="text/javascript">
       
		$(function() {
		
		var data = {
		<?php 
		$mwaka= '2013';
		$countyid = (int)$_GET['countyid'];
		if ($countyid == 0) {
		$query_Contents =mysql_query("SELECT sum(ExchIssues_1) as 'TotalAllocation' FROM nationalexpenditure WHERE used=1");
		$row_Contents=mysql_fetch_assoc($query_Contents);
		echo 'label: "Total Allocation",';
		echo 'amount: '. $row_Contents['TotalAllocation'] .',';
		echo 'children: [ ';
		$ch = '';
			$query_Contents_1 =mysql_query("SELECT indicators, ExchIssues_1 FROM nationalexpenditure WHERE used =1");
			while ($row_Contents_1=mysql_fetch_array($query_Contents_1)) {
		
		$ch .= ' 	{';		
		$ch .= '	label: "'. substr($row_Contents_1['indicators'],0,20) .'",';
		$ch .= '	amount: '. $row_Contents_1['ExchIssues_1'] ;
		
		$ch .= '	},';		
			
			} 
		$ch .= ']';
			
		echo str_replace('},]', '}]', $ch);
		
		} else {
		$mwaka= '2013';
		$countyid= (int)$_GET['countyid'];
		$query_Contents =mysql_query("SELECT SUM(AllocationQ1) AS TotalAllocation FROM  quarterexpenditure  WHERE countyid = $countyid AND mwaka = $mwaka ");
		$row_Contents=mysql_fetch_assoc($query_Contents);
		echo 'label: "Total Allocation",';
		echo 'amount: '. $row_Contents['TotalAllocation'] .',';
		echo 'children: [ ';
		$ch = '';
			$query_Contents_1 =mysql_query("SELECT quarterexpenditure.AllocationQ1 as TotalAllocation , quarterexpenditure.ExpendedQ1, departments.Name, departments.id FROM `quarterexpenditure` inner join departments on quarterexpenditure.departmentid = departments.id where quarterexpenditure.countyid = $countyid AND quarterexpenditure.mwaka = $mwaka AND departments.viewed =1");
			while ($row_Contents_1=mysql_fetch_array($query_Contents_1)) {
		
		$ch .= '{';		
		$ch .= 'label: "'. substr($row_Contents_1['Name'],0,20) .'",';
		$ch .= ' amount: '. $row_Contents_1['TotalAllocation'].',' ;
		
		$did = $row_Contents_1['id'];
		$query_Projects =mysql_query("SELECT  Projects ,  AmountReleased ,  AmountExpenses FROM  projects WHERE  departmentid = $did");
		$totalRows_Contents = mysql_num_rows($query_Projects);
		
		if ($totalRows_Contents>=1){
			$ch .= ' children: [ ';
				while ($row_Proj=mysql_fetch_array($query_Projects)){
				$ch .= '{';
				$ch .= 'label: "'. substr($row_Proj['Projects'],0,20) .'",';	
				$ch .= ' amount: '. $row_Proj['AmountReleased'];	
				$ch .= '},';
				}
			$ch .= '] ';	
			
		} 
			
		$ch .= '},';
			} 
		$ch .= ']';
			
		echo str_replace('},]', '}]', str_replace(',}', '}', $ch));
		}
		?>
			};
			
			new BubbleTree({
				taxonomy: 'cofog',
    				name: '05.3',
				data: data,
				container: '.bubbletree'
			});
		
		});
                                        
	</script>
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
	<div class="bubbletree-wrapper">
		<div class="bubbletree"></div>
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
           	$query_Contents =mysql_query("SELECT SUM( GrossEst_1 ) AS Gross,SUM( NetEst_1 ) AS Net, SUM( ExchIssues_1 ) AS issues FROM  nationalexpenditure WHERE  used =1");
		$row_Contents=mysql_fetch_assoc($query_Contents);
		$issue = $row_Contents['issues'];
		$net = $row_Contents['Net'];
		$pending = $cob + ($net - $cob);
		?>
    
data = {"title":"Expenditure","subtitle":"KES, in Millions","ranges":[<?php echo $net?>],"measures":[<?php echo $issue;?>],"markers":[<?php echo $pending;?>]};

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
