<{if isset($templatelite.post.submit)}>
    <div align="center"><p><b><{$lang.contactus.1}></b><br /><br />
    <{$lang.contactus.3}></p>
    </div>
<{else}>
	<div align="center">
		<form method="post">
		<p>
			<b><h1><{$lang.contactus.1}></h1></b>
			<br />
			<{$lang.contactus.2}>
			<{if $msg neq ''}>
				<br /><br />
                <font color="red"><{$lang.contactus.7}><br />
                <{$msg}>
                </b></font>
			<{/if}>
	    <table width="460" border="0">
          <tr>
            <td width="450"><p><{$lang.contactus.8}>
                <br />
              <input name="email" type="text" size="60" value="<?=txt_clean($_POST['email'])?>" />
            </p>            </td>
          </tr>
          <tr>
            <td height="55"><{$lang.contactus.9}><br />
              <input name="subj" type="text" size="60"  value="<?=txt_clean($_POST['subj'])?>" /></td>
          </tr>
          <tr>
            <td><table width="455" border="0">
              <tr>
                <td width="449"><{$lang.contactus.10}></td>
              </tr>
              <tr>
                <td><div align="left">
                    <textarea name="msg" cols="60" rows="10"><?=txt_clean($_POST['msg'])?></textarea>
                </div></td>
              </tr>
            </table></td>
          </tr>
          <tr>
            <td height="73"><{$lang.contactus.11}><{$captcha}><{$lang.contactus.12}>
			<br /></td>
          </tr>
        </table>
	      <input name="submit" style="font-size:16px" type="submit" value="<{$lang.contactus.13}>" /><br />
		  </p>
		  </form>
</div>
<{/if}>