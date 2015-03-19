<?php require('Includefiles/header.php'); ?>

    <!-- Hero -->
    <div class="hero">
      <div class="container">
        <h1>Welcome to the <span>Open County Dashboard</span></h1>
        <h2 class="heading">Find out what your county is accomplishing</h2>
        
        <div class="row">
        <div class="col-md-6">
        <div class="wrapper">
        <img id="counties" src="img/counties.gif" alt="Kenya Counties" width="530px" border="0" usemap="#Map">
       
    </div>
        </div>
        <div class="col-md-6">
          <!-- <div class="national active col-sm-3"><a href="./performance.php?cid=0"><h5><strong>National</strong></h5></a></div> -->
          <div class="national active col-sm-12 columns"><a href="./comparison.php"><h5><strong>County Comparison</strong></h5></a></div>
          <?php
              $query_Contents_2 =mysql_query("SELECT county.id , county.countyname, '0' as Val FROM county ORDER by countyname");
              while ($row_Contents_2=mysql_fetch_array($query_Contents_2)) {
                $cid = $row_Contents_2['id'];
                //~ 
                //~ $query_Contents_3 = mysql_query("SELECT DISTINCT countyid FROM Department where countyid = $cid");
//~ 
                //~ $totalRows_Contents = mysql_num_rows($query_Contents_3);
                //~ if ($totalRows_Contents>=1) {
                  echo '<div class="county active col-sm-3"><a href="./performance.php?cid='.$row_Contents_2['id'].'"><h5>'.$row_Contents_2['countyname'].'</h5></a></div>';
                //~ }
                //~ else {
                  //~ echo '<div class="county inactive col-sm-3"><h5>'.$row_Contents_2['countyname'].'</h5></div>';
                //~ }
              } ?>
        </div>
        </div>
      </div>
    </div>
    <!-- End of hero -->

    <!-- Footer -->
  <?php include ("./Includefiles/footer.php"); ?>
    <!-- End of Footer -->
     <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
     <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
    <script type="text/javascript">
   $("#submit").click(function(){
       var cid = $("#county").val();
       var mwaka = $("#mwaka").val();
      if (cid!="") {
          window.location.href='performance.php?cid=' + cid;
      }
    });
  
     </script>   
  </body>
</html>
