<script type="text/javascript" >
<{if $forceLogin eq "1"}>
location = '<{$loginLink}>';
<{/if}>
var progress_window;

var lang1 = '<{$lang.script.1}>';
var lang2 = '<{$lang.script.2}>';
var lang3 = '<{$lang.script.3}>';
var lang4 = '<{$lang.script.4}>';
var files_restricted = "<{$files_restrict_allowed}>";
var fileExt = "<{$fileExt}>";

function loadFileForDownload(link)
{
	location = '<{$siteurl}>index.php?p=get&file='+link;
	return false;
}


function check_types(id) 
{
	var isgood = false;
	var array = fileExt.split("|");
	
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
		// File types are restricted
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
						isgood = false;
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
		// File types are allowed
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
			setTimeout('cgiUploadBar()',5000);
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
function load_flash()
{
	$('#flash_upload_swf').flash(
	{ 
		pluginspage: 'http://www.adobe.com/go/getflashplayer',
		type: 'application/x-shockwave-flash', 
		width: "500", 
		height: "200", 
		src: '<{$siteurl}>upload.swf', 
		quality: "high", 
		wmode: "transparent", 
		flashvars: {
						server: "<{$server_id}>", 
						server1: "<{$server_id|escape:'urlpathinfo'}>", 
						sessionid: "<{$sid}>", 
						secid: "<{$sid}>", 
						limit: "<{$limit_size_int}>", 
						allowed: "<{$filetypes}>", 
						allow_featured: "<{$allow_featured_int}>", 
						loggeduser: "<{$myuid}>", 
						files_restricted: "<{$files_restrict_allowed}>", 
						rewrite_links: "<{$rewrite_links}>", 
						can_email: "<{$can_email}>"
					}
	}, 
	{ 
		expressInstall: true, 
		version: 8 
	});
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
	background:url(<{$siteurl}>images/p_bar_n.gif) repeat-x;
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
          <{if !$upload_cgi}> 
          	<{$lang.home.2}> 
          <{/if}>
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
          <{if !$smarty.session.loggedin}>
		  	<br /><{$lang.home.10}><a href="<{$fpLink}>"><{$lang.home.33}></a><br />
		  <{/if}>
          <br>
          <span class="style116"><strong>
          <{$lang.home.11}>
          </strong></span> </p>
        <br />
        <div class="style118" id="upload_sect" style="display:" align="center">
          <{if $can_flash}>
          	<a href="javascript:;" class="style119" onclick="show_upload_flash()" ><{$lang.home.13}></a> |
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
          <div id="flash_upload_swf" align="center"></div>
          <br />
          <div align="center">
            <{$getFiles}>
          </div>
          <{/if}>
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
