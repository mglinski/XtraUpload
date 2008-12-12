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
 * XtraUpload Servers DB Model
 *
 * @package		XtraUpload
 * @subpackage	Model
 * @category	Model
 * @author		Matthew Glinski
 * @link		http://xtrafile.com/docs/pages/files
 */

// ------------------------------------------------------------------------

class Server_db extends Model 
{
    public function Server_db()
    {
		// Call the Model constructor
        parent::Model();
    }
	
	// ------------------------------------------------------------------------

	public function getServers()
	{
		$get = $this->db->get('servers');
		return $get;
	}
	
	// ------------------------------------------------------------------------
	
	public function getServerForDownload($file)
	{
		if(!$file->mirror)
		{
			return $file->server;
		}
		else
		{
			$server = $file->server;
			$arr = unserialize($servers);
			return $arr[rand(0, (count($arr)-1))];
		}
	}
	
	// ------------------------------------------------------------------------

	public function getRandomServer()
	{
		$this->db->order_by('id', 'RANDOM');
		$get = $this->db->get_where('servers', array('status' => '1'), 1, 0);
		
		if($get->num_rows() != 1)
		{
			$this->db->order_by('id', 'RANDOM');
			$get = $this->db->get('servers', 1, 0);
			return $get->row();
		}
		else
		{
			return $get->row();
		}
	}
	
	// ------------------------------------------------------------------------

	public function getServerById($id)
	{
		$get = $this->db->get_where('servers', array('id' => $id), 1, 0);
		return $get->row();
	}
	
	// ------------------------------------------------------------------------
	
	public function editServer($id, $data)
	{
		$this->db->where('id', $id);
		$this->db->update('servers', $data);
	}
	
	// ------------------------------------------------------------------------
	
	public function addServer($data)
	{
		$this->db->insert('servers', $data);
		return $this->db->insert_id();
	}
	
	// ------------------------------------------------------------------------
	
	public function deleteServer($id)
	{
		$this->db->delete('servers', array('id' => $id));
	}
}