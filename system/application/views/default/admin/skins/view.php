<h2 style="vertical-align:middle"><img src="<?=base_url().'img/icons/colors_32.png'?>" class="nb" alt="" /> Skin Manager</h2>
<?=$flashMessage?>
	<div id="massActions" style="clear:both; padding-top:4px;">
	<div class="float-right">
		<?=generateLinkButton('Install New Skins', site_url('admin/skin/installNew'), base_url().'img/icons/new_16.png', NULL)?>
	</div>
</div>
<table border="0" style="width:95%" id="file_list_table">
	<tr>
		<th class="align-left" style="width:95%">Skin name</th>
		<th style="text-align:center">Active?</th>
	</tr>
	<? foreach($skins->result() as $skin)
	{
		?>			
		<tr <?=alternator('class="odd"', 'class="even"')?>>
			<td style="font-size:12px; font-weight:bold; color:#006600"><img src="<?=base_url().'img/icons/colors_16.png'?>" class="nb" alt="" /> <?=ucwords(str_replace('_', ' ', $skin->name))?></td>
			<td style="text-align:center">
			<?php
			if(!$skin->active)
			{
			?>
				<a title="Activate This Skin" href="<?=site_url('admin/skin/setActive/'.$skin->name)?>">
					<img src="<?=base_url()?>img/icons/off_24.png" class="nb" alt="Set Active" />
				</a>
			<?php 
			}
			else
			{
			?>
				<img src="<?=base_url()?>img/icons/on_24.png" class="nb" alt="Is Active" />
			<?php 
			}
			?>
			</td>
		</tr>
		<? 
	}
	?>
</table>