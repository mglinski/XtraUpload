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

function runUpgradeProcess($curver, $newver)
{
	global $db;
	
	if($curver == $newver)
	{
		return true;
	}
	
	if($curver == "1.5.0,0.3.0.0")
	{
		// Update to RC4 DB
		include('./setup/upgrade/5.php');
	}
	else if($curver == "1.5.0,0.4.0.0")
	{
		// Update to 1.5.0 STABLE DB
		include('./setup/upgrade/6.php');
	}
	else if($curver == "1.5.0,1.0.0.0")
	{
		// Update to 1.5.1 STABLE DB
		include('./setup/upgrade/7.php');
	}
	else if($curver == "1.5.1,1.0.0.0")
	{
		// Update to 1.5.2 STABLE DB
		include('./setup/upgrade/8.php');
	}
	else if($curver == "1.5.2,1.0.0.0")
	{
		// Update to 1.5.3 STABLE DB
		include('./setup/upgrade/9.php');
	}
	else if($curver == "1.5.3,1.0.0.0")
	{
		// Update to 1.5.4 STABLE DB
		include('./setup/upgrade/10.php');
	}
	else if($curver == "1.5.4,1.0.0.0")
	{
		// Update to 1.5.5 STABLE DB
		include('./setup/upgrade/11.php');
	}
	else if($curver == "1.5.5,1.0.0.0")
	{
		// Update to 1.5.6 STABLE DB
		include('./setup/upgrade/12.php');
	}
	else if($curver == "1.5.6,1.0.0.0")
	{
		// Update to 1.6.0 BETA1 DB
		include('./setup/upgrade/13.php');
	}
	else if($curver == "1.6.0,0.0.1.0")
	{
		// Update to 1.6.0 BETA2 DB
		include('./setup/upgrade/14.php');
	}
	else if($curver == "1.6.0,0.0.2.0")
	{
		// Update to 1.6.0 BETA2 DB
		include('./setup/upgrade/15.php');
	}
	else if($curver == "1.6.0,0.0.3.0")
	{
		// Update to 1.6.0 BETA2 DB
		include('./setup/upgrade/16.php');
	}
	else if($curver == "1.6.0,0.0.4.0")
	{
		// Update to 1.6.0 BETA2 DB
		include('./setup/upgrade/17.php');
	}
	return false;
}

if(!isset($_GET['step']))
{
	$_GET['step'] = '1';
}

if($_GET['step'] == '1')
{
xuSetupHeader();
?>

<div class='centerbox'>
  <div class='tableborder'>
    <div class='maintitle'> Welcome to XtraUpload Upgrader! </div>
    <div class='pformstrip'> Continue to upgrade your version of XtraUpload </div>
    <table width='100%' border='0' cellpadding='0' cellspacing='0' align='center'>
      <tr>
        <td width="12%" valign="middle"><center>
            <img style="vertical-align:middle;" src="images/angle/install.png" width="128" height="128">
          </center></td>
        <td width="88%"><br />
          <br />
          Thank you for Downloading a new version of XtraUpload. <br />
          We hope you find the update of xtrauploaod the new version a breeze as it is all automated making it simple to use for someone with very limited knowledge of php, sql ,etc. <br />
          <br />
          Click continue to carry on with this Upgrade.<br />
          You will be given a progress bar to show you how much is left to install. <br>
          <br>
          <b>Do not click back once you have clicked Continue. This may cause database errors! </b> <br />
          <br />
          <div align='center'><a href='index.php?step=2'><img src='images/continue.png' alt='proceed' width="120" height="30" border='0'></a></div></td>
      </tr>
    </table>
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
<div class='centerbox'>
  <div class='tableborder'>
    <div class='maintitle'>XtraUpload Upgrading!</div>
    <div class='pformstrip'>Upgrading your version of XtraUpload now!</div>
    <table width='100%' border='0' cellpadding='0' cellspacing='0' align='center'>
      <tr>
        <td width="12%" valign="middle"><center>
            <img style="vertical-align:middle;" src="../images/angle/install.png" width="128" height="128">
          </center></td>
        <td width="88%"><p> <b>We are upgrading your install now. You can check the progress below...</b> </p>
            <pre><code><?
	echo ' 
XtraUpload is (c) XtraFile.com
----------------------------------------------------
';
$ds = $db->fetch($db->query("SELECT `value` FROM `config` WHERE `name` = 'version' "));
$curver = $ds->value;
if(empty($curver))
{
	$ds = $db->fetch($db->query("SELECT `value` FROM `config` WHERE `name` = 'config' "));
	$curver = $ds->value;
	$db->query("UPDATE `config` SET `name` = 'version' WHERE `name` = 'config'");
}

if(isset($_GET['override']))
{
	$curver = $_GET['override'];
}

$ret = runUpgradeProcess(trim($curver), trim($versionDefault));

if($ret)
{
	echo'-> Upgrade Complete! 
';
	
	?></code></pre>
          </p>
          <p> New XtraUpload Version is: <?=$version?> <br />
            Please delete the setup folder or else XtraUpload will not work.<br />
          </p>
          <div align='center'><a href='../'><img src='images/continue.png' alt='proceed' width="120" height="30" border='0'></a> </div>
          <? }else{?>
          </code></pre>
          <p> Upgrade still in progress! <br />Please wait while we continue the upgrade.
          </p>
          <script>setTimeout('location.reload()',2000);</script>
          <div align='center'><input 
          style="background:#9EC4ED; border:1px #0033CC solid; font-family:Geneva, Arial, Helvetica, sans-serif; font-size:14px; padding:3px;" 
          type="button" 
          onclick="location = '<?='http://'.$_SERVER['HTTP_HOST'].$_SERVER['PHP_SELF'].'?'.$_SERVER['QUERY_STRING']?>';" 
          value="Click here if not forwarded..." /></div>
          
          <? }?>
          </td>
      </tr>
    </table>
    <div class='fade'>&nbsp;</div>
    <br />
  </div>
</div>
<?
	xuSetupFooter();
}
?>
