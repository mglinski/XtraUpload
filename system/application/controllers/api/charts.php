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
 * XtraUpload Charts API Controller
 *
 * @package		XtraUpload
 * @subpackage	Controllers - API
 * @category	Controllers
 * @author		Matthew Glinski
 * @link		http://xtrafile.com/docs/pages/api/charts
 */

// ------------------------------------------------------------------------

class Charts extends Controller 
{
	public function Charts()
	{
		parent::Controller();	
		$this->load->model('admin_access');
		$this->load->model('server/server_db');
	}
	
	public function all_downloads($height=300,$width=300,$ignore='')
	{
		$this->load->view($this->startup->skin.'/api/charts/all_downloads', array('width' => $width, 'height' => $height));
	}
	
	public function all_images_vs_regular($height=300,$width=300,$ignore='')
	{
		$this->load->view($this->startup->skin.'/api/charts/all_images_vs_regular', array('width' => $width, 'height' => $height));
	}
	
	public function all_remote_vs_host_uploads($height=300,$width=300,$ignore='')
	{
		$this->load->view($this->startup->skin.'/api/charts/all_remote_vs_host_uploads', array('width' => $width, 'height' => $height));
	}
	
	public function all_server_uploads($height=300,$width=300,$ignore='')
	{
		$data = array('width' => $width, 'height' => $height, 'servers' => $this->server_db->getServers());
		$this->load->view($this->startup->skin.'/api/charts/all_server_uploads', $data);
	}
	
	public function all_server_used_space($height=300,$width=300,$ignore='')
	{
		$data = array('width' => $width, 'height' => $height, 'servers' => $this->server_db->getServers());
		$this->load->view($this->startup->skin.'/api/charts/all_server_used_space', $data);
	}
	
	public function all_uploads($height=300,$width=300,$ignore='')
	{
		$this->load->view($this->startup->skin.'/api/charts/all_uploads', array('width' => $width, 'height' => $height));
	}
	
	public function downloads_weekly($height=300,$width=300,$ignore='')
	{
		$this->load->view($this->startup->skin.'/api/charts/downloads_weekly', array('width' => $width, 'height' => $height));
	}
	
	public function images_vs_regular_weekly($height=300,$width=300,$ignore='')
	{
		$this->load->view($this->startup->skin.'/api/charts/images_vs_regular_weekly', array('width' => $width, 'height' => $height));
	}
	
	public function remote_vs_host_uploads_weekly($height=300,$width=300,$ignore='')
	{
		$this->load->view($this->startup->skin.'/api/charts/remote_vs_host_uploads_weekly', array('width' => $width, 'height' => $height));
	}
	
	public function total_new_users_weekly($height=300,$width=300,$ignore='')
	{
		$this->load->view($this->startup->skin.'/api/charts/total_new_users_weekly', array('width' => $width, 'height' => $height));
	}
	
	public function uploads_weekly($height=300,$width=300,$ignore='')
	{
		$this->load->view($this->startup->skin.'/api/charts/uploads_weekly', array('width' => $width, 'height' => $height));
	}
}
?>