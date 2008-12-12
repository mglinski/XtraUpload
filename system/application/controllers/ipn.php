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
 * XtraUpload Ipn Controller
 *
 * @package		XtraUpload
 * @subpackage	Controllers
 * @category	Controllers
 * @author		Matthew Glinski
 * @link		http://xtrafile.com/docs/pages/ipn
 */

// ------------------------------------------------------------------------

class Ipn extends Controller 
{
	/**
	 * IPN()
	 *
	 * The home page controller constructor
	 *
	 * @access	public
	 * @return	none
	 */	
	public function Ipn()
	{
		parent::Controller();
		
		$this->load->library('paypal_lib');
	}
	
	// ------------------------------------------------------------------------

	
	/**
	 * IPN->paypal()
	 *
	 * The home page for XtraUpload, containing the flash uploader
	 *
	 * @access	public
	 * @return	none
	 */	
	public function paypal()
	{
		if ($this->paypal_lib->validate_ipn())
		{
			$id = $this->paypal_lib->ipn_data['item_number'];
			$this->db->where('id', $id)->update('users' array('status' => 1));
			
			$user = $this->db->get_where('users', array('id' => $id))->row();
			$group = $this->db->get_where('groups', array('id' => $user->group))->row();
			
			$this->users->sendNewUserEmail($user->email, $user, $group);
		} 
	}
}

/* End of file ipn.php */
/* Location: ./system/applicaton/controllers/ipn.php */