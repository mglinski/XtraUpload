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
class news
{

	function make($area = 'news')
	{
		global $db, $lang;	
		
		if($area == 'home') 
		{
			$sql = "SELECT * FROM `news` ORDER BY `id` DESC  LIMIT 0 ,3";
		}
		else if($area == 'news')
		{
			$sql = "SELECT * FROM `news` ORDER BY `id` DESC  LIMIT 0 ,10";
		}
		else if($area == 'archive')
		{
			$sql = "SELECT * FROM `news` ORDER BY `id` DESC  ";
		}
		
		$qr1 = $db->query($sql);	
		$block = '';
		while($c = $db->fetch($qr1,"obj"))
		{
			$block .= '
<table width="494" border="1" cellspacing="0" cellpadding="3" align="center" bordercolor="#000000" style="border:1px solid #000000">
  <tr>
    <td width="494" height="23"><table width="533" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td width="304" height="21">'.$c->title.'</td>
        <td width="229"><div align="right">'.$lang['news']['1'].$c->date.'</div></td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td height="76">'.$c->news.'</td>
  </tr>
  <tr>
    <td height="30"><div align="right">'.$lang['news']['2'].$c->author.'</div></td>
  </tr>
</table><br />
<br />
';
		}
		
		return $block;
	}
	
}// END CLASS
?>