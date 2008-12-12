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

class Xu_hooks_api
{
	private $store;
	private $CI;
	
	function Xu_hooks_api()
	{
		$this->CI =& get_instance();
		log_message('debug', "XtraUpload Hooks API Class Initialized");
		$this->init();
	}
	
	private function init()
	{
		$this->store = new stdClass();
		$this->store->hooks = array();
	}
	
	// Create API hook
	function setHook($name, $functionName, $sid)
	{
		if(!isset($this->store->hooks[$name]))
		{
			$this->store->hooks[$name] = array();
		}
		$this->store->hooks[$name][$sid] = $functionName;
	}
	
	// Delete your API hook
	function deleteHook($name, $sid)
	{
		if(!isset($this->store->hooks[$name]))
		{
			return false;
		}
		unset($this->store->hooks[$name][$sid]);
	}
	
	// [SYSTEM] -> run hooks for a function
	function _runHook($name, $vars=array())
	{
		if(!isset($this->store->hooks[$name]))
		{
			return false;
		}
		
		foreach($this->store->hooks[$name] as $k => $function)
		{
			$function($vars);
		}
		
		return $vars;
	}
	
	// [SYSTEM] -> return the raw hooks store variable
	function _getStore($item='hooks')
	{
		return $this->store->$item;
	}
}
?>