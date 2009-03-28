<h2 style="vertical-align:middle"><img src="<?php echo base_url().'img/icons/edit_32.png'?>" class="nb" alt="" /> Edit Transaction</h2>
<?php echo $flashMessage?>
<form method="post" action="<?php echo site_url('admin/transactions/update/'.$transaction->id)?>">
	<h3>Transaction Info</h3>
	<?php
	$set = unserialize($transaction->settings);
	$config = unserialize($transaction->config);
	
	foreach($config as $name => $type)
	{
		if($type == 'text')
		{
			?>
			<label><?php echo ucwords(str_replace('_', ' ', $name))?></label>
			<input type="text" name="<?php echo $name?>" id="<?php echo $name?>" value="<?php echo $set[$name]?>" /><br /><br />
			<?php
		}
		else if($type == 'box')
		{
			?>
			<label><?php echo ucwords(str_replace('_', ' ', $name))?></label>
			<textarea rows="8" cols="40" name="<?php echo $name?>" id="<?php echo $name?>" ><?php echo $set[$name]?></textarea><br /><br />
			<?php
		}
	}
	?>
	<input type="hidden" name="valid" value="yes" />
	<?php echo generateSubmitButton('Update', $base_url.'img/icons/ok_16.png', 'green')?><br />
</form>