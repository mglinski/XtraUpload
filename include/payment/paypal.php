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
		
		//SANDBOX ACCESS, FOR TESTING ONLY!
		$useSandbox = false;
		
		// Read the post from PayPal system and add 'cmd'
		$req = 'cmd=_notify-validate';
		
		foreach ($_POST as $key => $value) 
		{
			$value = urlencode(stripslashes($value));
			$req .= "&$key=$value";
		}

		// Post back to PayPal system to validate
		$header .= "POST /cgi-bin/webscr HTTP/1.0\r\n";
		$header .= "Content-Type: application/x-www-form-urlencoded\r\n";
		$header .= "Content-Length: " . strlen($req) . "\r\n\r\n";
		$url = 'www.paypal.com';
		if($useSandbox)
		{
			$url = 'sandbox.paypal.com';
		}
		$fp = fsockopen($url, 80, $error_no, $error_msg, 30);
		
		$message = 'Start paypal IPN Log '."\n";
		
		$id = intval($_POST['item_number']);
		$trans = $db->fetch($db->query("SELECT * FROM `transactions` WHERE id = '".$id."'"));
		$pay = $db->fetch($db->query("SELECT * FROM `payment` WHERE `id` = '".$trans->processor."'"));
		
		if (isset($_POST['item_number']) && !empty($_POST['item_number']))
		{
			if (!$fp) 
			{
				$message .= '-> http error: '.$error_msg."\n";
				// Error Mail
				$msg_to = $adminemail;				
				$msg_subject = 'Payment Gateway Event';
				$msg = "Hello,\n\nDuring a payment gateway callback (PayPal), the following occurred:\n\n".$error_msg."\n\nYou may wish to investigate into why this happened.\n\nXtraUpload -> ".$siteurl;
				
				mail($msg_to,$msg_subject,$msg,'From: '.$sitename.' <'.$adminemail.'>');
			} 
			else 
			{	
				$message .= '-> processing callback '."\n";
				
				if ($_POST['receiver_email'] != $pay->sell_id)
				{
					$message .= '-> receiver_email does not match ';
					$msg = "Hello,\n\nDuring a payment gateway callback (PayPal), the following occurred:\n\n- Receiver e-mail (".$_POST['receiver_email'].") did not match the PayPal e-mail address (".$pay->sell_id.") set in the XtraUpload settings (order ID ".$_POST['item_number'].")\n\nYou may wish to investigate into why this happened.\n\nXtraUpload -> ".$siteurl;
									
					mail($adminemail, 'Payment Gateway Event' ,$msg,'From: '.$sitename.' <'.$adminemail.'>');
				}
				else
				{
					fputs ($fp, $header . $req);
					while (!feof($fp)) 
					{
						$res = fgets ($fp, 1024);
						if (strcmp ($res, 'VERIFIED') == 0) 
						{
							$message .= '-> callback status '."\n";
							// Payment status
							switch ($_POST['payment_status'])
							{
								case 'Completed':					
									$message .= '-> payment > status: completed '."\n";													
									
									// Did they pay the right amount?
									if ($trans->ammount == $_POST['mc_gross'])
									{
										if($trans->approved != '1' && $trans->result != '1')
										{
											$db->query("UPDATE `transactions` SET `result` = '1',`approved` = '1' WHERE  `id` = '".$id."'");
											
											$sql = "SELECT * FROM `groups` WHERE `id` = '".$trans->group."'";
											$group = $db->fetch($db->query($sql));
											
											$sec = $group->expire * 24 * 3600;
											
											$db->query("INSERT INTO `users` ( `username`, `password`, `email`, `time`, `group`) values ('".txt_clean($trans->username)."', '".md5($trans->password)."',  '".txt_clean($trans->email)."', '".(int)(time()+$sec)."', '".txt_clean($trans->group)."')");
											
											mail($trans->email, $sitename.' Account Activated', $lang['paypal']['1'].$sitename.$lang['paypal']['2'].''."\n".'################### '."\n".''.$lang['paypal']['3'].$trans->username.$lang['paypal']['4'].$trans->password.' '."\n".'###################'."\n".''."\n".''.$lang['paypal']['5'].$sitename.$lang['paypal']['6']);
				
											mail($adminemail, $sitename.' Account Activated (Admin Copy)', $lang['paypal']['1'].$sitename.$lang['paypal']['2'].''."\n".'################### '.$lang['paypal']['3'].$trans->username.$lang['paypal']['4'].$trans->password.''."\n".'###################'."\n".''."\n".''.$lang['paypal']['5'].$sitename.$lang['paypal']['6']);
										}
										else
										{
										
										}
										
									}
									else // No
									{
										$message .= '-> payment > incorrect amount paid '."\n";
										
										// Error Mail
										$msg_to = $adminemail;
										$msg_subject = 'Payment Gateway Event';
										$msg = "Hello,\n\nDuring a payment gateway callback (PayPal), the following error(s) occurred:\n\n- Incorrect amount paid. Paid: ".$_POST['mc_gross']." Expected: ".$trans->price."\n\nYou may wish to investigate into why this happened.\n\nXtraUpload -> ".$siteurl;
										
										mail($msg_to,$msg_subject,$msg,'From: '.$sitename.' <'.$adminemail.'>');
									}
									break;
								case 'Denied':					
									$message .= '-> payment > status: denied '."\n";
									
									$msg_to = $adminemail;
										
									$msg_subject = 'Payment Gateway Event';
									$msg = "Hello,\n\nDuring a payment gateway callback (PayPal), the following occurred:\n\n- Payment status: denied. Order ID ".$id."\n\nYou may wish to investigate into why this happened.\n\nXtraUpload -> ".$siteurl;
										
									mail($msg_to,$msg_subject,$msg,'From: '.$sitename.' <'.$adminemail.'>');
									break;
								case 'Failed':					
									$message .= '-> payment > status: failed '."\n";
									
									// Insert into transaction table
									$database->query('INSERT INTO '.$database->prefix.'transactions {data}', 'INSERT', array('gateway_id' => $gateway['id'], 'status' => 'Payment: Failed', 'user_id' => $order['user_id'], 'order_id' => $id, 'trans_id' => $_POST['txn_id'], 'timestamp' => time(), 'amount' => $_POST['mc_gross'].$_POST['mc_currency']));													
									
									// Error Mail
									
									
									$msg_to = $adminemail;
										
									$msg_subject = 'Payment Gateway Event';
									$msg = "Hello,\n\nDuring a payment gateway callback (PayPal), the following occurred:\n\n- Payment status: failed. Order ID ".$id."\n\nYou may wish to investigate into why this happened.\n\nXtraUpload -> ".$siteurl;
										
									mail($msg_to,$msg_subject,$msg,'From: '.$sitename.' <'.$adminemail.'>');
									break;
								case 'Pending':
									$message .= '-> payment > status: pending '."\n";
									
									// Set statuses
									// Convert PayPal 'pending_reason' to English
									switch ($_POST['pending_reason'])
									{
										case 'address':
											$pending_reason = 'Customer address is not confirmed. The payment must be manually accepted.';
											break;
										case 'echeck':
											$pending_reason = 'Payment was made using a eCheck which has not yet cleared.';
											break;
										case 'intl':
											$pending_reason = 'The payment must be manually accepted.';
											break;
										case 'multi_currency':
											$pending_reason = 'Payment is in foreign currency. The payment must be manually accepted.';
											break;
										case 'unilateral':
											$pending_reason = 'Payment was made to an uncofirmed e-mail address.';
											break;
										case 'upgrade':
											$pending_reason = 'The Merchant PayPal account cannot accept this payment on the current account type.';
											break;
										case 'other':
											$pending_reason = 'Unknown reason. Contact PayPal Customer Services.';
											break;
										default:
											$pending_reason = 'Unknown reason. Contact PayPal Customer Services.';
											break;
									}													
									
									// Error Mail
									$db->query("UPDATE `transactions` SET `result` = '2', `notes` = '".$pending_reason."' WHERE  `id` = '".$id."'");
									
									$msg_to = $adminemail;
										
									$msg_subject = 'Payment Gateway Event';
									$msg = "Hello,\n\nDuring a payment gateway callback (PayPal), the following ccurred:\n\n- Payment status: pending (".$pending_reason."). Order ID ".$id."\n\nYou may wish to investigate into why this happened.\n\nXtraUpload -> ".$siteurl;
										
									mail($msg_to,$msg_subject,$msg,'From: '.$sitename.' <'.$adminemail.'>');
									break;
								case 'Refunded':					
									$message .= '-> payment > status: refunded '."\n";
									$db->query("UPDATE `transactions` SET `result` = '0', `notes` = '".$reversal_reason."' WHERE  `id` = '".$id."'");
									$db->query("DELETE FROM `users` WHERE `email` = '".$trans->email."'");
									
									$msg_to = $adminemail;
										
									$msg_subject = 'Payment Gateway Event';
									$msg = "Hello,\n\nDuring a payment gateway callback (PayPal), the following occurred:\n\n- Payment status: refunded. Order ID ".$id."\n\nYou may wish to investigate into why this happened.\n\nXtraUpload -> ".$siteurl;
										
									mail($msg_to,$msg_subject,$msg,'From: '.$sitename.' <'.$adminemail.'>');
									break;
								case 'Reversed':					
									$message .= '-> payment > status: reversed '."\n";
									
									// Set statuses
									// Convert PayPal 'reason_code' to English
									switch ($_POST['reason_code'])
									{
										case 'buyer_complaint':
											$reversal_reason = 'The customer has complained.';
											break;
										case 'chargeback':
											$reversal_reason = 'The customer has issued a chargeback.';
											break;
										case 'guarantee':
											$reversal_reason = 'The customer has triggered a money back guarantee.';
											break;
										case 'refund':
											$reversal_reason = 'The customer was refunded.';
											break;
										case 'refund':
											$reversal_reason = 'Unknown reason. Contact PayPal Customer Services.';
											break;
										default:
											$reversal_reason = 'Unknown reason. Contact PayPal Customer Services.';
											break;
									}
									
									// Insert into transaction table
									$db->query("UPDATE `transactions` SET `result` = '0', `notes` = '".$reversal_reason."' WHERE  `id` = '".$id."'");
									$db->query("DELETE FROM `users` WHERE `email` = '".$trans->email."'");
									
									// Error Mail
									
									
									$msg_to = $adminemail;
										
									$msg_subject = 'Payment Gateway Event';
									$msg = "Hello,\n\nDuring a payment gateway callback (PayPal), the following occurred:\n\n- Payment status: reversed (".$reversal_reason."). Order ID ".$id."\n\nYou may wish to investigate into why this happened.\n\nXtraUpload -> ".$siteurl;
										
									mail($msg_to,$msg_subject,$msg,'From: '.$sitename.' <'.$adminemail.'>');							
									break;				
							}
						}
						else if (strcmp ($res, 'INVALID') == 0) 
						{
							$message .= '-> invalid callback '."\n";
						}
					}
					$message .= '-> completed callback '."\n";
					fclose ($fp);
				}
			}
		}
	}
	
	function link()
	{
		/*
		*** PayPal Parameters ***
		* subscriptions/business= (subscription)
		* or
		* xclick/business= (one time)
		* &item_name= (item name)
		* &item_number= (aitem number)
		* &currency_code=GBP (currency code)
		* &a1=99.99 (first payment total)
		* &p1=1 (next payment in x y) (x)
		* &t1=Y (next payment in x y) (y) (e.g. &p1=1&t1=Y means next payment in 1 year)
		* &a3=39.99 (next payment total)
		* &p3=1 (recurring x y) (x)
		* &t3=Y (recurring x y) (y) (e.g. &p3=1&t3=Y means next payment in 1 year)
		* &src=1
		* &sra=1
		* &srt=5 (billing continues for x cycles then stops)
		*/
		
		global $db, $itemname, $sitename, $siteurl, $lang;
		$time = time();
		$pay = $db->fetch($db->query("SELECT * FROM `payment` WHERE id = '".intval($_POST['gate'])."'"));
		$group = $db->fetch($db->query("SELECT * FROM `groups` WHERE id = '".intval($_POST['group'])."'"));
		
		$sql = "INSERT INTO `transactions` SET `username` = '".$this->username."', `password` = '".$this->pass."', `email` = '".$this->email."', `group` = '".intval($_POST['group'])."', `ammount` = '".$group->price."', `processor` = '".intval($_POST['gate'])."', `result` = '2', `notes` = 'Transaction Is Pending User Action', `approved` = '0'";
		$db->query($sql);
		$id = mysql_insert_id();
		
		$form = '<p><form method="post" action="https://www.paypal.com/" id="paypal_co">'."\n";
		$form .= '<input type="hidden" name="business" value="'.$pay->sell_id.'" />'."\n";
		$form .= '<input type="hidden" name="amount" value="'.$group->price.'">'."\n";
		$form .= '<input type="hidden" name="item_name" value="'.ucfirst($group->name).' Package, Order '.$id.' ('.$sitename.')" />'."\n";
		$form .= '<input type="hidden" name="item_number" value="'.$id.'" />'."\n";
		$form .= '<input type="hidden" name="currency_code" value="USD" />'."\n";
		$form .= '<input type="hidden" name="cbt" value="Confirm Purchase">'."\n";
		$form .= '<input type="hidden" name="no_shipping" value="1">'."\n";
		$form .= '<input type="hidden" name="notify_url" value="'.$siteurl.'ipn.php?gateway='.$pay->id.'" />'."\n";		
		$form .= '<input type="hidden" name="cmd" value="_xclick" />'."\n";
		$form .= '<input type="hidden" name="custom" value="id='.$id.'">'."\n";
		$form .= '<input type="hidden" name="return" value="'.$siteurl.'">'."\n";
		$form .= '<input style="font-size:16px" type="submit" name="Submit" value="'.$lang['paypal']['7'].'" /></p></form>'."\n";
		return $form;
	}
}
?>