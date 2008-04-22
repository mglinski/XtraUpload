<?php
/*
XtraUpload - File Hosting Software
Copyright (C) 2006-2007  Matthew Glinski and XtraFile.com
Link: http://www.xtrafile.com
-----------------------------------------------------------------
This program is free software; you can redistribute it and/or
modify it under the terms of the GNU General Public License
as published by the Free Software Foundation; either version 2
of the License, or (at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program(LICENSE.txt); if not, write to the Free Software
Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA  02110-1301, USA.
*/
class rss 
{
	var $rss;
	var $supported;
	var $encoding = '';
	var $pageURL;

	function rss() {
		$this->supported=array(
			'channel' => array('title','link','description', 'pubDate','copyright', 'lastBuildDate', 'image_url', 'image_title', 'image_link','generator'), 
			'item' => array('title', 'description', 'link', 'author', 'pubDate', 'category', 'source', 'source_url','enclosure')
			);	
	
		$this->rss=array();
		$this->rss['channel'] = array();
		$this->rss['channel']['lastBuildDate'] = gmdate('D, d M Y H:i:s').' GMT';
		$this->rss['item'] = array();
	}
	
	function setChannelProperty($key, $value) {
		if (in_array($key, $this->supported['channel']) === false) {
			die("<strong>XML Creation Error</strong><br/>Property '$key' is not suported for 'channel'<br/>\n");
		}
		$this->rss['channel'][$key] = $value;
	}

	function addItem() {
		$this->rss['item'][] = array();
	}
	
	function setItemProperty($key, $value) {
		if (in_array($key, $this->supported['item']) === false) {
			die("<strong>XML Creation Error</strong><br/>Property '$key' is not suported for 'item' <br/>\n");
		}
		$this->rss['item'][count($this->rss['item']) - 1][$key] = $value;
	}

	function getXML($siteurl) 
	{
		$xml = '<rss version="2.0">'."\n";
		$xml.= '<channel>'."\n";
		
		foreach($this->rss['channel'] as $key => $value) {
			if (substr($key,0,6) != 'image_') {
				if ($key=='link') {
					$xml.= '<'.$key.'><![CDATA['.$this->escapeCDATA($this->makeLinkAbs($value)).']]></'.$key.'>'."\n";
				} else {
					$xml.= '<'.$key.'><![CDATA['.$this->escapeCDATA($value).']]></'.$key.'>'."\n";
				}
			}
		}
		if (isset($this->rss['channel']['image_url']) && isset($this->rss['channel']['image_title']) && isset($this->rss['channel']['image_link'])) {
			$xml.= '<image>'."\n";
			$xml.= '<url><![CDATA['.$this->escapeCDATA($this->makeLinkAbs($this->rss['channel']['image_url'])).']]></url>'."\n";
			$xml.= '<title><![CDATA['.$this->escapeCDATA($this->rss['channel']['image_title']).']]></title>'."\n";
			$xml.= '<link><![CDATA['.$this->escapeCDATA($this->makeLinkAbs($this->rss['channel']['image_link'])).']]></link>'."\n";
			$xml.= '</image>'."\n";
		}

		foreach($this->rss['item'] as $tmpKey => $detail) {
					
			$xml.= '<item>'."\n";
			foreach($detail as $key => $value) 
			{
				switch($key) 
				{
					case 'source_url':
						break;
					case 'source':
						if (!isset($detail['source_url'])) {
							$xml.= '<'.$key.'><![CDATA['.$this->escapeCDATA($value).']]></'.$key.'>'."\n";
						} else {
							$xml.= '<'.$key.' url="'.htmlentities($detail['source_url']).'"><![CDATA['.$this->escapeCDATA($value).']]></'.$key.'>'."\n";
						}
					break;
					default:
						if ($key=='link') 
						{
							$xml.= '<'.$key.'><![CDATA['.$this->escapeCDATA($this->makeLinkAbs($value)).']]></'.$key.'>'."\n";
						} 
						else if ($key=='enclosure') 
						{
							$xml.= $value."\n";
						} 
						else 
						{
							$xml.= '<'.$key.'><![CDATA['.$this->escapeCDATA($value).']]></'.$key.'>'."\n";
						}
					break;	
				}
			}
			$xml.= '</item>'."\n";
		}
		$xml.= '</channel></rss>';
		$xml = $this->convertEncoding($xml);
		$xml = "<?xml version=\"1.0\" encoding=\"".$this->encoding."\"?>\n".$xml;
		return $xml;
	}
	
	function setRssEncoding($encoding) {
		$this->encoding = $encoding;
	}
	
	function convertEncoding($str) {
		$ret = $str;
		if ($this->encoding == '') {
			$tmp = array();
			for($i=1;$i<10;$i++) {
				$tmp[] = 'ISO-8859-'.$i;
			}
			$tmp[] = 'UTF-8';
			$tmp[] = 'UTF-16';
			$tmp[] = 'UTF-32';
			if (!function_exists('mb_detect_encoding') || !function_exists('mb_convert_encoding')) {
				die("<strong>XML Creation Error</strong><br/>Please enable 'mbstring' extension from 'php.ini', so the output can be converted to 'UTF-8' encoding,<br/>or use the \"setRssEncoding(\$encoding);\" method of the XML class. <br/>");
			}
			$encoding = mb_detect_encoding($str,$tmp);
			$ret = mb_convert_encoding($ret, 'UTF-8', $encoding);
			$this->setRssEncoding('UTF-8');
		}
		return $ret;
	}
	
	function writeRssXML($siteurl) 
	{
		$ret = $this->getXML($siteurl);
		header("Content-Type: text/xml");
		header("Pragma: no-cache");
		print $ret;
		exit;
	}
	
	function escapeCDATA($data) {
		return str_replace(']]>', ']]&gt;', $data);
	}
	
	function makeLinkAbs($link) {
		if (preg_match("/http:|https:/i", $link)) {
			return $link;
		} else {
			$link = $this->getPageURL() . $link;
			$arr = explode('/', $link);
			$arrT = array();
			foreach ($arr as $val) {
				if ($val=='..') {
					array_pop($arrT);
				} else {
					$arrT[] = $val; 
				}
			}
			return implode('/', $arrT);
		}
	}
	
	function getPageURL() {
		if (!isset($this->pageURL)) {
				if (!isset($_SERVER['PHP_SELF']) && isset($_ENV['PHP_SELF'])) {
					$_SERVER['PHP_SELF'] = $_ENV['PHP_SELF'];
				}
				if (!isset($_SERVER['SERVER_NAME']) && isset($_ENV['SERVER_NAME'])) {
					$_SERVER['SERVER_NAME'] = $_ENV['SERVER_NAME'];
				}
				if (!isset($_SERVER['REQUEST_URI']) && isset($_ENV['REQUEST_URI'])) {
					$_SERVER['REQUEST_URI'] = $_ENV['REQUEST_URI'];
				}
				if (!isset($_SERVER['REQUEST_URI'])) {
					$_SERVER['REQUEST_URI'] = $_SERVER['PHP_SELF'].(isset($_SERVER['QUERY_STRING'])?"?".$_SERVER['QUERY_STRING']:"");
				}
				if (!isset($_SERVER['HTTP_HOST']) && isset($_ENV['HTTP_HOST'])) {
					$_SERVER['HTTP_HOST'] = $_ENV['HTTP_HOST'];
				}
				if (!isset($_SERVER['HTTP_HOST']) && isset($_SERVER['SERVER_NAME'])) {
					$_SERVER['HTTP_HOST'] = $_SERVER['SERVER_NAME'];
				}
				if (!isset($_SERVER['HTTPS']) && isset($_ENV['HTTPS'])) {
					$_SERVER['HTTPS'] = $_ENV['HTTPS'];
				}
				// server
				$protocol = 'http';
				if (isset($_SERVER['HTTPS']) && strtolower($_SERVER['HTTPS']) == 'on') {
					$protocol = 'https';
				}
				$host = $_SERVER['HTTP_HOST'];
				$server = $protocol . '://' . $host;
				if (substr($server, -1)=='/') {
					$server = substr($server, 0, strlen($server)-1);
				}
				//page
				$script = $_SERVER['REQUEST_URI'];
				if (strpos($script, '?') !== false) {
					$pos = strpos($script, '?');
					$script = substr($script, 0, $pos);
				}
				if (substr($script, -1) == '/') {
					$file = basename($_SERVER['PHP_SELF']);
					$script .= $file;
				}
				if (isset($_SERVER['PATH_INFO']) && $_SERVER['PATH_INFO'] != '' && $_SERVER['PATH_INFO'] != $_SERVER['PHP_SELF']) {
					$script = substr($script, 0, strlen($script) - strlen($_SERVER['PATH_INFO']));
				}
				$arr = explode("/", $script);
				array_pop($arr);
				$this->pageURL = $server . '' . implode("/", $arr) . (count($arr)==1?'/':'');
				if (substr($this->pageURL, -1)!='/') {
					$this->pageURL .= '/';
				}
		}
		return $this->pageURL;
	}
}
?>