<h2 style="vertical-align:middle"><img src="<?=base_url().'img/icons/transaction_32.png'?>" class="nb" alt="" /> Transaction Manager</h2>
<?=$flashMessage?>
<div style="display:none">
	<div id="massActions" style="clear:both; padding-top:4px;">
		<div class="float-right">
			<?=generateLinkButton('Search', site_url('admin/files/search'), base_url().'img/icons/search_16.png', NULL)?>
		</div>
	</div>
	<p style=" clear:both;"></p>
</div>
<table class="special" border="0" id="file_list_table"cellspacing="0" style="width:98%">
	<tr>
		<th>
			User
		</th>
		<th>
			Ammount
		</th>
		<th>
			Gateway
		</th>
		<th>
			Date
		</th>
		<th>
			Status
		</th>
		<th>
			Actions
		</th>
	</tr>
	<? foreach($transactions->result() as $transaction)
	{
		$user = $this->db->select('username')->get_where('users', array('id' => intval($transaction->user)))->row();
		$gate = $this->db->select('display_name')->get_where('gateways', array('id' => intval($transaction->gateway)))->row();
		?>			
		<tr <?=alternator('class="odd"', 'class="even"')?>>
			<td>
				<a href='<?=site_url('/admin/transactions/user/'.$user->id)?>'>
					<?=$user->username?>
				</a>
			</td>
			<td>
				$<?=$transaction->amount?>
			</td>
			<td>
				<?=$gate->display_name?>
			</td>
			<td>
				<?=unix_to_small($transaction->time)?>
			</td>
			<td>
				<?
				if($transaction->status)
				{
					?><img src="<?=$base_url?>img/icons/ok_16.png" alt="" class="nb" /><?
				}
				else
				{
					?><img src="<?=$base_url?>img/icons/cancel_16.png" alt="" class="nb" /><?
				}
				?>
			</td>
			<td>
			<?
				if(!$transaction->status)
				{
					?>
					<a title="Approve Transaction" href="<?=site_url('admin/transactions/approve/'.$transaction->id)?>"><img src="<?=base_url()?>img/icons/ok_16.png" class="nb" alt="Edit" /></a>
					<?
					
				}
				?>
				<a title="Edit Transaction" href="<?=site_url('admin/transactions/edit/'.$transaction->id)?>"><img src="<?=base_url()?>img/icons/edit_16.png" class="nb" alt="Edit" /></a>
				
				<a title="Delete Transaction" onclick="return confirm('Are you sure you want to delete this transaction?')" href="<?=site_url('admin/transactions/delete/'.$transaction->id)?>"><img src="<?=base_url()?>img/icons/close_16.png" class="nb" alt="Delete" /></a>
			</td>
		</tr>
		<? 
	}
	?>
</table>
<br />
<?=$pagination?>