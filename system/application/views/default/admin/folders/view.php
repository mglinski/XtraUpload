<h2 style="vertical-align:middle"><img src="<?=base_url().'img/icons/folder_32.png'?>" class="nb" alt="" /> FOlder Manager</h2>
<?=$flashMessage?>
<div id="massActions" style="clear:both; padding-top:4px;">
	<div class="float-right">
		<?=generateLinkButton('Search', site_url('admin/files/search'), base_url().'img/icons/search_16.png', NULL)?>
	</div>
</div>
<p style=" clear:both;"></p>
<table class="special" border="0" id="file_list_table"cellspacing="0" style="width:98%">
	<tr>
		<th class="align-left">
			Folder name
		</th>
		<th>
			# Files
		</th>
		<th>
			Created
		</th>
		<th>
			Actions
		</th>
	</tr>
	<? foreach($files->result() as $file)
	{
		$links = $this->files_db->getLinks('', $file);
		?>			
		<tr <?=alternator('class="odd"', 'class="even"')?>>
			<td>
				<a href='<?=site_url('/folders/get/'.$file->file_id.'/'.$file->link_name)?>' target="_blank">
					<img src="<?php echo base_url().'img/files/'.$this->functions->getFileTypeIcon($file->type);?>" class="nb" alt="" />
					<?=$this->functions->elipsis($file->o_filename, 10);?>
				</a>
			</td>
			<td>
				<?=$this->functions->getFilesizePrefix($file->size)?>
			</td>
			<td>
				<?=unix_to_small($file->time)?>
			</td>
			<td>
				<a title="Edit This File" href="<?=site_url('admin/files/edit/'.$file->file_id)?>"><img src="<?=base_url()?>img/icons/edit_16.png" class="nb" alt="Edit" /></a>
				
				<a title="Delete This File" onclick="return confirm('Are you sure you want to delete this file?')" href="<?=site_url('admin/files/delete/'.$file->file_id)?>"><img src="<?=base_url()?>img/icons/close_16.png" class="nb" alt="Delete" /></a>
				
				<a title="Ban This File" onclick="return confirm('Are you sure you want to ban this file?')" href="<?=site_url('admin/files/ban/'.$file->file_id)?>"><img src="<?=base_url()?>img/icons/lock_16.png" class="nb" alt="Ban" /></a>
			</td>
		</tr>
		<? 
	}
	?>
</table>