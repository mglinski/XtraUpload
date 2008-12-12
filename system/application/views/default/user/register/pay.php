<h2 style="vertical-align:middle"><img src="<?=$base_url.'img/icons/user_32.png'?>" class="nb" alt="" /> <?php echo $this->lang->line('user_register_pay_header')?></h2>
<p><?php echo $this->lang->line('user_register_pay_1')?></p>
<?php echo $this->paypal_lib->paypal_form();?>