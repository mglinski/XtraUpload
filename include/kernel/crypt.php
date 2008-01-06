<?php
class encrypt
{

	function process($str,$crypt_direction,$secure='',$key='')
	{
		if($key == '')
		{
			$key = md5('^sJksfyj%rhahrsh$tthjyjnd#fSRHt@jtjasr!hR');
		}
		else
		{
			$key = md5($key);
		}	
		
		$crypt_method = ( $crypt_direction == 'encrypt' ? 'encryptStr' : 'decryptStr' );
		$new_pass = $this->$crypt_method($str, $key);
		return $new_pass;
	}
	

	function encryptStr($str,$enc_string) 
	{	
		$str_encrypted = "";
		if ($enc_string % 2 == 1) { // we need even number of characters
			$enc_string .= $enc_string{0};
		}
		for ($i=0; $i < strlen($str); $i++) { // encrypts one character - two bytes at once
			$str_encrypted .= sprintf("%02X", hexdec(substr($enc_string, 2*$i % strlen($enc_string), 2)) ^ ord($str{$i}));
		}
	
		return $str_encrypted;
	
	} 
	
	function decryptStr($str_encrypted,$enc_string) 
	{
		$str = "";
		if ($enc_string % 2 == 1) 
		{
			$enc_string .= $enc_string{0};
		}
		for ($i=0; $i < strlen($str_encrypted); $i += 2) 
		{
			$str .= chr(hexdec(substr($enc_string, $i % strlen($enc_string), 2)) ^ hexdec(substr($str_encrypted, $i, 2)));
		}
		return $str;
	
	} // End function decryptPassword	
}
?>