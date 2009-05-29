<h2 style="vertical-align:middle"><img src="<?php echo base_url().'img/other/admin_32.png'?>" class="nb" alt="" /> Admin Home</h2>
<h3>Important Server Settings</h3>
<?

$ini_list = array(
	'upload_max_filesize' => 'The largest uploaded file size this server is configured to process is <em>{$}B</em>. <br />This overrides your group settings.',
	'post_max_size'  => 'The maximum size of all allowed POST data is <em>{$}B</em>',
	'max_execution_time'  => 'The longest ammount of time your server can execute PHP files is <em>{$} second(s)</em>',
	'max_input_time'  => 'The longest request your server will process is <em>{$} second(s</em>)',
	'memory_limit' => 'The maximum amount of memory a PHP script can use is <em>{$}B</em>',
	'short_open_tag' => 'Enable the use of PHP short opening tags "&lt;?": {$}'
);
$ini_name = array(
	'upload_max_filesize' => 'Max File Size',
	'post_max_size'  => 'Max POST-Request Size',
	'max_execution_time'  => 'Execution Timeout',
	'max_input_time'  => 'Request Input Timeout',
	'memory_limit' => 'Memory Limit',
	'short_open_tag' => 'Allow PHP Short Tags'
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
<ul style="font-size:1.2em;">
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
						echo 'On';
					}
					else
					{
						echo 'Off';
					}
				}
				else
				{
					echo ini_get($k).' second(s)';
				}
				?>
			</a>
			<?
			if(intval(ini_get($k)) < intval($ini_rec[$k]))
			{
				$is_not_good = true;
				echo ' - <img src="'.$base_url.'img/icons/cancel_16.png" alt="Error!" title="Error!" class="nb" /><span style="color:#F00">Reccomended: '; 
				if($k == 'upload_max_filesize' or $k == 'post_max_size' or $k == 'memory_limit')
				{
					echo $ini_rec[$k].'B';
				}
				elseif($k == 'short_open_tag')
				{
					echo 'On';
				}
				else
				{
					echo $ini_rec[$k].' second(s)';
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
	?><span class="alert">Some of the above Settings are not ideal, please inspect these to ensure minimal problems. </span><?
}
?>

<?php
if($this->startup->site_config['allow_version_check'])
{
	$latest_version = @file_get_contents('http://xtrafile.com/xu_version.txt');
	if(XU_VERSION < $latest_version)
	{
		?>
		<h3>Upgrade Available</h3>
		<span class="alert">Important Upgrade Available: <a href="http://xtrafile.com/files/">Update to <strong><?php echo $this->functions->parseVersion($latest_version)?></strong></a></span>
		<?php
	}
}
?>

<h3>XtraUpload v2 Stats</h3>
<table border="0" style="width:98%">
<tr>
	<td>
		<strong>Number of Uploads:</strong> <em><?php echo $this->db->count_all('refrence');?></em>
	</td>
	<td>
		<strong>Total Disk Space Used:</strong> <em><?php echo $this->functions->getFilesizePrefix($this->db->select_sum('size')->get('files')->row()->size)?></em>
	</td>
</tr>
<tr>
	<td>
		<strong>Number of Registered Users:</strong> <em><?php echo $this->db->count_all('users');?></em>
	</td>
	<td>
		<strong>Total Bandwidth Used:</strong> <em><?php echo $this->functions->getFilesizePrefix($this->db->select_sum('sent')->get('downloads')->row()->sent)?></em>
	</td>
</tr>
<tr>
	<td>
		<strong>Number of Admins:</strong> <em><?php echo $this->db->select_sum('id', 'count')->get_where('users', array('group' => '2'))->row()->count;?></em>
	</td>
	<td>
		<strong>Number of Active Servers:</strong> <em><?php echo $this->db->select_sum('id', 'count')->get_where('servers', array('status' => '1'))->row()->count?></em>
	</td>
</tr>
</table>

<h3>Server Stats</h3>
<? 
$load = $this->functions->getServerLoad(0);
if($load > 100)
{
    $load = 100;
}

$free_space = disk_free_space(dirname('filestore/'));
$total_space = disk_total_space(dirname('filestore/'));
$used_space = $total_space - $free_space;
$used_space_percent = (($used_space / $total_space) * 100);
$free_space_percent = ($used_space_percent - 100) * (-1);
$free_space = $this->functions->getFilesizePrefix($free_space);
$total_space = $this->functions->getFilesizePrefix($total_space);
$used_space = $this->functions->getFilesizePrefix($used_space);
?>
<table border="0" style="width:98%">
	<? 
	// I hate the COM, so if on a windows box dont show the CPU load
	if(!isset($_SERVER['WINDIR'])){?>
    <tr>
        <td>
            <h4 style="padding:4px;margin-top:4px;">Server Load: <?=$load?>%</h4>
            <div class="progress_border" style="margin-left:2px; width:99%;">
                <div class="progress_img_sliver" style="width:<?=round($load)?>%"></div>
            </div><br />
        </td>
    </tr>
    <? }?>
    <tr>
        <td>
            <h4 style="padding:4px;margin-top:4px;">Total Disk Space: <?=$total_space?></h4>
            <div class="progress_border" style="margin-left:2px; width:99%;">
                <div class="progress_img_sliver" style="width:<?=round($used_space_percent)?>%;"><?=$used_space?> Used</div>
				<div class="progress_img_blank" style="width:<?=round($free_space_percent)?>%;"><?=$free_space?> Free</div>
            </div>
            <br />
        </td>
    </tr>
</table>

<h3>Useful Information</h3>
<p> 
	You are using the <a href="<?php echo site_url('admin/skin/view')?>"><strong><?php echo ucwords(str_replace('_', ' ', $this->startup->skin))?></strong> skin</a> with <a href="<?php echo site_url('admin/extend/view')?>"><?php echo $this->db->get_where('extend', array('active' => 1))->num_rows()?> plugins</a>.<br />
	This is XtraUpload version <strong><?php echo XU_VERSION_READ?></strong>. 
</p>