<?php require('Includefiles/conn.inc');
$cons=$_POST['cons'];
$cid=$_POST['cid'];

$dat = '<table class="table table-condensed table-hover">
	<thead>
	  <th>MCA Name</th>
	  <th>Ward</th>
	  <th>Political Party</th>
	</thead>';
	if($cons!='Nominated'){
		$query_Contents_4 = mysql_query("SELECT * FROM mcas WHERE Constituency = '$cons' AND countyid = $cid");
	} else {
		$query_Contents_4 = mysql_query("SELECT * FROM mcas WHERE Constituency IS NULL AND countyid = $cid");
	}
		while($row_Contents_4 = mysql_fetch_array($query_Contents_4)){

	$dat .= '<tr>
			  <td>'. $row_Contents_4['MCAName'] .'</td>
			  <td>'. $row_Contents_4['Ward'] .'</td>
			  <td>'. $row_Contents_4['Party'] .'</td>
			</tr>';
		 } 
$dat .= '</table>';

echo $dat;
