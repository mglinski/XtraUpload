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

function server_monitor($domain,$port) 
{
	// Set Error Reporting to none to supress FSOCKOPEN() Error messages
	$error_level = error_reporting(0);
	
	// Set empty array to store results
	$result = array();
	
	$domain = str_replace('http://','',$domain);
	// try openeing a socket(connection) to the selected port
	$fp = fsockopen($domain, $port, $ern, $ers, 1);
	
	if (!$fp) 
	{ 
		// Close Socket
    	fclose($fp);
	
		// Restore Error Reporting
		error_reporting($error_level);
		
		// Failed
		return false; 
	} 
	else 
	{ 
		// Close Socket
    	fclose($fp);
	
		// Restore Error Reporting
		error_reporting($error_level);
		
		// Passed
		return true; 
	}
}

if(isset($_GET['stats']) && $_GET['stats'] != '')
{
	$server = intval($_GET['stats']);
	if($_POST['valid'])
	{
		
		$sql = "UPDATE `servers` 
		SET 
		`name` = '$_POST[name]', 
		`link` = '$_POST[link]',
		`active` = '$_POST[active]',
		`total_bandwith` = '".(($_POST['total_bandwith']*1024)*1024)."', 
		`space_limit` = '".(($_POST['space_limit']*1024)*1024)."'
		WHERE `id` = '$server'
		";
		log_action('Server Edited', 'server:edit', 'Server('.$_POST['name'].') Was updated.', 'ok', 'admin/servers.php');
		$db->query($sql);
		
	}

	$stats = $db->fetch($db->query("SELECT * FROM servers WHERE id='".$server."' "),'obj');
	$bw_used = round((( $stats->used_bandwith * 100) / $stats->total_bandwith ),2);
	$bw_total = 100 - $bw_used;
	
	$store_used = round((( $stats->space_used * 100) / $stats->space_limit ),2);
	$store_total = 100 - $store_used;
	
	$bw_used_t = $stats->used_bandwith;
	$bw_total_t = $stats->total_bandwith - $stats->used_bandwith;
	
	$store_used_t = $stats->space_used;
	$store_total_t = $stats->space_limit - $stats->space_used;
	?><script src="./js/chart.js" type="text/javascript"></script>
    <h1><span>Server Stats - <?=$stats->name?></span>XtraFile :: Admin Panel</h1>
<center>
  <br />
  <strong><font size="4">Server Name:  <?=$stats->name?>
  <br />
  Server URL:
  <a href='<?=$stats->link?>' target="_blank">
  <?=$stats->link?>
  </a>  </font></strong> <br />
  <br />
   <strong>
   <a href="javascript:;" onclick="document.getElementById('space').style.display = ''; document.getElementById('bw').style.display = 'none'; document.getElementById('config').style.display = 'none';">Storage Space Stats</a> | 
   <a href="javascript:;" onclick=" document.getElementById('bw').style.display = ''; document.getElementById('space').style.display = 'none'; document.getElementById('config').style.display = 'none';">Bandwith Usage Stats</a> | 
   <a href="javascript:;" onclick=" document.getElementById('bw').style.display = 'none'; document.getElementById('space').style.display = 'none'; document.getElementById('config').style.display = '';">Edit Configuration</a>  </strong> | <a href="servers.php"><strong>Back to Overview</strong></a> <br />
  <br />
  <table width="601" height="283" id="bw" style="display:none">
  <tr>
    <td width="713" height="277">
	
          <div align="center">Total Used Bandwith: <?=round(($bw_used_t/1024)/1024, 2)?> MB<br />
Total Free Bandwith: <?=round(($bw_total_t/1024)/1024,2)?> MB<br />
            <br />
			<script type="text/javascript">
			var XML = '';
			NAME = "<?=$stats->name?> Server: Bandwidth Useage Chart";
			XML += "<set value='<?=$bw_total?>' name='Free Bandwidth ' color='FF9933'/> ";
			XML += "<set value='<?=$bw_used?>' name='Used Bandwidth ' color='6699FF'/> ";
			draw_pie(XML,NAME,'','bw');
			XML = '';
			</script>
          </div></td>
</tr></table>
<table width="601" height="283" id="space" style="display:none">
  <tr>
    <td width="713" height="277">
          <div align="center">
            <p>Total Used Storage Space: <?=round(($store_used_t/1024)/1024,2)?> MB<br />
              Total Free  Storage Space: <?=round(($store_total_t/1024)/1024,2)?> MB<br />
			<br />
			<script type="text/javascript">
			var XML_SPACE = '';
			NAME = "<?=$stats->name?> Server: Storage Space Chart";
			XML += "<set value='<?=$store_total?>' name='Free Space ' color='FF9933'/> ";
			XML += "<set value='<?=$store_used?>' name='Used Space ' color='6699FF'/> ";
			XML_SPACE = XML;
			draw_pie(XML_SPACE,NAME,'','store');
			XML = '';
			XML_SPACE = '';
			</script>
            </p>
          </div></td>
</tr></table>
<table width="601" height="252" id="config" style="display:none">
  <tr>
    <td width="713" height="246">
	<form action="servers.php?stats=<?=$stats->id?>&update=1" method="post" >
	<table width="90%" height="86%" border="0" align="center" cellpadding="5" cellspacing="0">
      <tr>
        <td width="50%" height="32"><div align="right">Name:</div></td>
        <td width="50%"><input name="name" type="text" size="30" value="<?=$stats->name?>"  /></td>
      </tr>
      <tr>
        <td height="31"><div align="right">Link:</div></td>
        <td><input name="link" type="text" size="30" value="<?=$stats->link?>" /></td>
      </tr>
      <tr>
        <td height="33"><div align="right">Status:</div></td>
        <td>
<input name="active" type="radio" value="1"  <? if($stats->active){ ?>checked<? }?> /> Active <br />
<input name="active" type="radio" value="0" <? if(!$stats->active){ ?>checked<? }?> /> Inactive</td>
      </tr>
      <tr>
        <td height="31"><div align="right">Total Bandwith(in Megabytes):</div></td>
        <td><input name="total_bandwith" type="text" size="30" value="<?=(($stats->total_bandwith/1024)/1024)?>"  /></td>
      </tr>
      <tr>
        <td height="32"><div align="right">Total Storage Space(in Megabytes):</div>          </td>
        <td><input name="space_limit" type="text" size="30" value="<?=(($stats->space_limit/1024)/1024)?>"  /></td>
      </tr>
    </table>
      <br />
      <br />
      <div align="center">
        <input type="hidden" name="valid"  value="true"/>
        <input type="submit" name="Submit" id='submit' value="  Update  " />
        <br />
      </div>
	  </form>
	  </td>
</tr></table>
</center><?
}
else
{
	$step = $_REQUEST['step'];
	$uid = $_REQUEST['uid'];
	if (!$step)
	{
		$step = 1;
	}
	$display_block = true;
	switch($step)
	{
	
		case "4":// delete users
			$qry2 = $db->query("SELECT * FROM servers  WHERE id = '".$uid."' ");
			$res = $db->fetch($qry2,'obj');
			$db->query("DELETE FROM servers  WHERE id = '".$uid."' ");
			log_action('Server Deleted', 'server:delete', 'Server('.$res->name.') Was deleted.', 'ok', 'admin/servers.php');
			$display_block = false;
		break;
			
		case "9":// delete users
			
			$qry2 = $db->query("SELECT * FROM servers  WHERE id = '".$uid."' ");
			$res = $db->fetch($qry2,'obj');
			$db->query("UPDATE servers  SET active='$_REQUEST[stat]' WHERE id = '".$uid."' ");
			log_action('Server Status changed', 'server:status', 'Server('.$res->name.') status changed.', 'ok', 'admin/servers.php');
			$display_block = false;
			
		break;
			
		default:// user index
		// Nothing to do here
		break;
		
	}

	if(isset($_POST['s2']))
{
	$q1 = "INSERT INTO `servers` 
	 (  `name` , `link`, `active`, `total_bandwith`,`space_limit` )
	 VALUES
	 ('".$_POST['newserver']."', '".$_POST['link']."', '".$_POST['isactive']."', '".(($_POST['total_bandwith']*1024)*1024)."', '".(($_POST['space_limit']*1024)*1024)."');";
	$db->query($q1);
	log_action('Server Created', 'server:new', 'Server('.$_POST['newserver'].') Was created.', 'ok', 'admin/servers.php');
	echo "<br><center>New Server <b>'".$_POST['newserver']."'</b> was added.</center>";
}

?>
<h1><span>Server Control Center</span>XtraFile :: Admin Panel</h1>
<div align="center">

  <p><strong><font size=3 face="Verdana, Arial, Helvetica, sans-serif"><a href="javascript:;" onclick='document.getElementById("a1").style.display = ""; document.getElementById("b1").style.display = "none"; '>Manage Servers</a>  | 
    <a href="javascript:;" onclick='document.getElementById("b1").style.display = ""; document.getElementById("a1").style.display = "none"; '>Add Server </a>
        </font></strong><font size=2 face="Verdana, Arial, Helvetica, sans-serif"><br />
      <br />
          </font>
  </p>
</div>

<div style=" border-width:thin; border-color:#000000">
<div id="a1">

  <div align="center">
    <p><br />
      <font size="+1">Click on the lightbulb to switch the server status between &quot;On&quot; and &quot;Off&quot;</font><font size="4"><br />
      </font></p>
    <table width=850 border='0' align="center" cellpadding=3 cellspacing=0 style=" border-color:#000000; border-style:solid; border-width:1px;">
      <tr>
        <td width="23%" align=center class='a1'><strong>Server Name</strong></td>
        <td width="31%" align=center class='a1'><strong>Server URL </strong></td>
        <td width="16%" align=center class='a1'><strong>HTTPd Status: </strong></td>
        <td width="16%" align=center class='a1'><strong>MySQL Status: </strong></td>
        <td width="14%" align=center class='a1'><strong>Manage Server </strong></td>
      </tr>
      <?
	$a_old = $a;
	unset($a);
	$sql3 = "SELECT * FROM `servers` ";
	$result1 = $db->query($sql3);
	if ($result1)
	{
		$js_editable = '';
		while( $row = $db->fetch($result1,'obj') )
		{
		
			if($row->active == '1')
			{
				$nst=0;
				$status = "On";
			}
			else
			{
				$nst=1;
				$status = "Off";
			}
			$hostname = explode('/', $row->link);
			$hostname = $hostname[2];
?>
      <tr style='background-color:' onmouseover="this.style.backgroundColor = '#C1DEF0'" onmouseout="this.style.backgroundColor = ''" >
        <td class='a1'><div align="center"><span id='server_name_<?=$row->id?>'><?=$row->name?></span></div></td>
        <td class='a1'><div align="center"><span id='server_link_<?=$row->id?>'><?=$row->link?></span></div></td>
        <td class='a1'><div align="center">
		<? 
		$arr = server_monitor($hostname,'80'); 
		if($arr)
		{
			?>
            <img src="../images/actions/Event (Green)_24x24.png" border="0" alt="Alive" />
			<?
		}
		else
		{
			?>
            <img src="../images/actions/Event (Red)_24x24.png" border="0" alt="Dead" />
            <?
		} 
		?></div></td>
        <td class='a1'><div align="center">
		<? 
		$arr = server_monitor($hostname,'3306'); 
		if($arr)
		{
			?>
            <img src="../images/actions/Event (Green)_24x24.png" border="0" alt="Alive" />
			<?
		}
		else
		{
			?>
            <img src="../images/actions/Event (Red)_24x24.png" border="0" alt="Dead" />
            <?
		} 
		?></div></td>
        
        <td class='a1'>
        	<div align="center">
            	<span> 
                	<a href="<?=$PHP_SELF?>?a=<?=$a?>&step=9&stat=<?=$nst?>&uid=<?=$row->id?>">
                    	<img src="../images/actions/Light Bulb (<?=$status?>)_24x24.png" alt="Server is <?=$status?>" border="0" />                     </a> 
                     <a href="<?=$PHP_SELF?>?stats=<?=$row->id?>">
                     	<img src="../images/actions/View_24x24.png" alt="View Stats" border="0" />                     </a> 
                     <a onclick="return confirm('Are you sure you wish to delete this server?');" href="<?=$PHP_SELF?>?a=<?=$a?>&step=4&uid=<?=$row->id?>">
                     	<img src="../images/actions/Close_24x24.png" alt="Delete Server" border="0" />                     </a>                 </span>             </div>         </td>
      </tr>
      <?
	   $js_editable .= createEditableJS("server_name_".$row->id,"servers","name",$row->id).createEditableJS("server_link_".$row->id,"servers","link",$row->id);
		}
	}
	$a = $a_old;
	unset($a_old);
?>
    </table>
  </div>
</div>
<script>function load_editable(){<?=$js_editable?>} setTimeout('load_editable()',1200);</script>
<div id="b1" style="display:none">
    <div align="center"><br />
        <font size="4" face="Verdana, Arial, Helvetica, sans-serif">Add a Server</font><font face="Verdana, Arial, Helvetica, sans-serif"><br />
        </font></div>
  <form method=post onsubmit="return CheckInfo();" name=f1>
      <div align="center">
        <table width=397 align=center>
          <caption align=center>
          <br>
          <?=$up_error?></caption>
    

    <tr>
      <td width="189"><div align="right"><font size="2" face="Verdana, Arial, Helvetica, sans-serif">Server Name :</font></div></td>
	    <td width="196"><font size="2" face="Verdana, Arial, Helvetica, sans-serif">
	      <input type=text name="newserver" value="">
	    </font></td>
    </tr>
          
          
          <tr>
            <td><div align="right"><font size="2" face="Verdana, Arial, Helvetica, sans-serif">Server URL :</font></div></td>
            <td><font size="2" face="Verdana, Arial, Helvetica, sans-serif">
              <input type=text name="link">
            </font></td>
          </tr>
          <tr>
            <td><div align="right">Is This Server Active? </div></td>
	    <td><font size="2" face="Verdana, Arial, Helvetica, sans-serif">
	      <input name="isactive" type="radio" value="1" checked="checked">
	      Yes<br>
	      <input name="isactive" type="radio" value="0">
No	      </font></td>
    </tr>
          
      <tr>
        <td height="31"><div align="right">Total Bandwith:</div></td>
        <td><input name="total_bandwith" type="text" size="30"  /></td>
      </tr>
      <tr>
        <td height="32"><div align="right">Total File Storage Space:</div>          </td>
        <td><input name="space_limit" type="text" size="30"  /></td>
      </tr>
    <tr>
      <td colspan=2 align=center><font size="2" face="Verdana, Arial, Helvetica, sans-serif">
        <input type=submit name=s2 value="Add Server" class="sub1">	
        </font></td>
    </tr>
        </table>
      </div>
  </form>
</div>
    <?
	}
	include("admin/footer.php");
?>
