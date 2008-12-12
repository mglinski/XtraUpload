<h3>Admin Links</h3>
<?php /* Home Links */ ?>
<ul class="sidemenu">
	<li>
		<a href="<?=site_url('/admin/home')?>">
			<img src="<?=base_url().'img/other/admin_16.png'?>" class="nb" alt="" /> Admin Home
		</a>
	</li>
	<li>
		<a href="<?=site_url('/home')?>">
			<img src="<?=base_url().'img/other/home2_16.png'?>" class="nb" alt="" /> Site Home
		</a>
	</li>
	<li>
		<a href="<?=site_url('/user/logout')?>">
			<img src="<?=base_url().'img/icons/log_out_16.png'?>" class="nb" alt="" /> Log Out
		</a>
	</li>
</ul>

<?php /* Config Links */ ?>
<h3>Manage...</h3>
<ul class="sidemenu">
	<?php echo $this->xu_api->menus->getAdminMenu();?>
</ul>

<h3>Plugins...</h3>
<ul class="sidemenu">
	<?php echo $this->xu_api->menus->getPluginMenu();?>
</ul>