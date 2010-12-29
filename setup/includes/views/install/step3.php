<?php 
$dir = dirname(__FILE__);$dir = dirname($dir.'../');$dir = dirname($dir.'../');$dir = dirname($dir.'../');$dir = dirname($dir.'../');
$dir = substr($dir, strlen($_SERVER['DOCUMENT_ROOT']));
$servername = str_replace('\\', '/', 'http://'.$_SERVER['SERVER_NAME'].'/'.$dir.'/');
?>
<div style="margin:auto; text-align:center"><h1>Database and Config Details</h1></div>
<div class="progressMenu">
	<ul>
		<li class="complete"><a href="index.php?c=install&m=step1"><img src="../img/icons/ok_16.png" border="0" alt="" /> Step 1</a></li>
		<li>&raquo;</li>
		<li class="complete"><a href="index.php?c=install&m=step2"><img src="../img/icons/ok_16.png" border="0" alt="" /> Step 2</a></li>
		<li>&raquo;</li>
		<li class="current"><img src="../img/icons/about_16.png" border="0" alt="" /> Step 3</li>
		<li>&raquo;</li>
		<li>Step 4</li>
		<li>&raquo;</li>
		<li> Step 5</li>
	</ul>
</div>
<form id="form1" name="form1" method="post" enctype="multipart/form-data" action="index.php?c=install&m=step4">
	<div class='centerbox'>
		<div class='tableborder'>
			<div class='maintitle'>Website Address </div>
			<div class='pformstrip'>Enter your website address here.</div>
			<table width='100%' cellspacing='1'>
				<tr>
					<td class='pformleftw'>
						<b>Make sure this is correct:</b>
						<div class='description'>
							Please make sure it starts with <b>http://</b> This is the address of all your files EG: http://www.yoursite.com/upload<br />
<strong>Trailing slash is required!</strong>
						</div>
					</td>
					<td class='pformright'>
						<input class="required" type='text' size="45" name='url' value='<?php echo $servername;?>' />
					</td>
				</tr>
			</table>
		</div>
		<div class='fade'>&nbsp;</div>
		
		<br />
		
		<div class='tableborder'>
			<div class='maintitle'>Website Settings </div>
			<div class='pformstrip'>This allows you to set custom cookie prefixes and a custom encryption key. Leave blank to autogenerate these values.</div>
			<table width='100%' cellspacing='1'>
				<tr>
					<td class='pformleftw'>
						<b>Cookie Prefix</b>
						<div class='description'>
							This prevents session collisions with other XU installs around the internet
						</div>
					</td>
					<td class='pformright'><input type='text' size="45" name='cookie_prefix' /></td>
				</tr>
				<tr>
					<td class='pformleftw'>
						<b>Encryption Key</b>
						<div class='description'>
							This is the key that will be used to encrypt sensitive data in XU
						</div>
					</td>
					<td class='pformright'><input type='text' size="45" name='encryption_key'/></td>
				</tr>
				<tr>
					<td class='pformleftw'>
						<b>SEO Urls</b>
						<div class='description'>
							Remove the index.php/ from generated urls, creating more SQO friendly links.
						</div>
					</td>
					<td class='pformright'><input type='checkbox' value='true' name='seo'/> Yes</td>
				</tr>
			</table>
		</div>
		<div class='fade'>&nbsp;</div>
		
		<br />
		
		<div class='tableborder'>
			<div class='maintitle'>SQL Data </div>
			<div class='pformstrip'>Please enter the correct MySQL info below for the tables to install correctly. </div>
			<table width='100%' cellspacing='1'>
			<tr>
			  <td class='pformleftw'><b>SQL Host </b>
				<div class='description'>Localhost is default, but in some cases it can be your Server IP Address</div></td>
			  <td class='pformright'><input class="required" name="sql_server" type="text" id="sql_server" value="localhost" size="45" /></td>
			</tr>
			
			<tr>
			  <td class='pformleftw'><b>SQL User </b>
				<div class='description'></div></td>
			  <td class='pformright'><input class="required" name="sql_user" type="text" id="sql_user" size="45" /></td>
			</tr>
			
			<tr>
			  <td class='pformleftw'><b>SQL Database Name</b></td>
			  <td class='pformright'><input class="required" name="sql_name" type="text" id="sql_database" size="45" /></td>
			</tr>
			
			<tr>
			  <td class='pformleftw'><b>SQL Password </b></td>
			  <td class='pformright'><input name="sql_pass" type="password" id="sql_pass" size="45" /></td>
			</tr>
			
			<tr>
			  <td class='pformleftw'><b>Database Prefix</b> <div class='description'>Optional</div></td>
			  <td class='pformright'><input name="sql_prefix" type="text" id="sql_prefix" size="45" value="xu2_" /></td>
			</tr>
			
			<tr>
			  <td class='pformleftw'><b>SQL Engine</b>
				<div class='description'>You can choose from 7 different SQL database engines. MySQL is the most popular.</div></td>
			  <td class='pformright'>
				  <select name="sql_engine">
					<option selected="selected" value="mysql">MySQL</option>
					<option value="mysqli">MySQLi</option>
					<option value="mssql">MSSQL</option>
					<option value="postgre">Postgre SQL</option>
					<option value="oci8">OCI v8</option>
					<option value="odbc">ODBC</option>
					<option value="sqlite">SQLite</option>
				  </select>
			  </td>
			</tr>		
			</table>
			<div align='center' class='pformstrip'  style='text-align:center; vertical-align:middle'>
				<div style="float:left">
					<span class="cssbutton">
						<a class="buttonRed" href="index.php?c=install&m=step2">
							<img src="../img/icons/back_16.png" border="0" alt="" /> Go Back
						</a>
					</span>
				</div>
				<div style="float:right">
					<span class="cssbutton">
						<a class="buttonGreen" href="javascript:document.form1.submit();" onclick="return $('#form1').validate().form();">
							<img src="../img/icons/ok_16.png" border="0" alt="" /> Continue
						</a>
					</span>
				</div>
				<br /><br />
			</div>
		</div>
		<div class='fade'>&nbsp;</div>
	</div>
</form>   
<script>
$(document).ready(function(){
	$("#form1").validate();
});
</script>