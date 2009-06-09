<h2 style="vertical-align:middle"><img src="<?=base_url().'img/other/manage-files_32.png'?>" class="nb" alt="" /> <?php echo $this->lang->line('files_manage_title') ?></h2>
<div id="massActions" style="clear:both; padding-top:4px;">
	<div class="float-left">
		<?=generateLinkButton('Delete', 'javascript:;', base_url().'img/icons/close_16.png', 'red', array('onclick' => 'deleteSubmit()'))?>
	</div>
</div>
<p style=" clear:both;"></p>
<span style="display:none" class="info" id="edit_alert"><?php echo $this->lang->line('files_manage_10') ?></span>
<?=$flashMessage?>
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

<form action="<?=site_url('files/manage')?>" id="userAdmin" method="post" style="padding:0; margin:0; border:0;">
<table border="0" style="width:95%" id="file_list_table">
	<tr>
		<th style="width:20px"><div style="text-align:center"><input type="checkbox" onchange="switchCheckboxes(this.checked)" /></div></th>
		<th><?php echo $this->lang->line('files_manage_table_1') ?></th>
		<th><?php echo $this->lang->line('files_manage_table_2') ?></th>
		<th><?php //echo $this->lang->line('files_manage_table_') ?>Downloads</th>
		<th style="width:80px"><?php echo $this->lang->line('files_manage_table_3') ?></th>
	</tr>
	<?php 
		$i=0;
	foreach($files->result() as $file)
	{
		$id = $file->id;
		$link = $this->files_db->getLinks($file->secid);
	?>
	<tr id="<?=$file->file_id?>" <?=alternator('class="odd"', 'class="even"')?>>
		<td>
			<div align="center">
				<input type="checkbox" id="check-<?php echo $file->id?>" name="files[]" value="<?=$file->file_id?>" />
			</div>
		</td>
		<td>
			<a href='<?=site_url('/files/get/'.$file->file_id.'/'.$file->link_name)?>' target="_blank">
				<img src="<?php echo base_url().'img/files/'.$this->functions->getFileTypeIcon($file->type);?>" class="nb" alt="" />
				<?=$file->o_filename?>
			</a>
		</td>
		<td>
			<?=$this->functions->getFilesizePrefix($file->size)?>
		</td>
		<td>
			<?=intval($file->downloads)?>
		</td>
		<td>
			<a href='javascript:;' onclick='$("#<?=$file->file_id?>-details").toggle()'><img src="<?=$base_url.'/img/icons/link_16.png'?>"  title="<?php echo $this->lang->line('files_manage_table_4') ?>" class="nb" /></a>
			<a href='javascript:;' onclick='$("#<?=$file->id?>-edit").toggle()'><img src="<?=$base_url.'/img/icons/edit_16.png'?>"  title="<?php echo $this->lang->line('files_manage_17') ?>" class="nb" /></a>
			<a href="<?=$link['del']?>" onclick="return confirm('<?php echo $this->lang->line('files_manage_table_5') ?>');"><img src="<?=$base_url.'/img/icons/close_16.png'?>" title="<?php echo $this->lang->line('files_manage_table_6') ?>" class="nb" /></a>
		</td>
	</tr>
	<tr class="details" style="display:none; border-top:none;" id="<?=$file->file_id?>-details">
		<td colspan="4" id="<?=$file->file_id?>-details-inner">
		<?php echo $this->lang->line('files_manage_table_7') ?>: <input class="down_link" readonly="readonly" type="text" size="65" value="<?=$link['down']?>" onfocus="this.select()" onclick="this.select()" ondblclick="this.select()" /><br />
		<?php echo $this->lang->line('files_manage_table_8')?>: <a href="<?=$link['del']?>"><?=$link['del']?></a>
		<?
		if(isset($link['img']))
		{
			?><br /><?php echo $this->lang->line('files_manage_table_9') ?><a href="<?=$link['img']?>"><?=$link['img']?></a><?
		}
		?>
		</td>
	</tr>
	<tr class="details" style="display:none; border-top:none;" id="<?=$file->id?>-edit">
		<td colspan="4" id="<?=$file->file_id?>-edit-inner">
			<input name="<?=$file->id?>_fid" id="<?=$file->id?>_fid" value="<?=$file->secid?>" type="hidden" />
		
			<span class="float-right"><label for="<?=$file->id?>_desc"><?php echo $this->lang->line('files_manage_11') ?></label>
			<textarea name="<?=$file->id?>_desc" id="<?=$file->id?>_desc" cols="30" style="height:100px" rows="4"><?=$file->descr?></textarea></span>
            
			<label for="<?=$file->id?>_pass"><?php echo $this->lang->line('files_manage_12') ?></label>
			<input name="<?=$file->id?>_pass" id="<?=$file->id?>_pass" value="<?=$file->password?>" size="35" maxlength="32" type="text" /><br />
            
            <label for="<?=$file->id?>_feat"><?php echo $this->lang->line('files_manage_13') ?></label>
			<input name="<?=$file->id?>_feat" id="<?=$file->id?>_feat" <?php if($file->feature){?> checked="checked"<? }?> type="checkbox" value="1" /> <?php echo $this->lang->line('files_manage_14') ?><br /><br />
            
			<?=generateLinkButton($this->lang->line('files_manage_15'), 'javascript:;', base_url().'img/icons/ok_16.png', 'green', array('onclick' => 'editFileProps(\''.$file->id.'\');'))?>
			<?=generateLinkButton('Cancel Edit', 'javascript:;', base_url().'img/icons/close_16.png', 'red', array('onclick' => '$(\'#'.$file->id.'-edit\').hide();'))?><br /><br />
		</td>
	</tr>
	
	<?php 
		$i++;
	}
	?>
</table>
</form>

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
		var curFileId = $('#'+id+'_fid').val();
		$.post(
			'<?=site_url('upload/fileUploadProps')?>', 
			{
				fid: curFileId, 
				password: fPass, 
				desc: fDesc, 
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
			$('#userAdmin').attr('action', "<?=site_url('files/massDelete')?>");
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

<?=$pagination?>