<?php

if(isset($link['failed']) and $link['failed'] == true)
{
    echo $this->lang->line('upload_links_4').'<br /> Reason: '.$link['reason'];
}
elseif($link)
{
	?>
	<?php echo $this->lang->line('upload_links_1')?><input readonly="readonly" type="text" id="dl_<?php echo rand()?>" size="50" value="<?php echo $link['down']?>" onfocus="this.select()" onclick="this.select()" />
	<?php
	
	if(!$this->session->userdata('id'))
	{
	?>
	<br />
	<?php echo $this->lang->line('upload_links_2')?><input readonly="readonly" type="text" id="del_<?php echo rand()?>" size="50" value="<?php echo $link['del']?>" onfocus="this.select()" onclick="this.select()" />
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