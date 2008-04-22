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


$step = intval($_REQUEST['step']);
$uid = intval($_REQUEST['uid']);
$stat = intval($_REQUEST['stat']);

if (!$step)
{
$step = 1;
}
$display_block = true;
switch($step){

		
	case "9":// delete users
		
		$qry2 = $db->query("SELECT * FROM payment  WHERE id = '".$uid."' ");
		$res = $db->fetch($qry2,'obj');
		$db->query("UPDATE payment  SET status='".$stat."' WHERE id = '".$uid."' ");
		log_action('Payment Processor('.$res->f_name.') Status Changed', 'server:new', 'Payment Processor('.$res->f_name.') Status was Changed', 'ok', 'admin/pay.php');
		$display_block = false;
		
	break;
		
	default:// user index
	// Nothing to do here
	break;
	
}

if($_POST['submit'] == 'Update')
{
	$db->query("UPDATE payment 
	SET
	f_name = '$_POST[f_name]',
	sell_id = '$_POST[sell_id]',
	address = '$_POST[address]'
	WHERE 
	id = '".intval($_GET['pay'])."' ");
	log_action('Payment Processor Updated', 'server:new', 'Payment Processor was updated', 'ok', 'admin/pay.php');
}

?>

<h1><span>Gateway Manager</span>XtraFile :: Admin Panel</h1>
<div style=" border-width:thin; border-color:#000000">
<div align="center">
  <?

	if($_REQUEST['edit'] && $_POST['submit'] != 'Update')
	{
		$a = $db->fetch($db->query('SELECT * FROM payment WHERE id = \''.intval($_GET['pay']).'\' '),'obj');
	?>
  <a href="pay.php"><strong>Back To Overview</strong></a>
  <form method="post" >
    <table width="604" border="0" align="center" cellpadding="4" cellspacing="0">
      <tr>
        <td width="204"><div align="right">Gateway User ID/Email: </div></td>
        <td width="384"><input type="text" name="sell_id" value="<?=$a->sell_id?>" />
          ( Email address for paypal ) </td>
      </tr>
      <tr>
        <td><div align="right">Custom Name: </div></td>
        <td><input type="text" name="f_name" value="<?=$a->f_name?>" />
          ( Custom Display Name ) </td>
      </tr>
      <tr>
        <td><div align="right">Address/Payment Instructions: </div></td>
        <td><textarea name="address" rows="4" id="address"><?=$a->address?>
</textarea>
          ( ONLY for Check/Moneyorder )</td>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td><input name="submit" type="submit" id="submit" value="Update" /></td>
      </tr>
    </table>
  </form>
  <?
	
	}
	else
	{
	
	?>
</div>
<div id="a1">
  <div align="center">
    <table width=450 border='0' align="center" cellPadding=4 cellSpacing=0 style=" border:#000000 solid 1px;">
      <TR>
        <th width="49%" align=center class='a1'>Gateway Name</th>
        <th width="26%" align=center class='a1'>Status</th>
      <th width="25%" align=center class='a1'>Actions</th>      
      </tr>
      <?

	$a_old = $a;
	unset($a);
	$sql3 = "SELECT * FROM `payment` ";
	$result1 = $db->query($sql3);
	if ($result1){
		while( $row = $db->fetch($result1,'obj') )
		{
		
			if($row->status == '1')
			{
				$nst=0;
				$status = "On";
			}
			else
			{
				$nst=1;
				$status = "Off";
			}
?>
      <tr style='background-color:' onmouseover="this.style.backgroundColor = '#C1DEF0';" onmouseout="this.style.backgroundColor = '';">
        <td class='a1'><div align="center">
            <?=$row->f_name?>
            </font></div></td>
        <td class='a1'>
        	<div align="center">
        		<a href="<?=$PHP_SELF?>?a=<?=$a?>&step=9&stat=<?=$nst?>&uid=<?=$row->id?>">
					<img border='0' alt='Gateway <?=$status?>'  src='../images/actions/Light Bulb (<?=$status?>)_24x24.png' />
        		</a>
        	</div>
        </td>
        <td class='a1'>
       		<div align="center">
       			<a href="<?=$PHP_SELF?>?edit=true&pay=<?=$row->id?>">
                	<img border='0' alt='Edit Gateway' src='../images/actions/Edit_24x24.png' />
                </a>
       		</div>
        </td>
      </tr>
      <?
		}
	}
	$a = $a_old;
	unset($a_old);
?>
    </table>
  </div>
</div>
<?
	}
include("admin/footer.php");
?>
