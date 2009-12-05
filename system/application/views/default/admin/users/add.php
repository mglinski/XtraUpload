<h2 style="vertical-align:middle"><img src="<?=base_url().'img/icons/user_32.png'?>" class="nb" alt="" /> User - Add</h2><br />
<?=$error?>
<?=generateLinkButton('Manage Users', site_url('admin/user/home'), base_url().'img/icons/back_16.png')?><br />
<form action='<?php echo site_url('admin/user/add')?>' method="post">
	<h3>Add New User</h3>
    <p>
        <label style="font-weight:bold" for="username">Username</label>
		<input type="text" name="username" value="<?=$this->validation->username?>" size="50" /><br />
    
        <label style="font-weight:bold" for="email">Email</label>
        <input type="text" name="email" value="<?=$this->validation->email?>" size="50" /><br />
		
		<label style="font-weight:bold" for="group">User Group</label>
		<select name="group">
			<?php
			foreach($groups->result() as $group)
			{
				?>
				<option value="<?php echo $group->id?>"><?php echo ucwords($group->name)?></option>
				<?php
			}
			?>
		</select>
    
        <label style="font-weight:bold" for="realname">Password</label>
        <input type="text" name="password" value="<?=$this->validation->password?>" size="50" /><br /><br />

		<?=generateSubmitButton('Add User', base_url().'img/icons/ok_16.png', 'green')?><br />
    </p>
</form>