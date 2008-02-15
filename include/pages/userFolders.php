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
	
	$pageno = 0;
	if(isset($_REQUEST['pageno']))
	{
		$pageno = intval($_REQUEST['pageno']);
	}
	
	$limit = 10;
	if(isset($_REQUEST['limit']) && intval($_REQUEST['limit']) > 0)
	{
		$limit = intval($_REQUEST['limit']);
	}
?>
 <form method="post" id="folders_list1">
 	<h1 align="center"><?=$lang['userFolders']['1']?></h1>
		  <? 
if($can_create_folders)
{
	$js_folder = '';
			$sql = "SELECT * FROM folder WHERE user='".intval($_SESSION['myuid'])."'";
			$qr1 = $db->query($sql);
			$rowcount = $db->num($qr1);
			$pagecount = ceil($rowcount / $limit);
			print "<table width=100%><td>".$lang['misc']['1']."" . ($pageno+1) ."</td><td align=right>
						<select onchange='document.getElementById(\"folders_list1\").submit()' name='pageno' id='pageno1'>";
			for($x=0; $x < $pagecount; $x++)
			{
				$page = $x + 1;
				$lower = $x * $limit + 1;
				$upper = $lower + $limit - 1;
				if($upper > $rowcount) 
				{
					$upper=$rowcount;
				}
				print "<option";
		if($x == $pageno)
		{
			print " selected='selected'";
		}
		print" value='".$x."'>".$lang['misc']['3']." $page ($lower - $upper)</option>\n";
			}
			print "</select><br />".$lang['misc']['4']."<input type='text' name='limit'  size='5' value='".$limit."' /></td></table><hr /><br />
";
			$lower = $pageno * $limit;
			$upper = $lower + $limit -1;
			$count = -1;
			$i = 1;
			$domCount = 0;
	?>
 </form>
	<form onsubmit='return false;'>
	<table width="647" border="1" bordercolor="#000000" align="center" cellpadding="5" cellspacing="0">
	<tr>
	<th width="172"><?=$lang['userFolders']['2']?></th>
	<th width="321"><?=$lang['userFolders']['3']?></th>
	<th width="116"><?=$lang['userFolders']['4']?></th>
	</tr>
<?
			while( $a =  $db->fetch($qr1) )
			{
			$count++;
				if ($limit != 0 &&  $count > $upper)
				{ 
				
				}
				else
				{
					if($limit != 0 && $count < $lower )
					{ 
					
					}
					else
					{
			
			?>
	<tr onMouseOver="this.style.backgroundColor = '#C1DEF0'" onMouseOut="this.style.backgroundColor = ''">
		<td>
			<div align="center">
			  <?
			  if($a->name == "")
			  {
			      echo "<b><span id='folder_name_".$a->id."'>[".$lang['userFolders']['5']."]</span></b>  ";
			  }
			  else
			  {
				  echo "<b><span id='folder_name_".$a->id."'>".$a->name."</span></b>  ";
			  }
				?>
	        </div></td><td>
				  <div align="center">
				    <?
				echo "<input size='60' type='text' readonly='readonly' value='".makeXuLink('index.php', array('p' => 'view','id' => $a->fid))."' onfocus='this.focus();this.select()' onclick='this.focus();this.select()' onmousedown='this.focus();this.select()' /><br />";
				$js_folder .= createEditableJS("folder_name_".$a->id,"folder","name",$a->id).createEditableJS("folder_pass_".$a->id,"folder","password",$a->id);
				?>
	          </div></td><td>
				  <div align="center">
				    <?
				echo "<a id='img_f_".$a->fid."' title='".$lang['userFolders']['6']."' href='".makeXuLink('index.php', array('p' => 'view','id' => $a->fid))."'>".get_icon("Folder (Open)", "normal")."</a> &nbsp; ";
				echo "<a id='img_a_".$a->fid."' title='".$lang['userFolders']['7']."' href='".makeXuLink('index.php', array('p' => 'folders','login' => $a->fid))."'>".get_icon("Folder", "normal")."</a> &nbsp; ";
				echo "<a id='img_d_".$a->fid."' title='".$lang['userFolders']['8']."'  href='".makeXuLink('index.php', array('p' => 'folders','login' => $a->fid, 'del' => $a->fid))."'>".get_icon("Folder (Remove)", "normal")."</a>";
				?>	        
				<script>
					$('#img_f_<?=$a->fid?>').Tooltip({track: true, delay: 1500});
					$('#img_a_<?=$a->fid?>').Tooltip({track: true, delay: 1500});
					$('#img_d_<?=$a->fid?>').Tooltip({track: true, delay: 1500});
				</script>
		        </div></td></tr>
	  <?
		  			}
				}	
			}
?></table>
</form>
<form method="post" id="folders_list2">
<?
print "<br />
<hr /><table width=100%><td>".$lang['misc']['1']."" . ($pageno+1) ."</td><td align=right>
						<select onchange='document.getElementById(\"folders_list2\").submit()' name='pageno' id='pageno2'>";
			for($x=0; $x < $pagecount; $x++)
			{
				$page = $x + 1;
				$lower = $x * $limit + 1;
				$upper = $lower + $limit - 1;
				if($upper > $rowcount) 
				{
					$upper=$rowcount;
				}
				print "<option";
		if($x == $pageno)
		{
			print " selected='selected'";
		}
		print" value='".$x."'>".$lang['misc']['3']." $page ($lower - $upper)</option>\n";
			}
			print "</select><br />".$lang['misc']['4']."<input type='text' name='limit' size='5' value='".$limit."' /></td></table>";
			?>
</form>
			<script>function load_folder(){<?=$js_folder?>} setTimeout('load_folder()',2000);</script><?
	}
	else
	{
	?><h3><center><?=$lang['folder']['9']?></center></h3>
	<? 
	}