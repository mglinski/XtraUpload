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
 * XtraUpload Admin Action Controller
 *
 * @package		XtraUpload
 * @subpackage	Controllers - Admin
 * @category	Controllers
 * @author		Matthew Glinski
 * @link		http://xtrafile.com/docs/pages/admin/actions
 */

// ------------------------------------------------------------------------

class Actions extends Controller 
{
	public function Actions()
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
		
		$this->load->view($this->startup->skin.'/header', array('headerTitle' => 'Maintenance Actions'));
		$this->load->view($this->startup->skin.'/admin/actions/view', $data);
		$this->load->view($this->startup->skin.'/footer');
	}
	
	public function php_info()
	{
		phpinfo();
	}
	
	public function run_cron()
	{
		define('IN_CRON', TRUE);
		
		$dir = APPPATH."cron";
		$files = opendir($dir);
		
		// Look in the folder for cron files
		while ($file = readdir($files))
		{
			$code = substr($file, 0, 2);
			if ((substr($file, -4, 4) == '.php') and !is_dir($dir .'/'. $file) and !stristr($file, '_no_load'))
			{
				$name = str_replace('.php', '', $file);
				include_once($dir .'/'. $file);
				$cron_extend = new $name(base_url());
				unset($cron_extend);
			}
		}
		closedir ($files);
		
		$this->session->set_flashdata('msg', 'Cron Actions Completed!');
		redirect('admin/actions/view');
	}
	
	public function clear_cache()
	{
		$this->load->helper('file');
		
		delete_files(CACHEPATH);
		write_file(CACHEPATH.'index.html', "<html><head><title>403 Forbidden</title></head><body bgcolor='#ffffff'><p>Directory access is forbidden.<p></body></html>");
		
		$this->session->set_flashdata('msg', 'Cache Files Deleted!');
		redirect('admin/actions/view');
	}
	
	public function update_server_cache()
	{
		$this->load->library('Remote_server_xml_rpc');
		$this->remote_server_xml_rpc->update_cache();
		$this->session->set_flashdata('msg', 'Server Cache Updating Complete!');
		redirect('admin/actions/view');
	}
}