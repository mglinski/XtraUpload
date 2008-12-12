<div style="margin:auto; text-align:center"><h1>Complete!</h1></div>
<div class="progressMenu">
	<ul>
		<li class="complete"><a href="index.php?c=install&m=step1"><img src="../img/icons/ok_16.png" border="0" alt="" /> Step 1</a></li>
		<li>&raquo;</li>
		<li class="complete"><a href="index.php?c=install&m=step2"><img src="../img/icons/ok_16.png" border="0" alt="" /> Step 2</a></li>
		<li>&raquo;</li>
		<li class="complete"><a href="index.php?c=install&m=step3"><img src="../img/icons/ok_16.png" border="0" alt="" /> Step 3</a></li>
		<li>&raquo;</li>
		<li class="complete"><a href="index.php?c=install&m=step4"><img src="../img/icons/ok_16.png" border="0" alt="" /> Step 4</a></li>
		<li>&raquo;</li>
		<li class="current"><img src="../img/icons/about_16.png" border="0" alt="" /> Step 5</li>
	</ul>
</div>
<form id="form1" name="form1" method="post" enctype="multipart/form-data" action="step1.php?step=3">
	<div class='centerbox'>
		<div class='tableborder'>
			<div class='maintitle'>Success! XtraUpload v2 Has Installed Succefully </div>
			<div class='pformstrip'>Details About The Install Are Below </div>
			<table width="100%" border="0" cellpadding="0" cellspacing="0">
				<tr>
					<td width="19%" valign="middle">
						<center>
							<img src="./images/angle/checkmark.png" width="128" height="128" />
						</center>
					</td>
					<td width="100%">
						<center>
							<h1 style="color:#009900">XtraUpload was installed successfully!</h3>
							<h3 style="color:#FF0000">YOU MUST DELETE THE SETUP FOLDER FROM YOUR SERVER BEFORE XTRAUPLOAD WILL WORK!</h3>
							<p><strong>The admin login information is:</strong></p>
							<p>
								<b>Username:</b> <?php echo $this->input->post('username')?><br />
								<b>Password:</b> <?php echo $this->input->post('password')?>
							</p>
						</center>
					</td>
				</tr>
				<tr>
					<td colspan="2">
					<div align='center' class='pformstrip'  style='text-align:center; vertical-align:middle'>
								<div style="float:right">
									<span class="cssbutton">
										<a class="buttonGreen" href="../" onclick="return $('#form1').validate().form();">
											<img src="../img/icons/ok_16.png" border="0" alt="" /> Continue
										</a>
									</span>
								</div>
								<br /><br />
							</div>
					</td>
				</tr>
			</table>
		</div>
		<div class='fade'>&nbsp;</div>
		<br />
	</div>
</form>
