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
 * XtraUpload Stats Page Controller
 *
 * @package		XtraUpload
 * @subpackage	Controllers - Admin
 * @category	Controllers
 * @author		Matthew Glinski
 * @link		http://xtrafile.com/docs/pages/admin/stats
 */

// ------------------------------------------------------------------------

class Stats extends Controller 
{
	public function Stats()
	{
		parent::Controller();		
		$this->load->model('admin_access');
	}
	
	public function index()
	{
		redirect('admin/stats/view');
	}
	
	public function view()
	{
		$this->load->view($this->startup->skin.'/header', array('headerTitle' => 'Site Stats'));
		$this->load->view($this->startup->skin.'/admin/stats');
		$this->load->view($this->startup->skin.'/footer');
	}
}
?>