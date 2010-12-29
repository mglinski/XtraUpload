<h2><img src="<?php echo base_url().'img/other/admin_32.png'?>" class="nb" alt="" /><?php echo $this->lang->line('admin_home'); ?></h2>
<h3 id="php_ini_header" ><?php echo $this->lang->line('admin_important_server_settings'); ?></h3>
<?php

$ini_list = array(
	'upload_max_filesize' => $this->lang->line('admin_upload_max_filesize_description'),
	'post_max_size'  => $this->lang->line('admin_post_max_size_description'),
	'max_execution_time'  => $this->lang->line('admin_max_execution_time_description'),
	'max_input_time'  => $this->lang->line('admin_max_input_time_description'),
	'memory_limit' => $this->lang->line('admin_memory_limit_description'),
	'short_open_tag' => $this->lang->line('admin_short_open_tag_description')
);
$ini_name = array(
	'upload_max_filesize' => $this->lang->line('admin_upload_max_filesize_title'),
	'post_max_size'  => $this->lang->line('admin_post_max_size_title'),
	'max_execution_time'  => $this->lang->line('admin_max_execution_time_title'),
	'max_input_time'  => $this->lang->line('admin_max_input_time_title'),
	'memory_limit' => $this->lang->line('admin_memory_limit_title'),
	'short_open_tag' => $this->lang->line('admin_short_open_tag_title')
);
$ini_rec = array(
	'upload_max_filesize' => '250M',
	'post_max_size'  => '1000M',
	'max_execution_time'  => '600',
	'max_input_time'  => '600',
	'memory_limit' => '320M',
	'short_open_tag' => '1'
);

function renameINIResult($r, $n)
{
	if($n == 'short_open_tag')
	{
		if($r == 1)
		{
			return 'On';
		}
		else
		{
			return 'Off';
		}
	}
	return $r;
}

?>
<ul id="php_ini_list" style="font-size:1.2em;">
	<?
	$is_not_good = false;
	foreach($ini_list as $k => $v)
	{
		?>
		<li>
			<a href="javascript:;" onclick="$('#php_<?=$k?>').slideToggle('normal')">
				<strong><?=$ini_name[$k]?></strong> - <?
				if($k == 'upload_max_filesize' or $k == 'post_max_size' or $k == 'memory_limit')
				{
					echo ini_get($k).'B';
				}
				elseif($k == 'short_open_tag')
				{
					if(ini_get($k) == 1)
					{
						echo $this->lang->line('admin_on');
					}
					else
					{
						echo $this->lang->line('admin_off');
					}
				}
				else
				{
					echo ini_get($k).' '.$this->lang->line('admin_seconds');
				}
				?>
			</a>
			<?
			if(intval(ini_get($k)) < intval($ini_rec[$k]))
			{
				$is_not_good = true;
				echo ' - <img src="'.$base_url.'img/icons/cancel_16.png" alt="Error!" title="Error!" class="nb" /><span style="color:#F00">'.$this->lang->line('admin_recommended').': '; 
				if($k == 'upload_max_filesize' or $k == 'post_max_size' or $k == 'memory_limit')
				{
					echo $ini_rec[$k].'B';
				}
				elseif($k == 'short_open_tag')
				{
					echo $this->lang->line('admin_on');
				}
				else
				{
					echo $ini_rec[$k].' '.$this->lang->line('admin_seconds');
				}
				echo '</span>';
			}
			else
			{
				
				echo '<img src="'.$base_url.'img/icons/ok_16.png" alt="Ok!" title="Ok!" class="nb" />';
			}
			?>
			<span id="php_<?=$k?>" style="display:none">
				<strong style="padding-left:12px; text-decoration:underline"><?=str_replace('{$}', renameINIResult(ini_get($k), $k),$v )?></strong>
			</span>
		</li>
		<?
	}
	?>
</ul>
<?
if($is_not_good)
{
	?><span class="alert"><?php echo $this->lang->line('admin_settings_alert'); ?></span><?
}
else
{
	?>
		<script>
		$(document).ready(function()
		{
			$('#php_ini_list, #php_ini_header').hide();
		});
		</script>
	<?
}
?>

<?php
if($this->startup->site_config['allow_version_check'])
{
	$latest_version = @file_get_contents('http://xtrafile.com/xu_version.txt');
	if(XU_VERSION < $latest_version)
	{
		?>
		<h3><?php echo $this->lang->line('admin_upgrade_available'); ?></h3>
		<span class="alert"><?php echo $this->lang->line('admin_important_upgrade_available
		'); ?>: <a href="http://xtrafile.com/files/"><?php echo $this->lang->line('admin_update_to'); ?> <strong><?php echo $this->functions->parseVersion($latest_version)?></strong></a></span>
		<?php
	}
}
?>

<h3><?php echo $this->lang->line('admin_stats'); ?></h3>
<table border="0" style="width:98%">
<tr>
	<td>
		<strong><?php echo $this->lang->line('admin_number_of_uploads'); ?>:</strong> <em><?php echo $this->db->count_all('refrence');?></em>
	</td>
	<td>
		<strong><?php echo $this->lang->line('admin_total_disk_space_used'); ?>:</strong> <em><?php echo $this->functions->getFilesizePrefix($this->db->select_sum('size')->get('files')->row()->size)?></em>
	</td>
</tr>
<tr>
	<td>
		<strong><?php echo $this->lang->line('admin_number_of_registered_users'); ?>:</strong> <em><?php echo $this->db->count_all('users');?></em>
	</td>
	<td>
		<strong><?php echo $this->lang->line('admin_total_bandwidth_used'); ?>:</strong> <em><?php echo $this->functions->getFilesizePrefix($this->db->select_sum('sent')->get('downloads')->row()->sent)?></em>
	</td>
</tr>
<tr>
	<td>
		<strong><?php echo $this->lang->line('admin_number_of_admins'); ?>:</strong> <em><?php echo $this->db->select_sum('id', 'count')->get_where('users', array('group' => '2'))->row()->count;?></em>
	</td>
	<td>
		<strong><?php echo $this->lang->line('admin_number_of_active_servers'); ?>:</strong> <em><?php echo $this->db->select_sum('id', 'count')->get_where('servers', array('status' => '1'))->row()->count?></em>
	</td>
</tr>
</table>

<h3><?php echo $this->lang->line('admin_server_stats'); ?></h3>
<table border="0" style="width:98%">
	<? 
	$servers = $this->db->get('servers');
	foreach($servers->result() as $serv)
	{
		if($serv->total_space == 0)
		{
			continue;
		}
		$used_space_percent = (($serv->used_space / $serv->total_space) * 100);
		$free_space_percent = ($used_space_percent - 100) * (-1);
		$free_space = $this->functions->getFilesizePrefix($serv->free_space);
		$total_space = $this->functions->getFilesizePrefix($serv->total_space);
		$used_space = $this->functions->getFilesizePrefix($serv->used_space);
		?>
    	<tr>
	        <td>
				<h3 style="font-size:16px; padding:2px; margin:0"><img class="nb" src="<?=$base_url?>img/other/server_16.png" alt="" /> <a href="<?=site_url('admin/server/edit/'.$serv->id)?>"><?=ucfirst($serv->name)?></a> (<?=$serv->url?>)</h3>
	            <div class="progress_border" style="margin-left:2px; width:99%;">
	                <div class="progress_img_sliver" style="width:<?=round($used_space_percent)?>%;"><?=$used_space?> <?php echo $this->lang->line('admin_used'); ?></div>
					<div class="progress_img_blank" style="width:<?=round($free_space_percent)?>%;"><?=$free_space?> <?php echo $this->lang->line('admin_free'); ?></div>
	            </div>
				<h4 style="padding:4px;margin-top:4px;">
					<?php echo $this->lang->line('admin_total_disk_space'); ?>: <?=$total_space?><br />
					Files on Server: <?=$serv->num_files?><br />
				</h4>
	        </td>
	    </tr>
    	<? 
	}
	?>
</table>

<h3><?php echo $this->lang->line('admin_useful_information'); ?></h3>
<p> 
	<?php echo $this->lang->line('admin_you_are_using_the'); ?> <a href="<?php echo site_url('admin/skin/view')?>"><strong><?php echo ucwords(str_replace('_', ' ', $this->startup->skin))?></strong> <?php echo $this->lang->line('admin_skin'); ?></a> <?php echo $this->lang->line('admin_with'); ?> <a href="<?php echo site_url('admin/extend/view')?>"><?php echo $this->db->get_where('extend', array('active' => 1))->num_rows()?> <?php echo $this->lang->line('admin_plugins'); ?></a>.<br />
	<?php echo $this->lang->line('admin_this_is_xu_version'); ?> <strong><?php echo XU_VERSION_READ?></strong>. 
</p>

<h3><?php echo $this->lang->line('admin_login_logger'); ?></h3>
<table border="0" style="width:98%">
<tr>
	<th><?php echo $this->lang->line('admin_user'); ?></th>
	<th><?php echo $this->lang->line('admin_ip'); ?></th>
	<th><?php echo $this->lang->line('admin_date'); ?></th>
	<th><?php echo $this->lang->line('admin_valid'); ?></th>
</tr>
	<? 
	$logins = $this->admin_logger->getLogs(5);
	foreach($logins->result() as $log)
	{
		?>
    	<tr>
	        <td>
				<a href="<?=site_url('/admin/user/edit/'.$log->user)?>"><?=ucfirst($log->user_name)?></a>
	        </td>
	        
	        <td>
				<?=$log->ip?>
	        </td>
	        
	        <td>
				<?=unix_to_human($log->date)?>
	        </td>
	
			<td>
				<?php
				
				if ($log->valid == 1) 
				{
					?><img src="<?php echo base_url().'img/icons/ok_16.png'?>" class="nb" alt="" /><?
				} 
				else 
				{
					?><img src="<?php echo base_url().'img/icons/cancel_16.png'?>" class="nb" alt="" /><?
				}
				?>
	        </td>
	    </tr>
    	<? 
	}
	?>
</table>