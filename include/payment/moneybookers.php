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
	var $pa
	var $email;

	function gate($name,$pass,$email)
	{
		$this->username = txt_clean($name);
		$this->pass = txt_clean($pass);
		$this->email = txt_clean($email);
	}
	
	/**
	 * Handles the remote callback from the gateway
	 *
	 * @return bool Returns true
	 */
	function callback()
	{	
		global $db, $lang, $sitename, $adminemail;
		
		$id = intval($_POST['transaction_id']);
		$trans = $db->fetch($db->query("SELECT * FROM `transactions` WHERE id = '".$id."'"));
		$pay = $db->fetch($db->query("SELECT * FROM `payment` WHERE `id` = '".$trans->processor."'"));
		
		if (isset($_POST['transaction_id']))
		{
			switch ($_POST['status'])
			{
				case 2:					
					// Did they pay the right amount?
					if ($trans->ammount == $_POST['mb_amount'] || $invoice['recurring_total'] == $_POST['mb_amount'])
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
						return false;
					}	
					break;
				case 1:					
					$db->query("UPDATE `transactions` SET `notes` = 'Transaction Scheduled. Will be processed upon completion.' WHERE  `id` = '".$id."'");
					break;
				case 0:					
					$db->query("UPDATE `transactions` SET `notes` = 'Transaction Pending. Will be processed upon completion.' WHERE  `id` = '".$id."'");
					break;
				case -1:					
					$db->query("UPDATE `transactions` SET `result` = '0', `notes` = 'Transaction Canceled.' WHERE  `id` = '".$id."'");
					break;
				case -2:					
					$db->query("UPDATE `transactions` SET `result` = '0', `notes` = 'Transaction Failed.' WHERE  `id` = '".$id."'");
					break;
			}
		}
		else
		{
			return false;
		}
		
		header('HTTP/1.0 200 OK', false, 200); // Needed otherwise MB will continually post
		header('Location: '.$siteurl); // Needed otherwise MB will continually post
		return true;
	}
	
	/**
	 * Generates HTML form to complete payment
	 *
	 * @return string HTML
	 */
	function link()
	{
		global $db, $itemname, $sitename, $siteurl, $lang;
		$time = time();
		$pay = $db->fetch($db->query("SELECT * FROM `payment` WHERE id = '".intval($_POST['gate'])."'"));
		$group = $db->fetch($db->query("SELECT * FROM `groups` WHERE id = '".intval($_POST['group'])."'"));
		
		$sql = "INSERT INTO `transactions` SET `username` = '".$this->username."', `password` = '".$this->pass."', `email` = '".$this->email."', `group` = '".intval($_POST['group'])."', `ammount` = '".$group->price."', `processor` = '".intval($_POST['gate'])."', `result` = '2', `notes` = 'Transaction Is Pending User Action', `approved` = '0'";
		$db->query($sql);
		$id = mysql_insert_id();
		
		// Build HTML
		$html = '<form method="post" action="https://www.moneybookers.com/app/payment.pl">';
		$html .= '<input type="hidden" name="pay_to_email" value="'.$pay->sell_id.'" />';
		$html .= '<input type="hidden" name="transaction_id" value="'.$id.'" />';
		$html .= '<input type="hidden" name="return_url" value="'.$siteurl.'/index.php" />';
		$html .= '<input type="hidden" name="cancel_url" value="'.$siteurl.'/index.php" />';
		$html .= '<input type="hidden" name="status_url" value="'.$siteurl.'/ipn.php?gateway='.$_POST['gate'].'" />';
		$html .= '<input type="hidden" name="language" value="EN" />';
		$html .= '<input type="hidden" name="amount" value="'.$group->price.'" />';
		$html .= '<input type="hidden" name="currency" value="USD" />';
		$html .= '<p><input type="submit" name="Submit" value="Pay now with MoneyBrokers" /></p></form>'; // Don't hard code the name in case the admin changes it

		return $html;
	}
}
?>