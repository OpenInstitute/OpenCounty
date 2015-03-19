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
        
        <a name="overview"></a>
        <div class="col-md-12">
    		<fieldset class="rsslib">
    			<?php 
    				if ($cid == 0) 
    					{ $news='kenya'; } 
    				else {
						 $query_Contents_ =mysql_query("SELECT  * FROM countyInfo  WHERE countyid = $cid ");
  
						$row_Contents_=mysql_fetch_assoc($query_Contents_);
    					$news = 'county+'.$row_Contents_['County']; 
    				}
    					
              //$cachename = "./Includefiles/rss-cache.php";
    					$url = "http://news.google.com/news?cf=all&ned=us&hl=en&q=".$news."&output=rss";
    					//echo $url;
    				  /*if(file_exists($cachename))
    						{
    						  $now = date("G");
    						  $time = date("G", filemtime($cachename));
    						  if($time == $now)
    						  {
    							 include($cachename);
    							 exit();
    						  }
    						}*/
    				require_once("./Includefiles/rsslib.php");
    				$cache = RSS_Display($url, 15, false, true);
    				//file_put_contents($cachename, $cache);
    				echo $cache;
    			?>
    		</fieldset>
      </div>
        <!-- /.container -->
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
		$(".dropdown-menu").on("click", "li", function(){
		  var cid =$(this).attr('cid');// $(this).text();
		  window.location.href='performance.php?cid=' + cid;
		});
		
    
		$("li.level2").click(function(){
		  var cid = $(this).attr('cid');
		  var mcaCons = $(this).attr('Cons');
		  var divto = $(this).attr('divto');
		  mcaAJAX(cid,mcaCons,divto);
		});
    
    
		function mcaAJAX(c,d,t) {
		  $.ajax({
			url: "mca_list.php",
			type: "post",
			async: false, 
			data: { cid : c, cons : d},
			success:function(dat){
			  // alert(dat);
			  $("#mcaData").html(dat);
			},
			error:function(d){
			  alert("failure"+d);
			  $("#"+t).html('there is error while submit');
			}
		  }); 
		}
		
		$('.selectpicker').selectpicker({
        maxOptions: 1
		});
      

       $(".selectpicker").change(function() {
		   
         var element = $('option:selected',this);
         var countyid = element.attr('value');
         window.location.href = './newsfeed.php?cid='+countyid;
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
			$list .= "<b>". $tCont[0] ."</b>";
			
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
