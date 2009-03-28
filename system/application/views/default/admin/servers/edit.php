<h2 style="vertical-align:middle"><img src="<?=base_url().'img/other/server_32.png'?>" class="nb" alt="" /> Edit Server</h2>
<div id="massActions" style="clear:both; padding-top:4px;">
	<div class="float-left">
		<?=generateLinkButton('Manage Servers', site_url('admin/server/view'), base_url().'img/icons/back_16.png')?>
	</div>
</div>
<div style="clear:both"></div>
<form action="<?php echo site_url('/admin/server/edit/'.$id)?>" method="post"> 
	<input type="hidden" name="valid" value="true" size="50" />
	<h3>Server Details</h3>
	<p>
		<label>Server Name</label>
		<input type="text" name="name" value="<?=$server->name?>" size="50"/><br />

		<label>Server URL</label>
		<input type="text" name="url" value="<?=$server->url?>" size="50"/><br />
	
		<label>Is Active?</label>
		<input type="checkbox" name="status" <? if($server->status){?>checked="checked" <? }?>value="1"/> Yes<br /><br />

		<?=generateSubmitButton('Submit Changes', base_url().'img/icons/ok_16.png')?><br />
	</p>
</form>