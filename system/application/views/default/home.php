<?php if(!$this->startup->group_config->can_flash_upload)
{
	?>

	<h2 style="vertical-align:middle"><img src="<?php echo $base_url.'img/other/home2_32.png'?>" class="nb" alt="" /> <?php echo $this->lang->line('home_title')?></h2>
	<span class="alert"><?php echo $this->lang->line('home_not_logged_in', '<a href="'.site_url('user/login').'">'.$this->lang->line('home_login_text').'</a>'); ?></span>

	<?php 
}
else
{
	?>

	<h2 style="vertical-align:middle"><img src="<?php echo $base_url.'img/other/home2_32.png'?>" class="nb" alt="" /> <?php echo $this->lang->line('home_title')?></h2>
	<?php if(!empty($flashMessage)){ echo '<p>'.$flashMessage.'</p>';}?>
	<?php if(!empty($this->startup->site_config['home_info_msg'])){ echo '<span class="note">'.$this->startup->site_config['home_info_msg'].'</span>';}?>
	<div id="info_div" style="display:none">
		<h3>
			<a href="javascript:void(0);" onclick="$('#upload_limits').slideDown();$(this).parent().remove();">
				<img src="<?php echo $base_url?>img/icons/about_24.png" class="nb" alt="" /><?php echo $this->lang->line('home_upload_res'); ?>
			</a>
		</h3>
		<p>
			<span style="display:none" id="upload_limits" rel="no_close" class="info">
				<?php echo $this->lang->line('home_upload_limit', '<strong>'.intval($upload_num_limit).'</strong>', '<strong>'.intval($upload_limit).'</strong>'); ?>
				
				<?php if(trim($files_types) != '' and $files_types != '*'): ?>
				
					<br />
					<?php echo $this->lang->line('home_upload_filetypes', '<strong>'.(($file_types_allow_deny) ? $this->lang->line('home_upload_filetypes_allow') : $this->lang->line('home_upload_filetypes_deny')).'</strong>'), '.', str_replace('|', ', .', $files_types); ?>
					
				<?php endif; ?>
				
				<?php if(trim($storage_limit) != '' and $storage_limit != '0'): ?>
				
					<br /><br />
					<strong><?php echo $this->lang->line('home_limited_account_msg'); ?></strong>
					<br />
					<?php echo $this->lang->line('home_limited_remaining', '<strong>'.$storage_used.'</strong>', '<strong>'.$storage_limit.'</strong>'); ?>
					 
				<?php endif; ?>
			</span>
		</p>
	</div>
	
	<div id="flash" style="display:">
		
		<span class="alert">
			<strong><?php echo $this->lang->line('home_error')?></strong><br />
			<?php echo $this->lang->line('home_no_flash_required')?><br /><a href="http://www.adobe.com/shockwave/download/download.cgi?P1_Prod_Version=ShockwaveFlash"><?php echo $this->lang->line('home_no_flash_install')?></a>
		</span>
		
		
		<form enctype="multipart/form-data" action="<?=site_url('/upload/process/'.md5($this->functions->getRandId(32)).'/'.($this->session->userdata('id') ? $this->session->userdata('id') : 0 ))?>" method="post">
			<h3><?php echo $this->lang->line('home_upload_file_text'); ?></h3>
			<p>
				<span><?php echo $this->lang->line('home_no_flash_text'); ?></span>
				<input type="hidden" name="no_flash" value="1">
		
				<label for="file"><?php echo $this->lang->line('home_file_text'); ?></label>
				<input type="file" name="Filedata">
			
				<label for="password"><?php echo $this->lang->line('home_password_text'); ?></label>
				<input type="text" name="password" value="">
			
				<label for="description"><?php echo $this->lang->line('home_description_text'); ?></label>
				<textarea name="description" rows="8" cols="40"></textarea>
		
				<br style="clear:both" />
				<?php echo generateSubmitButton($this->lang->line('home_upload'), $base_url.'img/icons/up_16.png', 'green')?>
				<br style="clear:both" />
			</p>
		</form>
		
	</div>
	
	<div id="uploader" style="display:none;">
		<h3 style="padding-top:8px;"><?php echo $this->lang->line('home_select_files')?></h3><br />
		<div style=" padding-left:12px;">
			<div style="display: block; width:90px; height:22px; border: solid 1px #7FAAFF; background-color: #C5D9FF; padding: 2px; padding-top:6px; padding-left:6px;"><span id="spanButtonPlaceholder"></span></div>
		</div>
		<br />
	</div>
	
	
	<div id="files" style="display:none">
		<h3 style="padding-top:8px;"><?php echo $this->lang->line('home_queued')?></h3>
		<div id="file_list">
			<p>
				<?php echo $this->lang->line('home_selected_files')?> (<span id="summary">0</span> <?php echo $this->lang->line('home_files')?>).<br />
				<span class="alert" id="alert1" style="display:none">
					<?php echo $this->lang->line('home_select_error_1')?><br />
					<?php echo $this->lang->line('home_files_removed')?>.
				</span>
				<span class="alert" id="alert2" style="display:none">
					<?php echo $this->lang->line('home_select_error_2')?><br />
					<?php echo $this->lang->line('home_files_removed')?>.
				</span>
				<span class="alert" id="alert3" style="display:none">
					<?php echo $this->lang->line('home_select_error_3')?><br />
					<?php echo $this->lang->line('home_files_removed')?>.
				</span>
				<span class="alert" id="alert4" style="display:none">
					<?php echo $this->lang->line('home_select_error_4')?> <strong><?php echo intval($upload_num_limit)?></strong> <?php echo $this->lang->line('home_files')?>.<br />
					<?php echo $this->lang->line('home_select_error_5')?>.
				</span>
				<span class="alert" id="alert5" style="display:none">
					<?php echo $this->lang->line('home_select_error_6')?>.<br />
					<?php echo $this->lang->line('home_select_error_7')?>.
				</span>
			</p>
			<div class="float-right" style=" margin-bottom:1em">
				<?php echo generateLinkButton($this->lang->line('home_upload'), 'javascript:void(0);', $base_url.'img/icons/up_16.png', 'green', array('onclick'=>'swfu.startUpload();'))?>
			</div>
			<table border="0" style=" padding:0;width:98%;clear:both" id="file_list_table">
				<tr>
					<th style="width:470px" class="align-left"><?php echo $this->lang->line('home_table_1')?></th>
					<th style="width:90px"><?php echo $this->lang->line('home_table_2')?></th>
					<th style="width:85px"><?php echo $this->lang->line('home_table_3')?> <img title="Delete All?" src="<?php echo $base_url?>img/icons/delete_16.png" onclick="clearUploadQueue()" alt="" style="cursor:pointer" class="nb" /></th>
				</tr>
			</table>
			<div class="float-right">
				<?php echo generateLinkButton($this->lang->line('home_upload'), 'javascript:void(0);', $base_url.'img/icons/up_16.png', 'green', array('onclick'=>'swfu.startUpload();')); ?>
			</div>
		</div>
	</div>
	
	<input id="fid" type="hidden" />
	<input id="uid" type="hidden" value="<?php echo (intval($this->session->userdata('id')) != 0 ? intval($this->session->userdata('id')) : 0 )?>" />
	<div id="filesHidden" style="display:none"></div>
	
	<script type="text/javascript">
		var fileObj = new Array();
		var prevFile = false;
		var fileToBig = false;
		var fileNotAllowed = false;
		var filePropsObj = new Array();
		var subtractFilesFromTotal = 0;
		var curFileId = '';
		var pbUpd = 0;
		var flashUploadStartTime = '';
		var fileIcons = new Array(<?php echo $file_icons; ?>);
		
		function ___getMaxUploadSize()
		{
			return '<?php echo intval($upload_limit); ?>';
		}
		
		function ___serverUrl()
		{
			return '<?php echo $server; ?>';
		}
		
		function ___getFilePipeString()
		{
			return '<?php echo $files_types; ?>';
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
		
		function ___getFileTypesAllowOrDeny()
		{
			return <?php echo intval($file_types_allow_deny); ?>;
		}
		
		function ___toManyFilesError()
		{
			$('#alert4').show();
			setTimeout('$("#alert4").hide("normal");', 2500);
			fileToBig = false;
		}
		
		function ___generalError()
		{
			$('#alert5').show();
			setTimeout('$("#alert5").hide("normal");', 2500);
			fileToBig = false;
		}
		
		function ___filePropSaveButtons(id)
		{
			var template = "<?=str_replace("\n", '', str_replace('"', '\\"', generateLinkButton('Save Changes', 'javascript:;', base_url().'img/icons/ok_16.png', 'green', array('onclick' => 'saveFilePropChanges(\'--id--\');$(\'#--id---details\').hide();$(\'#--id---edit_img\').fadeIn(\'fast\');')).generateLinkButton('Discard Changes', 'javascript:;', base_url().'img/icons/close_16.png', 'red', array('onclick' => '$(\'#--id---details\').hide();$(\'#--id---edit_img\').fadeIn(\'fast\');'))))?>";
			
			return str_replace('--id--', id, template);
		}
		
		function str_replace (search, replace, subject, count) 
		{
	    	// Replaces all occurrences of search in haystack with replace  
            f = [].concat(search),
            r = [].concat(replace),
            s = subject,
            ra = r instanceof Array, sa = s instanceof Array;    s = [].concat(s);
		    if (count) {
		        this.window[count] = 0;
		    }
		     for (i=0, sl=s.length; i < sl; i++) {
		        if (s[i] === '') {
		            continue;
		        }
		        for (j=0, fl=f.length; j < fl; j++) {            temp = s[i]+'';
		            repl = ra ? (r[j] !== undefined ? r[j] : '') : r[0];
		            s[i] = (temp).split(f[j]).join(repl);
		            if (count && s[i] !== temp) {
		                this.window[count] += (temp.length-s[i].length)/f[j].length;}        }
		    }
		    return sa ? s : s[0];
		}
		
		function ___upLang(key)
		{
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
			lang['ft']		= '<?php echo $this->lang->line('home_js_12')?>';
			
			return lang[key];
		}
		
		$(document).ready(function()
		{
			var settings_object = { 
				file_types : "*.*", 
				file_types_description: "<?php echo $this->lang->line('home_js_9')?>", 
				file_upload_limit : <?php echo intval($upload_num_limit)?>, 
				file_size_limit : (<?php echo intval($upload_limit)?> * 1024),
				file_queue_limit : <?php echo intval($upload_num_limit)?>, 
				flash_url : ___baseUrl()+"flash/upload.swf", 
				flash9_url: ___baseUrl()+"flash/upload9.swf", 
				flash_width : "1px", 
				flash_height : "1px", 
				flash_color : "#CCCCCC", 
				debug: false,
				
				// Button settings
				button_image_url : "<?=$base_url.'img/flash_upload.png'?>",	// Relative to the SWF file
				button_placeholder_id : "spanButtonPlaceholder",
				button_width: 90,
				button_height: 18,
				button_text : '<'+'span class="button"><?=$this->lang->line('home_files_browse')?></'+'span>',
				button_text_style : '.button { font-family: Helvetica, Arial, sans-serif; font-size: 12pt;  font-weight:bold; color:#565656; }',
				button_text_top_padding: 0,
				button_text_left_padding: 22,
				button_window_mode: SWFUpload.WINDOW_MODE.TRANSPARENT,
				button_cursor: SWFUpload.CURSOR.HAND,
				
				upload_progress_handler : flashUploadProgress, 
				upload_error_handler : flashUploadError, 
				file_dialog_complete_handler : fileDialogComplete, 
				file_queue_error_handler : flashUploadQueueError,
				file_queued_handler : addFileQueue,
				upload_start_handler : beforeUploadStart, 
				upload_complete_handler : uploadDone
			};
			
			swfu = new SWFUpload(settings_object);
			if (swfu) {
				$('#flash').remove();
				$('#browser').attr('disabled', false);
				$('#uploader').show();
				$('#files').show();
				$('#info_div').show();
			}
		});
		
		function saveFilePropChanges(file_id)
		{
			filePropsObj[file_id]['desc'] = $('#'+file_id+'_desc').val();
			filePropsObj[file_id]['pass'] = $('#'+file_id+'_pass').val();
			filePropsObj[file_id]['tags'] = $('#'+file_id+'_tags').val();
			if($('#'+file_id+'_feat:checked').length)
			{
				filePropsObj[file_id]['feat'] = "1";
			}
			else
			{
				filePropsObj[file_id]['feat'] = "0";
			}	
		}
		
		function beforeUploadStart(file)
		{
			var fid = genRandId(32);
			curFileId = fid;
			var stats = swfu.getStats();
			var url;
			var fUser = $('#uid').val();
		
			var url = ___serverUrl()+"upload/process/"+fid+'/'+fUser;
			swfu.setUploadURL(url);
			placeProgressBar(file.id);
			flashUploadStartTime = Math.round(new Date().getTime()/1000.0);
			
			$("#"+file.id+"-details").css('borderTop', 'none').show();
			$("#"+file.id).addClass('details').css('borderBottom', 'none');
			//$.scrollTo( $("#"+file.id), 300);
			return true;
		}
		
		function syncFileProps(file)
		{
			var fFeatured = filePropsObj[file.id]['feat'];
			var fDesc = filePropsObj[file.id]['desc'] ;
			var fPass = filePropsObj[file.id]['pass'];
			var fTags = filePropsObj[file.id]['tags'];
			if(fPass == '' && fFeatured == '' && fDesc == '' && fTags == '')
			{
				$("#"+file.id+"-details-inner").empty().attr('colspan', 3).load('<?=site_url('upload/getLinks')?>/'+curFileId);
				return;
			}
			
			$.post(
				'<?=site_url('upload/fileUploadProps')?>', 
				{
					fid: curFileId, 
					password: fPass, 
					desc: fDesc, 
					tags: fTags, 
					featured: fFeatured
				},
				function()
				{
					$("#"+file.id+"-details-inner").empty().attr('colspan', 3).load('<?=site_url('upload/getLinks')?>/'+curFileId);
				}
			);
		}
		
		function uploadDone(file)
		{
			syncFileProps(file);
			$('#'+file.id+"-del").empty().html("<strong><?php echo $this->lang->line('home_upload_complete'); ?></strong>");
			$("#"+file.id+"-details").css('borderTop', 'none').show();
			var stats = swfu.getStats();
		
			if(stats.files_queued > 0)
			{
				swfu.startUpload();
			}
			else
			{
				$.scrollTo( $("#uploader"), 400);
			}
		}
	</script>
	<?php 
}