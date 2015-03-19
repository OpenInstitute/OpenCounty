<?php require('Includefiles/conn.inc');
$fld=$_GET['fld'];
if ($fld==""){$fld='Population2009';}
print_r ("name,value\n");
  $result =mysql_query("SELECT County, $fld FROM countyIndicators ORDER BY $fld DESC");
  while ($row_Contents_2 = mysql_fetch_array($result)) {
	  	print_r($row_Contents_2['County'] . "," . $row_Contents_2[$fld] . "\n");
  }
?>
