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
 * XtraUpload Home Page Controller
 *
 * @package		XtraUpload
 * @subpackage	Controllers
 * @category	Controllers
 * @author		Matthew Glinski
 * @link		http://xtrafile.com/docs/pages/home
 */

// ------------------------------------------------------------------------

class Home extends Controller 
{
	/**
	 * Home()
	 *
	 * The home page controller constructor
	 *
	 * @access	public
	 * @return	none
	 */	
	public function Home()
	{
		parent::Controller();
		
		// If the user just typed in the domain name add /home to the end of the url
//		if(!stristr($this->uri->uri_string(), 'home'))
//		{
//			redirect('home');
//		}
		$this->load->model('server/server_db');
		$this->load->model('admin_access');
		$this->lang->load('home');
	}
	
	// ------------------------------------------------------------------------

	
	/**
	 * Home->index()
	 *
	 * The home page for XtraUpload, containing the flash uploader
	 *
	 * @access	public
	 * @return	none
	 */	
	public function index()
	{
		// Get some vars
		$data = array(
			'server' => $this->server_db->getRandomServer()->url,
			'upload_limit' => $this->startup->group_config->upload_size_limit,
			'upload_num_limit' => $this->startup->group_config->upload_num_limit,
			'files_types' => $this->startup->group_config->files_types,
			'file_icons' => $this->functions->getJSONFileTypeList(),
			'file_types_allow_deny' => $this->startup->group_config->file_types_allow_deny,
			'storage_limit' => $this->startup->group_config->storage_limit
		);
		
		if(intval($this->startup->group_config->storage_limit) > 0)
		{
			$data['storage_used'] = $this->functions->getFilesizePrefix(($this->startup->group_config->storage_limit * 1024 * 1024) - $this->files_db->getFilesUseageSpace());
		}
		
		$data['flashMessage'] = '';
		
		if($this->session->flashdata('msg'))
		{
			$data['flashMessage'] = '<span class="info"><b>'.$this->session->flashdata('msg').'</b></span>';
		}
		
		// There is no processing functionality here, just static pages to send the user
		$this->load->view($this->startup->skin.'/header', array('headerTitle' => $this->lang->line('home_controller_1'), 'include_flash_upload_js' => true));
		$this->load->view($this->startup->skin.'/admin/home', $data);
		$this->load->view($this->startup->skin.'/footer');
	}
}

/* End of file home.php */
/* Location: ./system/applicaton/controllers/home.php */