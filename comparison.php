<?php require('Includefiles/header.php'); ?>
    <!-- Main Menu  -->
    <div class="main menu">
      <div class="container">
        <nav class="navbar navbar-default" role="navigation">
          <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav">
              <li class="#"><a href="index.php">Home</a></li>
              <li class="divider"></li>
              <li><a href="performance.php">County Overview</a></li>
              <li class="divider"></li>
              <li class="active"><a href="comparison.php">County Comparison</a></li>
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
        <div class="allocation row">
          <div class="col-md-3 regions"><!-- Sidebar -->
            <!-- Nav tabs -->
            <ul class="nav nav-pills" role="tablist">
              <li role="presentation" class="active" style="width:98%;background:#eee"><a id="depts" href="#departments" role="tab" data-toggle="tab">Indicators</a></li>
              <!-- <li role="presentation"><a id="devfns" href="#devolved" role="tab" data-toggle="tab">Devolved Functions</a></li> -->
            </ul>

            <!-- Tab panes -->
            <div class="tab-content">
              <div role="tabpanel" class="tab-pane active" id="departments">
                <table class="table table-bordered table-hover">
                  <tbody class="legends">
                    <?php
    
$title=['Population (2009)','Population with primary education (%)','Population with secondary education (%)','Population Per Nurse','Population Per Doctor','Improved water (% households 2009)','Improved sanitation (% households 2009)','Electricity (% households 2009)','Paved roads (as % of total roads)','Good/fair roads (as % of total roads)','County Expenditure - County Executive (March-June 2012/13)','County Expenditure - County Assembly (March-June 2012/13)','County Expenditure - Financial Management (March-June 2012/13)','County Expenditure - Former Councils (March-June 2012/13)','County Expenditure - Total Expenditure (March-June 2012/13)'];

$brief=['Population2009','PopPriEdu', 'PopSecEdu', 'PopPerNurse','PopPerDoctor', 'ImprovedWater','ImprovedSanitation', 'Electricity','	PavedRoads', 'FairRoads', 'CountyExecutiveExp', 'CountyAssemblyExp', 'FinancialMgtExp', 'FormerCouncilsExp', 'CountyTotalExp'];
	
$ind = array_search($_GET['fld'], $brief);
$Title= $title[$ind];

                      // Write rows
                      $k=1;
                      $letter = 'a';
                      //mysql_data_seek($projects, 0);
                      for($i=0; $i<count($brief); $i++) {
                        
                      if ($letter=='i'){ $letter++; }
                    ?>

                    <tr>
                      <td class="level2 legend <?php echo $letter;?>" fld="<?php echo $brief[$i];?>"><i class="pointer"></i><?php echo $title[$i];?> </td>
                    </tr>
                    <?php $letter++; } ?>
                  </tbody>
                </table>
              </div>
            </div>
          </div><!-- /.regions -->
          <!-- //End Sidebar -->

          <!-- Visualisations -->
          <div class="overall col-md-9">
			  <!-- Bar Chart -->
			  <h2 class="section-title" id="chartTitle"><?php echo $Title;?></h2>
			  <p><strong>Average:</strong> <span class="median"></span></p>
			  <div id="chart"></div>
          </div>
        </div><!-- /.overall -->
        <!-- End overall -->
        
      </div><!-- /.allocation -->
      <!-- //End Allocation -->

    </div><!-- /.container -->
  </div><!-- /.main -->
  <!-- //End Content -->

  <!-- Footer -->
  <?php include ("./Includefiles/footer.php"); ?>
  <!-- //End Footer -->
  <script src="js/vendor/jquery.js"></script>
  <script src="js/d3.min.js"></script>
  
  <script src="js/underscore-min.js"></script>
  <script src="js/highlight.pack.js"></script>
<em id="maxi"></em>
<script type="text/javascript"> 
	
$(document).ready(function() {
//~ var	name = [<?php echo $cat;?>];
//~ var value = [<?php echo $val;?>];
//~ var colors = [<?php echo $col;?>];
var barheight = 20;


		var url = "countycomparisondata.php?fld=<?php echo $_GET['fld'];?>"
		  , margin = {top: 30, right: 10, bottom: 30, left: 10}
		  , width = parseInt(d3.select('#chart').style('width'), 10)
		  , width = width - margin.left - margin.right
		  , height = 200 // placeholder
		  , barHeight = 20
		  , spacing = 3
		  , percent = d3.format(',d');
		
		GetmaxResult(url);
		
		var k;
		function GetmaxResult(u){
		var d = $.ajax(url)
			.done(function( data ) {
				
				var v = new Array();
				var params = data.split('\n');
				 for(var i=0;i<params.length;i++){
					//alert(params[i]);
					if(i>0){
						var items = params[i].split(',');
						//alert(items[1]);
						v.push(items[1]*1);
					}
				}
				//alert(d3.max(v));
				//alert(i);
				sample(d3.max(v), d3.min(v));
				
				//$("#maxi").html(k);
				//return k;
			});
		}
	//setTimeout(sample, 2000);
	function sample(maxi,mini){
			//m = $("#maxi").html();
		var x = d3.scale.linear()
		.range([0, width])
		.domain([mini, maxi]); // hard-coding this because I know the data
		
		var w = width;
		// scales and axes

		var y = d3.scale.ordinal();

		var xAxis = d3.svg.axis()
			.scale(x)
			.tickFormat(percent);

		// create the chart
		var chart = d3.select('#chart').append('svg')
			.style('width', (width + margin.left + margin.right) + 'px')
		  .append('g')
			.attr('transform', 'translate(' + [margin.left, margin.top] + ')');

		d3.csv(url).row(function(d) {
			//d.Total = +d.Total;
			d["value"] = +d["value"];
		//	d.percent = d["value"] / d.Total;

			return d;
		}).get(function(err, data) {
			// sort
			data = _.sortBy(data, 'value').reverse();

			// set y domain
			y.domain(d3.range(data.length))
				.rangeBands([0, data.length * barHeight]);

			// set height based on data
			height = y.rangeExtent()[1];
			d3.select(chart.node().parentNode)
				.style('height', (height + margin.top + margin.bottom) + 'px')

			// render the chart

			// add top and bottom axes
			chart.append('g')
				.attr('class', 'x axis top')
				.call(xAxis.orient('top'));

			chart.append('g')
				.attr('class', 'x axis bottom')
				.attr('transform', 'translate(0,' + height + ')')
				.call(xAxis.orient('bottom'));

			var bars = chart.selectAll('.bar')
				.data(data)
			  .enter().append('g')
				.attr('class', 'bar')
				.attr('transform', function(d, i) { return 'translate(0,'  + y(i) + ')'; });

			bars.append('rect')
				.attr('class', 'background')
				.attr('height', y.rangeBand())
				.attr('width', width);

			bars.append('rect')
				.attr('class', 'percent')
				.attr('height', y.rangeBand())
				.attr('width', function(d) { return (w/maxi)*d.value; });
			
			bars.append('text')
				.text(function(d) { return d.name ;})
				.attr('class', 'name')
				.attr('y', y.rangeBand() - 5)
				.attr('x', spacing);
			
			bars.append('text')
				.text(function(d) { return addCommas(d.value);})
				.attr('class', 'txVal')
				.attr('y', y.rangeBand() - 5)
				.attr('x', 700);
			

			// add median ticks
			var median = d3.median(data, function(d) { return d.value; });
//alert(median);
			var med = addCommas(median);
			d3.select('span.median').html(med);

			bars.append('line')
				.attr('class', 'median')
				.attr('x1', x(median))
				.attr('x2', x(median))
				.attr('y1', 1)
				.attr('y2', y.rangeBand() - 1);
		});

		// resize
		d3.select(window).on('resize', resize); 

		function resize() {
			// update width
			width = parseInt(d3.select('#chart').style('width'), 10);
			width = width - margin.left - margin.right;

			// resize the chart
			x.range([0, width]);
			d3.select(chart.node().parentNode)
				.style('height', (y.rangeExtent()[1] + margin.top + margin.bottom) + 'px')
				.style('width', (width + margin.left + margin.right) + 'px');

			chart.selectAll('rect.background')
				.attr('width', width);

			chart.selectAll('rect.percent')
				.attr('width', function(d) { return x(d.percent); });

			// update median ticks
			var median = d3.median(chart.selectAll('.bar').data(), 
				function(d) { return d.percent; });
			
			chart.selectAll('line.median')
				.attr('x1', x(median))
				.attr('x2', x(median));

			// update axes
			chart.select('.x.axis.top').call(xAxis.orient('top'));
			chart.select('.x.axis.bottom').call(xAxis.orient('bottom'));

		}
		// highlight code blocks
		hljs.initHighlighting();

	}
});

function addCommas(nStr)
{
	nStr += '';
	x = nStr.split('.');
	x1 = x[0];
	x2 = x.length > 1 ? '.' + x[1] : '';
	var rgx = /(\d+)(\d{3})/;
	while (rgx.test(x1)) {
		x1 = x1.replace(rgx, '$1' + ',' + '$2');
	}
	return x1 + x2;
}
	
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
  
   $( document ).ready(function() {

		$("td.level2").click(function(){
		  var fld = $(this).attr('fld');
		  window.location.href='comparison.php?fld=' + fld ;
		});
		
		var n = 0;
		$( "rect.bar" )
		  .mouseenter(function() {
			n += 1;
			
			$( this ).find( "span" ).text( "mouse enter x " + n );
		  })
		  .mouseleave(function() {
			$( this ).find( "span" ).text( "mouse leave" );
		  });

    });
    </script>
  </body>
</html>
