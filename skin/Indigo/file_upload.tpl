<{if !isset($templatelite.GET.secid)}>
    <{$lang.file_upload.1}>
    <script>
        function r(){location="index.php?p=home"}
        setTimeout('f()',1500);
    </script>
<{/if}>
<script type="text/javascript">
var eedw = 1;
function toggle1(loc)
{
	if (eedw == 0)
	{
		$('#'+loc).slideUp("normal");
		$('#show').html('<{$lang.file_upload.2}>');
		eedw = 1;
	}
	else
	{
		$('#'+loc).slideDown("normal");
		$('#show').html('<{$lang.file_upload.3}>');
		eedw = 0;
	}

}
</script>
<style type="text/css">
<!--
.style1 {font-size: 14px}
.style6 {
	font-size: 14px;
	
}
.style8 {font-size: 14px; font-weight: bold; }
-->
</style>
<table width="967" border="0" align="center" cellpadding="0" cellspacing="0" id="upload">
  <tr>
    <td width="967"><div align="center"><font size="4" face="Verdana, Arial, Helvetica, sans-serif" color="#009900"><span class="style512"><strong><br>
        <{$lang.upload.7}> </strong></span></font><br />
        <strong> <{$filename}> 
        <{$lang.url.19}></strong></div></td>
  </tr>
  <tr>
    <td><div align="center" class="style1">
      <p align="center"><br />
      <{if $reUpload}>
        <b><{$reMsg}></b>
      <{/if}>
      <{if $img}>
      <font face="Verdana, Arial, Helvetica, sans-serif">
      <div style="border:medium dashed #999999; width:<{if $imgSize.width > 180}><{$imgSize.width + 20}>;<{else}>200<{/if}>px; height:<{$imgSize.height + 20}>px"> <strong><{$lang.url.20}></strong> <br />
        <img src="<{$thumb}>"  border='0'/> </div>
      </font>
      <{/if}>
      </p>
      <div align="center">
        <table width="91%" border="0" cellspacing="0" cellpadding="5" style="border:1px solid #000000">
          <tr>
            <td width="24%"><div align="right"> <font face="Verdana, Arial, Helvetica, sans-serif" class="style1"><{$lang.upload.8}></font> </div></td>
            <td width="76%"><div align="left"><font face="Verdana, Arial, Helvetica, sans-serif"> <a href="<{$furl}>"  class="style1"> <{$furl}> </a> </font></div></td>
          </tr>
          <{if !$reUpload}>
          <tr>
            <td><div align="right"><font face="Verdana, Arial, Helvetica, sans-serif" class="style1"> <{$lang.upload.15}> </font></div></td>
            <td><div align="left"><font face="Verdana, Arial, Helvetica, sans-serif" class="style1"> <a href="<{$durl}>"  class="style1"> <{$durl}> </a></font></div></td>
          </tr>
          <{/if}>
          <tr>
            <td><div align="right"><font face="Verdana, Arial, Helvetica, sans-serif" class="style1"> <{$lang.upload.9}> </font></div></td>
            <td><div align="left"><font face="Verdana, Arial, Helvetica, sans-serif"  class="style1"><b> <{$hash}> </b></font></div></td>
          </tr>
          <tr>
            <td><div align="right"><font face="Verdana, Arial, Helvetica, sans-serif" class="style1"> <{$lang.upload.10}> </font></div></td>
            <td><div align="left"><font face="Verdana, Arial, Helvetica, sans-serif" class="style1"><a href="<{$r_url}>"  class="style1"> <{$r_url}> </a></font></div></td>
          </tr>
          <tr>
            <td><div align="right"  class="style1"><{$lang.url.21}></div></td>
            <td><div align="left"> <{$icon}> (<{$type}>)</div></td>
          </tr>
          <{if !$reUpload}>
          <tr>
            <td><div align="right"><font face="Verdana, Arial, Helvetica, sans-serif"  class="style1"> <{$lang.upload.12}> </font></div></td>
            <td><div align="left"><font face="Verdana, Arial, Helvetica, sans-serif">
                <input name="textfield" type="text" size="50" value="<{$password}>" readonly="readonly"/>
                </font></div></td>
          </tr>
          <{/if}>
        </table>
        <br />
        <{if $img}>
        <br />
        <p align="center"><a href="javascript:toggle1('bbcode');"><span style="font-size:18px" id="show"><{$lang.url.22}></span></a> </p>
        <div align="center">
          <table width="89%" border="0" cellpadding="5" cellspacing="0" id="bbcode" style="display:none">
            <tr>
              <td width="38%"><div align="right"><span class="formtext"><{$lang.url.23}></span></div></td>
              <td width="62%"><input name="textfield2" type="text" value="<{$imgSite}>" size="70" readonly="readonly" onclick="this.focus();this.select()" ondblclick="this.focus();this.select()" /></td>
            </tr>
            <tr>
              <td><div align="right"><span class="formtext"><{$lang.url.24}></span></div></td>
              <td>
              <input name="textfield22" type="text" value="[url=<{$imgSite}>][img=<{$imgFull}>][/url]" size="70"  onclick="this.focus();this.select()" ondblclick="this.focus();this.select()" readonly="readonly"/>              </td>
            </tr>
            <tr>
              <td><div align="right"><span class="formtext"><{$lang.url.25}></span></div></td>
              <td><input name="textfield23" type="text" value="[URL=<{$imgSite}>][IMG]<{$imgFull}>[/IMG][/URL]" size="70" readonly="readonly" onclick="this.focus();this.select()" ondblclick="this.focus();this.select()" /></td>
            </tr>
            <tr>
              <td><div align="right"><span class="\&quot;formtext\&quot;"><{$lang.url.26}></span></div></td>
              <td><input name="textfield24" type="text" value="[URL=<{$imgSite}>][IMG]<{$imgThumb}>[/IMG][/URL]" size="70" readonly="readonly" onclick="this.focus();this.select()" ondblclick="this.focus();this.select()" /></td>
            </tr>
            <tr>
              <td><div align="right"><span class="\&quot;formtext\&quot;"><{$lang.url.27}></span></div></td>
              <td><input name="textfield25" type="text" value="[URL=<{$imgSite}>][IMG=<<{$imgThumb}>][/URL]" size="70" readonly="readonly" onclick="this.focus();this.select()" ondblclick="this.focus();this.select()" /></td>
            </tr>
            <tr>
              <td><div align="right"><span class="formtext"><{$lang.url.28}></span></div></td>
              <td><input name="textfield26" type="text" value="<a href='<{$imgSite}>'><img src=<{$imgFull}> border='0' alt='<{$description}>' /></a>" size="70" readonly="readonly" onclick="this.focus();this.select()" ondblclick="this.focus();this.select()" /></td>
            </tr>
            <tr>
              <td><div align="right"><span class="formtext"><{$lang.url.28}></span></div></td>
              <td><input name="textfield26" type="text" value="<a href='<{$imgSite}>'><img src=<{$imgFull}> border='0' alt='<{$description}>' /></a>" size="70" readonly="readonly" onclick="this.focus();this.select()" ondblclick="this.focus();this.select()" /></td>
            </tr>
            <tr>
              <td><div align="right"><span class="formtext"><{$lang.url.29}></span></div></td>
              <td><input name="textfield27" type="text" value="<{$imgFull}>" size="70" readonly="readonly" onclick="this.focus();this.select()" ondblclick="this.focus();this.select()" /></td>
            </tr>
          </table>
        </div>
        <{/if}>
        <{if $description}>
        <p align="center"><font face="Verdana, Arial, Helvetica, sans-serif"><br />
          <{$lang.upload.11}><br />
          </font>
          <textarea name="textarea" cols="35" rows="6" readonly="readonly"><{$description}></textarea>
        </p>
        <{/if}>
        <p align="center"> <font face="Verdana, Arial, Helvetica, sans-serif"> <{$lang.upload.13}><{$templatelite.SERVER.REMOTE_ADDR.}><{$lang.upload.14}> </font></p>
      </div></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
  </tr>
</table>