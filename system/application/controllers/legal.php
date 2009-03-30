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
 * XtraUpload Cron Controller
 *
 * @package		XtraUpload
 * @subpackage	Controllers
 * @category	Controllers
 * @author		Matthew Glinski
 * @link		http://xtrafile.com/docs/cron
 */

// ------------------------------------------------------------------------

class Legal extends Controller 
{
	private $server = false;
	
	public function Legal()
	{
		parent::Controller();
		
	}
	
	function index()
	{
		return;	
	}
	
	function tos()
	{
		$data=array();
		$data['site_name'] = $this->startup->site_config['sitename'];
		$this->load->view($this->startup->skin.'/header', array('headerTitle' => 'Terms Of Service'));
		$this->load->view($this->startup->skin.'/legal/tos', $data);
		$this->load->view($this->startup->skin.'/footer');
		return;	
	}
	
	function privacy()
	{
		$this->load->view($this->startup->skin.'/header', array('headerTitle' => 'Privacy Policy'));
		$this->load->view($this->startup->skin.'/legal/privacy');
		$this->load->view($this->startup->skin.'/footer');
		return;	
	}
}