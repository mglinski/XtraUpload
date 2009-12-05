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
 * XtraUpload Cron Item
 *
 * @package		XtraUpload
 * @subpackage	Cron
 * @category	Controllers
 * @author		Matthew Glinski
 * @link		http://xtrafile.com/docs/cron
 */

// ------------------------------------------------------------------------

class Server_cron 
{
	private $server = false;
	private $CI = '';
	private $debug = false;
	
	public function Server_cron($server)
	{
		if(!defined('IN_CRON'))
		{
			return false;
		}
		
		$this->CI = &get_instance();
		
		if(defined('XU_DEBUG'))
		{
		    $this->debug = true;
		}
		
		$this->server = $server;
		$this->_runCron();
	}
	
	// Server Cron gets all files hosted on this server, and disk usage stats for display in the admin panel.
	function _runCron()
	{
	    if(!defined('IN_CRON'))
		{
			return false;
		}
	    
		$load = $this->CI->functions->getServerLoad(0);
		if($load > 100)
		{
		    $load = 100;
		}

		$free_space = disk_free_space(dirname('filestore/'));
		$total_space = disk_total_space(dirname('filestore/'));
		
		$data = array(
			'free_space' => $free_space,
			'total_space' => $total_space,
			'used_space' => ($total_space - $free_space),
			'num_files' => $this->CI->db->get_where('files', array('server' => base_url()))->num_rows()
		);
		
		$this->CI->db->where('url', base_url());
		$this->CI->db->update('servers', $data);
	}
	
}
?>