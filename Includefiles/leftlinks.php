
  <ul class="inline-list pills">
    <!------------------ Start List ---------->
<?php
$userid=(int)$_SESSION['userid'];
$sqAdcat="SELECT * FROM _adminuser WHERE userid = $userid ;";
$rs=mysql_query($sqAdcat,$conn);
$row_Contents = mysql_fetch_assoc($rs);
$AdminCatID=$row_Contents['AdminCatID'];


$sqAdcat1="SELECT _adminpage.AdminPageID, _adminpage.AdminPageTitle, _adminpage.AdminPageURL
		FROM _admincatpage
		INNER JOIN _adminpage ON _admincatpage.AdminPageID = _adminpage.AdminPageID
		WHERE _adminpage.Viewed =1
		AND _admincatpage.AdminCatID = $AdminCatID ORDER BY _adminpage.AdminPageTitle;";
//echo $sqAdcat1; exit;
$rs2=mysql_query($sqAdcat1,$conn);

while($rsprod0=mysql_fetch_array($rs2))
{
?>
<li <?php if ($rsprod0["AdminPageID"]==$_GET['submenuid']){ echo 'class="active"';}?>>
<a href="<?php echo $rsprod0["AdminPageURL"];?>?submenuid=<?php echo $rsprod0["AdminPageID"];?>"><?php echo $rsprod0["AdminPageTitle"];?></a>
</li>

<?php	} //end while statement		?>
		<!------- end list-------->
 </ul>
 &nbsp;
</div>
