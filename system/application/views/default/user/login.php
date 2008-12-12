<h2><img alt="" class="nb" src="<?=base_url().'img/icons/user_32.png'?>" /><?php echo $this->lang->line('user_login_header')?></h2>
<?=$errorMessage?>
<div id="login">
<form action="<?=site_url('user/login')?>" method="post" class="loginform">
<input type="hidden" name="submit" value="1" />
	<p>
		<label for="username"><b><?php echo $this->lang->line('user_login_1')?></b></label>
		<input style="background:2px center url(<?=base_url().'img/icons/user_16.png'?>) no-repeat transparent; padding-left:22px" type="text" id="username" name="username" />
		
		<label for="password"><b><?php echo $this->lang->line('user_login_2')?></b></label>
		<input style="background:2px center url(<?=base_url().'img/other/key_16.png'?>) no-repeat transparent; padding-left:22px" type="password" id="password" name="password"  /><br /><br />
		<?=generateSubmitButton($this->lang->line('user_login_3'), base_url().'img/icons/log_in_16.png', 'green')?><br />
		</p>
	</form>
</div>
