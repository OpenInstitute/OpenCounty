<?php

function DropMenu($inputVal) {

$query_Contents =mysql_query("SELECT * FROM menu  WHERE viewed=1 ORDER BY menuname ;");

$totalRows_Contents = mysql_num_rows($query_Contents);
	if ($totalRows_Contents>=1){ 
			while ($row_Contents=mysql_fetch_array($query_Contents)) {
				if ($inputVal==$row_Contents['menuid']){
				printf ("<option value=". $row_Contents['menuid'] ." selected>". $row_Contents['menuname'] ."</option>");
				} else {
				printf ("<option value=". $row_Contents['menuid'] .">". $row_Contents['menuname'] ."</option>");
				}
			} 

	}	
}

function DropCountry($inputVal) {

$query_Contents =mysql_query("SELECT * FROM country  ORDER BY countryname ;");

$totalRows_Contents = mysql_num_rows($query_Contents);
	if ($totalRows_Contents>=1){ 
			while ($row_Contents=mysql_fetch_array($query_Contents)) {
				if ($inputVal==$row_Contents['countryid']){
				printf ("<option value=". $row_Contents['countryid'] ." selected>". $row_Contents['countryname'] ."</option>");
				} else {
				printf ("<option value=". $row_Contents['countryid'] .">". $row_Contents['countryname'] ."</option>");
				}
			} 

	}	
}

function DropCounty($inputVal) {

$query_Contents =mysql_query("SELECT id, countyname FROM county  WHERE viewed=1 ORDER BY countyname ;");

$totalRows_Contents = mysql_num_rows($query_Contents);
	if ($totalRows_Contents>=1){ 
			while ($row_Contents=mysql_fetch_array($query_Contents)) {
				if ($inputVal==$row_Contents['id']){
				printf ("<option value=". $row_Contents['id'] ." selected>". $row_Contents['countyname'] ."</option>");
				} else {
				printf ("<option value=". $row_Contents['id'] .">". $row_Contents['countyname'] ."</option>");
				}
			} 

	}	
}

function DropDepartment($inputVal){
$query_Contents =mysql_query("SELECT id, Name FROM Department  WHERE viewed=1 AND countyid = $inputVal ORDER BY Name ;");

$totalRows_Contents = mysql_num_rows($query_Contents);
	if ($totalRows_Contents>=1){
			while ($row_Contents=mysql_fetch_array($query_Contents)) {
				
				printf ("<option value=". $row_Contents['id'] ." selected>". $row_Contents['Name'] ."</option>");
				
			} 
	}	
}


function DropTitle($inputVal) {

$query_Contents =mysql_query("SELECT * FROM title  ORDER BY titlename ;");

$totalRows_Contents = mysql_num_rows($query_Contents);
	if ($totalRows_Contents>=1){ 
			while ($row_Contents=mysql_fetch_array($query_Contents)) {
				if ($inputVal==$row_Contents['titleid']){
				printf ("<option value=". $row_Contents['titleid'] ." selected>". $row_Contents['titlename'] ."</option>");
				} else {
				printf ("<option value=". $row_Contents['titleid'] .">". $row_Contents['titlename'] ."</option>");
				}
			} 
	}	
}

function DropOrgType($inputVal) {

$query_Contents =mysql_query("SELECT * FROM orgtype  ORDER BY orgtypeid ;");

$totalRows_Contents = mysql_num_rows($query_Contents);
	if ($totalRows_Contents>=1){ 
			while ($row_Contents=mysql_fetch_array($query_Contents)) {
				if ($inputVal==$row_Contents['orgtypeid']){
				printf ("<option value=". $row_Contents['orgtypeid'] ." selected>". $row_Contents['orgtype'] ."</option>");
				} else {
				printf ("<option value=". $row_Contents['orgtypeid'] .">". $row_Contents['orgtype'] ."</option>");
				}
			} 
	}	
}

function DropPlannerTime($inputVal) {
$userid=$_SESSION['userid'];
$query_Contents=mysql_query("SELECT DISTINCT organizationid,priorityid FROM  planner where userid=$userid AND organizationid=$inputVal");
$totalRows_Contents = mysql_num_rows($query_Contents);
	if($totalRows_Contents>=1){
		$row_Contents=mysql_fetch_assoc($query_Contents);
		$pid=(int)$row_Contents['priorityid'];
	} else {
		$pid=0;
	}
		$query_Contents1=mysql_query("SELECT priorityid, priorityname FROM prioritytype WHERE viewed=1 ORDER BY priorityid DESC");
		$totalRows_Contents1 = mysql_num_rows($query_Contents1);
			if ($totalRows_Contents1>=1){ 
				while($row_Contents1=mysql_fetch_array($query_Contents1)) {
					if ($pid==$row_Contents1['priorityid']){
					printf ("<option value=". $row_Contents1['priorityid'] ." selected>". $row_Contents1['priorityname'] ."</option>");
					} else {
					printf ("<option value=". $row_Contents1['priorityid'] .">". $row_Contents1['priorityname'] ."</option>");
					}
				} 
			}
}



function CheckPlanner($inputVal) {
$compid=$_SESSION['companyid'];
$query_Contents =mysql_query("SELECT  organizationid FROM  planner where companyid  like '%,$compid,%' AND organizationid=$inputVal");
$totalRows_Contents = mysql_num_rows($query_Contents);

	if ($totalRows_Contents>=1){ return "1";} else {return "0";}	
}

function CheckIfFull($orgid){
	$compid=$_SESSION['companyid'];
	$orgtypeid=$_SESSION['orgtypeid'];

			if ($orgtypeid==4){
			$query_Contents =mysql_query("SELECT * FROM planner WHERE organizationid = $orgid AND groupmeet=1");
			}
			if ($orgtypeid==3){
			$query_Contents =mysql_query("SELECT * FROM planner WHERE organizationid = $orgid AND SUBSTRING_INDEX(companyid, ',',2)  rlike '^0,$' AND orgtypeid =0 AND groupmeet=0 OR organizationid = $orgid AND SUBSTRING_INDEX(companyid, ',',3)  rlike '^0,[0-9]*,$' AND orgtypeid =3 AND groupmeet=0 OR organizationid = $orgid AND SUBSTRING_INDEX(companyid, ',',4)  rlike '^0,[0-9]*,[0-9]*,$' AND orgtypeid =3 AND groupmeet=0");
			}
			if ($orgtypeid==2){
			$query_Contents =mysql_query("SELECT * FROM planner WHERE organizationid = $orgid AND SUBSTRING_INDEX(companyid, ',',2)  rlike '^0,$' AND orgtypeid =0 AND groupmeet=0 OR organizationid = $orgid AND SUBSTRING_INDEX(companyid, ',',3)  rlike '^0,[0-9]*,$' AND orgtypeid =2 AND groupmeet=0");
			}
			if ($orgtypeid==1){
			$query_Contents =mysql_query("SELECT * FROM planner WHERE organizationid = $orgid AND companyid like '0,'");
			}

	$totalRows_Contents = mysql_num_rows($query_Contents);
	if ($totalRows_Contents>=1){ return "1";} else {return "0";}
}

function CheckIfConfirmed($inputVal) {
$query_Contents =mysql_query("SELECT  organizationid FROM  organization WHERE status=2 AND organizationid=$inputVal");
$totalRows_Contents = mysql_num_rows($query_Contents);
	if ($totalRows_Contents>=1){ return "1";} else {return "0";}	
}

function CheckClientCompany($inputVal0,$inputVal1,$inputVal2) {
$compid=$_SESSION['companyid'];
$query_Contents =mysql_query("SELECT companyid, groupmeet FROM  planner  WHERE  eventcalendarid=$inputVal2 AND settime = '$inputVal1' AND organizationid=$inputVal0");
	if (mysql_num_rows($query_Contents)>0){
	$row_Contents=mysql_fetch_assoc($query_Contents);
	if ($row_Contents['groupmeet']==1){print ("[G]");}
		$id=substr($row_Contents['companyid'] , 0, -1);
			$query_Contents1 =mysql_query("SELECT  companyid, companyname ,orgtypeid FROM  usercompanies 	WHERE  companyid IN ($id)");
			$totalRows_Contents1 = mysql_num_rows($query_Contents1);
			$col=explode(",",',#666666,#FF6600,#996600');
			$colname=explode(",",',Platinum,Gold,Silver');
			
			if ($totalRows_Contents1>=1){ 
				while($row_Contents1=mysql_fetch_array($query_Contents1)){
				$colornumber=$row_Contents1['orgtypeid'];
					//echo $row_Contents['companyid'];
					printf ("[<a style='color:". $col[$colornumber] ."' title='". $colname[$colornumber] ."' target=_blank href='matrixschedule_client.php?companyid=".$row_Contents1['companyid'] ."' >".$row_Contents1['companyname'] ."</a>]<br/>");
				} 
			}else {
					printf (" --- ");
			}
	}
	else	
	{
		printf (" --- ");
	}
}

function DropEvents($inputVal) {
$query_Contents =mysql_query("SELECT eventid,heading FROM events WHERE viewed=1");
$totalRows_Contents = mysql_num_rows($query_Contents);
	if ($totalRows_Contents>=1){ 
		while ($row_Contents=mysql_fetch_array($query_Contents)) {
		if ($inputVal==$row_Contents['eventcalendarid']){
				printf ("<option value=". $row_Contents['eventid'] ." selected>". $row_Contents['heading'] ."</option>");
				} else {
				printf ("<option value=". $row_Contents['eventid'] .">". $row_Contents['heading'] ."</option>");
				}
		}
	}	
}

function DropCalendar($inputVal) {
$query_Contents =mysql_query("SELECT eventcalendarid, eventid, DATE_FORMAT(eventdate, '%b %e, %Y' ) as eventdate FROM eventscalendar WHERE viewed=1 AND meetingday=1 AND eventid = $inputVal");
$totalRows_Contents = mysql_num_rows($query_Contents);
	if ($totalRows_Contents>=1){ 
			while ($row_Contents=mysql_fetch_array($query_Contents)) {
			/*	if ($inputVal==$row_Contents['eventcalendarid']){
				printf ("<option value=". $row_Contents['eventcalendarid'] ." selected>". $row_Contents['eventdate'] ."</option>");
				} else { */
				//printf ("<option value=". $row_Contents['eventcalendarid'] .">". $row_Contents['eventdate'] ."</option>");
				printf ("<a href='?view=planner&eventcalendarid=". $row_Contents['eventcalendarid'] ."'>". $row_Contents['eventdate'] ."</a>&nbsp;&nbsp;&nbsp;&nbsp;");
				//}
			} 

	}	
}

function DropEmailCat() {
$query_Contents =mysql_query("SELECT EmailerID,	EmailerTitle, EmailMessage, Viewed FROM emailer WHERE Viewed=1");
$totalRows_Contents = mysql_num_rows($query_Contents);
	if ($totalRows_Contents>=1){ 
		while ($row_Contents=mysql_fetch_array($query_Contents)) {
			printf ("<option value=". $row_Contents['EmailerID'] .">". $row_Contents['EmailerTitle'] ."</option>");
		}
	}	
}

function CompanyName($id) {
	$query_Contents =mysql_query("SELECT companyname FROM usercompanies WHERE companyid=$id");

	$row_Contents=mysql_fetch_assoc($query_Contents);
	printf ($row_Contents['companyname']. ", ");
}


function OrgName($id) {
	if($id>0){
	$query_Contents =mysql_query("SELECT orgname FROM organization WHERE organizationid=$id");
	$row_Contents=mysql_fetch_assoc($query_Contents);
	printf ($row_Contents['orgname']);
	} else {printf ('---');}
}

function RoomAll($id) {
	if($id>0){
	$query_Contents =mysql_query("SELECT roomallocated FROM organization WHERE organizationid=$id");
	$row_Contents=mysql_fetch_assoc($query_Contents);
	printf ($row_Contents['roomallocated']);
	} else {printf ('---');}
}

function ActivityName($id) {
	$query_Contents =mysql_query("SELECT ActivityName FROM activities WHERE ActivityID=$id");

	$row_Contents=mysql_fetch_assoc($query_Contents);
	printf ($row_Contents['ActivityName']);
}


function DropCategory($inputVal) {
$query_Contents =mysql_query("SELECT AdminCatID,CatName,Viewed FROM _admincat WHERE Viewed=1");
$totalRows_Contents = mysql_num_rows($query_Contents);
	if ($totalRows_Contents>=1){ 
		while ($row_Contents=mysql_fetch_array($query_Contents)) {
				if ($inputVal==$row_Contents['AdminCatID']){
				printf ("<option value=". $row_Contents['AdminCatID'] ." selected>". $row_Contents['CatName'] ."</option>");
				} else {
				printf ("<option value=". $row_Contents['AdminCatID'] .">". $row_Contents['CatName'] ."</option>");
				}
			} 
	}	
}

function DropOrgCountry($inputVal) {
$query_Contents =mysql_query("SELECT orgcountryid,countryname,viewed FROM orgcountry WHERE viewed=1 ORDER BY countryname");
$totalRows_Contents = mysql_num_rows($query_Contents);
	if ($totalRows_Contents>=1){ 
		while ($row_Contents=mysql_fetch_array($query_Contents)) {
				if ($inputVal==$row_Contents['orgcountryid']){
				printf ("<option value=". $row_Contents['orgcountryid'] ." selected>". $row_Contents['countryname'] ."</option>");
				} else {
				printf ("<option value=". $row_Contents['orgcountryid'] .">". $row_Contents['countryname'] ."</option>");
				}
			} 
	}	
}

function DropOrgIndustry($inputVal) {
$query_Contents =mysql_query("SELECT orgindustryid, industryname,viewed FROM orgindustry WHERE viewed=1 ORDER BY industryname");
$totalRows_Contents = mysql_num_rows($query_Contents);
	if ($totalRows_Contents>=1){ 
		while ($row_Contents=mysql_fetch_array($query_Contents)) {
				if ($inputVal==$row_Contents['orgindustryid']){
				printf ("<option value=". $row_Contents['orgindustryid'] ." selected>". $row_Contents['industryname'] ."</option>");
				} else {
				printf ("<option value=". $row_Contents['orgindustryid'] .">". $row_Contents['industryname'] ."</option>");
				}
			} 
	}	
}


function AvaliableOrg($eventcalendarid,$timer,$compid) {
//echo $eventcalendarid.$timer.$compid;
$query_Contents =mysql_query("SELECT organization.orgname, organization.organizationid, planner.settime, planner.eventcalendarid,planner.companyid
FROM planner
INNER JOIN organization ON planner.organizationid = organization.organizationid
WHERE (
planner.companyid =0
AND planner.settime =  '$timer'
AND planner.eventcalendarid = $eventcalendarid
AND organization.status=2  AND organization.viewed=1
) OR (
planner.companyid = $compid
AND planner.settime =  '$timer'
AND planner.eventcalendarid =$eventcalendarid
AND organization.status=2 AND organization.viewed=1
) 
ORDER BY organization.orgname;");

$totalRows_Contents = mysql_num_rows($query_Contents);
	if ($totalRows_Contents>=1){ 
			printf ("<option value=0>Not Selected</option>");
			while ($row_Contents=mysql_fetch_array($query_Contents)) {
				if ($row_Contents['companyid']!=0){
				printf ("<option value=". $row_Contents['organizationid'] ." selected>". $row_Contents['orgname'] ."</option>");
				} else {
				printf ("<option value=". $row_Contents['organizationid'] .">". $row_Contents['orgname'] ."</option>");
				}
			} 

	}	
}


function SDate($dtDateTime)
{
  extract($GLOBALS);

  if ($isDate[$dtDateTime])
  {

    $function_ret=str_replace(".","/",$dtDateTime);
  } 

  return $function_ret;
} 

function ActiveLink($ActiveMode,$urllink,$Lname)
{
 // extract($GLOBALS);

  if ($ActiveMode)
  {

    $ALink="<a style='color:#FF9900;TEXT-DECORATION: none' href=".$urllink.">".$Lname."</a>";
  }
    else
  {

    $ALink=$Lname;
  } 

  echo $ALink;
  //return $function_ret;
} 


if(!get_magic_quotes_gpc()){

  $_GET = array_map('mysql_real_escape_string', $_GET); 
  $_POST = array_map('mysql_real_escape_string', $_POST); 
  $_COOKIE = array_map('mysql_real_escape_string', $_COOKIE);

} else {  

   $_GET = array_map('stripslashes', $_GET); 
   $_POST = array_map('stripslashes', $_POST); 
   $_COOKIE = array_map('stripslashes', $_COOKIE);
   $_GET = array_map('mysql_real_escape_string', $_GET); 
   $_POST = array_map('mysql_real_escape_string', $_POST); 
   $_COOKIE = array_map('mysql_real_escape_string', $_COOKIE);
}

function CallCountry($inputVal) {
$query_Contents =mysql_query("SELECT orgcountryid, countryname,viewed FROM orgcountry WHERE orgcountryid=$inputVal");
$row_Contents=mysql_fetch_assoc($query_Contents);
	print($row_Contents['countryname']); 
}

function CallIndustry($inputVal) {
$query_Contents =mysql_query("SELECT orgindustryid, industryname,viewed FROM orgindustry WHERE orgindustryid=$inputVal");
$row_Contents=mysql_fetch_assoc($query_Contents);
	print($row_Contents['industryname']); 
}

function scale_image($p,$mw='',$mh='') { // path max_width max_height
    if(list($w,$h) = @getimagesize($p)) {
    foreach(array('w','h') as $v) { $m = "m{$v}";
        if(${$v} > ${$m} && ${$m}) { $o = ($v == 'w') ? 'h' : 'w';
        $r = ${$m} / ${$v}; ${$v} = ${$m}; ${$o} = ceil(${$o} * $r); } }
    return("<img src='{$p}' alt='image' width='{$w}' height='{$h}' align='left'  hspace='5' vspace='5'/>"); }
}


function scale_image_gallery($p,$mw='',$mh='',$t='') { // path max_width max_height
    if(list($w,$h) = @getimagesize($p)) {
    foreach(array('w','h') as $v) { $m = "m{$v}";
        if(${$v} > ${$m} && ${$m}) { $o = ($v == 'w') ? 'h' : 'w';
        $r = ${$m} / ${$v}; ${$v} = ${$m}; ${$o} = ceil(${$o} * $r); } }
    return("<img src='{$p}'  class='thumbnail' alt='image' width='{$w}' height='{$h}' title={$t} alt={$t} />"); }
}

function scale_image_gallery_full($p,$mw='',$mh='') { // path max_width max_height
    if(list($w,$h) = @getimagesize($p)) {
    foreach(array('w','h') as $v) { $m = "m{$v}";
        if(${$v} > ${$m} && ${$m}) { $o = ($v == 'w') ? 'h' : 'w';
        $r = ${$m} / ${$v}; ${$v} = ${$m}; ${$o} = ceil(${$o} * $r); } }
    return("<img src='{$p}'  class='full' alt='image' width='{$w}' height='{$h}'/>"); }
}


/**
* word-sensitive substring function with html tags awareness
* @param text The text to cut
* @param len The maximum length of the cut string
* @returns string
**/

function cutText($string, $length, $replacer = '...')
{
  if(strlen($string) > $length)
  return (preg_match('/^(.*)\W.*$/', substr($string, 0, $length+1), $matches) ? $matches[1] : substr($string, 0, $length)) . $replacer;
 
  return $string;
}  

 function html_substr($string, $start, $length=false) {
    $pattern = '/(\[\w+[^\]]*?\]|\[\/\w+\]|<\w+[^>]*?>|<\/\w+>)/i';
    $clean = preg_replace($pattern, chr(1), $string);
    if(!$length)
        $str = substr($clean, $start);
    else {
        $str = substr($clean, $start, $length);
        $str = substr($clean, $start, $length + substr_count($str, chr(1)));
    }
    $pattern = str_replace(chr(1),'(.*?)',preg_quote($str));
    if(preg_match('/'.$pattern.'/is', $string, $matched))
        return $matched[0];
    return $string;
}



$userid=(int)$_SESSION['userid'];
$eventid = 1;

?>

