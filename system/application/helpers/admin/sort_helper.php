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
 * XtraUpload Admin Sort Helper
 *
 * @package		XtraUpload
 * @subpackage	Helper
 * @category	Helper
 * @author		Matthew Glinski
 * @link		http://xtrafile.com/docs/pages/files
 */

// ------------------------------------------------------------------------

function getSortLink($item, $sort, $dir)
{
	if($item == $sort)
	{
		if($dir == 'desc')
		{
			return "sortForm('".$item."', 'asc')";
		}
		else
		{
			return "sortForm('".$item."', 'desc')";
		}
	}
	else
	{
		return "sortForm('".$item."', 'desc')";
	}
}

function getSortArrow($item, $sort, $dir)
{
	if($sort == $item )
	{
		if($dir == 'asc')
		{
			?><img src="<?=base_url()?>img/fam/bullet_up.png" alt="" class="nb" /><?
		}
		else
		{
			?><img src="<?=base_url()?>img/fam/bullet_down.png" alt="" class="nb" /><?
		}
	}
}
?>