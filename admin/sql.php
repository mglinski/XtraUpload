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
include("./init.php");
$kernel->loadUserExt('sqlBackup');

if($_GET['cleanup'])
{
	$kernel->ext->sqlBackup->act('maintain');
}
else if($_GET['manage'])
{

	if (isset ($_POST['delete']))
	{
		if (is_file('./db/' . txt_clean($_POST['dbfile'])))
		{
			unlink('./db/' . txt_clean($_POST['dbfile']));
		}
		log_action('Database Backup Deleted', 'backup:delete', 'A Database Backup was deleted', 'ok', 'admin/sql.php');
		$txt = 'Deleted';
	}


	if (isset ($_POST['restore']))
	{
		if (is_file ('./db/' . txt_clean($_POST['dbfile'])))
		{
			$kernel->ext->sqlBackup->act('restore');
			
			foreach ($kernel->ext->sqlBackup->SelectedTables as $dbname => $tables)
			{
				foreach ($tables as $table)
				{
					$db->query ('DROP TABLE `' . $dbname . '`.`' . $table . '`');
				}
			}
	
			$sql_query = readsqlfile('./db/' . txt_clean($_POST['dbfile']));
			foreach ($sql_query as $query)
			{
				$db->query($query);
			}
		}
		$txt = 'Restored';
	}
	log_action('Database Backup Restored', 'backup:restore', 'A Database Backup was Restored', 'ok', 'admin/sql.php');
		echo '<center><h4 style="color:#009900">Backup '.$txt.' Successfully </h4> Transfering you to Backup Manager Main Page</center><script>function r(){location = \'./sql.php\'}setTimeout(\'r()\',1750);</script><br /><br />';
		include('./admin/footer.php');
		die;

}
else if($_GET['new'])
{
	$task = $_POST['task'];
	if($task == 'backup')
	{
		define ('BACKTICKCHAR', '`');
		define ('QUOTECHAR', '\'');
		define ('LINE_TERMINATOR', '
');
		define ('BUFFER_SIZE', 32768);
	
		if ($_POST['gzip'] == 1)
		{
			$kernel->ext->sqlBackup->GZ_enabled = (bool)function_exists ('gzopen');
		}
		else
		{
			$kernel->ext->sqlBackup->GZ_enabled = false;
		}
		
		$kernel->ext->sqlBackup->AddDatabase();
		//echo intval($_POST['structure']) . intval($_POST['data']) . intval($_POST['complete']) . ' | ';
		if($_POST['structure'])
		{
			$_POST['structure'] = 1;
		}
		if($_POST['data'])
		{
			$_POST['data'] = 1;
		}
		if($_POST['complete'])
		{
			$_POST['complete'] = 1;
		}
		$kernel->ext->sqlBackup->Start($_POST['structure'], $_POST['data'], $_POST['complete']);
		$kernel->ext->sqlBackup->Store();
		
		if ($_POST['emailbackup'])
		{
			$kernel->ext->sqlBackup->admin_email = $_POST['email'];
			$kernel->ext->sqlBackup->Email();
		}
		//echo '<pre><code>'.$kernel->ext->sqlBackup->output.'</code></pre>';
		echo '<center><h4 style="color:#009900">Backup Created Successfully </h4> Transferring you to Backup Manager Main Page</center><script>function r(){location = \'./sql.php\'}setTimeout(\'r()\',1750);</script><br /><br />';
		log_action('Database Backup Created', 'backup:create', 'A Database Backup was created', 'ok', 'admin/sql.php');
		include('./admin/footer.php');
		die;
	}

		?>
        <h1><span>MySQL Backup Manager - New</span>XtraFile :: Admin Panel</h1>
        <div class="actionsMenu">
    <a href="sql.php">
        <div class="item">
            <div class="img" style="background-image:url(../images/small/back.png);"></div>
            <div class="txt">Return To DB Backups</div>
        </div>
    </a> 
</div><br />
<form action='sql.php?new=1' method='post' name='form1'	>
<input type='hidden' name='task' value='backup'>
<div class='tableborder'>

<table width='52%' cellspacing='0' cellpadding='5' align='center' border='0'>
<tr>
<th colspan=2>New SQL Database Backup on <?=date('F j, Y, g:i a', ((int)time()) )?></th>
</tr>
<tr>
<td	width='44%'	align='left'>Backup Database Structure</td>
<td	width='56%'	align='left'>
<input name="structure" type="radio" value="1" checked="checked" /> Yes<br />
	<input name="structure" type="radio" value="0" /> No</td>
</tr>
<tr>
<td	width='44%'	align='left'>Backup Database Data</td>
<td width='56%'	align='left'>
<input name="data" type="radio" value="1" checked="checked" /> Yes<br />
	<input name="data" type="radio" value="0" /> No</td>
</tr>
<tr>
	<td	align='left'><span class="tdrow2">Include Complete Insert? </span></td>
	<td align='left'>
	<input name="complete" type="radio" value="1" checked="checked" /> Yes<br />
	<input name="complete" type="radio" value="0" /> No</td>
</tr>
<tr>
<td	width='44%'	align='left'>Compress( using Gzip )	file if possible</td>
<td width='56%'	align='left'>
<input name="gzip" type="radio" value="1" checked="checked" /> Yes<br />
	<input name="gzip" type="radio" value="0" />	No </td>
</tr>
<tr>
<td	width='44%'	align='left'>Email the backup file?	<span class="tdrow2"> ( Optional )</span></td>
<td width='56%'	align='left'> <span class="tdrow1">
	<input name="emailbackup" type="radio" value="1" /> Yes<br />
	<input name="emailbackup" type="radio" value="0" checked="checked" />	No
</span></td>
</tr>
<tr>
	<td	align='left'>Email Address to send backup to. </td>
	<td align='left'><input name='email' type='text' value='<?=$adminemail?>' /></td>
</tr>
<tr>
<td align='center' colspan='2' >
<input type='submit' name='done' value='Start!' size='30' class='textinput'></td>
</tr>
</table>
</div></form><br />
<?
}
else
{

	$backups = '';
	chdir('./db/');
	$fh = opendir('.');
	while ($file = readdir($fh))
	{
		//echo $file.'<br />\n';
		if (($file != '..' && $file != '.'  && $file != '.cvs'  && $file != '.svn' && !is_dir('./db/' . $file) && $file != 'index.php' && $file != 'index.html'))
		{
			$backups .= '' . '<option value="' . $file . '">' . $file . '</option>';
		}
	}
	closedir ($fh);
	chdir('..');

?>
<h1><span>MySQL Backup Manager</span>XtraFile :: Admin Panel</h1>
 <div class="actionsMenu">
    <a href="sql.php?new=1">
        <div class="item">
            <div class="img" style="background-image:url(../images/small/new.png);"></div>
            <div class="txt">Create New Backup</div>
        </div>
    </a> 
</div><br />
<script>
function toggle(a1,a2)
{
	d = document;
	d.getElementById(a1).style.display = 'inline';
	d.getElementById(a2).style.display = 'none';
}
</script>
<form action='sql.php?manage=1' method='post' name='myform'	/>
<input type='hidden' name='admin' value='restore' />
<input type='hidden' name='action' value='restore' />
<table width='35%'  cellspacing='0' cellpadding='5' align='center' border='0'>
<tr>
<th align='left'>SQL Database Backup Management</th>
	</tr>
	<tr>
<td class='tdrow1'	align='left'>
		Available Database Backups:
		<select name=dbfile size=1>
			<?=$backups?>
		</select>
	</td>
</tr>
<tr>
	<td align='center' class='tdrow1' colspan='1' >
		<input type='submit' name='restore' value='Restore' size='30' />
		<input type='submit' name='delete' value='Delete' size='30' />
	</td>
</tr>

</table></form><br />
<?
} 

include('./admin/footer.php')
?>