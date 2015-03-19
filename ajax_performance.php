<?php require('Includefiles/conn.inc');
					 
  $cid = (int)$_POST['cid'];
  $did = (int)$_POST['did'];
  $dept = $_POST['dept'];
  $mwaka = $_POST['mwaka'];
  $QT = $_POST['QT'];
  
  //echo $mwaka;
  $query_Contents_4 =mysql_query("SELECT  distinct mwaka FROM Department where countyid=$cid ORDER BY mwaka ASC LIMIT 1");
  $row_Contents_4 = mysql_fetch_assoc($query_Contents_4);
  if ($mwaka == ""){$mwaka= $row_Contents_4['mwaka'];}
	
	if ($QT == "") {
	  $query_Links5 ="SELECT distinct mwaka, sum(AllocationQ1) as AQ1, sum(AllocationQ2) as AQ2, sum(AllocationQ3) as AQ3, sum(AllocationQ4) as AQ4 FROM Department where countyid=$cid and mwaka ='$mwaka'";
	  $Contents5 = mysql_query($query_Links5, $conn) or die(mysql_error());
	  $row_Contents5 = mysql_fetch_assoc($Contents5);
		if ($row_Contents5['AQ1']!=0) {  $AQ = 'AllocationQ1'; $EQ = 'ExpendedQ1';}
		if ($row_Contents5['AQ2']!=0) {  $AQ = 'AllocationQ2'; $EQ = 'ExpendedQ2';}
		if ($row_Contents5['AQ3']!=0) {  $AQ = 'AllocationQ3'; $EQ = 'ExpendedQ3';}
		if ($row_Contents5['AQ4']!=0) {  $AQ = 'AllocationQ4'; $EQ = 'ExpendedQ4';}
	} else {
		if ($QT=='AllocationQ1') { $AQ = 'AllocationQ1'; $EQ = 'ExpendedQ1';}
		if ($QT=='AllocationQ2') { $AQ = 'AllocationQ2'; $EQ = 'ExpendedQ2';}
		if ($QT=='AllocationQ3') { $AQ = 'AllocationQ3'; $EQ = 'ExpendedQ3';}
		if ($QT=='AllocationQ4') { $AQ = 'AllocationQ4'; $EQ = 'ExpendedQ4';}
			
	}			 
		
		//if ($QT == "") {$QT=$AQ; } 
		
  $cl =  "progress-bar-success";
  if (($cid == 0) && ($dept == "")){
    $query_Contents_C = mysql_query("SELECT id, GrossEst_1 as Excheq, concat('<a href=?cid=0&did=',id,'>',indicators,'</a>') AS Name, (ExchIssues_1*1000000) as Exp, (NetEst_1*1000000) as Alloc,(ExchIssues_1/NetEst_1)*100 as Pct FROM nationalexpenditure WHERE   used =1 ");
  } 
  elseif (($cid == 0) && ($dept != "")) {
    $query_Contents_C =mysql_query("SELECT id, GrossEst_1  as Excheq, indicators AS Name, (ExchIssues_1*1000000) as Exp, (NetEst_1*1000000) as Alloc,(ExchIssues_1/NetEst_1)*100 as Pct FROM nationalexpenditure WHERE id = $did AND  used =1 ");
  }
  elseif (($cid != 0) && ($dept == "")) {
    $query_Contents_C = mysql_query("SELECT mwaka, concat('<a href=?cid=$cid&dept=', REPLACE(Dname,' ','%20') , '>', Dname , '</a>') as Name, sum($AQ) as Alloc, sum($EQ) as Exp,(sum($EQ)/sum($AQ))*100 as Pct  FROM Department WHERE countyid=$cid and mwaka ='$mwaka'  group by  DName ");
  }
  elseif (($cid != 0) && ($dept != "")) {
    $query_Contents_C = mysql_query("SELECT mwaka, Projects as Name, $AQ as Alloc, $EQ as Exp,($EQ/$AQ)*100 as Pct   FROM Department WHERE countyid=$cid and mwaka ='$mwaka' AND Dname = '$dept'");
  }
//echo "SELECT mwaka, Projects as Name, sum($AQ) as Alloc, sum($EQ) as Exp,(sum($EQ)/sum($AQ))*100 as Pct   FROM Department WHERE countyid=$cid and mwaka ='$mwaka' AND Dname = '$dept'";
  //"SELECT id, AllocationQ1 AS Alloc, ExpendedQ1 AS Exp, CONCAT(  '<a href=?cid=3&did=', id,  '>', Name,  '</a>' ) AS Name, (ExpendedQ1 / AllocationQ1) *100 AS Pct FROM Department WHERE countyid =3 ORDER BY AllocationQ1 ASC LIMIT 0 , 30";
  while ($row_Contents_C=mysql_fetch_array($query_Contents_C)) {
    $pct = 0;

    if ($row_Contents_C['Exp'] < $row_Contents_C['Alloc']) { 
      $cl =  "progress-bar-info";  //echo  $row_Contents_C['Alloc'] .'>>'. $row_Contents_C['Exp'];
    } 
    if ($row_Contents_C['Exp'] > $row_Contents_C['Alloc']) { 
      $cl =  "progress-bar-danger"; //echo  $row_Contents_C['Alloc'] .'<<'. $row_Contents_C['Exp'];
    }
    if ($row_Contents_C['Exp'] == $row_Contents_C['Alloc']) { 
      $cl =  "progress-bar-success"; //echo  $row_Contents_C['Alloc'] .'>>'. $row_Contents_C['Exp'];
    }
    $perc = ($row_Contents_C['Pct'] == "Null") ? 0 : (int)$row_Contents_C['Pct'] ;
    $pct = ($row_Contents_C['Pct'] == "Null") ? 0 : ($row_Contents_C['Pct'] >= "100") ? 100 : (int)$row_Contents_C['Pct'];
                   		
  	$br .= '<div class="col-md-6 panel">';
  	$br .= '   <h5>'. $row_Contents_C['Name'] .'</h5>';
    $br .= ' <h1 class="title">'.bd_nice_number($row_Contents_C['Exp']) .'</h1> spent from <span class="req-amt">'. bd_nice_number($row_Contents_C['Alloc']) .'</span> released';
  	$br .= '   <div class="progress" style="margin-bottom: 3px !important;" >';
  	$br .= '     <div class="progress-bar '. $cl .' six-sec-ease-in-out" role="progressbar" aria-valuenow="'. $pct .'" aria-valuemin="0" aria-valuemax="100"  data-transitiongoal="'. $pct .'">'. $perc .'%</div>';
  	$br .= '     </div>';
  	$br .= '	<small>'.bd_nice_number($row_Contents_C['Alloc']) .' released from '. bd_nice_number($row_Contents_C['Excheq']) .' approved budget</small>';
  	$br .= '  </div>';
            
    } 
    function bd_nice_number($n) {
      // first strip any formatting;
      $n = (0+str_replace(",","",$n));

      // is this a number?
      if(!is_numeric($n)) return false;

      // now filter it;
      if($n>1000000000000) return round(($n/1000000000000),1).'T';
      else if($n>1000000000) return round(($n/1000000000),1).'b';
      else if($n>1000000) return round(($n/1000000),1).'m';
      else if($n>1000) return round(($n/1000),1).'k';

      return number_format($n);
    }

    echo $br;
?> 
                 
