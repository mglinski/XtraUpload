<h2 style="vertical-align:middle"><img src="<?=base_url().'img/icons/documents_32.png'?>" class="nb" alt="" /> <?php echo $this->lang->line('files_edit_headertitle'); ?></h2>
<form action="<?php echo site_url('admin/files/edit/'.$id)?>" method="post">
<input type="hidden" name="status" value="1" />
	<p>
		<?=generateLinkButton($this->lang->line('files_edit_managebutton'), site_url('admin/files/view'), base_url().'img/icons/back_16.png')?><br /><br />
		<label for="o_filename"><?php echo $this->lang->line('files_edit_filename'); ?></label>
		<input type="text" name="o_filename" value="<?=$file->o_filename?>"  />
		
		<label for="downloads"><?php echo $this->lang->line('files_edit_filedownloads'); ?></label>
		<input type="text" name="downloads" value="<?=$file->downloads?>"  />
		
		<label for="pass"><?php echo $this->lang->line('files_edit_filepassword'); ?></label>
		<input type="text" name="pass" value="<?=$file->pass?>"  />
		
		<label for="descr"><?php echo $this->lang->line('files_edit_filedescription'); ?></label>
		<textarea name="descr" cols="60" rows="6"><?=$file->descr?></textarea>
		
		<label for="featured"><?php echo $this->lang->line('files_edit_featured'); ?></label>
		<input type="checkbox" <? if($file->feature){?> checked="checked"<? }?> name="feature" value="1"  />
		<br /><br />
		
		<?=generateSubmitButton($this->lang->line('files_edit_editbutton'), base_url().'img/icons/edit_16.png')?>
	</p>
</form>
