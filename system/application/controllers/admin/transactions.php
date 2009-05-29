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
 * XtraUpload User Page Controller
 *
 * @package		XtraUpload
 * @subpackage	Controllers - Admin
 * @category	Controllers
 * @author		Matthew Glinski
 * @link		http://xtrafile.com/docs/pages/admin/user
 */

// ------------------------------------------------------------------------

class Transactions extends Controller 
{
	public function Transactions()
	{
		parent::Controller();	
		$this->load->model('admin_access');
		$this->load->model('transactions/transactions_db');
	}
	
	public function index()
	{
		redirect('admin/user/view');
	}
	
	public function manage()
	{
		redirect('admin/user/view');
	}
	
	public function home()
	{
		redirect('admin/user/view');
	}
	
	public function view()
	{
		$this->load->library('pagination');
		$this->load->helper('string');
		$this->load->helper('date');
		
		$perPage = 50;
		
		$data['flashMessage'] = '';
		$data['perPage'] = $perPage;
				
		$config['base_url'] = site_url('admin/user/view');
		$config['total_rows'] = $this->transactions_db->getNumTransactions();
		$config['per_page'] = $perPage;	
		$config['uri_segment'] = 4;	
		$this->pagination->initialize($config);
		
		$data['transactions'] = $this->transactions_db->getTransactions($perPage, $this->uri->segment(4));
		
		if($this->session->flashdata('msg'))
		{
			$data['flashMessage'] = '<p><span class="info"><b>'.$this->session->flashdata('msg').'</b></span></p>';
		}
		
		$data['pagination'] = $this->pagination->create_links();

		$this->load->view($this->startup->skin.'/header', array('headerTitle' => 'Manage Transactions'));
		$this->load->view($this->startup->skin.'/admin/transactions/view', $data);
		$this->load->view($this->startup->skin.'/footer');
	}
	
	public function edit($id)
	{
		$data['flashMessage'] = '';
		if($this->session->flashdata('msg'))
		{
			$data['flashMessage'] = '<span class="info">'.$this->session->flashdata('msg').'</span>';
		}
		
		$data['transaction'] = $this->db->get_where('transactions', array('id' => intval($id)))->row();
		$this->load->view($this->startup->skin.'/header', array('headerTitle' => 'Edit Transaction'));
		$this->load->view($this->startup->skin.'/admin/transactions/edit', $data);
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
			$gate = $this->db->get_where('transactions', array('id' => $id))->row();
			$settings = unserialize($gate->settings);
			foreach($settings as $key => $type)
			{
				$data[$key] = $this->input->post($key);
			}
			
			$this->transactions_db->edit($id, $data);
			$this->session->set_flashdata('msg', 'Transaction Edited!');
			redirect('admin/transactions/view');
		}
		else
		{
			// Redirect back to main page
			 redirect('admin/config');
		}
	}
	
	public function delete($id)
	{
		// If the user has posted new values
		$this->transactions_db->delete($id);
		$this->session->set_flashdata('msg', 'Transaction Deleted!');
		redirect('admin/transactions/view');
	}
	
}
?>