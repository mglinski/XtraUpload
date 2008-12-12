<h2 style="vertical-align:middle"><img src="<?=base_url().'img/other/download_32.png'?>" class="nb" alt="" /> <?php echo $this->lang->line('files_pass_title') ?></h2>
<? if($error){?><span class="alert"><?php echo $this->lang->line('files_pass_1') ?></span><?php }?>
<form action="<?=site_url('files/get/'.$file->file_id.'/'.$file->link_name)?>" method="post">
<h3 id="dlhere">Enter File Password<?php echo $this->lang->line('files_pass_2') ?></h3>
<p>
	<?php echo $this->lang->line('files_pass_3') ?>
	<code> 
		<label style="font-weight:bold" for="pass">File Password:<?php echo $this->lang->line('files_pass_4') ?></label>
		<input type="text" size="40" maxlength="32" name="pass" />
	</code><br />
	<?=generateSubmitButton($this->lang->line('files_pass_5'), base_url().'img/icons/security_16.png', 'green')?><br />
</p>
</form>