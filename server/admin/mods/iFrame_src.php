<?
include('./include/functions.inc.php');

if(isset($_FILES['attached']))
{
	// Uploading Files Class 
	include_once('./include/kernel/upload.php');
	$kernel->upload = new upload();
	$upload = $kernel->upload->set();
	$ret = $kernel->upload->return;
	if($kernel->upload->error != '')
	{
		displayIFrameUpload();
	}
	else
	{
	
		$kernel->server->update_bandwith($kernel->upload->file_name);
		$ret = explode('|', $ret);
		echo "<b>Your File Link:</b> <a href='".$ret[0]."'>". $ret[0]."</a>";
		echo "<hr />";
		displayIFrameUpload();
	}
}
else
{
	displayIFrameUpload();
}



function displayIFrameUpload()
{
	global $kernel, $db, $lang, $files_restrict_allowed, $filetypes, $upload_cgi;
	$sid = md5(uniqid(rand()));
	$server_id = get_server();
	
	if($limit_size == '0')
	{
		$limit_size = 'Unlimited';
	}
	$dtstart = time();
	$dtnow = $dtstart;
	$pagelink = $siteurl."include/progress.php?sid=".$sid."&start_time=0&server=".urlencode($server_id);
	?>
<html>
<head>
<title></title>
<script type="text/javascript">
	
	var progress_window;
	
	var lang1 = '<?=$lang['script']['1']?>';
	var lang2 = '<?=$lang['script']['2']?>';
	var lang3 = '<?=$lang['script']['3']?>';
	var lang4 = '<?=$lang['script']['4']?>';
	var files_restricted = "<?=$files_restrict_allowed?>";
	
	function check_types(id) 
	{
		var ext = "<?=strtolower(str_replace(array('\n','\r'),'',$filetypes));?>";
		var isgood = false;
		var array = ext.split("|");
		
		var file; 
		var p;
		var file_array;
		file = document.getElementById(id).value;
		file_array = file.split(".");	
		p =	file_array.length;
		p--;
		file = file_array[p].toLowerCase();
		if(files_restricted)
		{
			for(var i=0 ; i < array.length ; i++)
			{				
				if(!isgood)
				{
					if(array[i] == '*')
					{
						isgood = true;
					}
					else
					{
						if(file == array[i].toLowerCase())
						{
							isgood = true;
						}
					}
				}	
			}
			if(isgood)
			{
				return true;
			}
			else
			{
				alert(lang1+file+lang2);
				return false;
			}
			
		}
		else
		{
			for(var i=0 ; i < array.length ; i++)
			{				
				if(!isgood)
				{
					if(array[i] == '*')
					{
						isgood = true;
					}
					else
					{
						if(file == array[i].toLowerCase())
						{
							isgood = true;
						}
					}
				}	
			}
			
			if(!isgood)
			{
				return true;
			}
			else
			{
				alert(lang1+file+lang2);
				return false;
			}
		}
		
	}
	
	
	function popUP()
	{
	document.getElementById("p_bar_text").style.display = "inline";
	document.getElementById("link_block").style.display = 'none';
	}
	
	function postIt(description, password, featured1)
	{
		sid = document.getElementById("attached").sessionid.value;
		serverurl = unescape(document.getElementById("attached").server.value);
		iTotal = escape("-1");
		var isgood = check_upload();
		basename = document.getElementById("upload_form").value.split('/');
		count = basename.length; count--;
		basename1 = basename[count].split('\\');
		count = ''; 
		count = basename1.length; count--;
		basename = ''; 
		basename = basename1[count];
		var featured = 0;
		if(featured1)
		{
			featured = 1;
		}
		if(isgood)
		{
			if(check_types('upload_form'))
			{
				popUP();
				document.getElementById("attached").submit();
			}
		}
		else
		{
			alert(lang3);
		}
		return false;
	}
	
	function redirect(URLStr) 
	{ 
		location = URLStr; 
	}
	
	function check_upload()
	{
		if(document.getElementById('attached').attached.value.length == '0')
		{
			return false;
		}
		return true;
	}
	</SCRIPT>
<style type="text/css">
	<!--
	
	.style26 {font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 12px; }
	
	.style114 {
		font-size: 18px;
		font-weight: bold;
	}
	.style115 {font-size: 12px}
	.style116 {font-size: 18px}
	.style118 {font-size: 12px}
	.style1 {font-size: 24px}
	.style123 {font-size: 14px}
	
	.border 
	{
	  background: url(<?=$siteurl?>images/progress-r.gif) repeat-x;
	  border-left: 1px solid grey;
	  border-right: 1px solid grey;
	  width: 100%;
	  height: 18px;
	}
	
	.progress_img 
	{
	  background: url(<?=$siteurl?>images/p_bar_n.gif) repeat-x;
	  height: 18px;
	  width: 0px;
	}
	
	-->
	</style>
</head>
<body>
<div id="p_bar_text" style="display:none"> <span class="style1">
  <?=$lang['main2']['1']?>
  </span>
  </center>
</div>
<div id="link_block">
<span class="style3 style123">
<?=$lang['main2']['17'].''.$limit_size.''.$lang['main2']['18']?>
</span>
<form action="<?=$siteurl?>index.php?p=upload" method="post" enctype="multipart/form-data" id="attached" onSubmit='return postIt(this.description.value,this.password.value,<? if($allow_featured){?>this.featured1.checked<? }else{?>0<? }?>)'>
  <p align="left" ><strong>
    <?=$lang['main2']['23']?>
    </strong><br>
    <input type="file" name="attached" tabindex="1" id="upload_form" size="50" />
  </p>
  <input name="description" type="hidden" id="description" />
  <input name="password" type="hidden" id="password"  />
  <input name="featured" type="hidden" id="featured2" value="0" />
  <input type="hidden" name="sessionid" value="<?=$sid;?>" />
  <input type="hidden" name="server" value="<?=urlencode($server_id)?>" />
  <input type="submit" class="style26" value="<?=$lang['main2']['22']?>" />
</form>
</div>
</body>
</html>
<?
}
?>