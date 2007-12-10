<style type="text/css">
<!--
.style1 {font-size: 18px}
.style2 {
	font-size: 20px;
	font-weight: bold;
}
-->
</style>
<div align="center" class="style1"> 
  <p><span class="style2">
    <?=$sitename?> - <?=$lang['rss']['1']?></span><br />  
    <br />
  <?=$lang['rss']['2']?></p>
	  <p><a href="<?=makeXuLink('rss.php', 'act=top')?>"><?=$lang['rss']['3']?></a></p>
	  <p><a href="<?=makeXuLink('rss.php', 'act=new')?>"><?=$lang['rss']['4']?></a></p>
	  <p><a href="<?=makeXuLink('rss.php', 'act=leastDownloaded')?>"><?=$lang['rss']['5']?></a></p>
</div>
