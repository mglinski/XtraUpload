<h2><img src="<?=base_url().'img/icons/pictures_32.png'?>" class="nb" alt="" /> <?php echo $this->lang->line('image_links_header') ?></h2>
<p>
	<label><?php echo $this->lang->line('image_links_1') ?></label>
	<img src="<?=$thumb_url?>" alt=""  /><br />
	<br />
	<?php echo $this->lang->line('image_links_2') ?><a rel="external" href="<?=$down?>"><?=$down?></a>
</p>

<h3><?php echo $this->lang->line('image_links_3') ?></h3>
<p>
	<label><?php echo $this->lang->line('image_links_4') ?></label>
	<input id="imagelinks_1" value="<?=$img_url?>" size="70" readonly="readonly" onclick="this.focus();this.select()" ondblclick="this.focus();this.select()" type="text" />
	
	<label><?php echo $this->lang->line('image_links_5') ?></label>
	<input id="imagelinks_2" value="[url=<?=$img_url?>][img=<?=$thumb_url?>][/url]" size="70" onclick="this.focus();this.select()" ondblclick="this.focus();this.select()" readonly="readonly" type="text" />
	
	<label><?php echo $this->lang->line('image_links_6') ?></label>
	<input id="imagelinks_3" value="[URL=<?=$img_url?>][IMG]<?=$thumb_url?>[/IMG][/URL]" size="70" readonly="readonly" onclick="this.focus();this.select()" ondblclick="this.focus();this.select()" type="text" />
	
	<label><?php echo $this->lang->line('image_links_7') ?></label>
	<input id="imagelinks_4" value="[URL=<?=$img_url?>][IMG]<?=$thumb_url?>[/IMG][/URL]" size="70" readonly="readonly" onclick="this.focus();this.select()" ondblclick="this.focus();this.select()" type="text" />
	
	<label><?php echo $this->lang->line('image_links_8') ?></label>
	<input id="imagelinks_5" value="[URL=<?=$img_url?>][IMG=<?=$thumb_url?>][/URL]" size="70" readonly="readonly" onclick="this.focus();this.select()" ondblclick="this.focus();this.select()" type="text" />
	
	<label><?php echo $this->lang->line('image_links_9') ?></label>
	<input id="imagelinks_6" value="&lt;a href='<?=$img_url?>'&gt;&lt;img src='<?=$thumb_url?>' border='0' alt='' /&gt;&lt;/a&gt;" size="70" readonly="readonly" onclick="this.focus();this.select()" ondblclick="this.focus();this.select()" type="text" />
	
	<label><?php echo $this->lang->line('image_links_10') ?></label>
	<input id="imagelinks_7" value="&lt;a href='<?=$img_url?>'&gt;&lt;img src='<?=$direct_url?>' border='0' alt='' /&gt;&lt;/a&gt;" size="70" readonly="readonly" onclick="this.focus();this.select()" ondblclick="this.focus();this.select()" type="text" />
	
	<label><?php echo $this->lang->line('image_links_11') ?></label>
	<input id="imagelinks_8" value="<?=$direct_url?>" size="70" readonly="readonly" onclick="this.focus();this.select()" ondblclick="this.focus();this.select()" type="text" />
</p>