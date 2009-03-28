<h2 style="vertical-align:middle"><img src="<?php echo base_url().'img/icons/tools_32.png'?>" class="nb" alt="" /> Site Maintenance </h2>
<?=$flashMessage?>

<h3>View PHPINFO Debug/Settings Output</h3>
<p class="action">
    <span class="desc">View your local PHPINFO, describing all your PHP settings(opens in a new window).</span>
    <?=generateLinkButton('View PHPINFO Page', site_url('admin/actions/php_info'), base_url().'img/icons/about_16.png', NULL, array('rel' => 'external', 'target' => '_blank'))?>
</p><br /><br />

<h3>Clear Site/Settings Cache</h3>
<p class="action">
    <span class="desc">Clear your local cache files and generate new ones. This is useful if your getting random PHP errors.</span>
    <?=generateLinkButton('Clear Site/Settings Cache', site_url('admin/actions/clear_cache'), base_url().'img/icons/trash_16.png', NULL)?>
</p><br /><br />

<h3>Run Site Cron</h3>
<p class="action">
    <span class="desc">Run the site cron now, removing all orphaned files and running any extention cron files.</span>
    <?=generateLinkButton('Run Site Cron', site_url('admin/actions/run_cron'), base_url().'img/icons/history_16.png', NULL)?>
</p><br /><br />

<h3>Sync Server Settings</h3>
<p class="action">
    <span class="desc">Sync out the latest settings to each slave server, config, user groups and plugins.</span>
    <?=generateLinkButton('Sync Server Settings', site_url('admin/actions/update_server_cache'), base_url().'img/icons/sync_16.png', NULL)?>
</p><br /><br />

