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
?>
<p><font size="2" face="Verdana, Arial, Helvetica, sans-serif">
  Our Customer Support team is only available to FastPass members and is available from 24/7 every day through emails below.<br />
 You may also use it for sales purposes. </font></p>
<p><font size="2" face="Verdana, Arial, Helvetica, sans-serif">---------------------------------------------------<br />
  Expect a reponse within 3 hours </font></p>
<table width="100%" border="0" align="center">
<tr>
	<td >
		<table width="100%" border="0" align="center" cellpadding="3" cellspacing="3" s>
		<tr>
			<td width=20></td>
			<td width="519" valign="top">
			<table width="100%" border="0" cellspacing="0" cellpadding="3" >
			<tr>
				<td>
<?
	if(( $_POST['sent']=="true")&&($_POST['name']!="")&&($_POST['email']!="")&&($_POST['message']!="")){
		$MSG="Name: ".$_POST['name']."\n\rEmail".$_POST['email']."\n\rSubject: ".$_POST['subject']."\n\r\n\rMessage:\n\r".$_POST['message'];
		mail($adminemail, $sitename." Support:".$_POST['subject'], $MSG, "MIME-Version: 1.0\r\nContent-type: text/plain;charset=iso-8859-1\r\nFrom: ".$_POST['email']."\n");

	
?>
						<table width="100%" border="0" cellspacing="10" cellpadding="0">
						<tr>
							<td><div align="center"><font size="1" face="Verdana, Arial, Helvetica, sans-serif"><strong>
								Your Email was sent to our support team, we will contact you back within 12 hours.<br>
								
							</strong></font></div></td>
						</tr>
						<tr>
							<td width="60%"><div align="center">

<?
	}else{
	if (($_POST['sent']=="true")&&($_POST['name']=="")) $errors="Enter Your Name";
	if (($_POST['sent']=="true")&&($_POST['email']=="")) $errors="$errors<br>Enter Your Email";
	if (($_POST['sent']=="true")&&($_POST['message']=="")) $errors="$errors<br>Enter Your Message<br>";
	print ("$errors<br>");
?>
	<script language=JavaScript>
	<!--
	function submitCheck(forma) {
  
	  if (forma.name.value=="") { alert("Enter Your Name");return false; }
	  if (forma.email.value=="") { alert("Enter Your Email");return false; }
	  if (forma.message.value=="") { alert("Enter Your Message");return false; }
	  document.forma.submit();}
//-->
</SCRIPT>
			
						<FORM method=post name="forma"  id="forma" onsubmit="return submitCheck(this);">
						<input type=hidden name=sent value=true>
						<BR>
						<CENTER>
						<TABLE class=design cellspacing=0 width=100% align=left>
						<tr>
							<td width="20%" align="center"><font size="2" face="Verdana, Arial, Helvetica, sans-serif">Your Name</font></td>
							<td width="80%"><input name="name" type="text" size="40" id="name" value="<? print $_POST['name'] ?>"></td>
						</tr>
						<tr>
							<td align="center"><font size="2" face="Verdana, Arial, Helvetica, sans-serif">Your Email</font></td>
							<td><input name="email" type="text" size="40" maxlength="40" value="<? print $_POST['email'] ?>"></td>
						</tr>
						<tr>
							<td align="center"><font size="2" face="Verdana, Arial, Helvetica, sans-serif">Subject</font></td>
							<td><input name="subject" type="text" size="40" maxlength="40"></td>
						</tr>
						<tr>
							<td align="center"><font size="2" face="Verdana, Arial, Helvetica, sans-serif">Message</font></td>
							<td><textarea name="message" rows=8 cols=39><? print $_POST['message'] ?></textarea></td>
						</tr>
				

					<tr>
							<td align="center"></td>
							<td></td>
						</tr>
						<tr>
							<th colspan=2><input type="submit" value="Send Email"></td>
						</tr>
						</table>
						</form>
<?
	}
?>
					</td>
				</tr>
				</table>
			</td>
		</tr>
		</table>
</table>