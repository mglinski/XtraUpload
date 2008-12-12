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
 * XtraUpload XU_API Menu Library
 *
 * @package		XtraUpload
 * @subpackage	Library
 * @category	Library
 * @author		Matthew Glinski
 * @link		http://xtrafile.com/docs/api/menus
 */

// ------------------------------------------------------------------------

class Xu_menus_api
{
	private $store;
	private $CI;
	
	function Xu_menus_api()
	{
		$this->CI =& get_instance();
		log_message('debug', "XtraUpload Menu API Class Initialized");
		$this->init();
	}
	
	private function init()
	{
		$this->store = new stdClass();
		$this->store->main_menu = array();
		$this->store->admin_menu = array();
		$this->store->plugin_menu = array();
		$this->store->sub_menu = array();
	}
	
	function getMainMenu()
	{
		$html = '';
		foreach($this->store->main_menu as $link => $arr)
		{
			if(((isset($item['login']) && $item['login'] == true) && $this->CI->session->userdata('id')) or !isset($item['login']))
			{
				$html .= '<li';
				if(stristr($this->CI->uri->uri_string(),'/'.$link) && !stristr($this->CI->uri->uri_string(),'/admin'))
				{
					$html .= ' id="current"';
				}
				$html .= '><a href="'.site_url($link).'"><img src="'.base_url().$arr['icon'].'" class="nb" alt="" /> '.$arr['text'].'</a></li>';
			}
		}
		return $html;
	}
	
	function addMainMenuLink($link, $text, $icon, $login=false)
	{
		$menu = $this->store->main_menu;
		$menu[$link] = array(
			'icon' => $icon, 
			'text' => $text, 
			'login' => $login
		);
		$this->store->main_menu = $menu;
	}
	
	function removeMainMenuLink($link)
	{
		unset($this->store->main_menu[$link]);
	}
	
	function getAdminMenu()
	{
		$html = '';
		//sort($this->store->admin_menu);
		foreach($this->store->admin_menu as $link => $arr)
		{
			$html .= '<li><a href="'.site_url($link).'"><img src="'.base_url().$arr['icon'].'" class="nb" alt="" /> '.$arr['text'].'</a></li>';
		}
		return $html;
	}
	
	function addAdminMenuLink($link, $text, $icon)
	{
		$menu = $this->store->admin_menu;
		$menu[$link] = array(
			'icon' => $icon, 
			'text' => $text
		);
		$this->store->admin_menu = $menu;
	}
	
	function removeAdminMenuLink($link)
	{
		unset($this->store->admin_menu[$link]);
	}
	
	function getPluginMenu()
	{
		$html = '';
		//sort($this->store->admin_menu);
		foreach($this->store->plugin_menu as $link => $arr)
		{
			$html .= '<li><a href="'.site_url($link).'"><img src="'.base_url().$arr['icon'].'" class="nb" alt="" /> '.$arr['text'].'</a></li>';
		}
		return $html;
	}
	
	function addPluginMenuLink($link, $text, $icon)
	{
		$menu = $this->store->plugin_menu;
		$menu[$link] = array(
			'icon' => $icon, 
			'text' => $text
		);
		$this->store->plugin_menu = $menu;
	}
	
	function removePluginMenuLink($link)
	{
		unset($this->store->plugin_menu[$link]);
	}
	
	function getSubMenu()
	{
		$html = '';
		foreach($this->store->sub_menu as $name => $menu)
		{
			if(stristr($name, '-login'))
			{
				if(!$this->CI->session->userdata('id'))
					continue;
			}
			$name = str_replace('-login', '', $name);
			
			$html .= '<h3>'.$name.'</h3><ul class="sidemenu">';
			
			foreach($menu as $link => $item)
			{
				if(((isset($item['login']) && $item['login'] == true) && $this->CI->session->userdata('id')) or !$item['login'])
				{
					$html .= '<li><a href="'.site_url($item['link']).'"><img src="'.base_url().$item['icon'].'" class="nb" alt="" /> '.$item['text'].'</a></li>';
				}
			}
			$html .= '</ul>';
		}
		
		return $html;
	}
	
	function addSubMenuLink($cat, $link, $text, $icon, $login=false)

	{
		$menu = $this->store->sub_menu;
		if(!isset($menu[$cat]))
		{
			$menu[$cat] = array();
		}
		$menu[$cat][$link] = array(
			'link' => $link, 
			'icon' => $icon, 
			'text' => $text, 
			'login' => $login
		);
		$this->store->sub_menu = $menu;
	}
	
	function removeSubMenuLink($cat, $link)
	{
		unset($this->store->sub_menu[$cat][$link]);
	}
	
	function _getStore($item)
	{
		return $this->store->$item;
	}
}
?>