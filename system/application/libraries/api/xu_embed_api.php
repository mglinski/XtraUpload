<?php  if (!defined('BASEPATH')) exit('No direct script access allowed');
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
 * XtraUpload XU_API Hooks Library
 *
 * @package		XtraUpload
 * @subpackage	Library
 * @category	Library
 * @author		Matthew Glinski
 * @link		http://xtrafile.com/docs/api/hooks
 */

// ------------------------------------------------------------------------

class Xu_embed_api
{
	private $store;
	private $CI;
	
	function Xu_embed_api()
	{
		$this->CI =& get_instance();
		log_message('debug', "XtraUpload Embed Code API Class Initialized");
		$this->init();
	}
	
	private function init()
	{
		$this->store = new stdClass();
		$this->store->embed = array();
	}
	
	public function addEmbedType($type, $data)
	{
		$this->store->embed[$type] = $data;
	}
	
	public function removeEmbedType($type)
	{
		unset($this->store->embed[$type]);
	}
	
	public function getEmbedCode($type)
	{
		if(!isset($this->store->embed[$type]) or !is_array($this->store->embed[$type]))
		{
			return false;	
		}
		return $this->store->embed[$type];
	}
	
	public function _getEmbedStore()
	{
		return $this->store;
	}
	
	public function _putEmbedStore($store)
	{
		$this->store = $store;
	}
}
?>