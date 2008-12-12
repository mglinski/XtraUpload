<h2 style="vertical-align:middle"><img src="<?=base_url().'img/other/server_32.png'?>" class="nb" alt="" /> Install Server Software</h2>
	<div id="massActions" style="clear:both; padding-top:4px;">
	<div class="float-left">
		<?=generateLinkButton('Manage Servers', site_url('admin/server/view'), base_url().'img/icons/back_16.png')?>
	</div>
</div>
<?php 
if($error)
{
	?>
	<p></p>
	<p>
		<span class="alert"><b>Error(s) Occured:</b><br /><?php echo $error?></span>
	</p>
	<?php 
}
else
{
	?>
	<p><br /></p>
	<?php
}
?>
<div style="border:1px #666666 solid">
	<h3 style="padding-top:0">
		<img src="<?php echo $base_url?>/img/icons/warning_24.png" class="nb" alt="" /><span style="color:#FF0000; text-decoration:underline">Important Information</span>
		<img src="<?php echo $base_url?>/img/icons/warning_24.png" class="nb" alt="" />
	</h3>
	<p style="font-weight:bold">
	This will FTP all php files required for a clean server install overwriting old files. <br />
	<span style="color:#FF0000; text-decoration:underline">THIS WILL ERASE ALL CHANGES YOU MIGHT HAVE MADE ON THIS SERVER!</span></p>
</div>
<form action="<?php echo site_url('/admin/server/install/'.$sid)?>" method="post"> 
	<input type="hidden" name="step-1" value="true" size="50" />
	<h3>Server FTP Details</h3>
	<p>
		<label>FTP URL</label>
		<input type="text" name="ftp_url" value="<?php echo ($this->input->post('ftp_url') ? $this->input->post('ftp_url') : str_replace('http://','',$server->url))?>" size="50"/><br />
		
		<label>FTP Username</label>
		<input type="text" name="ftp_user" value="<?php echo $this->input->post('ftp_user')?>" size="20"/><br />
		
		<label>FTP Password</label>
		<input type="password" name="ftp_pass" value="<?php echo $this->input->post('ftp_pass')?>" size="20"/><br />
		
		<label>FTP Port</label>
		<input type="text" name="ftp_port" value="<?php echo ($this->input->post('ftp_port') ? $this->input->post('ftp_port') : '21')?>" size="7"/><br />
		
		<label>FTP Path to install location</label>
		<input type="text" name="ftp_path" value="<?php echo $this->input->post('ftp_path')?>" size="50"/><br /><br />

		<?=generateSubmitButton('Validate FTP Settings', base_url().'img/icons/ok_16.png')?><br />
	</p>
</form>