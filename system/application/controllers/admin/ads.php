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
 * XtraUpload Ad Manager - Plugin
 *
 * @package		XtraUpload
 * @subpackage	Controllers - Admin
 * @category	Controllers
 * @author		Matthew Glinski
 * @link		http://xtrafile.com/docs/plugins/ads
 */

// ------------------------------------------------------------------------

class Ads extends Controller 
{
	public function Ads()
	{
		parent::Controller();		
		$this->load->model('admin_access');
		$this->load->model('ads/ads_db');
	}
	
	public function index()
	{
		redirect('admin/ads/view');
	}
	
	public function view()
	{
		$data['flashMessage'] = '';
		if($this->session->flashdata('msg'))
		{
			$data['flashMessage'] = '<span class="info"><b>'.$this->session->flashdata('msg').'</b></span>';
		}
		
		$data['ads'] = $this->ads_db->getAds();
		
		$this->load->view($this->startup->skin.'/header', array('headerTitle' => 'Advert Manager'));
		$this->load->view($this->startup->skin.'/admin/ads/view', $data);
		$this->load->view($this->startup->skin.'/footer');
	}
	
	public function add()
	{
		if($this->input->post('name'))
		{
			$this->ads_db->insert($_POST);
			$this->session->set_flashdata('msg', 'Advert Added!');
			redirect();
		}
		
		$data['flashMessage'] = '';
		if($this->session->flashdata('msg'))
		{
			$data['flashMessage'] = '<span class="info"><b>'.$this->session->flashdata('msg').'</b></span>';
		}
		
		$data['ads'] = $this->ads_db->getAds();
		
		$this->load->view($this->startup->skin.'/header', array('headerTitle' => 'Advert Manager'));
		$this->load->view($this->startup->skin.'/admin/ads/add', $data);
		$this->load->view($this->startup->skin.'/footer');
	}


	public function edit($id)
	{
		if(intval($id) == 0))
		{
			redirect('admin/ads/view');
		}
		
		if($this->input->post('name'))
		{
			$this->ads_db->insert($_POST);
			$this->session->set_flashdata('msg', 'Advert Edited!');
			redirect();
		}
		
		$data['flashMessage'] = '';
		if($this->session->flashdata('msg'))
		{
			$data['flashMessage'] = '<span class="info"><b>'.$this->session->flashdata('msg').'</b></span>';
		}
		
		$data['ads'] = $this->ads_db->getAds();
		
		$this->load->view($this->startup->skin.'/header', array('headerTitle' => 'Advert Manager'));
		$this->load->view($this->startup->skin.'/admin/ads/edit', $data);
		$this->load->view($this->startup->skin.'/footer');
	}

	public function turn_on($id)
	{
		if(intval($id) != 0))
		{
			$this->ads_db->turn_on(intval($id));
			$this->session->set_flashdata('msg', 'Advert Turned On!');
			redirect();
		}
	}
	
	public function turn_off($id)
	{
		if(intval($id) != 0))
		{
			$this->ads_db->turn_off(intval($id));
			$this->session->set_flashdata('msg', 'Advert Turned Off!');
			redirect();
		}
	}
	public function delete($id)
	{
		if(intval($id) != 0))
		{
			$this->ads_db->delete(intval($id));
			$this->session->set_flashdata('msg', 'Advert Deleted!');
			redirect();
		}
	}
}