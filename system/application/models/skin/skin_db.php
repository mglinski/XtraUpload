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
 * XtraUpload Skin DB Model
 *
 * @package		XtraUpload
 * @subpackage	Model
 * @category	Model
 * @author		Matthew Glinski
 * @link		http://xtrafile.com/docs/pages/files
 */

// ------------------------------------------------------------------------

class Skin_db extends Model 
{
    public function Skin_db()
    {
        // Call the Model constructor
        parent::Model();
    }
	
	public function getAllSkins()
	{
		return $this->db->get('skin');
	}
	
	public function setActiveSkin($name)
	{
		$this->db->where('active', '1');
		$this->db->update('skin', array('active' => '0'));
		
		$this->db->where('name', $name);
		$this->db->update('skin', array('active' => '1'));
	}
	
	public function installSkin($file)
	{
		$this->db->insert('skin', array('name' => $file, 'active' => '0'));
	}
	
	public function deleteSkin($file)
	{
		$this->db->delete('skin', array('name' => $file));
	}
}
?>