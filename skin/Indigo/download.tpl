<{if $status eq 'info'}>
	<style type="text/css">
    <!--
    .style47{
        font-family: Verdana, Arial, Helvetica, sans-serif;
        font-size: 12px;
    }
    .style49{ color: #FF0000; font-weight: bold;}
    .body{ color: #666666}
    #submit1{
        font-family: Verdana, Arial, Helvetica, sans-serif;
        font-size: 12px;
        font-weight: bold;
        background-color: #CCCCCC;
        border: thin solid #CC6600;
    }
    form:
    margin:0;
    padding:0;
    }
    .style57{font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 14px; font-weight: bold; color: #000000; }
    .style59{font-size: 18px; font-style: italic; }
    -->
    </style>
<div align="center">

                <div id="process"></div>
                <{if isset($templatelite.SESSION.a_id) && intval($templatelite.SESSION.a_id) != 0}>
                 <a href="javascript:;" style="font-size:14px" onclick="$('#qa_links').fadeIn('normal').css('display','block');$(this).fadeOut('normal');">Quick Admin Actions</a>
                    <table width="545" height="46" border="0" cellpadding="5" cellspacing="0" id="qa_links" style="display:none;border:2px solid #FF0000">
                        <tr>
                            <td width="280" height="42" colspan="2"><div align="center" style="font-size: 18px">Quick Admin Actions:</div></td>
                            <td width="133" height="42">
                                <div align="center">
                                    <a href="<{$siteurl}>admin/filemanager.php?edit=1&amp;file=<{$fileId}>"><?=get_icon('Edit','small')?>Edit File</a>
                                </div>
                            </td>
                            <td width="132" height="42">
                                <div align="center">
                                    <a onclick="return confirm('Are you sure you want to delete this file?')" href="<{$siteurl}>admin/filemanager.php?report=1&amp;byall=1&amp;pageno=0&amp;del=<{$fileId}>"><?=get_icon('Document_(Remove)', 'small');?>Delete File</a>
                                </div>
                            </td>
                        </tr>
                    </table>
                  <{/if}>
                  <table width="100%" height="83" border="0" cellpadding="3" cellspacing="3" bordercolor="E3E3E1" style="border:1px solid #000000">
                    <tr>
                      <td width="12%" height="27"><div align="right" class="style47"><strong><{$lang.download_summary.1}>:</strong></div></td>
                      <td width="42%"><div align="left" class="style47"><{$ORIG_FILENAME}> <img id="icon_<{$type}>" src="<{$siteurl}>images/icons/<{$type}>.png" alt="<{$type}>" />
</div></td>
                      <td width="16%"><div align="right" class="style47"><strong>MD5 Checksum: </strong></div></td>
                      <td width="30%"><div align="left" class="style47"><{$MD5}></div></td>
                    </tr>
                    
                    <tr>
                      <td height="34%"><div align="right" class="style47"><strong><{$lang.download_summary.2}>:</strong></div></td>
                      <td width="42%"><div align="left"  class="style47"><{$UPLOADER}></div></td>
                      <td><div align="right" class="style47"><strong><{$lang.download_summary.3}>:</strong></div></td>
                      <td><div align="left"  class="style47"><{$SIZE}></div></td>
                    </tr>
                    <tr>
                      <td height="27"><div align="right" class="style47"><strong><{$lang.download_summary.4}>:</strong></div></td>
                      <td><div align="left" class="style47"><{$DOWNLOADS}></div></td>
                      <td><div align="right" class="style47"><strong><{$lang.download_summary.5}>:</strong></div></td>
                      <td><div align="left" class="style47"><{$MBLIMIT}><{$lang.download_summary.6}>. </div></td>
                    </tr>
                  </table>
                  
                  <{if $description ne ''}>
                      <p align="center" class="style47">
                          <strong class="style49">
                              <span class="style57"><{$lang.download_summary.7}>:</span><br />
                              <textarea name="textarea" cols="40" rows="6" readonly="readonly"><{$description}></textarea><br />
                          </strong>
                      </p>
                  <{/if}>
                    
                  <form  method="POST" enctype="multipart/form-data" onSubmit="return checkTime();" >
                    <input name="waited" type="hidden" id="waited" value="yes">
                    <input name="pass_test" type="hidden" id="pass_test" value="true">
                    <input name="pass1" type="hidden" id="pass1" value="{PASS}">
                    <br />
                    <br />
                    <div align="center" id="dl1" style="display: ;border:#FF0000 dotted thick;width:420px"><p><b>Captcha Image:</b>
                   <{$CAPTCHA}>
                   <br />Please type the characters in the textbox to authorize downloading.</p>
                   </div>
                   <br />
                    <div id="dl3" style="font-size:14px; display:none"><{$REPORT_FILE_LINK}></div><br />
                    <div id="dl" style="display:none;"><input type="submit" value="Download File Now!" id="downloadFileNow"></div>
                  </form>
                    <div id="dl4"></div>
                    <div id="dl2">
                    	<{if $limit_wait > 1}>
                        	<p align="center" class="style47"><strong class="style49"><span class="style59">&gt;&gt;</span></strong> <span class="style59"><a href="<?=makeXuLink('index.php', 'p=fastpass')?>"><{$lang.download.4}></a> <strong class="style49">&lt;&lt;</strong></span></p>
                        <{/if}>
                    </div>
                        <br />
                      <span class="style47"><{$lang.download_summary.8}><a href="<?=$siteurl?>index.php?p=rules"><{$lang.download_summary.9}></a></span></p>
                      <br>
                <br>
                
                <div align="center" style="border: #E3E3E1 1px solid">
                	<{$GET_ACC}>
                </div>
</div>
    
    <br />
<script type="text/javascript"> 
    eval("set_time(<{$WAIT_TIME}>,'<{$F_HASH}>');");
    var  showCapt = '<{$CAPTCHA_TRUE}>';
    if(showCapt.length == 0)
    {
        $('#dl1').hide();
    }
    $('#main_c').css('height','auto');
	var comm_name = false;
	var comm_title = false;
	var comm_body = false;
	var comm_email = false;
	
	function check_comment()
	{
		if($("#author").attr("value") > 2)
		{
			alert('You must supply a name to post comments.')
			return false;
		}
		else if($("#title").attr("value") > 2)
		{
			alert('You must give your comment a title .')
			return false;
		}
		else if(!$("#email").attr("value") > 2)
		{
			alert('You must supply an email address to post comments.')
			return false;
		}
		else if(!$("#body").attr("value") > 2)
		{
			alert('You must type a comment post one.')
			return false;
		}
		else
		{
			return true;
		}
	}
	</script>
<{elseif $status eq 'link'}>
	<br />
    <br />
<div id="m_link" style="text-align:center;font-size:16px">
        <{$lang.download.10}><{$lang.download.11}><br /> 
        <a target="_new" href="<{$siteurl}>index.php?p=faq"><{$lang.download.12}></a>
</div>
<br /><div style="text-align:center">
<code><{$lang.download.3}><a href="<{$link}>"><{$link}></a></code>
</div>
<{/if}>