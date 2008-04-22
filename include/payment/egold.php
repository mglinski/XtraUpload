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
class gate
{
	var $username;
	var $pass;
	var $email;

	function gate($name,$pass,$email)
	{
		$this->username = txt_clean($name);
		$this->pass = txt_clean($pass);
		$this->email = txt_clean($email);
	}
	
	function callback()
	{
		global $db, $lang, $sitename, $adminemail;
		$id = $_POST['PAYMENT_ID'];
		$trans = $db->fetch($db->query("SELECT * FROM `transactions` WHERE id = '".$id."'"));
		$pay = $db->fetch($db->query("SELECT * FROM `payment` WHERE `id` = '".$trans->processor."'"));

		if (isset($_POST['PAYMENT_ID']))
		{
			
			if ($id == $_POST['PAYMENT_ID'])
			{			

				switch ($_REQUEST['status'])
				{
					case 1:			
						if($_POST['PAYMENT_AMOUNT'] != $trans->ammount)
						{
							$db->query("UPDATE `transactions` SET 'Batch ID: ".$_POST['PAYMENT_BATCH_NUM'].", Wrong Ammount Paid for account requested...' WHERE  `id` = '".$id."'");
							break;
						}		
						$db->query("UPDATE `transactions` SET `result` = '1',`approved` = '1', `notes` = 'Batch ID: ".$_POST['PAYMENT_BATCH_NUM']."' WHERE  `id` = '".$id."'");
						
						$sql = "SELECT * FROM `groups` WHERE `id` = '".$trans->group."'";
						$group = $db->fetch($db->query($sql));
						
						$sec = $group->expire * 24 * 3600;
						
						$db->query("INSERT INTO `users` ( `username`, `password`, `email`, `time`, `group`) values ('".txt_clean($trans->username)."', '".md5($trans->password)."',  '".txt_clean($trans->email)."', '".(int)(time()+$sec)."', '".txt_clean($trans->group)."')");
						
						mail($trans->email, $sitename.' Account Activated', $lang['paypal']['1'].$sitename.$lang['paypal']['2'].''."\n".'################### '."\n".''.$lang['paypal']['3'].$trans->username.$lang['paypal']['4'].$trans->password.' '."\n".'###################'."\n".''."\n".''.$lang['paypal']['5'].$sitename.$lang['paypal']['6']);

						mail($adminemail, $sitename.' Account Activated (Admin Copy)', $lang['paypal']['1'].$sitename.$lang['paypal']['2'].''."\n".'################### '.$lang['paypal']['3'].$trans->username.$lang['paypal']['4'].$trans->password.''."\n".'###################'."\n".''."\n".''.$lang['paypal']['5'].$sitename.$lang['paypal']['6']);
					break;
					case 2:					

						// Error Mail
						mail($adminemail, 'eGold Payment Cancelled', "Hello,\n\nDuring the e-gold payment process for order #".$trans->id.", the customer cancelled their order and did not complete payment.\n\nYou may wish to investigate.\n\n", 'From: '.$adminemail);
						break;
				}
			}
			else
			{
				
			}
			
			header('Location: '.$siteurl);
		}
	}
	
	function link()
	{
		global $db, $itemname, $sitename, $siteurl, $lang;
		$time = time();
		$pay = $db->fetch($db->query("SELECT * FROM `payment` WHERE id = '".intval($_POST['gate'])."'"));
		$group = $db->fetch($db->query("SELECT * FROM `groups` WHERE id = '".intval($_POST['group'])."'"));
		
		$sql = "INSERT INTO `transactions` SET `username` = '".$this->username."', `password` = '".$this->pass."', `email` = '".$this->email."', `group` = '".intval($_POST['group'])."', `ammount` = '".$group->price."', `processor` = '".intval($_POST['gate'])."', `result` = '2', `notes` = 'Transaction Is Pending User Action', `approved` = '0'";
		$db->query($sql);
		$id = mysql_insert_id();
		
		$item_name = urlencode(ucfirst($group->name).' Package, '.$sitename.' (Order '.$id.')');
		
		$form = '<form method="post" action="https://www.e-gold.com/sci_asp/payments.asp">';
		$form .= '<p><input type="hidden" name="PAYEE_ACCOUNT" value="'.$pay->gate_id.'" />';
		$form .= '<input type="hidden" name="PAYEE_NAME" value="'.$sitename.'" />';
		$form .= '<input type="hidden" name="PAYMENT_AMOUNT" value="'.number_format($group->price, 2, '.', '').'" />';
		$form .= '<input type="hidden" name="PAYMENT_UNITS" value="1" />';
		$form .= '<input type="hidden" name="PAYMENT_METAL_ID" value="0" />';
		$form .= '<input type="hidden" name="PAYMENT_ID" value="'.$id.'" />';
		$form .= '<input type="hidden" name="PAYMENT_URL" value="'.$siteurl.'ipn.php" />';
		$form .= '<input type="hidden" name="NOPAYMENT_URL" value="'.$siteurl.'" />';
		$form .= '<input type="hidden" name="SUGGESTED_MEMO" value="'.$item_name.'" />';
		$form .= '<input type="hidden" name="BAGGAGE_FIELDS" value="" />';
		$form .= '<input type="submit" name="Submit" value="Pay now with eGold!" /></p></form>';
		
		return $form;
	}
}
?>