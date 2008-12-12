<h2 style="vertical-align:middle"><img src="<?=base_url().'img/other/images_32.png'?>" class="nb" alt="" /> <?php echo $this->lang->line('image_gallys_done_header') ?></h2>

<label><?php echo $this->lang->line('image_gallys_done_1') ?></label>
<input type="text" size="70" readonly="readonly" value="<?=site_url('image/gallery/'.$gid)?>" onfocus="this.select()" onclick="this.select()" ondblclick="this.select()" />