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

class payment
{
	function payment()
	{
	
	}
	
	function forward($price,$custom,$return,$email)
	{
		global $siteurl;
		$form = 'https://www.paypal.com/?';
		$form .= 'business='.$email;
		$form .= '&item_name=';
		$form .= '&item_number=';
		$form .= '&currency_code=USD';
		$form .= '&notify_url='.urlencode($siteurl.'index.php?p=payment&gateway=paypal');		
		$form .= '&cmd=_xclick';
		$form .= '&amount='.$price;
		$form .= '&no_shipping=1';
		$form .= '&no_note=1';
		$form .= '&return='.$return;
		//$form .= '&rm=2';
		$form .= '&custom='.$custom;		
		header("Location: ".$form);
	}
	
	function parse()
	{
		// read the post from PayPal system and add 'cmd'
		$req = 'cmd=_notify-validate';
		
		foreach ($_POST as $key => $value) 
		{
			$value = urlencode(stripslashes($value));
			$req .= "&$key=$value";
			//$$key = "".$value.""
		}
		
		// post back to PayPal system to validate
		$header .= "POST /cgi-bin/webscr HTTP/1.0\r\n";
		$header .= "Content-Type: application/x-www-form-urlencoded\r\n";
		$header .= "Content-Length: " . strlen($req) . "\r\n\r\n";
		$fp = fsockopen ('www.paypal.com', 80, $errno, $errstr, 30);
		
		if (!$fp) 
		{
			// HTTP ERROR
		} 
		else 
		{
			fputs ($fp, $header . $req);
			while (!feof($fp)) 
			{
				$res = fgets ($fp, 1024);
				if (strcmp ($res, "VERIFIED") == 0) 
				{
					$payment_verified = true;
				} 
				else if (strcmp ($res, "INVALID") == 0) 
				{
					$payment_verified = false;
				}
			}
			fclose ($fp);
		}
		$this->validate($payment_verified);
	}
	
	function validate($payment_verified)
	{
		global $db, $kernel, $adminemail, $sitename;
		foreach ($_POST as $key => $value) 
		{
			$$key = "".$value."";
			/* assign posted variables to local variables
			$item_name            = $_POST['item_name'];
			$item_number          = $_POST['item_number'];
			$quantity             = $_POST['quantity'];
			$payment_amount       = $_POST['mc_gross'];
			$fee                  = $_POST['mc_fee'];
			$tax                  = $_POST['tax'];
			$payment_currency     = $_POST['mc_currency'];
			$exchange_rate        = $_POST['exchange_rate'];
			$payment_status       = $_POST['payment_status'];
			$payment_type         = $_POST['payment_type'];
			$payment_date         = $_POST['payment_date'];
			$txn_id               = $_POST['txn_id'];
			$txn_type             = $_POST['txn_type']; // 'cart', 'send_money' or 'web_accept' (manual page 46)
			$custom               = $_POST['custom'];   // Any custom data
			$receiver_email       = $_POST['receiver_email'];
			$first_name           = $_POST['first_name'];
			$last_name            = $_POST['last_name'];
			$payer_business_name  = $_POST['payer_business_name'];
			$payer_email          = $_POST['payer_email'];
			$address_street       = $_POST['address_street'];
			$address_zip          = $_POST['address_zip'];
			$address_city         = $_POST['address_city'];
			$address_state        = $_POST['address_state'];
			$address_country      = $_POST['address_country'];
			$address_country_code = $_POST['address_country_code'];
			$residence_country    = $_POST['residence_country'];
			*/
		}
		//--FORMAT TRANSACTION DETAILS--------------------------------------------------
		
		if ($quantity == '0' || $quantity == "" ) 
		{ 
			$quantity = 1; 
		}
		
		if ($exchange_rate == '0' || $exchange_rate == "" ) 
		{ 
			$exchange_rate = 1; 
		}
		
		if ($residence_country <> "") 
		{ 
			$country = $residence_country; 
		} 
		else 
		{ 
			$country = $address_country_code; 
		}
		
		//--PROCESS RESULT--------------------------------------------------
		if ($payment_verified) 
		{
			// check the payment_status is Completed
			// check that txn_id has not been previously processed
			// check that receiver_email is your Primary PayPal email
			// check that payment_amount/payment_currency are correct
			// process payment
			
			if (strcmp ($payment_status, "Completed") == 0) 
			{
				// Payment Completed
				$set = explode(',',$custom);
				$act = $set[0];
				$id = intval($set[1]);
				$var = txt_clean($set[2]);
				switch($act)
				{
					case "premium-link":
						$db->query("UPDATE `plinks` SET `status` = '1' WHERE `id` = '".$id."'");
						$link = $db->fetch($db->query("SELECT * FROM `plinks` WHERE `id` = '".$id."'"));
						mail($payer_email,'File Updated to Premium Status!',"Dear $first_name $last_name,\nYour Transaction was approved and your file has been upgraded to premium status!\nSincerly,\nThe $sitename Team",'From: '.$adminemail);
						mail($adminemail,'File Updated to Premium Status!',"Dear Admin,\nThe file($link->hash) has been given premium status.\nThe Details of the transaction are:\n+++++++++++++++++++++\n+ File Hash: $link->hash\n+ Paid By: $payer_email\n+ Status: Active\n+ Transaction: VARIFIED\n+ Gateway: Paypal\n+++++++++++++++++++++\nThis should require no more attention on your part.",'From: '.$adminemail);
					break;
					
					//case: 
				}
			} 
			else if (strcmp ($payment_status, "Refunded") == 0 || strcmp ($payment_status, "Reversed") == 0 || strcmp ($payment_status, "Partially-Refunded") == 0) 
			{
				// Payment Refunded
			} 
			else if (strcmp ($payment_status, "Pending") == 0 ) 
			{
				// Payment Pending
			} 
			else 
			{ 
				// Payment has *not* been successfully completed
			}
				
		} 
		else if (!$payment_verified) 
		{ 
			//manual investigation Needed
		}
	}
}
?>