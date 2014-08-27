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
                      $cl =  "progress-bar-success";
                      if (($cid == 0) && ($did == 0)){
                        $query_Contents_C = mysql_query("SELECT id, GrossEst_1 as Excheq, concat('<a href=?cid=0&did=',id,'>',indicators,'</a>') AS Name, (ExchIssues_1*1000000) as Exp, (NetEst_1*1000000) as Alloc,(ExchIssues_1/NetEst_1)*100 as Pct FROM nationalexpenditure WHERE   used =1 ");
                      } 
                      elseif (($cid == 0) && ($did != 0)) {
                        $query_Contents_C =mysql_query("SELECT id, GrossEst_1  as Excheq, indicators AS Name, (ExchIssues_1*1000000) as Exp, (NetEst_1*1000000) as Alloc,(ExchIssues_1/NetEst_1)*100 as Pct FROM nationalexpenditure WHERE id = $did AND  used =1 ");
                      }
                      elseif (($cid != 0) && ($did == 0)) {
                        $query_Contents_C = mysql_query("SELECT id, BudgetApprovedAnnual  as Excheq, AllocationQ1 as Alloc, ExpendedQ1 as Exp, concat('<a href=?cid=$cid&did=',id,'>',Name,'</a>') as Name, (ExpendedQ1/AllocationQ1)*100 as Pct  FROM Department WHERE countyid = $cid ORDER BY AllocationQ1 ASC");
                      }
                      elseif (($cid != 0) && ($did != 0)) {
                        $query_Contents_C = mysql_query("SELECT id, AmountReleased as Excheq, AmountReleased as Alloc,AmountExpenses as Exp, Projects as Name, (AmountExpenses/AmountReleased)*100 as Pct FROM projects WHERE departmentid = $did ORDER BY AmountReleased ASC");
                      }
                      //"SELECT id, AllocationQ1 AS Alloc, ExpendedQ1 AS Exp, CONCAT(  '<a href=?cid=3&did=', id,  '>', Name,  '</a>' ) AS Name, (ExpendedQ1 / AllocationQ1) *100 AS Pct FROM Department WHERE countyid =3 ORDER BY AllocationQ1 ASC LIMIT 0 , 30";
                      while ($row_Contents_C=mysql_fetch_array($query_Contents_C)) {
                        $pct = 0;

                        if ($row_Contents_C['Alloc'] > $row_Contents_C['Exp']) { 
                          $cl =  "progress-bar-info";  //echo  $row_Contents_C['Alloc'] .'>>'. $row_Contents_C['Exp'];
                        } 
                        if ($row_Contents_C['Alloc'] < $row_Contents_C['Exp']) { 
                          $cl =  "progress-bar-danger"; //echo  $row_Contents_C['Alloc'] .'<<'. $row_Contents_C['Exp'];
                        }
                        if ($row_Contents_C['Alloc'] == $row_Contents_C['Exp']) { 
                          $cl =  "progress-bar-success"; //echo  $row_Contents_C['Alloc'] .'>>'. $row_Contents_C['Exp'];
                        }
                        $perc = ($row_Contents_C['Pct'] == "Null") ? 0 : (int)$row_Contents_C['Pct'] ;
                        $pct = ($row_Contents_C['Pct'] == "Null") ? 0 : ($row_Contents_C['Pct'] >= "100") ? 100 : (int)$row_Contents_C['Pct'];
                   		
						$br .= '<div class="col-md-6 panel">';
						$br .= '   <h5>'. $row_Contents_C['Name'] .'</h5>';
						$br .= '  <h1 class="title">'. bd_nice_number($row_Contents_C['Alloc']) .'</h1> Released from <span class="req-amt">'. bd_nice_number($row_Contents_C['Excheq']) .'</span> approved budget';
						$br .= '   <div class="progress" style="margin-bottom: 3px !important;" >';
						$br .= '     <div class="progress-bar '. $cl .' six-sec-ease-in-out" role="progressbar" aria-valuenow="'. $pct .'" aria-valuemin="0" aria-valuemax="100"  data-transitiongoal="'. $pct .'">'. $perc .'%</div>';
						$br .= '     </div>';
						$br .= '	<small>'.$perc.'% ('. bd_nice_number($row_Contents_C['Exp']) .') spent from total '. bd_nice_number($row_Contents_C['Alloc']) .' released</small>';
						$br .= '  </div>';
                    
                     } 
                      function bd_nice_number($n) {
                        // first strip any formatting;
                        $n = (0+str_replace(",","",$n));

                        // is this a number?
                        if(!is_numeric($n)) return false;

                        // now filter it;
                        if($n>1000000000000) return round(($n/1000000000000),1).' T';
                        else if($n>1000000000) return round(($n/1000000000),1).' b';
                        else if($n>1000000) return round(($n/1000000),1).' m';
                        else if($n>1000) return round(($n/1000),1).' k';

                        return number_format($n);
                      }
                      
                      echo $br;
                    ?> 
                 
