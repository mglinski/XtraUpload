<{if $can_create_folders}>
	<h1><{$lang.addfolder.1}></h1>
	<{if isset($templatelite.post.step) and $templatelite.post.step eq "2"}>
		<h4><{$lang.addfolder.2}></h4><br />
		<fieldset style="border:medium #666666 dashed; -moz-border-radius:8px; width:425px;">
		<legend style="margin-left:20px; margin-right:20px; font-size:14px; padding-left:10px; padding-right:10px;"><{$lang.addfolder.4}></legend>
<form>
		<h2><{$lang.addfolder.5}></h2>
        
<input size='60' type='text' readonly="readonly" value='<{$folderName}>' onfocus='this.focus();this.select()' onclick='this.focus();this.select()' onmousedown='this.focus();this.select()' /><br />

<h2><{$lang.addfolder.6}></h2>
<input size='60' type='text' value='<{$siteurl}>index.php?p=view&id=<{$fid}>' onfocus='this.focus();this.select()' onclick='this.focus();this.select()' onmousedown='this.focus();this.select()' /><br />

<h2><{$lang.addfolder.7}></h2>
<input size='10' type='text' value='<{$fid}>' onfocus='this.focus();this.select()' onclick='this.focus();this.select()' onmousedown='this.focus();this.select()' /><br />

<h2><{$lang.addfolder.8}></h2>
<input size='10' type='text' value='<{$folderPass}>' onfocus='this.focus();this.select()' onclick='this.focus();this.select()' onmousedown='this.focus();this.select()' /><br />

<h2><{$lang.addfolder.9}></h2>
<input size='10' type='text' value='<{$adminPass}>' onfocus='this.focus();this.select()' onclick='this.focus();this.select()' onmousedown='this.focus();this.select()' /><br />

		</form><br />
		</fieldset>
		<br /><a href="<?=makeXuLink('index.php', 'p=folders')?>"><{$lang.addfolder.3}></a>
	<{else}>
		<form method="POST">
		  <input type='hidden' name='fname' value='<{$templatelite.post.fname}>'>
		  <input type='hidden' name='password'  id='password' value='<{$templatelite.post.password}>'>
		  <input type='hidden' name='step' value='2'>
		  <input type='hidden' name='admin_password' value='<{$templatelite.post.admin_password}>'>
		  <{$lang.addfolder.10}>
		  <br>
		  <textarea name="files" cols="60" rows="10"></textarea>
		  <br>
		  <input type='submit' value='Continue'>
		</form>
	<{/if}>
<{/if}>