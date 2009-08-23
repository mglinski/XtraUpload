<h2><img src="<?=base_url()?>img/icons/user_32.png" alt="" class="nb" /><?php echo $this->lang->line('user_view_header'); ?><span><?=ucwords($user->username)?></span></h2>
<div class="userProfile">
	<div>
		<? if($this->session->userdata('username') == $user->username){?>
			<span class="info"><strong><?=ucwords($user->username)?>:</strong><?php echo $this->lang->line('user_view_1'); ?><br /><?php echo $this->lang->line('user_view_2'); ?><a href="<?=site_url('user/manage')?>"></a><?php echo $this->lang->line('user_view_3'); ?></span>
		<? }?>
		<h3><img src="<?=base_url()?>img/icons/public_16.png" alt="" class="nb" /><?php echo $this->lang->line('user_view_header_1'); ?></h3>
		<p>
			<strong><?php echo $this->lang->line('user_view_4'); ?></strong> <?=ucwords($user->username)?><br />
			<br />
		</p>	
		<h3><img src="<?=base_url()?>img/icons/chart_16.png" alt="" class="nb" /><?php echo $this->lang->line('user_view_header_2'); ?></h3>
		<? 
		$num = $this->db->get_where('refrence', array('user' => $this->session->userdata('id')))->num_rows();
		?>
		<ul>
			<li style="list-style-image:none;"><strong><?php echo $this->lang->line('user_view_5'); ?></strong><?=$num?></li>
		</ul>		
	</div>
</div>