<?php require('Includefiles/conn.inc');

//echo $database_conn; exit;
$conn = mysql_connect($hostname_conn, $username_conn, $password_conn) or trigger_error(mysql_error(),E_USER_ERROR); 

mysql_select_db ($database_conn);

  $cid = (int)$_POST['cid'];
  $did = (int)$_POST['did'];
                           
  if ($cid == 0 ){
    $query_Contents_ =mysql_query("SELECT  SUM(NetEst_1)*1000000 as Exp, SUM(ExchIssues_1)*1000000 as Alloc FROM nationalexpenditure WHERE used =1 ");
  }
  else {
    $query_Contents_ =mysql_query("SELECT  * FROM countyInfo  WHERE countyid = $cid ");
  }   
  $row_Contents_=mysql_fetch_assoc($query_Contents_);
?>
    <div class="glance panel row">
    <div class="col-md-4">
      <br> 
      <?php if ($cid == 0) { ?> 
        <img src="http://www.vectorportal.com/img_novi/kenya-vector-map_2481.jpg" width="250px" height="auto">
      <?php } else {?>
        <img src="./maps/<?php echo $row_Contents_['County'];?>_Map.jpg" width="250px" height="auto">
      <?php }?>
    </div>
    <div class="col-md-8">
      <?php   if ($cid == 0 ) { ?>
        <div class="col-md-6"><h5>Area -</h5></div>
        <div class="col-md-6"><span> 581,309 km<sup>2</sup></span></div> 
        <div style="clear: both"></div>
        <div class="col-md-6"><h5>Population -</h5></div>
        <div class="col-md-6"><span> 44,037,656</span></div>
        <div style="clear: both"></div>
        <div class="col-md-6"><h5>Population density -</h5></div>
        <div class="col-md-6"><span>67.2/km<sup>2</sup></span></div>
        <div style="clear: both"></div>
      <?php } else { ?>
        <div class="col-md-3"><h5>Governor -</h5></div>
        <div class="col-md-9"><span><?php  echo $row_Contents_['Governor']; ?></span></div>
        <div style="clear: both"></div>
        <div class="col-md-3"><h5>Deputy Governor -</h5></div>
        <div class="col-md-9"><span><?php echo $row_Contents_['DeputyGovernor']; ?></span></div>
        <div style="clear: both"></div>
        <div class="col-md-3"><h5>Senator -</h5></div>
        <div class="col-md-9"><span><?php echo $row_Contents_['Senetor']; ?></span></div>
        <div style="clear: both"></div>
        <div class="col-md-3"><h5>Women Rep -</h5></div>
        <div class="col-md-9"><span><?php echo $row_Contents_['WomenRep']; ?></span></div>
        <div style="clear: both"></div>
        <div class="col-md-3"><h5>Email -</h5></div>
        <div class="col-md-9"><span><?php echo $row_Contents_['Email']; ?></span></div>
        <div style="clear: both"></div>
        <div class="col-md-3"><h5>Area -</h5></div>
        <div class="col-md-9"><span><?php echo $row_Contents_['area']; ?></span></div>
        <div style="clear: both"></div>
        <div class="col-md-3"><h5>Constituencies - </h5></div>
        <div class="col-md-9"><span><?php echo $row_Contents_['Constituencies']; ?></span></div>
        <div style="clear: both"></div>
        <div class="col-md-3"><h5>Population -</h5></div>
        <div class="col-md-9"><span><?php echo $row_Contents_['population']; ?></span></div>
        <div style="clear: both"></div>
        <div class="col-md-3"><h5>Population density -</h5></div>
        <div class="col-md-9"><span><?php echo $row_Contents_['populationDensity']; ?></span></div>
        <div style="clear: both"></div>
        <div class="col-md-3"><h5>Economy -</h5></div>
        <div class="col-md-9"><span><?php formatter($row_Contents_['Economy']); ?></span></div>
        <div style="clear: both"></div>
        <div class="col-md-3"><h5>Education -</h5></div>
        <div class="col-md-9"><span><?php formatter($row_Contents_['Education']); ?></span></div>
        <div style="clear: both"></div>
        <div class="col-md-3"><h5>Health -</h5></div>
        <div class="col-md-9"><span><?php  formatter($row_Contents_['Health']); ?></span></div>
        <div style="clear: both"></div>
      <?php }?>
    </div>

    <div class="col-md-12">
      <h4>Related News</h4>
    		<fieldset class="rsslib">
    			<?php 
    				if ($cid == 0) 
    					{ $news='kenya'; } 
    				else {
    					$news = 'county+'.$row_Contents_['Name']; }
    					
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
    </div>
  
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
                 
