<?php  if (!defined('BASEPATH')) exit('No direct script access allowed');
// ------------------------------------------------------------------------
// payment_lib (Payment Class Config)
// ------------------------------------------------------------------------

// If (and where) to log ipn to file
$config['payment_lib_ipn_log_file'] = BASEPATH . 'logs/payment_ipn.log';
$config['payment_lib_ipn_log'] = TRUE;

// Where are the buttons located at 
$config['payment_lib_button_path'] = 'buttons';

// What is the default currency?
$config['payment_lib_currency_code'] = 'USD';

?>
