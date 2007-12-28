<{if empty($templatelite.session.loggedin)}>
	<script>location: '<?=makeXuLink('index.php','p=home')?>';</script>
<{else}>
    <{if isset($templatelite.post.del) && $templatelite.post.del == "true"}>
        <div align="center">
            <p>
            	<span style="color:#009900; font-weight:bold"><{$lang.delacc.1}></span><br />
            	<{$lang.delacc.2}>
            </p>
        </div>
    <{else}>
       <div align="center">
       <h2><{$lang.delacc.3}></h2><br />
            <form action="<?=makeXuLink('index.php','p=delacc')?>" method="post" enctype="multipart/form-data" name="form1" target="_self">
               	<input id="del" name="del" type="checkbox" value="true" > <label style="font-size:14px" for="del"><{$lang.delacc.4}></label><br /><br />
                <input type="hidden" name="id" value="<?=intval($myuid)?>">
                <input type="submit" name="Submit" value="<{$lang.delacc.6}>">
            </form> 
        </div>
    <{/if}>
<{/if}>