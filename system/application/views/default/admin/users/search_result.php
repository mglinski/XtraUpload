<h2 style="vertical-align:middle"><img src="<?=base_url().'img/icons/user_32.png'?>" class="nb" alt="" /> Manage Users - Search</h2>
<div class="users">
	<?=$flashMessage?>
	<form action="<?=site_url('admin/user/')?>" id="userAdmin" method="post" style="padding:0; margin:0; border:0;">
		<div id="massActions" style="clear:both; padding-top:4px;">
			<div class="float-left">
				<?=generateLinkButton('Delete', 'javascript:;', base_url().'img/icons/close_16.png', 'red', array('onclick' => 'deleteSubmit()'))?>
			</div>
			<div class="float-right">
				<?=generateLinkButton('Search', site_url('admin/user/search'), base_url().'img/icons/search_16.png', NULL)?>
			</div>
		</div>
		<h3 style="clear:both">
			Search Query: "<?php echo $query?>" <br />
			Number of results: <?php echo $res_num?>
		</h3>
		<table class="special" border="0" cellpadding="4" cellspacing="0" style="width:98%">
		<tr>
			<th><div align="center"><input type="checkbox" onchange="switchCheckboxes(this.checked)" /></div></th>
			<th>
				<div align="center">
					<a href="javascript:;" onclick="<?=getSortLink('id', $sort, $direction)?>">
						ID #<?=getSortArrow('id', $sort, $direction)?>
					</a>
				</div>
			</th>
			<th>
				<div align="center">
					<a href="javascript:;" onclick="<?=getSortLink('username', $sort, $direction)?>">
						Name<?=getSortArrow('username', $sort, $direction)?>
					</a>
				</div>
			</th>
			<th>
				<div align="center">
					<a href="javascript:;" onclick="<?=getSortLink('email', $sort, $direction)?>">
						Email<?=getSortArrow('email', $sort, $direction)?>
					</a>
				</div>
			</th>
			<th>
				<div align="center">
					Space
				</div>
			</th>
			<th>
				<div align="center">
					Actions
				</div>
			</th>
		</tr>
		<?php
		foreach($users->result() as $user)
		{
		?>
			<tr <?=alternator('class="odd"', 'class="even"')?>>
				<td>
					<div align="center">
						<input type="checkbox" id="check-<?php echo $user->id?>" name="users[]" value="<?php echo $user->id?>" />&nbsp;
						<?php echo $user->id?>
					</div>
				</td>
				<td><div align="center"><?php echo $user->id?></div></td>
				<td><div align="center"><?php echo $user->username?></div></td>
				<td><div align="center"><?php echo $user->email?></div></td>
				<td><div align="center"><?php echo $this->functions->getFilesizePrefix($this->files_db->getFilesUseageSpace($user->id))?></div></td>
				<td>
					<div align="center"> 
					    <?php
					    if($user->status == 0 and $user->id != 1)
					    {
					        ?><a href="<?php echo site_url('admin/user/turn_on/'.$user->id)?>">
							<img src="<?php echo base_url()?>img/icons/off_16.png" class="nb" alt="Activate User" title="Activate User" />
						</a><?
					    }
					    else if($user->id != 1)
					    {
					        ?><a href="<?php echo site_url('admin/user/turn_off/'.$user->id)?>">
							<img src="<?php echo base_url()?>img/icons/on_16.png" class="nb" alt="Deactivate User" title="Deactivate User" />
						</a><?
					    }
					    ?>
						<a href="<?php echo site_url('admin/user/edit/'.$user->id)?>">
							<img src="<?php echo base_url()?>img/icons/edit_16.png" class="nb" alt=" Edit" title="Edit" />
						</a>
						<?php if($user->id != 1)
						{
							?>
							<a href="<?php echo site_url('admin/user/delete/'.$user->id)?>" onclick="return confirm('Are you sure you want to delete this user?')">
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
	</form>
	<div style="float:right">
		<form action="<?=site_url('admin/user/search_count/'.$query)?>" method="post" style="padding:0; margin:0; border:0;">
			Results: <input type="text" size="6" maxlength="6" name="userCount" value="<?php echo $perPage?>" />
		</form>
	</div>
	<?=$pagination?>
	
	<div class="clearer"></div>
	<form style="display:none" method="post" id="sortForm" action="<?=site_url('admin/user/sort')?>">
		<input type="hidden" id="formS" name="sort" />
		<input type="hidden"id="formD" name="direction" />
	</form>
	<script>
		function deleteSubmit()
		{
			if(confirm('Are you sure you want to delete these users?'))
			{
				$('#userAdmin').attr('action', "<?=site_url('admin/user/massDelete/'.$query)?>");
				$('#userAdmin').submit();
			}
		}
		
		function switchCheckboxes()
		{
			$('input[@type=checkbox]').each( function() 
			{
				this.checked = !this.checked;
			});
		}
		
		function switchCheckbox(id)
		{
			$('#'+id).each( function() 
			{
				this.checked = !this.checked;
			});
		}
		
		function sortForm(col, dir)
		{
			$('#formS').val(col);
			$('#formD').val(dir);
			$('#sortForm').get(0).submit();
		}
	</script>
</div>