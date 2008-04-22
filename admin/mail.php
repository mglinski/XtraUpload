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
include("./init.php");

	if($_POST['subject'] && $_POST['message'])
	{
		$sql = "SELECT * FROM `users` WHERE `group` = '".$_POST['group']."'";
		$result = $db->query($sql);
		if ($result)
		{
			while( $row = $db->fetch($result) )
			{
				$kernel->mail->send_email($adminemail, $_POST['subject'], $_POST['message'], $row->email);
			}
		}
		echo "<font size=3 color=green><b>Messages Sent</b></font><br>";
	}
?>

<h1><span>User Manager - Email Center</span>XtraFile :: Admin Panel</h1>
<br />
<style type="text/css">
<!--
.style1 {font-family: Verdana, Arial, Helvetica, sans-serif}
.style3 {font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 12px; }
.style4 {font-size: 24px}
-->
</style>
<form method="POST">
  <table width="66%" border="0" align="center">
    <tr>
      <td></P>
        <h2 align="center">Send an email to all  members of a user group at once. 
          <br />
          <br />
        </h2>
        <table width="100%" border='0' cellpadding="3" cellspacing="0" class="design" style="border-collapse: collapse">
          <tr>
            <td width="15%" bordercolor="#666666" class='style1'><div align="right">Subject</font>:</div></td>
            <td width="85%" bordercolor="#666666" class='a1'><input name="subject" size="78" />            </td>
          </tr>
          <tr>
            <td bordercolor="#666666" class='style1'><div align="right">Group:</div></td>
            <td bordercolor="#666666" class='a1'><select name="group">
                <?
		$qr1 = $db->query("SELECT * FROM groups WHERE id != '1'");
		while($a = $db->fetch($qr1,'obj'))
		{
		?>
                <option value="<?=$a->id?>">
                <?=$a->name?>
                </option>
                <? }?>
              </select>
              &nbsp;</td>
          </tr>
          <tr>
            <td bordercolor="#666666" class='style1'><div align="right">Message:</font></div></td>
            <td bordercolor="#666666" class='a1'><span class="style3">
              <textarea name="message" rows="10" cols="59"></textarea>
              </span></td>
          </tr>
          <tr>
            <td colspan="3" bordercolor="#666666"><div align="center" class="style3">&nbsp;
                <input name="submit" type="submit" alt="submit" width="66" height="20" hspace="5" vspace="5" border="0" />
              </div></td>
          </tr>
        </table></td>
    </tr>
  </table>
</form>
