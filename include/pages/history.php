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
if($_SESSION['loggedin'])
{
?>
<table width="646" border="0" align="center">
  <tr>
    <td width="470" class="style1"><p>
		<?=$lang['history']['1'].$_SESSION['username']?><br><br>
        <?=$lang['history']['2']?><br><br>
        <?=$lang['history']['3'].total_points($_SESSION['myuid'])?><br>
        <?=$lang['history']['4'].$_SESSION['file_name']; ?><br>
        <?=$lang['history']['5'].$_SESSION['file_size']; ?> </p>
    </td>
  </tr>
</table
><?
}
else
{
	redirect_foot("<h4><center>".$lang['history']['6']."</center></h4>",'home');
}
?>