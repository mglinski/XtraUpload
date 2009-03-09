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
 * XtraUpload Remote Server XML_RPC Library
 *
 * @package		XtraUpload
 * @subpackage	Model
 * @category	Model
 * @author		Matthew Glinski
 * @link		http://xtrafile.com/docs/code/libraries/remote_server_xml_rpc
 */
 
/* 
Usage:
	$this->load->library('Remote_server_xml_rpc');
	$this->remote_server_api->update_cache();
*/

// ------------------------------------------------------------------------

class Xu_hooks
{
	private $CI = '';
	private $hooks = array();
	
	/**
	 * Remote_server()
	 *
	 * AN XML_RPC server/client system for sending commands to file servers.
	 *
	 * @access	public
	 * @return	none
	 */
    public function Xu_hooks()
    {
		$this->CI =& get_instance();
    }
	
	// set a hook to be run
	public function setHook($name, $function)
	{
		if(!isset($this->hooks[$name]))
		{
			$this->hooks[$name] = array();
		}
		
		$this->hooks[$name][] = $function;
	}
	
	// Run all set hooks, and return the data
	public function runHooks($name, $args)
	{
		// dirty work, needs to be rethought. I hate eval statments... 
		foreach($this->hooks[$name] as $function)
		{
			eval('$args = '.$function.'($args);');
		}
		return $args;
	}
}
?>