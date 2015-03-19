<?php require('conn.inc'); ?>
  <?php
    $query_Contents_2 =mysql_query("SELECT * FROM countyInfo WHERE countyid =$cid");
    $row_Contents_2=mysql_fetch_assoc($query_Contents_2);
  ?>
		<div class="county-info row" 
      style="background-image: url(
        <?php
          echo 'img/Background/'. str_replace(' ','-',str_replace("'","",$row_Contents_2['County'])) .'_Gen.jpg';
        ?>); background-size: cover; height: 280px">      
      <div class="dropdown col-md-3">
        <select class="selectpicker show-tick" data-live-search="true" data-size="10">
          <?php
            //$query_Contents_1 =mysql_query("SELECT distinct county.id, county.countyname FROM `Department` inner join county on Department.countyid = county.id order by county.countyname");
             $query_Contents_1 =mysql_query("SELECT distinct county.id, county.countyname FROM county ORDER BY county.countyname");
            while ($row_Contents_1=mysql_fetch_array($query_Contents_1)) {
              $cid_ = $row_Contents_1['id'];
              echo '<option value='. $cid_ ; 
              if($cid_==$cid){ echo ' selected'; }
                echo '>'. $row_Contents_1['countyname']. '</option>';
              }
          ?>
        </select>
      </div>
      <div class="col-md-7 columns">
        <!-- <?php if(!empty($row_Contents_2['Facebook'])||($row_Contents_2['Twitter'])||($row_Contents_2['Email'])||($row_Contents_2['Website'])) { ?> -->
        <div class="links">
          <a class="devhub" target="blank" href="http://devolutionhub.or.ke/resources/47-counties/<?php echo str_replace(' ','-',trim($row_Contents_2['County'])); ?>">
            <img src="https://dl.dropbox.com/s/4yml90tm0616o1t/Devhublogo.png" style="height:120px;margin-bottom: -60px;margin-left: -30px;margin-top: -15px;" />
          </a>
          <br />
          <?php if(!empty($row_Contents_2['Facebook'])) { ?><span><a href="https://www.facebook.com/<?php echo $row_Contents_2['Facebook'];?>"><i class="fa fa-facebook-square"></i><?php echo $row_Contents_2['Facebook'];?></a></span><br /><?php } ?>
          <?php if(!empty($row_Contents_2['Twitter'])) { ?><span><a href="http://twitter.com/<?php echo $row_Contents_2['Twitter'];?>"><i class="fa fa-twitter"></i> @<?php echo $row_Contents_2['Twitter'];?></a></span><br /><?php } ?>
          <?php if(!empty($row_Contents_2['Email'])) { ?><span><a href="mailto:<?php echo $row_Contents_2['Email'];?>"><i class="fa fa-envelope"></i> <?php echo $row_Contents_2['Email'];?></a></span><br /><?php } ?>
          <?php if(!empty($row_Contents_2['Website'])) { ?><span><a href="<?php echo $row_Contents_2['Website'];?>" target=_blank><i class="fa fa-link"></i> <?php echo $row_Contents_2['Website'];?></a></span><?php } ?>
        </div>
        <!-- <?php } ?> -->
      </div>
      <div class="view-more col-md-2 columns indi">
        <div class="governor" style="background-image:url(<?php echo 'img/Governors/'. str_replace(' ','-',str_replace("'","",$row_Contents_2['County'])) .'_Gov.jpg';
        ?>);">
          <!-- <?php 
          echo '<img src="img/Governors/'. str_replace(' ','-',$row_Contents_2['County']) .'_Gov.jpg" style="width:180px; margin-left:-5px;" />';
            //echo '<img src="http://placehold.it/180x230&text=Image+not+available" />';
          ?> -->
          <small><strong>Governor: <?php echo $row_Contents_2['Governor'];?></strong></small>
        </div>
      </div>
    </div>
    
    <div id="menu-bar" class="row">
      <?php 
        $geturl = $_SERVER['SCRIPT_NAME'];
        $urlsnip = explode('/', $geturl);
        $current = $urlsnip[count($urlsnip) - 1];

        if ($current=="performance.php") {      
          $performance = 'active';
        } elseif ($current=="allocation.php") { 
          $allocation = 'bar'; 
        } elseif ($current=="about.php") {
          $about = 'active';
        } elseif ($current=="newsfeed.php") {
          $newsfeed = 'active';
        } elseif ($current=="downloads.php") {
          $downloads = 'active';
        }
      ?>
      <div class="col-md-2"><a class="<?php echo $performance; ?>" href="performance.php?cid=<?php echo $cid;?>">General Indicators</a></div>
      <div class="col-md-2"><a class="<?php echo $allocation; ?>" href="allocation.php?cid=<?php echo $cid;?>">Allocations</a></div>
      <div class="col-md-2"><a class="<?php echo $about; ?>" href="about.php?cid=<?php echo $cid;?>">About County</a></div>
      <div class="col-md-2"><a class="<?php echo $newsfeed; ?>" href="newsfeed.php?cid=<?php echo $cid;?>">Newsfeed</a></div>
      <div class="col-md-2"><a class="<?php echo $downloads; ?>" href="downloads.php?cid=<?php echo $cid;?>">Downloads</a></div>
    </div>
