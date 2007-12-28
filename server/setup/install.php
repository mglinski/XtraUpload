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
$versionSql = "INSERT INTO `config` VALUES (25, 'version', '1.6.0,0.0.1.0', '', '', '', '', 0);";
if(!isset($_GET['step']))
{
	
xuSetupHeader();
?>
<style type="text/css">
<!--
.style2 {font-size: 16px}
-->
</style>

<div class='centerbox'>
<div class='tableborder'>
	<div class='maintitle'>Welcome to XtraUpload Installer</div>
	<div class='pformstrip'>Details About The System Requirements Are Below </div>
	
	
				 <table width='100%' border='0' cellpadding='0' cellspacing='0' align='center'>
							<tr>
							 <td width="12%" valign="middle"><center><img style="vertical-align:middle;" src="images/angle/install.png" width="128" height="128"></center></td>
							 <td width="88%"><br />
							   <br />
							   Thank you for Downloading XtraUpload. <br />
							   We hope you find the installation of this script a breeze as it is all automated making it simple to use for someone with very limited knowledge of php, Installing etc. <br />
							   <br />
							   <b>XtraUpload works best on PHP 4.4.0 or better, MySQL 4.0 or better, and an unused database.</b>
							   <br />
							   Please gather this information ready:
							   <ul>
							   <li>SQL database name (Create on via cpanel or some other software you have) </li>
							   <li>Your SQL username</li>
							   <li>Your SQL password</li>
							   <li>Your SQL host address (Usually localhost but if all else fails try the ip address)</li>
							   </ul>
							   <br />
							   Click continue to carry on with this installation. You will be given a progress bar to show you how much is left to install.
							   <br>
							   <br>
							   <b>Do not click back once you have clicked Continue. This may cause database errors! </b>
						      <br />
						      <br /><div align='center'><a href='index.php?step=1'><img src='images/continue.png' alt='proceed' width="120" height="30" border='0'></a></div> </td>
				   </tr>
    </table>   </div>
	<div class='fade'>&nbsp;</div>
	<br />
	</div>
	</div>
<? 
	xuSetupFooter();

}

if($_GET['step'] == '1')
{

xuSetupHeader();
?>
<div class='centerbox'>
<div class='tableborder'>
	<div class='maintitle'>Welcome to XtraUpload Installer</div>
	<div class='pformstrip'>XtraUpload License Aggreement Below </div>
	
	
				 <table width='100%' border='0' cellpadding='0' cellspacing='0' align='center'>
							<tr>
							 <td width="12%" valign="middle"><center><img style="vertical-align:middle;" src="images/angle/install.png" width="128" height="128"></center></td>
							 <td width="88%">						       <span class="style2">You must aggree to the XtraUpload EULA before installing XtraUpload.<br />
						     By Installing XtraUpload, regardless if you read the EULA, you are bound by it.</span><br />
						     An online copy of this license can be found at <a href="http://xtrafile.com/license.php">http://xtrafile.com/license.php</a><br />
						       <br />
						       <textarea name="textarea" readonly="readonly" cols="70" rows="15" wrap="off" id="textarea">XtraUpload :: File Hosting System

License Agreement (v1.1)

------------------------------------
END USER LICENSE AGREEMENT FOR
XTRAUPLOAD FILE HOSTING SYSTEM SOFTWARE PRODUCT

XtraFile
For One (1) Computer

Notice to User:

This End User License Agreement (EULA) is a CONTRACT between you (either an individual or a single
entity) and XtraFile, which covers your use of the XtraFile software product that accompanies this
EULA and related software components, which may include associated media, printed materials, and
"online" or electronic documentation. All such software and materials are referred to herein as the
"Software Product." A software license, issued to a designated user only by XtraFile or its
authorized agents, is required for each user of the Software Product. If you do not agree to the
terms of this EULA, then do not install or use the Software Product or the Software Product License.
By explicitly accepting this EULA, however, or by installing, copying, downloading, accessing, or
otherwise using the Software Product and/or Software Product License, you are acknowledging and
agreeing to be bound by the following terms:


1. GRANT OF NON-EXCLUSIVE LICENSE.

(a) Software Product License. The Software Product License, which is issued to a designated user,
enables such designated user to use the Software Product on a single computer system. Each user on a
multi-user computer system who uses the Software Product requires an additional Software Product
License. You may not modify or create derivative copies of the Software Product License.

(b) Grant of License. Subject to a validly issued Software Product License, XtraFile grants to you
the non-exclusive, non-transferable right for you to use the Software Product on a single computer
running a validly licensed copy of the operating system for which the Software Product was designed.
You may not modify or create derivative copies of the Software Product. All rights not expressly
granted to you are retained by XtraFile.

(c) Backup Copy: Software Product. You may make copies of Software Product as reasonably necessary
for the use authorized above, including as needed for backup and/or archival purposes. No other
copies may be made. Each copy must reproduce all copyright and other proprietary rights notices on
or in the Software Product.

(d) Backup Copy: Software Product License. You may install each Software Product License on a
single computer system and make copies of the Software Product License as necessary only for backup
and/or archival purposes. No other copies may be made. Each copy must reproduce all copyright and
other proprietary rights notices on or in the Software Product License.


2. INTELLECTUAL PROPERTY RIGHTS RESERVED BY XTRAFILE.

The Software Product is protected by U.S. and international copyright laws and treaties, as well as
other intellectual property laws and treaties. You must not remove or alter any copyright notices on
any copies of the Software Product. This Software Product copy is licensed, not sold. Furthermore,
this EULA does not grant you any rights in connection with any trademarks or service marks of
XtraFile. XtraFile reserves all intellectual property rights, including copyrights, and trademark
rights.


3. NO RIGHT TO TRANSFER.

You may not rent, lease, lend, or in any way distribute or transfer any rights in this EULA or the
Software Product to third parties without XtraFile's written approval and subject to written
agreement by the recipient of the terms of this EULA.


4. PROHIBITION ON REVERSE ENGINEERING, DECOMPILATION, AND DISASSEMBLY.

You may not reverse engineer, decompile, defeat license encryption mechanisms, or disassemble the
Software Product or Software Product License except and only to the extent that such activity is
expressly permitted by applicable law notwithstanding this limitation.


5. SUPPORT SERVICES.

XtraFile may provide you with support services related to the Software Product. Use of any such
support services is governed by the XtraFile polices and programs described in "online"
documentation and/or other XtraFile-provided materials. Any supplemental software code or related
materials that XtraFile provides to you as part of the support services is to be considered part of
the Software Product and is subject to the terms and conditions of this EULA. With respect to any
technical information you provide to XtraFile as part of the support services, XtraFile may use such
information for its business purposes without restriction, including for product support and
development. XtraFile will not use such technical information in a form that personally identifies
you.


6. TERMINATION WITHOUT PREJUDICE TO ANY OTHER RIGHTS.

XtraFile may terminate this EULA if you fail to comply with any term or condition of this EULA. In
such event, Licensee agrees to return to Licensor or to destroy all copies of the Software upon
termination of the License. XtraFile may also terminate this EULA for any reason as XtraFile sees fit.


7. NO WARRANTIES.

YOU ACCEPT THE SOFTWARE PRODUCT AND SOFTWARE PRODUCT LICENSE "AS IS," AND XTRAFILE (AND ITS THIRD
PARTY SUPPLIERS AND LICENSORS) MAKE NO WARRANTY AS TO ITS USE, PERFORMANCE, OR OTHERWISE. TO THE
MAXIMUM EXTENT PERMITTED BY APPLICABLE LAW, XTRAFILE (AND ITS THIRD PARTY SUPPLIERS AND LICENSORS)
DISCLAIM ALL OTHER REPRESENTATIONS, WARRANTIES, AND CONDITIONS, EXPRESS, IMPLIED, STATUTORY, OR
OTHERWISE, INCLUDING, BUT NOT LIMITED TO, IMPLIED WARRANTIES OR CONDITIONS OF MERCHANTABILITY,
SATISFACTORY QUALITY, FITNESS FOR A PARTICULAR PURPOSE, TITLE, AND NON-INFRINGEMENT. THE ENTIRE RISK
ARISING OUT OF USE OR PERFORMANCE OF THE SOFTWARE PRODUCT REMAINS WITH YOU.


8. LIMITATION OF LIABILITY.

THIS LIMITATION OF LIABILITY IS TO THE MAXIMUM EXTENT PERMITTED BY APPLICABLE LAW. IN NO EVENT
SHALL XTRAFILE (OR ITS THIRD PARTY SUPPLIERS AND LICENSORS) BE LIABLE FOR ANY COSTS OF SUBSTITUTE
PRODUCTS OR SERVICES, OR FOR ANY SPECIAL, INCIDENTAL, INDIRECT, OR CONSEQUENTIAL DAMAGES WHATSOEVER
(INCLUDING, WITHOUT LIMITATION, DAMAGES FOR LOSS OF BUSINESS PROFITS, BUSINESS INTERRUPTION, OR LOSS
OF BUSINESS INFORMATION) ARISING OUT OF THIS EULA OR THE USE OF OR INABILITY TO USE THE SOFTWARE
PRODUCT OR THE FAILURE TO PROVIDE SUPPORT SERVICES, EVEN IF XTRAFILE HAS BEEN ADVISED OF THE
POSSIBILITY OF SUCH DAMAGES. IN ANY CASE, XTRAFILE'S (AND ITS THIRD PARTY SUPPLIERS' AND LICENSORS')
ENTIRE LIABILITY ARISING OUT OF THIS EULA SHALL BE LIMITED TO THE GREATER OF THE AMOUNT ACTUALLY
PAID BY YOU FOR THE SOFTWARE PRODUCT OR U.S. $5.00; PROVIDED, HOWEVER, THAT IF YOU HAVE ENTERED INTO
A XTRAFILE SUPPORT SERVICES AGREEMENT, XTRAFILE'S ENTIRE LIABILITY REGARDING SUPPORT SERVICES SHALL
BE GOVERNED BY THE TERMS OF THAT AGREEMENT.


9. GOVERNING LAW; ENTIRE AGREEMENT.

This EULA is governed by the laws of the State of Florida, U.S.A., excluding the application
of its conflict of law rules. The United Nations Convention for the International Sale of Goods
shall not apply. This EULA is the entire agreement between us and supersedes any other
communications or advertising with respect to the Software Product; this EULA may be modified only
by written agreement signed by authorized representatives of you and XtraFile.


10. CONTACT INFORMATION

If you have any questions about this EULA, or if you want to contact XtraFile for any reason,
please direct all correspondence to:

XtraFile.com
3107 Stirling Rd. 
Fort Lauderdale, FL 33312

or 

Email: sales@xtrafile.com.</textarea>
						       <br>
							   <br>
							   <b>By clicking the &quot;Continue&quot; button below and/or installing XtraUpload you are bound by the above license aggrement! </b>
						      <br />
						      <br /><div align='center'><a href='index.php?step=2'><img src='images/continue.png' alt='proceed' width="120" height="30" border='0'></a></div> </td>
				   </tr>
    </table>   </div>
	<div class='fade'>&nbsp;</div>
	<br />
	</div>
	</div>
<? 
	xuSetupFooter();

}
else if($_GET['step'] == '2')
{

xuSetupHeader();
?>				 
<form id="form1" name="form1" method="post" enctype="multipart/form-data" action="index.php?step=3">
	<div class='centerbox'>
	<div class='tableborder'>
	<div class='maintitle'>Server Test Results</div>
	<div class='pformstrip'>This section outputs the results of a series of tests to ensure everything is configured correctly before installing.</div>
	<table width='100%' cellspacing='1' id='perms'>
	<? 
	if(file_exists('./config.new.php'))
	{
		$isNewConf = true;
		$pass_fail = '<font color="#FF0000" size="4"><b>Failed</b></font>';
	}
	else
	{
		$pass_fail = '<font color="#009900" size="4"><b>Passed</b></font>';
	}
	?>
	<tr>
        <td class='pformleftw'><strong>File: config.new.php<br>
		Required Name: config.php<br>
		Actual Name: <? if($isNewConf){?>config.new.php<? }else{?>config.php<? }?><br>
          <div class='description'>Check if config file has the correct name.</div></td>
	    <td class='pformright'><?=$pass_fail?></td>
	  </tr>
	<?

	$chmod = array();
	$chmod['./config.php'] = "0666";
	$chmod['./cgi-bin/upload.cgi'] = "0755";
	$chmod['./files'] = "0777";
	$chmod['./prune.php'] = "0666";
	$chmod['./temp'] = "0777";
	$chmod['./cache'] = "0777";
	$chmod['./db'] = "0777";
	$chmod['./thumbs'] = "0777";
	$chmod['./cache/ads'] = "0777";
	$chmod['./cache/mods'] = "0777";
	$is_chmod = true;
	foreach($chmod as $file => $perm)
	{
		$perms = substr(sprintf('%o', fileperms($file)), -4);
		if($perms != $perm)
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
        <td class='pformleftw'><strong>File: <?=$file?><br>
Permissions Required: <?=$perm?><br>
Permissions Found: <?=$perms?></strong>
          <div class='description'></div></td>
	    <td class='pformright'><?=$pass_fail?></td>
	  </tr>
	<? }?>
	
	</table>
	<table width='100%' cellspacing='1' id="perms_ok" style="display:none">
	<tr>
        <td class='pformleftw'><strong>CHMOD Tests: </strong>
          <div class='description'></div></td>
	    <td class='pformright'><font color="#009900" size="3"><b>All Tests Passed</b></font></td>
	  </tr>
	</table>
	<?
	if($is_chmod)
	{
		echo "<script>$('#perms').hide('slow',function()"."{"."$('#perms_ok').show('slow')"."}".");</script>";
	}
	?>
	</div>
	<div class='fade'>&nbsp;</div>
	
	<br />
	
	<div class='tableborder'>
	<div class='maintitle'>Website Address </div>
	<div class='pformstrip'>This section requires you to enter the paths and URL's for the board.</div>
	<table width='100%' cellspacing='1'>
	<tr>
	  <td class='pformleftw'><b>Make sure this is correct  </b>
	    <div class='description'>Please make sure it starts <b></b>with http:// and also it is the address of all your files ie. http://www.yoursite.com/upload </div></td>
	  <td class='pformright'><input type='text' id='textinput' name='url' value='<? $dir=dirname(__FILE__); $dir=explode('/public_html/',$dir); $dir=str_replace('/setup','',$dir[1]); echo 'http://'.$_SERVER['SERVER_NAME'].'/'.$dir?>'></td>
	</tr>
	</table>
	</div>
	<div class='fade'>&nbsp;</div>
	
	<br />
	
	<div class='tableborder'>
	<div class='maintitle'>SQL Data </div>
	<div class='pformstrip'>Please enter the correct mysql info below for the tables to install correctly. </div>
	<table width='100%' cellspacing='1'>
	<tr>
	  <td class='pformleftw'><b>SQL User </b>
	    <div class='description'></div></td>
	  <td class='pformright'><input name="sql_user" type="text" id="sql_user" size="55" /></td>
	</tr>
	
	<tr>
	  <td class='pformleftw'><b>SQL Database Name</b></td>
	  <td class='pformright'><input name="sql_name" type="text" id="sql_database" size="55" /></td>
	</tr>
	
	<tr>
	  <td class='pformleftw'><b>SQL Password </b></td>
	  <td class='pformright'><input name="sql_pass" type="text" id="sql_pass" size="55" /></td>
	</tr>
	
	<tr>
	  <td class='pformleftw'><b>SQL Host </b>
	    <div class='description'>(Localhost is default but in some cases it can be your ip (server ip)</div></td>
	  <td class='pformright'><input name="sql_server" type="text" id="sql_server" value="localhost" size="55" /></td>
	</tr>
	

	</table>
	</div>
	<div class='fade'>&nbsp;</div>
	
	<br />
	
	<div class='tableborder'>
	<div class='maintitle'>Admin Details and License Key </div>
	<div class='pformstrip'>This section requires information to create your administration account. Please enter the data carefully!</div>
	<table width='100%' cellspacing='1'>
	<tr>
	  <td class='pformleftw'><b>Admin Username </b></td>
	  <td class='pformright'><input name="name" type="text" id="name" size="55" /></td>
	</tr>
	
	<tr>
	  <td class='pformleftw'><b>Password</b></td>
	  <td class='pformright'><input name="pass" type="password" id="pass" size="55" /></td>
	</tr>
	<tr>
	  <td class="pformleftw"><strong>Copyright Information Language</strong></td>
	  <td class='pformright'>
	  	<select name="trans" id="trans">
			<option value="EN">English</option>
			<option value="DE">Deutsch/German</option>
			<option value="SP">Spanish</option>
			<option value="KR">Korean</option>
			<option value="CH">Chinese</option>
			<option value="DU">Dutch</option>
			<option value="FR">French</option>
	    </select>	  </td>
	  </tr>
	</table>
	<div align='center' class='pformstrip'  style='text-align:center'>
	<? if(!$is_chmod){ ?>
	<font color="#0000FF">
		<b>
			There were errors during testing. <br>
			Please fix these errors before continuing.<br>
			If you chose to continue you do so at your own risk. <br>
		</b>
	</font>
	<? } ?>
	<input name="Submit" type='image' src='images/continue.png'>
	</div>
	</div>
	<div class='fade'>&nbsp;</div>
	</div>
	</form>   
		
</span>
<? 
xuSetupFooter();
}
else if($_GET['step'] == '3')
{

$url = $_POST['url'];
$count = sizeof($_POST['url']);

if(substr($url,-1) != '/')
{
	$url .= '/';
}

if(substr($url,-1) == '/')
{
	$count--;$count--;
	$server = '';
	$server = substr($url, 0, $count);
}
else
{
	$server = $url;
}

$file = '<?PHP
// XtraUpload  |  1.5.0
// http://XtraFile.com/forums
// This file is (C) XtraFile.com
// All Rights Reserved Unless Explictly Noted.
/////////////////////////////
################
@session_start();
################
$dbServer = "'.$_POST['sql_server'].'"; // mysql host
$dbUser = "'.$_POST['sql_user'].'"; // mysql username
$dbPass = "'.$_POST['sql_pass'].'"; //mysql password
$dbName = "'.$_POST['sql_name'].'"; //mysql database
$trans = "'.$_POST['trans'].'"; // Currently: EN = English, DE = Deutsch/German, SP = Spanish, KR = Korean, CH = Chinese, More to come soon!
$language = "english.php"; // The File That Contains all the Text for XtraUpload. Located in the include/languages folder.
$serverurl = "'.$server.'"; // URL to compare to for Progress bar
?>';

$fp = fopen('./config.php', 'w');
fwrite($fp,$file);
fclose($fp);

include("./include/kernel/db.php");
include("./config.php");

$db=new db_conn();
$db->connect($dbServer,$dbUser,$dbPass,$dbName);

$q1 = "
CREATE TABLE `ads` (
  `id` int(255) NOT NULL auto_increment,
  `name` text ,
  `src` text ,
  `impressions` int(255) default '0',
  `clicks` int(255) default '0',
  `status` tinyint(1) default '1',
  `type` text ,
  `allow_imp` tinyint(255) default '0',
  `nolimit` tinyint(1) default '0',
  `link` text ,
  `o_name` text ,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM   ;

CREATE TABLE `comments` (
  `id` int(4) NOT NULL auto_increment,
  `title` text  NOT NULL,
  `file` text  NOT NULL,
  `author` text  NOT NULL,
  `body` text  NOT NULL,
  `status` tinyint(1) NOT NULL default '1',
  `date` text  NOT NULL,
  `url` text  NOT NULL,
  `email` text  NOT NULL,
  PRIMARY KEY  (`id`),
  FULLTEXT KEY `body` (`body`),
  FULLTEXT KEY `author` (`author`),
  FULLTEXT KEY `url` (`url`),
  FULLTEXT KEY `title` (`title`),
  FULLTEXT KEY `email` (`email`)
) ENGINE=MyISAM  ;

CREATE TABLE `config` (
  `id` int(11) NOT NULL auto_increment,
  `name` text  NOT NULL,
  `value` text  NOT NULL,
  `description1` text  NOT NULL,
  `description2` text  NOT NULL,
  `group` text  NOT NULL,
  `type` text  NOT NULL,
  `invincible` tinyint(1) NOT NULL default '1',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM   ;

INSERT INTO `config` VALUES (1, 'sitename', 'XtraUpload Install ', 'Site Name:', '(Site Name)', 'Main Settings', 'text', 1);
INSERT INTO `config` VALUES (2, 'siteurl', '".$url."', 'Site URL', '(URL to the Main Folder) ', 'Main Settings', 'text', 1);
INSERT INTO `config` VALUES (3, 'adminemail', 'admin@localhost', 'Admin Email Address', '(Your Email Address) ', 'Main Settings', 'text', 1);
INSERT INTO `config` VALUES (4, 'sess_time', '3600', 'Session Time Limit:', '( In Seconds)', 'Main Settings', 'text', 1);
INSERT INTO `config` VALUES (7, 'upload_cgi', '0', 'Upload Method', 'CGI ( Progress bar, Slower)|-|PHP ( Faster, No Progress bar ) ', 'Feature Settings', 'yesno', 1);
INSERT INTO `config` VALUES (8, 'rewrite_links', '0', 'Use mod_rewrite Links? ', 'Yes ( Links look like: /files/2343n423i4n3i4)|-|No (Llinks look like: /download.php?hash=2343n423i4n3i4) ', 'Feature Settings', 'yesno', 1);
INSERT INTO `config` VALUES (9, 'allow_imaging', '0', 'Use Image Processing?', 'Yes ( Requires GD2 )|-|No (No BBCode links or Image Thumbnailing) ', 'Image Processing Settings', 'yesno', 1);
INSERT INTO `config` VALUES (10, 'allow_featured', '0', 'Allow Featured Uploads?', 'Yes|-|No  ', 'Feature Settings', 'yesno', 1);
INSERT INTO `config` VALUES (16, 'site_offline', '0', 'Site Closed', 'Yes, your site is closed|-|No, your site is open', 'Closure Settings', 'text\r\n', 1);
INSERT INTO `config` VALUES (17, 'offline_message', '<font size=\"4\" color=\"#ff0000\"><strong>Testing site closed system.</strong></font>', 'Site Offline Messaage', 'The message that is displayed if your site is offline.', 'Closure Settings', 'box', 1);
INSERT INTO `config` VALUES (18, 'metakey', '', 'Meta Tag: Keywords', 'Keywords that describe your site.', 'Site Meta', 'text', 1);
INSERT INTO `config` VALUES (19, 'metadesc', '', 'Meta Tag: Description', 'Your Site Description, to appear in the description meta tag.', 'Site Meta', 'text', 1);
INSERT INTO `config` VALUES (20, 'shortcut_icon', 'favicon.ico', 'Favicon', 'Your Site''s Favicon URL', 'Site Meta', 'text', 1);
INSERT INTO `config` VALUES (21, 'report_links', '1', 'Show Report File Link?', 'Yes|-|No', 'Feature Settings', 'yesno', 1);
INSERT INTO `config` VALUES (22, 'imageCopyText', 'XtraUpload - Free File Hosting!', 'Uploaded Image Text', 'The Text to be displayed on all images uploaded that can be processed.', 'Image Processing Settings', 'text', 1);
INSERT INTO `config` VALUES (23, 'imageTextColor', '#ff0000', 'Uploaded Image Color', 'The color of the above text.', 'Image Processing Settings', 'color', 1);
INSERT INTO `config` VALUES (24, 'imageFontSize', 'dynamic', 'Uploaded Image Font Size', 'The font size in pixels to be written to a uploaded image.', 'Image Processing Settings', 'text', 1);
".$versionSql."

CREATE TABLE `dlinks` (
  `id` int(11) NOT NULL auto_increment,
  `down_id` text ,
  `store_name` text ,
  `real_name` text ,
  `time` text ,
  `resume` text ,
  `can_r` tinyint(1) NOT NULL default '0',
  `limit` int(11) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM   ;



CREATE TABLE `dlsessions` (
  `id` int(11) NOT NULL auto_increment,
  `ip` text  NOT NULL,
  `user` text  NOT NULL,
  `file` text  NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM   ;



CREATE TABLE `downloads` (
  `id` int(32) NOT NULL auto_increment,
  `filesize` int(32) default '0',
  `filename` varchar(128)  default '',
  `time` int(12) default '0',
  `ip` text  NOT NULL,
  PRIMARY KEY  (`id`),
  KEY `id` (`id`),
  KEY `filename` (`filename`),
  FULLTEXT KEY `ip` (`ip`)
) ENGINE=MyISAM   ;


CREATE TABLE `faq` (
  `id` int(10) NOT NULL auto_increment,
  `pos` int(10) NOT NULL,
  `name` text  NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM   ;

INSERT INTO `faq` VALUES (1, 1, 'Frequently Asked Questions');
INSERT INTO `faq` VALUES (5, 0, 'Payment System FAQ');
INSERT INTO `faq` VALUES (6, 0, 'Download FAQ');CREATE TABLE `faq_items` (
  `id` int(10) NOT NULL auto_increment,
  `pos` int(10) NOT NULL,
  `name` text  NOT NULL,
  `answer` text  NOT NULL,
  `faq` int(10) NOT NULL,
  `status` tinyint(1) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM   ;

INSERT INTO `faq_items` VALUES (1, 1, 'How do I make .ZIP or .RAR files?', 'Simply visit www.winzip.com (Winzip) or www.rarlabs.com (WinRar) and follow the instructions on their site.', 1, 1);
INSERT INTO `faq_items` VALUES (8, 0, 'What is this site? ', 'This is a file hosting system where you upload a file. Our website will then generate a download link which you can share with friends/family and they will be able to download. You can also create file folders, upload images and get forum codes, and much more!', 1, 0);
INSERT INTO `faq_items` VALUES (3, 1, 'How do I make .ZIP or .RAR files?', 'Simply visit www.winzip.com (Winzip) or www.rarlabs.com (WinRar) and follow the instructions on their site', 2, 1);
INSERT INTO `faq_items` VALUES (4, 2, 'What is XtraFile? ', 'This is a Free file hosting system, you upload a file, our website will then generate a download link which you can share with friends/family and they will be able to download.', 2, 1);
INSERT INTO `faq_items` VALUES (5, 1, 'How do I make .ZIP or .RAR files?', 'Simply visit www.winzip.com (Winzip) or www.rarlabs.com (WinRar) and follow the instructions on their site', 3, 1);
INSERT INTO `faq_items` VALUES (6, 2, 'What is XtraFile? ', 'This is a Free file hosting system, you upload a file, our website will then generate a download link which you can share with friends/family and they will be able to download.', 3, 1);
INSERT INTO `faq_items` VALUES (9, 0, 'Is registration required?', 'No, you do not have to register to use our service. However using the free, anonymous upload does not allow you to delete and change Files and your upload links are not saved. Those features are reserved for Fast Pass (Premium) users.', 1, 0);
INSERT INTO `faq_items` VALUES (10, 0, 'What file formats do your support?', 'You can only upload files. Your files should have the correct extensions, and the filenames should not include spaces or invalid characters or the download will be corrupted.', 1, 0);
INSERT INTO `faq_items` VALUES (11, 0, 'What is the maximum filesize?', 'The maximum filesize depends on what type of user you are.<br />\r\nFor more information <a href=\"-!-".'{'."$".'SITEURL'.'}'."-!-index.php?p=fastpass\">click here</a>. ', 1, 0);
INSERT INTO `faq_items` VALUES (12, 0, 'How long will you host my files?', 'Your files stay as long as we do not receive a complaint. ', 1, 0);
INSERT INTO `faq_items` VALUES (13, 0, 'What kinds of files will you host?', 'We''ll host any file you have the legal rights to use. Anything illegal in nature, or a file you don''t have rights to, will be deleted and your IP address turned over to the authorities.', 1, 0);
INSERT INTO `faq_items` VALUES (14, 0, 'How can I contact you?', 'We are available 24/7 to answer your questions through emails, to contact us, use our <a href=\"-!-".'{'."$".'SITEURL'.'}'."-!-index.php?p=contactus\">contact form</a>.', 1, 0);
INSERT INTO `faq_items` VALUES (15, 0, 'I signed up but cannot login! ', 'You must contact us immediately through our contact form and we will take care of your problem right away.', 1, 0);
INSERT INTO `faq_items` VALUES (16, 0, 'I lost my login information ', 'Click on the forgot password link under every login form and it will be automatically sent to your email. ', 1, 0);
INSERT INTO `faq_items` VALUES (17, 0, 'Where is you TOS/AUP?', '<a href=\"-!-".'{'."$".'SITEURL'.'}'."-!-index.php?p=tos\">TOS/AUP is Availabe Here</a>', 1, 0);


INSERT INTO `faq_items` VALUES (18, 0, 'What happens if someone else registers with my username?', 'Our system will not allow new users to register accounts with already used user names or email addresses. The one exception is when you register your account with a non IPN payment service. When this happens anyone can register that user name until an admin approves the transaction manually. In that time if someone registers an account with that username using a IPN payment service that name is gon and you will be contacted to chose a new name with the email address you provided.', 5, 0);
INSERT INTO `faq_items` VALUES (19, 0, 'What payment processors do you accept?', 'To view what payment processors we accpet please begin the account registration process on a paid account. Once you have aggred to the EULA/TOS you will be presented with the registration page where you select what payment processors we accept.', 5, 0);
INSERT INTO `faq_items` VALUES (20, 0, 'If I cancel my account early do I get a partial refund?', 'No, once you register an account with us you cannot receive a refund unless we explicitly note it on your account. These exceptions are rare as you are agreeing to a no refund policy on account terminations when you created the account.', 5, 0);
INSERT INTO `faq_items` VALUES (21, 0, 'Can I extend my account without points?', 'Yes you can extend your account for the same length as it originally was valid for for the current price of that account package.', 5, 0);


INSERT INTO `faq_items` VALUES (22, 0, 'What are Download Links?', 'The Links are used to monitor file downloads and to allow Download Accelerators to function properly. <br />\r\nLinks expire after a set amount of time and when expired you must go through the wait cycle to get another one. ', 6, 0);
INSERT INTO `faq_items` VALUES (23, 0, 'Can I use a download Accelerator with my download link?  ', 'It depends on the type of account you are using. \r\nIf you have an account please login to it as it might allow you to use download accelerators with your download links. ', 6, 0);
INSERT INTO `faq_items` VALUES (24, 0, 'Why can''t I just get a direct link to the file?', '  We need to keep bandwith within reasonable amounts, we can not allow hot linking of files, we need to make money off advertising to keep this service going, and if we directly link to files there is a chance that our servers will be compromised. </p>\r\n', 6, 0);
INSERT INTO `faq_items` VALUES (25, 0, 'The link I recived expired, what can I do?', 'Visit the main file link again, wait, and get a new download link.', 6, 0);


CREATE TABLE `files` (
  `id` int(11) NOT NULL auto_increment,
  `filename` text ,
  `ipaddress` text ,
  `o_filename` text ,
  `hash` text ,
  `rating_num` int(255) default '0',
  `rating_average` tinyint(25) default '0',
  `description` text ,
  `date` int(11) default '0',
  `status` tinyint(4) default '1',
  `bandwith` text ,
  `pkey` varchar(25)  default '',
  `user` int(11) default '0',
  `server` text ,
  `secid` text ,
  `del` text ,
  `password` text ,
  `downloads` int(255) default '0',
  `thumb` text  NOT NULL,
  `featured` tinyint(1) NOT NULL default '0',
  `approved` tinyint(1) NOT NULL default '0',
  `md5` varchar(32)  NOT NULL,
  `size` int(11) NOT NULL,
  `last_download` text  NOT NULL,
  `group` text  NOT NULL,
  `ban` tinyint(4) NOT NULL,
  `report` tinyint(4) NOT NULL,
  `reupload` TINYINT( 1 ) NOT NULL DEFAULT '0',
  PRIMARY KEY  (`id`),
  KEY `downloads` (`downloads`),
  FULLTEXT KEY `filename` (`filename`,`o_filename`,`hash`,`description`)
) ENGINE=MyISAM   ;


CREATE TABLE `fitem` (
  `id` int(11) NOT NULL auto_increment,
  `fid` text ,
  `file` int(11) default '0',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM   ;


CREATE TABLE `folder` (
  `id` int(11) NOT NULL auto_increment,
  `name` text ,
  `user` int(11) default '0',
  `password` text ,
  `fid` text  NOT NULL,
  `admin_password` text  NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM   ;



CREATE TABLE `groups` (
  `name` text ,
  `description` text ,
  `price` text ,
  `can_cgi` tinyint(1) default '1',
  `can_flash` tinyint(1) default '1',
  `can_url` tinyint(1) default '1',
  `can_manage` tinyint(1) default '1',
  `can_delete` tinyint(1) default '1',
  `can_email` tinyint(1) default '1',
  `can_create_folders` tinyint(1) default '1',
  `can_view_folders` tinyint(1) default '1',
  `is_admin` tinyint(1) default '0',
  `limit_speed` text ,
  `id` int(255) NOT NULL auto_increment,
  `visible` tinyint(1) default '1',
  `resume` tinyint(1) default '0',
  `limit` text ,
  `allow_types` text ,
  `extend_points` text ,
  `expire` text ,
  `can_extend` tinyint(1) default '0',
  `expired` tinyint(1) default '0',
  `captcha` tinyint(1) default '1',
  `home_captcha` tinyint(1) default '0',
  `users` int(255) default '0',
  `userlimit` int(255) default '0',
  `points` int(255) default '0',
  `days` int(255) default '0',
  `limit_wait` int(255) default '30',
  `limit_size` int(255) default '0',
  `show_direct_link` tinyint(1) NOT NULL,
  `files_restrict_allowed` tinyint(1) NOT NULL,
  `no_ads` tinyint(1) NOT NULL,
  `file_expire` tinyint(1) NOT NULL,
  `max_file_streams` int(11) NOT NULL default '1',
  `shownUploadMethod` INT NOT NULL DEFAULT '1',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM   ;

INSERT INTO `groups` VALUES ('Free', 'Non Registered Users.', '0.00', 1, 1, 1, 0, 0, 1, 0, 1, 0, '100', 1, 1, 0, '150', '*', '0', '0', 0, 0, 1, 0, 0, 0, 0, 0, 30, 0, 1, 0, 0, 0, 1, 1);
INSERT INTO `groups` VALUES ('Admins', 'Administrators', '0.00', 1, 1, 1, 1, 1, 1, 1, 1, 1, '30', 2, 0, 1, '0', '*', '10000', '0', 1, 0, 1, 0, 0, 0, 10000, 0, 2, 250, 1, 0, 0, 0, 5, 1);
INSERT INTO `groups` VALUES ('Premium', 'Premium Membership', '0.01', 1, 1, 1, 1, 1, 1, 1, 1, 0, '350', 3, 1, 1, '1000', '*', '10000', '360', 1, 0, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1, 1);



CREATE TABLE `lang` (
  `id` int(11) NOT NULL auto_increment,
  `default` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  `name` text  NOT NULL,
  `users` text  NOT NULL,
  `file` text  NOT NULL,
  `cc` text  NOT NULL,
  PRIMARY KEY  (`id`),
  FULLTEXT KEY `name` (`name`)
) ENGINE=MyISAM   ;

INSERT INTO `lang` VALUES (1, 1, 1, 'English', '', 'english.php', 'us');



CREATE TABLE `news` (
  `id` int(255) NOT NULL auto_increment,
  `title` text ,
  `news` text ,
  `author` text ,
  `date` text ,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM   ;

INSERT INTO `news` VALUES (4, 'Welcome to XtraUpload!', 'Thank you for downloading XtraUpload!<br /><br />Welcome to the most advanced, feature rich, FREE file hosting system on the planet.<br />With Advanced functionality like multiple servers, user groups, an integrated ad management system, a points system, and much more this is going to be the only file hosting system you will ever need.<br />By focusing on simple, clean interfaces your users will love the functionality while you make money showing them ads.<br />We believe in a simple, yet advanced, uncluttered but functional product.<br /><br />Enjoy the script and please report all bugs to our  <a href=\"http://xtrafile.com/tracker\">bug tracker</a> or <a href=\"http://xtrafile.com/forum\">forum</a>. <br />-Matt ', 'Matthew', 'September 29, 2006, 12:42 am');



CREATE TABLE `payment` (
  `id` int(2) NOT NULL auto_increment,
  `name` text ,
  `status` text ,
  `sell_id` text ,
  `f_name` text ,
  `price` text ,
  `cartid` text ,
  `address` text ,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM   ;

INSERT INTO `payment` VALUES (1, 'authnet', '1', '3333333333333', 'Authorize.net', '9.99', '', '');
INSERT INTO `payment` VALUES (2, 'paypal', '1', 'paypal@tcg-direct.com', 'PayPal', '9.99', '', '');
INSERT INTO `payment` VALUES (3, '2co', '1', '619337', '2CheckOut', '9.99', '1', '');
INSERT INTO `payment` VALUES (4, 'check', '1', '', 'Check / Money Order', '9.99', '', 'Please send your Payment to this address: XtraUpload ATTN: Payments 1234 NW 324 St. El Paso TX, 56343 Please include your username with this payment. Thank you! ');
INSERT INTO `payment` VALUES (5, 'mb', '1', 'email@domain.com', 'MoneyBrokers', '9.00', NULL, NULL);
INSERT INTO `payment` VALUES (6, 'stormpay', '1', 'email@domain.com', 'StormPay', NULL, NULL, NULL);
INSERT INTO `payment` VALUES (7, 'egold', '1', '2139182931', 'eGold', NULL, NULL, NULL);



CREATE TABLE `servers` (
  `id` int(10) NOT NULL auto_increment,
  `name` text ,
  `link` text ,
  `active` tinyint(1) default '1',
  `used_bandwith` bigint(255) default '0',
  `total_bandwith` bigint(255) default '50000',
  `space_limit` bigint(255) default '5000',
  `space_used` bigint(255) default '0',
  `files` int(255) default '0',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM   ;

INSERT INTO `servers` VALUES (1, 'Main', '".$server."', 1, 0, 52428800000, 5242880000, 0, 0);



CREATE TABLE `skin` (
  `id` int(10) NOT NULL auto_increment,
  `name` text ,
  `active` tinyint(1) default '1',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM   ;

INSERT INTO `skin` VALUES (1, 'default', 0);
INSERT INTO `skin` VALUES (2, 'reaper', 0);
INSERT INTO `skin` VALUES (3, 'rxv2', 0);
INSERT INTO `skin` VALUES (5, 'Indigo', 1);



CREATE TABLE `syslog` (
  `id` int(10) NOT NULL auto_increment,
  `desc` text  NOT NULL,
  `action` text  NOT NULL,
  `content` text  NOT NULL,
  `status` text  NOT NULL,
  `sector` text  NOT NULL,
  `date` text  NOT NULL,
  PRIMARY KEY  (`id`),
  FULLTEXT KEY `desc` (`desc`),
  FULLTEXT KEY `content` (`content`),
  FULLTEXT KEY `action` (`action`)
) ENGINE=MyISAM   ;



CREATE TABLE `transactions` (
  `id` int(255) NOT NULL auto_increment,
  `name` text  NOT NULL,
  `notes` text  NOT NULL,
  `postdata` text  NOT NULL,
  `result` text  NOT NULL,
  `ammount` text  NOT NULL,
  `email` text  NOT NULL,
  `username` text  NOT NULL,
  `password` text  NOT NULL,
  `processor` text  NOT NULL,
  `group` text  NOT NULL,
  `approved` tinyint(1) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM   ;

CREATE TABLE `users` (
  `isadmin` tinyint(1) default '0',
  `uid` int(11) NOT NULL auto_increment,
  `username` varchar(50)  default NULL,
  `password` varchar(50)  default NULL,
  `status` int(11) default '1',
  `expire` text ,
  `email` text ,
  `terminate` text ,
  `points` int(255) default '0',
  `group` text ,
  `expired` tinyint(1) default '0',
  `time` text ,
  `lang` int(11) NOT NULL,
  PRIMARY KEY  (`uid`)
) ENGINE=MyISAM   ;

INSERT INTO `users` VALUES (1, 1, '".$_POST['name']."', '".md5($_POST['pass'])."', 1, '', '', '', 0, '2', 0, '1260358571', 0);

CREATE TABLE `wait` (
  `session_id` varchar(32)  NOT NULL default '',
  `hash` varchar(13)  default '',
  `cur_time` varchar(128)  default '',
  PRIMARY KEY  (`session_id`)
) ENGINE=MyISAM ;

ALTER TABLE `dlinks` ADD INDEX `downlink` ( `down_id` ( 16 ) );
ALTER TABLE `dlsessions` ADD INDEX ( `file` ( 300 ) );
ALTER TABLE `files` ADD INDEX `fileid` ( `hash` ( 12 ) , `pkey` ( 12 ) );
ALTER TABLE `servers` ADD INDEX `serv` ( `link` ( 150 ) , `name` ( 150 ) );
ALTER TABLE `folder` ADD INDEX `fid` ( `fid` ( 6 ) );
ALTER TABLE `fitem` ADD INDEX ( `fid` ( 6 ) );
ALTER TABLE `fitem` ADD INDEX ( `file` );


INSERT INTO `config` ( `id` , `name` , `value` , `description1` , `description2` , `group` , `type` , `invincible` )
VALUES 
(NULL , 'use_memcache', '0', 'Use Memcache', 'Yes|-|No', 'Memcache', 'yesno', '1'), 
(NULL , 'memcache_port', '11211', 'Memcache Server Port', 'The port php will connect to memcache with(default is 11211).', 'Memcache', 'text', '1'),
(NULL , '$memcache_server', 'localhost', 'Server Url', 'The url to the memcache server', 'Memcache', 'text', '1');

";
$q1 = explode(';',$q1);
$i=0;
foreach($q1 as $q1)
{
	if(trim($q1) != '')
	{
		$db->query($q1,$q1.'<br /><br />'.$i);
		$i++;
	}
}
xuSetupHeader();
?>			 
	<form id="form1" name="form1" method="post" enctype="multipart/form-data" action="step1.php?step=3">
	<div class='centerbox'>
	
	<div class='tableborder'>
	<div class='maintitle'>Success! XtraUpload Has Installed Succefully </div>
	<div class='pformstrip'>Details About The Install Are Below </div>
	<table width="100%" height="40" border="0" cellpadding="0" cellspacing="0">
      <tr>
        <td width="19%" valign="middle"><center><img src="images/angle/checkmark.png" width="128" height="128" />
        </center></td>
        <td width="62%"><br>
          <br><center>
  <font face=verdana size=2 color=black><b><font color="#009900" size="4">XtraUpload was installed successfully!</font><font color="#009900"><br>
  <br>
  </font><br> 
  <font color="#FF0000">YOU MUST DELETE THE SETUP FOLDER FROM YOUR SERVER BEFORE XTRAUPLOAD WILL WORK! </font></b><br>
  </font>
  <P><font color="black" size="2" face="verdana"><strong>&lt;&lt; Log into your admin area &gt;&gt; </strong><BR>
  <a href="./admin/"><strong>Login Here</strong></a></font>
  <P><font color="black" size="2" face="Verdana, Arial, Helvetica, sans-serif"><strong>The admin </strong></font><font color="black" size="2" face="verdana"><strong> login information is:</strong></font>
  <table width="309" border="0" cellspacing="2" cellpadding="0">
        <tr>
          <td width="166"><div align="right"><font color="black" size="2" face="verdana"><b>Admin Username:</b></font></div></td>
          <td width="137"><font color="black" size="2" face="verdana"><b><?=$_POST['name']?></b></font></td>
        </tr>
        <tr>
          <td><div align="right"><font color="black" size="2" face="verdana"><b>Admin Password:</b></font></div></td>
          <td><font color="black" size="2" face="verdana"><b><?=$_POST['pass']?></b></font></td>
        </tr>
  </table>
  <br>
  <span class="pformstrip" style="text-align:center">
  <a href="../"><img src='images/continue.png' border="0"></a>  </span><br>
  <br />
</center></td>
        <td width="19%">&nbsp;</td>
      </tr>
    </table>
	</div>
	<div class='fade'>&nbsp;</div>
	<br />
	</div>
	</form>
</span>
<? 
xuSetupFooter();
}

?>