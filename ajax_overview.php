  <?php
# FileName="Connection_php_mysql.htm"
# Type="MYSQL"
# HTTP="true"

//echo 'http://'.$_SERVER['HTTP_HOST']; exit;
if ('http://'.$_SERVER['HTTP_HOST'] == 'http://localhost'){
$hostname_conn = "localhost";
$database_conn = "opencounty_db";
$username_conn = "root";
$password_conn = "pass";

}else{

$hostname_conn = "mysql.kenya.opencounty.org";
$database_conn = "kenya_opencounty";
$username_conn = "openinstitute";
$password_conn = "K@r1buK@ya!";
}

//echo $database_conn; exit;
$conn = mysql_connect($hostname_conn, $username_conn, $password_conn) or trigger_error(mysql_error(),E_USER_ERROR); 

mysql_select_db ($database_conn);



                      $cid = (int)$_POST['cid'];
                      $did = (int)$_POST['did'];

                           
                            if ($cid == 0 ){
                              $query_Contents_ =mysql_query("SELECT  SUM(NetEst_1)*1000000 as Exp, SUM(ExchIssues_1)*1000000 as Alloc FROM nationalexpenditure WHERE used =1 ");
                            }
                            else {
                              $query_Contents_ =mysql_query("SELECT  SUM(Department.AllocationQ1) as Alloc, SUM(Department.ExpendedQ1) as Exp, county.countyname as Name, county.Governor, county.depGovernor, county.populationDensity, county.population, county.area, county.economy, county.education, county.health, county.constituencies, county.image FROM Department INNER JOIN county ON county.id = Department.countyid WHERE Department.countyid = $cid ");
                            }   
                              $row_Contents_=mysql_fetch_assoc($query_Contents_);
                          ?>

                        <div class="col-md-12 glance panel">
                          <div class="col-md-3">
                            <br> 
                              <?php if ($cid == 0) { ?> 
                                <img src="http://www.vectorportal.com/img_novi/kenya-vector-map_2481.jpg" width="auto" height="180px">
                              <?php } else {?>
                                <img src="./img/<?php echo $row_Contents_['image'];?>" width="auto" height="180px">
                              <?php }?>
                          </div>
                          <div class="col-md-9">
                           <?php   if ($cid == 0 ) { ?>
                           
                                <div class="col-md-6">
                                  <h5>Area -</h5>  
                                </div>
                                <div class="col-md-6">
                                  <span> 581,309 km<sup>2</sup></span>
                                </div>
                               
                                <div style="clear: both"></div>
                              	<div class="col-md-6">
                                  <h5>Population -</h5>
                                </div>
                                <div class="col-md-6">
                                  <span> 44,037,656</span>
                                </div>
                                <div style="clear: both"></div>
                                <div class="col-md-6">
                                  <h5>Population density -</h5>
                                </div>
                                <div class="col-md-6">
                                  <span>67.2/km<sup>2</sup></span>
                                </div>
                              <div style="clear: both"></div>
                           <?php } else { ?>
                           <div class="col-md-6">
                                  <h5>Governor -</h5>
                                </div>
                                <div class="col-md-6">
                                  <span><?php  echo $row_Contents_['Governor']; ?></span>
                                </div>
                                <div style="clear: both"></div>
                                <div class="col-md-6">
                                  <h5>Deputy Governor -</h5>
                                </div>
                                <div class="col-md-6">
                                  <span><?php echo $row_Contents_['depGovernor']; ?></span>
                                </div>
                                <div style="clear: both"></div>
                              	<div class="col-md-6">
                                  <h5>Location -</h5>
                                </div>
                                <div class="col-md-6">
                                  <span><?php echo $row_Contents_['location']; ?></span>
                                </div>
                                <div style="clear: both"></div>
                                <div class="col-md-6">
                                  <h5>Area -</h5>  
                                </div>
                                <div class="col-md-6">
                                  <span><?php echo $row_Contents_['area']; ?></span>
                                </div>
                                <div style="clear: both"></div>
                              	<div class="col-md-6">
                                  <h5>Constituencies - </h5>
                                </div>
                                <div class="col-md-6">
                                  <span><?php echo $row_Contents_['constituencies']; ?></span>
                                </div>
                                <div style="clear: both"></div>
                              	<div class="col-md-6">
                                  <h5>Population -</h5>
                                </div>
                                <div class="col-md-6">
                                  <span><?php echo $row_Contents_['population']; ?></span>
                                </div>
                                <div style="clear: both"></div>
                                <div class="col-md-6">
                                  <h5>Population density -</h5>
                                </div>
                                <div class="col-md-6">
                                  <span><?php echo $row_Contents_['populationDensity']; ?></span>
                                </div>
                              <div style="clear: both"></div>
                              <div class="col-md-6">
                                  <h5>Economy -</h5>
                                </div>
                                <div class="col-md-6">
                                  <span><?php echo $row_Contents_['economy']; ?></span>
                                </div>
                              <div style="clear: both"></div>
                              <div class="col-md-6">
                                  <h5>Education -</h5>
                                </div>
                                <div class="col-md-6">
                                  <span><?php echo $row_Contents_['education']; ?></span>
                                </div>
                              <div style="clear: both"></div>
                              <div class="col-md-6">
                                  <h5>Health -</h5>
                                </div>
                                <div class="col-md-6">
                                  <span><?php echo $row_Contents_['health']; ?></span>
                                </div>
                              <div style="clear: both"></div>
                           <?php }?>
                              	
                           </div>
                            <div class="col-md-12">
                            <h4>Related News</h4>
								<fieldset class="rsslib">
								<?php 
									if ($cid == 0) 
										{ $news='kenya'; } 
									else 
										{ $news = 'county+'.$row_Contents_['Name']; }
								
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
                     
                 
