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
 * XtraUpload Email Page Controller
 *
 * @package		XtraUpload
 * @subpackage	Controllers - Admin
 * @category	Controllers
 * @author		Matthew Glinski
 * @link		http://xtrafile.com/docs/pages/admin/email
 */

// ------------------------------------------------------------------------

class Email extends Controller 
{
	public function Email()
	{
		parent::Controller();		
		$this->load->model('admin_access');
	}
	
	public function index()
	{
		redirect('admin/email/view');
	}
	
	public function view()
	{
		$data['flashMessage'] = '';
		if($this->session->flashdata('msg'))
		{
			$data['flashMessage'] = '<span class="info"><b>'.$this->session->flashdata('msg').'</b></span>';
		}
		
		$this->load->view($this->startup->skin.'/header', array('headerTitle' => 'Bulk Email'));
		$this->load->view($this->startup->skin.'/admin/email', $data);
		$this->load->view($this->startup->skin.'/footer');
	}
	
	public function send()
	{
		if($this->input->post('group') == '0')
		{
			$users = $this->db->get('users');
		}
		else
		{
			$users = $this->db->get_where('users', array('group' => $this->input->post('group')));
		}
		
		// Load the email library
		$this->load->library('email');
		
		foreach($users->result() as $user)
		{
			if(trim($user->email) == '')
			{
				continue;
			}
			$this->email->clear();
			
			// Set email options
			$this->email->from($this->startup->site_config['site_email'], $this->startup->site_config['sitename'].' Support');
			$this->email->to($user->email);
			$this->email->subject($this->input->post('subject'));
			$this->email->message($this->input->post('msg'));
			
			// Send the email
			$this->email->send();
		}
		
		$this->session->set_flashdata('msg', 'Email sent!');
		redirect('admin/email/view');
	}
}
?>