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

class Cron extends Controller 
{
	private $server = false;
	
	public function Cron()
	{
		parent::Controller();
		if(!defined('IN_CRON'))
		{
			show_404();	
		}
		
		$this->server = base_url();
		$this->_runCron();
	}
	
	function index()
	{
		return;	
	}
	
	function _runCron()
	{
		// delete file without a DB entry, IE: deleted or baned
		$this->_pruneDatabaseFiles();
		
		// delete file without a DB entry, IE: deleted or baned
		$this->_pruneFolderFiles('./filestore');
		
		// Delete database entries without files, edge case
		$this->_pruneDatabaseFiles();
		
		// clear temp folder
		$this->_clearTemp();
		
		// run plugin cron files
		$this->_extendCron();
	}
	
	function _extendCron()
	{
		$dir = APPPATH."cron";
		$files = opendir($dir);
		
		// Look in the folder for javascript files
		while ($file = readdir($files))
		{
			$code = substr($file, 0, 2);
			if ((substr($file, -4, 4) == '.php') and !is_dir($dir .'/'. $file) and !stristr($file, '_no_load'))
			{
				$name = str_replace('.php', '', $file);
				include_once($dir .'/'. $file);
				$cron_extend = new $name($this->server);
				unset($cron_extend);
			}
		}
		closedir ($files);
	}
	
	function _pruneFolderFiles($dir)
	{
		$fh = @opendir($dir);
		while ($file = @readdir($fh))
		{
			if (($file != '..' && $file != '.' && $file != 'index.php' && $file != 'index.html' && $file != '.DS_Store' && $file != '.htaccess'))
			{
				if(is_dir($dir . '/' . $file) and $file != '.svn')
				{
					$this->_pruneFolderFiles($dir.'/'.$file);
				}
				else
				{
					$q = $this->db->join('files', 'refrence.link_id = files.id')->get_where('refrence', array("filename" => $file, 'server' => $this->server), 1, 0);
					$num = $q->num_rows();
					if($num == '0' and $file != '.svn')
					{
						$file_obj = $q->row();						
						if(!empty($file_obj->thumb))
						{
							unlink($file_obj->thumb);
						}
						unlink($dir.'/'.$file);
					}
				}
			}
		}
		closedir ($fh);
	}
	
	function _pruneDatabaseFiles()
	{
		$files = $this->db->get_where('files', array('server' => $this->server));
		foreach($files->result() as $file)
		{
			if(!file_exists('./filestore/'.$file->prefix.'/'.$file->filename))
			{
				$this->db->delete('refrence', array('link_id' => $file->id));
				$this->db->delete('files', array('id' => $file->id));
			}
		}
	}
	
	function _pruneExpiredFiles()
	{
		$files = $this->db->join('files', 'refrence.link_id = files.id')->get_where('refrence', array('server' => $this->server));
		foreach($files->result() as $file)
		{
			if(!$file->user)
			{
				$group = 1;
			}
			else
			{
				$group = $this->db->select('group')->get_where('users', array('id' => $file->user))->row()->group;
			}
			$group = $this->db->get_where('groups', array('id' => $group))->row();
			
			if($file->last_download < (time() - (3600 * 24 * $group->file_expire)) and $group->file_expire != 0)
			{
				$this->files_db->deleteFile($file->file_id, $file->secid, $file->link_name);	
			}
		}
	}

	function _clearTemp()
	{
		$temp = @opendir('./temp/');
		while ($file = @readdir($temp))
		{
			if (($file != 'index.php' && $file != 'index.html' && $file != '.DS_Store' && $file != '.htaccess' && !is_dir('./temp/' . $file)))
			{
				unlink('./temp/'.$file);
			}
		}
		@closedir ($temp);
	}
}
?>