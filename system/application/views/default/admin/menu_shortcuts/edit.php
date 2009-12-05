<h2 style="vertical-align:middle"><img src="<?=base_url().'img/icons/sticky_32.png'?>" class="nb" alt="" /> Admin Shortcuts</h2>
<form action="<?php echo site_url('admin/menu_shortcuts/edit/'.$shortcut->id)?>" method="post">
	<input type="hidden" name="status" value="1" />
	<h3>Edit Shortcut</h3>
	<p>
		<label for="o_filename">Name</label>
		<input type="text" name="title" value="<?=$shortcut->title?>"  />
		
		<label for="downloads">Link</label>
		<input type="text" name="link" value="<?=$shortcut->link?>"  />
		
		<label for="downloads">Order</label>
		<input type="text" name="order" value="<?=$shortcut->order?>"  />

		<br /><br />
		
		<?=generateSubmitButton('Edit', base_url().'img/icons/edit_16.png')?><br />
	</p>
</form>
