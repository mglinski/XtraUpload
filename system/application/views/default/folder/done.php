<h2 style="vertical-align:middle"><img src="<?=base_url().'img/icons/folder_32.png'?>" class="nb" alt="" /> <?php echo $this->lang->line('folder_done_header')?></h2>

<label><?php echo $this->lang->line('folder_done_1')?></label>
<input type="text" size="70" readonly="readonly" value="<?=site_url('folder/view/'.$fid)?>" onfocus="this.select()" onclick="this.select()" ondblclick="this.select()" />