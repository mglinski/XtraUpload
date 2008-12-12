<h2 style="vertical-align:middle"><img src="<?=base_url().'img/icons/pictures_32.png'?>" class="nb" alt="" /> <?php echo $this->lang->line('image_home_header') ?></h2>
<h3><?php echo $this->lang->line('image_home_1')?><?=$file->o_filename?></h3>
<p>
<?php echo $this->lang->line('image_home_2')?><br />
<a href="<?=$direct_url?>" class="thickbox"><img src="<?=$thumb_url?>" alt=""  /></a><br />
<br />
<?php echo $this->lang->line('image_home_3')?><a target="_blank" href="<?=$down?>"><?=$down?></a>
</p>