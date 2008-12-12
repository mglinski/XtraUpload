<script type="text/javascript" src="<?php echo $base_url?>/js/charts.js"></script>
<h2 style="vertical-align:middle"><img src="<?=base_url().'img/icons/reports_32.png'?>" class="nb" alt="" /> Mass Emailer</h2>
<?php if(!empty($flashMessage)){ echo '<p>'.$flashMessage.'</p>';}?>
<form method="post" action="<?php echo site_url('admin/email/send')?>">
	<h3>Send Mass EMail</h3>
	<p>
		<label>Select user group to send email to</label>
		<select name="group">
			<option value="0">All Users</option>
			<?php
			$groups = $this->db->get('groups');
			foreach($groups->result() as $group)
			{
				?>
				<option value="<?php echo $group->id?>"><?php echo $group->name?></option>
				<?php
			}
			?>
		</select><br />
		
		<label>Subject</label>
		<input type="text" size="60" name="subject" />	<br />
		
		<label>Message</label>
		<textarea name="msg" cols="60" rows="10"></textarea><br />
		
		<?php echo generateSubmitButton('Send Emails', base_url().'img/icons/ok_16.png', 'green')?><br /><br />
	</p>
</form>
