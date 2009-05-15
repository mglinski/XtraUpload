<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
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
 * XtraUpload Startup Library
 *
 * @package		XtraUpload
 * @subpackage	Model
 * @category	Model
 * @author		Matthew Glinski
 * @link		http://xtrafile.com/docs/pages/files
 */

// ------------------------------------------------------------------------

class Startup
{
	public $skin = '';
	public $site_config = '';
	public $group_config = '';
	private $CI = '';
	
	/**
	 * Startup()
	 *
	 * Runs before all other custom files, loading all required subsystems and settings.
	 *
	 * @access	public
	 * @return	none
	 */
    public function Startup()
    {
		// Define the path to the cache folder
		define('CACHEPATH', BASEPATH.'cache/');
		
		// Define Hard Coded Script Version
		include('xu_ver.php');
		define('XU_VERSION', $version);
		
		$this->CI =& get_instance();
		
		//$this->CI->output->enable_profiler(TRUE);
		
		// Load the DB and session class
		$this->CI->load->database();
		$this->CI->load->library('session');
		
		// Load 2 helpers
		$this->CI->load->helper(array('url', 'cssbutton'));
		
		// Setup group config object
		$this->group_config = new stdClass();
		
		// Get the active skin name
		$this->getSkin();
		
		// Get the sitewide config settings
		$this->getConfig();
		
		// Get the user group config settings for the accessing user
		$this->getGroup();
		
		// Define system wide view vars
		$this->CI->load->vars(array(
			'base_url' => base_url(),
			'server_url' => base_url(),
			'skin' => $this->skin
		));
		
		// Load General Functions and XU API
		$this->CI->load->library(array('functions', 'xu_api'));
		
		// Readable XtraUpload Version String
		define('XU_VERSION_READ', $this->CI->functions->parseVersion(XU_VERSION));
		
		// Load site menus
		$this->setupMenu();
		
		// Load the Files Subsystem and the USers subsystem
		$this->CI->load->model(array('users', 'files/files_db'));
		
		// Load the global language bits, header, footer, and menu
		$this->CI->lang->load('global');
		
		// load all custom startup files
		$this->runStartup();
    }
	
	// ------------------------------------------------------------------------

	/**
	 * Startup->getSkin()
	 *
	 * loads active skin
	 *
	 * @access	public
	 * @return	none
	 */
	private function getSkin()
	{
		// Encrypt the cache filename for security
		$skin_name = md5($this->CI->config->config['encryption_key'].'skin_name');
		
		// Check if the cache file previously exists
		if(file_exists(CACHEPATH . $skin_name))
		{
			// Dont wast time with the DB, load the cached version
			$this->skin = $this->CI->input->xss_clean($this->CI->load->file(CACHEPATH . $skin_name , true));
		}
		else
		{
			// Ugh, no cache file. Lets fix that!
			
			// Get skin name from DB
			$this->skin = $this->CI->db->get_where('skin', array('active' => '1'))->row()->name;
			
			// Save the config object to cache for increased performance
			file_put_contents(CACHEPATH . $skin_name , $this->skin);
		}
	}
	
	// ------------------------------------------------------------------------

	/**
	 * Startup->getConfig()
	 *
	 * loads site config
	 *
	 * @access	public
	 * @return	none
	 */
	private function getConfig()
	{
		// Encrypt the cache filename for security
		$config_file_name = md5($this->CI->config->config['encryption_key'].'site_config');
		
		// Check if the cache file previously exists
		if(file_exists(CACHEPATH . $config_file_name))
		{
			// Dont wast time with the DB, load the cached version
			$this->site_config = unserialize(base64_decode($this->CI->load->file(CACHEPATH . $config_file_name, true)));
		}
		else
		{
			// Get config object from DB
			$q = $this->CI->db->get('config');
			foreach($q->result() as $row)
			{
				// load each value into a global scope, a public class var
				$this->site_config[$row->name] = $row->value;
			}
			
			// Save the config object to cache for increased performance
			file_put_contents(CACHEPATH . $config_file_name, base64_encode(serialize($this->site_config)));
		}
	}
	
	// ------------------------------------------------------------------------

	/**
	 * Startup->getGroup()
	 *
	 * Loads user group for accessing user
	 *
	 * @access	public
	 * @return	none
	 */
	public function getGroup($gid='')
	{
		if($gid != '')
		{
			$group = $gid;
			$this->group_config = $this->CI->db->get_where('groups', array('id' => $group))->row();
			return;
		}
		else
		{
			if($this->CI->session->userdata('group'))
			{
				$group = $this->CI->session->userdata('group');
			}
			else
			{
				$group = 1;
			}
		}
		
		// Encrypt the cache filename for security
		$group_file_name = md5($this->CI->config->config['encryption_key'].'group_'.$group);
		
		// Check if the cache file previously exists
		if(file_exists(CACHEPATH . $group_file_name))
		{
			// Dont wast time with the DB, load the cached version
			$this->group_config = unserialize(base64_decode($this->CI->load->file(CACHEPATH . $group_file_name, true)));
		}
		else
		{
			// Get group object from DB
			$this->group_config = $this->CI->db->get_where('groups', array('id' => $group))->row();
			
			// Save the group object to cache for increased performance
			file_put_contents(CACHEPATH . $group_file_name, base64_encode(serialize($this->group_config)));
		}
	}
	
	// ------------------------------------------------------------------------

	/**
	 * Startup->runStartup()
	 *
	 * Loads all installed and active plugins
	 *
	 * @access	public
	 * @return	none
	 */
	private function runStartup()
	{
		$extend_file_name = md5($this->CI->config->config['encryption_key'].'extend');
		if(file_exists(CACHEPATH . $extend_file_name))
		{
			$extend = unserialize(base64_decode($this->CI->load->file(CACHEPATH . $extend_file_name, true)));
			
			// Open a known directory, and proceed to read its contents
			foreach($extend as $app)
			{
				$this->CI->load->extention($app);
			}
		}
	}
	
	// ------------------------------------------------------------------------

	/**
	 * Startup->setupMenu()
	 *
	 * Loads the default site menus
	 *
	 * @access	public
	 * @return	none
	 */
	private function setupMenu()
	{
		// load main menu links
		$this->CI->xu_api->menus->addMainMenuLink('home', 'Home', 'img/other/home2_16.png');
		
		// can user access URL Uploading?
		if($this->group_config->can_url_upload)
		{
			$this->CI->xu_api->menus->addMainMenuLink('upload/url', 'URL Upload', 'img/icons/connect_16.png');
		}
		
		// can user access search page?
		if($this->group_config->can_search)
		{
			$this->CI->xu_api->menus->addMainMenuLink('files/search', 'Search', 'img/icons/search_16.png');
		}
		
		// can user access the admin panel?
		if($this->group_config->admin)
		{
			$this->CI->xu_api->menus->addMainMenuLink('admin/home', 'Admin', 'img/other/admin_16.png');
		}
		
		// load either admin or user manu links
		if(substr($this->CI->uri->uri_string(), 0, 7) == '/admin/')
		{
			$this->CI->xu_api->menus->addAdminMenuLink('/admin/config', 'Site Config', 'img/icons/options_16.png');
			$this->CI->xu_api->menus->addAdminMenuLink('/admin/files/view', 'Files', 'img/icons/hard_disk_16.png');
			$this->CI->xu_api->menus->addAdminMenuLink('/admin/email/view', 'Mass Emailer', 'img/icons/mail_16.png');
			$this->CI->xu_api->menus->addAdminMenuLink('/admin/extend/view', 'Plugins', 'img/icons/component_16.png');
			$this->CI->xu_api->menus->addAdminMenuLink('/admin/skin/view', 'Skins', 'img/icons/colors_16.png');
			$this->CI->xu_api->menus->addAdminMenuLink('/admin/gateways/view', 'Payment Gateways', 'img/icons/credit_card_16.png');
			
			$this->CI->xu_api->menus->addAdminMenuLink('/admin/transactions/view', 'Transactions', 'img/icons/transaction_16.png');
			
			$this->CI->xu_api->menus->addAdminMenuLink('/admin/server/view', 'Servers', 'img/other/server_16.png');
			$this->CI->xu_api->menus->addAdminMenuLink('/admin/stats/view', 'Site Stats', 'img/icons/chart_16.png');
			$this->CI->xu_api->menus->addAdminMenuLink('/admin/translator', 'Translation', 'img/icons/spelling_16.png');
			$this->CI->xu_api->menus->addAdminMenuLink('/admin/actions/view', 'Tools/Maintenance', 'img/icons/tools_16.png');
			$this->CI->xu_api->menus->addAdminMenuLink('/admin/user/view', 'Users', 'img/icons/user_16.png');
			$this->CI->xu_api->menus->addAdminMenuLink('/admin/group/view', 'User Groups', 'img/icons/user_group_16.png');
			
			$this->CI->xu_api->menus->addPluginMenuLink('/admin/config/plugin', 'Plugin Config', 'img/icons/options_16.png');
		}
		else
		{
			$this->CI->xu_api->menus->addSubMenuLink('Files', 'home', 'Upload', 'img/other/upload_16.png');
			$this->CI->xu_api->menus->addSubMenuLink('Files', 'files/manage', 'Manage', 'img/other/manage-files_16.png', true);
			$this->CI->xu_api->menus->addSubMenuLink('Create-login', 'folder/create', 'File Folder', 'img/icons/folder_16.png');
			$this->CI->xu_api->menus->addSubMenuLink('Create-login', 'image/createGallery', 'Image Gallery', 'img/other/images_16.png');
		}
		
		// Enable embed code for MP3s
		$this->CI->xu_api->embed->addEmbedType('mp3', array('width' => '470', 'height' => '20', 'speed' => '50'));
	}
}
?>