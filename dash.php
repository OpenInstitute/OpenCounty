<?php require('./Includefiles/conn.inc'); ?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta charset="UTF-8"/>
	<title>Open County National Budget Sample</title>
	<link type="text/css" rel="stylesheet" href="build/foundation.css" />
	<link type="text/css" rel="stylesheet" href="build/normalize.css" />
	<link type="text/css" rel="stylesheet" href="build/custom.css" />

	<link href="//netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css" rel="stylesheet">

	<link type="text/css" rel="stylesheet" href="http://fonts.googleapis.com/css?family=Lato:400,700|Raleway:400,500,700|Roboto:400,700"/>
	 <script src="amcharts/amcharts.js" type="text/javascript"></script>
        <script src="amcharts/gauge.js" type="text/javascript"></script>

        <script type="text/javascript">
           AmCharts.ready(function () {
		   AmCharts.makeChart("chartdiv_1", {
			    "type": "gauge",
				"theme": "none",    
			    "axes": [{
				"axisThickness":1,
				 "axisAlpha":0.2,
				 "tickAlpha":0.2,
				 "valueInterval":20,
				"bands": [{
				    "color": "#84b761",
				    "endValue": 90,
				    "startValue": 0
				}, {
				    "color": "#cc4748",
				    "endValue": 220,
				    "innerRadius": "95%",
				    "startValue": 130
				}],
				"bottomText": "200 km/h",
				"bottomTextYOffset": -20,
				"endValue": 220
			    }],
			    "arrows": [{
			    	"value": "90"
			    }]
			});
			
			AmCharts.makeChart("chartdiv_2", {
			    "type": "gauge",
				"theme": "none",    
			    "axes": [{
				"axisThickness":1,
				 "axisAlpha":0.2,
				 "tickAlpha":0.2,
				 "valueInterval":20,
				"bands": [{
				    "color": "#84b761",
				    "endValue": 90,
				    "startValue": 0
				}, {
				    "color": "#cc4748",
				    "endValue": 220,
				    "innerRadius": "95%",
				    "startValue": 130
				}],
				"bottomText": "200 km/h",
				"bottomTextYOffset": -20,
				"endValue": 220
			    }],
			    "arrows": [{
			    	"value": "20"
			    }]
			});
			AmCharts.makeChart("chartdiv_3", {
			    "type": "gauge",
				"theme": "none",    
			    "axes": [{
				"axisThickness":1,
				 "axisAlpha":0.2,
				 "tickAlpha":0.2,
				 "valueInterval":20,
				"bands": [{
				    "color": "#84b761",
				    "endValue": 90,
				    "startValue": 0
				}, {
				    "color": "#cc4748",
				    "endValue": 220,
				    "innerRadius": "95%",
				    "startValue": 130
				}],
				"bottomText": "200 km/h",
				"bottomTextYOffset": -20,
				"endValue": 220
			    }],
			    "arrows": [{
			    	"value": "130"
			    }]
			});
			AmCharts.makeChart("chartdiv_4", {
			    "type": "gauge",
				"theme": "none",    
			    "axes": [{
				"axisThickness":1,
				 "axisAlpha":0.2,
				 "tickAlpha":0.2,
				 "valueInterval":20,
				"bands": [{
				    "color": "#84b761",
				    "endValue": 90,
				    "startValue": 0
				}, {
				    "color": "#cc4748",
				    "endValue": 220,
				    "innerRadius": "95%",
				    "startValue": 130
				}],
				"bottomText": "200 km/h",
				"bottomTextYOffset": -20,
				"endValue": 220
			    }],
			    "arrows": [{
			    	"value": "210"
			    }]
			});
			AmCharts.makeChart("chartdiv_5", {
			    "type": "gauge",
				"theme": "none",    
			    "axes": [{
				"axisThickness":1,
				 "axisAlpha":0.2,
				 "tickAlpha":0.2,
				 "valueInterval":20,
				"bands": [{
				    "color": "#84b761",
				    "endValue": 90,
				    "startValue": 0
				}, {
				    "color": "#cc4748",
				    "endValue": 220,
				    "innerRadius": "95%",
				    "startValue": 130
				}],
				"bottomText": "200 km/h",
				"bottomTextYOffset": -20,
				"endValue": 220
			    }],
			    "arrows": [{
			    	"value": "100"
			    }]
			});
			
			AmCharts.makeChart("chartdiv_6", {
			    "type": "gauge",
				"theme": "none",    
			    "axes": [{
				"axisThickness":1,
				 "axisAlpha":0.2,
				 "tickAlpha":0.2,
				 "valueInterval":20,
				"bands": [{
				    "color": "#84b761",
				    "endValue": 90,
				    "startValue": 0
				}, {
				    "color": "#cc4748",
				    "endValue": 220,
				    "innerRadius": "95%",
				    "startValue": 130
				}],
				"bottomText": "200 km/h",
				"bottomTextYOffset": -20,
				"endValue": 220
			    }],
			    "arrows": [{
			    	"value": "130"
			    }]
			});

		});
        </script>
</head>
<body>
	
	<div class="fixed">
		<nav class="top-bar" data-topbar>
			<ul class="title-area">
				<li class="name"><a href="/"><img src="img/logo.jpg" /></a></li>
				<li class="toggle-topbar menu-icon"><a href="#">Menu</a></li>
			</ul>

			<section class="top-bar-section">
				<ul class="right">
					<li class="active"><a href="/">Home</a></li>
					<!-- <li><a href="#">Data</a></li> -->
					<li><a href="feedback.php">Feedback</a></li>
					<li><a href="about.php">About</a></li>
					<li><a href="login.php">Login</a></li>
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
	</div>
	<div class="tabs large-12" style="margin-top: 70px;">
		<ul>
			<li class="small-7 medium-7 large-7 column"><h3><a href="<?php //echo $county[0]['id']; ?>"><?php // echo $county[0]['countyname']; ?> National Expenditure (bn)</a></h3></li>
			<li class="divider"></li>
			<li class="small-2 medium-2 large-2 column"><a href="index.php">Allocation</a></li>
			<li class="small-2 medium-2 large-2 column"><a href="dash.php">Performance</a></li>
		</ul>
	</div>
	<div class="small-12 medium-12 large-12 rows charts">

		<div id="chartdiv_1" style="width:300px; height:200px; text-align: center;"></div>
		<div id="chartdiv_2" style="width:300px; height:200px; text-align: center;"></div>
		<div id="chartdiv_3" style="width:300px; height:200px; text-align: center;"></div>
		<div id="chartdiv_4" style="width:300px; height:200px; text-align: center;"></div>
		<div id="chartdiv_5" style="width:300px; height:200px; text-align: center;"></div>
		<div id="chartdiv_6" style="width:300px; height:200px; text-align: center;"></div>
		
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
</body>
</html>
