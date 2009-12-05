<h2 style="vertical-align:middle"><img src="<?=base_url().'img/icons/sticky_32.png'?>" class="nb" alt="" /> Admin Shortcuts</h2>
<form action="<?php echo site_url('admin/menu_shortcuts/add')?>" method="post">
	<input type="hidden" name="status" value="1" />
	<input type="hidden" name="order" value="<?=$order?>" />
	<h3>Add Shortcut</h3>
	<p>
		<label for="title">Name</label>
		<input type="text" name="title" value="<?=$title?>"  />
		
		<label for="link">Link</label>
		<input type="text" name="link" value="<?=$link?>"  />
		
		<br /><br />
		
		<?=generateSubmitButton('Add', base_url().'img/icons/add_16.png')?><br />
	</p>
</form>
