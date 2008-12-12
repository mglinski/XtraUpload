<h2 style="vertical-align:middle"><img src="<?php echo base_url().'img/icons/connect_32.png'?>" class="nb" alt="" /><?php echo $this->lang->line('upload_url_header')?></h2>
<p><?php echo $this->lang->line('upload_url_1')?><span style="color:#FF0000"><?php echo $this->lang->line('upload_url_2')?></span><?php echo $this->lang->line('upload_url_3')?><br />
	<br />
</p>

<p>
	<label for="linkBlock">
		<a href="javascript:;" style="cursor:pointer" onclick="toggleUploadBlock()">
			<img alt="" id="uploadImgSwitch" src="<?php echo $base_url?>img/other/remove_16.png" class="nb"/> 
			<?php echo $this->lang->line('upload_url_4')?>
		</a>
	</label>
	<span id="uploadTextBlock">
		<textarea id="linkBlock" name="linkBlock" cols="65" rows="15"></textarea><br />
		<span class="cssButton" style="display:block">
			<a onclick="addToQueue();" class="buttonGreen" href="javascript:;"> 
				<img alt="" src="<?php echo $base_url?>img/icons/add_16.png"/><?php echo $this->lang->line('upload_url_5')?>
			</a>
		</span><br />
	</span>
</p>


<div id="files" style="display:">
	<h3><?php echo $this->lang->line('upload_url_6')?></h3>
	<div id="file_list">
		<p>
			<?php echo $this->lang->line('upload_url_7')?>(<span id="summary">0</span><?php echo $this->lang->line('upload_url_8')?>).<br />
			<span class="alert" id="alert1" style="display:none"></span>
			<span class="alert" id="alert2" style="display:none"></span>
			<span class="float-right"><?php echo generateLinkButton($this->lang->line('upload_url_9'), 'javascript:startUploadQueue();', $base_url.'img/icons/up_16.png', 'green')?><br /><br /></span>
		</p>
		<div style="clear:both"></div>
		<table border="0" style="width:98%" id="file_list_table">
			<tr>
				<th style="width:470px" class="align-left"><?php echo $this->lang->line('upload_url_10')?></th>
				<th style="width:85px"><?php echo $this->lang->line('upload_url_11')?> <img title="<?php echo $this->lang->line('upload_url_12')?>" src="<?php echo $base_url?>img/icons/delete_16.png" onclick="clearUploadQueue()" alt="<?php echo $this->lang->line('upload_url_12')?>" style="cursor:pointer" class="nb" /></th>
			</tr>
		</table>
		<p>
			<span class="float-right"><?php echo generateLinkButton($this->lang->line('upload_url_9'), 'javascript:startUploadQueue();', $base_url.'img/icons/up_16.png', 'green')?><br /><br /></span>
		</p>
	</div>
</div>

<form action="<?=$server.'upload/url_process'?>" method="post" id="urlUp" style="display:none">
	<p>
		<input type="hidden" id="fid" name="fid" value="" />	
		<input type="hidden" name="link" id="link" value="" />
		<input type="hidden" name="descr" id="descr" value="" />
		<input type="hidden" name="pass" id="pass" value="" />
		<input type="hidden" name="user" id="pass" value="<?php echo $this->session->userdata('id')?>" />
	</p>
</form>

<script type="text/javascript">
	var doProgress = false;
	var file_count = 0;
	var filesToUpload = [];
	var currentFileId;
	var allowCheckProgress=false;
	var fileIcons = new Array(<?php echo $file_icons?>);
	
	function toggleUploadBlock()
	{
		if($('#uploadTextBlock').css('display') != 'none')
		{
			$('#uploadTextBlock').slideUp('fast');
			$('#uploadImgSwitch').attr('src', '<?php echo $base_url?>/img/icons/add_16.png');
		}
		else
		{
			$('#uploadTextBlock').slideDown('fast');
			$('#uploadImgSwitch').attr('src', '<?php echo $base_url?>/img/other/remove_16.png');
		}
	}
	
	function ___getFileIcon(icon)
	{
		if(in_array(icon, fileIcons))
		{
			return icon;
		}
		else
		{
			return 'default';
		}
	}
	
	function in_array(needle, haystack, strict) 
	{
		// http://kevin.vanzonneveld.net
		var found = false, key, strict = !!strict;
	 
		for (key in haystack) {
			if ((strict && haystack[key] === needle) || (!strict && haystack[key] == needle)) {
				found = true;
				break;
			}
		}
	 
		return found;
	}
	
	function ___progressURL()
	{
		return "<?php echo site_url('upload/get_progress')?>";
	}
</script>