<h2 style="vertical-align:middle"><img src="<?=base_url().'img/icons/search_32.png'?>" class="nb" alt="" /> Search Files</h2>
<?=$flashMessage?>

<form action="<?=site_url('files/search')?>" onsubmit="submitSearch(); return false;"  method="get">
	<p>
		<label>Search Text(can be file id, part of a file name, or part of a file description)</label>
		<input type="text" name="query" id="search" value="" /><br /><br />
		
		<?=generateLinkButton('Search Files', 'javascript:;', base_url().'img/icons/search_16.png', NULL, array('onclick' => 'submitSearch();'))?><br />
	</p>
</form>
<script>
function submitSearch()
{
	if($('#search').val() != '')
	{
		window.location = '<?=site_url('files/search')?>/'+escape($('#search').val());
	}
}
</script>