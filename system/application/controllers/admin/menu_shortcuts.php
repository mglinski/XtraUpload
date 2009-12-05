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
 * XtraUpload Files Page Controller
 *
 * @package		XtraUpload
 * @subpackage	Controllers - Admin
 * @category	Controllers
 * @author		Matthew Glinski
 * @link		http://xtrafile.com/docs/pages/admin/files
 */

// ------------------------------------------------------------------------

class Menu_shortcuts extends Controller 
{
	public function Menu_shortcuts()
	{
		parent::Controller();	
		$this->load->model('admin/menu_shortcuts/admin_menu_shortcuts_db');
	}
	
	public function index()
	{
		redirect('admin/menu_shortcuts/view');
	}
	
	public function view()
	{
		$this->load->library('pagination');
		$this->load->helper('admin/sort');
		$this->load->helper('string');
		$this->load->helper('date');
		
		$perPage = 20;		
		$data['flashMessage'] = '';
		$data['perPage'] = $perPage;
		
		$config['base_url'] = site_url('admin/menu_shortcuts/view');
		$config['total_rows'] = $this->admin_menu_shortcuts_db->getNumShortcuts();
		$config['per_page'] = $perPage;	
		$config['uri_segment'] = 4;	
		
		$this->pagination->initialize($config);
		
		if($this->session->flashdata('msg'))
		{
			$data['flashMessage'] = '<span class="info"><b>'.$this->session->flashdata('msg').'</b></span>';
		}
		
		$data['shortcuts'] = $this->admin_menu_shortcuts_db->getShortcuts($perPage, $this->uri->segment(4));
		$data['pagination'] = $this->pagination->create_links();
		
		$this->load->view($this->startup->skin.'/header', array('headerTitle' => 'Manage Files'));
		$this->load->view($this->startup->skin.'/admin/menu_shortcuts/view',$data);
		$this->load->view($this->startup->skin.'/footer');
	}
	
	public function edit($id)
	{
		if($this->input->post('status'))
		{
			$this->admin_menu_shortcuts_db->editShortcut($id, $_POST);
			
			$this->session->set_flashdata('msg', 'Shortcut Edited');
			redirect('admin/menu_shortcuts/view');
			return false;
		}
		
		$data['id'] = $id;
		$data['shortcut'] = $this->admin_menu_shortcuts_db->getShortcut($id)->row();
		
		$this->load->view($this->startup->skin.'/header', array('headerTitle' => 'Edit Shortcut'));
		$this->load->view($this->startup->skin.'/admin/menu_shortcuts/edit',$data);
		$this->load->view($this->startup->skin.'/footer');
	}
	
	public function add($link= '', $title='')
	{
		if($this->input->post('link'))
		{
			$this->admin_menu_shortcuts_db->addShortcut($_POST);
			
			$this->session->set_flashdata('msg', 'New Shortcut Added');
			redirect('admin/menu_shortcuts/view');
			return false;
		}
		
		$data['link'] = '';
		if($link != '')
		{
			$data['link'] = base64_decode($link);
		}
		
		$data['title'] = '';
		if($title != '')
		{
			$data['title'] = base64_decode($title);
		}
		
		$data['order'] = $this->admin_menu_shortcuts_db->getNumShortcuts();
		
		$this->load->view($this->startup->skin.'/header', array('headerTitle' => 'Add Shortcut'));
		$this->load->view($this->startup->skin.'/admin/menu_shortcuts/add', $data);
		$this->load->view($this->startup->skin.'/footer');
	}
	
	public function delete($id)
	{
		$this->admin_menu_shortcuts_db->deleteShortcut($id);
		$this->session->set_flashdata('msg', 'Shortcut Deleted');
		redirect('admin/menu_shortcuts/view');
	}
	
	public function turn_off($id)
	{
		$this->admin_menu_shortcuts_db->editShortcut($id, array('status' => 0));
		$this->session->set_flashdata('msg', 'Shortcut Hidden');
		redirect('admin/menu_shortcuts/view');
	}
	
	public function turn_on($id)
	{
		$this->admin_menu_shortcuts_db->editShortcut($id, array('status' => 1));
		$this->session->set_flashdata('msg', 'Shortcut Shown');
		redirect('admin/menu_shortcuts/view');
	}
}
?>