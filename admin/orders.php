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

$noMain = false;
if(isset($_GET['act']))
{
	$act = txt_clean($_GET['act']);
	$submit = (bool)($_POST['submit']);
	$id = intval($_GET['id']);
	switch($act)
	{
		case "approve":
			if(isset($_POST['massCheck']))
			{
				foreach($_POST['massCheck'] as $id)
				{
					$id = intval($id);
					$sql = "SELECT * FROM `transactions` WHERE `id` = '".$id."'";
					$user = $db->fetch($db->query($sql));
					$db->query("INSERT INTO `users` (`username`,`password`,`points`,`email`, `group`) VALUES ('".$user->username."','".md5($user->password)."','0','".$user->email."','".$user->group."')");
					$db->query("UPDATE `transactions` SET `approved` = '1', `result` = '1' WHERE `id` = '".$id."'");
					
					if(isValidEmail($user->email))
					{
						mail($user->email, $sitename.' - Account Activated', 
						$lang['paypal']['1'].$sitename.$lang['paypal']['2'].''."\n".'################### '."\n".''.$lang['paypal']['3'].$user->username.$lang['paypal']['4'].$user->password.' '."\n".'###################'."\n".''."\n".''.$lang['paypal']['5'].$sitename.$lang['paypal']['6'], "From: ".$sitename." <".$adminemail.">");
					}
					
					mail($adminemail, $sitename.' Account Activated (Admin Copy)', $lang['paypal']['1'].$sitename.$lang['paypal']['2'].''."\n".'################### '.$lang['paypal']['3'].$user->username.$lang['paypal']['4'].$user->password.''."\n".'###################'."\n".''."\n".''.$lang['paypal']['5'].$sitename.$lang['paypal']['6']);

				}
				$msg = 'Order(s) Approved, User(s) Created and Emails Dispatched!';
			}
			else
			{
				$sql = "SELECT * FROM `transactions` WHERE `id` = '".$id."'";
				$user = $db->fetch($db->query($sql));
				$db->query("INSERT INTO `users` (`username`,`password`,`points`,`email`, `group`) VALUES ('".$user->username."','".md5($user->password)."','0','".$user->email."','".$user->group."')");
				$db->query("UPDATE `transactions` SET `approved` = '1', `result` = '1' WHERE `id` = '".$id."'");
				
				if(isValidEmail($user->email))
				{
					mail($user->email, $sitename.' - Account Activated', 
					$lang['paypal']['1'].$sitename.$lang['paypal']['2'].''."\n".'################### '."\n".''.$lang['paypal']['3'].$user->username.$lang['paypal']['4'].$user->password.' '."\n".'###################'."\n".''."\n".''.$lang['paypal']['5'].$sitename.$lang['paypal']['6'], "From: ".$sitename." <".$adminemail.">");
				}
				
				mail($adminemail, $sitename.' Account Activated (Admin Copy)', $lang['paypal']['1'].$sitename.$lang['paypal']['2'].''."\n".'################### '.$lang['paypal']['3'].$user->username.$lang['paypal']['4'].$user->password.''."\n".'###################'."\n".''."\n".''.$lang['paypal']['5'].$sitename.$lang['paypal']['6']);
				
				$msg = 'Order Approved, User Created and Emails Dispatched!';
			}
		break;
		
		case "delete":
			if(isset($_POST['massCheck']))
			{
				print_r($_POST['massCheck']);
				foreach($_POST['massCheck'] as $ids)
				{
					$id = intval($id);
					$db->query("DELETE FROM `transactions` WHERE `id` = '".$ids."'");
					$i++;
					echo $ids."<br />";
				}
				$msg = $i.' Order(s) Deleted!';
			}
			else
			{
				$db->query("DELETE FROM `transactions` WHERE `id` = '".$id."'");
				$msg = 'Order Deleted!';
			}
		break;
		
		case "edit":
		if($submit)
		{
			$sql = 'UPDATE `transactions` SET `id` = \''.intval($_POST["id"]).'\'';
			foreach ($_POST as $key => $value)
			{
				if($key != 'submit')
				{
					$sql .= ', '."\n".'`'.mysql_real_escape_string($key).'` = \''.mysql_real_escape_string($value).'\'';
				}
			}
			$sql .= ' WHERE `id` = \''.intval($_POST["id"]).'\'';
			$db->query($sql);
			$msg = 'Order Edited!';
		}
		else
		{
		$order = $db->fetch($db->query("SELECT * FROM `transactions` WHERE `id` = '".intval($_GET['id'])."'"));
			?>
                <h1><span>Orders - Edit Order</span>XtraFile :: Admin Panel</h1>
<form id="form1" name="form1" method="post" action="./orders.php?act=edit">
			<input type="hidden" name="id" value="<?=intval($_POST['edit'])?>"  />
			<table width="600" border="0" align="center" cellpadding="3" cellspacing="0">
  <tr>
    <td><div align="right">Email</div></td>
    <td><input name="email" type="text" id="email" value="<?=$order->email?>"  /></td>
  </tr>
  <tr>
    <td><div align="right">Username</div></td>
    <td><input name="username" type="text" id="username" value="<?=$order->username?>"  /></td>
  </tr>
  <tr>
    <td><div align="right">Password</div></td>
    <td><input name="password" type="text" id="password" value="<?=$order->password?>"  /></td>
  </tr>
  <tr>
    <td><div align="right">Amount</div></td>
    <td><input name="amount" type="text" id="ammount" value="<?=$order->ammount?>"  /></td>
  </tr>
  <tr>
    <td><div align="right">Processor</div></td>
    <td><select name="processor">
	<? $ff = $db->query("SELECT * FROM payment WHERE status = '1'");
	while($gr = $db->fetch($ff,'obj'))
	{
	?>
	  <option <? if($order->processor == $gr->id){ ?>selected="selected"<? }?> value="<?=$gr->id?>"><?=$gr->f_name?></option>
	<? }?>
    </select>
    </td>
  </tr>
  <tr>
    <td><div align="right">Status</div></td>
    <td>
	<select name="result">
	  <option value="1" <? if($order->result == '1'){ ?>selected="selected"<? }?> style="color:green; font-weight:bold">Completed</option>
	  <option value="2" <? if($order->result == '2'){ ?>selected="selected"<? }?> style="color:orange; font-weight:bold">Pending</option>
	  <option value="0" <? if($order->result == '0'){ ?>selected="selected"<? }?> style="color:red; font-weight:bold">Failed</option>
    </select>
	</td>
  </tr>
  <tr>
    <td><div align="right">Group</div></td>
    <td><select name="group">
	<? $ff = $db->query("SELECT * FROM groups WHERE id != '1'");
	while($gr = $db->fetch($ff,'obj'))
	{
	?>
	  <option <? if($order->group == $gr->id){ ?>selected="selected"<? }?> value="<?=$gr->id?>"><?=$gr->name?></option>
	<? }?>
    </select></td>
  </tr>
  <tr>
    <td><div align="right"></div></td>
    <td><input name="submit" type="submit" id="submit" value="Add Order" /></td>
  </tr>
</table>
</form>
			<?
			$noMain = true;
			}
		break;
		
		case "new":
		if($submit)
		{
			$sql = 'INSERT INTO `transactions` SET id = NULL';
			foreach ($_POST as $key => $value)
			{
				if($key != 'submit')
				{
					$sql .= ', '."\n".'`'.mysql_real_escape_string($key).'` = \''.mysql_real_escape_string($value).'\'';
				}
			}
			$db->query($sql);
			$msg = 'Order Added!';
		}
		else
		{
			?>
            <h1><span>Orders - New Order</span>XtraFile :: Admin Panel</h1>
<form id="form1" name="form1" method="post" action="./orders.php?act=new">
			<table width="600" border="0" align="center" cellpadding="3" cellspacing="0">
  <tr>
    <td width="253"><div align="right">Name</div></td>
    <td width="335"><input name="name" type="text" id="name" /></td>
  </tr>
  <tr>
    <td><div align="right">Email</div></td>
    <td><input name="email" type="text" id="email" /></td>
  </tr>
  <tr>
    <td><div align="right">Username</div></td>
    <td><input name="username" type="text" id="username" /></td>
  </tr>
  <tr>
    <td><div align="right">Password</div></td>
    <td><input name="password" type="text" id="password" /></td>
  </tr>
  <tr>
    <td><div align="right">amount</div></td>
    <td><input name="amount" type="text" id="amount" /></td>
  </tr>
  <tr>
    <td><div align="right">Processor</div></td>
    <td><select name="processor">
	<? $ff = $db->query("SELECT * FROM payment WHERE status = '1'");
	while($gr = $db->fetch($ff,'obj'))
	{
	?>
	  <option value="<?=$gr->id?>"><?=$gr->f_name?></option>
	<? }?>
    </select>
    </td>
  </tr>
  <tr>
    <td><div align="right">Status</div></td>
    <td>
	<select name="result">
	  <option value="1" style="color:green; font-weight:bold">Completed</option>
	  <option value="2" style="color:orange; font-weight:bold">Pending</option>
	  <option value="0" style="color:red; font-weight:bold">Failed</option>
    </select>
	</td>
  </tr>
  <tr>
    <td><div align="right">Postdata</div></td>
    <td><input name="postdata" type="text" id="postdata" /></td>
  </tr>
  <tr>
    <td><div align="right">Group</div></td>
    <td><select name="group">
	<? $ff = $db->query("SELECT * FROM groups WHERE id != '1'");
	while($gr = $db->fetch($ff,'obj'))
	{
	?>
	  <option value="<?=$gr->id?>"><?=$gr->name?></option>
	<? }?>
    </select></td>
  </tr>
  <tr>
    <td><div align="right"></div></td>
    <td><input name="submit" type="submit" id="submit" value="Add Order" /></td>
  </tr>
</table>
</form>
			<?
			$noMain = true;
			}
		break;
		
	}
}

if(!$noMain)
{
?>
<h1><span>Order Management</span>XtraFile :: Admin Panel</h1>
<div class="actionsMenu">
    <a href="./orders.php?act=new">
        <div class="item">
        	<div class="img" style="background-image:url(../images/small/New.png);"></div>
            <div class="txt">Add</div>
        </div>
	</a>
    <a href="#" onclick="massForm.action = './orders.php?act=delete'; massForm.submit();">
        <div class="item">
        	<div class="img" style="background-image:url(../images/small/Close.png);"></div>
            <div class="txt">Delete</div>
        </div>
	</a>
    <a href="#" onclick="massForm.action = './orders.php?act=approve'; massForm.submit();">
        <div class="item">
        	<div class="img" style="background-image:url(../images/small/Ok.png);"></div>
            <div class="txt">Approve</div>
        </div>
	</a>
</div>
<br />
<? if($msg != ''){?>
<div id="msgBox" class="msgBox">
    <img class="okImg" src="../images/actions/OK_24x24.png" alt="Ok!"  />
    <span>
        <?=$msg?>
    </span>
    <a href="javascript:;" onclick="hideMsgBox();">
        <img class="closeImg" src="../images/small/Close.png" alt="Close"  />
    </a>
</div>
<? }?>
<br />
<form method="post" id="massForm">
<table id="mainTable" width="849" style="border:#000 thin solid" border="0" cellpadding="2" cellspacing="0" align="center">
  <tr>
    <th style="border-right:1px #000000 solid;" width="27"><input type="checkbox" name="mass" value="" onchange="if(this.checked){$('input[@type=checkbox]','#mainTable').attr('checked','checked');}else{$('input[@type=checkbox]','#mainTable').attr('checked','');}" /></th>
    <th width="27">#</th>
    <th width="256">Email</th>
    <th width="103">amount</th>
    <th width="95">Processor</th>
    <th width="162">Status</th>
    <th width="138">Actions</th>
  </tr>
  <? 
  $f1 = $db->query("SELECT * FROM `transactions` ORDER BY `id`");
  while($order = $db->fetch($f1,'obj'))
  {?>
  <tr style="background-color:#<? if($order->result == '0'){echo 'EC4642';}else if($order->result == '1'){echo '66FF33';}else if($order->result == '2'){echo 'FFFF66';}?>" onmouseover="this.style.backgroundColor = '#C1DEF0'" onmouseout="this.style.backgroundColor = '#<? if($order->result == '0'){echo 'EC4642';}else if($order->result == '1'){echo '66FF33';}else if($order->result == '2'){echo 'FFFF66';}else{echo "";} ?>' ">
    <td style="border-right:1px #000000 solid;"><div align="center"><input name="massCheck[]" type="checkbox" value="<?=$order->id?>" /></div></td>
    <td><div align="center"><?=$order->id?></div></td>
	<td><div align="center"><?=$order->email?></div></td>
	<td><div align="center">$<?=$order->amount?> USD</div></td>
    <td><div align="center"><? $sql = "SELECT * FROM `payment` WHERE `id` = '".$order->processor."'";$d2 = $db->fetch($db->query($sql)); echo $d2->f_name?></div></td>
    <td><div align="center"><? 
	
	if($order->result == '1')
	{
	    echo "Completed";
	}
	else if($order->result == '2')
	{
	    echo "Pending";
	}
	else if($order->result == '0')
	{
	  
	    echo "Failed";
	}
	
	?></div></td>
    <td><table align="center">
	  <tr>
						<td height="26">
							<a href='./orders.php?act=edit&amp;id=<?=$order->id?>'>
								<img border='0' id='edit_".$i1."' alt='Edit Order' src='../images/actions/Edit_24x24.png' />							</a>						</td>
<? if($order->approved != '1'){?>
                            <td>
                                <a href='./orders.php?act=approve&amp;id=<?=$order->id?>' onclick='return confirm("Are You Sure You Want To Approve This Order?");'>
                                    <img border='0' id='delete_".$i1."' alt='Approve File' src='../images/actions/Checkmark_24x24.png' />                                </a>                            </td>
<? }?>
						<td>
							<a href='./orders.php?act=delete&amp;id=<?=$order->id?>' onclick='return confirm("Are You Sure You Want To Delete This Order?");'>
								<img border='0' id='delete_".$i1."' alt='Delete File' src='../images/actions/Close_24x24.png' />							</a>						</td>
		</tr>
	  </table></td>
  </tr>
  <? }?>
</table>
</form>
<script>
var massForm = $('#massForm').get(0);
function hideMsgBox()
{
	$('#msgBox').slideUp('normal');
}
<? if(strlen($msg)){?>
setTimeout('hideMsgBox()', 20000);
<? }?>
</script>
<?
}
require_once("./admin/footer.php");
?>