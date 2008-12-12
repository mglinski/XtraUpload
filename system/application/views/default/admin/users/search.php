<h2 style="vertical-align:middle"><img src="<?=base_url().'img/icons/user_32.png'?>" class="nb" alt="" /> User Manager - Search</h2>
<form action="<?=site_url('admin/user/search')?>" onsubmit="submitSearch(); return false;"  method="get">
	<p>
		<label>Search Text(can be username, email address, or ip address)</label>
		<input type="text" name="query" id="search" value="" /><br /><br />
		
		<?=generateLinkButton('Search Users', 'javascript:;', base_url().'img/icons/search_16.png', NULL, array('onclick' => 'submitSearch();'))?><br />
	</p>
</form>
<script>
function submitSearch()
{
	if($('#search').val() != '')
	{
		window.location = '<?=site_url('admin/user/search')?>/'+escape($('#search').val());
	}
}
</script>