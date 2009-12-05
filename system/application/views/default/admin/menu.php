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

<? 
// I hate the COM, so if on a windows box dont show the CPU load
$load = $this->functions->getServerLoad(0);
if($load > 100)
{
    $load = 100;
}

if(!isset($_SERVER['WINDIR'])){?>
<h3>Server Load</h3>
<ul class="sidemenu">
	<li>
        <div class="progress_border" style="margin-left:2px; width:99%;">
            <div class="progress_img_sliver" style="width:<?=round($load)?>%"></div>
        </div>
		<span><?=$load?>%</span>
	</li>
</ul>
<? }?>

<?php /* Config Links */ ?>
<?php echo $this->xu_api->menus->getAdminMenu();?>

<h3>Plugins...</h3>
<ul class="sidemenu">
	<?php echo $this->xu_api->menus->getPluginMenu();?>
</ul>