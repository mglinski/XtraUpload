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

class Files extends Controller 
{
	public function Files()
	{
		parent::Controller();	
		$this->load->model('admin_access');
	}
	
	public function index()
	{
		redirect('admin/files/view');
	}
	
	public function view()
	{
		$this->load->library('pagination');
		$this->load->helper('admin/sort');
		$this->load->helper('string');
		$this->load->helper('date');
	
		$sort = $this->session->userdata('fileSort');
		$direction = $this->session->userdata('fileDirection');
		$perPage = $this->session->userdata('fileCount');
		
		if(!$perPage)
		{
			$perPage = 50;
			$this->session->set_userdata('fileCount', $perPage);
		}
		
		if(!$sort)
		{
			$sort = 'time';
			$this->session->set_userdata('fileSort', $sort);
		}
		
		if(!$direction)
		{
			$direction = 'desc';
			$this->session->set_userdata('fileDirection', $direction);
		}
		
		$data['sort'] = $sort;
		$data['direction'] = $direction;
		$data['flashMessage'] = '';
		$data['perPage'] = $perPage;
		
		$config['base_url'] = site_url('admin/files/view');
		$config['total_rows'] = $this->files_db->getAdminNumFiles();
		$config['per_page'] = $perPage;	
		$config['uri_segment'] = 4;	
		
		$this->pagination->initialize($config);
		
		if($this->session->flashdata('msg'))
		{
			$data['flashMessage'] = '<span class="info"><b>'.$this->session->flashdata('msg').'</b></span>';
		}
		
		$data['files'] = $this->files_db->getAdminFiles($sort, $direction, $perPage, $this->uri->segment(4));
		$data['pagination'] = $this->pagination->create_links();
		
		$this->load->view($this->startup->skin.'/header', array('headerTitle' => 'Manage Files'));
		$this->load->view($this->startup->skin.'/admin/files/view',$data);
		$this->load->view($this->startup->skin.'/footer');
	}
	
	public function folder($folder_id)
	{
		$this->load->library('pagination');
		$this->load->helper('admin/sort');
		$this->load->helper('string');
		$this->load->helper('date');
	
		$sort = $this->session->userdata('fileSort');
		$direction = $this->session->userdata('fileDirection');
		$perPage = $this->session->userdata('fileCount');
		
		if(!$perPage)
		{
			$perPage = 50;
			$this->session->set_userdata('fileCount', $perPage);
		}
		
		if(!$sort)
		{
			$sort = 'time';
			$this->session->set_userdata('fileSort', $sort);
		}
		
		if(!$direction)
		{
			$direction = 'desc';
			$this->session->set_userdata('fileDirection', $direction);
		}
		
		$data['sort'] = $sort;
		$data['direction'] = $direction;
		$data['flashMessage'] = '';
		$data['perPage'] = $perPage;
		
		$config['base_url'] = site_url('admin/files/view');
		$config['total_rows'] = $this->files_db->getAdminNumFilesInFolder($folder_id);
		$config['per_page'] = $perPage;	
		$config['uri_segment'] = 4;	
		
		$this->pagination->initialize($config);
		
		if($this->session->flashdata('msg'))
		{
			$data['flashMessage'] = '<span class="info"><b>'.$this->session->flashdata('msg').'</b></span>';
		}
		
		$data['files'] = $this->files_db->getAdminFilesInFolder($folder_id, $sort, $direction, $perPage, $this->uri->segment(4));
		$data['pagination'] = $this->pagination->create_links();
		
		$this->load->view($this->startup->skin.'/header', array('headerTitle' => 'Manage Files in Folder'));
		$this->load->view($this->startup->skin.'/admin/files/folder',$data);
		$this->load->view($this->startup->skin.'/footer');
	}
	
	public function search($query='')
	{
		if(!empty($query))
		{
			$this->load->library('pagination');
			$this->load->helper('admin/sort');
			$this->load->helper('string');
			$this->load->helper('date');
			
			$query = urldecode($query);
		
			$sort = $this->session->userdata('fileSort');
			$direction = $this->session->userdata('fileDirection');
			$perPage = $this->session->userdata('fileCount');
			
			if(!$perPage)
			{
				$perPage = 50;
				$this->session->set_userdata('fileCount', $perPage);
			}
			
			if(!$sort)
			{
				$sort = 'time';
				$this->session->set_userdata('fileSort', $sort);
			}
			
			if(!$direction)
			{
				$direction = 'desc';
				$this->session->set_userdata('fileDirection', $direction);
			}
			
			$data['sort'] = $sort;
			$data['direction'] = $direction;
			$data['flashMessage'] = '';
			$data['res_num'] = $this->files_db->getAdminNumFiles_search($query);
			$data['query'] = $query;
			$data['perPage'] = $perPage;
			
			$config['base_url'] = site_url('admin/files/search/'.urlencode($query));
			$config['total_rows'] = $data['res_num'];
			$config['per_page'] = $perPage;	
			$config['uri_segment'] = 5;	
			
			$this->pagination->initialize($config);
			
			if($this->session->flashdata('msg'))
			{
				$data['flashMessage'] = '<span class="info"><b>'.$this->session->flashdata('msg').'</b></span>';
			}
			
			$data['files'] = $this->files_db->getAdminFiles_search($query, $sort, $direction, $perPage, $this->uri->segment(5));
			$data['pagination'] = $this->pagination->create_links();
			
			$this->load->view($this->startup->skin.'/header', array('headerTitle' => 'Manage Files'));
			$this->load->view($this->startup->skin.'/admin/files/search_result',$data);
			$this->load->view($this->startup->skin.'/footer');
		}
		else
		{
			$this->load->view($this->startup->skin.'/header', array('headerTitle' => 'Search Files'));
			$this->load->view($this->startup->skin.'/admin/files/search');
			$this->load->view($this->startup->skin.'/footer');
		}
	}
	
	public function edit($id)
	{
		if($this->input->post('status'))
		{
			$this->db->where('file_id', $id);
			$this->db->update('refrence', $_POST);
			
			$this->session->set_flashdata('msg', 'File Edited');
			redirect('admin/files/view');
			return false;
		}
		
		$data['id'] = $id;
		$data['file'] = $this->files_db->getFileObject($id);
		
		$this->load->view($this->startup->skin.'/header', array('headerTitle' => 'Edit File'));
		$this->load->view($this->startup->skin.'/admin/files/edit',$data);
		$this->load->view($this->startup->skin.'/footer');
	}
	
	public function delete($id)
	{
		$this->files_db->deleteFileAdmin($id);
		$this->session->set_flashdata('msg', 'File Deleted');
		redirect('admin/files/view');
	}
	
	public function ban($id)
	{
		$this->files_db->banFileAdmin($id);
		$this->session->set_flashdata('msg', 'File Banned');
		redirect('admin/files/view');
	}
	
	public function sort()
	{
		if($this->input->post('sort'))
		{
			$sort = $this->input->post('sort');
			$this->session->set_userdata('fileSort', $sort);
		}
		
		if($this->input->post('direction'))
		{
			$direction = $this->input->post('direction');
			$this->session->set_userdata('fileDirection', $direction);
		}
		
		redirect('admin/files');
	}
	
	public function count()
	{
		if($this->input->post('fileCount'))
		{
			$count = $this->input->post('fileCount');
			$this->session->set_userdata('fileCount', $count);
		}
		
		redirect('admin/files/view');
	}
	
	public function search_count($query)
	{
		if($this->input->post('fileCount'))
		{
			$count = $this->input->post('fileCount');
			$this->session->set_userdata('fileCount', $count);
		}
		
		redirect('admin/files/search/'.$query);
	}
	
	public function massBan($query='')
	{
		if($this->input->post('files') and is_array($this->input->post('files')))
		{
			foreach($this->input->post('files') as $id)
			{
				$this->files_db->banFileAdmin($id);
			}
			
			$this->session->set_flashdata('msg', count($this->input->post('files')).' File(s) have been Banned');
		}
		
		if(!empty($query))
		{
			redirect('admin/files/search/'.$query);
		}
		else
		{
			redirect('admin/files/view');
		}
	}
	
	public function massDelete($query='')
	{
		if($this->input->post('files') and is_array($this->input->post('files')))
		{
			foreach($this->input->post('files') as $id)
			{
				$this->files_db->deleteFileAdmin($id);
			}
			
			$this->session->set_flashdata('msg', count($this->input->post('files')).' Files(s) have been deleted');
		}
		
		if(!empty($query))
		{
			redirect('admin/files/search/'.$query);
		}
		else
		{
			redirect('admin/files/view');
		}
	}
}
?>