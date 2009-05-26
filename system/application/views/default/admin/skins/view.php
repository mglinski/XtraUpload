<h2 style="vertical-align:middle"><img src="<?=$base_url.'img/icons/colors_32.png'?>" class="nb" alt="" /> Skin Manager</h2>
<?=$flashMessage?>
	<div id="massActions" style="clear:both; padding-top:4px;">
	<div class="float-right">
		<?=generateLinkButton('Install New Skins', site_url('admin/skin/installNew'), $base_url.'img/icons/new_16.png', NULL)?>
	</div>
</div>
<script>
/*
 * Image preview script 
 * powered by jQuery (http://www.jquery.com)
 * 
 * written by Alen Grakalic (http://cssglobe.com)
 * 
 * for more info visit http://cssglobe.com/post/1695/easiest-tooltip-and-image-preview-using-jquery
 *
 */
 
this.imagePreview = function(){	
	/* CONFIG */
		
		xOffset = 10;
		yOffset = 30;
		
		// these 2 variable determine popup's distance from the cursor
		// you might want to adjust to get the right result
		
	/* END CONFIG */
	$("a.preview").hover(function(e){
		this.t = this.title;
		this.title = "";	
		var c = (this.t != "") ? "<br/>" + this.t : "";
		$("body").append("<p id='preview'><img class='nb' src='"+ this.href +"' alt='Image preview' />"+ c +"</p>");								 
		$("#preview")
			.css("top",(e.pageY - xOffset) + "px")
			.css("left",(e.pageX + yOffset) + "px")
			.fadeIn("fast");						
    },
	function(){
		this.title = this.t;	
		$("#preview").remove();
    });	
	$("a.preview").mousemove(function(e){
		$("#preview")
			.css("top",(e.pageY - xOffset) + "px")
			.css("left",(e.pageX + yOffset) + "px");
	});			
};


// starting the script on page load
$(document).ready(function(){
	imagePreview();
});
</script>
<style type="text/css">
/*  */

#preview{
	position:absolute;
	border:1px solid #ccc;
	background:#333;
	padding:5px;
	display:none;
	color:#fff;
}

/*  */
</style>

<table border="0" style="width:95%" id="file_list_table">
	<tr>
		<th class="align-left" style="width:90%">Skin name</th>
		<th style="text-align:center">Active?</th>
	</tr>
	<? foreach($skins->result() as $skin)
	{
		?>			
		<tr <?=alternator('class="odd"', 'class="even"')?>>
			<td style="font-size:12px; font-weight:bold; color:#006600">
				<?php
				if($skin->active)
				{
					?>
					<img src="<?=$base_url.'img/icons/colors_16.png'?>" class="nb" alt="" /> 
					<?
				}
				?>
				<a href="<?=$base_url?>system/application/views/<?=$skin->name?>/<?=$skin->name?>.png" onclick="return false;" target="_blank" class="preview">
					<?=ucwords(str_replace('_', ' ', $skin->name))?>
				</a>
			</td>
			<td style="text-align:center">
			<?php
			if(!$skin->active)
			{
			?>
				<a title="Activate This Skin" href="<?=site_url('admin/skin/setActive/'.$skin->name)?>">
					<img src="<?=$base_url?>img/icons/off_16.png" class="nb" alt="Set Active" />
				</a>
			<?php 
			}
			else
			{
			?>
				<img src="<?=$base_url?>img/icons/on_16.png" class="nb" alt="Is Active" />
			<?php 
			}
			
			if($skin->name != 'default')
			{
				?>
				<a title="Delete This Skin" href="<?=site_url('admin/skin/delete/'.$skin->name)?>">
					<img src="<?=$base_url?>img/icons/close_16.png" class="nb" alt="delete" />
				</a>
				<?
			}
			?>
			</td>
		</tr>
		<? 
	}
	?>
</table>