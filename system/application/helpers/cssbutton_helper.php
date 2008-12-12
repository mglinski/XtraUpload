<?php if (!defined('BASEPATH')) { die('No direct script access allowed'); }
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
 * XtraUpload CSS Button Helper
 *
 * @package		XtraUpload
 * @subpackage	Helper
 * @category	Helper
 * @author		Matthew Glinski
 * @link		http://xtrafile.com/docs/pages/files
 */

// ------------------------------------------------------------------------

if (! function_exists('generateCSS'))
{
	function generateCSSForButtons($addStyleTags)
	{
		
		$css = '/* BUTTONS */
span.cssbutton
{
	clear:left;
}

span.cssButton a, span.cssButton button
{
	display:block;
	float:left;
	margin:0 7px 0 0;
	background-color:#f5f5f5;
	border:1px solid #dedede;
	border-top:1px solid #eee;
	border-left:1px solid #eee;
	font-family:"Lucida Grande", Tahoma, Arial, Verdana, sans-serif;
	font-size:100%;
	line-height:130%;
	text-decoration:none;
	font-weight:bold;
	color:#565656;
	cursor:pointer;
	padding:5px 10px 6px 7px; /* Links */
}

span.cssButton button
{
	width:auto;
	overflow:visible;
	padding:4px 10px 3px 7px; /* IE6 */
}

span.cssButton button[type]
{
	padding:5px 10px 5px 7px; /* Firefox */
	line-height:17px; /* Safari */
}

*:first-child+html button[type] { padding:4px 10px 3px 7px; /* IE7 */ }

span.cssButton button img, span.cssButton a img
{
	margin:0 3px -3px 0 !important;
	padding:0;
	border:none;
	width:16px;
	height:16px;
}

/* STANDARD */

button:hover, span.cssButton a:hover
{
	background-color:#dff4ff;
	border:1px solid #c2e1ef;
	color:#336699;
}

span.cssButton a:active
{
	background-color:#6299c5;
	border:1px solid #6299c5;
	color:#fff;
}

/* buttonGreen */

button.buttonGreen, span.cssButton a.buttonGreen { color:#529214; }

span.cssButton a.buttonGreen:hover, button.buttonGreen:hover
{
	background-color:#E6EFC2;
	border:1px solid #C6D880;
	color:#529214;
}

span.cssButton a.buttonGreen:active
{
	background-color:#529214;
	border:1px solid #529214;
	color:#fff;
}

/* buttonRed */

span.cssButton a.buttonRed, button.buttonRed { color:#d12f19; }

span.cssButton a.buttonRed:hover, button.buttonRed:hover
{
	background:#fbe3e4;
	border:1px solid #fbc2c4;
	color:#d12f19;
}

span.cssButton a.buttonRed:active
{
	background-color:#d12f19;
	border:1px solid #d12f19;
	color:#fff;
}
';
		if($addStyleTags)
		{
			return "<style type='text/css'>\n".$css."\n</style>";
		}
		else
		{
			return $css;
		}
	}	
}

// ------------------------------------------------------------------------

/**
 * Generate Link Button - Make a button with an <a> element
 *
 * @access	public
 * @param	string
 * @param	string
 * @param	string
 * @param	bool
 * @return	string
 */	
if (! function_exists('generateLinkButton'))
{
	function generateLinkButton($text, $link, $icon=NULL, $color=NULL, $attributes=NULL)
	{
		$buttonHTML = '';
		$buttonHTML .= '<span class="cssButton"><a href="'.$link.'"';
		
		if($color != NULL)
		{
			if($color == 'green')
			{
				$buttonHTML .= ' class="buttonGreen"';
			}
			else if($color == 'red')
			{
				$buttonHTML .= ' class="buttonRed"';
			}
		}
		
		if (is_array($attributes) AND count($attributes) > 0)
		{
			foreach ($attributes as $key => $val)
			{
				$buttonHTML .= ' '.$key.'="'.$val.'"';
			}
		}
		
		$buttonHTML .= '>';
		if($icon != NULL)
		{
			$buttonHTML .= ' <img src="'.$icon.'" alt=""/>';
		}
		$buttonHTML .= ' '.$text.' </a></span>'."\n"; 
		return $buttonHTML;
	}	
}

// ------------------------------------------------------------------------

/**
 * Generate Link Button - Make a button with an <a> element
 *
 * @access	public
 * @param	string
 * @param	string
 * @param	string
 * @param	bool
 * @return	string
 */	
if (! function_exists('generateSubmitButton'))
{
	function generateSubmitButton($text, $icon=NULL, $color=NULL, $attributes=NULL)
	{
		$buttonHTML = '';
		$buttonHTML .= '<span class="cssButton"><button type="submit"';
		
		if($color != NULL)
		{
			if($color == 'green')
			{
				$buttonHTML .= ' class="buttonGreen"';
			}
			else if($color == 'red')
			{
				$buttonHTML .= ' class="buttonRed"';
			}
		}
		
		if (is_array($attributes) AND count($attributes) > 0)
		{
			foreach ($attributes as $key => $val)
			{
				$buttonHTML .= ' '.$key.'="'.$val.'"';
			}
		}
		
		$buttonHTML .= '>';
		if($icon != NULL)
		{
			$buttonHTML .= ' <img src="'.$icon.'" alt=""/>';
		}
		$buttonHTML .= ' '.$text.' </button></span>'."\n"; 
		return $buttonHTML;
	}	
}
?>