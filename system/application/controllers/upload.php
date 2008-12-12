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
 * XtraUpload Upload Page Controller
 *
 * @package		XtraUpload
 * @subpackage	Controllers
 * @category	Controllers
 * @author		Matthew Glinski
 * @link		http://xtrafile.com/docs/pages/files
 */

// ------------------------------------------------------------------------

class Upload extends Controller 
{
	public function Upload()
	{
		parent::Controller();	
		$this->lang->load('upload');
	}
	
	// ------------------------------------------------------------------------

	public function index()
	{
		redirect('/home');
	}
	
	// ------------------------------------------------------------------------

	public function url()
	{
		// Load the Server DB model
		$this->load->model('server/server_db');
		
		$data = array(
			'server' => $this->server_db->getRandomServer()->url,
			'file_icons' => $this->functions->getJSONFileTypeList()
		);
		
		$this->load->view($this->startup->skin.'/header', array('headerTitle' => $this->lang->line('upload_controller_1')));
		$this->load->view($this->startup->skin.'/upload/url', $data);
		$this->load->view($this->startup->skin.'/footer');
	}
	
	// ------------------------------------------------------------------------

	public function get_progress($fid)
	{
		$db = $this->db->get_where('progress', array('fid' => $fid));
		if($db->num_rows() != 1)
		{
			echo '[{"total":"100", "sofar":"0", "startTime":"'.time().'"}]';
		}
		else
		{
			$pro = $db->row();
			echo '[{"total":"'.$pro->total.'", "sofar":"'.$pro->progress.'", "startTime":"'.$pro->start_time.'"}]';
		}
	}
	
	// ------------------------------------------------------------------------
	
	public function url_process()
	{
		$this->load->library('remotefile');
		
		// Load post data
		$uid = $this->input->post('fid');
		$url = $this->input->post('link');
		$pass = $this->input->post('pass');
		$desc = $this->input->post('descr');
		$feature = $this->input->post('feature');
		$user = $this->input->post('user');
		
		if(intval($user) != 0)
		{
			$userobj = $this->users->getUserById($user);
			$this->startup->getGroup($userobj->group);
			unset($userobj);
		}
		
		$file = $this->remotefile->fetchFile($url, $uid, intval($this->startup->group_config->upload_size_limit));
		
		if(is_file($file))
		{
			$is_image = $this->functions->is_image($file);
			
			$nfile = './temp/'.basename($url);
			rename($file, $nfile);
			
			$this->files_db->newFile($nfile, $uid, $pass, $desc, $feature, $user, $is_image, base_url(), true);
			echo $this->lang->line('upload_controller_2');
		}
		else
		{
			echo $this->lang->line('upload_controller_3');
		}
	}
	
	// ------------------------------------------------------------------------

	public function process($uid='', $pass='', $desc='', $feature='', $user='')
	{
		$config['upload_path'] = './temp/';
		$config['allowed_types'] = $this->startup->group_config->files_types;
		$config['max_size']	= (1024 * intval($this->startup->group_config->upload_size_limit));
		$this->load->library('upload', $config);
		
		$pass = urldecode($pass);
		$desc = urldecode($desc);
		
		if($pass == '_' or $pass == 'undefined')
		{
			$pass = '';
		}
		
		if($desc == '_' or $desc == 'undefined')
		{
			$desc = '';
		}
		
		if(intval($user) != 0)
		{
			$userobj = $this->users->getUserById($user);
			$this->startup->getGroup($userobj->group);
			unset($userobj);
		}
				
		if($this->upload->do_upload('Filedata'))
		{
			$data = $this->upload->data();
			$file = $data['full_path'];
						
			$this->files_db->newFile($file, $uid, $pass, $desc, $feature, $user, (bool)$data['is_image'], base_url(), false);
			echo "WIN";
		}
		else
		{
			echo "FAIL";	
		}
	}
	
	// ------------------------------------------------------------------------

	public function getLinks($id)
	{
		$data['link'] = $this->files_db->getLinks($id);
		$this->load->view($this->startup->skin.'/upload/links', $data);
	}
}
?>