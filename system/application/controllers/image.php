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
 * XtraUpload Image Page Controller
 *
 * @package		XtraUpload
 * @subpackage	Controllers
 * @category	Controllers
 * @author		Matthew Glinski
 * @link		http://xtrafile.com/docs/pages/files
 */

// ------------------------------------------------------------------------


class Image extends Controller 
{
	public function Image()
	{
		parent::Controller();
		$this->load->model('files/files_db');
		$this->load->library('functions');
		$this->lang->load('image');
	}
	
	public function index()
	{
		redirect('home');
	}
	
	public function show($id, $name)
	{
		$links = $this->files_db->getImageLinks($id, $name);
		if(!$links)
		{
			redirect('home');
		}
		$links['down'] = $this->files_db->getDownloadLink($id);
		$links['file'] = $this->files_db->getFileObject($id);
		$this->load->view($this->startup->skin.'/header', array('headerTitle' => $this->lang->line('image_controller_1').' '.$this->startup->site_config['title_separator'].' '.$name));
		$this->load->view($this->startup->skin.'/image/home', $links);
		$this->load->view($this->startup->skin.'/footer');
	}
	
	public function links($id, $name)
	{
		$links = $this->files_db->getImageLinks($id, $name);
		if(!$links)
		{
			redirect('home');
		}
		
		if($this->startup->site_config['no_php_images'])
		{
			$links['direct_url'] = base_url().$links['img_path'];
			$links['thumb_url'] = base_url().$links['thumb_path'];
		}
		
		$links['down'] = $this->files_db->getDownloadLink($id);
		
		$this->load->view($this->startup->skin.'/header', array('headerTitle' => $this->lang->line('image_controller_2')));
		$this->load->view($this->startup->skin.'/image/links', $links);
		$this->load->view($this->startup->skin.'/footer');
	}
	
	public function thumb($id, $name)
	{
		$file = $this->files_db->getFileObject($id);
		$type = strtolower($file->type);
		
		if($type == "gif")
		{
			$type == 'gif';
		}
		else if($type == "bmp")
		{
			$type == 'bmp';
		}
		else if($type == "jpg")
		{
			$type == 'jpeg';
		}
		else if($type == "png")
		{
			$type == 'png';
		}
	
		header("Content-type: image/".$type);
		echo file_get_contents($file->thumb);
	}
	
	public function direct($id, $name)
	{
		$file = $this->files_db->getFileObject($id);
		$this->files_db->addToDownloads($id);
		$type = strtolower($file->type);
		
		if($type == "gif")
		{
			$type == 'gif';
		}
		else if($type == "bmp")
		{
			$type == 'bmp';
		}
		else if($type == "jpg")
		{
			$type == 'jpeg';
		}
		else if($type == "png")
		{
			$type == 'png';
		}
	
		header("Content-type: image/".$type);
		echo file_get_contents($file->filename);
	}
	
	public function gallery($id)
	{
		$data['gall'] = $this->db->get_where('gallery', array('g_id' => $id))->row();
		$data['gall_imgs'] = $this->db->get_where('g_items', array('gid' => $id));
		$data['id'] = $id;
		$this->load->view($this->startup->skin.'/header', array('headerTitle' => $this->lang->line('image_controller_3').' '.$this->startup->site_config['title_separator'].' '.$data['gall']->name));
		$this->load->view($this->startup->skin.'/image/gallery/view', $data);
		$this->load->view($this->startup->skin.'/footer');
	}
	
	public function createGallery()
	{
		$this->load->model('user_access');
		$data['files'] = $this->files_db->getImages();
		
		$this->load->view($this->startup->skin.'/header', array('headerTitle' => $this->lang->line('image_controller_4')));
		$this->load->view($this->startup->skin.'/image/gallery/create', $data);
		$this->load->view($this->startup->skin.'/footer');
	}
	
	public function processNewGallery()
	{
		$this->load->model('user_access');
		if(!is_array($this->input->post('files')) or !$this->input->post('name'))
		{
			redirect('image/createGallery');
		}
		
		$name = $this->input->post('name');
		$desc = $this->input->post('desc');
		$gid = $this->functions->getRandId(8);
		$data['gid'] = $gid;
		$this->db->insert('gallery', array('name' => $name, 'descr' => $desc, 'g_id' => $gid));
		
		$files = $this->input->post('files');
		foreach($files as $file)
		{
			$fileObj = $this->files_db->_getFileObject($file);
			$image = $this->files_db->getImageLinks($fileObj->file_id);
			
			$this->db->insert('g_items', array('gid' => $gid, 'thumb' => $image['thumb_url'], 'direct' => $image['direct_url'], 'view' => $image['img_url'], 'fid' => $fileObj->file_id));
		}
		
		$this->load->view($this->startup->skin.'/header', array('headerTitle' => $this->lang->line('image_controller_4').' '.$this->startup->site_config['title_separator'].' '.$this->lang->line('image_controller_5')));
		$this->load->view($this->startup->skin.'/image/gallery/done', $data);
		$this->load->view($this->startup->skin.'/footer');
	}
}
?>