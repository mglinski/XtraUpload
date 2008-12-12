<h2 style="vertical-align:middle"><img src="<?=base_url().'img/icons/documents_32.png'?>" class="nb" alt="" /> File Manager</h2>
<?=$flashMessage?>
<form action="<?=site_url('admin/files/')?>" id="userAdmin" method="post" style="padding:0; margin:0; border:0;">
	<div id="massActions" style="clear:both; padding-top:4px;">
		<div class="float-left">
			<?=generateLinkButton('Delete', 'javascript:;', base_url().'img/icons/close_16.png', 'red', array('onclick' => 'deleteSubmit()'))?>
			<?=generateLinkButton('Ban', 'javascript:;', base_url().'img/icons/lock_16.png', NULL, array('onclick' => 'banSubmit()'))?>
		</div>
		<div class="float-right">
			<?=generateLinkButton('Search', site_url('admin/files/search'), base_url().'img/icons/search_16.png', NULL)?>
		</div>
	</div>
	<p style=" clear:both;"></p>
	<table class="special" border="0" id="file_list_table"cellspacing="0" style="width:98%">
		<tr>
			<th>
				<div align="center">
					<input type="checkbox" onchange="switchCheckboxes(this.checked)" />
				</div>
			</th>
			<th class="align-left">
				<a href="javascript:;" onclick="<?=getSortLink('o_filename', $sort, $direction)?>">
					File name<?=getSortArrow('o_filename', $sort, $direction)?>
				</a>
			</th>
			<th>
				<a href="javascript:;" onclick="<?=getSortLink('size', $sort, $direction)?>">
					Size<?=getSortArrow('size', $sort, $direction)?>
				</a>
			</th>
			<th>
				<a href="javascript:;" onclick="<?=getSortLink('time', $sort, $direction)?>">
					Date<?=getSortArrow('time', $sort, $direction)?>
				</a>
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
					<div align="center">
						<input type="checkbox" id="check-<?php echo $file->id?>" name="files[]" value="<?=$file->file_id?>" />
					</div>
				</td>
				<td>
					<a href='<?=site_url('/files/get/'.$file->file_id.'/'.$file->link_name)?>' target="_blank">
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
</form>
<br />
<div style="float:right">
	<form action="<?=site_url('admin/files/count')?>" method="post" style="padding:0; margin:0; border:0;">
		Results: <input type="text" size="6" maxlength="6" name="fileCount" value="<?php echo $perPage?>" />
	</form>
</div>
<?=$pagination?>

<form style="display:none" method="post" id="sortForm" action="<?=site_url('admin/files/sort')?>">
<input type="hidden" id="formS" name="sort" />
<input type="hidden"id="formD" name="direction" />
</form>
<script>
	function banSubmit()
	{
		if(confirm('Are you sure you want to ban these files?'))
		{
			$('#userAdmin').attr('action', "<?=site_url('admin/files/massBan')?>");
			$('#userAdmin').submit();
		}
	}
	
	function deleteSubmit()
	{
		if(confirm('Are you sure you want to delete these files?'))
		{
			$('#userAdmin').attr('action', "<?=site_url('admin/files/massDelete')?>");
			$('#userAdmin').submit();
		}
	}
	
	function switchCheckboxes()
	{
		$('input[@type=checkbox]').each( function() 
		{
			this.checked = !this.checked;
		});
	}
	
	function switchCheckbox(id)
	{
		$('#'+id).each( function() 
		{
			this.checked = !this.checked;
		});
	}
	
	function sortForm(col, dir)
	{
		$('#formS').val(col);
		$('#formD').val(dir);
		$('#sortForm').get(0).submit();
	}
</script>