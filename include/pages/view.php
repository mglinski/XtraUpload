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
if($can_view_folders)
{
if(!isset($_REQUEST['id']))
{
	?>
	<center><h2><?=$lang['view']['14']?></h2><br />
		<form method="post">
			<?=$lang['view']['15']?> <input name="id" size="20" type="text" value="" />
			<br />
			<input type="submit" name="Submit" value="<?=$lang['view']['16']?>" />
		</form>
	</center>
	<?
}
else
{

	$folder = $db->fetch( $db->query("SELECT * FROM folder WHERE fid='".txt_clean($_REQUEST['id'])."'") , "obj");
	$user_name = $db->fetch( $db->query("SELECT * FROM users WHERE uid='".$folder->user."'") , "obj");
	$user_name = $user_name->username;

if(isset($folder->password) && $folder->password != ""){
$pass_image = false;
}else{
$pass_image = true;
}

if(isset( $_POST['pass1']))
{
	if($folder->password == $_POST['pass1'])
	{
		$pass_image = true;
	}
	else
	{
		$msg = "<font color='#FF0000'>".$lang['view']['8']."</font><br /><br />";
	}
}

if(!$pass_image)
{
?>
<?=$msg?>
<form method="post" enctype="multipart/form-data">
<?=$lang['view']['9']?><br /><br />
 
  <input type="text" name="pass1" id="pass1" /><?=$lang['view']['1']?><br />
  <input type="submit" name="Submit2" value="<?=$lang['view']['2']?>" />
</form>
<br />
<br />
<?
}
else
{

	$pageno = 0;
	if(isset($_REQUEST['pageno']))
	{
		$pageno = $_REQUEST['pageno'];
	}
	
	$limit = 10;
	if(isset($_REQUEST['limit']) && intval($_REQUEST['limit']) > 0)
	{
		$limit = intval($_REQUEST['limit']);
	}
	
	if($limit > 50)
	{
		$limit = 50;
	}
	$sql = "SELECT files.* FROM fitem,files WHERE files.id=fitem.file AND fid='".txt_clean($_REQUEST['id'])."'";
	$qr1 = $db->query($sql);
	$rowcount = $db->num($qr1);
	$pagecount = ceil($rowcount / $limit);
?>
	<h3><?=$lang['view']['3'].$folder->name?>
    <br />
	<?=$lang['view']['4'].$user_name?> </h3><br />
<br />
	<form method="post" id="form1">
	<input type="hidden" name="pass1" id="pass1" value="<?=$_POST['pass1']?>" />
	<?
		print "<table width=100%><td>".$lang['misc']['1'] . ($pageno+1) ."</td><td align=right>
				<select onchange='document.getElementById(\"form1\").submit()' name='pageno'>";
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
	
	
	
	$lower = $pageno * $limit;
	$upper = $lower + $limit -1;
	$count = -1;
	$i = 1;
	$domCount = 0;
	?>
	<table width="871" border="0" align="center" cellpadding="3" cellspacing="0" style="border:1px solid #000000; padding:3px">
	<tr>
	  <th height="30" align="center" ><?=$lang['view']['10']?></td>
	  <th align="center"><?=$lang['view']['11']?></th>
	  <th align="center"><?=$lang['view']['12']?></th>
	  <th align="center"><?=$lang['view']['13']?></th>
	  </tr>
<?
			while( $a = $db->fetch($qr1) )
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
				$user = $db->fetch($db->query("SELECT * FROM `users` WHERE `uid` = '".$a->user."'"));
				$user = $user->username;
				if($user == '' or $user == '0')
				{
					$user = 'Anonymous';
				}
				?><tr onmouseover="this.style.backgroundColor = '#C1DEF0'" onmouseout="this.style.backgroundColor = ''">
	  <td width="92" align="center" style="border-top:1px solid #000000; padding:3px"><?=$user?></td>
	  <td width="255" align="center" style="border-top:1px solid #000000; padding:3px"><?=$a->o_filename?><br></td>
	  <td width="335" align="center" style="border-top:1px solid #000000; padding:3px">
				<b><a href='<?=makeXuLink('index.php', array('p' => 'download', 'hash' => $a->hash), $a->server)?>'><?=makeXuLink('index.php', array('p' => 'download', 'hash' => $a->hash), $a->server)?></a></b><br><?
				
				?></td>
	  <td width="163" align="center" style="border-top:1px solid #000000; padding:3px"><?=check_file($a->hash);?></td>
</tr>
				<?			
				$id=1;
					}
				}
			}
?>
</table>
<?
print "<hr /><table width=100%><td>".$lang['misc']['1']."" . ($pageno+1) ."</td><td align=right>
						<select onchange='document.getElementById(\"form1\").submit()' name='pageno'>";
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
<input type="button" id="adminLinkButton" onclick="location = '<?=makeXuLink('index.php', array('p' => 'folders', 'login' => txt_clean($_GET['id'])))?>';" value="Folder Admin" />
</form>
<br />
<br />

<?	
		}
	}
	
}
else
{
?>
	<h3><center><?=$lang['view']['7']?></center></h3>
<? 
}
?>