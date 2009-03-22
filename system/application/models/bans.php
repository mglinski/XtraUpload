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
 * XtraUpload Ban Access Model
 *
 * @package		XtraUpload
 * @subpackage	Model
 * @category	Model
 * @author		Matthew Glinski
 * @link		http://xtrafile.com/docs/pages/files
 */

// ------------------------------------------------------------------------

class Bans extends Model 
{
	var $ban_list = array();
	var $ban_file = 'ban_list_file';
	// ------------------------------------------------------------------------

    public function Bans()
    {
        // Call the Model constructor
        parent::Model();
		
		$this->checkForBan(true);
    }
	
	public function checkForBan($kill=false)
	{
		$ip = $this->input->ip_address();
		if(!isset($this->ban_list[$ip]))
		{
			return false;
		}
		else
		{
			if($kill)
				show_404();
			else
				return true;
		}
	}
	
	public function addBan($data)
	{
		$this->db->insert('bans', $data);
		$this->_putBans();
	}
	
	public function removeBan($id)
	{
		$this->db->delete('bans', array('id' => $id));
		$this->_putBans();
	}
	
	public function getUserBans()
	{
		return $this->ban_list;
	}
	
	public function getAllBans()
	{
		return $this->db->get('bans');
	}
	
	private function _putBans()
	{
		// Encrypt the cache filename for security
		$ban_file_name = md5($this->CI->config->config['encryption_key'].$this->ban_file);
		
		// Get group object from DB
		$bans = $this->db->get_where('bans', array('type' => 'user'));
		foreach($bans->result() as $ban)
		{
			$this->ban_list[$ban->ip] = array('ip' => $ban->ip, 'time' => $ban->time, 'type' => 'user');
		}
		
		// Save the group object to cache for increased performance
		file_put_contents(CACHEPATH . $ban_file_name, base64_encode(serialize($this->ban_list)));
	}
	
	private function _getBans()
	{
		// Encrypt the cache filename for security
		$ban_file_name = md5($this->CI->config->config['encryption_key'].$this->ban_file);
		
		// Check if the cache file previously exists
		if(file_exists(CACHEPATH . $ban_file_name))
		{
			// Dont wast time with the DB, load the cached version
			$this->ban_list = unserialize(base64_decode($this->CI->load->file(CACHEPATH . $ban_file_name, true)));
		}
		else
		{
			// Get group object from DB
			$bans = $this->db->get_where('bans', array('type' => 'user'));
			foreach($bans->result() as $ban)
			{
				$this->ban_list[] = array('ip' => $ban->ip, 'time' => $ban->time, 'type' => 'user');
			}
			
			// Save the group object to cache for increased performance
			file_put_contents(CACHEPATH . $ban_file_name, base64_encode(serialize($this->ban_list)));
		}
	}
}
?>