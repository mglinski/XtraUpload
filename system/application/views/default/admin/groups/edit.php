<h2 style="vertical-align:middle"><img src="<?=base_url().'img/icons/user_group_32.png'?>" class="nb" alt="" /> '<?=$group->name?>' Group - Edit</h2><br />
<?=generateLinkButton('Manage Groups', site_url('admin/group/view'), base_url().'img/icons/back_16.png')?><br />
<form action='<?php echo site_url('admin/group/edit/'.$group->id)?>' method="post">
	<h3>Edit Group: <?=ucwords($group->name)?></h3>
    <p>
		<?php 
		foreach($group as $name => $value)
		{
			if($name == 'id' or $name == 'status') {continue;}
			?>
				<label style="font-weight:bold" for="<?=$name?>">
					<?=$real_name[$name]?> 
					<img src="<?php echo $base_url?>/img/icons/about_16.png" style="cursor:pointer" onclick="$('#d_<?php echo $name?>').slideToggle()" class="nb" /> 
				</label>
			<?php
				
			if($real_type[$name] == 'yesno')
			{
				?>
				<input type="radio" name="<?=$name?>" <?php if($value){?>checked="checked"<?php }?> value="1" size="50" /> Yes<br />
				<input type="radio" name="<?=$name?>" <?php if(!$value){?>checked="checked"<?php }?> value="0" size="50" /> No<br />
				<?php
			}
			else if($real_type[$name] == 'allowdeny')
			{
				?>
				<input type="radio" name="<?=$name?>" <?php if($value){?>checked="checked"<?php }?> value="1" size="50" /> Allow<br />
				<input type="radio" name="<?=$name?>" <?php if(!$value){?>checked="checked"<?php }?> value="0" size="50" /> Deny<br />
				<?php
			}
			else if(is_array($real_type[$name]))
			{
				?>
				<select name="<?=$name?>">
					<?
					foreach($real_type[$name] as $a_key => $a_val)
					{
						?>
						<option <?php if($value == $a_val){?> selected="selected" <? }?>value="<?=$a_key?>"><?=$a_val?></option>
						<?
					}
					?>
				</select><br />
				<?php
			}
			else if($real_type[$name] == 'area')
			{
				?>
				<textarea name="<?=$name?>" rows="4" cols="40" ><?=$value?></textarea>
				<?php
			}
			else
			{
				?>
				<input type="text" name="<?=$name?>" value="<?=$value?>" size="50" /><br />
				<?php
			}
			?>
			<span style="display:none; text-decoration:underline; font-weight:bold" id="d_<?php echo $name?>"><?php echo $real_descr[$name]?></span><br />
			<?php
		}
		echo '<br />';
		echo generateSubmitButton('Save Changes', base_url().'img/icons/ok_16.png', 'green')
		?><br />
    </p>
</form>