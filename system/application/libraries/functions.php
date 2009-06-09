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
 * XtraUpload Functions Library
 *
 * @package		XtraUpload
 * @subpackage	Library
 * @category	Library
 * @author		Matthew Glinski
 * @link		http://xtrafile.com/docs/pages/files
 */

// ------------------------------------------------------------------------

class Functions
{
	function getRandId($length=10)
	{
		$password = "";
		$vals = 'abcdefghijklmnopqrstuvwxyz'.strtoupper('abcdefghijklmnopqrstuvwxyz').'0123456789_-'; 
		
		while (strlen($password) < $length) 
		{
			$num = mt_rand() % strlen($vals);
			
			if($num > 60)
			{
				$num = mt_rand(0, 60);
			}
			
			$password .= substr($vals, $num+4, 1);
		}
		return $password;
	}
	
	function getServerLoad($movingAverage=0) 
    { 
        $stats = explode(' ', substr(exec('uptime'), -14));
        return str_replace(',', '', $stats[$movingAverage]);
    }
	
	public function genPass($length, $caps=true)
	{
		$password = "";
		if(!$caps)
		{
			$vals = 'abchefghjkmnpqrstuvwxyz0123456789'; 
		}
		else
		{
			$vals = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabchefghjkmnpqrstuvwxyz0123456789'; 
		}
		$length;
		while (strlen($password) < $length) 
		{
			mt_getrandmax();
			$num = rand() % strlen($vals);
			$password .= substr($vals, $num+4, 1);
		}
		return $password;
	}
	
	function checkLogin($send='/user/login')
	{
		$CI =& get_instance();
		if(!$CI->session->userdata('id'))
		{
			redirect($send);
			exit();
		}
	}
	
	function elipsis($str, $count = 13)
	{
		if(strlen($str) <= ($count*3))
		{
			return $str;
		}
		
		$parts = str_split($str, 3);
		$i=0;
		$return='';
		while(($count-3) >= ($i))
		{
			$return .= $parts[$i];
			$i++;
		}
		
		$return .= '&hellip;';
		$return .= $parts[(count($parts) - 3)].$parts[(count($parts) - 2)].end($parts);
		return $return;
	}
	
	function is_image($file)
	{
		$img_ext = array('jpg', 'gif', 'jpeg', 'png');
		$file_ext = end(explode('.', basename($file)));
		
		if (in_array(strtolower($file_ext), $img_ext))
		{
			return TRUE;
		}
		else
		{
			return FALSE;
		}

	}
	
	function getFileTypeIcon($type)
	{
		if(file_exists('./img/files/'.$type.'.png'))
		{
			return $type.'.png';
		}
		else
		{
			return 'default.png';
		}
	}
	
	function getJSONFileTypeList()
	{
		return '"3gp", "7z", "aca", "ai", "api", "app", "as", "ascx", "asmx", "asp", "aspx", "avi", "avs", "axt", "bash", "bat", "bmp", "c", "cab", "cal", "cat", "cda", "cf", "chm", "cnf", "conf", "config", "cpl", "cpp", "crt", "cs", "csproj", "css", "csv", "cue", "dar", "db", "dbp", "dem", "disco", "dll", "dng", "doc", "dot", "dpk", "dpr", "dps", "dtq", "dun", "etp", "exe", "fdb", "fhf", "fla", "flv", "fnd", "fon", "gif", "gz", "h", "hlp", "hol", "htm", "html", "htt", "hxc", "hxi", "hxk", "hxs", "hxt", "icm", "ini", "ins", "iqy", "iso", "its", "jar", "java", "jbf", "job", "jpeg", "jpf", "jpg", "js", "lnk", "m3u", "m3v", "m4a", "m4p", "m4v", "mad", "map", "mapup", "mat", "mdb", "mdf", "mht", "mml", "mov", "mp3", "mp4", "mpeg", "mpg", "msc", "msg", "msi", "ncd", "nfo", "none", "nrg", "ogg", "ost", "otf", "pas", "pdf", "pdi", "pet", "pfm", "php", "pif", "plg", "pmc", "", "pot", "ppk", "pps", "ppt", "prf", "psd", "psp", "pub", "qbb", "rar", "rb", "rc", "rct", "rdp", "refresh", "reg", "res", "resx", "rmvb", "rss", "rtf", "sdl", "sea", "sh", "shs", "sln", "sql", "suo", "swf", "tar", "tdf", "tdl", "theme", "tiff", "ttf", "txt", "url", "vb", "vbproj", "vbs", "vcard", "vcf", "vob", "vsmacros", "wab", "wma", "wmv", "wpl", "wri", "wsc", "xhtml", "xla", "xls", "xml", "xpi", "xsd", "xsl", "xslt", "xsn", "zip"';
	}
	
	// Depreciated - USE >> byte_format()
	function getFilesizePrefix($size)
	{
	    if(!function_exists('byte_format'))
	    {
	        $ci =& get_instance();
	        $ci->load->helper('number');
	    }
	    return byte_format($size);
	}
	
	public function parseVersion($v, $details=true)
	{
		if(!stristr($v, ','))
		{
			return 'Not Valid Version Number!';
		}
		
		$parts = explode(',',$v);
		$version = $parts[0];
		
		if($details)
		{
			$part = (int)str_replace('.','',$parts[1]);
			if($part < 10)
			{
				$ver = explode('.',$parts[1]);
				$part = (int)($ver[3]);
				$version .= ' [ALPHA-'.round($part / 1).']';
			}
			else if($part < 100)
			{
				$ver = explode('.',$parts[1]);
				$part = (int)($ver[2].'0');
				$version .= ' [BETA-'.round($part / 10).']';
			}
			else if($part < 1000)
			{
				$ver = explode('.',$parts[1]);
				$part = (int)($ver[1].'00');
				$version .= ' [RC-'.round($part / 100).']';
			}
			else
			{
				if($part > 1000)
				{
					//$version .= '; Build: '.(int)substr($part,1,3);
					$version .= ' r'.(int)substr($part,1,3).' STABLE';
				}
				else
				{
					$version .= ' [STABLE]';
				}
				
			}
		}
		
		return $version;
	}
}
?>