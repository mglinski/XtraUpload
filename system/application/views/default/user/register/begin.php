<h2 style="vertical-align:middle"><img src="<?=$base_url.'img/icons/user_32.png'?>" class="nb" alt="" /> <?php echo $this->lang->line('user_register_begin_header')?></h2>
<?=$errorMessage?>
<form action="<?=site_url('user/register')?>" method="post" id="user_reg">
	<input type="hidden" name="posted" value="1" />
	
    <label style="font-weight:bold" for="username"><?php echo $this->lang->line('user_register_begin_1')?></label>
	<input type="text" class="required remove_title" minlength="5" name="username" value="<?=$this->validation->username;?>" size="50" /><br /><br />
	
	<label style="font-weight:bold" for="group"><?php echo $this->lang->line('user_register_begin_2')?>, <a href="<?php echo site_url('user/compare')?>" rel="external"><?php echo $this->lang->line('user_register_begin_3')?></a></label>
	<select name="group" id="group_sel" onchange="isPaidGroup(this.value)">
		<?php
		$bs = array(
			'0' => $this->lang->line('user_register_begin_4'),
			'd' => $this->lang->line('user_register_begin_5'),
			'w' => $this->lang->line('user_register_begin_6'),
			'm' => $this->lang->line('user_register_begin_7'),
			'y' => $this->lang->line('user_register_begin_8'),
			'dy' => $this->lang->line('user_register_begin_9'),
		);
		$script = array();
		foreach($groups->result() as $group)
		{
			if($group->id == 2 or $group->id == 1)
			{
				continue;
			}
			
			$script[$group->id] = false;
			if($group->price > 0.00)
			{
				$script[$group->id] = true;
			}
			?>
			<option value="<?php echo $group->id?>">
				<?php echo ucwords($group->name)?>&nbsp;(<?php if($group->price > 0.00){echo '$'.$group->price.$this->lang->line('user_register_begin_10').$bs[$group->repeat_billing];}else{echo $this->lang->line('user_register_begin_11');}?>)&nbsp;
			</option>
			<?php
		}
		?>
	</select><br /><br />
	<script type="text/javascript">	
	$(document).ready(function()
	{
		isPaidGroup($('#group_sel').val());
	});
	
	function isPaidGroup(id)
	{
		var groups = new Array();
		<?php foreach($script as $id => $paid)
		{
		?>groups[<?=$id?>] = <?=$paid?>;
		<?
		}
		?>
		if(groups[id])
		{
			$('#payment_gate').slideDown('normal');
		}
		else
		{
			$('#payment_gate').slideUp('normal');
		}
	}
	</script>
	
	<div style="display:none" id="payment_gate">
		<label style="font-weight:bold" for="group">Select Payment Method</label>
		<select name="gate">
			<?php
			foreach($gates->result() as $gate)
			{
				?>
				<option <?php if($gate->default == 1){?> selected="selected"<?php }?> value="<?php echo $gate->id?>"><?php echo ucwords($gate->display_name);?></option>
				<?php
			}
			?>
		</select><br /><br />
	</div>

    <label style="font-weight:bold" for="email"><?php echo $this->lang->line('user_register_begin_12')?></label>
    <input type="text" class="required email remove_title" name="email" value="<?=$this->validation->email;?>" size="50" /><br />
	
	<label style="font-weight:bold" for="email"><?php echo $this->lang->line('user_register_begin_13')?></label>
    <input type="text" class="required email remove_title" name="emailConf" value="<?=$this->validation->emailConf;?>" size="50" /><br /><br />

    <label style="font-weight:bold" for="password"><?php echo $this->lang->line('user_register_begin_14')?></label>
    <input type="password" class="required remove_title" name="password" value="<?=$this->validation->password;?>" size="50" /><br />
    
    <label style="font-weight:bold" for="passconf"><?php echo $this->lang->line('user_register_begin_15')?></label>
    <input type="password" class="required remove_title" name="passconf" value="<?=$this->validation->passconf;?>" size="50" /><br /><br />

    
    <label style="font-weight:bold" for="captcha"><?php echo $this->lang->line('user_register_begin_16')?></label>
    <?=$captcha?><br />
	<input type="text" class="required remove_title" name="captcha" /><br /><br />
    
    <?=generateSubmitButton($this->lang->line('user_register_begin_17'), base_url().'img/other/user-add_16.png')?><br />
</form>
<script type="text/javascript">
$(document).ready(function(){
	$("#user_reg").validate();
});
</script>