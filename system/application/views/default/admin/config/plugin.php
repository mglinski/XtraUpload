<h2 style="vertical-align:middle"><img src="<?php echo base_url().'img/icons/options_32.png'?>" class="nb" alt="" /> Config Settings</h2>
<?php echo $flashMessage?>
<form method="post" action="<?php echo site_url('admin/config/update')?>">
	<h3>General Config</h3>
	<table width="500" border="0">
		<?php
		$this->load->helper('string');
		foreach($configs->result() as $config)
		{
			?>
			<tr <?=alternator('class="odd"', 'class="even"')?>>
				<td width="150"><?php echo $config->description1?></td>
				<td width="350">
					<?php
					if($config->type == 'text')
					{
						?>
						<input type="text" name="<?php echo $config->name?>" id="<?php echo $config->name?>" value="<?php echo $config->value?>" />
						<img src="<?php echo $base_url?>/img/icons/about_16.png" style="cursor:pointer" onclick="$('#d_<?php echo $config->name?>').slideToggle()" class="nb" /> 
						<span style="display:none" id="d_<?php echo $config->name?>"><?php echo $config->description2?></span>
						<?php
					}
					else if($config->type == 'box')
					{
						?>
						<textarea rows="8" cols="40" name="<?php echo $config->name?>" id="<?php echo $config->name?>" ><?php echo $config->value?></textarea>
						<img src="<?php echo $base_url?>/img/icons/about_16.png" style="cursor:pointer" onclick="$('#d_<?php echo $config->name?>').slideToggle()" class="nb" />&nbsp;<span style="display:none" id="d_<?php echo $config->name?>"><?php echo $config->description2?></span>
						<?php
					}
					else if($config->type == 'color')
					{
						?>
						<div id="color_<?php echo $config->id?>"></div>
						<input type="text" name="<?php echo $config->name?>" value="<?php echo $config->value?>" id="<?php echo $config->name?>" \>
						<?php echo $config->description2?>
						<script>
						$("#color_<?php echo $config->id?>").farbtastic('<?php echo $config->name?>','<?php echo $config->value?>');
						$("#color_<?php echo $config->id?>").css('background-color','<?php echo $config->value?>');
						</script><br />
						<?php
					}
					else
					{
						$description = $config->description2;
						$description = explode('|-|',$description);
						?>
						<input type="radio" name="<?php echo $config->name?>" id="<?php echo $config->name?>" value="1"<?php if($config->value == '1'){?> checked="checked"<?php } ?> />
						<?php echo $description[0]?><br />
						
						<input type="radio" name="<?php echo $config->name?>" id="<?php echo $config->name?>" value="0"<?php if($config->value == '0'){?> checked="checked"<?php } ?> /> 
						<?php echo $description[1]?><br />
					<?php
					}
					?>
				</td>
			</tr>
			
		<?php
		}
		?>
	</table>
	<input type="hidden" name="valid" value="yes" />
	<?php echo generateSubmitButton('Update', base_url().'img/icons/ok_16.png', 'green')?><br />
</form>