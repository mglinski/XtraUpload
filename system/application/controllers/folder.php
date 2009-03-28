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
 * XtraUpload Folder Page Controller
 *
 * @package		XtraUpload
 * @subpackage	Controllers
 * @category	Controllers
 * @author		Matthew Glinski
 * @link		http://xtrafile.com/docs/pages/files
 */

// ------------------------------------------------------------------------

class Folder extends Controller
{
	public function Folder()
	{
		parent::Controller();
		$this->load->model('files/files_db');
		$this->load->library('functions');
		$this->lang->load('folder');
	}
	
	public function index()
	{
		redirect('home');
	}
	
	public function view($id)
	{
		$data['folder'] = $this->db->get_where('folder', array('f_id' => $id))->row();
		if(!$data['folder'])
		{
			show_404();	
		}
		
		$data['folder_files'] = $this->db->get_where('f_items', array('folder_id' => $id));
		$data['id'] = $id;
		$this->load->view($this->startup->skin.'/header', array('headerTitle' => $this->lang->line('folder_controller_1').' '.$this->startup->site_config['title_separator'].' '.$data['folder']->name));
		$this->load->view($this->startup->skin.'/folder/view', $data);
		$this->load->view($this->startup->skin.'/footer');
	}
	
	public function create()
	{
		$this->load->model('user_access');
		$data['files'] = $this->files_db->getFiles();
		
		$this->load->view($this->startup->skin.'/header', array('headerTitle' => $this->lang->line('folder_controller_2')));
		$this->load->view($this->startup->skin.'/folder/create', $data);
		$this->load->view($this->startup->skin.'/footer');
	}
	
	public function process()
	{
		$this->load->model('user_access');
		if(!is_array($this->input->post('files')) or !$this->input->post('name'))
		{
			redirect('folder/create');
		}
		
		$name = $this->input->post('name');
		$desc = $this->input->post('desc');
		$fid = $this->functions->getRandId(8);
		
		$data['fid'] = $fid;
		$this->db->insert('folder', array('name' => $name, 'descr' => $desc, 'f_id' => $fid));
		
		$files = $this->input->post('files');
		foreach($files as $ind => $fileid)
		{
			if($this->files_db->fileExists($fileid))
			{
				$this->db->insert('f_items', array('folder_id'=>$fid, 'file_id' => $fileid));
			}
		}
		
		
		$this->load->view($this->startup->skin.'/header', array('headerTitle' => $this->lang->line('folder_controller_2').' '.$this->startup->site_config['title_separator'].' Done'));
		$this->load->view($this->startup->skin.'/folder/done', $data);
		$this->load->view($this->startup->skin.'/footer');
	}
}
?>