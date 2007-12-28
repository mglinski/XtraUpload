<? if($_GET['error'] == 'size')
{
	?>
	<script>alert('<?=$lang['uploadError']['1']?>');</script>
	<p align="center" style="color: #FF0000;font-weight: bold;font-size:24px;"><span id="download_text" class="style41"><?=$lang['uploadError']['2']?></span></p><br />
	<p align="center" style="font-family: Verdana, Arial, Helvetica, sans-serif;font-weight: bold;font-size: 12px;"><?=$lang['uploadError']['3']?> <a href="<?=makeXuLink('index', 'p=fastpass')?>"><?=$lang['uploadError']['4']?></a> <?=$lang['uploadError']['5']?> <a href="<?=makeXuLink('index', 'p=login')?>"><?=$lang['uploadError']['6']?></a><?=$lang['uploadError']['7']?></p>
	<br />
	<? 
}
else if($_GET['error'] == 'ftp_login')
{
	?>
	<script>alert('<?=$lang['uploadError']['8']?>');</script>
	<p align="center" style="color: #FF0000;font-weight: bold;font-size:24px;"><span id="download_text" class="style41"><?=$lang['uploadError']['9']?></span></p><br />
	<p align="center" style="font-family: Verdana, Arial, Helvetica, sans-serif;font-weight: bold;font-size: 12px;"><?=$lang['uploadError']['10']?></p>
	<br />
	<? 
}
else if($_GET['error'] == 'banned')
{
	?>
	<script>alert('<?=$lang['uploadError']['11']?>');</script>
	<p align="center" style="color: #FF0000;font-weight: bold;font-size:24px;"><span id="download_text" class="style41"><?=$lang['uploadError']['12']?></span></p><br />
	<p align="center" style="font-family: Verdana, Arial, Helvetica, sans-serif;font-weight: bold;font-size: 12px;"><?=$lang['uploadError']['13']?> <a href="<?=makeXuLink('index', 'p=rules')?>">T.O.S.</a>.</p>
	<br />
	<? 
}
else if($_GET['error'] == 'unknown')
{
	?>
	<script>alert('<?=$lang['uploadError']['14']?>');</script>
	<p align="center" style="color: #FF0000;font-weight: bold;font-size:24px;"><span id="download_text" class="style41"><?=$lang['uploadError']['15']?></span></p><br />
	<p align="center" style="font-family: Verdana, Arial, Helvetica, sans-serif;font-weight: bold;font-size: 12px;"><?=$lang['uploadError']['16']?></p>
	<br />
	<? 
}
else
{
	?>
	<script> location = '<?=makeXuLink('index.php', array('p'=>'home'))?>'; </script>
    <? 
}
?>