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

class Remote_server_xml_rpc
{
	private $CI = '';
	
	/**
	 * Remote_server()
	 *
	 * AN XML_RPC server/client system for sending commands to file servers.
	 *
	 * @access	public
	 * @return	none
	 */
    public function Remote_server_xml_rpc()
    {
		$this->CI =& get_instance();
		$this->CI->load->library('xmlrpc');
    }
	
	// ------------------------------------------------------------------------
	
	public function update_cache()
	{
		$this->CI->load->model('server/server_db');
		$servers = $this->CI->server_db->getServers();
				
		foreach($servers->result() as $server)
		{
			$this->CI->xmlrpc->server($server->url.'remote', 80);
			$this->CI->xmlrpc->method('remote_server_api.updateCache');
			
			//$request = '';
			$request = array($this->CI->config->config['encryption_key']);
			$this->CI->xmlrpc->request($request);
			
			if( ! $this->CI->xmlrpc->send_request())
			{
				log_message('error', 'Server('.$server->url.') did not respond to XML_RPC request to update cache');
			}
		}
	}
}
?>