<?php
$this->load->view($skin.'/header',  array('headerTitle' => $page_title));
?><h2 style="vertical-align:middle"><img src="<?=base_url().'img/icons/spelling_32.png'?>" class="nb" alt="" /> <?=$page_title?></h2><?
$this->load->view($skin.'/'.$page_content);
$this->load->view($skin.'/footer');
?> 
