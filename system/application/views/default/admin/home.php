<h2 style="vertical-align:middle"><img src="<?php echo base_url().'img/other/admin_32.png'?>" class="nb" alt="" /> Admin Home</h2>
<h3>Important Server Settings</h3>
<?
$ini_list = array(
	'upload_max_filesize' => 'The largest uploaded file size this server is configured to process is <em>{$}B</em>. <br />This overrides your group settings.',
	'post_max_size'  => 'The maximum size of all allowed POST data is <em>{$}B</em>',
	'max_execution_time'  => 'The longest ammount of time your server can execute PHP files is <em>{$} second(s)</em>',
	'max_input_time'  => 'The longest request your server will process is <em>{$} second(s</em>)',
	'memory_limit' => 'The maximum amount of memory a PHP script can use is <em>{$}B</em>'
);

$ini_name = array(
	'upload_max_filesize' => 'Max File Size',
	'post_max_size'  => 'Max POST-Request Size',
	'max_execution_time'  => 'Execution Timeout',
	'max_input_time'  => 'Request Input Timeout',
	'memory_limit' => 'Memory Limit'
);

$ini_rec = array(
	'upload_max_filesize' => '250M',
	'post_max_size'  => '1000M',
	'max_execution_time'  => '600',
	'max_input_time'  => '600',
	'memory_limit' => '320M'
);

?>
<ul>
	<?
	foreach($ini_list as $k => $v)
	{
		?>
		<li>
			<a href="javascript:;" onclick="$('#php_<?=$k?>').slideToggle('normal')">
				<strong><?=$ini_name[$k]?></strong> - <?
				echo ini_get($k); 
				if($k == 'upload_max_filesize' or $k == 'post_max_size' or $k == 'memory_limit')
				{
					echo 'B';
				}
				else
				{
					echo ' second(s)';
				}
				?>
			</a>
			<? 
			$is_not_good = false;
			if(ini_get($k) != $ini_rec[$k])
			{
				$is_not_good = true;
				echo ' - <span style="color:#F00">Reccomended: '.$ini_rec[$k]; 
				if($k == 'upload_max_filesize' or $k == 'post_max_size' or $k == 'memory_limit')
				{
					echo 'B';
				}
				else
				{
					echo ' second(s)';
				} 
				echo '</span>';
			}
			?>
			<span id="php_<?=$k?>" style="display:none"><strong><ul><?=str_replace('{$}', ini_get($k),$v )?></ul></strong></span></li>
		<?
	}
	?>
</ul>
<?
if($is_not_good)
{
	?><span class="alert">Some of the above Settings are not ideal, please inspect these to ensure minimal problems. </span><?
}
?>

<h3>XtraUpload v2 Stats</h3>
<table border="0">
<tr>
	<td>
		Number of Uploads: <?php echo $this->db->count_all('refrence');?>
	</td>
	<td>
		Total Disk Space Used: <?php echo $this->functions->getFilesizePrefix($this->db->select_sum('size')->get('files')->row()->size)?>
	</td>
</tr>
<tr>
	<td>
		Number of Registered Users: <?php echo $this->db->count_all('users');?>
	</td>
	<td>
		Total Bandwth Used: <?php echo $this->functions->getFilesizePrefix($this->db->select_sum('sent')->get('downloads')->row()->sent)?>
	</td>
</tr>
</table>

<h3>Useful Information</h3>
<p> 
	You are using the <a href="<?php echo site_url('admin/skin/view')?>"><strong><?php echo ucwords(str_replace('_', ' ', $this->startup->skin))?></strong> skin</a> with <a href="<?php echo site_url('admin/extend/view')?>"><?php echo $this->db->get_where('extend', array('active' => 1))->num_rows()?> plugins</a>.<br />
	This is XtraUpload version <strong><?php echo XU_VERSION_READ?></strong>. 
	<?php
	if($this->startup->site_config['allow_version_check'])
	{
		$latest_version = @file_get_contents('http://xtrafile.com/xu_version.txt');
		if(XU_VERSION < $latest_version)
		{
			?>
			<a href="http://xtrafile.com/files/">Update to <strong><?php echo $this->functions->parseVersion($latest_version)?></strong></a>
			<?php
		}
	}
	?>
</p>