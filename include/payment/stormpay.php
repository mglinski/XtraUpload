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
		$id = $_POST['transaction_ref'];
		$trans = $db->fetch($db->query("SELECT * FROM `transactions` WHERE id = '".$id."'"));
		$pay = $db->fetch($db->query("SELECT * FROM `payment` WHERE `id` = '".$trans->processor."'"));
		
		if (isset($_POST['transaction_ref']))
		{
			
			if ($trans->id == $_POST['transaction_ref'])
			{			
				
				switch ($_POST['status'])
				{
					case 'SUCCESS':					
						$db->query("UPDATE `transactions` SET `result` = '1',`approved` = '1' WHERE  `id` = '".$id."'");
						
						$sql = "SELECT * FROM `groups` WHERE `id` = '".$trans->group."'";
						$group = $db->fetch($db->query($sql));
						
						$sec = $group->expire * 24 * 3600;
						
						$db->query("INSERT INTO `users` ( `username`, `password`, `email`, `time`, `group`) values ('".txt_clean($trans->username)."', '".md5($trans->password)."',  '".txt_clean($trans->email)."', '".(int)(time()+$sec)."', '".txt_clean($trans->group)."')");
						
						mail($trans->email, $sitename.' Account Activated', $lang['paypal']['1'].$sitename.$lang['paypal']['2'].''."\n".'################### '."\n".''.$lang['paypal']['3'].$trans->username.$lang['paypal']['4'].$trans->password.' '."\n".'###################'."\n".''."\n".''.$lang['paypal']['5'].$sitename.$lang['paypal']['6']);

						mail($adminemail, $sitename.' Account Activated (Admin Copy)', $lang['paypal']['1'].$sitename.$lang['paypal']['2'].''."\n".'################### '.$lang['paypal']['3'].$trans->username.$lang['paypal']['4'].$trans->password.''."\n".'###################'."\n".''."\n".''.$lang['paypal']['5'].$sitename.$lang['paypal']['6']);
					break;
					case 'REFUND':			
						$db->query("UPDATE `transactions` SET `result` = '0', `notes` = '".$reversal_reason."' WHERE  `id` = '".$id."'");
						$db->query("DELETE FROM `users` WHERE `email` = '".$trans->email."'");		
						$message .= '-> payment > status: refunded '."\n";
						$msg_to = $adminemail;
						$msg_subject = 'Payment Gateway Event';
						$msg = "Hello,\n\nDuring a payment gateway callback (PayPal), the following occurred:\n\n- Payment status: refunded. Order ID ".$id."\n\nYou may wish to investigate into why this happened.\n\nXtraUpload -> ".$siteurl;
							
						mail($msg_to,$msg_subject,$msg,'From: '.$sitename.' <'.$adminemail.'>');						
					break;
					case 'CHARGEBACK':					
						// Insert into transaction table
						$db->query("UPDATE `transactions` SET `result` = '0', `notes` = 'Payment Reversed and Account Deleted. Reason: ".$reversal_reason."' WHERE  `id` = '".$id."'");
						$db->query("DELETE FROM `users` WHERE `email` = '".$trans->email."'");
						// Error Mail
						
						
						$msg_to = $adminemail;
							
						$msg_subject = 'Payment Gateway Event';
						$msg = "Hello,\n\nDuring a payment gateway callback (StormPay), the following occurred:\n\n- Payment status: reversed (".$reversal_reason."). Order ID ".$trans->id."\n\nYou may wish to investigate into why this happened.\n\nXtraUpload -> ".$siteurl;
							
						mail($msg_to,$msg_subject,$msg,'From: '.$sitename.' <'.$adminemail.'>');							
						break;											
					break;
				}
			}
			else
			{
				
			}
			
			header("HTTP/1.1 202 Accepted");
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
		
		// Guide at https://www.stormpay.com/stormpay/user/glc_integration_manual.html
		$item_name = urlencode(ucfirst($group->name).' Package, '.$sitename.' (Order '.$id.')');

		// Build form
		$form = '<form method="post" action="https://www.stormpay.com/stormpay/handle_gen.php">';
		$form .= '<p><input type="hidden" name="generic" value="1" />';
		$form .= '<input type="hidden" name="transaction_ref" value="'.$id.'" />';
		$form .= '<input type="hidden" name="payee_email" value="'.$pay->sell_id.'" />';
		$form .= '<input type="hidden" name="product_name" value="'.$item_name.'" />';
		$form .= '<input type="hidden" name="require_IPN" value="1" />';
		$form .= '<input type="hidden" name="subject_matter" value="'.$item_name.'" />';
		$form .= '<input type="hidden" name="amount" value="'.$group->price.'" />';
		$form .= '<input type="submit" name="Submit" value="Pay now with StormPay" /></p></form>';
		return $form;
	}
}
?>