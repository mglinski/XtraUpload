<?php
/**
 * XtraUpload
 *
 * A turn-key open source web 2.0 PHP file uploading package requiring PHP v5
 *
 * @package		XtraUpload
 * @author		Matthew Glinski
 * @copyright	Copyright (c) 2006, XtraFile.com
 * @license		http://xtrafile.com/docs/license
 * @link		http://xtrafile.com
 * @since		Version 2.0
 * @filesource
 */

// ------------------------------------------------------------------------

/**
 * XtraUpload Payments IPN Controller
 *
 * @package		XtraUpload
 * @subpackage	Controllers
 * @category	Controllers
 * @author		Matthew Glinski
 * @link		http://xtrafile.com/docs/code/paypal_ipn
 */

// ------------------------------------------------------------------------

class Ipn extends Controller 
{
	private $gateway = '';
	/**
	 * Ipn()
	 *
	 * The home page controller constructor
	 *
	 * @access	public
	 * @return	none
	 */	
	public function Ipn()
	{
		parent::Controller();
		include_once(APPPATH.'libraries/payment/PaymentGateway.php');
	}
	
	// ------------------------------------------------------------------------
	
	/**
	 * IPN->paypal()
	 *
	 * Validate PayPal payments
	 *
	 * @access	public
	 * @return	none
	 */	
	public function paypal()
	{
		// Include the paypal library
		include_once (APPPATH.'libraries/payment/Paypal.php');
		$this->gateway = '1';
		
		// Create an instance of the paypal library
		$myPaypal = new Paypal();
		
		// Log the IPN results
		// $myPaypal->ipnLog = TRUE;
		
		// Enable test mode if needed
		if(defined('XUDEBUG') and XUDEBUG == true)
		{
			$myPaypal->enableTestMode();
		}
		
		// Check validity and write down it
		if ($myPaypal->validateIpn())
		{
			if ($myPaypal->ipnData['payment_status'] == 'Completed')
			{
				$settings = unserialize(base64_decode($myPaypal->ipnData['custom']));
				if($settings['type'] == 'reg')
				{
					$this->_newUserPayment($settings['user_id'], $myPaypal->ipnData['amount']);
				}
			}
			else
			{
				 $this->_logError($myPaypal->ipnData);
			}
		}
	}
	
	function authorize()
	{
		// make sure there are no timeouts...
		echo 'Processing...'; flush();
		
		$gate = $this->db->get_where('gateways', array('name' => 'authorize'))->row();
		$gate_conf = unserialize($gate->settings);
		
		// Include the paypal library
		include_once (APPPATH.'libraries/payment/Authorize.php');
		$this->gateway = '2';
		
		// Create an instance of the authorize.net library
		$myAuthorize = new Authorize();
		
		// Log the IPN results
		// $myAuthorize->ipnLog = TRUE;
		
		// Specify your authorize login and secret
		$myAuthorize->setUserInfo($gate_conf['login'], $gate_conf['secret']);
		
		// Enable test mode if needed
		$myAuthorize->enableTestMode();
		
		// Check validity and write down it
		if ($myAuthorize->validateIpn())
		{
			$settings = unserialize(base64_decode($myPaypal->ipnData['x_Cust_ID']));
			if($settings['type'] == 'reg')
			{
				$this->_newUserPayment($settings['user_id'], $myPaypal->ipnData['x_Amount']);
			}
		}
		else
		{
			$this->_logError($myAuthorize->ipnData);
		}
	}
	
	function two_checkout()
	{
		// Include the paypal library
		include_once (APPPATH.'libraries/payment/TwoCo.php');
		$this->gateway = '3';
		
		$gate = $this->db->get_where('gateways', array('name' => 'twoco'))->row();
		$gate_conf = unserialize($gate->settings);
		
		// Create an instance of the authorize.net library
		$my2CO = new TwoCo();
		
		// Log the IPN results
		// $my2CO->ipnLog = TRUE;
		
		// Specify your authorize login and secret
		$my2CO->setSecret($gate_conf['secret_id']);
		
		// Enable test mode if needed
		$my2CO->enableTestMode();
		
		// Check validity and write down it
		if ($my2CO->validateIpn())
		{
			$settings = unserialize(base64_decode($myPaypal->ipnData['custom']));
			if($settings['type'] == 'reg')
			{
				$this->_newUserPayment($settings['user_id'], $myPaypal->ipnData['total']);
			}
		}
		else
		{
			$this->_logError($my2CO->ipnData);
		}
	}
	
	//--------------------------------------------------------------------
	
	private function _newUserPayment($id, $amount)
	{
		$this->db->where('id', $id)->update('users' array('status' => 1));
		
		$user = $this->db->get_where('users', array('id' => $id))->row();
		$group = $this->db->get_where('groups', array('id' => $user->group))->row();
		
		$this->users->sendNewUserEmail($user->email, $user, $group);
		
		$this->load->model('transactions/transactions_db');
		$data = array(
			'user' => $user->id,
			'gateway' => $this->gateway,
			'time' => time(),
			'status' => '1',
			'ammount' => $amount,
			'config' => serialize(array('type' => 'text', 'activated' => 'text', 'duration' => 'text', 'group' => 'text', 'email' => 'text' )),
			'settings' => serialize(array('type' => 'New Registration', 'activated' => 'yes', 'duration' => $group->repeat_billing, 'group' => $group->id, 'email' => $user->email ))
		);
		
		$this->transactions_db->insert($id);
	}
	
	private function _logError($gate, $data)
	{
		if($this->gateway == 2)
		{
			$settings = @unserialize(@base64_decode(@$data['x_Cust_ID']));
		}
		else
		{
			$settings = @unserialize(@base64_decode(@$data['custom']));
		}
		if(!$settings)
		{
			return false;
		}
		
		$id = $settings['user_id'];
		if($this->gateway == 1)
			$amount = $data['amount'];
		elseif($this->gateway == 2)
			$amount = $data['x_Amount'];
		elseif($this->gateway == 3)
			$amount = $data['total'];
			
		$user = $this->db->get_where('users', array('id' => $id))->row();
		$group = $this->db->get_where('groups', array('id' => $user->group))->row();
		
		$this->load->model('transactions/transactions_db');
		$data = array(
			'user' => $user->id,
			'gateway' => $this->gateway,
			'time' => time(),
			'status' => '0',
			'ammount' => $amount,
			'config' => serialize(array('type' => 'text', 'activated' => 'text', 'duration' => 'text', 'group' => 'text', 'email' => 'text' )),
			'settings' => serialize(array('type' => 'New Registration', 'activated' => 'yes', 'duration' => $group->repeat_billing, 'group' => $group->id, 'email' => $user->email ))
		);
		
		$this->transactions_db->insert($id);
	}
}

/* End of file ipn.php */
/* Location: ./system/applicaton/controllers/payment/ipn.php */