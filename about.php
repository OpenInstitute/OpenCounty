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
        <div class="about-county row">
          <div class="row section">
            <div class="col-md-2 columns">
              <div class="map">
                <img class="indi" src="./maps/<?php echo str_replace(' ','-',trim($row_Contents_2['County']));?>_Map.jpg">
              </div>
            </div>
            <div class="col-md-7 columns">
              <div class="blurb">
              <h4>General Information</h4>
                <?php echo $row_Contents_2['AboutBlurb']; ?>
              </div>
              <div class="constituencies">
                <h4>Constituencies</h4>
                  <p><?php echo $row_Contents_2['Constituencies']; ?></p>
              </div>
            </div>
            <div class="col-md-3 columns quick-links cfs">
              <div class="heading"><h3>Quick Links</h3></div>
              <p>
                <?php if(!empty($row_Contents_2['Website'])) { ?>Official Website: <a href="<?php echo $row_Contents_2['Website']; ?>"><?php echo $row_Contents_2['Website']; ?></a><br /><?php } ?>
                <?php if(!empty($row_Contents_2['Email'])) { ?>Email: <a href="mailto:<?php echo $row_Contents_2['Email']; ?>"><?php echo $row_Contents_2['Email']; ?></a><br /><?php } ?>
                <?php if(!empty($row_Contents_2['Twitter'])) { ?>Twitter: <a href="<?php echo $row_Contents_2['Twitter']; ?>">@<?php echo $row_Contents_2['Twitter']; ?></a><br /><?php } ?>
                <?php if(!empty($row_Contents_2['Telephone'])) { ?>Tel: <?php echo $row_Contents_2['Telephone']; ?><br /><?php } ?>
                <?php if(!empty($row_Contents_2['PostalAddress'])) { ?>Address: <br /><?php echo $row_Contents_2['PostalAddress']; ?><br /><?php } ?>
                <br /><br />
                <a target="blank" href="http://devolutionhub.or.ke/resources/47-counties/<?php echo str_replace(' ','-',trim($row_Contents_2['County'])); ?>">
                  Explore resources on devolution in Kenya and <?php echo $row_Contents_2['County']; ?> County on DevolutionHub.or.ke
                </a>
                <br />
              </p>
            </div>
          </div>
          <div class="row section">
            <div class="col-md-3 columns cfs">
              <div class="heading"><h3>Economy</h3></div>
              <p><?php formatter($row_Contents_2['Economy']); ?></p>
            </div> 
            <div class="col-md-3 columns cfs">
              <div class="heading"><h3>Health</h3></div>
              <p><?php formatter($row_Contents_2['Health']); ?></p>
            </div>
            <div class="col-md-3 columns cfs">
              <div class="heading"><h3>Education</h3></div>
              <p><?php formatter($row_Contents_2['Education']); ?></p>
            </div>
            <?php
  				    $query_Contents_ =mysql_query("SELECT * FROM countyPopulation WHERE countyid =$cid");
  				    $row_Contents_ =mysql_fetch_assoc($query_Contents_);
            ?>
            <div class="col-md-3 columns cfs">
              <div class="heading"><h3>County Facts</h3></div>
              <p>
              <?php if (!empty($row_Contents_['Population2009'])) { ?><span>Population (2009):</span>&nbsp;&nbsp;&nbsp;<?php echo $row_Contents_['Population2009']; ?><br /><?php } ?>
              <?php if (!empty($row_Contents_['AnnualPopGrowthRate1999-2009'])) { ?><span>Annual Population Growth Rate (%):</span>&nbsp;&nbsp;&nbsp;<?php echo $row_Contents_['AnnualPopGrowthRate1999-2009']; ?><br /><?php } ?>
              <?php if (!empty($row_Contents_['ShareUrbanPop2009'])) { ?><span>Share of Urban Population, 2009 (%):</span>&nbsp;&nbsp;&nbsp;<?php echo $row_Contents_['ShareUrbanPop2009']; ?><br /><?php } ?>
              <?php if (!empty($row_Contents_['UrbanPopTowns2009'])) { ?><span>Urban Population in Largest Towns (2009):</span>&nbsp;&nbsp;&nbsp;<br /><?php echo $row_Contents_['UrbanPopTowns2009']; ?><br /><?php } ?>
              <?php if (!empty($row_Contents_['PopPriEdu'])) { ?><span>Population with Primary Education (%):</span>&nbsp;&nbsp;&nbsp;<?php echo $row_Contents_['PopPriEdu']; ?><br /><?php } ?>
              <?php if (!empty($row_Contents_['PopSecEdu'])) { ?><span>Population with Secondary Education (%):</span>&nbsp;&nbsp;&nbsp;<?php echo $row_Contents_['PopSecEdu']; ?><br /><?php } ?>
              <?php if (!empty($row_Contents_['PopPerNurse'])) { ?><span>Population Per Nurse:</span>&nbsp;&nbsp;&nbsp;<?php echo $row_Contents_['PopPerNurse']; ?><br /><?php } ?>
              <?php if (!empty($row_Contents_['PopPerDoctor'])) { ?><span>Population Per Doctor:</span>&nbsp;&nbsp;&nbsp;<?php echo $row_Contents_['PopPerDoctor']; ?><br /><?php } ?>
              <?php if (!empty($row_Contents_['ShareCountyReg2012'])) { ?><span>County's Share of Registered Voters in 2012:</span>&nbsp;&nbsp;&nbsp;<?php echo $row_Contents_['ShareCountyReg2012']; ?><br /><?php } ?>
              <br /><a href="http://devolutionhub.or.ke/blog/2015/02/kenya-county-fact-sheets-june-2013-second-edition">Download Full County Fact Sheet</a>
              </p>
            </div>
          </div>
          <div class="row administration">
            <div class="tabbable-panel">
              <div class="tabbable-line">
                <ul class="nav nav-tabs ">
                  <li class="active"><a href="#administration" data-toggle="tab">Administration</a></li>
                  <li><a href="#mcas" data-toggle="tab">MCAs </a></li>
                  <li><a href="#mps" data-toggle="tab">MPs </a></li>
                </ul>
                
                <div class="tab-content">
                  <div class="tab-pane active" id="administration">
                    <div class="row">
                      <div class="col-md-12">
                        <ul class="nav nav-justified" id="nav-tabs" role="tablist">
                          <li role="presentation" class="active">
                            <h3><strong>Governor</strong></h3>
                            <a href="#governor" aria-controls="governor" role="tab" data-toggle="tab">
                            <?php 
                              echo '<img class="img-circle" src="img/GovernorsCropped/'. str_replace(' ','-',$row_Contents_2['County']) .'_Gov.jpg" />'; 
                            ?></a>
                            <br />
                            <p><?php echo $row_Contents_2['Governor']; ?></p>
                          </li>
                          <li role="presentation">
                            <h3><strong>Deputy Governor</strong></h3>
                            <a href="#deputygovernor" aria-controls="deputygovernor" role="tab" data-toggle="tab">
                            <?php 
                              echo '<img class="img-circle" src="img/DeputyGovernors/'. str_replace(' ','-',$row_Contents_2['County']) .'_DepGov.jpg" />'; 
                            ?></a>
                            <br />
                            <p><?php echo $row_Contents_2['DeputyGovernor']; ?></p>
                          </li>
                          <li role="presentation">
                            <h3><strong>Senator</strong></h3>
                            <a href="#senator" aria-controls="senator" role="tab" data-toggle="tab">
                            <?php 
                              echo '<img class="img-circle" src="img/Senators/'. str_replace(' ','-',$row_Contents_2['County']) .'_Sen.jpg" />'; 
                            ?></a>
                            <br />
                            <p><?php echo $row_Contents_2['Senator']; ?></p>
                          </li>
                          <li role="presentation">
                            <h3><strong>Women Representative</strong></h3>
                            <a href="#womenrep" aria-controls="womenrep" role="tab" data-toggle="tab">
                            <?php 
                              echo '<img class="img-circle" src="img/WomenRep/'. str_replace(' ','-',$row_Contents_2['County']) .'_WoRep.jpg" />'; 
                            ?></a>
                            <br />
                            <p><?php echo $row_Contents_2['WomenRep']; ?></p>
                          </li>
                          <?php
                            $cid = (int)$_GET['cid'];
                            $query_Contents_3 = mysql_query("SELECT * FROM MCAData INNER JOIN IBPOnlineBudget2014 ON MCAData.countyid = IBPOnlineBudget2014.countyid WHERE MCAData.countyid = $cid");
                            $row_Contents_3=mysql_fetch_assoc($query_Contents_3);
                          ?>
                          <li role="presentation">
                            <h3><strong>County Assembly</strong></h3>
                            <a href="#countyassembly" aria-controls="countyassembly" role="tab" data-toggle="tab">
                            <img class="img-circle group" src="img/group.png" /></a>
                          </li>
                        </ul>
                      </div>
                    </div>
                    <div class="tab-content" id="tabs-collapse">
                      <div role="tabpanel" class="tab-pane fade in active" id="governor">
                        <div class="tab-inner">                    
                          <p><strong class="text-uppercase"><?php echo $row_Contents_2['Governor']; ?></strong></p>
                          <hr>
                          <?php if(!empty($row_Contents_2['OfficeGovernorEmail'])) { ?><p>Office of the Governor: <a href="mailto: <?php echo $row_Contents_2['OfficeGovernorEmail']; ?>"><?php echo $row_Contents_2['OfficeGovernorEmail']; ?></a></p><?php } ?>
                          <span>Committees:  </span><?php formatter($row_Contents_2['Governor_CoGCommittee']); ?>
                        </div>
                      </div>
                      <div role="tabpanel" class="tab-pane fade in" id="deputygovernor">
                        <div class="tab-inner">                    
                          <p><strong class="text-uppercase"><?php echo $row_Contents_2['DeputyGovernor']; ?></strong></p>
                          <hr>
                          <?php if(!empty($row_Contents_2['OfficeDeputyGovernorEmail'])) { ?><p>Office of the Deputy Governor: <a href="mailto: <?php echo $row_Contents_2['OfficeDeputyGovernorEmail']; ?>"><?php echo $row_Contents_2['OfficeDeputyGovernorEmail']; ?></a></p><?php } ?>
                        </div>
                      </div>
                      <div role="tabpanel" class="tab-pane fade in" id="senator">
                        <div class="tab-inner">                    
                          <p><strong class="text-uppercase"><?php echo $row_Contents_2['Senator']; ?></strong></p>
                          <hr>
                        </div>
                      </div>
                      <div role="tabpanel" class="tab-pane fade in" id="womenrep">
                        <div class="tab-inner">                    
                          <p><strong class="text-uppercase"><?php echo $row_Contents_2['WomenRep']; ?></strong></p>
                          <hr>
                        </div>
                      </div>
                      <div role="tabpanel" class="tab-pane fade in" id="countyassembly">
                        <div class="tab-inner">                    
                          <p><strong class="text-uppercase"><?php echo $row_Contents_2['County']; ?> County</strong></p>
                          <hr>
                          <p><?php echo $row_Contents_2['County']; ?> County has <strong> <?php echo $row_Contents_3['TotMCAs']; ?></strong> MCAs from <strong><?php echo $row_Contents_3['ConstituencyNo']; ?> </strong> constituencies</p>
                          <?php if (!empty($row_Contents_3['CAWebEmail'])) { ?><p>County Assembly Website: <a href="<?php echo $row_Contents_3['CAWebEmail']; ?>" target="_blank"><?php echo $row_Contents_3['CAWebEmail']; ?></a></p><?php } ?>
                        </div>
                      </div>
                    </div>
                  </div>

                  <div class="tab-pane" id="mcas">
                    <div class="row">                       
                      <div class="col-md-4 columns">
                        <nav class="nav-sidebar">
                          <ul class="nav tabs">
                            <?php
                              $cid = (int)$_GET['cid'];
                                $query_Contents_5 = mysql_query("SELECT DISTINCT Constituency from mcas WHERE countyid = $cid AND Constituency IS NOT NULL ORDER BY Constituency ");
                                while($row_Contents_5= mysql_fetch_array($query_Contents_5)) {
                                  $constituency = $row_Contents_5['Constituency'];
                                  $con = str_replace(' ','-',trim($constituency));
                            ?>
                            <li class="level2" cid=<?php echo $cid; ?> Cons='<?php echo $constituency; ?>' id=<?php echo $con; ?>><i class="pointer"></i><?php echo $constituency; ?></li>
                            <?php } ?>
                            <li class="level2" cid=<?php echo $cid; ?> Cons="Nominated" id="Nominated"><i class="pointer"></i>Nominated</li>
                          </ul>
                        </nav>
                      </div>
                      <div class="col-md-8 columns">
                        <div class="tab-content">
                          <div class="tab-pane active text-style" id="mcaData">Please select a constituency</div>
                        </div>
                      </div>
                    </div>
                  </div>
                  
                  <div class="tab-pane" id="mps">
                    <div class="row">                       
                      <div class="col-md-2 columns">&nbsp;
					  </div>
					  <div class="col-md-8 columns">
                        <table class="table table-condensed table-hover">
							<thead>
							  <th>Name</th>
							  <th>Constituency</th>
							  <th>Party</th>
							</thead>
							<?php
								$query_Contents_4 = mysql_query("SELECT * FROM MPs WHERE countyid = $cid ORDER BY MPName");
							
								while($row_Contents_4 = mysql_fetch_array($query_Contents_4)){

							echo '<tr>
									  <td>'. $row_Contents_4['MPName'] .'</td>
									  <td>'. $row_Contents_4['Constituency'] .'</td>
									  <td>'. $row_Contents_4['Party'] .'</td>
									</tr>';
								 } 
							?>
						</table>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
        </div><!-- .overview -->
      <div class="allocation row">
      
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
	$(document).ready(function() {
		
		$(".dropdown-menu").on("click", "li", function(){
		  var cid =$(this).attr('cid');// $(this).text();
		  window.location.href='performance.php?cid=' + cid;
		});
		
		var liCons = $("li.level2",this).attr('Cons');
		var liCID = $("li.level2",this).attr('cid');
		var liID = $("li.level2",this).attr('id');
		$("#"+liID).addClass('active');
		mcaAJAX(liCID,liCons);
     
		$("li.level2").click(function(){
		
		  $("li.level2").removeClass('active');
		  $(this).addClass('active');
		  var cid = $(this).attr('cid');
		  var mcaCons = $(this).attr('Cons');
		  var divto = $(this).attr('divto');
		  mcaAJAX(cid,mcaCons);
		});
    
    
		function mcaAJAX(c,d) {
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
			  $("#mcaData").html('there is error while submit');
			}
		  }); 
		}
		
		$('.selectpicker').selectpicker({
        maxOptions: 1
		});
      

       $(".selectpicker").change(function() {
		   
         var element = $('option:selected',this);
         var countyid = element.attr('value');
         window.location.href = './about.php?cid='+countyid;
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
