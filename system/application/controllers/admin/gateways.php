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
 * XtraUpload Payment Gateways Page Controller
 *
 * @package		XtraUpload
 * @subpackage	Controllers - Admin
 * @category	Controllers
 * @author		Matthew Glinski
 * @link		http://xtrafile.com/docs/pages/admin/gateways
 */

// ------------------------------------------------------------------------

class Gateways extends Controller 
{
	public function Gateways()
	{
		parent::Controller();	
		$this->load->model('admin_access');
	}
	
	public function index()
	{
		redirect('admin/gateways/view');
	}
	
	public function manage()
	{
		redirect('admin/gateways/view');
	}
	
	public function home()
	{
		redirect('admin/gateways/view');
	}
	
	public function view()
	{
		$this->load->library('pagination');
		$this->load->helper('string');
		
		$data['flashMessage'] = '';
		if($this->session->flashdata('msg'))
		{
			$data['flashMessage'] = '<span class="info">'.$this->session->flashdata('msg').'</span>';
		}
		
		$data['gates'] = $this->db->get('gateways');
		
		$this->load->view($this->startup->skin.'/header', array('headerTitle' => 'Manage Payment Gateways'));
		$this->load->view($this->startup->skin.'/admin/gateways/view', $data);
		$this->load->view($this->startup->skin.'/footer');
	}
	
	public function edit($id)
	{
		$data['flashMessage'] = '';
		if($this->session->flashdata('msg'))
		{
			$data['flashMessage'] = '<span class="info">'.$this->session->flashdata('msg').'</span>';
		}
		
		$data['gate'] = $this->db->get_where('gateways', array('id' => intval($id)))->row();
		$this->load->view($this->startup->skin.'/header', array('headerTitle' => 'Edit Payment Gateway'));
		$this->load->view($this->startup->skin.'/admin/gateways/edit', $data);
		$this->load->view($this->startup->skin.'/footer');
	}
	
	// ------------------------------------------------------------------------
	
	/**
	 * update()
	 *
	 * Process a new config object save request
	 *
	 * @access	public
	 * @return	none
	 */
	public function update($id)
	{
		// If the user has posted new values
		if($this->input->post('valid'))
		{
			$gate = $this->db->get_where('gateways', array('id' => $id))->row();
			$settings = unserialize($gate->settings);
			foreach($settings as $key => $type)
			{
				$data[$key] = $this->input->post($key);
			}
			
			$this->db->where('id', $id);
			$this->db->update('gateways', array('settings' => serialize($data)));
			$this->session->set_flashdata('msg', 'Payment Gateway Edited!');
			redirect('admin/gateways/view');
		}
		else
		{
			// Redirect back to main page
			 redirect('admin/config');
		}
	}
	
	public function set_default($id)
	{
		// If the user has posted new values		
		$this->db->where('default', '1');
		$this->db->update('gateways', array('default' => '0'));
		
		$this->db->where('id', $id);
		$this->db->update('gateways', array('default' => '1'));
		
		$this->session->set_flashdata('msg', 'New Payment Gateway Set as Default!');
		redirect('admin/gateways/view');
	}
	
	public function turn_on($id)
	{
		$this->db->where('id', $id);
		$this->db->update('gateways', array('status' => '1'));
		
		$this->session->set_flashdata('msg', 'Payment Gateway turned on!');
		redirect('admin/gateways/view');
	}
	
	public function turn_off($id)
	{
		$this->db->where('id', $id);
		$this->db->update('gateways', array('status' => '0'));
		
		$this->session->set_flashdata('msg', 'Payment Gateway turned off!');
		redirect('admin/gateways/view');
	}
}