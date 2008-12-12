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
 * XtraUpload Group Page Controller
 *
 * @package		XtraUpload
 * @subpackage	Controllers - Admin
 * @category	Controllers
 * @author		Matthew Glinski
 * @link		http://xtrafile.com/docs/pages/admin/user
 */

// ------------------------------------------------------------------------

class Group extends Controller 
{
	public function Group()
	{
		parent::Controller();	
		$this->load->model('admin_access');
	}
	
	public function index()
	{
		redirect('admin/group/view');
	}
	
	public function view()
	{
		$this->load->helper('string');
	
		$data['flashMessage'] = '';
		
		$data['groups'] = $this->db->get('groups');
		
		if($this->session->flashdata('msg'))
		{
			$data['flashMessage'] = '<p><span class="info"><b>'.$this->session->flashdata('msg').'</b></span></p>';
		}
		

		$this->load->view($this->startup->skin.'/header', array('headerTitle' => 'Manage Groups'));
		$this->load->view($this->startup->skin.'/admin/groups/view', $data);
		$this->load->view($this->startup->skin.'/footer');
	}
	
	public function edit($id)
	{
		if($this->input->post('name'))
		{
			// Save changes
			$this->db->where('id', $id)->update('groups', $_POST);
						
			// Encrypt the cache filename for security
			$group_file_name = md5($this->config->config['encryption_key'].'group_'.$id);
			
			// Get group object from DB
			$group_config = $this->db->get_where('groups', array('id' => $id))->row();
			
			// Save the group object to cache for increased performance
			file_put_contents(CACHEPATH . $group_file_name, base64_encode(serialize($group_config)));
			
			// Send updates to all servers
			$this->load->library('Remote_server_xml_rpc');
			$this->remote_server_xml_rpc->update_cache();
			
			$this->session->set_flashdata('msg', 'Group Edited!');
			redirect('/admin/group/view');
		}
		
		$data['group'] = $this->db->get_where('groups', array('id' => $id))->row();
		$data['real_name'] = $this->_getRealNames();
		$data['real_descr'] = $this->_getRealDescriptions();
		$data['real_type'] = $this->_getRealTypes();
		
		$this->load->view($this->startup->skin.'/header', array('headerTitle' => 'Edit User Group'));
		$this->load->view($this->startup->skin.'/admin/groups/edit', $data);
		$this->load->view($this->startup->skin.'/footer');
	}
	
	public function add()
	{
		if($this->input->post('name'))
		{			
			// Insert new group
			$this->db->insert('groups', $_POST);
			$group = $this->db->insert_id();
			
			// Encrypt the cache filename for security
			$group_file_name = md5($this->config->config['encryption_key'].'group_'.$group);
			
			// Get group object from DB
			$group_config = $this->db->get_where('groups', array('id' => $group))->row();
			
			// Save the group object to cache for increased performance
			file_put_contents(CACHEPATH . $group_file_name, base64_encode(serialize($group_config)));
			
			// Send updates to all servers
			$this->load->library('Remote_server_xml_rpc');
			$this->remote_server_xml_rpc->update_cache();
		
			// Send back to the main page
			$this->session->set_flashdata('msg', 'Group Edited!');
			redirect('/admin/group/view');
		}
		
		$data['group'] = $this->db->get_where('groups', array('id' => '1'))->row();
		$data['real_name'] = $this->_getRealNames();
		$data['real_descr'] = $this->_getRealDescriptions();
		$data['real_type'] = $this->_getRealTypes();
		
		$this->load->view($this->startup->skin.'/header', array('headerTitle' => 'Add New User Group'));
		$this->load->view($this->startup->skin.'/admin/groups/add', $data);
		$this->load->view($this->startup->skin.'/footer');
	}
	
	public function turn_on($id)
	{
		if($id > 2)
		{
			$this->db->where('id', $id);
			$this->db->update('groups', array('status' => 1));
			$this->session->set_flashdata('msg', 'Group is now Public');
		}
		redirect('admin/group/view');
	}
	
	public function turn_off($id)
	{
		if($id > 2)
		{
			$this->db->where('id', $id);
			$this->db->update('groups', array('status' => 0));
			$this->session->set_flashdata('msg', 'Group is now Private');
		}
		redirect('admin/group/view');
	}
	
	public function delete($id)
	{
		if($id > 2)
		{
			$this->db->delete('groups', array('id' =>$id));
			$this->session->set_flashdata('msg', 'Group has been deleted');
		}
		redirect('admin/group/view');
	}
	
	private function _getRealNames()
	{
		$group = array(
			'name' => 'Group Name',
			'price' => 'Registration Price',
			'descr' => 'Group Description',
			'admin' => 'Can Access Admin Panel?',
			'speed_limit' => 'Download speed limit',
			'upload_size_limit' => 'File Size Limit',
			'wait_time' => 'Download Wait Time',
			'files_types' => 'File Types',
			'file_types_allow_deny' => 'File Types are Allowed/Restricted',
			'download_captcha' => 'Captcha for downloads',
			'auto_download' => 'Direct Links?',
			'upload_num_limit' => 'Mass Upload File Count',
			'storage_limit' => 'Account Storage Limit',
			'repeat_billing' => 'Billing Interval',
			'file_expire' => 'File Expire Time'
		);
		return $group;
	}
	
	private function _getRealDescriptions()
	{
		$group = array(
			'name' => 'The name for your Group',
			'price' => 'The price someone has to pay to register or extend a user account with this group',
			'descr' => 'The group description',
			'admin' => 'Are users in this group allowed to access the admin panel?',
			'speed_limit' => 'The download speed limit, in KBps',
			'upload_size_limit' => 'The max filesize for uploads, in MB',
			'wait_time' => 'The time a user has to wait before they can download a file.',
			'files_types' => 'A Pipe("|") seperated list of file types to allow or deny on upload. <br />Leave blank to remove restrictions. The setting below controls this setting.',
			'file_types_allow_deny' => 'Allow or deny the above file list.',
			'download_captcha' => 'Force a captcha on users in this group before they can download a file',
			'auto_download' => 'If captcha is off, the wait time is 1 or less and this is set to yes, file links will auto download.',
			'upload_num_limit' => 'The number of files a user can upload at once without refreshing the page.',
			'storage_limit' => 'The total size in megabytes that any user in thes group can store at one time.',
			'repeat_billing' => 'The period of time where an account is billed for service',
			'file_expire' => 'The ammount of time in days that a file uploaded by this group is kept on the server.',
		);
		return $group;
	}
	
	private function _getRealTypes()
	{
		$group = array(
			'name' => '',
			'price' => '',
			'descr' => 'area',
			'admin' => 'yesno',
			'speed_limit' => '',
			'upload_size_limit' => '',
			'wait_time' => '',
			'files_types' => '',
			'file_types_allow_deny' => 'allowdeny',
			'download_captcha' => 'yesno',
			'auto_download' => 'yesno',
			'upload_num_limit' => '',
			'storage_limit' => '',
			'file_expire' => '',
			'repeat_billing' => array(
				'0' => 'None',
				'd' => 'Daily',
				'w' => 'Weekly',
				'm' => 'Monthly',
				'y' => 'Yearly',
				'dy' => 'Bi-Yearly',
			)
		);
		return $group;
	}
}
?>