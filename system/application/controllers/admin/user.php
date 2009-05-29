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

class User extends Controller 
{
	public function User()
	{
		parent::Controller();	
		$this->load->model('admin_access');
		$this->load->model('users/users_db');
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
		$this->load->helper('admin/sort');
		$this->load->helper('string');
		
		$sort = $this->session->userdata('userSort');
		$direction = $this->session->userdata('userDirection');
		$perPage = $this->session->userdata('userCount');
			
		if(!$perPage)
		{
			$perPage = 50;
			$this->session->set_userdata('userCount', $perPage);
		}
			
		if(!$sort)
		{
			$sort = 'id';
			$this->session->set_userdata('userSort', $sort);
		}
		
		if(!$direction)
		{
			$direction = 'desc';
			$this->session->set_userdata('userDirection', $direction);
		}
		
		$data['flashMessage'] = '';
		$data['sort'] = $sort;
		$data['direction'] = $direction;
		$data['perPage'] = $perPage;
				
		$config['base_url'] = site_url('admin/user/view');
		$config['total_rows'] = $this->users_db->getNumUsers();
		$config['per_page'] = $perPage;	
		$config['uri_segment'] = 4;	
		$this->pagination->initialize($config);
		
		$data['users'] = $this->users_db->getAllUsers($sort, $direction, $perPage, $this->uri->segment(4));
		
		if($this->session->flashdata('msg'))
		{
			$data['flashMessage'] = '<p><span class="info"><b>'.$this->session->flashdata('msg').'</b></span></p>';
		}
		
		$data['pagination'] = $this->pagination->create_links();

		$this->load->view($this->startup->skin.'/header', array('headerTitle' => 'Manage Users'));
		$this->load->view($this->startup->skin.'/admin/users/view', $data);
		$this->load->view($this->startup->skin.'/footer');
	}
	
	public function search($query='')
	{
		$this->load->helper('string');
		if(!empty($query))
		{
			$this->load->library('pagination');
			$this->load->helper('admin/sort');
			
			$query = urldecode($query);
			
			$sort = $this->session->userdata('userSort');
			$direction = $this->session->userdata('userDirection');
			$perPage = $this->session->userdata('userCount');
			
			if(!$perPage)
			{
				$perPage = 50;
				$this->session->set_userdata('userCount', $perPage);
			}
				
			if(!$sort)
			{
				$sort = 'id';
				$this->session->set_userdata('userSort', $sort);
			}
			
			if(!$direction)
			{
				$direction = 'desc';
				$this->session->set_userdata('userDirection', $direction);
			}
			
			$results_num = $this->users_db->getNumUsers_search($query);
			
			$data['flashMessage'] = '';
			$data['sort'] = $sort;
			$data['direction'] = $direction;
			$data['res_num'] = $results_num;
			$data['query'] = $query;
			$data['perPage'] = $perPage;
			
			$config['base_url'] = site_url('admin/user/view');
			$config['total_rows'] = $results_num;
			$config['per_page'] = $perPage;	
			$config['uri_segment'] = 4;	
			$this->pagination->initialize($config);
			
			$data['users'] = $this->users_db->getAllUsers_search($query, $sort, $direction, $perPage, $this->uri->segment(4));
			
			if($this->session->flashdata('msg'))
			{
				$data['flashMessage'] = '<p><span class="info"><b>'.$this->session->flashdata('msg').'</b></span></p>';
			}
			
			$data['pagination'] = $this->pagination->create_links();
			
			$this->load->view($this->startup->skin.'/header', array('headerTitle' => 'Search Files'));
			$this->load->view($this->startup->skin.'/admin/users/search_result',$data);
			$this->load->view($this->startup->skin.'/footer');
		}
		else
		{
			$this->load->view($this->startup->skin.'/header', array('headerTitle' => 'Search Users'));
			$this->load->view($this->startup->skin.'/admin/users/search');
			$this->load->view($this->startup->skin.'/footer');
		}
	}
	
	// ------------------------------------------------------------------------

	public function edit($id)
	{
		$this->load->library('validation');
		
		$rules['email'] = "trim|valid_email";
		$rules['username'] = "trim|_checkUser";
		$rules['password'] = "trim|min_length[5]|max_length[70]";
		$this->validation->set_rules($rules);
		
		$fields['email'] = "Email";
		$fields['username'] = "Username";
		$fields['password'] = "Password";
		$this->validation->set_fields($fields);		
			
		if ($this->validation->run() == FALSE)
		{
			$error = str_replace('p>','li>',$this->validation->error_string); 
			if($this->input->post('edited'))
			{
				$data['error'] = '<span class="alert"><b>Error(s):</b><br /><ul>'.$error.'</ul></span>';
			}
			else
			{
				$data['error'] = '';
			}
		}
		else
		{
			$this->users_db->editUser($id, $this->input->post('username'),  $this->input->post('password'), $this->input->post('email'), $this->input->post('group'));
			$this->session->set_flashdata('msg', 'User Edited!');
			redirect('/admin/user/view');
			return true;
		}
		
		$data['user'] = $this->users_db->getUserById($id);
		$data['groups'] = $this->db->get('groups');
		$this->load->view($this->startup->skin.'/header', array('headerTitle' => 'Edit User'));
		$this->load->view($this->startup->skin.'/admin/users/edit', $data);
		$this->load->view($this->startup->skin.'/footer');
	}
	
	public function delete($id)
	{
		$this->users_db->deleteUser($id);
		$this->session->set_flashdata('msg', 'User has been deleted');
		redirect('admin/user/view');
	}
	
	public function turn_off($id)
	{
		$this->users_db->setUserStatus(0, $id);
		$this->session->set_flashdata('msg', 'User has been Deactivated');
		redirect('admin/user/view');
	}
	
	public function turn_on($id)
	{
		$this->users_db->setUserStatus(1, $id);
		$this->session->set_flashdata('msg', 'User has been Activated');
		redirect('admin/user/view');
	}
	
	public function sort()
	{
		if($this->input->post('sort'))
		{
			$sort = $this->input->post('sort');
			$this->session->set_userdata('userSort', $sort);
		}
		
		if($this->input->post('direction'))
		{
			$direction = $this->input->post('direction');
			$this->session->set_userdata('userDirection', $direction);
		}
		
		redirect('admin/user');
	}
	
	public function count()
	{
		if($this->input->post('userCount'))
		{
			$count = $this->input->post('userCount');
			$this->session->set_userdata('userCount', $count);
		}
		
		redirect('admin/user/view');
	}
	
	public function search_count($query)
	{
		if($this->input->post('userCount'))
		{
			$count = $this->input->post('userCount');
			$this->session->set_userdata('userCount', $count);
		}
		
		redirect('admin/user/search/'.$query);
	}
	
	public function massDelete($query='')
	{
		if($this->input->post('users') and is_array($this->input->post('users')))
		{
			foreach($this->input->post('users') as $id)
			{
				$this->users_db->deleteUser($id);
			}
			$this->session->set_flashdata('msg', count($this->input->post('users')).' User(s) have been deleted');
		}
		if(!empty($query))
		{
			redirect('admin/user/search/'.$query);
		}
		else
		{
			redirect('admin/user/view');
		}
	}
	
	private function _checkUser()
	{		
		$query = $this->db->getwhere('users', array('username' => $this->input->post('username')));
		$num = $query->num_rows();
		if($num != 1)
		{
			return FALSE;
		}
		else
		{
			return TRUE;
		}
	}
	
}
?>