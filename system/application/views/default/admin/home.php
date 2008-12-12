<h2 style="vertical-align:middle"><img src="<?php echo base_url().'img/other/admin_32.png'?>" class="nb" alt="" /> Admin Home</h2>
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