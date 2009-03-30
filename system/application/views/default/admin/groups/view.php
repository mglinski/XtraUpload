<h2 style="vertical-align:middle"><img src="<?=base_url().'img/icons/user_group_32.png'?>" class="nb" alt="" /> Groups - Manage</h2>
<div class="users">
	<?=$flashMessage?>
	<div id="massActions" style="clear:both; padding-top:4px;">
		<div class="float-right">
			<?=generateLinkButton('New Group', site_url('admin/group/add'), base_url().'img/icons/add_16.png', NULL)?>
		</div>
	</div>
	<table class="special" border="0" cellpadding="4" cellspacing="0" style="width:98%">
	<tr>
		<th>
			<div align="center">
				Name
			</div>
		</th>
		<th>
			<div align="center">
				Description
			</div>
		</th>
		<th>
			<div align="center">
				Actions
			</div>
		</th>
	</tr>
	<?php
	foreach($groups->result() as $group)
	{
	?>
		<tr <?=alternator('class="odd"', 'class="even"')?>>
			<td><div align="center"><?php echo ucwords($group->name)?></div></td>
			<td><div align="center"><?php echo $group->descr?></div></td>
			<td>
				<div align="center"> 
					<?php
					if($group->id > 2)
					{
						if($group->status)
						{
							?>
								<a href="<?php echo site_url('admin/group/turn_off/'.$group->id)?>">
									<img src="<?php echo base_url()?>img/icons/on_16.png" class="nb" alt="public" title="Make Private" />
								</a>
							<?
						}
						else
						{
							?>
								<a href="<?php echo site_url('admin/group/turn_on/'.$group->id)?>">
									<img src="<?php echo base_url()?>img/icons/off_16.png" class="nb" alt="private" title="Make Public" />
								</a>
							<?
						}
					}
					?>
					<a href="<?php echo site_url('admin/group/edit/'.$group->id)?>">
						<img src="<?php echo base_url()?>img/icons/edit_16.png" class="nb" alt=" Edit" title="Edit" />
					</a>
					
					<?php
					if($group->id > 2)
					{
						?>
						<a href="<?php echo site_url('admin/group/delete/'.$group->id)?>"> 
							<img src="<?php echo base_url()?>img/icons/close_16.png" class="nb" alt="Delete" title="Delete" />
						</a>
						<?php
					}
					?>
				</div>
			</td>
		</tr>
	<?php
	}
	?>
	</table>
</div>