<?php require('./Includefiles/conn.inc'); 
require('./Includefiles/header.php');
?>
<div id="content">
	<div class="control-panel">
		<div class="row">
			<div class="small-12 columns">
			
				<?php require('./Includefiles/leftlinks.php');?>
					<h3>Reset Password</h3>
						
			</div>
		</div>
	</div>
	<div class="details">
		<div class="row">
			<section class="fields">
				<table width="100%" border="0" cellpadding="2" cellspacing="2">
				<form id="form" name="form" method="post" action="session.php"  enctype="multipart/form-data">
				
				<tr>
				 <td align="right" valign="top" class="medium">Your email</td>
				<td valign="top" class="medium"><input type="email" name="email" value=""  /></td>
				</tr>
				  <tr>
					<td width="35%" align="left" valign="top"><input type="hidden" name="formname" value="resetpass"  />
					</td>
					<td width="65%" align="left" valign="top"><input type="submit" name="Submit" value="Submit" id="button" class="button"  /></td>
				  </tr>
				</form>
				</table>
			</section><!-- / .section -->
		</div><!-- / .example-row -->
	</div><!-- / .details -->
</div> <!---content --->
<?php require('./Includefiles/footer.php');?>
