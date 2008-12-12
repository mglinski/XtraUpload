<?php
$r1 = rand();
$r2 = rand();
if($link)
{
	?>
	<?php echo $this->lang->line('upload_links_1')?><input readonly="readonly" type="text" id="dl_<?php echo $r1?>" size="50" value="<?php echo $link['down']?>" onfocus="this.select()" onclick="this.select()" />
	<?php
	
	if(!$this->session->userdata('id'))
	{
	?>
	<br />
	<?php echo $this->lang->line('upload_links_2')?><input readonly="readonly" type="text" id="del_<?php echo $r2?>" size="50" value="<?php echo $link['del']?>" onfocus="this.select()" onclick="this.select()" />
	<?php
	}
	
	if(isset($link['img']))
	{
		?>
		<br />
		<?php echo $this->lang->line('upload_links_3')?><a href="<?php echo $link['img']?>"><?php echo $link['img']?></a>
		<?php
	}
}
else
{
	echo $this->lang->line('upload_links_4');
}
?>