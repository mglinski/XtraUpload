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
 * XtraUpload Files Page Controller
 *
 * @package		XtraUpload
 * @subpackage	Controllers
 * @category	Controllers
 * @author		Matthew Glinski
 * @link		http://xtrafile.com/docs/pages/files
 */

// ------------------------------------------------------------------------

class Cron_file_export
{
	private $CI;
	public function Cron_file_export($server)
	{
		if(!defined('IN_CRON'))
		{
			show_404();	
		}
		
		$this->CI =& get_instance();	
		$this->_runCron();
	}
	
	function index()
	{
		return;
	}
	
	function _runCron()
	{
		// delete file without a DB entry, IE: deleted or baned
		$this->_makeFileXmlList();
	}
	
	function _makeFileXmlList()
	{
		$num = $this->CI->files_db->getNumFiles();
		$files = $this->CI->files_db->getFiles(($num/2), 0, 'link_name, file_id, refrence.is_image, descr, secid, o_filename', true);
		$fp = fopen('filelist_2343.xml', 'w');
		
		fwrite($fp, "<?xml version='1.0' encoding='UTF-8'?>\n<filelist>\n");
		foreach($files->result() as $file)
		{
			$link = $this->files_db->getLinks(NULL, $file);
			$txt = "<file>";
				$txt .= "<name>".$file->o_filename."</name>";
				$txt .= "<desc>".$file->descr."</desc>";
				$txt .= "<url>".$link['down']."</url>";
			$txt .= "</file>\n";
			
			fwrite($fp, $txt);
			unset($file, $link);
		}
		
		unset($files);
		
		$files = $this->CI->files_db->getFiles(($num/2), ($num/2), 'link_name, file_id, refrence.is_image, descr, secid, o_filename', true);
		foreach($files->result() as $file)
		{
			$link = $this->CI->files_db->getLinks(NULL, $file);
			$txt = "<file>";
				$txt .= "<name>".$file->o_filename."</name>";
				$txt .= "<desc>".$file->descr."</desc>";
				$txt .= "<url>".$link['down']."</url>";
			$txt .= "</file>\n";
			
			fwrite($fp, $txt);
			unset($file, $link);
		}
		
		fwrite($fp, "</filelist>");
		fclose($fp);
	}
}
?>