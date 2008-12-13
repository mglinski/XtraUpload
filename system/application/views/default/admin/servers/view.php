<h2 style="vertical-align:middle"><img src="<?=base_url().'img/other/server_32.png'?>" class="nb" alt="" /> Server Manager</h2>
<?=$flashMessage?>
<div id="massActions" style="clear:both; padding-top:4px;">
	<div class="float-right">
		<?=generateLinkButton('Add New Server', site_url('admin/server/add'), base_url().'img/icons/new_16.png', NULL)?>
	</div>
</div>
<table border="0" style="width:95%" id="file_list_table">
	<tr>
		<th class="align-left">Name</th>
		<th class="align-left">URL</th>
		<th class="align-left"># Files</th>
		<th class="align-left">Used Space</th>
		<th style="text-align:center">Actions</th>
	</tr>
	<? foreach($servers->result() as $server)
	{
		?>			
		<tr <?=alternator('class="odd"', 'class="even"')?>>
			<td style="font-size:12px; font-weight:bold; color:#006600">
				<?php echo $server->name?>
			</td>
			<td style="font-size:12px; font-weight:bold; color:#006600">
				<?php echo $server->url?>
			</td>
			<td style="font-size:12px; font-weight:bold; color:#006600">
				<?php
				$file = $this->db->get_where('files', array('server' => $server->url));
				echo $file->num_rows();
				?>
			</td>
			<td style="font-size:12px; font-weight:bold; color:#006600">
				<?php
				$this->db->select_sum('size');
				$file = $this->db->get_where('files', array('server' => $server->url));
				echo $this->functions->getFilesizePrefix($file->row()->size);
				?>
			</td>
			<td style="text-align:center">
				<?php
				if(!$server->status)
				{
				?>
					<a title="Turn On Server" href="<?=site_url('admin/server/turn_on/'.$server->id)?>">
						<img src="<?=base_url()?>img/icons/off_16.png" class="nb" alt="Turn On" />
					</a>
				<?php 
				}
				else
				{
				?><a title="Turn Off Server" href="<?=site_url('admin/server/turn_off/'.$server->id)?>">
						<img src="<?=base_url()?>img/icons/on_16.png" class="nb" alt="Turn Off" />
					</a>
				<?php 
				}
				?>
				<a title="Edit Server" href="<?=site_url('admin/server/edit/'.$server->id)?>">
					<img src="<?=base_url()?>img/icons/edit_16.png" class="nb" alt="edit" />
				</a>
				
				<a title="Install Server" href="<?=site_url('admin/server/install/'.$server->id)?>">
					<img src="<?=base_url()?>img/icons/wizard_16.png" class="nb" alt="install" />
				</a>
				
				<a title="Delete Server" href="<?=site_url('admin/server/delete/'.$server->id)?>">
					<img src="<?=base_url()?>img/icons/close_16.png" class="nb" alt="delete" />
				</a>
			</td>
		</tr>
		<? 
	}
	?>
</table>