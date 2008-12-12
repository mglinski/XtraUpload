<h2 style="vertical-align:middle"><img src="<?=base_url().'img/other/manage-files_32.png'?>" class="nb" alt="" /> <?php echo $this->lang->line('files_manage_title') ?></h2>
<?=$flashMessage?><br />

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
?>

<?=$pagination?><br />
<table border="0" style="width:550px" id="file_list_table">
	<tr>
		<th width="396" class="align-left"><?php echo $this->lang->line('files_manage_table_1') ?></th>
		<th width="78"><?php echo $this->lang->line('files_manage_table_2') ?></th>
		<th width="62"><?php echo $this->lang->line('files_manage_table_3') ?></th>
	</tr>
	<?php 
		$i=0;
	foreach($files->result() as $file)
	{
		$id = $file->id;
		$link = $this->files_db->getLinks($file->secid);
	?>
	<tr id="<?=$file->file_id?>">
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
			<a href='javascript:;' onclick='$("#<?=$file->file_id?>-details").toggle()'><img src="<?=site_url('/img/icons/link_16.png')?>"  title="<?php echo $this->lang->line('files_manage_table_4') ?>" class="nb" /></a>
			<a href="<?=$link['del']?>" onclick="return confirm('<?php echo $this->lang->line('files_manage_table_5') ?>');"><img src="<?=site_url('/img/icons/close_16.png')?>" title="<?php echo $this->lang->line('files_manage_table_6') ?>" class="nb" /></a>
		</td>
	</tr>
	<tr class="details" style="display:none; border-top:none;" id="<?=$file->file_id?>-details">
		<td colspan="3" id="<?=$file->file_id?>-details-inner">
		<?php echo $this->lang->line('files_manage_table_7') ?> <input class="down_link" readonly="readonly" type="text" size="65" value="<?=$link['down']?>" onfocus="this.select()" onclick="this.select()" ondblclick="this.select()" /><br /><?php echo $this->lang->line('files_manage_table_8') ?><a href="<?=$link['del']?>"><?=$link['del']?></a><?
			if(isset($link['img']))
			{
				?><br /><?php echo $this->lang->line('files_manage_table_9') ?><a href="<?=$link['img']?>"><?=$link['img']?></a><?
			}?>
		</td>
	</tr>
	
	<?php 
		$i++;
	}
	?>
</table>
<?=$pagination?>