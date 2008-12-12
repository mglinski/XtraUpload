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
 * XtraUpload Home Page Controller
 *
 * @package		XtraUpload
 * @subpackage	Controllers - Admin
 * @category	Controllers
 * @author		Matthew Glinski
 * @link		http://xtrafile.com/docs/pages/files
 */

// ------------------------------------------------------------------------

class Home extends Controller 
{
	public function Home()
	{
		parent::Controller();		
		$this->load->model('admin_access');
		$this->load->model('server/server_db');
	}
	
	public function index()
	{
		if(!stristr($this->uri->uri_string(), '/admin/home'))
		{
			redirect('/admin/home');
		}
		$this->load->vars(array('servers' => $this->server_db->getServers()));
		
		$this->load->view($this->startup->skin.'/header', array('headerTitle' => 'Admin Home'));
		$this->load->view($this->startup->skin.'/admin/home');
		$this->load->view($this->startup->skin.'/footer');
	}
}
?>