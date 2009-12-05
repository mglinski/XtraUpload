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

class Admin_menu_shortcuts_db extends Model 
{
	var $ban_list = array();
	var $ban_file = 'ban_list_file';
	// ------------------------------------------------------------------------

    public function Admin_menu_shortcuts_db()
    {
        // Call the Model constructor
        parent::Model();
    }
	
	function getShortcuts($limit=100, $offset=0, $select='')
	{
		$this->db->order_by("order", "asc"); 
		if($select != '')
		{
			$this->db->select($select);
		}

		$query = $this->db->get('admin_menu_shortcuts', $limit, $offset);
		return $query;	
	}
	
	function getNumShortcuts()
	{
		return $this->db->select('id')->where('status', 1)->count_all_results('admin_menu_shortcuts');
	}
	
	function getShortcut($id, $limit=100, $offset=0, $select='')
	{
		$this->db->order_by("order", "asc"); 
		if($select != '')
		{
			$this->db->select($select);
		}

		$query = $this->db->get_where('admin_menu_shortcuts', array('id' => $id), $limit, $offset);
		return $query;	
	}
	
	function addShortcut($data)
	{
		$query = $this->db->insert('admin_menu_shortcuts', $data);
		return $query;	
	}
	
	function editShortcut($id, $data = '')
	{
		if($data == '' and is_array($id))
		{
			$array = $id;
			foreach($array as $id => $data)
			{
				$this->db->where('id', $id)->update('admin_menu_shortcuts', $data);
			}
		}
		else
		{
			$this->db->where('id', $id)->update('admin_menu_shortcuts', $data);
		}
	}
	
	function deleteShortcut($id)
	{
		$this->db->delete('admin_menu_shortcuts', array('id' => $id));
	}
}
?>