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
include('./include/template/class.template.php');
class template extends Template_Lite 
{ 
    function template() 
	{
		global $db;
		$this->Template_Lite();
		
		$skin = $db->fetch($db->query("SELECT * FROM `skin` WHERE `active` = 1"));
		$skin = $skin->name;
		
        $this->template_dir = 'skin/'.$skin;
        $this->compile_dir = 'cache/compile';
        $this->config_dir = 'cache/smarty/configs';
        $this->cache_dir = 'cache/smarty/cache';
		
		$this->left_delimiter = '<{';
		$this->right_delimiter = '}>';
		$this->php_handling = SMARTY_PHP_ALLOW;
    }
}
?>