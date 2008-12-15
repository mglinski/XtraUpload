<style type="text/css">
<!--
.style2 {font-size: 16px}
-->
</style>

<div class='centerbox'>
	<div class='tableborder'>
		<div class='maintitle'>Welcome to XtraUpload Upgrader</div>
		<div class='pformstrip'>Please check file permissions below before continuing.</div>
		<table width='100%' cellspacing='1' id='perms'>
		<tr>
			<td class='pformleftw' colspan="2">
				We are going to attempt to upgrade your database to the latest version now, but first we need to copy your database config files so we can correctly access the database. Please make sure these permissions are correct before continuing or you will receive error messages.
			</td>
		</tr>
		<tr>
			<td class='pformleftw'><span style="font-size:20px; font-weight:bold">Permission Checks</span></td>
			<td class='pformright'>&nbsp;</td>
		</tr>
		<?php
		$chmod = array();
		$chmod['includes/config/database.php'] = "0666";
		$is_chmod = true;
		foreach($chmod as $file => $perm)
		{
			if(!is_writeable($file))
			{
				$is_chmod = false;
				$pass_fail = '<font color="#FF0000" size="4"><b>Failed</b></font>';
			}
			else
			{
				$pass_fail = '<font color="#009900" size="4"><b>Passed</b></font>';
			}
		?>
		  <tr>
			<td class='pformleftw'>
				<strong>
					File: <?='upgrade/'.$file?><br>
					Permissions Required: <?=$perm?><br>
				</strong>
			</td>
			<td class='pformright'><?=$pass_fail?></td>
		  </tr>
		<?php 
		}?>
		</table>
		<div align='center' class='pformstrip'  style='text-align:center; vertical-align:middle'>
				<?php if(!$is_chmod){ ?>
				<font color="#0000FF">
					<b>
						There were errors during testing. <br>
						Please fix these errors before continuing.<br>
					</b>
				</font>
				<?php }else{ ?>
				<div style="float:right">
					<span class="cssbutton">
						<a class="buttonGreen" href="index.php?c=home&m=step_1">
							<img src="../img/icons/ok_16.png" border="0" alt="" /> Continue
						</a>
					</span>
				</div>
				<br /><br />
				<?php }?>
			</div>
	</div>
	<div class='fade'>&nbsp;</div>
	<br />
</div>