<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
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
 * XtraUpload Payment Library - Thermal Payments
 *
 * @package		XtraUpload
 * @subpackage	Model
 * @category	Model
 * @author		Matthew Glinski
 * @link		http://xtrafile.com/docs/code/libraries/remote_server_xml_rpc
 */
 
class Thermal
{
	// Location of driver classes
	$include_dir = '';
	
	// Configuration
	private $config = array(
	
	);
	
	// internal driver name class
	private $driver = array(
		'paypal',
		'authnet',
		'2checkout'
	);
	
	// sudo $this
	private $CI = NULL;
	
	// general constructor
	private function Thermal()
	{
		$this->CI =& get_instance();
	}
	
	public function setup($config = array())
	{
	
	}
	
	public function process()
	{
		
	}
}