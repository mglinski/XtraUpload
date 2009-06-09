<h2 style="vertical-align:middle"><img src="<?php echo base_url().'img/other/download_32.png'?>" class="nb" alt="" /> <?php echo $this->lang->line('files_get_header')?><a href="javascript:;" onclick="$.scrollTo($('#dlhere'),300)">&darr;</a></h2>
<?php echo $error?>
<table width="98%">
	<tr>
		<th>
			<a href="javascript:;" onclick="toggleDetails()"><img id="file-details-icon" src="<?php echo $base_url?>img/other/remove_16.png" class="nb" alt="" /> <?php echo $this->lang->line('files_get_1')?></a>
		</th>
	</tr>
	<tr id="file-details">
		<td>
			<?php if($image){?>
				<div class="float-right" style="margin-left:8px;">
					<label for="image"><?php echo $this->lang->line('files_get_2')?></label>
					<span id="image"><img src="<?php echo $image['thumb_url']?>" alt="" class="nb" /></span> 
				</div>
			<?php }?>
			<code>
				<label for="name" style="display:inline;padding-bottom:2px">
					<img class="nb" src="<?php echo base_url()?>img/icons/about_16.png" alt="" />
					<?php echo $this->lang->line('files_get_3')?>
				</label>
				<span id="name">
					<nobr><?php echo $file->o_filename?> <img class="nb" src="<?php echo base_url()?>img/files/<?php echo $file->type?>.png" alt="" /></nobr>
				</span><br />
				
				<label for="size" style="display:inline;padding-bottom:2px">
					<img class="nb" src="<?php echo base_url()?>img/icons/database_16.png" alt="" />
					<?php echo $this->lang->line('files_get_4')?>
				</label>
				<span id="size">
					<?php echo $this->functions->getFilesizePrefix($file->size)?>
				</span><br />
				
				<span id="moreInfo">
					<a href="javascript:;" class="showMoreLink" onclick="showMoreLink()">
						<img src="<?php echo base_url().'img/icons/add_16.png'?>" alt="" class="nb" />
						<?php echo $this->lang->line('files_get_5')?>
					</a>
				</span>
				<span class="hidden" style="display:none">
					<label for="md5" style="display:inline;padding-bottom:2px">
						<img class="nb" src="<?php echo $base_url?>img/icons/lock_16.png" alt="" />
						<?php echo $this->lang->line('files_get_6')?>
					</label>
					<span id="md5"><?php echo $file->md5?></span> <br />
					
					<label for="md5" style="display:inline;padding-bottom:2px">
						<img class="nb" src="<?php echo $base_url?>img/icons/calendar_16.png" alt="" />
						<?php echo $this->lang->line('files_get_7')?>
					</label>
					<span id="md5"><?php echo date('m-D-Y', $file->time)?></span> <br />
	
					<label for="user" style="display:inline;padding-bottom:2px">
						<img class="nb" src="<?php echo $base_url?>img/icons/user_16.png" alt="" />
						<?php echo $this->lang->line('files_get_8')?>
					</label>
					<span id="user"><?php echo $this->users->getUsernameById($file->user)?></span><br />
	
					<label for="dls" style="display:inline;padding-bottom:2px">
						<img class="nb" src="<?php echo $base_url?>img/icons/save_16.png" alt="" />
						<?php echo $this->lang->line('files_get_9')?>
					</label>
					<span id="dls"><?php echo intval($file->downloads)?></span><br />
					
					<?php 
					if(!empty($file->pass))
					{
						?>
						<label for="pass" style="display:inline;padding-bottom:2px">
							<img class="nb" src="<?php echo $base_url?>img/icons/security_16.png" alt="" />
							<?php echo $this->lang->line('files_get_10')?>
						</label>
						<span id="pass">
							<input value="<?php echo $file->pass?>" size="42" readonly="readonly"/>
						</span><br />
						<?php
					}
					?>
					
					<?php
					if($image)
					{
						?>
						<label for="img_links" style="display:inline;padding-bottom:2px">
							<img class="nb" src="<?php echo $base_url?>img/other/images_16.png" alt="" />
							<?php echo $this->lang->line('files_get_11')?>
						</label>
						<span id="img_links">
							<a href="<?php echo $image['code_url']?>" rel="external">
								<?php echo $image['code_url']?>
							</a>
						</span><br />
						<?php 
					}
					?>
					
					<?php 
					if(!empty($file->descr))
					{
						?>
						<label for="descr" style="display:inline;padding-bottom:2px">
							<img class="nb" src="<?php echo $base_url?>img/icons/text_16.png" alt="" />
							<?php echo $this->lang->line('files_get_12')?>
						</label>
						<span id="descr">
							<textarea readonly="readonly" rows="4" cols="56"><?php echo $file->descr?></textarea>
						</span>
						<?php
					}
					?>
					</span>
				</code>
		</td>
	</tr>
</table>

<?php if($this->startup->site_config['show_preview'] and $this->xu_api->embed->getEmbedCode($file->type))
{
	$embed = $this->xu_api->embed->getEmbedCode($file->type);
	?>
	<h3 id="dlhere"><img src="<?php echo $base_url?>img/icons/music_16.png" class="nb" alt="" /> <?php echo $this->lang->line('files_get_13')?></h3>
	<p>
		<iframe src="<?=site_url('files/embed/'.$file->type.'/'.$file->file_id)?>" width="<?=$embed['width']?>" height="<?=$embed['height']?>" scrolling="no" frameborder="0"></iframe><br />
		<a href="javascript:;" onclick="$('#mp3_embed_code').slideToggle('normal')">
			<img src="<?php echo $base_url?>img/icons/add_16.png" class="nb" alt="" /> <?php echo $this->lang->line('files_get_15')?>
		</a><br />
			<input style="display:none" id="<?=$file->type?>_embed_code" type="text" size="60" onclick="this.select();" onfocus="this.select()" value='<iframe src="<?=site_url('files/embed/'.$file->type.'/'.$file->file_id)?>" width="<?=$embed['width']?>" height="<?=$embed['height']?>" scrolling="no" frameborder="0"></iframe>' />
	</p>
	 
	<?
}
?>

<? /*File Page Hooks*/ $this->xu_api->hooks->runHooks('files::get::add_section::before_download', null); ?>

<h3 id="dlhere"><img src="<?php echo $base_url?>img/other/download_16.png" class="nb" alt="" /> <?php echo $this->lang->line('files_get_16')?></h3>
<form action="<?php echo site_url('files/gen/'.$file->file_id.'/'.$file->link_name)?>" method="post" onsubmit="return checkTimer()">
<div>
	<input type="hidden" name="pass" value="<?php echo $this->input->post('pass')?>" />
	<input type="hidden" name="waited" value="1" />
	<span id="waitL">
		<?php echo $this->lang->line('files_get_17')?><span id="waittime"><?php echo $sec?></span><?php echo $this->lang->line('files_get_18')?><br />
	</span>
	<span style="display:none" id="captcha">
	<?php if($captcha_bool)
	{
		?>
		<label style="font-weight:bold" for="captcha"><?php echo $this->lang->line('files_get_19')?></label>
		<code> 
			<span id="captchaImg"><?php echo $captcha?></span> 
			<a href="javascript:;" onclick="getNewCaptcha()">
				<img class="nb" title="Get New Captcha<?php echo $this->lang->line('files_get_20')?>" src="<?php echo $base_url?>img/icons/refresh_16.png" alt="" />
			</a><br />
			<input type="text" size="3" maxlength="3" name="captcha" />
		</code><br />
		<?php 
	}
	echo generateSubmitButton($this->lang->line('files_get_21'), base_url().'img/icons/backup_16.png', 'green');
	if($image)
	{
	    echo generateLinkButton('View This Image', $image['direct_url'], base_url().'img/icons/pictures_16.png', null, array('target' => '_blank'));
	}
	?><br />
	</span>
</div>
</form>

<? /*File Page Hooks*/ $this->xu_api->hooks->runHooks('files::get::add_section::after_download', null); ?>

<script type="text/javascript">
<? 
$rand = 'x'.str_replace('-', '', $this->functions->getRandId());
$rand1 = 'y'.str_replace('-', '', $this->functions->getRandId(32));
?>
var <?php echo $rand?> = <?php echo $sec?>;
//var <?php echo $rand?> = <? // $group->waittimme?>;
var <?php echo $rand1?> = false;
function startCountdown()
{
	setTimeout('incCountdown()', 1000);
}
function incCountdown()
{
	if(<?php echo $rand?> == 1 || <?php echo $rand?> == 0)
	{
		<?php echo $rand1?> = true;
		$('#captcha').fadeIn('fast');
		$('#waitL').fadeOut('fast');
	}
	else
	{
		<?php echo $rand?>  = <?php echo $rand?> - 1;
		$('#waittime').html(<?php echo $rand?>);
		setTimeout('incCountdown()', 1000);
	}
}
function checkTimer()
{
	if(!(<?php echo $rand1?>))
	{
		alert('You need to wait '+<?php echo $rand?>+' more seconds before you can download this file.');
		return false;
	}
}
$(document).ready(function()
{
	startCountdown();
	$('.showMoreLink').hoverIntent({
		sensitivity: 4, // number = sensitivity threshold (must be 1 or higher)
		interval: 2000,   // number = milliseconds of polling interval
		over: showMoreLink,  // function = onMouseOver callback (required)
		timeout: 0,   // number = milliseconds delay before onMouseOut function call
		out: returnFalse    // function = onMouseOut callback (required)
	});
});

function returnFalse()
{
	return false;
}

function showMoreLink()
{
	$('.hidden').slideDown('fast');
	$('#moreInfo').hide();
}

function getNewCaptcha()
{
	var id = $('#captchaImg img').attr('id').split('t_')[1];
	$('#captchaImg').load('<?php echo site_url('api/captcha/get')?>/'+escape(id));
}

function toggleDetails()
{
	if($("#file-details").css('display') == 'none')
	{
		$("#file-details-icon").attr('src', '<?php echo $base_url?>img/other/remove_16.png');
		$("#file-details").show();
	}
	else
	{
		$("#file-details-icon").attr('src', '<?php echo $base_url?>img/icons/add_16.png');
		$("#file-details").hide();
	}
}
</script>