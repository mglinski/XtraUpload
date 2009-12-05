<h2 style="vertical-align:middle"><img src="<?=base_url().'img/icons/sticky_32.png'?>" class="nb" alt="" /> Admin Shortcut Manager</h2>
<?=$flashMessage?>
<form action="<?=site_url('admin/menu_shortcuts/view')?>" id="userAdmin" method="post" style="padding:0; margin:0; border:0;">
	
	<div id="massActions" style="clear:both; padding-top:4px;">
		<div class="float-right">
			<?=generateLinkButton('Add', site_url('admin/menu_shortcuts/add'), base_url().'img/icons/add_16.png', 'green')?>
		</div>
	</div>
	<p style=" clear:both;"></p>
	
	<table class="special" border="0" id="shortcut_list_table"cellspacing="0" style="width:98%">
		<tr>
			<th class="align-left">
				Link Name
			</th>
			<th>
				Link Locaton
			</th>
			<th>
				Actions
			</th>
		</tr>
		<? foreach($shortcuts->result() as $shortcut)
		{
			?>			
			<tr <?=alternator('class="odd"', 'class="even"')?>>
				<td>
					<?=$shortcut->title?>
				</td>
				<td>
					<a href='<?=site_url($shortcut->link)?>' rel="external">
						<?=site_url($shortcut->link)?>
					</a>
				</td>
				<td>
				<?
					if($shortcut->status == 1)
					{
						?><a title="Turn Off Shortcut" href="<?=site_url('admin/menu_shortcuts/turn_off/'.$shortcut->id)?>"><img src="<?=base_url()?>img/icons/on_16.png" class="nb" alt="Edit" /></a><?
					}
					else
					{
						?><a title="Turn On Shortcut" href="<?=site_url('admin/menu_shortcuts/turn_on/'.$shortcut->id)?>"><img src="<?=base_url()?>img/icons/off_16.png" class="nb" alt="Edit" /></a><?
					}
					?>
					<a title="Edit This Shortcut" href="<?=site_url('admin/menu_shortcuts/edit/'.$shortcut->id)?>"><img src="<?=base_url()?>img/icons/edit_16.png" class="nb" alt="Edit" /></a>
					
					<a title="Delete This Shortcut" onclick="return confirm('Are you sure you want to delete this shortcut?')" href="<?=site_url('admin/menu_shortcuts/delete/'.$shortcut->id)?>"><img src="<?=base_url()?>img/icons/close_16.png" class="nb" alt="Delete" /></a>
				</td>
			</tr>
			<? 
		}
		?>
	</table>
</form>
<br />
<div style="float:right">
	<form action="<?=site_url('admin/files/count')?>" method="post" style="padding:0; margin:0; border:0;">
		Results Per Page: <input type="text" size="6" maxlength="6" name="fileCount" value="<?php echo $perPage?>" />
	</form>
</div>
<?=$pagination?>

<script type="text/javascript" charset="utf-8">
function submitOrderChange()
{
	//TODO: add javascript actions to drag and drop sort these shortcuts
	//$()
}
</script>
