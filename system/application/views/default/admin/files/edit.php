<h2 style="vertical-align:middle"><img src="<?=base_url().'img/icons/documents_32.png'?>" class="nb" alt="" /> Edit File</h2>
<form action="<?php echo site_url('admin/files/edit/'.$id)?>" method="post">
<input type="hidden" name="status" value="1" />
	<p>
		<?=generateLinkButton('Manage Files', site_url('admin/files/view'), base_url().'img/icons/back_16.png')?><br /><br />
		<label for="o_filename">File Name</label>
		<input type="text" name="o_filename" value="<?=$file->o_filename?>"  />
		
		<label for="downloads">File Downloads</label>
		<input type="text" name="downloads" value="<?=$file->downloads?>"  />
		
		<label for="pass">File Password</label>
		<input type="text" name="pass" value="<?=$file->pass?>"  />
		
		<label for="descr">File Description</label>
		<textarea name="descr" cols="60" rows="6"><?=$file->descr?></textarea>
		
		<label for="featured">Featured?</label>
		<input type="checkbox" <? if($file->feature){?> checked="checked"<? }?> name="feature" value="1"  />
		<br /><br />
		
		<?=generateSubmitButton('Edit', base_url().'img/icons/edit_16.png')?>
	</p>
</form>
