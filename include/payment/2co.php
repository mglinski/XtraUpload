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
	function callback($gateway)
	{
		global $db, $lang;
 		
		if (isset($_POST['cart_order_id']))
		{
			// Lookup the order details
			$id = intval($_POST['cart_order_id']);
			$trans = $db->fetch($db->query("SELECT * FROM `transactions` WHERE id = '".$id."'"));
			$pay = $db->fetch($db->query("SELECT * FROM `payment` WHERE `id` = '".$trans->processor."'"));
			
			switch ($_POST['credit_card_processed'])
			{
				case 'Y':					
					$pay = $db->fetch($db->query("SELECT * FROM payment WHERE id = '".intval($_POST['gate'])."'"),'obj');
					$custom = urlencode($kernel->crypt->process($_POST['custom'],'decrypt'));
					$custom = explode('|',$custom);
					// Did they pay the right amount?
					if ($pay->price == $_POST['total'])
					{							
						$db->query("UPDATE `transactions` SET `result` = '1',`approved` = '1' WHERE  `id` = '".$id."'");
										
						$sql = "SELECT * FROM `groups` WHERE `id` = '".$trans->group."'";
						$group = $db->fetch($db->query($sql));
						
						$sec = $group->expire * 24 * 3600;
						
						$db->query("INSERT INTO `users` ( `username`, `password`, `email`, `time`, `group`) values ('".txt_clean($trans->username)."', '".md5($trans->password)."',  '".txt_clean($trans->email)."', '".(int)(time()+$sec)."', '".txt_clean($trans->group)."')");
						
						mail($trans->email, $sitename.' Account Activated', $lang['paypal']['1'].$sitename.$lang['paypal']['2'].''."\n".'################### '."\n".''.$lang['paypal']['3'].$trans->username.$lang['paypal']['4'].$trans->password.' '."\n".'###################'."\n".''."\n".''.$lang['paypal']['5'].$sitename.$lang['paypal']['6']);
			
						mail($adminemail, $sitename.' Account Activated (Admin Copy)', $lang['paypal']['1'].$sitename.$lang['paypal']['2'].''."\n".'################### '.$lang['paypal']['3'].$trans->username.$lang['paypal']['4'].$trans->password.''."\n".'###################'."\n".''."\n".''.$lang['paypal']['5'].$sitename.$lang['paypal']['6']);
					}
					else // No
					{							
						$msg_subject = 'Payment Gateway Event';
						$msg = "Hello,\n\nDuring a payment gateway callback (2checkout), the following occurred:\n\n- Incorrect amount paid. Paid: ".
						$_POST['total']." Expected: ".$pay->paid.". Order ID ".$order['id']."\n\nYou may wish to investigate.\n\nXtraUpload - ".$siteurl;
							
						mail($adminemail,$msg_subject,$msg,'From: '.$sitename.' <'.$adminemail.'>');
					
					}
					
					break;
					case 'K':					
									
					// Error Mail
					$msg_subject = 'Payment Gateway Event';
					$msg = "Hello,\n\nDuring a payment gateway callback (2checkout), the following occurred:\n\n- Payment status: pending. \n\nThank you.\n\nXtraUpload - ".$siteurl;
								
					mail($adminemail,$msg_subject,$msg,'From: '.$sitename.' <'.$adminemail.'>');
					break;
				}

		}		
		
		// Redirect user
		header('Location: '.makeXuLink('index.php','p=home'));
	}
	
	function link()
	{
	
		global $db,$siteurl, $lang;
		$time = time();
		$pay = $db->fetch($db->query("SELECT * FROM `payment` WHERE id = '".intval($_POST['gate'])."'"));
		$group = $db->fetch($db->query("SELECT * FROM `groups` WHERE id = '".intval($_POST['group'])."'"));
		
		$sql = "INSERT INTO `transactions` SET `username` = '".$this->username."', `password` = '".$this->pass."', `email` = '".$this->email."', `group` = '".intval($_POST['group'])."', `ammount` = '".$group->price."', `processor` = '".intval($_POST['gate'])."', `result` = '2', `notes` = 'Transaction Is Pending User Action', `approved` = '0'";
		$db->query($sql);
		$id = mysql_insert_id();
						
		$link  = 'https://www.2checkout.com/2co/buyer/purchase/?&sid='.$pay->sell_id;
		$link .= '&total='.number_format($group->price, 2, '.', '');	
		$link .= '&merchant_order_id='.$id;	
		$link .= '&cart_order_id='.$id;
		$link .= '&fixed=Y';
		$link .= '&return_url='.urlencode($siteurl.'index.php?p=ipn&gateway='.$pay->id);			
		$link .= '&product_id1='.$pay->cart_id;
		$link .= '&quantity1=1';			
		
		$form = '<form method="post" action="'.$link.'" id="paypal_co"><p><input type="submit" name="submit" value="'.$lang['2co']['7'].'" /></p></form>';
		return $form;
	
	}
}
?>