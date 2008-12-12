<h2><img src="<?=base_url()?>img/icons/user_32.png" alt="" class="nb" /> User Profile:  <span><?=ucwords($user->username)?></span></h2>
<div class="userProfile">
	<div>
		<? if($this->session->userdata('username') == $user->username){?>
			<span class="info"><strong><?=ucwords($user->username)?>:</strong> This is your user profile! <br />You can update these values <a href="<?=site_url('user/manage')?>">here!</a></span>
		<? }?>
		<h3><img src="<?=base_url()?>img/icons/public_16.png" alt="" class="nb" /> User Info</h4>
		<p>
			<strong>Username: </strong> <?=ucwords($user->username)?><br />
			<br />
		</p>	
		<h3><img src="<?=base_url()?>img/icons/chart_16.png" alt="" class="nb" /> User Stats</h4>
		<? 
		$num = $this->db->get_where('refrence', array('user' => $this->session->userdata('id')))->num_rows();
		?>
		<ul>
			<li style="list-style-image:none;"><strong>Uploaded Files: </strong><?=$num?></li>
		</ul>		
	</div>
</div>