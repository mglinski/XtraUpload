<?php
if($this->session->userdata('id'))
{
?>
	<h3><?php echo $this->lang->line('global_welcome')?> <?=$this->session->userdata('username')?>!</h3>
	<ul class="sidemenu">
		<li>
			<a href="<?=site_url('user/manage')?>">
				<img src="<?=$base_url?>img/icons/options_16.png" class="nb" alt="" /> <?php echo $this->lang->line('global_manage')?>
			</a>
		</li>
		<li>
			<a href="<?=site_url('user/changePassword')?>">
				<img src="<?=$base_url?>img/icons/security_16.png" class="nb" alt="" /> <?php echo $this->lang->line('global_change')?>
			</a>
		</li>
		<li>
			<a href="<?=site_url('user/logout')?>">
				<img src="<?=$base_url?>img/icons/log_out_16.png" class="nb" alt="" /> <?php echo $this->lang->line('global_logout')?>
			</a>
		</li>
	</ul>
<?
}
else
{
?> 
	<h3><?php echo $this->lang->line('global_member_login')?> </h3>
	<form action="<?=site_url('user/login')?>" method="post" class="loginform">
	<p>
		<label for="username"><b><?php echo $this->lang->line('global_username')?> </b></label>
		<input style="background:2px center url(<?=$base_url?>img/icons/user_16.png) no-repeat transparent; padding-left:22px" type="text" id="username" name="username" />
		
		<label for="password"><b><?php echo $this->lang->line('global_password')?> </b></label>
		<input style="background:2px center url(<?=$base_url?>img/other/key_16.png) no-repeat transparent; padding-left:22px" type="password" id="password" name="password"  /><br /><br />
		<?=generateSubmitButton($this->lang->line('global_login'), $base_url.'img/icons/log_in_16.png', 'green')?><br />
		</p>
	</form>
	<ul class="sidemenu">
		<li>
			<a href="<?=site_url('user/forgotPassword')?>">
				<img src="<?=$base_url?>img/icons/help_16.png" class="nb" alt="" /> <?php echo $this->lang->line('global_forgot_pass')?>
			</a>
		</li>
		<li>
			<a href="<?=site_url('user/register')?>">
				<img src="<?=$base_url?>img/other/user-add_16.png" class="nb" alt="" /> <?php echo $this->lang->line('global_new_user')?>
			</a>
		</li>
	</ul>
<?php
}	

// Get action submenus
echo $this->xu_api->menus->getSubMenu();