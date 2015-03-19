<?php require('Includefiles/conn.inc');

  $cid = (int)$_POST['cid'];
  $did = (int)$_POST['did'];
  $dept = $_POST['dept'];
 //  echo $dept; exit;
  $mwaka = $_POST['mwaka'];
  $QT = $_POST['QT'];

  
  
   $query_Links5 ="SELECT distinct `mwaka`, sum(`AllocationQ1`) as AQ1, sum(`AllocationQ2`) as AQ2, sum(`AllocationQ3`) as AQ3, sum(`AllocationQ4`) as AQ4, sum(`ExpendedQ1`) as EQ1, sum(`ExpendedQ2`) as EQ2, sum(`ExpendedQ3`) as EQ3, sum(`ExpendedQ4`) as EQ4 FROM `Department` where `countyid`=$cid and mwaka ='$mwaka'";
			  $Contents5 = mysql_query($query_Links5, $conn) or die(mysql_error());
			  $row_Contents5 = mysql_fetch_assoc($Contents5);
				if (($row_Contents5['AQ1']!=0) || ($row_Contents5['EQ1']!=0)) { $AQ = 'AllocationQ1'; $EQ = 'ExpendedQ1';}
				if (($row_Contents5['AQ2']!=0) || ($row_Contents5['EQ2']!=0)) { $AQ = 'AllocationQ2'; $EQ = 'ExpendedQ2';}
				if (($row_Contents5['AQ3']!=0) || ($row_Contents5['EQ3']!=0)) { $AQ = 'AllocationQ3'; $EQ = 'ExpendedQ3';}
				if (($row_Contents5['AQ4']!=0) || ($row_Contents5['EQ4']!=0)) { $AQ = 'AllocationQ4'; $EQ = 'ExpendedQ4';}
					 
		$QT = $_GET['QT'];
		if ($QT == "") {$QT=$AQ; } 

  if (($cid == 0) && ($dept == "")) {
    $result = mysql_query("SELECT id, DName as Name, $AQ as Allocation, $EQ as 'Expended', ($EQ/$AQ)*100 as Pct FROM  Department WHERE mwaka =  '$mwaka'");
  ?>
  <table class="col-md-12 table table-hover">
    <caption>Amounts in KES</caption>
    <thead>
      <tr>
        <th>&nbsp;</th>
        <th>Department Name</th>
        <th>Amount Released<br> (in Millions)</th>
        <th>Amount Expenses<br> (in Millions)</th>
        <th>Absorption</th>
      </tr>
    </thead>
    <tbody>
      <?php
        // Write rows
        $k=1;
        //mysql_data_seek($projects, 0);
        while ($row = mysql_fetch_assoc($result)) {
          $pct = ($row['Pct'] == "Null") ? 0 : (int)$row['Pct']; 
      ?>
      <tr>
        <td><?php echo $k++; ?></td>
        <td><a href="allocation.php?cid=<?php echo $cid;?>"><?php echo $row['Name']; ?></a></td>
        <td align="left"><?php echo number_format($row['Allocation'],2); ?></td>
        <td align="left"><?php echo number_format($row['Expended'],2); ?></td>
        <td align="left"><?php echo $pct; ?>%</td>
        <?php $ar += $row['Allocation']; ?>
        <?php $ae += $row['Expended']; ?>
      </tr>
      <?php } ?>
      <tr>
        <td>&nbsp;</td>
        <td><b>Totals</b></td>
        <td><b><?php echo number_format($ar,2); ?></b></td>
        <td><b><?php echo number_format($ae,2); ?></b></td>
        <td><b><?php if(($ae==0) || ($ar==0)) { echo '0'; } else {echo number_format(($ae/$ar)*100);} ?>%</b></td>
      </tr>
    </tbody>
  </table>
  <?php
    }
    elseif (($cid == 0) && ($dept != "")) {
      $result =mysql_query("SELECT indicators as 'Name', NetEst_1 as 'AllocationQ1', ExchIssues_1 as 'ExpendedQ1', (ExchIssues_1/NetEst_1)*100 as Pct FROM nationalexpenditure WHERE id =$did AND   used =1 ");
  ?>
  <table class="col-md-12 table table-hover">
    <caption>Amounts in KES</caption>
    <thead>
      <tr>
        <th>&nbsp;</th>
        <th>Department Name</th>
        <th>Amount Released<br> (in Millions)</th>
        <th>Amount Expenses<br> (in Millions)</th>
        <th>Absorption</th>
      </tr>
    </thead>
    <tbody>
      <?php
      // Write rows
      $k=1;
      //mysql_data_seek($projects, 0);
      while ($row = mysql_fetch_assoc($result)) {
        $pct = ($row['Pct'] == "Null") ? 0 : (int)$row['Pct']; 
      ?>
      <tr>
        <td><?php echo $k++; ?></td>
        <td><?php echo $row['Name']; ?></td>
        <td><?php echo number_format($row['AllocationQ1'],2); ?></td>
        <td><?php echo number_format($row['ExpendedQ1'],2); ?></td>
        <td><?php echo $pct; ?>%</td>
        <?php $ar += $row['AllocationQ1']; ?>
        <?php $ae += $row['ExpendedQ1']; ?>
      </tr>
      <?php } ?>
      <tr>
        <td>&nbsp;</td>
        <td><b>Totals</b></td>
        <td><b><?php echo number_format($ar,2); ?></b></td>
        <td><b><?php echo number_format($ae,2); ?></b></td>
        <td><b><?php if(($ae==0) || ($ar==0)) { echo '0'; } else {echo number_format(($ae/$ar)*100);} ?>%</b></td>
      </tr>
    </tbody>
  </table>
    <?php
    } 
    elseif (($cid != 0) && ($dept == "")) {
	$query_Contents_4 =mysql_query("SELECT  distinct mwaka FROM Department where countyid=$cid ORDER BY mwaka ASC LIMIT 1");
	$row_Contents_4 = mysql_fetch_assoc($query_Contents_4);
	if ($mwaka == ""){$mwaka= $row_Contents_4['mwaka'];}
 // echo "SELECT id, Name, $AQ, $EQ, ($EQ/$AQ)*100 as Pct  FROM Department where countyid = $cid ";
    $result =mysql_query("SELECT id, DName, sum($AQ) as Allocation, sum($EQ) as Expended, ((sum($EQ)/sum($AQ))*100) as Pct  FROM Department where countyid = $cid AND mwaka = '$mwaka' GROUP BY DName ");
  ?>
  <table class="col-md-12 table table-hover">
    <caption><?php echo $QT;?>  Amounts in KES</caption>
    <thead>
      <tr>
        <th>&nbsp;</th>
        <th>Department Name</th>
        <th>Annual Budget<br> Approved by COB</th>
        <th>Amount<br>Released</th>
        <th>Amount<br>Expenses</th>
        <th>Absorption</th>
      </tr>
    </thead>
    <tbody>
      <?php
      // Write rows
      $k=1;
      //mysql_data_seek($projects, 0);
      while ($row = mysql_fetch_assoc($result)) {
        $pct = ($row['Pct'] == "Null") ? 0 : (int)$row['Pct']; 
      ?>
      <tr>
        <td><?php echo $k++; ?></td>
        <td><a href="allocation.php?mwaka=<?php echo $mwaka;?>&dept=<?php echo $row['DName'];?>&QT=<?php echo $QT;?>&cid=<?php echo $cid;?>&did=<?php echo $row['id'];?>"><?php echo $row['DName']; ?></a></td>
        <td><?php echo number_format($row['BudgetApprovedAnnual'],2); ?></td>
        <td><?php echo number_format($row['Allocation'],2); ?></td>
        <td><?php echo number_format($row['Expended'],2); ?></td>
        <td><?php echo $pct; ?>%</td>
        <?php $al += $row['BudgetApprovedAnnual']; ?>
        <?php $ar += $row['Allocation']; ?>
        <?php $ae += $row['Expended']; ?>
      </tr>
      <?php } ?>
      <tr>
        <td>&nbsp;</td>
        <td><b>Totals</b></td>
        <td><b><?php echo number_format($al,2); ?></b></td>
        <td><b><?php echo number_format($ar,2); ?></b></td>
        <td><b><?php echo number_format($ae,2); ?></b></td>
        <td><b><?php if(($ae==0) || ($ar==0)) { echo '0'; } else {echo number_format(($ae/$ar)*100);} ?>%</b></td>
      </tr>
    </tbody>
  </table>
  <?php
    } 
    elseif (($cid != 0) && ($dept != "")) {
      $result =mysql_query("SELECT id, Projects as Name, $AQ as Allocation, $EQ as 'Expended', ($EQ/$AQ)*100 as Pct FROM  Department WHERE mwaka =  '$mwaka' AND countyid = $cid AND Dname = '$dept' ");
      //echo "SELECT id, Projects as Name, $AQ as Allocation, $EQ as 'Expended', ($EQ/$AQ)*100 as Pct FROM  Department WHERE mwaka =  '$mwaka' AND countyid = $cid AND Dname = '$dept' ";
  ?>
  <table class="col-md-12 table table-hover">
    <caption><?php echo $QT;?> Amounts in KES</caption>
    <thead>
      <tr>
        <th>&nbsp;</th>
        <th>Project Name</th>
        <th>Amount<br>Released</th>
        <th>Amount<br>Expenses</th>
        <th>Absorption</th>
      </tr>
    </thead>
    <tbody>
      <?php
      // Write rows
      $k=1;
      //mysql_data_seek($projects, 0);
      while ($row = mysql_fetch_assoc($result)) {
        $pct = ($row['Pct'] == "Null") ? 0 : (int)$row['Pct']; 
      ?>
      <tr>
        <td><?php echo $k++; ?></td>
        <td><?php echo $row['Name']; ?></td>
        <td><?php echo number_format($row['Allocation'],2); ?></td>
        <td><?php echo number_format($row['Expended'],2); ?></td>
        <td><?php echo $pct; ?>%</td>
        <?php $ar += $row['Allocation']; ?>
        <?php $ae += $row['Expended']; ?>
      </tr>
      <?php } ?>
      <tr>
        <td>&nbsp;</td>
        <td><b>Totals</b></td>
        <td><b><?php echo number_format($ar,2); ?></b></td>
        <td><b><?php echo number_format($ae,2); ?></b></td>
        <td><b><?php if(($ae==0) || ($ar==0)) { echo '0'; } else {echo number_format(($ae/$ar)*100);} ?>%</b></td>
      </tr>
    </tbody>
  </table>
<?php } ?>
                
