<script type="text/javascript" language="javascript">
<{if $forceLogin eq "1"}>location = '<{$loginLink}>';<{/if}>
var progress_window;

var lang1 = '<{$lang.script.1}>';
var lang2 = '<{$lang.script.2}>';
var lang3 = '<{$lang.script.3}>';
var lang4 = '<{$lang.script.4}>';
var files_restricted = "<{$files_restrict_allowed}>";
var fileExt = "<{$fileExt}>";
var swfu;
var flashUploadStartTime;
var flashUploadFileId;
var pbUpd = 0;
var flashUploadCancel = false;

var defaultUpload = <{$shownUploadMethod}>;

if(defaultUpload == 3)
{
	window.onload = function()
	{
		flashBrowseButton();
	}
}

function loadFileForDownload(link)
{
	location = '<{$siteurl}>index.php?p=download&hash='+link;
	return false;
}

function check_types(id) 
{
	var types = '';
	var extention = document.getElementById(id).value.split('.');
	var allow = false;
	extension = extention[extention.length-1];
	
	if(fileTypes != '*')
	{
		fileTypes = fileTypes.split('|');
		if(checkMethod)
		{
			allow = true;
			for(var i=0; i<fileTypes.length; i++)
			{
				if(extension == fileTypes[i] && allow)
				{
					allow = false;
					break;
				}
			}
		}
		else
		{
			for(var i=0; i<fileTypes.length; i++)
			{
				if(extension == fileTypes[i] && !allow)
				{
					allow = true;
					break;
				}
			}
		}
	}
	else
	{
		allow = true;
	}
	
	if(!allow)
	{
		alert('Error: Filetype ".'+extension+'" is not allowed!');
		return false;
	}
	
}

function postIt()
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

	if(isgood)
	{
		if(check_types('upload_form'))
		{
			popUP();
			<{if $can_cgi eq "1"}>
			document.getElementById("p_bar_load").style.display='';
			cgiUploadBar();
			<{/if}>
			document.getElementById("attached").submit();
		}
	}
	else
	{
		alert(lang3);
	}
	return false;
}

function update(u,p,d,a,t,e,s)
{
	$('#trans').html(u);
	$('#total').html(p);
	$('#remaining').html(d);
	$('#elapsed').html(a);
	$('#speed').html(t);
	$('#percent').html(e);
	$("#progress_img").animate({width: e*6}, 'normal');
	$("#p_link").attr('value', s);
}

function flashUpdate(u,p,d,a,t,e)
{
	if(u != '')
		$('#trans').html(u);
	
	if(p != '')
		$('#total').html(p);
	
	if(d != '')
		$('#remaining').html(d);
	
	if(a != '')
		$('#elapsed').html(a);
	
	if(t != '')
		$('#speed').html(t);
	
	if(e != '')
	{
		$('#percent').html(e);
		$("#progress_img").animate({width: e*6}, 'fast');
	}
}

function check_upload()
{
	if(document.getElementById('attached').attached.value.length == '0')
	{
		return false;
	}
	return true;
}

function check_url()
{
	if(document.getElementById("urlfile").value.length <= '12')
	{
		alert(lang4);
		return false;
	}
	else
	{
		if(check_types('urlfile'))
		{	
			//document.getElementById("url_txt").style.display = "inline"; 
			document.getElementById("link_block").style.display = "none";
			document.getElementById("up_url").style.display = "none";
			document.getElementById("p_bar_load").style.display='';
			document.getElementById("p_bar_text").style.display='';
			cgiUploadBar();
			return true;
		}
		else
		{
			return false;
		}
	}
}

function cgiUploadBar()
{
	var ourl = $('#p_link').attr('value');
	
	$.getScript(ourl, function(){setTimeout("cgiUploadBar()",4000);});
}

function flashUploadProgress(file, sofar, total)
{
	var flashCurrentTime = Math.round(new Date().getTime()/1000.0);
	
	var bRead = sofar;
	var lapsed =  flashCurrentTime - flashUploadStartTime;
	var bSpeed = 0; 
	var speed = 0; 
	var remaining = 0;
	
	if(lapsed > 0)
	{ 
		bSpeed = (bRead / lapsed); 
	}
	
	if(bSpeed > 0)
	{ 
		remaining = Math.round((total - sofar) / bSpeed); 
	}
	
	var remaining_sec = (remaining % 60); 
	var remaining_min = (((remaining - remaining_sec) % 3600) / 60); 
	var remaining_hours = ((((remaining - remaining_sec) - (remaining_min * 60)) % 86400) / 3600); 
	
	if(remaining_sec < 10){ remaining_sec = "0"+remaining_sec; }
	if(remaining_min < 10){ remaining_min = "0"+remaining_min; }
	if(remaining_hours < 10){ remaining_hours = "0"+remaining_hours; }
	
	var remainingf = remaining_hours+":"+remaining_min+":"+remaining_sec; 
	
	
	var lapsed_sec = (lapsed % 60); 
	var lapsed_min = (((lapsed - lapsed_sec) % 3600) / 60); 
	var lapsed_hours = ((((lapsed - lapsed_sec) - (lapsed_min * 60)) % 86400) / 3600); 
	
	if(lapsed_sec < 10){ lapsed_sec = "0"+lapsed_sec; }
	if(lapsed_min < 10){ lapsed_min = "0"+lapsed_min; }
	if(lapsed_hours < 10){ lapsed_hours = "0"+lapsed_hours; }
	
	var lapsedf = lapsed_hours+":"+lapsed_min+":"+lapsed_sec; 
	
	
	var percent = Math.round(100 * bRead / total);
	if(lapsed>1)
	{
		speed = Math.round(bRead / lapsed);
	}
	else
	{
		speed = 0;
	}
	speed = Math.round(speed / 1024);	
	
	if(pbUpd % 2 == 0)
	{
		flashUpdate(Math.round(sofar/1024),Math.round(total/1024),remainingf,lapsedf,speed,percent);
	}
	pbUpd++;
}

function flashBrowseButton()
{
	flashUploadCancel = true;
	$('#flashFileName').attr('value', '');
	$('#flashFileUploadButton').attr('disabled',true);
	cancelQueue();
	flashUploadCancel = false;
	swfu.selectFile();
}

function flashBrowseComplete(file)
{
	var fileTypes = '<{$filetypes}>';
	var checkMethod = <{$files_restrict_allowed}>;// 0 is Allowed, 1 is restricted
	var types = '';
	var extention = file.name.split('.');
	var allow = false;
	extension = extention[extention.length-1];
	
		
	if(fileTypes != '*')
	{
		fileTypes = fileTypes.split('|');
		if(checkMethod)
		{
			allow = true;
			for(var i=0; i<fileTypes.length; i++)
			{
				if(extension == fileTypes[i] && allow)
				{
					allow = false;
					break;
				}
			}
		}
		else
		{
			for(var i=0; i<fileTypes.length; i++)
			{
				if(extension == fileTypes[i] && !allow)
				{
					allow = true;
					break;
				}
			}
		}
	}
	else
	{
		allow = true;
	}
	
		
	if(allow)
	{
		$('#flashFileName').attr('value', file.name);
		$('#flashFileUploadButton').attr('disabled',false);
	}
	else
	{
		cancelQueue();
		alert('Error: Filetype ".'+extension+'" is not allowed!');
	}
}

function cancelQueue()
{
	var stats = swfu.getStats();
	swfu.customSettings.queue_cancelled_flag = false;

	if (stats.in_progress > 0) {
		swfu.customSettings.queue_cancelled_flag = true;
	}
	
	while(stats.files_queued > 0) {
		swfu.cancelUpload();
		stats = swfu.getStats();
	}
};

function flashUploadError(file, errorCode, message)
{
	if(errorCode != -280)
	{
		alert("Upload Failed("+errorCode+"): "+ message);
	}
}

function flashUploadQueueError(file,errorCode, message)
{
	alert(message);
}

function flashUploadComplete(file)
{
	flashUpdate(Math.round(file.size/1024),Math.round(file.size/1024),'00:00:00','','',100);
	location = '<{$siteurl}>index.php?p=fileUpload&secid=<{$sid}>';
}

function sendFlashUpload()
{
	var flashFeatured;
	var post_params;
	if($('#flashFeatured').attr('checked') && $('#flashFeatured').attr('value'))
	{
		flashFeatured = "1";
	}
	else
	{
		flashFeatured = "0";
	}

	var url;
	
	var fDesc = $('#flashDescription').val();
	if(!fDesc == 'undefined')
	{
		fDesc = '';
	}
	
	var fEmail = $('#flashEmail').val();
	if(!fEmail == 'undefined')
	{
		fEmail = '';
	}
	
	var fPass = $('#flashPassword').val();
	if(!fPass)
	{
		fPass = '';
	}

	url = "<{$server_id}>/index.php?p=upload&flash=true&sid=<{$sid}>&server=<{$server_id|escape:'urlpathinfo'}>&secid=<{$sid}>&user=<{$myuid}>&description="+fDesc+"&email="+fEmail+"&password="+fPass+"&featured="+flashFeatured;
	swfu.setUploadURL(url);
	
	popUP();
	$("#up_flash").css('display', 'none');
	$("#p_bar_load").css('display', 'block');
	flashUploadStartTime = Math.round(new Date().getTime()/1000.0);
	swfu.startUpload();
}

function load_flash()
{

	var settings_object = { 
		file_types : "*.*", 
		file_types_description: "Allowed Files", 
		file_size_limit : (<{$limit_size_int}>*1024*1024), 
		file_upload_limit : 1, 
		file_queue_limit : 1, 
		flash_url : "<{$siteurl}>flash/swfupload_f8.swf", 
		flash_width : "1px", 
		flash_height : "1px", 
		flash_color : "#FFFFFF", 
		debug : false, 
		
		upload_progress_handler : flashUploadProgress, 
		upload_error_handler : flashUploadError, 
		file_queue_error_handler : flashUploadQueueError,
		file_queued_handler : flashBrowseComplete,
		upload_complete_handler : flashUploadComplete
	};
	
	swfu = new SWFUpload(settings_object);
}

$(document).ready(function()
{
	load_flash();
	<{if $shownUploadMethod eq '1'}>
		currently_showing = 3;
	<{elseif $shownUploadMethod == '2'}>
		currently_showing = 2;
	<{else}>
		currently_showing = 1;
	<{/if}>
	
});
</SCRIPT>
<style type="text/css">
<!--
.style26 {
	font-family: Verdana, Arial, Helvetica, sans-serif;
	font-size: 12px;
}
.style115 {
	font-size: 12px
}
.style116 {
	font-size: 18px
}
.style118 {
	font-size: 12px
}
.style1 {
	font-size: 24px
}
.style123 {
	font-size: 14px
}
.border {
	background:url(<{$siteurl}>images/progress-r.gif) repeat-x;
	border-left: 1px solid grey;
	border-right: 1px solid grey;
	width: 100%;
	height: 18px;
}
.progress_img {
	background:url(<{$siteurl}>images/p_bar_n.gif) left top repeat-x;
	height: 18px;
	width: 0px;
}
.style124 {
	font-size: 16px;
	font-weight: bold;
}
-->
</style>
<input type="hidden" value="<{$uploadProgressLink}>" id="p_link" name="p_link" />
<table width="766" height="350" border="0" align="center" class="style26">
  <tr>
    <td width="760" height="220" align="left" valign="middle">
      <div id="p_bar_text" style="display:none">
        <center>
          <span class="style1">
          <{$lang.home.1}>
          </span><br />
        </center>
      </div>
      <div id="p_bar_load" style="display:none"><br />
        <hr />
        <table width="870" height="132" border="0">
          <tr>
            <td><div align="center"><br>
                <strong>
                <{$lang.home.3}>
                </strong>: <span id='percent'>0</span>%</div>
              <br />
              <br />
              <div align="center">
                <table width="650" height="26" border="0" align="center" cellpadding="1" cellspacing="0" style="border:2px solid #000000">
                  <tr>
                    <td width="26" height="24"><img src="<{$siteurl}>images/actions/Import_24x24.png" width="24" height="24" /></td>
                    <td width="600"><div class="border">
                        <div class="progress_img" id="progress_img"></div>
                      </div></td>
                    <td width="19"><img src="<{$siteurl}>images/actions/Event (Green)_24x24.png" width="24" height="24" /></td>
                  </tr>
                </table>
              </div>
              <div align="center"><span id='trans'><strong><br />
                0</strong></span>KB of <span id='total'><strong>0</strong></span>KB
                <{$lang.home.6}>
                <span id='speed'><strong>0</strong></span> KBPS) <br />
                <{$lang.home.7}>
                <span id='remaining'><strong>00 : 00 : 00</strong></span> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                <{$lang.home.9}>
                <span id='elapsed'><strong>00 : 00 : 00</strong></span></div></td>
          </tr>
        </table>
      </div>
      </div>
      <div id="link_block">
        <p align="center" class="style114 style115">
        <{* Check to see if we are logged in here *}>
          <{if !$templatelite.session.loggedin}>
		  	<br /><{$lang.home.10}><a href="<{$fpLink}>"><{$lang.home.33}></a><br />
		  <{/if}>
          <br>
          <span class="style116"><strong>
          <{$lang.home.11}>
          </strong></span> </p>
        <br />
        </div>
        <div class="style118" id="upload_sect" style="display:" align="center">
          <{if $can_flash}>
          	<a href="javascript:;" class="style119" onclick="show_upload_flash();flashBrowseButton();" ><{$lang.home.13}></a> |
          <{/if}>
          
          <{if $can_url}>
          	<a href="javascript:;" class="style119" onclick="show_upload_url()" ><{$lang.home.14}></a> |
          <{/if}>
          
          <{if $can_cgi}>
          	<a href="javascript:;" class="style119" onclick="show_upload_browse()" ><{$lang.home.15}></a> 
          <{/if}>
          <br />
          <br />
        </div>
        <div id="uploadMethods">
        <div align="center" id='up_plain' style="display:<{if $shownUploadMethod neq "1"}>none<{/if}>">
          <{if $can_cgi eq '1'}>
              <span class="style3 style123">
              <center>
                <{$lang.home.17}><{$limit_size}><{$lang.home.18}>
              </center>
              </span><br />
              <span class="style83">
              </span>
              <form action="<{$up_method}>" method="post" enctype="multipart/form-data" id="attached" onSubmit='return postIt()'>
                <input type="hidden" name="sessionid" value="<{$sid}>" />
                <input type="hidden" name="server" value="<{$server_id|escape:'urlpathinfo'}>" />
                <p align="center" ><strong>
                  <{$lang.home.23}>
                  </strong><br>
                  <input type="file" name="attached" tabindex="1" id="upload_form" size="50" />
                  <br />
                  <{$getFiles}>
                  <br />
                  <span id="uploadBrowserOptionsLink">
                  <input type="button" onclick="showUploadBrowserOptions()" value="<{$lang.home.34}>" />
                  </span>
                  <input type="submit" value="<{$lang.home.22}>" />
                <div id="uploadBrowserOptions" style="display:none; border:#FFCC33 dashed medium"><br />
                  <div align="center" style="font-size: 18px; font-weight: bold;">Upload Options </div>
                  <br />
                  <table width="753" height="209" border="0" cellpadding="3" cellspacing="3">
                    <tr>
                      <td valign="top" width="348"><p align="left" >
                          <{$lang.home.21}>
                          <br />
                          <input name="password" type="text" id="password" size="50" />
                          <br />
                      </p></td>
                      <td width="384"  valign="top" height="61"><div align="left">
                          <{if $allow_featured}>
                              <p align="left" >
                                  <{$lang.home.26}>
                                  <br />
                                  
                                  <input name="featured" type="radio" id="featured3" value="1" />
                                  <label for="featured3">
                                  	<{$lang.home.27}>
                                  </label>
                                  <br />
                                  
                                  <input name="featured" type="radio" id="featured4" value="0" checked="checked" />
                                  <label for="featured4">
                                 	 <{$lang.home.28}>
                                  </label>
                              </p>
                          <{else}>
                         	 <input name="featured" type="hidden" id="featured2" value="0" />
                          <{/if}>
                          </div>
                      </td>
                    </tr>
                    <tr>
                      <td valign="top">
                        <div align="left">
                          <{$lang.home.20}>
                          <br />
                          <textarea name="description" cols="50" rows="7" id="description"></textarea>
                          <br />
                        </div></td>
                      <td  valign="top"><div align="left">
                           <{ if $can_email}>
                            <strong>
                            <{$lang.home.30}>
                            </strong><br />
                            <textarea name="email" cols="30" rows="4" id="email1"></textarea><br />
                            <{$lang.home.31}>
                            <br />
                            <{$lang.home.32}>
                        <{/if}>
                        </div></td>
                    </tr>
                  </table>
                </div>
              </form>
		<{/if}>
        
        </div>
        <div id='up_url' style="display:<{if $shownUploadMethod neq "2"}>none<{/if}><{$shownUploadMethod2}>">
        
         <{if $can_url eq '1'}>
          <span class="style3 style123">
          <center>
            <{$lang.home.17}><{$limit_size}><{$lang.home.18}>
          </center>
          </span><br />
          <br />
          <form action="<{$up_method_url}>" method="post" enctype="multipart/form-data" onSubmit='return check_url();'>
            <div align="center">
              <input type="hidden" name="sessionid" value="<{$sid}>" />
              <input type="hidden" name="server" id='server' value="<{$server_id|escape:'urlpathinfo'}>" />
              <strong>
              <{$lang.home.19}>
              </strong><br />
              <input type="text" name="file" id="urlfile" size="50" />
              <br />
              <{$getFiles}>
              <br />
              <span id="uploadUrlOptionsLink">
              <input type="button" onclick="showUploadUrlOptions()" value="<{$lang.home.34}>" />
              </span>
              <input type="submit" value="<{$lang.home.22}>" />
              <div id="uploadUrlOptions" style="display:none; border:#FFCC33 dashed medium"><br />
                <div align="center" style="font-size: 18px; font-weight: bold;">Upload Options </div>
                <br />
                <table width="753" height="209" border="0" cellpadding="3" cellspacing="3">
                  <tr>
                    <td valign="top" width="373"><p align="left" >
                        <{$lang.home.21}>
                        <br />
                        <input name="password" type="text" id="password" size="71" />
                        <br />
                      </p></td>
                    <td width="359"  valign="top" height="61"><div align="left">
                          <{if $allow_featured}>
                              <p align="left" >
                                  <{$lang.home.26}>
                                  <br />
                                  
                                  <input name="featured" type="radio" id="featured3" value="1" />
                                  <label for="featured3">
                                  	<{$lang.home.27}>
                                  </label>
                                  <br />
                                  
                                  <input name="featured" type="radio" id="featured4" value="0" checked="checked" />
                                  <label for="featured4">
                                 	 <{$lang.home.28}>
                                  </label>
                              </p>
                          <{else}>
                         	 <input name="featured" type="hidden" id="featured2" value="0" />
                          <{/if}>
                          </div>
                    </td>
                  </tr>
                  <tr>
                    <td valign="top">
                      <div align="left">
                        <{$lang.home.20}>
                        <br />
                        <textarea name="description" cols="35" rows="7" id="description"></textarea>
                        <br />
                      </div></td>
                    <td  valign="top"><div align="left">
                        <{ if $can_email}>
                            <strong>
                            <{$lang.home.30}>
                            </strong><br />
                            <textarea name="email" cols="30" rows="4" id="email1"></textarea><br />
                            <{$lang.home.31}>
                            <br />
                            <{$lang.home.32}>
                        <{/if}>
                      </div></td>
                  </tr>
                </table>
              </div>
              </br>
              </div>
          </form>
          </center>
      <{/if}>
      
        </div>
        <div id="up_flash" style="display:<{if $shownUploadMethod neq "3"}>none<{/if}>" >
        
          <{if $can_flash eq '1'}>
          
          <span class="style3 style123">
          <center>
            <{$lang.home.17}><{$limit_size}><{$lang.home.18}>
          </center>
          </span><br />
       	  <div id="flash_upload_swf" align="center">
          		<input type="text" id="flashFileName" size="40"  /> <input type="button" value="  Browse...  " onclick="flashBrowseButton()" />
                <br />
                <{$getFiles}> <br />
                <input type="button" id="uploadFlashOptionsButton" onclick="showUploadFlashOptions()" value="<{$lang.home.34}>" />
              <input type="button" onclick="sendFlashUpload()" id="flashFileUploadButton" disabled="disabled" value="<{$lang.home.22}>" />
              <div id="uploadFlashOptions" style="display:none; border:#FFCC33 dashed medium"><br />
                <div align="center" style="font-size: 18px; font-weight: bold;">Upload Options </div>
                <br />
                <table width="753" height="209" border="0" cellpadding="3" cellspacing="3">
                  <tr>
                    <td valign="top" width="373"><p align="left" >
                        <{$lang.home.21}>
                        <br />
                        <input name="password" type="text" id="flashPassword" size="71" />
                        <br />
                      </p></td>
                    <td width="359"  valign="top" height="61"><div align="left">
                          <{if $allow_featured}>
                              <p align="left" >
                                  <{$lang.home.26}>
                                  <br />
                                  
                                  <input name="featured" type="checkbox" id="flashFeatured" value="1" />
                                  <label for="featured3">
                                  	<{$lang.home.27}>
                                  </label>
                                  <br />

                              </p>
                          <{else}>
                         	 <input name="featured" type="hidden" id="flashFeatured" value="0" />
                          <{/if}>
                          </div>
                    </td>
                  </tr>
                  <tr>
                    <td valign="top">
                      <div align="left">
                        <{$lang.home.20}>
                        <br />
                        <textarea name="description" cols="35" rows="7" id="flashDescription"></textarea>
                        <br />
                      </div></td>
                    <td  valign="top"><div align="left">
                        <{ if $can_email}>
                            <strong>
                            <{$lang.home.30}>
                            </strong><br />
                            <textarea name="email" cols="30" rows="4" id="flashEmail"></textarea><br />
                            <{$lang.home.31}>
                            <br />
                            <{$lang.home.32}>
                        <{/if}>
                      </div></td>
                  </tr>
                </table>
              </div>
              </br>
              
</div>
          <br />
          <div align="center"></div>
          <{/if}>
        </div>
        </div>
      </div>
      <br />
      <{if (count($featFiles) gt 0) and $allow_featured}>
      <hr />
      <table align="center">
        <tr>
          <td height="20"><div align="center" style="font-size:16px"><strong>
              <{$lang.home.29}>
              </strong></div></td>
        </tr>
      </table>
      <table height="163">
        <tr>
          {section name=file loop=$featuredArr}
            <table width="209" height="214" style="border:1px solid #000000" id="featured" align="center">
                <tr>
                <td width="274" align="center">
                 <p align="center"> 
                  <center> 
                   <br />
                    <strong><font size="4">{$featuredArr[file].name}</font></strong><hr />
                    <br />
                    </center>
                    <{if $featuredArr[file].thumbExists}>
                        <a href='<{$featuredArr[file].imageDirect}>' class='thickbox' rel='group-featured' title='<{$featuredArr[file].title}>'>
                            <img src='<{$featuredArr[file].thumbSrc}>' type='image/png' alt='<{$featuredArr[file].desc}>' />
                        </a><br />
                    <{/if}>
                    <{$lang.open.34}>: 
                    <{if $featuredArr[file].iconExists}>
                    	<img id='<{$featuredArr[file].id}>_<{$featuredArr[file].type}>' src='<{$siteurl}>images/icons/<{$featuredArr[file].type}>.png' alt='<{$featuredArr[file].type}>' /> 
                        (<{$featuredArr[file].type}>)<br />
                    <{else}>
                    	 <{$featuredArr[file].type}>
                    <{/if}>
                    
                    <{$lang.open.35}>: <{$featuredArr[file].dl}>
                  <hr />
                    <a href="<{$featuredArr[file].dlLink}>"><font size="4"><{$lang.open.36}></font></a>
                 </center>
                </p>
                </td>
                </tr></table>
            {/section}
        </tr>
      </table>
      <{/if}>
    </td>
  </tr>
</table>
