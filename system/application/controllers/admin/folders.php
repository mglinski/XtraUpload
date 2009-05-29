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
 * XtraUpload Admin - Folder Manager
 *
 * @package		XtraUpload
 * @subpackage	Controllers - Admin
 * @category	Controllers
 * @author		Matthew Glinski
 * @link		http://xtrafile.com/docs/plugins/ads
 */

// ------------------------------------------------------------------------

class Folderss extends Controller 
{
	public function Folders()
	{
		parent::Controller();		
		$this->load->model('admin_access');
		$this->load->model('folders/folders_db');
	}
	
	public function index()
	{
		redirect('admin/folders/view');
	}
	
	public function view()
	{
		$data['flashMessage'] = '';
		if($this->session->flashdata('msg'))
		{
			$data['flashMessage'] = '<span class="info"><b>'.$this->session->flashdata('msg').'</b></span>';
		}
		
		$this->load->library('pagination');
		$perPage = 50;
		
		$config['base_url'] = site_url('admin/folders/view');
		$config['total_rows'] = $this->folders_db->getNumFolders();
		$config['per_page'] = $perPage;	
		$config['uri_segment'] = 4;	
		$this->pagination->initialize($config);
		
		$data['pagination'] = $this->pagination->create_links();
		$data['folders'] = $this->folders_db->getFolders($perPage, $this->uri->segment(4));
		
		$this->load->view($this->startup->skin.'/header', array('headerTitle' => 'File Folder Manager'));
		$this->load->view($this->startup->skin.'/admin/folders/view', $data);
		$this->load->view($this->startup->skin.'/footer');
	}
	
	public function search($query='')
	{
		$data['flashMessage'] = '';
		if($this->session->flashdata('msg'))
		{
			$data['flashMessage'] = '<span class="info"><b>'.$this->session->flashdata('msg').'</b></span>';
		}
		
		if($query == '')
		{
			$this->load->view($this->startup->skin.'/header', array('headerTitle' => 'Search File Folder'));
			$this->load->view($this->startup->skin.'/admin/folders/search', $data);
			$this->load->view($this->startup->skin.'/footer');	
			return;
		}
		
		$this->load->library('pagination');
		$perPage = 50;
		
		$config['base_url'] = site_url('admin/folders/view');
		$config['total_rows'] = $this->folders_db->getNumSearchFolders($query);
		$config['per_page'] = $perPage;	
		$config['uri_segment'] = 4;	
		$this->pagination->initialize($config);
		
		$data['folders'] = $this->folders_db->searchFolders($query, $perPage, $this->uri->segment(4));
		$data['pagination'] = $this->pagination->create_links();
		
		$this->load->view($this->startup->skin.'/header', array('headerTitle' => 'File Folder Search Results '));
		$this->load->view($this->startup->skin.'/admin/folders/search_result', $data);
		$this->load->view($this->startup->skin.'/footer');
	}

	public function delete($id)
	{
		if(intval($id) != 0))
		{
			$this->folders_db->delete(intval($id));
			$this->session->set_flashdata('msg', 'Folder Deleted!');
			redirect('admin/folders/view');
		}
	}
}