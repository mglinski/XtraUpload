<?{if !$fileExists }>
    <table width="644" border="0">
      <tr>
        <td width="638"><div align="center">
          <p><font size="2" face="Verdana, Arial, Helvetica, sans-serif"><b><{$lang.delfile.1}></b><br />
            <{$lang.delfile.2}></font><font face="Verdana, Arial, Helvetica, sans-serif"> </font>
            <script>
            alert('<{$lang.delfile.3}>');
            function r(){location = '<?=makeXuLink('index.php','p=home')?>'}setTimeout('r()',2000);
            </script>
            </p>
        </div></td>
      </tr>
    </table>
<{elseif isset($templatelite.post.del) && $templatelite.post.del == 'yes'}>
    <div align="center">
        <{$msg}><br />
        <h2>
        <{$lang.delfile.4}><br />
        <{$lang.delfile.2}>
        </h2>
        <script>function r(){location = '<?=makeXuLink('index.php','p=home')?>'}setTimeout('r()',1500);</script>
    </div>
<{else}>
	<script>
    function check()
        {
            if(document.getElementById('del1').checked == true)
                document.getElementById('del').value = 'yes';
            else
                document.getElementById('del').value = 'no';
            
            var v = document.getElementById('del').value;
            if(v == 'no')
            {
                alert('<{$lang.delfile.6}>');
                window.location = '<?=$siteurl?>index.php?p=home';
                return false;
            }
            else
                return confirm('<{$lang.delfile.7}>');
        }
    </script>
    <div align="center">
        <h1>
            <{$lang.delfile.5}> <{$file->o_filename}>
        </h1>
        <form method="post" onsubmit="return check();">
            <input id="del" name="del" type="hidden" value=""  />
            <input id="del1" name="del1" type="checkbox" value="yes"> <label for="del1"><{$lang.delfile.8}></label>
            <input type="submit" name="Submit" value="<{$lang.delfile.10}>">
        </form>
    </div>
<{/if}>
