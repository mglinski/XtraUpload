<h2 style="vertical-align:middle"><img src="<?=base_url().'img/other/server_32.png'?>" class="nb" alt="" /> Add New Server</h2>
	<div id="massActions" style="clear:both; padding-top:4px;">
	<div class="float-left">
		<?=generateLinkButton('Manage Servers', site_url('admin/server/view'), base_url().'img/icons/back_16.png')?>
	</div>
</div>
<p></p>
<form action="<?php echo site_url('/admin/server/add')?>" method="post"> 
	<input type="hidden" name="valid" value="true" size="50" />
	<h3>Add New Server</h3>
	<p>
		<label>Server Name</label>
		<input type="text" name="name" value="" size="50"/><br />

		<label>Server URL</label>
		<input type="text" name="url" value="" size="50"/><br />
	
		<label>Is Active?</label>
		<input type="checkbox" name="status" value="1"/> Yes<br /><br />

		<?=generateSubmitButton('Add Server', base_url().'img/icons/add_16.png')?><br />
	</p>
</form>