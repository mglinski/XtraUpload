<h2 style="vertical-align:middle"><img src="<?php echo base_url().'img/other/manage-files_32.png'?>" class="nb" alt="" /> <?php echo $this->lang->line('files_manage_title') ?></h2>
<div id="massActions" style="clear:both; padding-top:4px;">
	<div class="float-left">
		<?php echo generateLinkButton('Delete', 'javascript:;', base_url().'img/icons/close_16.png', 'red', array('onclick' => 'deleteSubmit()')); ?>
	</div>
</div>
<p style=" clear:both;"></p>
<span style="display:none" class="info" id="edit_alert"><?php echo $this->lang->line('files_manage_10') ?></span>
<?php echo $flashMessage; ?>
<?php 
if($this->startup->group_config->storage_limit > '0')
{
	?>
	<span class="info">
		<strong><?php echo $this->lang->line('files_manage_storage_limit_1') ?></strong><br />
		<?php echo $this->lang->line('files_manage_storage_limit_2') ?><strong><?php echo $this->functions->getFilesizePrefix(($this->startup->group_config->storage_limit * 1024 * 1024) - $this->files_db->getFilesUseageSpace())?></strong><?php echo $this->lang->line('files_manage_storage_limit_3') ?><strong><?php echo $this->startup->group_config->storage_limit.$this->lang->line('files_manage_storage_limit_4') ?></strong><?php echo $this->lang->line('files_manage_storage_limit_5') ?>
	</span>
	<?php 
}
$this->load->helper('string');
?>

<form action="<?php echo site_url('files/manage')?>" id="userAdmin" method="post" style="padding:0; margin:0; border:0;">
<table border="0" style="width:95%" id="file_list_table">
	<tr>
		<th style="width:20px"><div style="text-align:center"><input type="checkbox" id="switch_box" onchange="switchCheckboxes(this.checked)" /></div></th>
		<th><?php echo $this->lang->line('files_manage_table_1') ?></th>
		<th><?php echo $this->lang->line('files_manage_table_2') ?></th>
		<th><?php echo $this->lang->line('files_manage_table_2_1'); ?></th>
		<th style="width:80px"><?php echo $this->lang->line('files_manage_table_3') ?></th>
	</tr>
	<?php 
		$i=0;
	foreach($files->result() as $file)
	{
		$id = $file->id;
		$link = $this->files_db->getLinks($file->secid);
	?>
	<tr id="<?php echo $file->file_id?>" <?php echo alternator('class="odd"', 'class="even"')?>>
		<td>
			<div align="center">
				<input type="checkbox" id="check-<?php echo $file->id?>" onchange="manageCheckboxes()" name="files[]" value="<?php echo $file->file_id?>" />
			</div>
		</td>
		<td>
			<a href='<?php echo $link['down']?>' rel="external">
				<img src="<?php echo base_url().'img/files/'.$this->functions->getFileTypeIcon($file->type);?>" class="nb" alt="" />
				<?php echo $this->functions->elipsis($file->o_filename, 10)?>
			</a>
		</td>
		<td>
			<?php echo $this->functions->getFilesizePrefix($file->size)?>
		</td>
		<td>
			<?php echo intval($file->downloads)?>
		</td>
		<td>
			<a href='javascript:;' onclick='$("#<?php echo $file->file_id?>-details").toggle()'><img src="<?php echo $base_url.'/img/icons/link_16.png'?>"  title="<?php echo $this->lang->line('files_manage_table_4') ?>" class="nb" /></a>
			<a href='javascript:;' onclick='$("#<?php echo $file->id?>-edit").toggle()'><img src="<?php echo $base_url.'/img/icons/edit_16.png'?>"  title="<?php echo $this->lang->line('files_manage_17') ?>" class="nb" /></a>
			<a href="<?php echo $link['del']?>" onclick="return confirm('<?php echo $this->lang->line('files_manage_table_5') ?>');"><img src="<?php echo $base_url.'/img/icons/close_16.png'?>" title="<?php echo $this->lang->line('files_manage_table_6') ?>" class="nb" /></a>
		</td>
	</tr>
	<tr class="details" style="display:none; border-top:none;" id="<?php echo $file->file_id?>-details">
		<td colspan="5" id="<?php echo $file->file_id?>-details-inner">
		<?php echo $this->lang->line('files_manage_table_7') ?>: <input class="down_link" readonly="readonly" type="text" size="65" value="<?php echo $link['down']?>" onfocus="this.select()" onclick="this.select()" ondblclick="this.select()" /><br />
		<?php echo $this->lang->line('files_manage_table_8')?>: <a href="<?php echo $link['del']?>"><?php echo $link['del']?></a>
		<?
		if(isset($link['img']))
		{
			?><br /><?php echo $this->lang->line('files_manage_table_9') ?><a href="<?php echo $link['img']?>"><?php echo $link['img']?></a><?
		}
		?>
		</td>
	</tr>
	<tr class="details" style="display:none; border-top:none;" id="<?php echo $file->id?>-edit">
		<td colspan="5" id="<?php echo $file->file_id?>-edit-inner">
			<input name="<?php echo $file->id?>_fid" id="<?php echo $file->id?>_fid" value="<?php echo $file->secid?>" type="hidden" />
		
			<span class="float-right">
				<label for="<?php echo $file->id?>_desc"><?php echo $this->lang->line('files_manage_11') ?></label>
				<textarea name="<?php echo $file->id?>_desc" id="<?php echo $file->id?>_desc" cols="30" style="height:180px" rows="2"><?php echo $file->descr?></textarea>
			</span>
            
			<label for="<?php echo $file->id?>_pass"><?php echo $this->lang->line('files_manage_12') ?></label>
			<input name="<?php echo $file->id?>_pass" id="<?php echo $file->id?>_pass" value="<?php echo $file->password?>" size="35" maxlength="32" type="text" /><br />
			
			<label for="<?php echo $file->id?>_tags"><?php echo $this->lang->line('files_manage_tags'); ?></label>
			<input name="<?php echo $file->id?>_tags" id="<?php echo $file->id?>_tags" value="<?php echo $file->tags?>" size="35" maxlength="200" type="text" /><br />
            
            <label for="<?php echo $file->id?>_feat"><?php echo $this->lang->line('files_manage_13') ?></label>
			<input name="<?php echo $file->id?>_feat" id="<?php echo $file->id?>_feat" <?php if($file->feature){?> checked="checked"<? }?> type="checkbox" value="1" /> <?php echo $this->lang->line('files_manage_14') ?><br /><br />
            
			<?php echo generateLinkButton($this->lang->line('files_manage_15'), 'javascript:;', base_url().'img/icons/ok_16.png', 'green', array('onclick' => 'editFileProps(\''.$file->id.'\');'))?>
			<?php echo generateLinkButton('Cancel Edit', 'javascript:;', base_url().'img/icons/close_16.png', 'red', array('onclick' => '$(\'#'.$file->id.'-edit\').hide();'))?><br /><br />
		</td>
	</tr>
	
	<?php 
		$i++;
	}
	?>
</table>
</form>

<?php echo $pagination; ?>

<script type="text/javascript">
	function editFileProps(id)
	{
		if($('#'+id+'_feat').is(':checked'))
		{
			var fFeatured = 1;
		}
		else
		{
			var fFeatured = 0;
		}
		var fDesc = $('#'+id+'_desc').val();
		var fPass = $('#'+id+'_pass').val();
		var fTags = $('#'+id+'_tags').val();
		var curFileId = $('#'+id+'_fid').val();
		$.post(
			'<?php echo site_url('upload/fileUploadProps')?>', 
			{
				fid: curFileId, 
				password: fPass, 
				desc: fDesc, 
				tags: fTags, 
				featured: fFeatured
			}
		);
		$('#edit_alert').show();
		$("#"+id+"-edit").hide();
		setTimeout('$(\'#edit_alert\').slideUp("normal")', 1500)
	}
	
	function deleteSubmit()
	{
		if(confirm('<?php echo $this->lang->line('files_manage_16') ?>'))
		{
			$('#userAdmin').attr('action', "<?php echo site_url('files/massDelete')?>");
			$('#userAdmin').submit();
		}
	}
	
	function switchCheckboxes(checked)
	{
		var the_id = this.id;
		if(checked == false)
		{
			$("input:checkbox").each( function() 
			{
				if(this.id != the_id)
				{
					this.checked = false;
				}
			});
		}
		else
		{
			$("input:checkbox").each( function() 
			{
				if(this.id != the_id)
				{
					this.checked = true;
				}
			});
		}
	}
	
	function manageCheckboxes()
	{
		var boxes = [];
		var is_all_checked = true;
		var i = 0;
		
		// get all main checkboxes and manage them muwahhahh!!!!
		$("input[id^='check-']:checkbox").each( function() 
		{
			if(this.id != 'switch_box' && is_all_checked == true)
			{
				if(this.checked === false)
				{
					is_all_checked = false;
				}
			}
		});
		
		if(is_all_checked)
		{
			$('#switch_box').get(0).checked = true;
		}
		else
		{
			$('#switch_box').get(0).checked = false;
		}
	}
	
	function switchCheckbox(id)
	{
		$('#'+id).each( function() 
		{
			$(this).get(0).checked = !$(this).get(0).checked;
		});
	}
	
	function sortForm(col, dir)
	{
		$('#formS').val(col);
		$('#formD').val(dir);
		$('#sortForm').get(0).submit();
	}
</script>