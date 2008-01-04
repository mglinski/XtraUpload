<?php
/*
XtraUpload - File Hosting Software
Copyright (C) 2006-2007  Matthew Glinski and XtraFile.com
Link: http://www.xtrafile.com
-----------------------------------------------------------------
This program is free software; you can redistribute it and/or
modify it under the terms of the GNU General Public License
as published by the Free Software Foundation; either version 2
of the License, or (at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program(LICENSE.txt); if not, write to the Free Software
Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA  02110-1301, USA.
*/
if(!isset($_POST['group']))
{
?><style type="text/css">
<!--
.style2 {
	font-family: Verdana, Arial, Helvetica, sans-serif;
	font-size: 12px;
}

.style48 {
	font-size: 16px;
	color: #FF0000;
}
.style49 {color: #000000}
.style50 {font-size: 12px}
.style39 {color: #0000FF; font-weight: bold; font-size: 16px; }
.style4 {font-family: Verdana, Arial, Helvetica, sans-serif}
.style42 {font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 12; }
.style63 {font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 12px; font-weight: bold; }
.style59 {	font-size: 12px;
	font-weight: bold;
}
.style67 {
	color: #FF0000;
	font-weight: bold;
}
.style68 {color: #000000; font-size: 24px; }
-->
    </style>
    <table width="604" border="0" align="center" cellpadding="0" cellspacing="0" >	
<tr>
  <td align="center" valign="top"><span class="style67">
      <h3 class="style68"><?=$lang['fastpass']['1']?></h3>
  </span>
    <?=get_accounts();?>
    <p class="style2"><?=$lang['fastpass']['2']?></p>
    <p class="style2"><?=$lang['fastpass']['3']?></p><br />
</td></tr>
</table>   <?
}
else
{
	if($_POST['submit'] != '')
	{
		switch($_POST['step'])
		{
			case "1": include('./include/step1.php');
			break;
			
			case "2": include('./include/step2.php');
			break;
			
			case "3": include('./include/step3.php');
			break;
			
			case "4": include('./include/step4.php');
			break;	
		}	
	}
	else
	{
	
	?>
	<script>
	function check()
	{
		var d = document;
		if(d.getElementById("step_1").checked != true)
		{
			alert("<?=$lang['join']['9']?>");
			return false
		}
	}
	</script>
			<h3 align="center"><font size="2" face="Verdana, Arial, Helvetica, sans-serif"><?=$lang['join']['1']?></font></h3><table align="center">
			<tr>
				<td align=center><div align="center">
				  <p><font size="2" face="Verdana, Arial, Helvetica, sans-serif"><strong><?=$lang['join']['2']?></strong> <?=$_SERVER['REMOTE_ADDR']?></font></p>
				  <p><font size="2" face="Verdana, Arial, Helvetica, sans-serif"><?=$lang['join']['3']?></font></p>
				  <p><strong><font color="#FF0000" size="2" face="Verdana, Arial, Helvetica, sans-serif"><?=$lang['join']['4']?></font></strong></p>
				</div>
				  <p align="center">
					<font size=2 face="Verdana, Arial, Helvetica, sans-serif"><b><?=$lang['join']['5']?></b></font>
				  <p align="center">
				  <form method=post onsubmit="return check();">
					  <div align="center"><font size="2" face="Verdana, Arial, Helvetica, sans-serif"><? include('./include/pages/rules.php'); ?></font></div>
					  <p align="center"><font size="2" face="Verdana, Arial, Helvetica, sans-serif">
<table width="80" border="0" align="center">
  <tr>
    <td><center><center><input type="checkbox" name=step id="step_1" value=1 /><label for="step_1"><?=$lang['join']['6']?></label><br></center></center></td>
</tr>
</table>
	
				<input type="hidden" name="group" value="<?=$_POST['group']?>" />
				<input type=submit name='submit' value='<?=$lang['join']['8']?>'>
				</form>			</td>
			</tr>
			</table>
	<? }
}	
?>