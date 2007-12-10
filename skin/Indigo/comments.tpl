<{if $templatelite.get.edit and !isset($templatelite.post.edit)}>
    <form enctype="application/x-www-form-urlencoded" method="post" onsubmit="return check_comment()" >
    <strong><font size="5">Edit Comment! </font></strong><br />
    <br />
    <table width="685" height="177" border="0" cellpadding="3" cellspacing="0">
      <tr>
        <td width="679"><table width="673" height="75" border="0" cellpadding="5" cellspacing="0">
          <tr>
            <td width="124" height="25"><div align="right"><strong><{$lang.comments.8}><font color="#FF0000">* </font></strong></div></td>
            <td width="537"><input type="text" name="author" size="50" value="<{$comment->author}>"/></td>
          </tr>
          <tr>
            <td height="25"><div align="right"><strong><{$lang.comments.9}><font color="#FF0000">*</font> </strong></div></td>
            <td><input type="text" name="title" size="50" value="<{$comment->title}>"/></td>
          </tr>
           <tr>
            <td height="25"><div align="right"><strong><{$lang.comments.10}><font color="#FF0000">*</font> </strong></div></td>
            <td><input type="text" name="url" size="50" value="<{$comment->url}>"/></td>
          </tr>
          <tr>
            <td><div align="right"><strong><{$lang.comments.11}><font color="#FF0000">*</font> </strong></div></td>
            <td><input type="text" name="email" size="50" value="<{$comment->email}>"/></td>
          </tr>
          <tr>
            <td><div align="right"><strong><{$lang.comments.12}><font color="#FF0000">*</font> </strong></div></td>
            <td><textarea name="body" cols="60" rows="8"><{$comment->body}></textarea></td>
          </tr>
        </table>
          <div align="center"><br />
            <input name="post" type="submit" id="post" value="<{$lang.comments.13}>" />
            <input type="reset" name="Reset" value="<{$lang.comments.14}>" />
            <input type="hidden" name="edit" value="true" />
          </div></td>
      </tr>
    </table>
      <br />
      <font color="#FF0000"><strong>* = required</strong></font>
    </form>
<{/if}>