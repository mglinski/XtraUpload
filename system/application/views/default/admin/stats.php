<script type="text/javascript" src="<?php echo $base_url?>/js/charts.js"></script>
<h2 style="vertical-align:middle"><img src="<?=base_url().'img/icons/chart_32.png'?>" class="nb" alt="" /> Site Stats</h2>
<h3>Information</h3>
<p>
Here you can view a graphical representation of many site stats including weekly upload count, new users, total used space by server, etc. Please select a chart to view the corresponding data.
</p>

<div>
	<select onchange="getChart('<?php echo site_url('api/charts/')?>/'+this.value+'/600/300')">
		<option value="null" selected="selected">Select a Chart</option>
		<optgroup label="Uploads">
			<option value="all_uploads">All Uploads</option>
			<option value="uploads_weekly">All Uploads >> Weekly</option>
			<option value="all_images_vs_regular">All Uploads >> Files vs Images</option>
			<option value="all_remote_vs_host_uploads">All Uploads >> Local vs Remote</option>
			<option value="all_server_uploads">All Uploads >> By Server</option>
		</optgroup>
		
		<optgroup label="New Uploads">
			<option value="images_vs_regular_weekly">New Uploads >> Files vs Images >> Weekly</option>
			<option value="remote_vs_host_uploads_weekly">New Uploads >> Local vs Remote >> Weekly</option>
		</optgroup>
		
		<optgroup label="Downloads">
			<option value="all_downloads">All Downloads</option>
			<option value="downloads_weekly">All Downloads >> Weekly</option>
		</optgroup>
		
		<optgroup label="Servers">
			<option value="all_server_used_space">Servers >> Used Space</option>
		</optgroup>
		
		<optgroup label="New Users">
			<option value="total_new_users_weekly">New Users >> Weekly</option>
		</optgroup>
	</select>
</div>

<h3 id="chart_name">Please select a Chart</h3>
<p id="chart_data"></p>
<script type="text/javascript">
function getChart(chartUrl)
{
	$('#chart_data').html('<img src="<?php echo $base_url?>images/loading.gif" class="nb" />');
	$.ajax({type: 'GET', url: chartUrl+'/r_'+rand(1,999999999), cache: true, dataType: 'script'}); 
	$('#chart_name').html('Your Requested Chart');
}

function rand( min, max ) {
    // http://kevin.vanzonneveld.net
    // +   original by: Leslie Hoare
    // *     example 1: rand(1, 1);
    // *     returns 1: 1
 
    if( max ) {
        return Math.floor(Math.random() * (max - min + 1)) + min;
    } else {
        return Math.floor(Math.random() * (min + 1));
    }
}
</script>