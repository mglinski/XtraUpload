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
 * XtraUpload Skin Page Controller
 *
 * @package		XtraUpload
 * @subpackage	Controllers - Admin
 * @category	Controllers
 * @author		Matthew Glinski
 * @link		http://xtrafile.com/docs/pages/admin/skin
 */

// ------------------------------------------------------------------------

class Skin extends Controller 
{
	public function Skin()
	{
		parent::Controller();	
		$this->load->model('admin_access');
		$this->load->model('skin/skin_db');
	}
	
	public function index()
	{
		redirect('admin/skin/view');
	}
	
	public function view()
	{
		$this->load->helper('string');
		$data['flashMessage'] = '';

		if($this->session->flashdata('msg'))
		{
			$data['flashMessage'] = '<span class="info"><b>'.$this->session->flashdata('msg').'</b></span>';
		}
		
		$data['skins'] = $this->skin_db->getAllSkins();
		
		$this->load->view($this->startup->skin.'/header', array('headerTitle' => 'Manage Skins'));
		$this->load->view($this->startup->skin.'/admin/skins/view',$data);
		$this->load->view($this->startup->skin.'/footer');
	}
	
	public function installNew()
	{
		if ($handle = opendir('system/application/views')) 
		{
			$i = 0;
			while (false !== ($file = readdir($handle))) 
			{				
				if (($file != "." && $file != ".." && $file != ".svn" && $file != "_protected") && is_dir('system/application/views/'.$file)) 
				{
					$skin = $this->db->get_where('skin', array('name' => $file));
					if($skin->num_rows() == '0')
					{	
						$this->skin_db->installSkin($file);
						$i++;
					}
				}
			}
  			closedir($handle);
		}
		$this->session->set_flashdata('msg', $i.' New Skin(s) were installed.');
		redirect('admin/skin/view');
	}
	
	public function delete($file='')
	{
		if($file != '' and $file != 'default')
		{
			$this->skin_db->deleteSkin($file);
			$this->session->set_flashdata('msg', 'The Skin "<strong>'.ucwords(str_replace('_',' ',$file)).'</strong>" has been Uninstalled.');
		}
		redirect('admin/skin/view');
	}
	
	
	public function setActive($name)
	{
		$skin_name = md5($this->config->config['encryption_key'].'skin_name');
		
		$this->session->set_flashdata('msg', 'Skin "'.ucwords(str_replace('_', ' ', $name)).'" set as active.');
		$this->skin_db->setActiveSkin($name);
			
		// Save the config object to cache for increased performance
		file_put_contents(CACHEPATH . $skin_name , $name);
		
		// Send updates to all servers
		$this->load->library('Remote_server_xml_rpc');
		$this->remote_server_xml_rpc->update_cache();
		
		redirect('admin/skin/view');
	}

	public function _newSkinsToInstall()
	{
		if ($handle = opendir('./system/application/views/')) 
		{
			$i = 0;
			while (false !== ($file = readdir($handle))) 
			{
				if ($file != "." && $file != ".." && is_dir($file)) 
				{
					$skin = $this->db->get_where('skin', array('name' => $file));
					if($skin->num_rows() == '0')
					{	
						return true;
					}
				}
				
			}
  			closedir($handle);
		}
		return false;
	}
}
?>