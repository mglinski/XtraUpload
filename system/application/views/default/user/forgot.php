<h2><img alt="" class="nb" src="<?=base_url().'img/icons/help_32.png'?>" /><?php echo $this->lang->line('user_forgot_')?></h2>
<?=$errorMessage?>

<form action='<?php echo site_url('user/forgotPassword')?>' method="post">
<input type="hidden" name="posted" value="true"  />
	<h3><?php echo $this->lang->line('user_forgot_1')?></h3>
    <p>
        <label style="font-weight:bold" for="username"><?php echo $this->lang->line('user_forgot_2')?></label>
        <input type="text" name="username" value="<?=$this->validation->username?>" size="50" /><br /><br />
        
        <label style="font-weight:bold" for="passconf"><?php echo $this->lang->line('user_forgot_3')?></label>
        <input type="text" name="email" value="<?=$this->validation->email?>" size="50" /><br /><br />
        
		<?=generateSubmitButton($this->lang->line('user_forgot_4'), base_url().'img/icons/security_16.png')?><br />
	</p>
</form>