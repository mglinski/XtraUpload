<?
if(!$this->startup->group_config->can_url_upload)
{
	?>
	<h2 style="vertical-align:middle"><img src="<?php echo base_url().'img/icons/connect_32.png'?>" class="nb" alt="" /><?php echo $this->lang->line('upload_url_header')?></h2>
	<span class="alert">You are currently not allowed to use URL Upload. Please <a href="<?=site_url('user/login')?>">login</a> to gain access.</span>
	<?
}
else
{
?>
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
		var filePropsObj = new Array();
		var fileIcons = new Array(<?php echo $file_icons?>);
		
		function ___upLang(key)
		{
			<? $this->lang->load('home');?>
			var lang = new Array();
			lang['pc' ] 	= '<?php echo $this->lang->line('home_js_1')?>';
			lang['kbr'] 	= '<?php echo $this->lang->line('home_js_2')?>';
			lang['remain']	= '<?php echo $this->lang->line('home_js_3')?>';
			lang['desc']	= '<?php echo $this->lang->line('home_js_4')?>';
			lang['fp']  	= '<?php echo $this->lang->line('home_js_5')?>';
			lang['sc']  	= '<?php echo $this->lang->line('home_js_6')?>';
			lang['efd'] 	= '<?php echo $this->lang->line('home_js_7')?>';
			lang['rm']  	= '<?php echo $this->lang->line('home_js_8')?>';
			lang['ff1']  	= '<?php echo $this->lang->line('home_js_10')?>';
			lang['ff2']  	= '<?php echo $this->lang->line('home_js_11')?>';
			
			return lang[key];
		}
		
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
		
		function startUpload(id)
		{
			var idO = id.split('up_')[1];
			var file = filesToUpload[idO];
			var jForm = $("#urlUp");
			
			currentFileId = genRandId(16);
			$('#fid').attr('value', currentFileId);
			$('#pass').val($('#'+file.id+'_pass').val());
			$('#descr').val($('#'+file.id+'_desc').val());
			$('#link').val(file.link);
			
			var strName = ("uploader" + (new Date()).getTime());
			var jFrame = $("<iframe name=\"" + strName + "\" src=\"about:blank\" />");
			jForm.attr("target", strName);
			jFrame.css("display", "none");
			jFrame.load( function(objEvent)
			{
				syncFileProps(filesToUpload[idO]);
				endProgress(idO);
				$("iframe[name='"+strName+"']").remove();
				$('#'+idO+"-del").empty().html("<strong>Done!</strong>");
				filesToUpload[idO].uploaded = true;
				startUploadQueue();
			});
			$("body:first").append(jFrame);
		
			
			jForm.submit();
			placeProgressBar(idO);
			startProgress();
		}
		
		function syncFileProps(file)
		{
			var fFeatured = filePropsObj[file.id]['feat'];
			var fDesc = filePropsObj[file.id]['desc'] ;
			var fPass = filePropsObj[file.id]['pass'];
			if(fPass == '' && fFeatured == '' && fDesc == '')
			{
				$("#"+file.id+"-details-inner").empty().attr('colspan', 3).load('<?=site_url('upload/getLinks')?>/'+currentFileId);
				return;
			}
			
			$.post(
				'<?=site_url('upload/fileUploadProps')?>', 
				{
					fid: currentFileId, 
					password: fPass, 
					desc: fDesc, 
					featured: fFeatured
				},
				function()
				{
					$("#"+file.id+"-details-inner").empty().attr('colspan', 3).load('<?=site_url('upload/getLinks')?>/'+currentFileId);
				}
			);
		}
		
		function saveFilePropChanges(file_id)
		{
			if(typeof(filePropsObj[file_id]) == 'undefined')
			{
				filePropsObj[file_id] = new Array();
			}
			
			filePropsObj[file_id]['desc'] = $('#'+file_id+'_desc').val();
			filePropsObj[file_id]['pass'] = $('#'+file_id+'_pass').val();
			if($('#'+file_id+'_feature').attr('checked') && $('#'+file_id+'_feature').attr('value'))
			{
				filePropsObj[file_id]['feat'] ="1";
			}
			else
			{
				filePropsObj[file_id]['feat'] ="0";
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
<?
}