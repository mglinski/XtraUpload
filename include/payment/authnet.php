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
	/*
	* User changable data
	*/
	var $trans_key = 'YOUR TRANS KEY HERE'; // Transaction key
	var $test_mode = false; // Change to true to enable test mode
	
	/*
	* You should not need to change any of the following unless you have modified the default gateway settings
	*/
	var $delimiter = ','; // What the return data is separated by
	var $transaction_type = 'AUTH_CAPTURE';
	
	var $username;
	var $pass;
	var $email;

	function gate($name,$pass,$email)
	{
		$this->username = txt_clean($name);
		$this->pass = txt_clean($pass);
		$this->email = txt_clean($email);
	}
	
	function link()
	{
		global $db, $sitename, $siteurl, $lang;
		$time = time();
		$pay = $db->fetch($db->query("SELECT * FROM `payment` WHERE id = '".intval($_POST['gate'])."'"));
		$group = $db->fetch($db->query("SELECT * FROM `groups` WHERE id = '".intval($_POST['group'])."'"));
		$db->query("INSERT INTO `transactions` SET `username` = '".$this->username."', `password` = '".$this->pass."', `email` = '".$this->email."', `group` = '".intval($_POST['group'])."', `ammount` = '".$group->price."', `processor` = '".intval($_POST['gate'])."', `result` = '2', `notes` = 'Transaction Is Pending User Action', `approved` = '0'");
		$id = mysql_insert_id();
			
		$form = '<form method="post" action="'.$siteurl.'ipn.php?gateway=1" id="auth_co">
		<input type="hidden" name="order_id" value="'.$id.'" />';
		$form .= '<table cellspacing="5" cellpadding="0" class="list" style="margin: 1em">';
		$form .= '<tr><td class="left"><label for="card">'.$lang['authnet']['7'].'</label></td><td><input type="text" name="card" size="35" /></td>';
		$form .= '<tr><td class="left"><label for="exp">'.$lang['authnet']['8'].'</label></td><td><input type="text" name="exp" size="4" maxlength="4" /></td>';
		$form .= '<tr><td class="left"><label for="cvv2">'.$lang['authnet']['9'].'</label></td><td><input type="text" name="cvv2" size="3" maxlength="3" /></td>';
		$form .= '<tr><td class="left"><label for="first_name">'.$lang['authnet']['10'].'</label></td><td><input type="text" name="first_name" size="30" value="" /></td>';
		$form .= '<tr><td class="left"><label for="last_name">'.$lang['authnet']['11'].'</label></td><td><input type="text" name="last_name" size="30" value="" /></td>';
		$form .= '<tr><td class="left"><label for="address">'.$lang['authnet']['12'].'</label></td><td><input type="text" name="street" size="30" value="" /></td>';		
		$form .= '<tr><td class="left"><label for="city">'.$lang['authnet']['13'].'</label></td><td><input type="text" name="city" size="30" value="" /></td>';		
		$form .= '<tr><td class="left"><label for="country">'.$lang['authnet']['14'].'</label></td><td><input type="text" name="state" size="30" value="" /></td>';		
		$form .= '<tr><td class="left"><label for="zip">'.$lang['authnet']['15'].'</label></td><td><input type="text" name="postal_code" size="10" value="" /></td>';
		$form .= '<tr><td class="left"><label for="email">'.$lang['authnet']['16'].'</label></td><td><input type="text" name="email" size="35" value="" /></td>';
		$form .= '<tr><td class="left"><label for="phone">'.$lang['authnet']['17'].$lang['authnet']['18'].'</label></td><td><input type="text" name="phone" size="15" value="" /></td>';
				
		$form .= '<tr class="alt"><td colspan="2">
		<input type="submit" name="submit" value="'.$lang['authnet']['18'].'" /></td></tr></table></form>';
		
		return $form;
	}
	
	function callback()
	{
		global $db, $lang,$adminemail,$siteurl,$sitename;
		$id = intval($_POST['order_id']);
		$trans = $db->fetch($db->query("SELECT * FROM `transactions` WHERE id = '".$id."'"));
		$pay = $db->fetch($db->query("SELECT * FROM `payment` WHERE `id` = '".$trans->processor."'"));
		
		$authnet_values				= array
		(
			'x_version'				=> '3.1',
			'x_test_request'		=> 'FALSE',
			'x_delim_data'			=> 'TRUE',
			'x_delim_char'			=> $this->delimiter,
			'x_relay_response'		=> 'FALSE',
			'x_login'				=> $pay->cart_id,
			'x_tran_key'			=> $this->trans_key,		
			'x_type'				=> $this->transaction_type,
			'x_method'				=> 'CC',			
			'x_card_num'			=> $_POST['card'],
			'x_exp_date'			=> $_POST['exp'],
			'x_card_code'			=> $_POST['cvv2'],
			'x_invoice_num'			=> $id,
			'x_description'			=> $_POST['item_name'],
			'x_amount'				=> number_format($trans->price, 2, '.', ''),
			'x_email'				=> $_POST['email'],
			'x_first_name'			=> $_POST['first_name'],
			'x_last_name'			=> $_POST['last_name'],
			'x_address'				=> $_POST['street'],
			'x_city'				=> $_POST['city'],
			'x_state'				=> $_POST['state'],
			'x_zip'					=> $_POST['postal_code'],
			'x_phone'				=> $_POST['phone'],
		);
		
		foreach ($authnet_values as $key => $value ) 
		{
			$fields .= "$key=".urlencode($value).'&';
		}
		
		// URL is https://secure.authorize.net/gateway/transact.dll for live sites
		// URL is https://certification.authorize.net/gateway/transact.dll for test sites
		if ($this->test_mode)
		{
			$curl_url = 'https://certification.authorize.net/gateway/transact.dll';
		}
		else
		{
			$curl_url = 'https://secure.authorize.net/gateway/transact.dll';
		}		
		
		$curl_send = curl_init($curl_url); // URL of gateway for cURL to post to
		curl_setopt($curl_send, CURLOPT_HEADER, 0); // Set to 0 to eliminate header info from response
		curl_setopt($curl_send, CURLOPT_RETURNTRANSFER, 1); // Returns response data instead of TRUE(1)
		curl_setopt($curl_send, CURLOPT_POSTFIELDS, rtrim($fields, '& ')); // Use HTTP POST to send form data
		//curl_setopt($curl_send, CURLOPT_SSL_VERIFYPEER, FALSE); // Uncomment this line if you get no response from the gateway. 
		$curl_response = curl_exec($curl_send); // Execute post and get results
		curl_close($curl_send);
		
		// Make it readable
		$response = explode($this->delimiter, $curl_response);
		
		if($response[0] == 1)
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
			echo $lang['authnet']['20'].$response[3].$lang['authnet']['21'];
			$msg = 'Dear Admin,
			The user "'.txt_clean($_POST['xu_username']).'" has tried to signup for a premium account. <br />
			The process has failed because: '.$response[3].'
			Please Investigate this further, the user\'s email address is '.txt_clean($_POST['email']).'
			-XtraUpload Payment System';
			mail($adminemail,'Failed Authorize.net Payment',$msg);
												
		}	
	}
		
}

?>